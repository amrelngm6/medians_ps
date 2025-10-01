<template>
  <div class="w-full overflow-auto">
    <GoogleMap v-if="mapCenter" :api-key="setting.google_map_api" ref="map" :center="mapCenter"
      :key="`${mapCenter.lat},${mapCenter.lng}`" :options="{
        zoomControl: true,
        mapTypeControl: true,
        scaleControl: true,
        streetViewControl: true,
        rotateControl: true,
        fullscreenControl: true
      }" :zoom="mapZoom" style="width: 100%; height: calc(100vh - 100px)">

      <!-- Polylines for each trip -->
      <Polyline v-for="(polyline, tripId) in polylines" :key="tripId" :options="polyline" />

      <!-- Markers for all trips -->
      <CustomMarker v-for="(marker, index) in allMarkers" :key="index" :options="marker ? {
        position: marker.marker_position,
      } : null" @click="markerClicked(marker)">
        <div style="text-align: center">
          <img :src="marker.icon" width="40" class="rounded-full" height="40" style="margin-top: 8px" />
          <div v-if="marker.trip_name" class="text-xs bg-white px-1 rounded shadow" 
               :style="`color: ${marker.trip_color || '#000'}`">
            {{ marker.trip_name }}
          </div>
        </div>
      </CustomMarker>

    </GoogleMap>
    
    <!-- Trip Legend -->
    <div class="trip-legend">
      <h4 class="legend-title">Active Trips ({{ trips.length }})</h4>
      <div class="legend-scroll">
        <div v-for="(trip, index) in trips" :key="trip.id" class="legend-item">
          <div class="trip-color-indicator" :style="`background-color: ${getTripColor(index)}`"></div>
          <div class="trip-info">
            <span class="trip-name" :title="trip.route?.route_name">
              {{ trip.route?.route_name || `Trip ${index + 1}` }}
            </span>
            <span class="trip-status" :class="`status-${trip.status}`">{{ trip.status }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, watch } from 'vue';
import { GoogleMap, Polyline, CustomMarker } from 'vue3-google-map';

export default {
  components: {
    GoogleMap,
    Polyline,
    CustomMarker
  },
  emits: ['markerclicked'],
  setup(props, { emit }) {
    const map = ref(null);
    const mapCenter = ref(null);
    const mapZoom = ref(10);
    const allMarkers = ref([]);
    const polylines = ref({});
    const directionsServices = ref({});
    
    // Predefined colors for different trips
    const tripColors = [
      '#FF0000', '#00FF00', '#0000FF', '#FFFF00', '#FF00FF', 
      '#00FFFF', '#800000', '#008000', '#000080', '#808000',
      '#800080', '#008080', '#FFA500', '#FFC0CB', '#A52A2A'
    ];

    const getTripColor = (index) => {
      return tripColors[index % tripColors.length];
    };

    const originTracking = (trip) => {
      if (trip.status == 'started' && trip.vehicle) {
        return { lat: Number(trip.vehicle.latitude ?? 0), lng: Number(trip.vehicle.longitude ?? 0) };
      }
      return { lat: trip.route.position.start_latitude, lng: trip.route.position.start_longitude };
    };

    const handlePickup = (obj, trip, icon) => {
      var pic = obj.model && obj.model.picture ? obj.model.picture : icon;
      var lat = obj.status == 'waiting' ? obj.location.start_latitude : obj.location.end_latitude;
      var lng = obj.status == 'waiting' ? obj.location.start_longitude : obj.location.end_longitude;
      return handleMarker(trip, { lat: lat, lng: lng }, pic);
    };

    const handleMarker = (trip, latlng, icon = 'uploads/images/car.svg', tripIndex = 0) => {
      let data = JSON.parse(JSON.stringify(trip));
      data.icon = props.conf.url + icon;
      data.marker_position = latlng;
      data.drag = false;
      data.trip_name = trip.route?.route_name || `Trip ${tripIndex + 1}`;
      data.trip_color = getTripColor(tripIndex);
      return data;
    };

    const calculateMapBounds = () => {
      if (!props.trips || props.trips.length === 0) return;
      
      let bounds = {
        north: -90,
        south: 90,
        east: -180,
        west: 180
      };

      props.trips.forEach(trip => {
        const origin = originTracking(trip);
        const destination = {
          lat: trip.route.position.end_latitude,
          lng: trip.route.position.end_longitude
        };

        bounds.north = Math.max(bounds.north, origin.lat, destination.lat);
        bounds.south = Math.min(bounds.south, origin.lat, destination.lat);
        bounds.east = Math.max(bounds.east, origin.lng, destination.lng);
        bounds.west = Math.min(bounds.west, origin.lng, destination.lng);
      });

      // Calculate center
      mapCenter.value = {
        lat: (bounds.north + bounds.south) / 2,
        lng: (bounds.east + bounds.west) / 2
      };

      // Calculate appropriate zoom level
      const latDiff = bounds.north - bounds.south;
      const lngDiff = bounds.east - bounds.west;
      const maxDiff = Math.max(latDiff, lngDiff);
      
      if (maxDiff > 10) mapZoom.value = 6;
      else if (maxDiff > 5) mapZoom.value = 8;
      else if (maxDiff > 1) mapZoom.value = 10;
      else mapZoom.value = 12;
    };

    const setMarkersForAllTrips = () => {
      allMarkers.value = [];
      
      props.trips.forEach((trip, tripIndex) => {
        const tripColor = getTripColor(tripIndex);
        
        // Vehicle/Origin marker
        const origin = originTracking(trip);
        allMarkers.value.push(handleMarker(trip, origin, 'uploads/images/car.svg', tripIndex));

        // Waypoint markers
        if (props.waypoints && props.waypoints[trip.id]) {
          props.waypoints[trip.id].forEach(waypoint => {
            if (waypoint.status == 'waiting' || waypoint.status == 'moving') {
              allMarkers.value.push(handlePickup(waypoint, trip, 'uploads/images/pin.svg'));
            }
          });
        }

        // Destination marker
        const destination = {
          lat: trip.route.position.end_latitude,
          lng: trip.route.position.end_longitude
        };
        allMarkers.value.push(handleMarker(trip, destination, 'uploads/images/destination.svg', tripIndex));
      });

      allMarkers.value = allMarkers.value.filter(marker => marker != null);
    };

    const fetchRoutesForAllTrips = () => {
      if (!window.google) {
        setTimeout(fetchRoutesForAllTrips, 1000);
        return;
      }

      props.trips.forEach((trip, tripIndex) => {
        const tripColor = getTripColor(tripIndex);
        const directionsService = new window.google.maps.DirectionsService();
        directionsServices.value[trip.id] = directionsService;

        const origin = originTracking(trip);
        const destination = {
          lat: trip.route.position.end_latitude,
          lng: trip.route.position.end_longitude
        };

        const waypoints = handleWaypoints(trip);

        directionsService.route({
          origin: origin,
          destination: destination,
          waypoints: waypoints,
          travelMode: window.google.maps.TravelMode.DRIVING,
          avoidTolls: true,
        })
        .then((result) => {
          const points = extractPolylinePoints(result);
          polylines.value[trip.id] = {
            path: points,
            geodesic: true,
            strokeColor: tripColor,
            strokeOpacity: 0.8,
            strokeWeight: 3,
          };
        })
        .catch((e) => {
          console.error(`Could not display directions for trip ${trip.id}:`, e);
        });
      });
    };

    const extractPolylinePoints = (directionsResult) => {
      const polyline = directionsResult.routes[0].overview_polyline;
      const polylinePoints = window.google.maps.geometry.encoding.decodePath(polyline);
      return polylinePoints.map(point => ({ lat: point.lat(), lng: point.lng() }));
    };

    const handleWaypoints = (trip) => {
      const waypoints = [];
      if (props.waypoints && props.waypoints[trip.id]) {
        props.waypoints[trip.id].forEach(waypoint => {
          if (waypoint.marker_position) {
            waypoints.push({ location: waypoint.marker_position });
          }
        });
      }
      return waypoints.length ? waypoints : null;
    };

    const markerClicked = (marker) => {
      emit('markerclicked', marker);
    };

    // Watch for changes in trips
    watch(() => props.trips, () => {
      if (props.trips && props.trips.length > 0) {
        calculateMapBounds();
        setMarkersForAllTrips();
        fetchRoutesForAllTrips();
      }
    }, { immediate: true, deep: true });

    onMounted(() => {
      if (props.trips && props.trips.length > 0) {
        calculateMapBounds();
        setMarkersForAllTrips();
        fetchRoutesForAllTrips();
      }
    });

    return {
      map,
      markerClicked,
      allMarkers,
      mapCenter,
      mapZoom,
      polylines,
      getTripColor,
      trips: props.trips
    };
  },
  props: ['system_setting', 'setting', 'trips', 'conf', 'waypoints', 'center'],
};
</script>

<style scoped>
.trip-legend {
  position: absolute;
  top: 16px;
  left: 16px;
  background: white;
  padding: 16px;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  z-index: 10;
  min-width: 250px;
  max-width: 350px;
}

.legend-title {
  font-weight: bold;
  font-size: 14px;
  margin-bottom: 12px;
  color: #333;
  border-bottom: 1px solid #eee;
  padding-bottom: 8px;
}

.legend-scroll {
  max-height: 300px;
  overflow-y: auto;
}

.legend-item {
  display: flex;
  align-items: center;
  margin-bottom: 8px;
  padding: 6px;
  border-radius: 4px;
  transition: background-color 0.2s;
}

.legend-item:hover {
  background-color: #f5f5f5;
}

.trip-color-indicator {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  margin-right: 10px;
  flex-shrink: 0;
  border: 2px solid white;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
}

.trip-info {
  display: flex;
  flex-direction: column;
  min-width: 0;
}

.trip-name {
  font-size: 12px;
  font-weight: 500;
  color: #333;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  margin-bottom: 2px;
}

.trip-status {
  font-size: 10px;
  padding: 2px 6px;
  border-radius: 12px;
  text-transform: uppercase;
  font-weight: 600;
  align-self: flex-start;
}

.status-active, .status-started {
  background-color: #d4edda;
  color: #155724;
}

.status-pending, .status-waiting {
  background-color: #fff3cd;
  color: #856404;
}

.status-completed {
  background-color: #cce7ff;
  color: #004085;
}

.status-cancelled {
  background-color: #f8d7da;
  color: #721c24;
}

/* Custom scrollbar for legend */
.legend-scroll::-webkit-scrollbar {
  width: 4px;
}

.legend-scroll::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 2px;
}

.legend-scroll::-webkit-scrollbar-thumb {
  background: #ccc;
  border-radius: 2px;
}

.legend-scroll::-webkit-scrollbar-thumb:hover {
  background: #999;
}
</style>
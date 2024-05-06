<template>
  <div class="w-full overflow-auto">
    <GoogleMap v-if="mapCenter" :api-key="system_setting.google_map_api" ref="map" :center="mapCenter"
      :key="`${mapCenter.lat},${mapCenter.lng}`" :options="{
        zoomControl: true,
        mapTypeControl: true,
        scaleControl: true,
        streetViewControl: true,
        rotateControl: true,
        fullscreenControl: true
      }" :zoom="mapZoom" style="width: 100%; height: calc(100vh - 100px)">
      <Polyline :options="polylinePath" />


      <CustomMarker v-for="(marker, index) in markers" :options="{
        position: marker.marker_position,
      }" @click="markerClicked(marker)">
        <div style="text-align: center">
          <img :src="marker.icon" width="40" class="rouned-full" height="40" style="margin-top: 8px" />
        </div>
      </CustomMarker>

    </GoogleMap>
    
    <div id="panel"></div>
    <div id="total"></div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { decodePoly } from '@/utils.vue';
import { GoogleMap, Polyline, CustomMarker } from 'vue3-google-map';
import axios from 'axios'

export default {
  components: {
    GoogleMap,
    Polyline,
    CustomMarker
  },
  emits:['markerclicked'],
  setup(props, {emit}) {
    const map = ref(null);
    const mapCenter = ref(null);
    const mapZoom = ref(12);
    const markers = ref([]);
    const polylinePath = ref([]);
    const routeCoordinates = ref([]);
    const polylineOptions = ref({
      strokeColor: '#000000',
      strokeOpacity: 0.8,
      strokeWeight: 2,
    });

    const trip = ref(props.trip);


    /**
    * Handle object
    * @param {Model Object} i 
    */
    const handlePickup = (obj, latKey = 'lat', lngKey = 'lng', icon) => {
      let data = JSON.parse(JSON.stringify(obj))
      data.icon = props.conf.url + 'uploads/images/' + icon
      data.marker_position = { lat: parseFloat(obj[latKey]), lng: parseFloat(obj[lngKey]) }
      data.drag = false;
      return data;
    }

    const setValues = () => 
    {
      markers.value = [handlePickup(trip.value, 'pickup_latitude', 'pickup_longitude', 'car.svg')];
      markers.value[markers.value.length] = handlePickup(trip.value, 'destination_latitude', 'destination_longitude', 'destination.svg')
    }

    setValues();

    const mapOrigin = ref({ lat: 0, lng: 0 }); // Set initial values
    const mapDestination = ref({ lat: 0, lng: 0 }); // Set initial values
    const directionsService = ref(null);
    const directionsRenderer = ref(null);

    const handleAlterDirection = () => {
      console.log(window)
      setTimeout(function(){

        directionsService.value =  new window.google.maps.DirectionsService();
        directionsRenderer.value = new window.google.maps.DirectionsRenderer({
            draggable: true,
            map,
            panel: document.getElementById("panel"),
        });

        directionsRenderer.value.addListener("directions_changed", () => {
          const directions = directionsRenderer.value.getDirections();

          if (directions) {
            computeTotalDistance(directions);
          }
        });

        displayRoute(
          mapOrigin.value,
          mapDestination.value,
          directionsService.value,
          directionsRenderer.value
        );
      }, 2000)

    }

    const  displayRoute = (origin, destination, service, display) => {
      service
        .route({
          origin: origin,
          destination: destination,
          // waypoints: [
          //   { location: mapOrigin },
          // ],
          travelMode: google.maps.TravelMode.DRIVING,
          avoidTolls: true,
        })
        .then((result) => {
          console.log(result)
          const points = decodePoly(result.routes[0].overview_polyline.points);
          routeCoordinates.value = points;

          polylinePath.value = {
            path: points,
            geodesic: true,
            strokeColor: "#000",
            strokeOpacity: .9,
            strokeWeight: 2,
          };

          // display.setDirections(result);
        })
        .catch((e) => {
          alert("Could not display directions due to: " + e);
        });
    }


    const computeTotalDistance = (result) => {
        let total = 0;
        const myroute = result.routes[0];

        if (!myroute) {
          return;
        }

        for (let i = 0; i < myroute.legs.length; i++) {
          total += myroute.legs[i].distance.value;
        }

        total = total / 1000;
        document.getElementById("total").innerHTML = total + " km";
    }

    const fetchRoute = async () => {
      return handleAlterDirection();

    //   const baseUrl = 'http://localhost:3000/directions'; // Use your server's URL
    //   const url = `${baseUrl}?origin=${mapOrigin.value.lat},${mapOrigin.value.lng}&destination=${mapDestination.value.lat},${mapDestination.value.lng}&apiKey=${props.system_setting.google_map_api}`;
      const baseUrl = 'https://maps.googleapis.com/maps/api/directions/json';
      const url = `${baseUrl}?origin=${mapOrigin.value.lat},${mapOrigin.value.lng}&destination=${mapDestination.value.lat},${mapDestination.value.lng}&key=${props.system_setting.google_map_api}`;


      try {
        const response = await fetch(url);

        if (response.ok) {
          const data = await response.json();
          const points = decodePoly(data.routes[0].overview_polyline.points);
          routeCoordinates.value = points;

          polylinePath.value = {
            path: points,
            geodesic: true,
            strokeColor: "#000",
            strokeOpacity: .9,
            strokeWeight: 2,
          };
        } else {
          console.error('Failed to fetch route:', response.statusText);
        }
      } catch (error) {
        console.error('Error fetching route:', error);
      }
    };


    onMounted(() => {
        mapOrigin.value = { lat: trip.value.pickup_latitude, lng: trip.value.pickup_longitude }; // Example coordinates (New York)
        mapCenter.value = mapOrigin.value;
        mapDestination.value = { lat: trip.value.destination_latitude, lng: trip.value.destination_longitude }; // Example coordinates (Los Angeles)
        fetchRoute();
    });

    const markerClicked = (marker) => 
    {
      emit('markerclicked', marker)
    }

    return {
      map,
      markerClicked,
      markers,
      mapCenter,
      mapZoom,
      polylinePath,
      routeCoordinates,
      polylineOptions,
    };
  },
  props: ['system_setting', 'trip', 'conf'],
};
</script>
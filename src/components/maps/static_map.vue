<template>
    <div class="w-full overflow-auto">
      <GoogleMap v-if="mapCenter" :api-key="system_setting.google_map_api" ref="mapRef" :center="mapCenter"
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
  
      const location = ref(props.item);
  
      /**
      * Handle object
      * @param {Model Object} i 
      */
      const handlePickup = (obj, latlng, icon) => {
        let data = JSON.parse(JSON.stringify(obj))
        data.icon = props.conf.url + 'uploads/images/' + icon
        data.marker_position = latlng
        data.drag = false;
        return data;
      }
  
      const setValues = () => {
  
        markers.value = [
            handlePickup(location.value, {lat: location.value.start_latitude, lng: location.value.start_longitude}, 'yellow_pin.gif'), 
            handlePickup(location.value, {lat: location.value.end_latitude, lng: location.value.end_longitude}, 'destination.svg'), 
        ];
        
      }
  
      setValues();
  
      const directionsService = ref(null);
      const directionsRenderer = ref(null);

      const fetchRoute = () => {
        directionsService.value =  new window.google.maps.DirectionsService();
        directionsRenderer.value = new window.google.maps.DirectionsRenderer({
            draggable: true,
            map,
            panel: document.getElementById("panel"),
        });

        displayRoute(
          mapOrigin.value,
          mapDestination.value,
          directionsService.value,
          directionsRenderer.value
        );
      }

      const  displayRoute = (origin, destination, service, display) => {
        service
          .route({
            origin: origin,
            destination: destination,
            // waypoints: [
              // { location: origin },
            // ],
            travelMode: window.google.maps.TravelMode.DRIVING,
            avoidTolls: true,
          })
          .then((result) => {
            console.log(result)
            const points = extractPolylinePoints(result);
            routeCoordinates.value = points;
            polylinePath.value = {
              path: points,
              geodesic: true,
              strokeColor: "#000",
              strokeOpacity: .9,
              strokeWeight: 2,
            };
          })
          .catch((e) => {
            alert("Could not display directions due to: " + e);
          });
      }

      const extractPolylinePoints = (directionsResult) => {
        const polyline = directionsResult.routes[0].overview_polyline;
        const polylinePoints = window.google.maps.geometry.encoding.decodePath(polyline);
        return polylinePoints.map(point => ({ lat: point.lat(), lng: point.lng() }));
      }

  
      onMounted(() => {
        mapCenter.value = { lat: location.value.start_latitude, lng: location.value.start_longitude };
        fetchRoute();
      });
  
      const markerClicked = (marker) => 
      {
        emit('markerclicked', marker)
      }
  
      return {
        markerClicked,
        markers,
        mapCenter,
        mapZoom,
        polylinePath,
        routeCoordinates,
        polylineOptions,
      };
    },
    props: ['system_setting', 'item', 'conf'],
  };
  </script>
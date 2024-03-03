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
      const handlePickup = (obj, latKey = 'lat', lngKey = 'lng', icon) => {
        let data = JSON.parse(JSON.stringify(obj))
        data.icon = props.conf.url + 'uploads/images/' + icon
        data.marker_position = { lat: parseFloat(obj[latKey]), lng: parseFloat(obj[lngKey]) }
        data.drag = false;
        return data;
      }
  
      const setValues = () => {
  
        markers.value = [
            handlePickup(location.value, 'start_latitude', 'start_longitude', 'yellow_pin.gif'), 
            handlePickup(location.value, 'end_latitude', 'end_longitude', 'destination.svg')
        ];
        
      }
  
      setValues();
  
      const fetchRoute = async () => {
        const baseUrl = 'http://localhost:3000/directions'; // Use your server's URL
        // const url = `${baseUrl}?origin=${mapOrigin.value.lat},${mapOrigin.value.lng}&destination=${mapDestination.value.lat},${mapDestination.value.lng}&apiKey=${props.system_setting.google_map_api}`;
        // const baseUrl = 'https://maps.googleapis.com/maps/api/directions/json';
        const url = `${baseUrl}?origin=${location.value.start_latitude},${location.value.start_longitude}&destination=${location.value.end_latitude},${location.value.end_longitude}&key=${props.system_setting.google_map_api}`;
  
        try {
  
          axios.get(url)
          .then(response => {
            
            if (response.data) {
              const data = response.data;
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
            
          })
          .catch(error => {
            // Handle errors here
            console.error('Error fetching data:', error);
          });
  
          const response = await fetch(url);
  
        } catch (error) {
          console.error('Error fetching route:', error);
        }
      };
  
  
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
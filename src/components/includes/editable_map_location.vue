<template>
  <div>
    <GoogleMap
        :api-key="system_setting.google_map_api" 
        ref="mapRef"
        :center="mapCenter"
        :zoom="mapZoom"
        style="height: 400px; width: 100%"
        @map-click="handleMapClick"
        :options="{
            zoomControl: true,
            mapTypeControl: true,
            scaleControl: true,
            streetViewControl: true,
            rotateControl: true,
            fullscreenControl: true
        }"
    >
    
        <Marker :options="{
            position: markerPosition,
            draggable: true,
        }" :draggable="true" @dragend="handleMarkerDragEnd" />
    </GoogleMap>
  </div>
</template>

<script>
import { ref, watch, onMounted } from 'vue';
import { GoogleMap,  CustomMarker, InfoWindow , Marker,Polyline } from "vue3-google-map";

export default {
  components: {
    GoogleMap,
    Marker,
  },
  emits: ['setlocation'],
  setup(props, {emit}) {
    const mapCenter = ref({ lat: props.location.lat, lng: props.location.lng });
    const mapZoom = ref(14);
    const searchQuery = ref('');

    const markerPosition = ref({ lat: mapCenter.value.lat, lng: mapCenter.value.lng });

    const handleMapClick = (event) => {
      const { latLng } = event;
      setMapCenter(latLng.lat(), latLng.lng());
      setMarkerPosition(latLng.lat(), latLng.lng());
    };

    const handleSearch = () => {
      // Handle search button click if needed
    };

    const handleMarkerDragEnd = (event) => {
      const { latLng } = event;
      setMapCenter(latLng.lat(), latLng.lng());
      emit('setlocation', latLng);
    };

    const setMapCenter = (lat, lng) => {
      mapCenter.value = { lat, lng };
    };

    const setMarkerPosition = (lat, lng) => {
      // If you want to update marker position programmatically
      mapRef.value.setMarkerPosition({ lat, lng });
    };

    // Use onMounted to initialize the map and marker
    onMounted(() => {
      // Your map initialization code here
    });

    // Use the returned values from the setup function
    return {
      mapCenter,
      mapZoom,
      searchQuery,
      markerPosition,
      handleMapClick,
      handleSearch,
      handleMarkerDragEnd,
      setMapCenter,
      setMarkerPosition,
    };
  },
  props: ['system_setting', 'location','item']
};
</script>

<template>
    <div class="w-full  overflow-auto" >
        <GoogleMap :api-key="setting.google_map_api" ref="map" :center="mapCenter" :key="mapCenter"  
            :options="{
                zoomControl: true,
                mapTypeControl: true,
                scaleControl: true,
                streetViewControl: true,
                rotateControl: true,
                fullscreenControl: true
            }"
            
            :zoom="zoom" style="width: 100%; height: calc(100vh -  100px)">
            
            <CustomMarker
                    v-for="(marker, i) in markers" 
                    :options="{
                        position: marker,
                    }"
                    @click="markerClicked(drivers[i])"
                    >
                    <div style="text-align: center" > 
                        <img :src="'/app/image.php?h=50&w=50&src='+drivers[i].picture" width="40" class="rounded-full bg-white " height="40" style="margin-top: 8px" />
                    </div>
                </CustomMarker>
                
                <CustomMarker
                    :options="{
                        position: {lat: item.pickup_latitude,lng: item.pickup_longitude},
                    }"
                    >
                    <div style="text-align: center" > 
                        <img :src="'/uploads/images/yellow_pin.gif'" width="30" class="" height="30" style="margin-top: 8px" />
                    </div>
                </CustomMarker>

        </GoogleMap>
    </div>
</template>
<script>

import { ref } from "vue";
import { GoogleMap,  CustomMarker, InfoWindow , Marker,Polyline } from "vue3-google-map";

export default
{
    components: {
        GoogleMap, 
        Marker,
        Polyline,
        InfoWindow,
        CustomMarker 
        // DirectionsRenderer,
    },
    name: 'Map',
    emits:[
        'click-marker',
        'update-marker',
    ],
    emits: ['setdriver'],
    setup(props, {emit}) 
    {
        const map = ref(null);

        const zoom = ref(10);
        const mapCenter = ref({});
        const markers = ref([]);
        for (let i = 0; i < props.drivers.length; i++) {
            const element = props.drivers[i];
            markers.value[i] = {lat: Number(element.vehicle.latitude) ?? 0 , lng: Number(element.vehicle.longitude) ?? 0};
        }

        mapCenter.value = props.center ?? markers.value[0];

        const markerClicked = (driver) => {
            emit('setdriver', driver)
        }

        const handleZoom = () => {

            const bounds = new window.google.maps.LatLngBounds();
            markers.value.forEach(marker => {
                bounds.extend(marker);
            });

            // Set the center of the map to the center of the bounds
            mapCenter.value = bounds.getCenter();

            // Set the zoom level to fit all markers within the bounds
            map.value.fitBounds(bounds);
        }
        

        return {
            handleZoom,
            markerClicked,
            zoom,
            map,
            mapCenter,
            markers,
        }
    },

    props: [
        'path',
        'lang',
        'setting',
        'conf',
        'auth',
        'center',
        'item',
        'drivers',
    ]

};
</script>
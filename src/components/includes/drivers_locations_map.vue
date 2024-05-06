<template>
    <div class="w-full  overflow-auto" >
        <GoogleMap :api-key="setting.google_map_api" ref="trip_map" :center="newcenter" :key="newcenter" 
            :options="{
                zoomControl: true,
                mapTypeControl: true,
                scaleControl: true,
                streetViewControl: true,
                rotateControl: true,
                fullscreenControl: true
            }"
            
            :zoom="zoom" style="width: 100%; height: calc(100vh -  100px)">
            
                <!-- <Polyline v-if="showroute" :options="flightPath" /> -->

                <CustomMarker
                    v-for="(marker, index) in markers" 

                    :options="{
                        position: marker.destination,
                    }"
                    >
                    <div style="text-align: center">
                        <img :src="marker.icon" width="40" class="rouned-full" height="40" style="margin-top: 8px" />
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
        
        const zoom = ref(14);
        const newcenter = ref({});
        const markers = ref([]);
        console.log(props.drivers);
        for (let i = 0; i < props.drivers.length; i++) {
            const element = props.drivers[i];
            markers.value[i] = {lat: element.vehicle.latitude ?? 0 , lng: element.vehicle.latitude ?? 0};
        }
        // newcenter.value = {lat: props.center.destination.lat, lng: props.center.destination.lng};
        console.log(markers.value);

        return {
            zoom,
            newcenter,
            markers,
        }
    },

    props: [
        'path',
        'lang',
        'setting',
        'conf',
        'auth',
        'drivers',
    ]

};
</script>
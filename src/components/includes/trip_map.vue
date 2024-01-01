<template>
    <div class="w-full  overflow-auto" style="height: 85vh; z-index: 9999;">
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
                        draggable: true,
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
    setup(props, {emit}) 
    {
        console.log(props.waypoints);
        console.log(props.center);


        const zoom = ref(14);
        const newcenter = ref({});
        
        newcenter.value = props.center;
             
        return {
            zoom,
            newcenter,
            markers: props.waypoints,
        }
    },

    props: [
        'path',
        'lang',
        'setting',
        'conf',
        'auth',
        'waypoints',
        'center',
    ]

};


// export default
//     {
//         components: {
//             // DirectionsRenderer,
//         },
//         name: 'Trip Map',
//         data() {
//             return {
                
//                 modes: ['DRIVING', 'WALKING'],
//                 activeMarkerIndex: 0,
//                 reload: true,
//                 render: true,
//                 travelMode: 'DRIVING',
//                 origin: { lat: 0, lng: 0 }, // Replace with your origin location
//                 destination: { lat: 0, lng: 0 }, // Replace with your destination location
                
//                 zoom: 12,
//                 markers: [
//                 ],
                
//                 center: { lat: 0, lng: 0 }, 
//                 waypoints: [],
//                 polylineCoordinates: [],
//                 directionPoints: {},
//                 activeDestination: {},
//             }

//         },

//         computed: {

//         },
//         props: [
//             'path',
//             'lang',
//             'setting',
//             'conf',
//             'auth',
//             'trip',
//             'showroute',
//             // 'waypoints',
//             // 'center',
//         ],
//         mounted() {
//             var t = this;
//             setTimeout(function(){
//                 t.onMapReady()
//             }, 1000)
//         },

//         methods:
//         {

//             /**
//              * When map loaded is ready
//              * 
//              * @param
//              */
//             onMapReady()
//             {
//                 var t = this;
//                 t.updateMarkers(this.trip.vehicle);

//                 setInterval(() => {
//                     t.updateVehicle()
//                 }, 10000);
//             },

//             updateVehicle()
//             {   
//                 var t = this;
//                 let url = this.conf ? (this.conf.url + "vehicle/"+this.trip.vehicle_id) : ''
//                 this.$root.$children[0].handleGetRequest( url ).then(response=> {
//                     t.updateMarkers(response);
//                 });
//             },

//             /**
//              * Set markers and update 
//              * if got new location
//              */
//             updateMarkers(item)
//             {
//                 this.center = {lat: parseFloat(item.latitude), lng: parseFloat(item.longitude)}
//                 this.waypoints = this.trip.locations;
//                 this.waypoints[0].origin = this.center;
//             },
            

//             async checkMarker(i)  {
//                 this.activeDestination = this.waypoints[i].destination;
//                 this.$emit('click-marker', this.waypoints[i], i);
//             },
            
            

//             __(i) {
//                 return this.$root.$children[0].__(i);
//             }
//         }
//     };
</script>
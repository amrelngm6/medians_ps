<template>
    <div class="w-full  overflow-auto" style="height: 85vh; z-index: 9999;">
        <GoogleMap :api-key="setting.google_map_api" ref="gmap" :center="center" :key="reload" 
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
                    v-for="(marker, index) in waypoints" 

                    :options="{
                        draggable: true,
                        position: marker.destination,
                    }"
                    v-if="!showDrag"
                    :key="showDrag" 
                    :draggable="true"
                    @click="enableDrag(marker, index)"
                    >
                    <div style="text-align: center">
                        <img :src="marker.icon" width="40" class="rouned-full" height="40" style="margin-top: 8px" />
                    </div>
                </CustomMarker>

                <Marker
                    v-for="(marker, index) in waypoints" 
                    :options="{
                        position: marker.destination,
                        draggable: true
                    }"
                    :key="showDrag" 
                    :draggable="true"
                    v-if="showDrag"
                    @click="checkMarker(marker, index)"
                    @drag="activeMarkerIndex = index" 
                    @dragend="updateMarker(marker, index)" >

                </Marker>

        </GoogleMap>
    </div>
</template>
<script>
// import DirectionsRenderer from "./map_direction.vue";
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


            const reload = ref(null);
            const render = ref(null);
            const showDrag = ref(null);
            const travelMode = ref('Driving');
            const zoom = ref(14);
            const markers = ref([]);
            const polylineCoordinates = ref([]);
            const directionPoints = ref({});
            const activeDestination = ref({});
            const activeMarkerIndex = ref({});
            
            const  enableDrag = (marker, i) =>  {
                showDrag.value = true
                checkMarker(marker, i)
            }
            
            
            const  checkMarker = async (marker, i ) =>  {
                activeMarkerIndex.value = i;
                emit('click-marker', props.waypoints[i], i, JSON.parse(JSON.stringify(marker)));
            }
            
            
            const  updateMarker = async (marker, i ) =>  {
                console.log('dragged')
                console.log(i)
                console.log(marker)
                // activeMarkerIndex.value = i;
                // emit('update-marker', props.waypoints[i], i, JSON.parse(JSON.stringify(marker)));
            }
            
                    
            return {
                checkMarker,
                enableDrag,
                updateMarker,
                reload,
                render,
                showDrag,
                travelMode,
                origin: { lat: 0, lng: 0 }, // Replace with your origin location
                destination: { lat: 0, lng: 0 }, // Replace with your destination location
                zoom,
                markers: props.waypoints,
                polylineCoordinates,
                activeMarkerIndex,
                directionPoints,
                activeDestination,
            }

        },

        props: [
            'path',
            'lang',
            'setting',
            'conf',
            'auth',
            'waypoints',
            'showroute',
            'center',
        ],

        // methods:
        // {

        //     /**
        //      * When map loaded is ready
        //      * 
        //      * @param
        //      */
            
        //     calculateDistance(location1, location2) {
        //         const R = 6371; // Radius of the Earth in kilometers
        //         const lat1 = location1.lat;
        //         const lon1 = location1.lng;
        //         const lat2 = location2.lat;
        //         const lon2 = location2.lng;

        //         const dLat = (lat2 - lat1) * (Math.PI / 180);
        //         const dLon = (lon2 - lon1) * (Math.PI / 180);

        //         const a =
        //             Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        //             Math.cos(lat1 * (Math.PI / 180)) * Math.cos(lat2 * (Math.PI / 180)) *
        //             Math.sin(dLon / 2) * Math.sin(dLon / 2);

        //         const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        //         const distance = R * c; // Distance in kilometers

        //         return distance;
        //     },

        //     addPoint(event, status) {
        //         if (status == 'waiting')
        //         {
        //             this.polylineCoordinates.push(event);
        //         }
        //         // Sorting the polylineCoordinates array based on distance from a specific location
        //         this.polylineCoordinates.sort((a, b) => {
        //             const locationData = props.waypoints[0];
        //             const distanceA = this.calculateDistance(locationData, a);
        //             const distanceB = this.calculateDistance(locationData, b);

        //             return distanceA - distanceB;
        //         });

        //     },
        //     setMarker(i) { this.activeMarkerIndex = i; },
        //     updateDestination(event) {
        //         this.destination = {
        //             lat: event.latLng.lat(),
        //             lng: event.latLng.lng(),
        //         };
        //     },
        //     updateOrigin(event) {
        //         this.origin = {
        //             lat: event.latLng.lat(),
        //             lng: event.latLng.lng(),
        //         };
        //     },
            
            
        //      calculateAndDisplayRoute() {
        //         var t = this;
        //         if (window.google && props.waypoints.length && this.showroute) 
        //         {
        //             t.directionPoints = {origin: props.waypoints[0].destination, destination:props.waypoints[1].destination};
        //             var {origin, destination} = t.directionPoints;
                    
        //             t.directionsService.route(
        //                 {
        //                     origin: new window.google.maps.LatLng(origin.lat, origin.lng),
        //                     destination: this.activeDestination ? this.activeDestination : new window.google.maps.LatLng(destination.lat, destination.lng),
        //                     travelMode: 'DRIVING'
        //                 },
        //                 (response, status) => {
        //                     if (status === 'OK') {
        //                         t.directionsDisplay.setDirections(response);
        //                     } else {
        //                         console.warn('Directions request failed due to ' + status);
        //                     }
        //                 }
        //             );
        //         }
        //     },



        // }
    };
</script>
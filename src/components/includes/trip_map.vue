<template>
    <div class="w-full  overflow-auto" style="height: 85vh; z-index: 9999;">
        <GoogleMap :api-key="setting.google_map_api" ref="trip_map" :center="center" :key="reload" 
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
                    v-for="(marker, index) in markers" 
                    :options="{
                        position: marker.destination,
                        draggable: true,
                    }"
                    :key="showDrag" 
                    v-if="showDrag"
                    @dragstart="onMarkerDragStart(index)"
                    @dragend="updateMarker"
                    >

                </Marker>

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
        
        
        const  updateMarker = async (event) =>  {
            let newObject = props.waypoints[activeMarkerIndex.value]
            newObject.latitude = event.latLng.lat()
            newObject.longitude = event.latLng.lng()
            newObject.address = await handlePositionToPlaceId(newObject.latitude, newObject.longitude);

            props.waypoints[activeMarkerIndex.value].destination = {lat: newObject.latitude, lng: newObject.longitude};

            showDrag.value = null;
            emit('update-marker', newObject);
        }
        
        
        const  getPlaceIdFromPosition = async (lat, lng) => {
            const geocoder = new google.maps.Geocoder();

            const latLng = { lat: parseFloat(lat), lng: parseFloat(lng) };

            return new Promise((resolve, reject) => {
                geocoder.geocode({ location: latLng }, (results, status) => {
                if (status === 'OK') {
                    results[0] ? resolve(results[0]) : reject('No results found');
                } else {
                    reject(`Geocoder failed due to: ${status}`);
                }
                });
            });
        }

        const handlePositionToPlaceId = async (lat, lng) => {

            try {
                const place = await getPlaceIdFromPosition(lat, lng);
                return place.formatted_address;
                // Perform actions with the retrieved placeId
            } catch (error) {
                console.error(error);
                // Handle error if geocoding fails
            }
        }
        
        const  onMarkerDragStart =  (i) =>  {
            activeMarkerIndex.value = i
        }
        
             
        return {
            checkMarker,
            onMarkerDragStart,
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
        'trip',
        'waypoints',
        'showroute',
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
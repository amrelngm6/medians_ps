<template>
    <div class="w-full  overflow-auto" >
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
                        <img :src="marker.icon" width="40" class="rounded-full" height="40" style="margin-top: 8px" />
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
            showDrag.value = props.dragggable ? true : false
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
        'waypoints',
        'showroute',
        'dragggable',
        'center',
    ],

};
</script>
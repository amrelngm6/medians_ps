<template>
    <div class="w-full  overflow-auto" style="height: 85vh; z-index: 9999;">
        <GmapMap ref="trip_map" :center="center" :key="waypoints" 
            :options="{
                zoomControl: true,
                mapTypeControl: true,
                scaleControl: true,
                streetViewControl: true,
                rotateControl: true,
                fullscreenControl: true
            }"
            :zoom="zoom" style="width: 100%; height: calc(100vh -  100px)">

            
            <DirectionsRenderer 
                v-if="showroute && directionPoints"
                :destination="directionPoints.destination" 
                :origin="directionPoints.origin"
                :key="directionPoints" 
                :travelMode="travelMode"  ></DirectionsRenderer>
                
            <GmapMarker
                v-for="(marker, index) in waypoints" 
                :key="waypoints" 
                :position="marker.destination"
                :clickable="true" 
                :draggable="false" 
                :icon="marker.icon ? marker.icon : null" 
                @click="checkMarker(index)"
                >
            </GmapMarker> 

        </GmapMap>
    </div>
</template>
<script>

import DirectionsRenderer from "./map_direction.vue";

export default
    {
        components: {
            DirectionsRenderer,
        },
        name: 'Trip Map',
        data() {
            return {
                
                modes: ['DRIVING', 'WALKING'],
                activeMarkerIndex: 0,
                reload: true,
                render: true,
                travelMode: 'DRIVING',
                origin: { lat: 0, lng: 0 }, // Replace with your origin location
                destination: { lat: 0, lng: 0 }, // Replace with your destination location
                
                zoom: 16,
                markers: [
                ],
                
                center: { lat: 0, lng: 0 }, 
                waypoints: [],
                polylineCoordinates: [],
                directionPoints: {},
                activeDestination: {},
            }

        },

        computed: {

        },
        props: [
            'path',
            'lang',
            'setting',
            'conf',
            'auth',
            'trip',
            'showroute',
            // 'waypoints',
            // 'center',
        ],
        mounted() {
            var t = this;
            setTimeout(function(){
                t.onMapReady()
            }, 1000)
        },

        methods:
        {

            /**
             * When map loaded is ready
             * 
             * @param
             */
            onMapReady()
            {
                var t = this;
                t.updateMarkers(this.trip.vehicle);

                setInterval(() => {
                    t.updateVehicle()
                }, 10000);
            },

            updateVehicle()
            {   
                var t = this;
                let url = this.conf ? (this.conf.url + "vehicle/"+this.trip.vehicle_id) : ''
                this.$root.$children[0].handleGetRequest( url ).then(response=> {
                    t.center = {lat: parseFloat(response.latitude), lng: parseFloat(response.longitude)};
                    console.log()
                });
            },

            /**
             * Set markers and update 
             * if got new location
             */
            updateMarkers(item)
            {
                this.center = {lat: parseFloat(item.latitude), lng: parseFloat(item.longitude)}
                this.waypoints = this.trip.locations;
            },
            
            
            /**
            * Handle object
            * @param {Model Object} i 
            */
            handleObject(data) {
                data.icon = this.conf ? (this.conf.url + 'uploads/images/blue_pin.gif') : ''
                data.origin = data.destination = { lat: parseFloat(data.latitude), lng: parseFloat(data.longitude) }
                data.drag = false;
                return data;
            },


            async checkMarker(i)  {
                this.activeDestination = this.waypoints[i].destination;
                this.$emit('click-marker', this.waypoints[i], i);
            },
            
            

            __(i) {
                return this.$root.$children[0].__(i);
            }
        }
    };
</script>
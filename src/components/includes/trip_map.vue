<template>
    <div class="w-full  overflow-auto" style="height: 85vh; z-index: 9999;">
        <GmapMap ref="gmap" :center="center" :key="center" 
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
                :travelMode="travelMode" 
                 />
                
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
        name: 'Vehicles',
        data() {
            return {
                modes: ['DRIVING', 'WALKING'],
                activeMarkerIndex: 0,
                reload: true,
                render: true,
                travelMode: 'DRIVING',
                origin: { lat: 0, lng: 0 }, // Replace with your origin location
                destination: { lat: 0, lng: 0 }, // Replace with your destination location
                
                zoom: 14,
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
            t.updateMarkers();
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
                t.directionsService = new window.google.maps.DirectionsService();
                t.directionsDisplay = new window.google.maps.DirectionsRenderer();

                var map = this.$refs.gmap.$mapObject;
                this.directionsDisplay.setMap(map);

                setInterval(() => {
                    if (t.waypoints != t.trip.locations && t.trip.locations) {
                        t.updateMarkers()
                    }
                }, 2000);
            },

            /**
             * Set markers and update 
             * if got new location
             */
            updateMarkers()
            {
                this.center = {lat: parseFloat(this.trip.vehicle.last_latitude), lng: parseFloat(this.trip.vehicle.last_longitude)}
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
                this.waypoints[i].address = await this.handlePositionToPlaceId(this.waypoints[i].destination.lat, this.waypoints[i].destination.lng);
                this.$emit('click-marker', this.waypoints[i], i);
                this.calculateAndDisplayRoute()
            },
            
            
            calculateAndDisplayRoute() {
                var t = this;
                if (window.google && this.waypoints.length && this.showroute) 
                {
                    t.directionPoints = {origin: t.waypoints[0].destination, destination:t.waypoints[1].destination};
                    var {origin, destination} = t.directionPoints;
                    
                    t.directionsService.route(
                        {
                            origin: new window.google.maps.LatLng(origin.lat, origin.lng),
                            destination: this.activeDestination ? this.activeDestination : new window.google.maps.LatLng(destination.lat, destination.lng),
                            travelMode: 'DRIVING'
                        },
                        (response, status) => {
                            if (status === 'OK') {
                                t.directionsDisplay.setDirections(response);
                            } else {
                                console.warn('Directions request failed due to ' + status);
                            }
                        }
                    );
                }
            },

            async handlePositionToPlaceId(lat, lng) 
            {
                try {
                    const place = await this.getPlaceIdFromPosition(lat, lng);
                    console.log('Place ID:', place.formatted_address);
                    return place.formatted_address;
                    // Perform actions with the retrieved placeId
                } catch (error) {
                    console.error(error);
                    // Handle error if geocoding fails
                }
            },

            async getPlaceIdFromPosition(lat, lng) {
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
            },
                
            __(i) {
                return this.$root.$children[0].__(i);
            }
        }
    };
</script>
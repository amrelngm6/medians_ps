<template>
    <div class="w-full  overflow-auto" style="height: 85vh; z-index: 9999;">
        <GmapMap ref="gmap" :center="center" :key="reload" 
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
                :draggable="marker.drag ? true : false" 
                :icon="marker.icon ? marker.icon : null" 
                @click="checkMarker(index)"
                @drag="activeMarkerIndex = index" 
                @dragend="updateMarker" />

        </GmapMap>
        <select :change="calculateAndDisplayRoute" v-model="travelMode">
            <option v-text="mode" :value="mode" v-for="mode in modes"></option>
        </select>
    </div>
</template>
<script>

import { F } from "core-js/modules/_export";
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

                polylineCoordinates: [],
                // waypoints: [],
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
            'waypoints',
            'showroute',
            'center',
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
                t.directionsService = new window.google.maps.DirectionsService();
                t.directionsDisplay = new window.google.maps.DirectionsRenderer();

                var map = this.$refs.gmap.$mapObject;
                this.directionsDisplay.setMap(map);

                setInterval(() => {
                    if (t.waypoints != this.$parent.locations && this.$parent.locations) {
                        t.waypoints = this.$parent.locations;
                        t.calculateAndDisplayRoute();
                    }
                }, 2000);
            },

            calculateDistance(location1, location2) {
                const R = 6371; // Radius of the Earth in kilometers
                const lat1 = location1.lat;
                const lon1 = location1.lng;
                const lat2 = location2.lat;
                const lon2 = location2.lng;

                const dLat = (lat2 - lat1) * (Math.PI / 180);
                const dLon = (lon2 - lon1) * (Math.PI / 180);

                const a =
                    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(lat1 * (Math.PI / 180)) * Math.cos(lat2 * (Math.PI / 180)) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);

                const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                const distance = R * c; // Distance in kilometers

                return distance;
            },

            addPoint(event, status) {
                if (status == 'waiting')
                {
                    this.polylineCoordinates.push(event);
                }
                // Sorting the polylineCoordinates array based on distance from a specific location
                this.polylineCoordinates.sort((a, b) => {
                    const locationData = this.waypoints[0];
                    const distanceA = this.calculateDistance(locationData, a);
                    const distanceB = this.calculateDistance(locationData, b);

                    return distanceA - distanceB;
                });

            },
            setMarker(i) { this.activeMarkerIndex = i; },
            updateDestination(event) {
                this.destination = {
                    lat: event.latLng.lat(),
                    lng: event.latLng.lng(),
                };
            },
            updateOrigin(event) {
                this.origin = {
                    lat: event.latLng.lat(),
                    lng: event.latLng.lng(),
                };
            },
            updateMarker(event) {
                this.waypoints[this.activeMarkerIndex].destination = {
                    lat: event.latLng.lat(), lng: event.latLng.lng()
                };

                this.$emit('update-marker', this.waypoints[this.activeMarkerIndex], event);
            },
            checkMarker(i) {
                this.activeDestination = this.waypoints[i].destination;
                console.log(this.waypoints[i]);
                this.$emit('click-marker', this.waypoints[i], i);
                this.calculateAndDisplayRoute()
            },
            addMarker() {
                this.markers[this.markers.length] = { position: { lat: this.markers[this.markers.length - 1].position.lat + 0.005, lng: this.markers[this.markers.length - 1].position.lat + 0.05 } }
                this.sortWaypointsByDistance();
                this.calculateAndDisplayRoute();
            },

            setMode() {
                this.travelMode;
            },

             calculateAndDisplayRoute() {
                var t = this;
                if (window.google && this.waypoints.length) 
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

            async calculateAndDisplayRoute2() {
                if (window.google) {
                    this.render = false;

                    var directionsService = new window.google.maps.DirectionsService();
                    var directionsRenderer = new window.google.maps.DirectionsRenderer();

                    var map = this.$refs.gmap.$mapObject;

                    directionsRenderer.setMap(map);

                    directionsService.route(
                        {
                            origin: this.origin,
                            destination: this.destination,
                            travelMode: this.travelMode,
                            waypoints: this.waypoints.map((waypoint) => ({
                                location: waypoint,
                            })),
                        },
                        (response, status) => {
                            if (status === 'OK') {
                                directionsRenderer.setDirections(response);
                            } else {
                                console.error('Directions request failed due to ' + status);
                            }
                        }
                    );
                    this.render = true
                }
            },

            sortWaypointsByDistance() {

                const waypointsWithDistances = this.waypoints.map((waypoint) => {
                    const originLatLng = new window.google.maps.LatLng(this.origin);
                    const destinationLatLng = new window.google.maps.LatLng(this.destination);
                    const waypointLatLng = new window.google.maps.LatLng(waypoint.location);

                    const distanceToOrigin = window.google.maps.geometry.spherical.computeDistanceBetween(
                        originLatLng,
                        waypointLatLng
                    );

                    const distanceToDestination = window.google.maps.geometry.spherical.computeDistanceBetween(
                        waypointLatLng,
                        destinationLatLng
                    );

                    return {
                        waypoint,
                        distance: distanceToOrigin + distanceToDestination,
                    };
                });

                // Sort waypoints by total distance
                waypointsWithDistances.sort((a, b) => a.distance - b.distance);

                // Extract the sorted waypoints
                return waypointsWithDistances.map((item) => item.waypoint);

            },


            __(i) {
                return this.$root.$children[0].__(i);
            }
        }
    };
</script>
<template>
    <div class="w-full  overflow-auto" style="height: 85vh; z-index: 9999;">
        <GmapMap ref="gmap" :center="center" :key="reload" :zoom="zoom" style="width: 100%; height: calc(100vh -  100px)">

            <DirectionsRenderer 
                v-if="showroute"
                v-for="(waypoint, index) in waypoints" 
                :origin="waypoint.origin"
                :destination="waypoint.destination" 
                :key="waypoint" 
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

import DirectionsRenderer from "./map_direction.vue";

export default
    {
        components: {
            DirectionsRenderer,
        },
        name: 'Vehicles',
        data() {
            return {
                imageUrl: 'http://192.168.1.99:81/uploads/images/',
                modes: ['DRIVING', 'WALKING'],
                activeMarkerIndex: 0,
                reload: true,
                render: true,
                travelMode: 'DRIVING',
                origin: { lat: 30.093048, lng: 31.152120 }, // Replace with your origin location
                destination: { lat: 30.073048, lng: 31.142120 }, // Replace with your destination location

                zoom: 14,
                center: { lat: 30.058122734715376, lng: 31.219219598388676 },
                markers: [
                    {
                        position: {
                            lat: 30.0581227357153761, lng: 31.21921983886761
                        }
                    },
                    {
                        position: {
                            lat: 30.058122734715376, lng: 31.219219598388676
                        }
                    },
                    {
                        position: {
                            lat: 30.057544505767098, lng: 31.22335947143557
                        }
                    },
                    {
                        position: {
                            lat: 30.062368086177194, lng: 31.221097905273425
                        }
                    },
                    {
                        position: {
                            lat: 30.05930379083195, lng: 31.22166653358458
                        }
                    }
                ],

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
            'showroute',
            'waypoints'
        ],
        mounted() {
            if (this.waypoints && this.waypoints.length)
                this.calculateAndDisplayRoute();

            console.log(this.waypoints)
        },

        methods:
        {
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

                this.$emit('update-marker', this.waypoints[this.activeMarkerIndex], this.activeMarkerIndex);
            },
            checkMarker(i) {
                console.log(this.waypoints[i]);
                this.$emit('click-marker', this.waypoints[i], i);

            },
            addMarker() {
                this.markers[this.markers.length] = { position: { lat: this.markers[this.markers.length - 1].position.lat + 0.005, lng: this.markers[this.markers.length - 1].position.lat + 0.05 } }
                this.sortWaypointsByDistance();
                this.calculateAndDisplayRoute();
            },

            setMode() {
                this.travelMode;
            },
            async calculateAndDisplayRoute() {
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
                    const originLatLng = new google.maps.LatLng(this.origin);
                    const destinationLatLng = new google.maps.LatLng(this.destination);
                    const waypointLatLng = new google.maps.LatLng(waypoint.location);

                    const distanceToOrigin = google.maps.geometry.spherical.computeDistanceBetween(
                        originLatLng,
                        waypointLatLng
                    );

                    const distanceToDestination = google.maps.geometry.spherical.computeDistanceBetween(
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
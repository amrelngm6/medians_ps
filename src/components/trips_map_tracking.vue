<template>
    <div class="w-full overflow-auto">
        
        <main class=" flex-1 overflow-x-hidden overflow-y-auto  w-full">
            <!-- New releases -->
            <div class="px-4 mb-6 py-4 rounded-lg shadow-md bg-white dark:bg-gray-700 flex w-full">
                <h1 class="font-bold text-lg w-full" v-text="translate('Active trips')"></h1>
            </div>
        </main>

        <div v-if="loader" :key="loader" class="bg-white fixed w-full h-full top-0 left-0" style="z-index:99999; opacity: .9;">
            <img class="m-auto w-500px" :src="'/uploads/loader.gif'" />
        </div>
        <div class="w-full relative">
            <div class="card w-full py-10" v-if="!trips || (trips && trips.length < 1)">
                <div class="text-center p-10">
                    <h3 class="text-lg font-bold mb-4" v-text="translate('No active trips found')"></h3>
                    <p class="text-gray-600" v-text="translate('There are currently no active trips to display. Please check back later.')"></p>
                    
                    <div class="text-center py-10 px-5">
                        <img :src="'/uploads/img/start-wizard.png'" alt="" class="mx-auto mw-100 h-200px h-sm-325px">
                    </div>
                </div>
            </div>

            <div class="card w-full py-10" v-if="trips && trips.length > 0">
                <!-- Multi-trips map showing all active trips -->
                <multi_trips_map  
                    :conf="conf"
                    :setting="setting"
                    :trips="trips"
                    :waypoints="allWaypoints"
                    @markerclicked="onMarkerClicked">
                </multi_trips_map>
                
                <!-- Trip details panel -->
                <div v-if="selectedTrip" class="trip-details-panel">
                    <div class="panel-header">
                        <h3 class="panel-title">{{ selectedTrip.route?.route_name || 'Trip Details' }}</h3>
                        <close_icon class="close-btn" @click="selectedTrip = null" />
                    </div>
                    <div class="panel-content">
                        <div class="detail-item">
                            <span class="detail-label">Status:</span>
                            <span class="detail-value" :class="`status-${selectedTrip.status}`">{{ selectedTrip.status }}</span>
                        </div>
                        <div class="detail-item" v-if="selectedTrip.vehicle">
                            <span class="detail-label">Vehicle:</span>
                            <span class="detail-value">{{ selectedTrip.vehicle.plate_number || 'N/A' }}</span>
                        </div>
                        <div class="detail-item" v-if="selectedTrip.driver">
                            <span class="detail-label">Driver:</span>
                            <span class="detail-value">{{ selectedTrip.driver.name || 'N/A' }}</span>
                        </div>
                        <div class="detail-item" v-if="selectedTrip.route">
                            <span class="detail-label">Route:</span>
                            <div class="route-info">
                                <div class="route-point">
                                    <span class="route-icon start">🚩</span>
                                    <span class="route-address">{{ selectedTrip.route.start_address }}</span>
                                </div>
                                <div class="route-arrow">↓</div>
                                <div class="route-point">
                                    <span class="route-icon end">🏁</span>
                                    <span class="route-address">{{ selectedTrip.route.end_address }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="detail-item" v-if="selectedTrip.created_at">
                            <span class="detail-label">Created:</span>
                            <span class="detail-value">{{ formatDate(selectedTrip.created_at) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import dashboard_card_white from '@/components/includes/dashboard_card_white.vue';
import help_icon from '@/components/svgs/help.vue';
import close_icon from '@/components/svgs/Close.vue';
import multi_trips_map from '@/components/maps/multi_trips_map.vue';

import {defineAsyncComponent, ref} from 'vue';
import {translate, handleGetRequest, handleRequest, deleteByKey, showAlert} from '@/utils.vue';

export default
    {
        components: {
            dashboard_card_white,
            help_icon,
            multi_trips_map,
            close_icon,
            translate
            
        },
        emits: ['close'],
        setup(props, {emit}) {
    
            const url =  props.conf.url+props.path+'?load=json';

            const selectedTrip = ref(null);
            const trips = ref([]);
            const allWaypoints = ref({});
            const loader = ref(false);

            const load = () => {
                loader.value = true;
                handleGetRequest(url).then(response => {
                    trips.value = response.items;
                    processWaypoints();
                    loader.value = false;
                    console.log('Loaded trips:', trips.value);
                }).catch(error => {
                    console.error('Error loading trips:', error);
                    loader.value = false;
                });
            }

            const processWaypoints = () => {
                allWaypoints.value = {};
                trips.value.forEach(trip => {
                    if (trip.pickup_locations || trip.destinations) {
                        allWaypoints.value[trip.id] = [];
                        
                        // Add pickup locations
                        if (trip.pickup_locations) {
                            trip.pickup_locations.forEach(pickup => {
                                allWaypoints.value[trip.id].push({
                                    location: {
                                        start_latitude: pickup.latitude,
                                        start_longitude: pickup.longitude,
                                        end_latitude: pickup.latitude,
                                        end_longitude: pickup.longitude
                                    },
                                    status: pickup.status || 'waiting',
                                    model: pickup
                                });
                            });
                        }
                        
                        // Add destinations
                        if (trip.destinations) {
                            trip.destinations.forEach(destination => {
                                allWaypoints.value[trip.id].push({
                                    location: {
                                        start_latitude: destination.latitude,
                                        start_longitude: destination.longitude,
                                        end_latitude: destination.latitude,
                                        end_longitude: destination.longitude
                                    },
                                    status: destination.status || 'waiting',
                                    model: destination
                                });
                            });
                        }
                    }
                });
            };

            const onMarkerClicked = (marker) => {
                selectedTrip.value = marker;
            };

            const formatDate = (dateString) => {
                if (!dateString) return 'N/A';
                return new Date(dateString).toLocaleDateString() + ' ' + new Date(dateString).toLocaleTimeString();
            };

            // Auto-refresh trips every 30 seconds for live tracking
            const startLiveTracking = () => {
                setInterval(() => {
                    load();
                }, 30000); // Refresh every 30 seconds
            };
            
            load();
            startLiveTracking();

            const close = () => {
                emit('close')
            }

            return {
                url,
                selectedTrip,
                trips,
                allWaypoints,
                loader,
                load,
                onMarkerClicked,
                formatDate,
                close,
                translate
            }
        },

        props: [
            'path',
            'lang',
            'setting',
            'conf',
            'auth',
        ],
        
    };
</script>

<style scoped>
.trip-details-panel {
    position: absolute;
    top: 16px;
    right: 16px;
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    z-index: 20;
    min-width: 300px;
    max-width: 400px;
    border: 1px solid #e5e7eb;
}

.panel-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f3f4f6;
}

.panel-title {
    font-weight: bold;
    font-size: 18px;
    color: #1f2937;
    margin: 0;
}

.close-btn {
    cursor: pointer;
    padding: 4px;
    border-radius: 4px;
    transition: background-color 0.2s;
}

.close-btn:hover {
    background-color: #f3f4f6;
}

.panel-content {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.detail-label {
    font-weight: 600;
    font-size: 12px;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.detail-value {
    font-size: 14px;
    color: #374151;
    font-weight: 500;
}

.detail-value.status-active,
.detail-value.status-started {
    color: #059669;
    background-color: #d1fae5;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 12px;
    text-transform: uppercase;
    font-weight: 600;
    align-self: flex-start;
}

.detail-value.status-pending,
.detail-value.status-waiting {
    color: #d97706;
    background-color: #fef3c7;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 12px;
    text-transform: uppercase;
    font-weight: 600;
    align-self: flex-start;
}

.detail-value.status-completed {
    color: #2563eb;
    background-color: #dbeafe;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 12px;
    text-transform: uppercase;
    font-weight: 600;
    align-self: flex-start;
}

.detail-value.status-cancelled {
    color: #dc2626;
    background-color: #fee2e2;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 12px;
    text-transform: uppercase;
    font-weight: 600;
    align-self: flex-start;
}

.route-info {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-top: 4px;
}

.route-point {
    display: flex;
    align-items: center;
    gap: 8px;
}

.route-icon {
    font-size: 16px;
    width: 20px;
    text-align: center;
}

.route-address {
    font-size: 13px;
    color: #4b5563;
    line-height: 1.4;
}

.route-arrow {
    font-size: 16px;
    color: #9ca3af;
    text-align: center;
    margin: 4px 0;
}

/* Responsive design */
@media (max-width: 768px) {
    .trip-details-panel {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
        max-width: 350px;
        right: auto;
    }
}
</style>
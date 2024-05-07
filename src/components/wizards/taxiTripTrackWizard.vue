<template>
    <div class="w-full ">

        <div v-if="loader" :key="loader" class="bg-white fixed w-full h-full top-0 left-0"
            style="z-index:99999; opacity: .9;">
            <img class="m-auto w-500px" :src="'/uploads/loader.gif'" />
        </div>
        <div class="w-full flex overflow-auto">
            <div class=" w-full relative">
                <close_icon class="absolute top-4 right-4 z-10 cursor-pointer" @click="back" />
                <div class=" card w-full py-10">
                    <div class="w-full stepper stepper-links ">
                        <div class="w-full">
                            <div class="">
                                <div class="card-body pt-0 mx-auto ">
                                    <div class="w-full flex gap-10">
                                        <div class="w-full">
                                            <taxt_trip_map @markerclicked="markerClicked" class="w-full rounded-xl shadow-md mx-4"
                                                :system_setting="system_setting" :conf="conf" :trip="activeItem" />
                                        </div>
                                        <div class="w-full">
                                            <hr class="block mt-6 my-2 opacity-10" />
                                            <div class="bg-gray-200 shadow-md mb-10 rounded-xl">
                                                <div class="card-header border-0 pt-9">
                                                    <div class="card-title m-0 flex  gap-4" v-if="activeItem.model">
                                                        <div class="symbol symbol-50px w-50px bg-light">
                                                            <img :src="activeItem.model.picture" alt="image"
                                                                class="p-3">
                                                        </div>
                                                        <div class="w-full ">
                                                            <div class="font-semibold" v-text="activeItem.model.name">
                                                            </div>
                                                            <div class="" v-text="activeItem.model.mobile"></div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>

                                                <div class="card-body p-9" v-if="activeItem">
                                                    <div class="timeline timeline-border-dashed">

                                                        <div class="timeline-item">
                                                            <div class="timeline-line"></div>
                                                            <div class="timeline-icon me-4"><vue-feather type="circle"
                                                                    class="fs-2 text-success"></vue-feather></div>

                                                            <div class="timeline-content mb-10 mt-n2">
                                                                <div class="overflow-auto pe-3">
                                                                    <div class="fs-5 fw-semibold mb-2" v-if="activeItem"
                                                                        v-text="activeItem.pickup_address"></div>

                                                                    <div class="d-flex align-items-center mt-1 fs-6">
                                                                        <div class="text-muted me-2 fs-7"
                                                                            v-text="translate('Pickup')"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="timeline-item">
                                                            <div class="timeline-line"></div>
                                                            <div class="timeline-icon me-4"><vue-feather type="map-pin"
                                                                    class="fs-2 text-danger"></vue-feather></div>

                                                            <div class="timeline-content mb-10 mt-n2">
                                                                <div class="overflow-auto pe-3">
                                                                    <div class="fs-5 fw-semibold mb-2" v-if="activeItem"
                                                                        v-text="activeItem.destination_address"></div>

                                                                    <div class="d-flex align-items-center mt-1 fs-6">
                                                                        <div class="text-muted me-2 fs-7"
                                                                            v-text="translate('Destination')"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="h-4px w-100 bg-light mb-5">
                                                        <div class="rounded h-4px transition transition-all"
                                                            role="progressbar"
                                                            :class="progressWidth() < 100 ? 'bg-info' : 'bg-success'"
                                                            :style="{ width: progressWidth() + '%' }"></div>
                                                    </div>

                                                    <div class="w-full flex gap-4" v-if="activeItem">

                                                        <div class="flex gap-4 w-full  " v-if="activeItem.driver">
                                                            <img :src="activeItem.driver.picture"
                                                                class="rounded-full bg-white border-1 border border-gray-600 p-1 w-12 h-12" />
                                                            <div class="block gap-4 w-full">
                                                                <span class="w-full block font-semibold"
                                                                    v-text="translate('Driver')"></span>
                                                                <span class="w-full block"
                                                                    v-text="activeItem.driver.name"></span>
                                                            </div>
                                                        </div>

                                                        <div class="w-full flex gap-4" v-if="activeItem.vehicle">
                                                            <car_icon />
                                                            <div class="block gap-4">
                                                                <span class="w-full block font-semibold"
                                                                    v-text="translate('Vehicle')"></span>
                                                                <span class="w-full block"
                                                                    v-text="activeItem.vehicle.plate_number"></span>
                                                            </div>
                                                        </div>

                                                        <div class="w-full flex-end" v-if="activeItem.date">
                                                            <span class="w-full block font-semibold"
                                                                v-text="translate('Trip date')"></span>
                                                            <div class="w-full flex gap-4">
                                                                <span class=" " v-text="activeItem.date"></span>
                                                                <span class=" " v-text="activeItem.start_time"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex gap-6 pb-4 font-semibold text-lg">

                                                <div class="flex gap-6 w-full">
                                                    <div v-text="translate('Subtotal')"></div>
                                                    <div v-text="currency.symbol + '' + activeItem.subtotal"></div>
                                                </div>

                                                <div class="flex gap-6 w-full">
                                                    <div v-text="translate('Discount')"></div>
                                                    <div v-text="currency.symbol + '' + activeItem.discount_amount"></div>
                                                </div>

                                                <div class="flex gap-6 w-full">
                                                    <div v-text="translate('Total cost')"></div>
                                                    <div v-text="currency.symbol + '' + activeItem.total_cost"></div>
                                                </div>

                                            </div>

                                            <div
                                                class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-12 p-6 gap-4">
                                                <i class="vue-feather vue-feather--alert-octagon ki-duotone ki-information fs-2tx text-warning me-4"
                                                    data-name="alert-octagon" data-tags="warning,alert,danger"
                                                    data-type="alert-octagon"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-alert-octagon vue-feather__content">
                                                        <polygon
                                                            points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                                                        </polygon>
                                                        <line x1="12" y1="8" x2="12" y2="12"></line>
                                                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                                    </svg></i>
                                                <div class="d-flex flex-stack flex-grow-1">
                                                    <div class="fw-semibold">
                                                        <h4 class="text-gray-900 fw-bold"
                                                            v-text="translate(activeItem.payment_status)"></h4>
                                                        <div class="fs-6 text-gray-700">
                                                            <div v-text="translate('Payment status')"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="text-center mt-10"><a href="javascript:;"
                                            class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                            @click="back" v-text="translate('Back')"></a></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>


import close_icon from '@/components/svgs/Close.vue';
import delete_icon from '@/components/svgs/trash.vue';
import route_icon from '@/components/svgs/route.vue';
import car_icon from '@/components/svgs/car.vue';

import 'vue3-easy-data-table/dist/style.css';
import Vue3EasyDataTable from 'vue3-easy-data-table';

import { defineAsyncComponent, getCurrentInstance, ref } from 'vue';
import { translate, getProgressWidth, handleRequest, deleteByKey, showAlert, handleAccess, getPositionAddress, findPlaces, getPlaceDetails, today } from '@/utils.vue';


const form_field = defineAsyncComponent(() =>
    import('@/components/includes/form_field.vue')
);
import editable_map_location from '@/components/includes/editable_map_location.vue';
import drivers_locations_map from '@/components/includes/drivers_locations_map.vue';
import tooltip from '@/components/includes/tooltip.vue';
import taxt_trip_map from '@/components/maps/taxi_trip_map.vue';

export default
    {
        components: {
            taxt_trip_map,
            close_icon,
            delete_icon,
            car_icon,
            form_field,
            editable_map_location,
            drivers_locations_map,
            tooltip,
        },
        name: 'Taxi trips',
        emits: ['callback'],
        setup(props, { emit }) {

            const loader = ref(false);
            const showAddSide = ref(false);
            const showEditSide = ref(false);
            const showProfilePage = ref(null);
            const activeItem = ref({});
            const activeTab = ref(props.usertype);
            const content = ref({});
            const center = ref({});
            const locations = ref([]);
            const showList = ref(true);
            const searchText = ref('');
            const locationError = ref(null);
            const collapsed = ref(false);
            const fillable = ref([props.usertype, 'Pickup location', 'Destination', 'Driver', 'Time', 'Cost', 'Confirm']);
            const places = ref([]);
            const showPlaceSearch = ref(false);
            const pickup_placeSearch = ref('');
            const destination_placeSearch = ref('');
            const tripsStatusList = ref([
                { title: translate("Scheduled"), status: 'scheduled' },
                { title: translate("Started"), status: 'started' },
                { title: translate("Completed"), status: 'completed' },
                { title: translate("Cancelled"), status: 'cancelled' },
            ]);

            console.log(props.item)

            if (props.item) {
                activeItem.value = props.item
                activeItem.value.date = props.item.date ?? today()
            } else {
                activeItem.value.date = today()
            }

            const users = (props.userslist) ? ref(props.userslist) : ref([]);

            /**
             * Get current location
             */
            const getUserLocation = async () => {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition
                        (
                            position => {
                                if (!activeItem.value.trip_id) {
                                    activeItem.value.pickup_latitude = position.coords.latitude;
                                    activeItem.value.pickup_longitude = position.coords.longitude;
                                    activeItem.value.destination_latitude = position.coords.latitude;
                                    activeItem.value.destination_longitude = position.coords.longitude;
                                }
                            },
                            error => {

                                if (!activeItem.value.trip_id) {
                                    activeItem.value.pickup_latitude = activeItem.value.pickup_latitude ?? 30.06;
                                    activeItem.value.pickup_longitude = activeItem.value.pickup_longitude ?? 31.21;
                                    activeItem.value.destination_latitude = activeItem.value.destination_latitude ?? 30.06;
                                    activeItem.value.destination_longitude = activeItem.value.destination_longitude ?? 31.21;
                                }
                                showAlert(error.message)
                            }
                        );

                } else {
                    showAlert('location error')
                    locationError.value = "Geolocation is not supported by this browser.";
                }
            }

            getUserLocation();

            const pickupPlaceChanged = async () => {
                let result = pickup_placeSearch.value.length > 3 ? await findPlaces(props.system_setting.google_map_api, pickup_placeSearch.value, props.business_setting.country) : ''
                places.value = result.predictions;
            }

            const destinationPlaceChanged = async () => {
                let result = destination_placeSearch.value.length > 3 ? await findPlaces(props.system_setting.google_map_api, destination_placeSearch.value, props.business_setting.country) : ''
                places.value = result.predictions;
            }

            const saveTrip = () => {
                loader.value = true;
                var params = new URLSearchParams();
                let array = JSON.parse(JSON.stringify(activeItem.value));
                let keys = Object.keys(array)
                let k, d, value = '';
                for (let i = 0; i < keys.length; i++) {
                    k = keys[i]
                    d = typeof array[k] === 'object' ? JSON.stringify(array[k]) : array[k]
                    params.append('params[' + k + ']', d)
                }
                let type = array.trip_id > 0 ? 'update' : 'create';
                params.append('type', 'TaxiTrip.' + type)


                const currentInstance = getCurrentInstance();

                if (currentInstance)
                    currentInstance.root.data.loader = true;

                handleRequest(params, '/api/' + type).then(response => {
                    handleAccess(response)
                    loader.value = false;
                })
            }

            const updatePickupMarker = async (position) => {
                activeItem.value.pickup_latitude = position.lat();
                activeItem.value.pickup_longitude = position.lng();
                activeItem.value.pickup_address = await getPositionAddress(position.lat(), position.lng())
            }

            const updateDestinationMarker = async (position) => {
                activeItem.value.destination_latitude = position.lat();
                activeItem.value.destination_longitude = position.lng();
                activeItem.value.destination_address = await getPositionAddress(position.lat(), position.lng())
            }


            const setPlaceMarker = async (placeInfo, type) => {
                const placesService = new google.maps.places.PlacesService(document.createElement('div'));

                let placeId = placeInfo.place_id;

                placesService.getDetails({ placeId }, (place, status) => {
                    if (status === google.maps.places.PlacesServiceStatus.OK && place) {
                        const location = place.geometry.location;


                        if (type == 'pickup') {
                            activeItem.value.pickup_address = placeInfo.description
                            activeItem.value.pickup_latitude = location.lat()
                            activeItem.value.pickup_longitude = location.lng()
                        }

                        if (type == 'destination') {
                            activeItem.value.destination_address = placeInfo.description
                            activeItem.value.destination_latitude = location.lat()
                            activeItem.value.destination_longitude = location.lng()
                        }
                        places.value = []
                        showPlaceSearch.value = false
                    } else {
                        console.error('Failed to fetch place details');
                    }
                });
            }

            const back = () => {
                emit('callback');
            }

            const progressWidth = () => {
                let requiredData = ['model_id', 'driver_id', 'pickup_address', 'destination_address', 'status'];

                return getProgressWidth(requiredData, activeItem);
            }

            const setUser = (user) => {
                activeItem.value.model_id = props.usertype == 'student' ? user.student_id : user.customer_id;
                activeItem.value.model = user;
                activeTab.value = 'Pickup location';
                searchText.value = null;
            }

            const setDriver = (driver) => {
                activeItem.value.driver_id = driver.driver_id;
                activeItem.value.driver = driver;
                setVehicle(driver.vehicle);
            }

            const setVehicle = (vehicle) => {
                activeItem.value.vehicle_id = vehicle.vehicle_id;
                activeItem.value.vehicle = vehicle;
                searchText.value = null;
            }

            const findUser = () => {
                if (props.userslist) {
                    for (let i = 0; i < props.userslist.length; i++) {
                        props.userslist[i].show = searchText.value.trim() ? checkSimilarUser(props.userslist[i]) : 1;
                    }
                }
            }

            const checkSimilarUser = (item) => {
                let name = (item.name).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
                let email = name ? name : (item.email).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
                return email ? email : (item.mobile).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
            }


            const selectedObject = (array, key) => {
                const keyValue = activeItem.value[key];
                for (let i = 0; i < array.length; i++) {
                    if (array[i][key] == keyValue) {
                        return array[i]
                    }
                }
                return {}
            }


            return {
                loader,
                tripsStatusList,
                selectedObject,
                setDriver,
                setVehicle,
                users,
                progressWidth,
                setUser,
                findUser,
                setPlaceMarker,
                showPlaceSearch,
                pickupPlaceChanged,
                destinationPlaceChanged,
                pickup_placeSearch,
                destination_placeSearch,
                places,
                showAddSide,
                showEditSide,
                content,
                fillable,
                center,
                activeItem,
                activeTab,
                translate,
                updatePickupMarker,
                updateDestinationMarker,
                searchText,
                getUserLocation,
                collapsed,
                saveTrip,
                back
            };
        },

        props: [
            'conf',
            'path',
            'system_setting',
            'business_setting',
            'setting',
            'item',
            'userslist',
            'usertype',
            'drivers',
            'vehicles',
            'currency'
        ],

    };
</script>
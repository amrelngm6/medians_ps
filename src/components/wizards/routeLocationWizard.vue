<template>
    <div class="w-full flex overflow-auto">
        <div class=" w-full relative">
            <close_icon class="absolute top-4 right-4 z-10 cursor-pointer" @click="back" />
            <div class=" card w-full py-10">
                <div class="w-full stepper stepper-links ">
                    <div class="stepper-nav justify-content-center py-2 mb-10">
                        <div class="stepper-item " v-for="row in fillable" @click="activeTab = row">
                            <h3 :class="activeTab == row ? 'text-danger border-danger' : 'text-gray-400 border-transparent'"
                                class="cursor-pointer pb-3 px-2 stepper-title text-md border-b " v-text="translate(row)"></h3>
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="" v-if="activeTab == usertype" :key="activeTab">
                            <div class="card-body pt-0 mx-auto max-w-xl" :key="users">
                                <div class="text-center mb-13">
                                    <h1 class="mb-3" v-text="translate('Find')+' '+translate(usertype)"></h1>

                                    <div class="text-gray-400 font-semibold "
                                        v-text="translate('Search by name or mobile')"></div>
                                </div>
                                <div class="w-100 relative mb-5" autocomplete="off">

                                    <vue-feather type="user"
                                        class="text-gray-500 position-absolute top-50 ms-5 translate-middle-y"></vue-feather>

                                    <input type="text" @type="findUser" @input="findUser" v-model="searchText"
                                        class="form-control form-control-lg form-control-solid px-15"
                                        :placeholder="translate('Search by name or mobile')">
                                </div>
                                <div class="w-full " v-for="usermodel in userslist" v-if="searchText">
                                    <a href="javascript:;" :key="usermodel.show" v-if="usermodel.show"
                                        class="d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1">
                                        <div class="symbol symbol-35px symbol-circle me-5"><img alt="Pic"
                                                :src="usermodel.picture"></div>
                                        <div class="fw-semibold w-full">
                                            <span class="text-lg text-danger font-semibold me-2"
                                                v-text="usermodel.name"></span>
                                            <span class="block text-gray-500 text-sm"
                                                v-text="usermodel.mobile"></span>
                                        </div>
                                        <span @click="setUser(usermodel)" class="btn btn-danger btn-sm text-white"
                                            v-text="translate('Choose')"></span>
                                    </a>
                                </div>
                                <a href="javascript:;" :key="activeItem.model" v-if="activeItem.model"
                                    class="d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1">
                                    <div class="symbol symbol-35px symbol-circle me-5"><img alt="Pic"
                                            :src="activeItem.model.picture"></div>
                                    <div class="fw-semibold w-full">
                                        <span class="text-lg text-danger font-semibold me-2"
                                            v-text="activeItem.model.name"></span>
                                        <span class="block text-gray-500 text-sm"
                                            v-text="activeItem.model.mobile"></span>
                                    </div>
                                </a>
                            </div>
                            <p class="text-center"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                    @click="activeTab = 'Pickup location'" v-text="translate('Pickup location')"></a></p>
                        </div>
                        <div class="" v-if="activeTab == 'Pickup location'" :key="activeTab">
                            <div class="card-body pt-0">
                                <div class="settings-form">
                                    <div class="px-10 mb-6 mx-auto row">
                                        <div class="lg:flex w-full ">
                                            <div class="mt-10 w-full">
                                                <h3 class="mb-3" v-text="translate('Location Address')"></h3>

                                                <div class="fw-semibold text-gray-600 fs-6">
                                                    <span class="d-block fw-bold pb-3 text-gray-400"
                                                        :key="activeItem.start_address"
                                                        v-text="activeItem.start_address"></span>
                                                    <a class="fw-bold" @click="showPlaceSearch = true" href="javascript:;"
                                                        v-text="translate('Change')"></a>
                                                </div>
                                                <div v-if="showPlaceSearch" :key="showPlaceSearch">
                                                    <input autocomplete="off" @change="startPlaceChanged"
                                                        v-model="start_placeSearch" type="text"
                                                        class="form-control form-control-solid"
                                                        :placeholder="translate('Find Location')">

                                                    <div class="mt-3 w-full card-body" v-if="places" :key="places">
                                                        <div class="w-full" v-for="place in places">
                                                            <div class="d-flex align-items-center mb-8" v-if="place">
                                                                <span
                                                                    class="bullet bullet-vertical h-40px bg-success"></span>
                                                                <div class="form-check form-check-custom form-check-solid mx-5 cursor-pointer"
                                                                    @click="setPlaceMarker(place, 'start')">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="">
                                                                </div>
                                                                <div class="flex-grow-1 cursor-pointer"
                                                                    @click="setPlaceMarker(place, 'start')">
                                                                    <a href="#"
                                                                        class="text-gray-800 text-hover-primary fw-bold fs-6"
                                                                        v-if="place.structured_formatting"
                                                                        v-text="place.structured_formatting.main_text"></a>
                                                                    <span class="text-muted fw-semibold d-block"
                                                                        v-text="place.description"></span>
                                                                </div>
                                                                <span class="badge badge-light-success fs-8 fw-bold"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" w-full">
                                                <editable_map_location :system_setting="system_setting" :item="activeItem"
                                                    @setlocation="updateStartMarker" :key="activeItem.start_latitude"
                                                    :location="{ lat: activeItem.start_latitude, lng: activeItem.start_longitude }">
                                                </editable_map_location>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center"><a href="javascript:;"
                                class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                @click="activeTab = 'Destination'" v-text="translate('Destination')"></a></p>
                        </div>
                        <div class="" v-if="activeTab == 'Destination'" :key="activeTab">
                            <div class="card-body pt-0">
                                <div class="px-10 mb-6 mx-auto row">
                                    <div class="lg:flex w-full">
                                        <div class="mt-10 w-full">
                                            <h3 class="mb-3" v-text="translate('Location Address')"></h3>

                                            <div class="fw-semibold text-gray-600 fs-6">
                                                <span class="d-block fw-bold pb-3 text-gray-400"
                                                    :key="activeItem.end_address" v-text="activeItem.end_address"></span>
                                                <a class="fw-bold" @click="showPlaceSearch = true" href="javascript:;"
                                                    v-text="translate('Change')"></a>
                                            </div>
                                            <div v-if="showPlaceSearch" :key="showPlaceSearch">
                                                <input autocomplete="off" @change="endPlaceChanged"
                                                    v-model="end_placeSearch" type="text"
                                                    class="form-control form-control-solid"
                                                    :placeholder="translate('Find Location')">

                                                <div class="mt-3 w-full card-body" v-if="places && end_placeSearch.length"
                                                    :key="places">
                                                    <div class="w-full" v-for="place in places">
                                                        <div class="d-flex align-items-center mb-8" v-if="place">
                                                            <span class="bullet bullet-vertical h-40px bg-success"></span>
                                                            <div class="form-check form-check-custom form-check-solid mx-5 cursor-pointer"
                                                                @click="setPlaceMarker(place, 'end')">
                                                                <input class="form-check-input" type="checkbox" value="">
                                                            </div>
                                                            <div class="flex-grow-1 cursor-pointer"
                                                                @click="setPlaceMarker(place, 'end')">
                                                                <a href="#"
                                                                    class="text-gray-800 text-hover-primary fw-bold fs-6"
                                                                    v-if="place.structured_formatting"
                                                                    v-text="place.structured_formatting.main_text"></a>
                                                                <span class="text-muted fw-semibold d-block"
                                                                    v-text="place.description"></span>
                                                            </div>
                                                            <span class="badge badge-light-success fs-8 fw-bold"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" w-full">
                                            <editable_map_location :system_setting="system_setting" :item="activeItem"
                                                @setlocation="updateEndMarker" :key="activeItem.end_latitude"
                                                :location="{ lat: activeItem.end_latitude, lng: activeItem.end_longitude }">
                                            </editable_map_location>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                    @click="activeTab = 'Pickup days'" v-text="translate('Pickup days')"></a></p>
                        </div>

                        <div class="" v-if="activeTab == 'Pickup days'" :key="activeTab">
                            <div class="card-body pt-0">
                                <div class="settings-form">
                                    <div class="max-w-xl mb-6 mx-auto row">

                                        <div class="w-full flex">
                                            <label class="w-full col-form-label  fw-semibold fs-6"
                                                v-text="translate('Saturday')"></label>
                                            <form_field class="w-full" :item="activeItem"
                                                :column="{ key: 'saturday', title: translate('Saturday'), column_type: 'checkbox' }">
                                            </form_field>
                                        </div>
                                        <hr class="block mt-6 my-2 opacity-10" />

                                        <div class="w-full flex">
                                            <label class="w-full col-form-label  fw-semibold fs-6"
                                                v-text="translate('Sunday')"></label>
                                            <form_field class="w-full" :item="activeItem"
                                                :column="{ key: 'sunday', title: translate('Sunday'), column_type: 'checkbox' }">
                                            </form_field>
                                        </div>
                                        <hr class="block mt-6 my-2 opacity-10" />

                                        <div class="w-full flex">
                                            <label class="w-full col-form-label  fw-semibold fs-6"
                                                v-text="translate('Monday')"></label>
                                            <form_field class="w-full" :item="activeItem"
                                                :column="{ key: 'monday', title: translate('Monday'), column_type: 'checkbox' }">
                                            </form_field>
                                        </div>
                                        <hr class="block mt-6 my-2 opacity-10" />

                                        <div class="w-full flex">
                                            <label class="w-full col-form-label  fw-semibold fs-6"
                                                v-text="translate('Tuesday')"></label>
                                            <form_field class="w-full" :item="activeItem"
                                                :column="{ key: 'tuesday', title: translate('Tuesday'), column_type: 'checkbox' }">
                                            </form_field>
                                        </div>
                                        <hr class="block mt-6 my-2 opacity-10" />

                                        <div class="w-full flex">
                                            <label class="w-full col-form-label  fw-semibold fs-6"
                                                v-text="translate('Wednesday')"></label>
                                            <form_field class="w-full" :item="activeItem"
                                                :column="{ key: 'wednesday', title: translate('Wednesday'), column_type: 'checkbox' }">
                                            </form_field>
                                        </div>
                                        <hr class="block mt-6 my-2 opacity-10" />

                                        <div class="w-full flex">
                                            <label class="w-full col-form-label  fw-semibold fs-6"
                                                v-text="translate('Thursday')"></label>
                                            <form_field class="w-full" :item="activeItem"
                                                :column="{ key: 'thursday', title: translate('Thursday'), column_type: 'checkbox' }">
                                            </form_field>
                                        </div>
                                        <hr class="block mt-6 my-2 opacity-10" />

                                        <div class="w-full flex">
                                            <label class="w-full col-form-label  fw-semibold fs-6"
                                                v-text="translate('Friday')"></label>
                                            <form_field class="w-full" :item="activeItem"
                                                :column="{ key: 'friday', title: translate('Friday'), column_type: 'checkbox' }">
                                            </form_field>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <p class="text-center"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                    @click="activeTab = 'Route'" v-text="translate('Set Route')"></a></p>
                        </div>

                        <div class="" v-if="activeTab == 'Route'" :key="activeTab">
                            <div class="card-body pt-0">
                                <div class="settings-form">
                                    <div class="max-w-xl mb-6 mx-auto row">
                                        <div class="card-body pt-0 mx-auto max-w-xl" :key="routes">

                                            <div class="text-center mb-13">
                                                <h1 class="mb-3" v-text="translate('Find Route')"></h1>

                                                <div class="text-gray-400 font-semibold "
                                                    v-text="translate('Search by name')"></div>
                                            </div>
                                            <div class="w-100 relative mb-5" autocomplete="off">

                                                <vue-feather type="search"
                                                    class="text-gray-500 position-absolute top-50 ms-5 translate-middle-y"></vue-feather>

                                                <input type="text" @change="findRoute" @input="findRoute" v-model="searchText"
                                                    class="form-control form-control-lg form-control-solid px-15"
                                                    :placeholder="translate('Search by name')">
                                            </div>
                                            <div class="w-full " v-for="route in routes" v-if="searchText">
                                                <a href="javascript:;" :key="route.show" v-if="route && route.show"
                                                    class="d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1">
                                                    
                                                    <div class="fw-semibold w-full">
                                                        <span class="text-lg text-danger font-semibold me-2"
                                                            v-text="route.route_name"></span>
                                                        <span class="block text-gray-500 text-sm"
                                                            v-text="route.description"></span>
                                                    </div>
                                                    <span @click="setRoute(route)" class="btn btn-danger btn-sm text-white"
                                                        v-text="translate('Choose')"></span>
                                                </a>
                                            </div>

                                            <a href="javascript:;" :key="activeItem.route" v-if="activeItem.route"
                                                class="d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1 gap-4">
                                                <vue-feather type="map-pin" class="w-3"></vue-feather>
                                                <div class="fw-semibold w-full">
                                                    <span class="text-lg text-danger font-semibold me-2"
                                                        v-text="activeItem.route.route_name"></span>
                                                    <span class="block text-gray-500 text-sm truncate"
                                                        v-text="activeItem.route.description"></span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                    @click="activeTab = 'Confirm'" v-text="translate('Confirm')"></a></p>
                        </div>

                        <div class="max-w-xl mx-auto" v-if="activeTab == 'Confirm'" :key="activeTab">
                            
                            <hr class="block mt-6 my-2 opacity-10" />
                            <div class="bg-gray-200 shadow-md mb-10 rounded-xl">
                                <div class="card-header border-0 pt-9">
                                    <div class="card-title m-0 flex  gap-4" v-if="activeItem && activeItem.model">
                                        <div class="symbol symbol-50px w-50px bg-light">
                                            <img :src="activeItem.model.picture" alt="image" class="p-3">
                                        </div>
                                        <span class="" v-text="activeItem.model.name"></span>
                                    </div>
                                    <label class=" flex gap-2 cursor-pointer">
                                        <form_field class="flex-end" :item="activeItem"
                                            :column="{ key: 'status', title: translate('Status'), column_type: 'checkbox', hide_text:true }">
                                        </form_field>
                                        <div class="pt-3">
                                            <span class="badge badge-light fw-bold me-auto px-4 py-3" v-text="!activeItem.status ? 'Pending' : 'Active'"></span>
                                        </div>
                                    </label>
                                </div>
                                

                                <div class="card-body p-9" v-if="activeItem.route">
                                    <div class="fs-3 fw-bold text-gray-900" v-text="activeItem.route.route_name"></div>
                                    <p class="text-gray-500 fw-semibold fs-5 mt-1 mb-7" v-text="activeItem.route.description"></p>
                                    <div class="timeline timeline-border-dashed">
                                        
                                        <div class="timeline-item">
                                            <div class="timeline-line"></div>
                                            <div class="timeline-icon me-4"><vue-feather type="circle" class="fs-2 text-success"></vue-feather></div>

                                            <div class="timeline-content mb-10 mt-n2">
                                                <div class="overflow-auto pe-3">
                                                    <div class="fs-5 fw-semibold mb-2" v-text="activeItem.start_address"></div>

                                                    <div class="d-flex align-items-center mt-1 fs-6">
                                                        <div class="text-muted me-2 fs-7" v-text="translate('Pickup')"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="timeline-item">
                                            <div class="timeline-line"></div>
                                            <div class="timeline-icon me-4"><vue-feather type="map-pin" class="fs-2 text-danger"></vue-feather></div>

                                            <div class="timeline-content mb-10 mt-n2">
                                                <div class="overflow-auto pe-3">
                                                    <div class="fs-5 fw-semibold mb-2" v-text="activeItem.end_address"></div>

                                                    <div class="d-flex align-items-center mt-1 fs-6">
                                                        <div class="text-muted me-2 fs-7" v-text="translate('Destination')"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="h-4px w-100 bg-light mb-5" >
                                        <div class="rounded h-4px" role="progressbar" :class="progressWidth() < 100 ? 'bg-info' : 'bg-success'" :style="{width: progressWidth()+'%'}"></div>
                                    </div>
                                    <div class="w-full flex gap-4">
                                        <span class="font-semibold pt-2" v-text="translate('Pickup days')"></span>
                                        <div class="symbol-group symbol-hover">
                                            <div v-for="(day, i) in weekDays">
                                                <div @mouseover="showTip[i] = true" @mouseleave="showTip[i] = false" v-if="activeItem[day.k]" :style="{'margin-left':'-7px'}" class="symbol symbol-35px symbol-circle" ><span :class="day.class" class="symbol-label  text-inverse-warning fw-bold" v-text="day.s"></span><tooltip v-if="showTip[i]" :key="showTip[i]" :title="day.k" ></tooltip></div>
                                            </div> 
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <p class="text-center"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                    @click="saveRoute" v-text="translate('Submit')"></a></p>
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

import { defineAsyncComponent, ref } from 'vue';
import { translate, getProgressWidth, handleRequest, deleteByKey, showAlert, handleAccess, getPositionAddress, findPlaces, getPlaceDetails } from '@/utils.vue';

const maps = defineAsyncComponent(() =>
    import('@/components/includes/map.vue')
);
const SideFormCreate = defineAsyncComponent(() =>
    import('@/components/includes/side-form-create.vue')
);

const SideFormUpdate = defineAsyncComponent(() =>
    import('@/components/includes/side-form-update.vue')
);

const form_field = defineAsyncComponent(() =>
    import('@/components/includes/form_field.vue')
);
import editable_map_location from '@/components/includes/editable_map_location.vue';
import tooltip from '@/components/includes/tooltip.vue';

export default
    {
        components: {
            'datatabble': Vue3EasyDataTable,
            SideFormCreate,
            SideFormUpdate,
            maps,
            close_icon,
            delete_icon,
            car_icon,
            route_icon,
            form_field,
            editable_map_location,
            tooltip,
        },
        name: 'Routes',
        emits: ['callback'],
        setup(props, { emit }) {

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
            const fillable = ref([props.usertype, 'Pickup location', 'Destination', 'Pickup days', 'Route', 'Confirm']);
            const places = ref([]);
            const showPlaceSearch = ref(false);
            const start_placeSearch = ref('');
            const end_placeSearch = ref('');
            const weekDays = ref([
                
                {k:'saturday', s:'SA', class:'bg-warning'},
                {k:'sunday', s:'SU', class:'bg-danger'},
                {k:'monday', s:'MO', class:'bg-info'},
                {k:'tuesday', s:'TU', class:'bg-success'},
                {k:'wednesday', s:'WE', class:'bg-primary'},
                {k:'thursday', s:'TH', class:'bg-gradient-secondary'},
                {k:'friday', s:'FR', class:'bg-dark-subtle'},
            ]);

            if (props.item) {
                activeItem.value = props.item
            }

            const users = (props.userslist) ? ref(props.userslist) : ref([]);

            /**
             * Get current location
             */
            const getUserLocation = async () => {
                if (navigator.geolocation && !activeItem.value.location_id) {
                    navigator.geolocation.getCurrentPosition
                        (
                            position => {
                                activeItem.value.start_latitude = position.coords.latitude;
                                activeItem.value.start_longitude = position.coords.longitude;
                                activeItem.value.end_latitude = position.coords.latitude;
                                activeItem.value.end_longitude = position.coords.longitude;
                            },
                            error => {

                                activeItem.value.start_latitude = activeItem.value.start_latitude ?? 30.06;
                                activeItem.value.start_longitude = activeItem.value.start_longitude ?? 31.21;
                                activeItem.value.end_latitude = activeItem.value.end_latitude ?? 30.06;
                                activeItem.value.end_longitude = activeItem.value.end_longitude ?? 31.21;
                                showAlert(error.message)
                            }
                        );

                } else {
                    locationError.value = "Geolocation is not supported by this browser.";
                }
            }

            getUserLocation();

            const startPlaceChanged = async () => {
                let result = start_placeSearch.value.length > 3 ? await findPlaces(props.system_setting.google_map_api, start_placeSearch.value, props.business_setting.country) : ''
                places.value = result.predictions;
            }

            const endPlaceChanged = async () => {
                let result = end_placeSearch.value.length > 3 ? await findPlaces(props.system_setting.google_map_api, end_placeSearch.value, props.business_setting.country) : ''
                places.value = result.predictions;
            }

            const saveRoute = () => {
                var params = new URLSearchParams();
                let array = JSON.parse(JSON.stringify(activeItem.value));
                let keys = Object.keys(array)
                let k, d, value = '';
                for (let i = 0; i < keys.length; i++) {
                    k = keys[i]
                    d = typeof array[k] === 'object' ? JSON.stringify(array[k]) : array[k]
                    params.append('params[' + k + ']', d)
                }
                let type = array.location_id > 0 ? 'update' : 'create';
                params.append('type', 'RouteLocation.' + type)
                handleRequest(params, '/api/' + type).then(response => {
                    handleAccess(response)
                })
            }

            const updateStartMarker = async (position) => {
                activeItem.value.start_latitude = position.lat();
                activeItem.value.start_longitude = position.lng();
                activeItem.value.start_address = await getPositionAddress(position.lat(), position.lng())
            }

            const updateEndMarker = async (position) => {
                activeItem.value.end_latitude = position.lat();
                activeItem.value.end_longitude = position.lng();
                activeItem.value.end_address = await getPositionAddress(position.lat(), position.lng())
            }


            const setPlaceMarker = async (placeInfo, type) => {
                const placesService = new google.maps.places.PlacesService(document.createElement('div'));

                let placeId = placeInfo.place_id;

                placesService.getDetails({ placeId }, (place, status) => {
                    if (status === google.maps.places.PlacesServiceStatus.OK && place) {
                        const location = place.geometry.location;


                        if (type == 'start') {
                            activeItem.value.start_address = placeInfo.description
                            activeItem.value.start_latitude = location.lat()
                            activeItem.value.start_longitude = location.lng()
                        }

                        if (type == 'end') {
                            activeItem.value.end_address = placeInfo.description
                            activeItem.value.end_latitude = location.lat()
                            activeItem.value.end_longitude = location.lng()
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

            const checkSimilarUser = (item) => {
                let name = (item.name).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
                return name ? name : (item.mobile).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
            }

            const setUser = (user) => {
                activeItem.value.model_id = props.usertype == 'student' ? user.student_id : user.customer_id;
                activeItem.value.model = user;
                activeTab.value = 'Pickup location';
                searchText.value = null;
            }

            const findUser = () => 
            {
                if (props.userslist)
                {
                    for (let i = 0; i < props.userslist.length; i++) {
                        props.userslist[i].show = searchText.value.trim() ? checkSimilarUser(props.userslist[i]) : false;
                    }
                }
            }


            const checkSimilarRoute = (item) => {
                let name = (item.route_name).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
                return name ? name : ((item.description).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false);
            }

            const setRoute = (route) => {
                activeItem.value.route_id = route.route_id;
                activeItem.value.route = route;
                activeTab.value = 'Confirm';
                searchText.value = null;
            }

            const findRoute = () => {

                if (props.routes) {

                    for (let i = 0; i < props.routes.length; i++) {
                        props.routes[i].show = searchText.value.trim() ? checkSimilarRoute(props.routes[i]) : 1;
                    }
                    console.log(props.routes);
                }
            }

            const showTip = ref({});

            
            const progressWidth = () => 
            {
                let requiredData = ['model_id', 'route_id', 'start_address', 'end_address','status'];
                
                return getProgressWidth(requiredData, activeItem);
            }


            return {
                users,
                progressWidth,
                weekDays,
                showTip,
                setRoute,
                findRoute,
                setUser,
                findUser,
                setPlaceMarker,
                showPlaceSearch,
                startPlaceChanged,
                endPlaceChanged,
                start_placeSearch,
                end_placeSearch,
                places,
                showAddSide,
                showEditSide,
                content,
                fillable,
                center,
                activeItem,
                activeTab,
                translate,
                updateStartMarker,
                updateEndMarker,
                searchText,
                getUserLocation,
                collapsed,
                saveRoute,
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
            'routes',
        ],

    };
</script>
<template>
    <div class="w-full overflow-auto" >
        
        <div v-if="loader" :key="loader" class="bg-white fixed w-full h-full top-0 left-0" style="z-index:99999; opacity: .9;">
            <img class="m-auto w-500px" :src="'/uploads/loader.gif'" />
        </div>
        <div  class=" w-full relative">
            <close_icon class="absolute top-4 right-4 z-10 cursor-pointer" @click="back" />
            <div class=" card w-full py-10" >
                <div class="w-full stepper stepper-links ">
                    <div class="stepper-nav justify-content-center py-2 mb-10"   >
                        <div class="stepper-item " v-for="row in fillable" @click="activeTab = row">
                            <h3  :class="activeTab == row ? 'text-danger border-danger' : 'text-gray-400 border-transparent'"  class="cursor-pointer pb-3 px-2 stepper-title text-md border-b " v-text="translate(row)" ></h3>
                        </div>
                    </div>
                    <div  class="w-full">
                        <div class="" v-if="activeTab == 'Info'" :key="activeTab">
                            <div class="card-body pt-0"  >
                                <div class="settings-form" >
                                    <div class="max-w-xl mb-6 mx-auto row" >
                                
                                        <input name="params[route_id]" type="hidden" >
                    
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6" :for="'input'+i"  v-text="translate('Route name')" ></label>
                                        <input :required="true" autocomplete="off" name="params[name]" class="form-control form-control-solid" :placeholder="translate('Route name')" v-model="activeItem.route_name">
                                        <hr class="block mt-6 my-2 opacity-10" />
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6" :for="'input'+i"  v-text="translate('Description')"></label>
                                        <textarea :required="true" autocomplete="off" name="params[description]" class="form-control form-control-solid" :placeholder="translate('Description')" v-model="activeItem.description"> </textarea>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center mt-10"><a href="javascript:;" class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger" @click="activeTab = 'Time'" v-text="translate('Next')"></a></p>
                        </div>
                        <div class="" v-if="activeTab == 'Time'" :key="activeTab">
                            <div class="card-body pt-0"  >
                                <div class="settings-form" >
                                    <div class="max-w-xl mb-6 mx-auto row" >
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6" v-text="translate('Morning trip time')" ></label>
                                        <input :required="true" autocomplete="off" name="params[morning_trip_time]" class="form-control form-control-solid" :placeholder="translate('Morning Trip time')" type="time" v-model="activeItem.morning_trip_time">
                                        <hr class="block mt-6 my-2 opacity-10" />
                                        
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6"   v-text="translate('Afternoon trip time')" ></label>
                                        <input :required="true" autocomplete="off" name="params[afternoon_trip_time]" class="form-control form-control-solid" :placeholder="translate('Afternoon Trip time')" type="time" v-model="activeItem.afternoon_trip_time">

                                    </div>
                                </div>
                            </div>
                            <p class="text-center mt-10"><a href="javascript:;" class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger" @click="activeTab = 'Start location'" v-text="translate('Next')"></a></p>
                        </div>
                        <div class="" v-if="activeTab == 'Start location'" :key="activeTab">
                            <div class="card-body pt-0"  >
                                <div class="settings-form" >
                                    <div class="px-10 mb-6 mx-auto row" >
                                        <div class="flex w-full">
                                            <div class="mt-10 w-full">
                                                <h3 class="mb-3" v-text="translate('Location Address')"></h3>
                                                
                                                <div class="fw-semibold text-gray-600 fs-6">
                                                    <span class="d-block fw-bold pb-3 text-gray-400" :key="activeItem.position.start_address" v-text="activeItem.position.start_address"></span>
                                                    <a class="fw-bold" @click="showPlaceSearch = true" href="javascript:;" v-text="translate('Change')"></a>
                                                </div>
                                                <div v-if="showPlaceSearch" :key="showPlaceSearch">
                                                    <input autocomplete="off" @change="startPlaceChanged" v-model="start_placeSearch" type="text" class="form-control form-control-solid" :placeholder="translate('Find Location')">

                                                    <div class="mt-3 w-full card-body" v-if="places" :key="places">
                                                        <div class="w-full" v-for="place in places">
                                                            <div class="d-flex align-items-center mb-8" v-if="place">
                                                                <span class="bullet bullet-vertical h-40px bg-success"></span>
                                                                <div class="form-check form-check-custom form-check-solid mx-5 cursor-pointer" @click="setPlaceMarker(place, 'start')">
                                                                    <input class="form-check-input" type="checkbox" value="">
                                                                </div>
                                                                <div class="flex-grow-1 cursor-pointer" @click="setPlaceMarker(place, 'start')">
                                                                    <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6" v-if="place.structured_formatting" v-text="place.structured_formatting.main_text"></a>
                                                                    <span class="text-muted fw-semibold d-block" v-text="place.description"></span>
                                                                </div>
                                                                <span class="badge badge-light-success fs-8 fw-bold"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" w-full">
                                                <editable_map_location :system_setting="system_setting" :item="activeItem.position" @setlocation="updateStartMarker" :key="activeItem.position.start_latitude" :location="{lat:activeItem.position.start_latitude, lng: activeItem.position.start_longitude}" ></editable_map_location>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center mt-10"><a href="javascript:;" class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger" @click="activeTab = 'End location'" v-text="translate('Next')"></a></p>
                        </div>
                        <div class="" v-if="activeTab == 'End location'" :key="activeTab">
                            <div class="card-body pt-0"  >
                                <div class="px-10 mb-6 mx-auto row" >
                                    <div class="flex w-full">
                                        <div class="mt-10 w-full">
                                            <h3 class="mb-3" v-text="translate('Location Address')"></h3>
                                            
                                            <div class="fw-semibold text-gray-600 fs-6">
                                                <span class="d-block fw-bold pb-3 text-gray-400" :key="activeItem.position.end_address" v-text="activeItem.position.end_address"></span>
                                                <a class="fw-bold" @click="showPlaceSearch = true" href="javascript:;" v-text="translate('Change')"></a>
                                            </div>
                                            <div v-if="showPlaceSearch" :key="showPlaceSearch">
                                                <input autocomplete="off" @change="endPlaceChanged" v-model="end_placeSearch" type="text" class="form-control form-control-solid" :placeholder="translate('Find Location')">

                                                <div class="mt-3 w-full card-body" v-if="places && end_placeSearch.length" :key="places">
                                                    <div class="w-full" v-for="place in places">
                                                        <div class="d-flex align-items-center mb-8" v-if="place">
                                                            <span class="bullet bullet-vertical h-40px bg-success"></span>
                                                            <div class="form-check form-check-custom form-check-solid mx-5 cursor-pointer" @click="setPlaceMarker(place, 'end')">
                                                                <input class="form-check-input" type="checkbox" value="">
                                                            </div>
                                                            <div class="flex-grow-1 cursor-pointer" @click="setPlaceMarker(place,'end')">
                                                                <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6" v-if="place.structured_formatting" v-text="place.structured_formatting.main_text"></a>
                                                                <span class="text-muted fw-semibold d-block" v-text="place.description"></span>
                                                            </div>
                                                            <span class="badge badge-light-success fs-8 fw-bold"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" w-full">
                                            <editable_map_location :system_setting="system_setting" :item="activeItem.position" @setlocation="updateEndMarker" :key="activeItem.position.end_latitude" :location="{lat:activeItem.position.end_latitude, lng: activeItem.position.end_longitude}" ></editable_map_location>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center mt-10"><a href="javascript:;" class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger" @click="activeTab = 'Driver'" v-text="translate('Next')"></a></p>
                        </div>
                        
                        <div class="" v-if="activeTab == 'Driver'" :key="activeTab">
                            <div class="card-body pt-0">
                                <div class="settings-form flex w-full">
                                    <div class="w-full">
                                        <drivers_locations_map :setting="system_setting" :item="activeItem"
                                            :drivers="drivers" :conf="conf" 
                                            :center="{lat: Number(activeItem.position.start_latitude),lng: Number(activeItem.position.start_longitude)}"
                                            @setdriver="setDriver" :key="activeItem"
                                            >
                                        </drivers_locations_map>
                                    </div>
                                    <div class="w-full mb-6 mx-auto row">
                                        <div class="card-body pt-0 mx-auto max-w-xl" :key="drivers">
                                            <div class="text-center mb-13">
                                                <h1 class="mb-3" v-text="translate('Find Driver')"></h1>

                                                <div class="text-gray-400 font-semibold "
                                                    v-text="translate('Search by name or mobile')"></div>
                                            </div>
                                            <div class="w-100 relative mb-5" autocomplete="off">

                                                <vue-feather type="user"
                                                    class="text-gray-500 position-absolute top-50 ms-5 translate-middle-y"></vue-feather>

                                                <input type="text" @change="findDriver" @input="findDriver" v-model="searchText"
                                                    class="form-control form-control-lg form-control-solid px-15"
                                                    :placeholder="translate('Search by name or mobile')">
                                            </div>
                                            <div class="w-full " v-for="driver in drivers" v-if="searchText">
                                                <a href="javascript:;" :key="driver.show" v-if="driver && driver.show"
                                                    class="d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1">
                                                    <div class="symbol symbol-35px symbol-circle me-5">
                                                        <car_icon  v-if="!driver.picture" /> 
                                                        <img alt="Pic" v-if="driver.picture" :src="driver.picture">
                                                    </div>
                                                    <div class="fw-semibold w-full">
                                                        <span class="text-lg text-danger font-semibold me-2"
                                                            v-text="driver.name"></span>
                                                        <span class="block text-gray-500 text-sm"
                                                            v-text="driver.mobile"></span>
                                                    </div>
                                                    <span @click="setDriver(driver)" class="btn btn-danger btn-sm text-white"
                                                        v-text="translate('Choose')"></span>
                                                </a>
                                            </div>

                                            <a href="javascript:;" :key="activeItem.driver" v-if="activeItem.driver"
                                                class="d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1 gap-4">
                                                <div class="symbol symbol-35px symbol-circle me-5">
                                                    <car_icon  v-if="!activeItem.driver.picture" /> 
                                                    <img alt="Pic" v-if="activeItem.driver.picture" :src="activeItem.driver.picture">
                                                </div>

                                                <div class="fw-semibold w-full">
                                                    <span class="text-lg text-danger font-semibold me-2"
                                                        v-text="activeItem.driver.name"></span>
                                                    <span class="block text-gray-500 text-sm truncate"
                                                        v-text="activeItem.driver.mobile"></span>
                                                </div>
                                                
                                                <div v-if="activeItem.vehicle" class="text-gray-600 fw-semibold flex flex-column-auto gap-2">
                                                    <vue-feather type="truck"></vue-feather>
                                                    <span v-text="activeItem.vehicle.plate_number" class="text-md font-semibold me-2 flex-column-auto"></span>
                                                </div>
                                            </a>
                                            
                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6" v-text="translate('Vehicles')" ></label>
                                            <form_field @callback="setVehicle" :item="activeItem" :column="{key: 'vehicle_id', title: translate('Vehicle'), text_key:'vehicle_name',column_type:'select', data:vehicles}"></form_field>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center mt-10"><a href="javascript:;" class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger" @click="activeTab = 'Supervisor'" v-text="translate('Next')"></a></p>
                        </div>

                        <div class="w-full  mx-auto" v-if="activeTab == 'Supervisor'" :key="activeTab">
                            
                            <div class="card-body pt-0"  >
                                <div class="settings-form" >
                                    <div class="max-w-xl mb-6 mx-auto row" >
                                        <div class="text-center mb-13">
                                            <h1 class="mb-3" v-text="translate('Select Supervisor')"></h1>
                                            <div class="text-gray-400 font-semibold " v-text="translate('Assigned spervisor should have location')"></div>
                                        </div>

                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6" v-text="translate('Supervisor')" ></label>
                                        <form_field :item="activeItem" :column="{key: 'supervisor_id', title: translate('Supervisor'), text_key:'name',column_type:'select', data:supervisors}"></form_field>
                                        <hr class="block mt-6 my-2 opacity-10" />
                                
                                    </div>
                                </div>
                            </div>
                            <p class="text-center mt-10"><a href="javascript:;" class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger" @click="activeTab = 'Confirm'" v-text="translate('Next')"></a></p>
                        </div>

                        <div class="w-full  mx-auto" v-if="activeTab == 'Confirm'" :key="activeTab">
                            
                            <div class="w-full flex gap-10">
                                <div class="w-full">
                                    <route_map @markerclicked="markerClicked" class="rounded-xl shadow-md mx-4" :system_setting="system_setting" :conf="conf" :route="activeItem"  ></route_map>
                                </div>
                                <div class="w-full">
                                    <hr class="block mt-6 my-2 opacity-10" />
                                    <div class="bg-gray-200 shadow-md mb-10 rounded-xl">
                                        <div class="card-header border-0 pt-9">
                                            <div class="card-title m-0 flex  gap-4" v-if="activeItem.driver_id">
                                                <div class="symbol symbol-50px w-50px bg-light">
                                                    <img  :src="selectedObject(drivers,'driver_id').picture" alt="image" class="p-3" >
                                                </div>
                                                <span class="" v-text="selectedObject(drivers,'driver_id').name"></span>
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

                                        <div class="card-body p-9" v-if="activeItem">
                                            <div class="fs-3 fw-bold text-gray-900" v-text="activeItem.route_name"></div>
                                            <p class="text-gray-500 fw-semibold fs-5 mt-1 mb-7" v-text="activeItem.description"></p>
                                            <div class="timeline timeline-border-dashed">
                                                
                                                <div class="timeline-item">
                                                    <div class="timeline-line"></div>
                                                    <div class="timeline-icon me-4"><vue-feather type="circle" class="fs-2 text-success"></vue-feather></div>

                                                    <div class="timeline-content mb-10 mt-n2">
                                                        <div class="overflow-auto pe-3">
                                                            <div class="fs-5 fw-semibold mb-2" v-if="activeItem.position" v-text="activeItem.position.start_address"></div>

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
                                                            <div class="fs-5 fw-semibold mb-2" v-if="activeItem.position" v-text="activeItem.position.end_address"></div>

                                                            <div class="d-flex align-items-center mt-1 fs-6">
                                                                <div class="text-muted me-2 fs-7" v-text="translate('Destination')"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="h-4px w-100 bg-light mb-5" >
                                                <div class="rounded h-4px transition transition-all" role="progressbar" :class="progressWidth() < 100 ? 'bg-info' : 'bg-success'" :style="{width: progressWidth()+'%'}"></div>
                                            </div>
                                            
                                            <div class="w-full flex gap-4" v-if="activeItem.vehicle_id">
                                                <div class="w-full flex gap-4" v-if="activeItem.vehicle_id">
                                                    <img :src="'/uploads/images/car.svg'" class="w-10" />
                                                    <div class="block gap-4">
                                                        <span class="w-full block font-semibold" v-text="translate('Vehicle')"></span>
                                                        <span class="w-full block" v-text="selectedObject(vehicles,'vehicle_id').plate_number"></span>
                                                    </div>
                                                </div>
                                                <div class="w-full block gap-4" v-if="activeItem.morning_trip_time">
                                                    <span class="w-full block font-semibold" v-text="translate('Morning trip')"></span>
                                                    <span class="w-full block " v-text="activeItem.morning_trip_time"></span>
                                                </div>
                                                <div class="w-full block gap-4" v-if="activeItem.afternoon_trip_time">
                                                    <div class="w-full block gap-4">
                                                        <span class="w-full block font-semibold" v-text="translate('Afternoon trip')"></span>
                                                        <span class="w-full block " v-text="activeItem.afternoon_trip_time"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center mt-10"><a href="javascript:;" class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger" @click="saveRoute" v-text="translate('Submit')"></a></p>
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

import {defineAsyncComponent, getCurrentInstance, ref} from 'vue';
import {translate, getProgressWidth, handleRequest, deleteByKey, showAlert, handleAccess, getPositionAddress, findPlaces, getPlaceDetails} from '@/utils.vue';

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
import route_map from '@/components/maps/route_map.vue';
import drivers_locations_map from '@/components/includes/drivers_locations_map.vue';

export default 
{
    components:{
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
        drivers_locations_map,
        route_map
    },
    name:'Routes',
    emits:['callback'],
    setup(props, {emit}) {

        const loader = ref(false);
        const showAddSide = ref(false);
        const showEditSide = ref(false);
        const activeItem = ref({});
        const activeTab = ref('Info');
        const content = ref({});
        const center = ref({});
        const searchText =  ref('');
        const locationError =  ref(null);
        const collapsed =  ref(false);
        const fillable =  ref(['Info', 'Time','Start location','End location','Driver', 'Supervisor','Confirm']);
        const places =  ref([]);
        const showPlaceSearch =  ref(false);
        const start_placeSearch =  ref('');
        const end_placeSearch =  ref('');
        
        if (props.active_tab) {
            activeTab.value = props.active_tab;
        }
        if (props.item) {
            activeItem.value = props.item
            activeItem.value.position = props.item.position ?? {}
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
        


        /**
         * Get current location
         */
        const getUserLocation = async () => 
        {
            if (navigator.geolocation && !activeItem.value.route_id) 
            {
                navigator.geolocation.getCurrentPosition
                (
                    position => {
                        activeItem.value.position.start_latitude = position.coords.latitude;
                        activeItem.value.position.start_longitude = position.coords.longitude;
                        activeItem.value.position.end_latitude = position.coords.latitude;
                        activeItem.value.position.end_longitude = position.coords.longitude;
                    },
                    error => { 
                        
                        activeItem.value.position.start_latitude = activeItem.value.position.start_latitude ?? 30.06;
                        activeItem.value.position.start_longitude = activeItem.value.position.start_longitude ?? 31.21;
                        activeItem.value.position.end_latitude = activeItem.value.position.end_latitude ?? 30.06;
                        activeItem.value.position.end_longitude = activeItem.value.position.end_longitude ?? 31.21;
                        showAlert(error.message) 
                    }
                );

            } else {
                locationError.value = "Geolocation is not supported by this browser.";
            }
        }

        getUserLocation();
        
        const  startPlaceChanged = async () =>
        {
            let result = start_placeSearch.value.length > 3 ? await findPlaces(props.system_setting.google_map_api, start_placeSearch.value, props.business_setting.country) : ''
            places.value = result.predictions;
        }

        const  endPlaceChanged = async () =>
        {
            let result = end_placeSearch.value.length > 3 ? await findPlaces(props.system_setting.google_map_api, end_placeSearch.value, props.business_setting.country) : ''
            places.value = result.predictions;
        }

        const saveRoute = async ()  =>
        {
            loader.value = true;
            var params = new URLSearchParams();
            let array = JSON.parse(JSON.stringify(activeItem.value));
            let keys = Object.keys(array)
            let k,d,value = '';
            for (let i = 0; i < keys.length; i++) {
                k = keys[i]
                d = typeof array[k] === 'object' ? JSON.stringify(array[k]) : array[k]
                params.append('params['+k+']', d)
            }
            
            let type = array.route_id > 0 ? 'update' : 'create';
            params.append('type', 'Route.'+type)
            await handleRequest(params, '/api/'+type).then(response => {
                loader.value = false;
                handleAccess(response)
            })
        }
        
        const updateStartMarker = async (position) =>
        {
            activeItem.value.position.start_latitude =  position.lat();
            activeItem.value.position.start_longitude =  position.lng();
            activeItem.value.position.start_address = await getPositionAddress(position.lat(),position.lng())
        } 
        
        const updateEndMarker = async (position) =>
        {
            activeItem.value.position.end_latitude =  position.lat();
            activeItem.value.position.end_longitude =  position.lng();
            activeItem.value.position.end_address = await getPositionAddress(position.lat(),position.lng())
        } 
        

        const setPlaceMarker = async (placeInfo, type) => 
        {
            const placesService = new google.maps.places.PlacesService(document.createElement('div'));

            let placeId = placeInfo.place_id;

            placesService.getDetails({ placeId }, (place, status) => 
            {
                if (status === google.maps.places.PlacesServiceStatus.OK && place) 
                {
                    const location = place.geometry.location;
                    
                    
                    if (type == 'start') 
                    {
                        activeItem.value.position.start_address = placeInfo.description
                        activeItem.value.position.start_latitude = location.lat()
                        activeItem.value.position.start_longitude = location.lng()
                    }

                    if (type == 'end')
                    {
                        activeItem.value.position.end_address = placeInfo.description
                        activeItem.value.position.end_latitude = location.lat()
                        activeItem.value.position.end_longitude = location.lng()
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
        
        const selectedObject = (array, key) => 
        {
            const keyValue = activeItem.value[key];
            for (let i = 0; i < array.length; i++) {
                if (array[i][key] == keyValue)
                {
                    return array[i]
                }
            }
            return {}
        }

        const markerClicked = (object) => 
        {
            if (object && object.model)
            {
                showAlert(object.model.name+" \n\r " + object.start_address)
            }
        }

        const progressWidth = () => 
        {
            let requiredData = ['route_name', 'description', 'morning_trip_time','afternoon_trip_time','start_address', 'end_address','driver_id', 'vehicle_id', 'status'];
            
            return getProgressWidth(requiredData, activeItem);
        }

        const findDriver = () => {
            if (props.drivers) {
                for (let i = 0; i < props.drivers.length; i++) {
                    props.drivers[i].show = searchText.value.trim() ? checkSimilarDriver(props.drivers[i]) : 1;
                }
            }   
        }
        
        const checkSimilarDriver = (item) => {
            let name = (item.name).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
            return name ? name : (item.mobile).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
        }


        return {
            loader,
            showPlaceSearch,
            findDriver,
            setDriver,
            setVehicle,
            markerClicked,
            progressWidth,
            selectedObject,
            setPlaceMarker,
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
        'drivers',
        'vehicles',
        'supervisors',
        'active_tab'
    ],
    
};
</script>
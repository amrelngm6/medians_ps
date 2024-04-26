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
                        <div class="" v-if="activeTab == 'Info'" :key="activeTab">
                            <div class="card-body pt-0"  >
                                <div class="settings-form" >
                                    <div class="max-w-xl mb-6 mx-auto row" >
                                
                                        <input name="params[route_id]" type="hidden" >
                    
                                        <label class="col-lg-4 col-form-label required font-semibold fs-6" :for="'input'+i"  v-text="translate('Name')" ></label>
                                        <form_field class="w-full" :item="activeItem"
                                            :column="{ key: 'name', title: translate('name'), column_type: 'text', hide_text: false }">
                                        </form_field>
                                        <hr class="block mt-6 my-2 opacity-10" />
                                        
                                        <label class="col-lg-4 col-form-label required font-semibold fs-6" :for="'input'+i"  v-text="translate('Email')" ></label>
                                        <form_field class="w-full" :item="activeItem"
                                            :column="{ key: 'email', title: translate('email'), column_type: 'email', hide_text: false }">
                                        </form_field>
                                        <hr class="block mt-6 my-2 opacity-10" />
                                        
                                        <label class="col-lg-4 col-form-label required font-semibold fs-6" :for="'input'+i"  v-text="translate('Mobile')" ></label>
                                        <form_field class="w-full" :item="activeItem"
                                            :column="{ key: 'mobile', title: translate('mobile'), column_type: 'phone', hide_text: false }">
                                        </form_field>
                                        <hr class="block mt-6 my-2 opacity-10" />
                                        
                                        <label class="col-lg-4 col-form-label required font-semibold fs-6" :for="'input'+i"  v-text="translate('Date of Birth')" ></label>
                                        <form_field class="w-full" :item="activeItem"
                                            :column="{ key: 'birth_date', title: translate('birth_date'), column_type: 'date', hide_text: false }">
                                        </form_field>
                                        <hr class="block mt-6 my-2 opacity-10" />
                                        
                                        <label class="col-lg-4 col-form-label required font-semibold fs-6" :for="'input'+i"  v-text="translate('Picture')" ></label>
                                        <form_field class="w-full" :item="activeItem" :conf="conf"
                                            :column="{ key: 'picture', title: translate('Picture'), column_type: 'picture', hide_text: false }">
                                        </form_field>

                                    </div>
                                </div>
                            </div>
                            <p class="text-center mt-10"><a href="javascript:;" class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger" @click="activeTab = 'Pickup location'" v-text="translate('Next')"></a></p>
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
                                                                    @click="setPlaceMarker(place)">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="">
                                                                </div>
                                                                <div class="flex-grow-1 cursor-pointer"
                                                                    @click="setPlaceMarker(place)">
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
                                @click="activeTab = 'Confirm'" v-text="translate('Confirm')"></a></p>
                        </div>
                        

                        <div class="max-w-xl mx-auto" v-if="activeTab == 'Confirm'" :key="activeTab">
                            
                            <hr class="block mt-6 my-2 opacity-10" />
                            <div class="bg-gray-200 shadow-md mb-10 rounded-xl">
                                <div class="card-header border-0 pt-9">
                                    <div class="card-title m-0 flex  gap-4" v-if="activeItem ">
                                        <div class="symbol symbol-50px w-50px bg-light">
                                            <img :src="activeItem.picture" alt="image" class="p-3">
                                        </div>
                                        <div class="block">
                                            <span class="block font-semibold" v-text="activeItem.name"></span>
                                            <span class="block text-base" v-text="activeItem.email"></span>
                                        </div>
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
                                    
                                </div> 
                                <div class="card-body p-9" >
                                    <div class="timeline timeline-border-dashed">
                                        
                                        <div class="timeline-item" v-if="activeItem.route">
                                            <div class="timeline-line"></div>
                                            <div class="timeline-icon me-4"><vue-feather type="circle" class="fs-2 text-success"></vue-feather></div>

                                            <div class="timeline-content mb-10 mt-n2">
                                                <div class="overflow-auto pe-3">
                                                    <div class="fs-5 fw-semibold mb-2" v-text="activeItem.start_address"></div>

                                                    <div class="d-flex align-items-center mt-1 fs-6">
                                                        <div class="text-muted me-2 fs-7" v-text="translate('Route Start')"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="timeline-item">
                                            <div class="timeline-line"></div>
                                            <div class="timeline-icon me-4"><vue-feather type="map-pin" class="fs-2 text-danger"></vue-feather></div>

                                            <div class="timeline-content mb-10 mt-n2">
                                                <div class="overflow-auto pe-3">
                                                    <div class="fs-5 fw-semibold mb-2" v-text="activeItem.start_address"></div>

                                                    <div class="d-flex align-items-center mt-1 fs-6">
                                                        <div class="text-muted me-2 fs-7" v-text="translate('Pickup')"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="h-4px w-100 bg-light mb-5" >
                                        <div class="rounded h-4px" role="progressbar" :class="progressWidth() < 100 ? 'bg-info' : 'bg-success'" :style="{width: progressWidth()+'%'}"></div>
                                    </div>

                                    
                                    <div class="w-full flex gap-4" >
                                        <div class="w-full flex gap-4" v-if="activeItem.mobile">
                                            <vue-feather type="phone" class="pt-2" />
                                            <div class="block gap-4">
                                                <span class="w-full block font-semibold" v-text="translate('Mobile')"></span>
                                                <span class="w-full block" v-text="activeItem.mobile"></span>
                                            </div>
                                        </div>
                                        <div class="w-full flex gap-4" v-if="activeItem.birth_date">
                                            <vue-feather type="calendar" class="pt-2" />
                                            <div class="block gap-4">
                                                <span class="w-full block font-semibold" v-text="translate('Birth date')"></span>
                                                <span class="w-full block " v-text="activeItem.birth_date"></span>
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>

                            <p class="text-center"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                    @click="saveSupervisor" v-text="translate('Submit')"></a></p>
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
        name: 'Supervisors',
        emits: ['callback'],
        setup(props, { emit }) {

            const showAddSide = ref(false);
            const showEditSide = ref(false);
            const showProfilePage = ref(null);
            const activeItem = ref({});
            const activeTab = ref('Info');
            const content = ref({});
            const center = ref({});
            const locations = ref([]);
            const showList = ref(true);
            const searchText = ref('');
            const locationError = ref(null);
            const collapsed = ref(false);
            const fillable = ref(['Info', 'Pickup location', 'Confirm']);
            const places = ref([]);
            const showPlaceSearch = ref(false);
            const start_placeSearch = ref('');
            

            if (props.item) {
                activeItem.value = props.item
            }

            const supervisors = (props.allsupervisors) ? ref(props.allsupervisors) : ref([]);

            /**
             * Get current location
             */
            const getUserLocation = async () => {
                if (navigator.geolocation) {
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
                    showAlert('location error')
                    locationError.value = "Geolocation is not supported by this browser.";
                }
            }

            getUserLocation();

            const startPlaceChanged = async () => {
                let result = start_placeSearch.value.length > 3 ? await findPlaces(props.system_setting.google_map_api, start_placeSearch.value, props.business_setting.country) : ''
                places.value = result.predictions;
            }

            const saveSupervisor = () => {
                var params = new URLSearchParams();
                let array = JSON.parse(JSON.stringify(activeItem.value));
                let keys = Object.keys(array)
                let k, d, value = '';
                for (let i = 0; i < keys.length; i++) {
                    k = keys[i]
                    d = typeof array[k] === 'object' ? JSON.stringify(array[k]) : array[k]
                    params.append('params[' + k + ']', d)
                }
                let type = array.supervisor_id > 0 ? 'update' : 'create';
                params.append('type', 'SuperVisor.' + type)
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


            const setPlaceMarker = async (placeInfo) => {
                const placesService = new google.maps.places.PlacesService(document.createElement('div'));

                let placeId = placeInfo.place_id;

                placesService.getDetails({ placeId }, (place, status) => {
                    if (status === google.maps.places.PlacesServiceStatus.OK && place) {
                        const location = place.geometry.location;

                        activeItem.value.start_address = placeInfo.description
                        activeItem.value.start_latitude = location.lat()
                        activeItem.value.start_longitude = location.lng()

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

            const checkSimilarSupervisor = (item) => {
                let name = (item.name).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
                return name ? name : (item.mobile).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
            }

            const setSupervisor = (supervisor) => {
                activeItem.value.model_id = supervisor.supervisor_id;
                activeItem.value.user_type = 'supervisor';
                activeItem.value.model = supervisor;
                activeTab.value = 'Pickup location';
                searchText.value = null;
            }

            const findSupervisor = () => {

                if (props.allsupervisors)
                {
                    for (let i = 0; i < props.allsupervisors.length; i++) {
                        props.allsupervisors[i].show = searchText.value.trim() ? checkSimilarSupervisor(props.allsupervisors[i]) : 1;
                    }
                }
            }

            const showTip = ref({});

            
            const progressWidth = () => 
            {
                let requiredData = ['name', 'email', 'mobile', 'birth_date','picture', 'start_address','status'];
                
                return getProgressWidth(requiredData, activeItem);
            }


            return {
                progressWidth,
                showTip,
                setSupervisor,
                findSupervisor,
                setPlaceMarker,
                showPlaceSearch,
                startPlaceChanged,
                start_placeSearch,
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
                saveSupervisor,
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
            'allsupervisors',
            'routes',
        ],

    };
</script>
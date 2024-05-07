<template>
    <div class="w-full overflow-auto">
        
        <div v-if="loader" :key="loader" class="bg-white fixed w-full h-full top-0 left-0" style="z-index:99999; opacity: .9;">
            <img class="m-auto w-500px" :src="'/uploads/loader.gif'" />
        </div>
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
                            <div class="card-body pt-0 mx-auto max-w-xl" :key="users">
                                
                                <div class="mb-6 mx-auto  flex">
                                    <label class="w-200px col-form-label required fw-semibold fs-6" v-text="translate('Trip Date')"></label>
                                    <span  v-text="activeItem.date" class="fw-semibold text-lg" ></span>
                                </div>
                                <hr class="block mt-6 my-2 opacity-10" />
                                <div class="mb-6 mx-auto  flex">
                                    <label class="w-200px col-form-label required fw-semibold fs-6"
                                        v-text="translate('Start time')"></label>
                                    <span  v-text="formatCustomTime(activeItem.created_at, 'hh:mm:ss')" class="fw-semibold text-lg" ></span>
                                </div>
                                <div class="mb-6 mx-auto  flex">

                                    <label class="w-200px my-2 col-form-label required fw-semibold fs-6" v-text="translate('Driver')"></label>
                                    <a href="javascript:;" :key="activeItem.driver" v-if="activeItem.driver"
                                        class="w-full d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1 gap-4">
                                        <div class="symbol symbol-35px symbol-circle me-5">
                                            <car_icon v-if="!activeItem.driver.picture" />
                                            <img alt="Pic" v-if="activeItem.driver.picture"
                                                :src="activeItem.driver.picture">
                                        </div>

                                        <div class="fw-semibold w-full">
                                            <span class="text-lg text-danger font-semibold me-2"
                                                v-text="activeItem.driver.name"></span>
                                            <span class="block text-gray-500 text-sm truncate"
                                                v-text="activeItem.driver.mobile"></span>
                                        </div>
                                    </a>
                                </div>
                                <div class="mb-6 mx-auto  flex">

                                    <label class="w-200px my-2 col-form-label required fw-semibold fs-6" v-text="translate('Vehicle')"></label>
                                    <a href="javascript:;" :key="activeItem.vehicle" v-if="activeItem.vehicle"
                                        class="w-full d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1">
                                        <div class="symbol symbol-35px symbol-circle me-5">
                                            <car_icon v-if="!activeItem.vehicle.picture" />
                                            <img alt="Pic" v-if="activeItem.vehicle.picture" :src="activeItem.vehicle.picture">
                                        </div>
                                        <div class="fw-semibold w-full">
                                            <span class="text-lg text-danger font-semibold me-2"
                                                v-text="activeItem.vehicle.vehicle_name"></span>
                                            <span class="block text-gray-500 text-sm"
                                                v-text="activeItem.vehicle.plate_number"></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <p class="text-center"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                    @click="activeTab = 'Locations'" v-text="translate('Locations')"></a></p>
                        </div>

                        <div class="" v-if="activeTab == 'Locations'" :key="activeTab">
                            <div class="card-body pt-0">
                                <div class="settings-form">
                                    <div class="px-10 mb-6 mx-auto row">
                                        <div class="lg:flex w-full gap-6">
                                            <div class="mt-10 w-full">
                                                <div class="flex gap-6">
                                                    <h3 class="mb-3 w-full" v-text="translate('Location Address')"></h3>
                                                    <p class="text-center px-6" v-text="translate('Time')"></p>
                                                </div>

                                                <div class="d-flex flex-stack pt-4" v-for="item in activeItem.locations">
                                                    <div class="symbol symbol-40px me-5">
                                                        <img :src="item.model.picture" class="h-50 align-self-center" alt="">
                                                    </div>

                                                    <div class="flex align-items-center w-full" v-if="item.model && item.location">
                                                        <div class="flex-grow-1 me-2" >
                                                            <a href="javascript:;" class="text-gray-800 text-hover-primary fs-6 fw-bold" v-text="item.model.name"></a>
                                                            <span class="text-muted fw-semibold d-block fs-7" v-text="item.location.start_address"></span>
                                                        </div>
                                                        <div>
                                                            <div @mouseover="item.showTip = true" @mouseleave="item.showTip = false" class="relative" >
                                                                <a href="javascript:;" @click="activeItem.currentLat = item.location.start_latitude, activeItem.currentLng = item.location.start_longitude" class="btn btn-sm btn-light fs-8 fw-bold" v-text="item.time"></a>
                                                                <tooltip v-if="item.showTip" :key="item.showTip" :title="translate('Show location')" ></tooltip></div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" w-full">
                                                <trip_map :system_setting="system_setting" :trip="activeItem" :conf="conf"
                                                    :key="activeItem" :waypoints="activeItem.locations"
                                                    >
                                                </trip_map>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                    @click="activeTab = 'Confirm'" v-text="translate('Confirm')"></a></p>
                        </div>


                        <div class="w-full  mx-auto" v-if="activeTab == 'Confirm'" :key="activeTab">

                            <div class="max-w-xl mx-auto">
                                <div class="w-full">
                                    <hr class="block mt-6 my-2 opacity-10" />
                                    <div class="bg-gray-200 shadow-md mb-10 rounded-xl">
                                        <div class="card-header border-0 pt-9">
                                            <div class="card-title m-0 flex  gap-4" v-if="activeItem.model">
                                                <div class="symbol symbol-50px w-50px bg-light">
                                                    <img :src="activeItem.model.picture" alt="image" class="p-3">
                                                </div>
                                                <div class="w-full ">
                                                    <div class="font-semibold" v-text="activeItem.model.name"></div>
                                                    <div class="" v-text="activeItem.model.mobile"></div>
                                                </div>
                                            </div>
                                            <label class=" flex gap-2 cursor-pointer">
                                                <div class="pt-3">
                                                    <span class="relative badge badge-light fw-bold me-auto px-4 py-3">
                                                        <form_field class="flex-end" :item="activeItem" :column="{
                                                            key: 'status', title: translate('Status'), column_type: 'select', text_key: 'title',
                                                            data: tripsStatusList, hide_text: true
                                                        }">
                                                        </form_field>
                                                        <vue-feather class="absolute right-4 " type="chevron-down" />
                                                    </span>
                                                </div>
                                            </label>
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
                                                                v-text="activeItem.route.position.start_address"></div>

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
                                                                v-text="activeItem.route.position.end_address"></div>

                                                            <div class="d-flex align-items-center mt-1 fs-6">
                                                                <div class="text-muted me-2 fs-7"
                                                                    v-text="translate('Destination')"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="h-4px w-100 bg-light mb-5">
                                                <div class="rounded h-4px transition transition-all" role="progressbar"
                                                    :class="progressWidth() < 100 ? 'bg-info' : 'bg-success'"
                                                    :style="{ width: progressWidth() + '%' }"></div>
                                            </div>

                                            <div class="w-full flex gap-4" v-if="activeItem">

                                                <div class="flex gap-4 min-w-175px  " v-if="activeItem.driver">
                                                    <img :src="activeItem.driver.picture"
                                                        class="rounded-full bg-white border-1 border border-gray-600 p-1 w-12 h-12" />
                                                    <div class="block gap-4 w-full">
                                                        <span class="w-full block font-semibold"
                                                            v-text="translate('Driver')"></span>
                                                        <span class="w-full block" v-text="activeItem.driver.name"></span>
                                                    </div>
                                                </div>

                                                <div class="w-150px flex gap-4" v-if="activeItem.vehicle">
                                                    <car_icon />
                                                    <div class="block gap-4">
                                                        <span class="w-full block font-semibold"
                                                            v-text="translate('Vehicle')"></span>
                                                        <span class="w-full block"
                                                            v-text="activeItem.vehicle.plate_number"></span>
                                                    </div>
                                                </div>

                                                <div class="w-125px flex-end" v-if="activeItem.date">
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
                                </div>
                            </div>
                            <p class="text-center mt-10"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                    @click="saveTrip" v-text="translate('Submit')"></a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import dashboard_card_white from '@/components/includes/dashboard_card_white.vue';
import close_icon from '@/components/svgs/Close.vue';
import delete_icon from '@/components/svgs/trash.vue';
import car_icon from '@/components/svgs/car.vue';

import 'vue3-easy-data-table/dist/style.css';
import Vue3EasyDataTable from 'vue3-easy-data-table';

import { defineAsyncComponent, ref } from 'vue';
import { translate, getProgressWidth, handleRequest, formatCustomTime, showAlert, handleAccess, getPositionAddress, findPlaces, getPlaceDetails, today } from '@/utils.vue';

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
import trip_map from '@/components/maps/trip_map.vue';

export default
    {
        components: {
            'datatabble': Vue3EasyDataTable,
            SideFormCreate,
            SideFormUpdate,
            trip_map,
            close_icon,
            delete_icon,
            car_icon,
            form_field,
            editable_map_location,
            dashboard_card_white,
            tooltip,
        },
        name: 'Route trips',
        emits: ['callback'],
        setup(props, { emit }) {

            const loader = ref(false);
            const showAddSide = ref(false);
            const showEditSide = ref(false);
            const activeItem = ref({});
            const activeTab = ref('Info');
            const content = ref({});
            const center = ref({});
            const searchText = ref('');
            const locationError = ref(null);
            const collapsed = ref(false);
            const fillable = ref(['Info', 'Locations', 'Confirm']);
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

            if (props.item) {
                activeItem.value = props.item
                activeItem.value.date = props.item.date ?? today()
            } else {
                activeItem.value.date = today()
            }

            const users = (props.userslist) ? ref(props.userslist) : ref([]);


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
                params.append('type', 'Trip.update')
                handleRequest(params, '/api/' + type).then(response => {
                    loader.value = false;
                    handleAccess(response)
                })
            }


            const progressWidth = () => {
                let requiredData = ['vehicle_id', 'driver_id', 'locations', 'date', 'status'];

                return getProgressWidth(requiredData, activeItem);
            }

            const back = () => {
                emit('callback');
            }

            return {
                loader,
                tripsStatusList,
                users,
                progressWidth,
                showPlaceSearch,
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
                formatCustomTime,
                searchText,
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
        ],

    };
</script>
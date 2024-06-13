<template>
    <div class="w-full  overflow-auto">
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
                        <div class="" v-if="activeTab == usertype" :key="activeTab">
                            <div class="card-body pt-0 mx-auto max-w-xl" :key="userslist">
                                <div class="text-center mb-13">
                                    <h1 class="mb-3" v-text="translate('Find')+' '+translate(usertype)"></h1>

                                    <div class="text-gray-400 font-semibold "
                                        v-text="translate('Search by name email or mobile')"></div>
                                </div>
                                <div class="w-100 relative mb-5" autocomplete="off">

                                    <vue-feather type="user"
                                        class="text-gray-500 position-absolute top-50 ms-5 translate-middle-y"></vue-feather>

                                    <input type="text" @change="findUser" @input="findUser" v-model="searchText"
                                        class="form-control form-control-lg form-control-solid px-15"
                                        :placeholder="translate('Search by name email or mobile')">
                                </div>
                                <div class="w-full " v-for="usermodel in userslist" v-if="searchText">
                                    <a href="javascript:;" :key="usermodel.show" v-if="usermodel.show"
                                        class="d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1">
                                        <div class="symbol symbol-35px symbol-circle me-5"><img alt="Pic"
                                                :src="usermodel.picture"></div>
                                        <div class="fw-semibold w-full">
                                            <span class="text-lg text-danger font-semibold me-2"
                                                v-text="usermodel.name"></span>
                                            <span class="block text-gray-500 text-sm" v-text="usermodel.mobile"></span>
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
                                        <span class="block text-gray-500 text-sm" v-text="activeItem.model.mobile"></span>
                                    </div>
                                </a>
                            </div>
                            <p class="text-center"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                    @click="activeTab = 'Package'" v-text="translate('Package')"></a></p>
                        </div>

                        <div class="" v-if="activeTab == 'Package'" :key="activeTab">
                            <div class="card-body pt-0">
                                <div class="settings-form">
                                    <div class="max-w-xl mb-6 mx-auto row">
                                        <div class="card-body pt-0 mx-auto max-w-xl" :key="packages">

                                            <div class="text-center mb-13">
                                                <h1 class="mb-3" v-text="translate('Find Package')"></h1>

                                                <div class="text-gray-400 font-semibold "
                                                    v-text="translate('Search by name or description')"></div>
                                            </div>
                                            <div class="w-100 relative mb-5" autocomplete="off">

                                                <vue-feather type="search"
                                                    class="text-gray-500 position-absolute top-50 ms-5 translate-middle-y"></vue-feather>

                                                <input type="text" @change="findPackage" @input="findPackage"
                                                    v-model="searchText"
                                                    class="form-control form-control-lg form-control-solid px-15"
                                                    :placeholder="translate('Search by name or description')">
                                            </div>
                                            <div class="w-full " v-for="packageItem in packages" v-if="searchText">
                                                <a href="javascript:;" :key="packageItem.show"
                                                    v-if="packageItem && packageItem.show"
                                                    class="d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1">
                                                    <div class="fw-semibold w-full">
                                                        <span class="text-lg text-danger font-semibold me-2"
                                                            v-text="packageItem.name"></span>
                                                        <span class="block text-gray-500 text-sm"
                                                            v-text="packageItem.description"></span>
                                                    </div>
                                                    <span @click="setPackage(packageItem)"
                                                        class="btn btn-danger btn-sm text-white"
                                                        v-text="translate('Choose')"></span>
                                                </a>
                                            </div>

                                            <a href="javascript:;" :key="activeItem.package" v-if="activeItem.package"
                                                class="d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1 gap-4">
                                                <vue-feather type="map" ></vue-feather>
                                                <div class="fw-semibold ">
                                                    <span class="text-lg text-danger font-semibold me-2"
                                                        v-text="activeItem.package.name"></span>
                                                    <span class="block text-gray-500 text-sm truncate"
                                                        v-text="activeItem.package.description"></span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                    @click="activeTab = 'Subscription'" v-text="translate('Subscription')"></a></p>
                        </div>

                        <div class="mx-auto max-w-4xl" v-if="activeTab == 'Subscription'" :key="activeTab">

                            <div class="relative py-4">


                                <div class="text-center mb-13">
                                    <h1 class="mb-3" v-text="translate('Subscription duration')"></h1>

                                    <div class="text-gray-400 font-semibold "
                                        v-text="translate('Choose the duration of the subscription to set the end date')">
                                    </div>
                                </div>
                                <div class="row">
                                    <!--begin::Col-->
                                    <div class="col-lg-4" @click="setType('month')">
                                        <input type="radio" class="btn-check" value="month"
                                            :checked="activeItem.payment_type == 'month' ? true : false"
                                            name="payment_type" />
                                        <label
                                            class="gap-6 btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-10">
                                            <vue-feather type="server"></vue-feather>
                                            <span class="d-block fw-semibold text-start">
                                                <span class="text-gray-900 fw-bold d-block fs-4 mb-2"
                                                    v-text="translate('Month')"></span>
                                                <span class="text-muted fw-semibold fs-6"
                                                    v-text="translate('Subscribe for month')"></span>
                                            </span>
                                        </label>
                                    </div>

                                    <div class="col-lg-4" @click="setType('quarter')">
                                        <input type="radio" class="btn-check" value="quarter"
                                            :checked="activeItem.payment_type == 'quarter' ? true : false"
                                            name="payment_type" />
                                        <label
                                            class="gap-6 btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-10">
                                            <vue-feather type="server"></vue-feather>
                                            <span class="d-block fw-semibold text-start">
                                                <span class="text-gray-900 fw-bold d-block fs-4 mb-2"
                                                    v-text="translate('Quarter')"></span>
                                                <span class="text-muted fw-semibold fs-6"
                                                    v-text="translate('Subscribe for quarter')"></span>
                                            </span>
                                        </label>
                                    </div>

                                    <div class="col-lg-4" @click="setType('year')">
                                        <input type="radio" class="btn-check" value="year"
                                            :checked="activeItem.payment_type == 'year' ? true : false"
                                            name="payment_type" />
                                        <label
                                            class="gap-6 btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-10">
                                            <vue-feather type="server"></vue-feather>
                                            <span class="d-block fw-semibold text-start">
                                                <span class="text-gray-900 fw-bold d-block fs-4 mb-2"
                                                    v-text="translate('Year')"></span>
                                                <span class="text-muted fw-semibold fs-6"
                                                    v-text="translate('Subscribe for year')"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="relative py-4 max-w-xl mx-auto">

                                <label class="nui-label w-full pb-2 px-5 block font-semibold text-lg"
                                    v-text="translate('Route type')"></label>

                                <div class="fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">

                                    <label class="d-flex flex-stack mb-5 cursor-pointer"
                                        @click="activeItem.daily_trips = 2">
                                        <span class="d-flex align-items-center me-2">
                                            <span class="symbol symbol-50px me-6">
                                                <span class="symbol-label bg-light-danger  ">
                                                    <vue-feather type="map-pin"></vue-feather>
                                                </span>
                                            </span>
                                            <span class="d-flex flex-column">
                                                <span class="fw-bold fs-6"  v-text="translate('Double trips')"></span>
                                                <span class="fs-7 text-muted"
                                                    v-text="translate('Two trips per day going and return')"></span>
                                            </span>
                                        </span>
                                        <span class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" v-model="activeItem.daily_trips" type="radio"
                                                name="daily_trips" value="2">
                                        </span>
                                    </label>

                                    <label class="d-flex flex-stack mb-5 cursor-pointer"
                                        @click="activeItem.daily_trips = 1">
                                        <span class="d-flex align-items-center me-2">
                                            <span class="symbol symbol-50px me-6">
                                                <span class="symbol-label bg-light-danger  ">
                                                    <vue-feather type="map-pin"></vue-feather>
                                                </span>
                                            </span>
                                            <span class="d-flex flex-column">
                                                <span class="fw-bold fs-6" v-text="translate('Single trip')"></span>
                                                <span class="fs-7 text-muted"
                                                    v-text="translate('One trip per day going')"></span>
                                            </span>
                                        </span>
                                        <span class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" v-model="activeItem.daily_trips" type="radio"
                                                name="daily_trips" value="1">
                                        </span>
                                    </label>

                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>

                                    <div class="pt-0">
                                        <div class="settings-form">
                                            <div class="max-w-xl mb-6 mx-auto row">
                                                <div>
                                                    <label class="col-lg-4 py-4 required font-semibold fs-6"
                                                        v-text="translate('Start date')"></label>
                                                    <input @change="dateChanged" :required="true" autocomplete="off"
                                                        name="params[start_date]" class="form-control form-control-solid"
                                                        :placeholder="translate('Start date')" type="date"
                                                        v-model="activeItem.start_date">
                                                </div>
                                                <div>
                                                    <label class="col-lg-4 py-4 required font-semibold fs-6"
                                                        v-text="translate('End date')"></label>
                                                    <input :required="true" autocomplete="off" :disabled="true"
                                                        name="params[end_date]" class="form-control form-control-solid"
                                                        :placeholder="translate('End date')" type="date"
                                                        v-model="activeItem.end_date">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="text-center mt-10"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                    @click="activeTab = 'Confirm'" v-text="translate('Next')"></a></p>
                        </div>

                        <div class="max-w-xl  mx-auto" v-if="activeTab == 'Confirm'" :key="activeTab">

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
                                            :column="{ key: 'is_paid',  column_type: 'checkbox', hide_text: true }">
                                        </form_field>
                                        <div class="pt-3">
                                            <span class="badge badge-light fw-bold me-auto px-4 py-3"
                                                v-text="activeItem.is_paid ? 'Paid' : 'Unpaid'"></span>
                                        </div>
                                    </label>
                                </div>


                                <div class="card-body p-9" v-if="activeItem.package">
                                    <div class="fs-3 fw-bold text-gray-900" v-text="activeItem.package.name"></div>
                                    <p class="text-gray-500 fw-semibold fs-5 mt-1 mb-7"
                                        v-text="activeItem.package.description"></p>
                                    
                                    <div class="mb-8 gap-4 notice d-flex bg-inverse-default rounded border-primary border border-dashed  p-6">
                                        <vue-feather type="map"></vue-feather>
                                        <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                            <div class="mb-3 mb-md-0 fw-semibold">
                                                <h4 class="text-gray-900 fw-bold" v-text="activeItem.daily_trips == 1 ? translate('Single trip') : translate('Double trips')"></h4>
                                                <div class="fs-6 text-gray-700 pe-7"  v-text="activeItem.daily_trips == 1 ? translate('Single trip per day') : translate('Two trips per day going and return')"></div>
                                            </div>
                                        </div>

                                    </div>
                                    
                                    <div class="h-4px w-100 bg-light mb-5">
                                        <div class="rounded h-4px" role="progressbar"
                                            :class="progressWidth() < 100 ? 'bg-info' : 'bg-success'"
                                            :style="{ width: progressWidth() + '%' }"></div>
                                    </div>

                                    <div class="w-full flex gap-4" v-if="activeItem.package">
                                        <div class="w-full flex gap-4">
                                            <vue-feather type="credit-card"></vue-feather>
                                            <div class="block gap-4">
                                                <span class="w-full block font-semibold"
                                                    v-text="translate('Total cost')"></span>
                                                <span class="w-full block" v-text="totalCost()"></span>
                                            </div>
                                        </div>
                                        <div class="w-full block gap-4" v-if="activeItem.start_date">
                                            <span class="w-full block font-semibold"
                                                v-text="translate('Start date')"></span>
                                            <span class="w-full block " v-text="activeItem.start_date"></span>
                                        </div>
                                        <div class="w-full block gap-4" v-if="activeItem.end_date">
                                            <div class="w-full block gap-4">
                                                <span class="w-full block font-semibold"
                                                    v-text="translate('End date')"></span>
                                                <span class="w-full block " v-text="activeItem.end_date"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="text-center mt-10"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                    @click="savePackageSubscription" v-text="translate('Submit')"></a></p>
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
import { translate, getProgressWidth, durationMonthsDate, handleRequest, deleteByKey, showAlert, handleAccess, getPositionAddress, findPlaces, getPlaceDetails } from '@/utils.vue';

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
            route_map
        },
        name: 'PackageSubscriptions',
        emits: ['callback'],
        setup(props, { emit }) {

            const loader = ref(false);
            const showEditSide = ref(false);
            const activeItem = ref({});
            const activeTab = ref(props.usertype);
            const content = ref({});
            const fillable = ref([props.usertype, 'Package', 'Subscription', 'Confirm']);
            const searchText = ref('');

            if (props.item) {
                activeItem.value = props.item
            }

            const savePackageSubscription = () => {
                loader.value =true;
                var params = new URLSearchParams();
                let array = JSON.parse(JSON.stringify(activeItem.value));
                let keys = Object.keys(array)
                let k, d, value = '';
                for (let i = 0; i < keys.length; i++) {
                    k = keys[i]
                    d = typeof array[k] === 'object' ? JSON.stringify(array[k]) : array[k]
                    params.append('params[' + k + ']', d)
                }

                let type = array.subscription_id > 0 ? 'update' : 'create';
                params.append('type', 'PackageSubscription.' + type)
                handleRequest(params, '/api/' + type).then(response => {
                    loader.value =false;
                    handleAccess(response)
                })
            }

            const back = () => {
                emit('callback');
            }


            const progressWidth = () => {
                let requiredData = ['model_id', 'package_id', 'start_date', 'payment_type', 'daily_trips', 'payment_status'];

                return getProgressWidth(requiredData, activeItem);
            }

            const checkSimilarUser = (item) => {
                let name = (item.name).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
                let email = name ? name : (item.mobile).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
                return email ? email : ((item.parent.name).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false);
            }

            const setUser = (model) => {
                activeItem.value.model_id = props.usertype == 'student' ? model.student_id :  model.customer_id;
                activeItem.value.model = model;
                activeItem.value.user_type = props.usertype;
                activeTab.value = 'Package';
                searchText.value = null;
            }

            const findUser = () => {
                for (let i = 0; i < props.userslist.length; i++) {
                    props.userslist[i].show = searchText.value.trim() ? checkSimilarUser(props.userslist[i]) : 1;
                }
            }


            const checkSimilarPackage = (item) => {
                let name = (item.name).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
                return name ? name : ((item.description).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false);
            }

            const setPackage = (packageItem) => {
                activeItem.value.package_id = packageItem.package_id;
                activeItem.value.package = packageItem;
                activeTab.value = 'Subscription';
                searchText.value = null;
            }

            const findPackage = () => {
                if (props.packages) {
                    for (let i = 0; i < props.packages.length; i++) {
                        props.packages[i].show = searchText.value.trim() ? checkSimilarPackage(props.packages[i]) : 1;
                    }
                }
            }

            const setType = (val) => {
                activeItem.value.payment_type = val;
                dateChanged()
            }

            const dateChanged = () => {

                if (!activeItem.value.start_date)
                    return null;

                let value = 0;
                if (activeItem.value.payment_type == 'month')
                    value = 1;

                if (activeItem.value.payment_type == 'quarter')
                    value = 3;

                if (activeItem.value.payment_type == 'year')
                    value = 12;

                activeItem.value.end_date = durationMonthsDate(activeItem.value.start_date, value);
            }

            const showTip = ref(false);

            const totalCost = () => {

                let priceType = (activeItem.value.daily_trips == 1) ? ('single_cost_' + activeItem.value.payment_type) : ('double_cost_' + activeItem.value.payment_type);

                activeItem.value.total_cost = activeItem.value.package[priceType];

                return activeItem.value.total_cost;
            }


            return {
                loader,
                totalCost,
                showTip,
                dateChanged,
                setType,
                findPackage,
                checkSimilarPackage,
                setPackage,
                findUser,
                setUser,
                checkSimilarUser,
                progressWidth,
                showEditSide,
                content,
                fillable,
                activeItem,
                activeTab,
                translate,
                savePackageSubscription,
                searchText,
                back
            };
        },

        props: [
            'conf',
            'path',
            'system_setting',
            'item',
            'userslist',
            'usertype',
            'packages',
        ],

    };
</script>
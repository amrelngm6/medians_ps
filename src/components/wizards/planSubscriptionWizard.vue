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
                        <div class="" v-if="activeTab == 'User'" :key="activeTab">
                            <div class="card-body pt-0 mx-auto max-w-xl" :key="userslist">
                                <div class="text-center mb-13">
                                    <h1 class="mb-3" v-text="translate('Find user')"></h1>

                                    <div class="text-gray-400 font-semibold "
                                        v-text="translate('Search by name, contact number')"></div>
                                </div>
                                <div class="w-100 relative mb-5" autocomplete="off">

                                    <vue-feather type="user"
                                        class="text-gray-500 position-absolute top-50 ms-5 translate-middle-y"></vue-feather>

                                    <input type="text" @change="findUser" @input="findUser" v-model="searchText"
                                        class="form-control form-control-lg form-control-solid px-15"
                                        :placeholder="translate('Search by name')">
                                </div>
                                <div class="w-full " v-for="usermodel in userslist" v-if="searchText">
                                    <a href="javascript:;" :key="usermodel.show" v-if="usermodel.show"
                                        class="d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1">
                                        <div class="symbol symbol-35px symbol-circle me-5"><img alt="Pic"
                                                :src="usermodel.picture"></div>
                                        <div class="fw-semibold w-full">
                                            <span class="text-lg text-danger font-semibold me-2"
                                                v-text="usermodel.name"></span>
                                            <span class="block text-gray-500 text-sm" v-text="usermodel.phone"></span>
                                        </div>
                                        <span @click="setUser(usermodel)" class="btn btn-danger btn-sm text-white"
                                            v-text="translate('Choose')"></span>
                                    </a>
                                </div>

                                <a href="javascript:;" :key="activeItem.user" v-if="activeItem.user"
                                    class="d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1">
                                    <div class="symbol symbol-35px symbol-circle me-5"><img alt="Pic"
                                            :src="activeItem.user.picture"></div>
                                    <div class="fw-semibold w-full">
                                        <span class="text-lg text-danger font-semibold me-2"
                                            v-text="activeItem.user.name"></span>
                                        <span class="block text-gray-500 text-sm" v-text="activeItem.user.phone"></span>
                                    </div>
                                </a>
                            </div>
                            <p class="text-center"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                    @click="activeTab = 'Plan'" v-text="translate('Plan')"></a></p>
                        </div>

                        <div class="" v-if="activeTab == 'Plan'" :key="activeTab">
                            <div class="card-body pt-0">
                                <div class="settings-form">
                                    <div class="max-w-xl mb-6 mx-auto row">
                                        <div class="card-body pt-0 mx-auto max-w-xl" :key="plans">

                                            <div class="text-center mb-13">
                                                <h1 class="mb-3" v-text="translate('Find Plan')"></h1>

                                                <div class="text-gray-400 font-semibold "
                                                    v-text="translate('Search by name or description')"></div>
                                            </div>
                                            <div class="w-100 relative mb-5" autocomplete="off">

                                                <vue-feather type="search"
                                                    class="text-gray-500 position-absolute top-50 ms-5 translate-middle-y"></vue-feather>

                                                <input type="text" @change="findPlan" @input="findPlan"
                                                    v-model="searchText"
                                                    class="form-control form-control-lg form-control-solid px-15"
                                                    :placeholder="translate('Search by name or description')">
                                            </div>
                                            <div class="w-full " v-for="planItem in plans" v-if="searchText">
                                                <a href="javascript:;" :key="planItem.show"
                                                    v-if="planItem && planItem.show"
                                                    class="d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1">
                                                    <div class="fw-semibold w-full">
                                                        <span class="text-lg text-danger font-semibold me-2"
                                                            v-text="planItem.name"></span>
                                                        <span class="block text-gray-500 text-sm"
                                                            v-text="planItem.description"></span>
                                                    </div>
                                                    <span @click="setPlan(planItem)"
                                                        class="btn btn-danger btn-sm text-white"
                                                        v-text="translate('Choose')"></span>
                                                </a>
                                            </div>

                                            <a href="javascript:;" :key="activeItem.plan" v-if="activeItem.plan"
                                                class="d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1 gap-4">
                                                <vue-feather type="database" ></vue-feather>
                                                <div class="fw-semibold ">
                                                    <span class="text-lg text-danger font-semibold me-2"
                                                        v-text="activeItem.plan.name"></span>
                                                    <span class="block text-gray-500 text-sm truncate"
                                                        v-text="activeItem.plan.description"></span>
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
                                    <div class="col-lg-6" @click="setType('monthly')">
                                        <input type="radio" class="btn-check" value="monthly"
                                            :checked="activeItem.type == 'monthly' ? true : false"
                                            name="type" />
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


                                    <div class="col-lg-6" @click="setType('yearly')">
                                        <input type="radio" class="btn-check" value="yearly"
                                            :checked="activeItem.type == 'yearly' ? true : false"
                                            name="type" />
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

                                
                                <div class="fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">


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
                                    <div class="card-title m-0 flex  gap-4" v-if="activeItem && activeItem.user">
                                        <div class="symbol symbol-50px w-50px bg-light">
                                            <img :src="activeItem.user.picture" alt="image" class="p-3">
                                        </div>
                                        <span class="" v-text="activeItem.user.name"></span>
                                    </div>
                                </div>


                                <div class="card-body p-9" v-if="activeItem.business">
                                    <div class="text-gray-500 fw-semibold fs-5 " v-text="translate('Business')"></div>
                                    <p class="fs-3 fw-bold text-gray-900 mt-1 mb-0" v-text="activeItem.business.business_name"></p>
                                </div>
                                    
                                <div class="card-body p-9" v-if="activeItem.plan">
                                    <div class="text-gray-500 fw-semibold fs-5 " v-text="translate('Plan')"></div>
                                    <div class="fs-3 fw-bold text-gray-900" v-text="activeItem.plan.name"></div>
                                    <p class="text-gray-500 fw-semibold fs-5 mt-1 mb-7"
                                        v-text="activeItem.plan.description"></p>
                                    
                                    <div class="h-4px w-100 bg-light mb-5">
                                        <div class="rounded h-4px" role="progressbar"
                                            :class="progressWidth() < 100 ? 'bg-info' : 'bg-success'"
                                            :style="{ width: progressWidth() + '%' }"></div>
                                    </div>

                                    <div class="w-full flex gap-4" v-if="activeItem.plan">
                                       
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
                                    @click="savePlanSubscription" v-text="translate('Submit')"></a></p>
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
        name: 'PlanSubscriptions',
        emits: ['callback'],
        setup(props, { emit }) {

            const showEditSide = ref(false);
            const activeItem = ref({});
            const activeTab = ref("User");
            const content = ref({});
            const fillable = ref(["User", 'Plan', 'Subscription', 'Confirm']);
            const searchText = ref('');

            if (props.item) {
                activeItem.value = props.item
            }

            const savePlanSubscription = () => {
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
                params.append('type', 'PlanSubscription.' + type)
                handleRequest(params, '/api/' + type).then(response => {
                    handleAccess(response)
                })
            }

            const back = () => {
                emit('callback');
            }


            const progressWidth = () => {
                let requiredData = ['user_id', 'plan_id', 'start_date', 'type'];

                return getProgressWidth(requiredData, activeItem);
            }

            const checkSimilarUser = (item) => {
                let name = (item.name).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
                return name ?? (item.phone).toLowerCase().includes(searchText.value.toLowerCase());
            }

            const setUser = (model) => {
                activeItem.value.user_id = model.id;
                activeItem.value.user = model;
                activeItem.value.user_type = props.usertype;
                activeTab.value = 'Plan';
                searchText.value = null;
            }

            const findUser = () => {
                for (let i = 0; i < props.userslist.length; i++) {
                    props.userslist[i].show = searchText.value.trim() ? checkSimilarUser(props.userslist[i]) : 1;
                }
            }


            const checkSimilarPlan = (item) => {
                let name = (item.name).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
                return name ? name : ((item.description).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false);
            }

            const setPlan = (planItem) => {
                activeItem.value.plan_id = planItem.plan_id;
                activeItem.value.plan = planItem;
                activeTab.value = 'Subscription';
                searchText.value = null;
            }

            const findPlan = () => {
                if (props.plans) {
                    for (let i = 0; i < props.plans.length; i++) {
                        props.plans[i].show = searchText.value.trim() ? checkSimilarPlan(props.plans[i]) : 1;
                    }
                }
            }

            const setType = (val) => {
                activeItem.value.type = val;
                dateChanged()
            }

            const dateChanged = () => {

                if (!activeItem.value.start_date)
                    return null;

                let value = 0;
                if (activeItem.value.type == 'monthly')
                    value = 1;

                if (activeItem.value.type == 'yearly')
                    value = 12;

                activeItem.value.end_date = durationMonthsDate(activeItem.value.start_date, value);
            }

            const showTip = ref(false);


            return {
                showTip,
                dateChanged,
                setType,
                findPlan,
                checkSimilarPlan,
                setPlan,
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
                savePlanSubscription,
                searchText,
                back
            };
        },

        props: [
            'conf',
            'path',
            'system_setting',
            'business_setting',
            'item',
            'userslist',
            'usertype',
            'plans',
        ],

    };
</script>
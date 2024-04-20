<template>
    <div class="d-flex flex-column flex-column-fluid">

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content  flex-column-fluid ">

            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container  container-xxl relative">
                <close_icon class="absolute top-4 right-4 z-10 cursor-pointer" @click="back" />

                <!--begin::Invoice 2 main-->
                <div class="card">
                    <!--begin::Body-->
                    <div class="card-body py-lg-20">
                        <!--begin::Layout-->
                        <div class="d-flex flex-column flex-xl-row">
                            <!--begin::Content-->
                            <div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
                                <div class="mt-n1">
                                    <div class="d-flex flex-stack pb-10" >
                                        <a href="#" v-if="business_setting">
                                            <img alt="Logo" class="w-250px" :src="business_setting['logo'] ?? system_setting.logo">
                                        </a>
                                    </div>
                                    <div class="m-0">
                                        
                                        <div class="fw-bold fs-3 text-gray-800 mb-8" v-text="translate('Withdrawal request')+' #'+activeItem.withdrawal_id"> </div>
                                        <div class="row g-5 mb-11">
                                            <div class="col-sm-6">
                                                <div class="fw-semibold fs-7 text-gray-600 mb-1" v-text="translate('Sent Date')"></div>
                                                <div class="fw-bold fs-6 text-gray-800" v-text="activeItem.date"></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="fw-semibold fs-7 text-gray-600 mb-1" v-text="translate('Due Date')"></div>
                                                <div class="fw-bold fs-6 text-gray-800 d-flex align-items-center flex-wrap">
                                                    <input type="date"  v-model="activeItem.due_date" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-125px " :placeholder="translate('Due date for proceed')">
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->

                                        <!--begin::Row-->
                                        <div class="row g-5 mb-12">
                                            <!--end::Col-->
                                            <div class="col-sm-6" v-if="activeItem.business">
                                                
                                                <div class="fw-semibold fs-7 text-gray-600 mb-1" v-text="translate('Issue For')"></div>
                                                
                                                <!--end::Text-->
                                                <div class="flex gap-2" >
                                                    <img :src="activeItem.business.picture" class="w-10 h-10" />
                                                    <div class="fw-bold fs-6 text-gray-800">
                                                        <div class="text-gray-800" v-text="activeItem.business.business_name"></div>
                                                        <div class="text-gray-800 fs-normal" v-text="activeItem.business.type"></div>
                                                    </div>
                                                </div>
                                                <!--end::Text-->

                                                <!--end::Description-->
                                                <div class="fw-semibold fs-7 text-gray-600" >
                                                    <span v-text="activeItem.user.field.address"></span>
                                                    <span v-text="activeItem.user.field.country"></span>
                                                </div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Col-->

                                            <!--end::Col-->
                                            <div class="col-sm-6">
                                                
                                                <div class="fw-semibold fs-7 text-gray-600 mb-1" v-text="translate('Issued By')"></div>
                                                

                                                <!--end::Text-->
                                                <div class="flex gap-2" v-if="business_setting && activeItem.business">
                                                    <img :src="business_setting.logo" class="w-10 h-10" />
                                                    <div class="fw-bold fs-6 text-gray-800">
                                                        <div class="text-gray-800" v-text="activeItem.business.name"></div>
                                                    </div>
                                                </div>

                                                <!--end::Description-->
                                                <div class="fw-semibold fs-7 text-gray-600"  v-if="business_setting" v-text="business_setting.address"></div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Invoice 2 content-->
                            </div>
                            <!--end::Content-->

                            <!--begin::Sidebar-->
                            <div class="m-0">
                                <!--begin::Invoice 2 sidebar-->
                                <div v-if="activeItem.transaction"
                                    class="d-print-none border border-dashed border-gray-300 card-rounded h-lg-100 min-w-md-350px p-9 bg-lighten">
                                    <!--begin::Labels-->
                                    <div class="mb-8">
                                        <span class="badge badge-light-success me-2" v-text="activeItem.status"></span>
                                    </div>
                                    <!--end::Labels-->

                                    <!--begin::Title-->
                                    <h6 class="mb-8 fw-bolder text-gray-600 text-hover-primary" v-text="translate('PAYMENT DETAILS')"></h6>
                                    <!--end::Title-->

                                    <!--begin::Item-->
                                    <div class="mb-6">
                                        <div class="fw-semibold text-gray-600 fs-7" v-text="translate('payment method')"></div>

                                        <div class="fw-bold text-gray-800 fs-6" v-text="activeItem.transaction.payment_method"></div>
                                    </div>
            
                                    <!--begin::Item-->
                                    <div class="mb-6">
                                        <div class="fw-semibold text-gray-600 fs-7" v-text="translate('Transaction number')"></div>

                                        <div class="fw-bold text-gray-800 fs-6" v-text="activeItem.transaction.transaction_id"></div>
                                    </div>
            
                                    <!--begin::Item-->
                                    <div class="mb-6">
                                        <div class="fw-semibold text-gray-600 fs-7" v-text="translate('Total amount')"></div>

                                        <div class="fw-bold text-gray-800 fs-6" v-text="activeItem.transaction.amount+''+system_setting.currency"></div>
                                    </div>
                                    
                                    <!--begin::Item-->
                                    <div class="mb-6">
                                        <div class="fw-semibold text-gray-600 fs-7" v-text="translate('Status')"></div>

                                        <div class="fw-bold text-gray-800 fs-6" v-text="activeItem.transaction.status"></div>
                                    </div>
            
                                    <h6 class="mb-8 fw-bolder text-gray-600 text-hover-primary" v-text="translate('Billing info')"></h6>

                                    <!--begin::Item-->
                                    <div class="mb-6">
                                        <div class="fw-semibold text-gray-600 fs-7" v-text="translate('Payer name')"></div>

                                        <div class="fw-bold text-gray-800 fs-6" v-text="activeItem.transaction.field.payer_first_name"></div>
                                    </div>

                                    <!--begin::Item-->
                                    <div class="mb-6">
                                        <div class="fw-semibold text-gray-600 fs-7" v-text="translate('Payer email')"></div>

                                        <div class="fw-bold text-gray-800 fs-6" v-text="activeItem.transaction.field.payer_email"></div>
                                    </div>
                                    
                                    <div class="m-0">
                                        <div class="fw-semibold text-gray-600 fs-7" v-text="translate('Order id')"></div>
                                        
                                        <div class="fw-bold text-gray-800 fs-6" v-text="activeItem.transaction.field.order_id"></div>
                                    </div>
                                    
                                    <div class="m-0">
                                        <div class="fw-semibold text-gray-600 fs-7" v-text="translate('Date')"></div>

                                        <div class="fw-bold fs-6 text-gray-800 d-flex align-items-center" v-text="activeItem.date"> 
                                        </div>
                                    </div>
            
                                </div>
                                <!--end::Invoice 2 sidebar-->
                            </div>
                            <!--end::Sidebar-->
                        </div>
                        <!--end::Layout-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Invoice 2 main-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->

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
            route_map,
        },
        name: 'PackageSubscriptions',
        emits: ['callback'],
        setup(props, { emit }) {

            const showEditSide = ref(false);
            const activeItem = ref({});
            const activeTab = ref('Business');
            const content = ref({});
            const fillable = ref(['Business', 'Payment', 'Confirm']);
            const searchText = ref('');

            console.log(props.business_setting);

            if (props.item) {
                activeItem.value = props.item
            }

            const savePackageSubscription = () => {
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
                    handleAccess(response)
                })
            }

            const back = () => {
                emit('callback');
            }





            return {
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
            'business_setting',
            'item',
            'userslist',
            'usertype',
            'packages',
        ],

    };
</script>
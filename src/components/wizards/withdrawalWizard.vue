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
                                    
                                    <div class="m-0">
                                        
                                        <div class="fw-bold fs-3 text-gray-800 mb-8" v-text="translate('Withdrawal request')+' #'+activeItem.withdrawal_id"> </div>
                                        <div class="row g-5 mb-11">
                                            
                                            <div class="col-sm-4">
                                                <div class="flex gap-2" v-if="activeItem.user" >
                                                    <img :src="activeItem.user.picture" class="w-10 h-10" />
                                                    <div class="fw-bold fs-2 text-gray-800">
                                                        <div class="text-gray-800 fs-bold" v-text="activeItem.user.name"></div>
                                                        <div class="text-gray-800 fs-normal" v-text="activeItem.user.mobile"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="fw-semibold fs-4 text-gray-600 mb-1" v-text="translate('Sent Date')"></div>
                                                <div class="fw-bold fs-2 text-gray-800" v-text="activeItem.date"></div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="fw-semibold fs-4 text-gray-600 mb-1" v-text="translate('Due Date')"></div>
                                                <div class="fw-bold fs-2 text-gray-800 d-flex align-items-center flex-wrap">
                                                    <input type="date"  v-model="activeItem.due_date" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-125px " :placeholder="translate('Due date for proceed')">
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Invoice 2 content-->
                                <div class="w-full flex gap-4">
                                        
                                    <!--begin::Invoice 2 sidebar-->
                                    <div v-if="activeItem.wallet"
                                        class="w-full d-print-none border border-dashed border-gray-300 card-rounded h-lg-100 min-w-md-350px p-9 bg-lighten">
                                        <h6 class="mb-8 fw-bolder text-gray-600 text-hover-primary" v-text="translate('Wallet Details')"></h6>

                                        <div class="mb-6">
                                            <div class="fw-semibold text-gray-600 fs-4" v-text="translate('Current balance')"></div>
                                            <div class="fw-bold text-gray-800 fs-2" v-text="currency.symbol+''+activeItem.wallet.credit_balance"></div>
                                        </div>

                                        <div class="mb-6">
                                            <div class="fw-semibold text-gray-600 fs-4" v-text="translate('Debit balance')"></div>
                                            <div class="fw-bold text-red-800 fs-2" v-text="currency.symbol+''+activeItem.wallet.debit_balance"></div>
                                        </div>
                
                                        <h6 class="mb-2 mt-4 fw-bolder text-gray-600 text-hover-primary" v-text="translate('Request Details')"></h6>

                                        <div class="mb-6">
                                            <div class="fw-semibold text-gray-600 fs-4" v-text="translate('Total amount')"></div>
                                            <div class="fw-bold text-gray-800 fs-2" v-if="system_setting" v-text="currency.symbol+''+activeItem.amount"></div>
                                        </div>
                                        
                                        <div class="mb-6">
                                            <div class="fw-semibold text-gray-600 fs-4" v-text="translate('Status')"></div>
                                            <div class="fw-bold text-gray-800 fs-2" v-text="translate(activeItem.status)"></div>
                                        </div>
                                    </div>
                                    
                                    <div v-if="activeItem.field"
                                        class="w-full  d-print-none border border-dashed border-gray-300 card-rounded h-lg-100 min-w-md-350px p-9 bg-lighten">
                                        <h6 class="mb-8 fw-bolder text-gray-600 text-hover-primary" v-text="translate('Payment Details')"></h6>
                
                                        <div class="mb-6">
                                            <div class="fw-semibold text-gray-600 fs-4" v-text="translate('payment method')"></div>
                                            <div class="fw-bold text-gray-800 fs-2" v-text="activeItem.payment_method"></div>
                                        </div>
                
                                        <div class="mb-6" v-for="(field, key) in activeItem.field">
                                            <div v-if="field">
                                                <div class="fw-semibold text-gray-600 fs-4" v-text="translate(key)"></div>
                                                <div class="fw-bold text-gray-800 fs-2" v-text="field"></div>
                                            </div>
                                        </div>
                                    </div>
                
                                    <!--end::Invoice 2 sidebar-->
                                </div>
                            </div>                            
                        </div>
                        
                        <div class="mx-auto flex gap-6 w-500px py-2 text-gray-200 pt-8"  >
                            <div class="text-center"  v-if="activeItem.status == 'pending'"><a href="javascript:;"
                                class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-primary"
                                @click="approveItem" v-text="translate('Approved')"></a> - </div>
                            <div v-if="activeItem.status == 'approved' || activeItem.status == 'pending'" class="text-center"><a href="javascript:;"
                                class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-info"
                                @click="confirmItem" v-text="translate('Set as done')"></a> - </div>
                            <div class="text-center" v-if="activeItem.status == 'pending'"><a href="javascript:;"
                                class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                @click="rejectItem" v-text="translate('Reject')"></a></div>
                        </div>
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
        },
        name: 'PackageSubscriptions',
        emits: ['callback'],
        setup(props, { emit }) {

            const showEditSide = ref(false);
            const activeItem = ref({});
            const content = ref({});
            const searchText = ref('');

            if (props.item) {
                activeItem.value = props.item
            }

            const back = () => {
                emit('callback');
            }

            const saveItem = () => {
                var params = new URLSearchParams();
                let array = JSON.parse(JSON.stringify(activeItem.value));
                let keys = Object.keys(array)
                let k, d, value = '';
                for (let i = 0; i < keys.length; i++) {
                    k = keys[i]
                    d = typeof array[k] === 'object' ? JSON.stringify(array[k]) : array[k]
                    params.append('params[' + k + ']', d)
                }
                params.append('type', 'Withdrawal.update' )
                handleRequest(params, '/api/update').then(response => {
                    handleAccess(response)
                })
            }

            const confirmItem = () => {
                if (activeItem.value.status == 'done') {
                    showAlert(translate('Already approved'));
                    return;
                }
                if (window.confirm(translate('Confirm and set request as done'))) {
                    activeItem.value.status = 'done';
                    saveItem();
                }
            }

            const rejectItem = () => {
                if (window.confirm(translate('Confirm to reject this request'))) {
                    activeItem.value.status = 'rejected';
                    saveItem();
                }
            }
            
            const approveItem = () => {
                if (window.confirm(translate('Approve this item until it is done'))) {
                    activeItem.value.status = 'approved';
                    saveItem();
                }
            }


            return {
                approveItem,
                rejectItem,
                confirmItem,
                content,
                activeItem,
                translate,
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
            'currency'
        ],

    };
</script>
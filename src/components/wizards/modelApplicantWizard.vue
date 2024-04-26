<template>
    <div class="w-full flex overflow-auto">
        <div class=" w-full relative">
            <close_icon class="absolute top-4 right-4 z-10 cursor-pointer" @click="back" />
            <div class=" card w-full py-10">
                <div class="w-full stepper stepper-links ">
                    
                    <div class="w-full" v-if="activeItem">
                        <div class="" >
                            <div class="card-body pt-0 mx-auto " :key="activeItem">

                                <div class="flex w-full gap-6 ">
                                    <div class="w-full" v-if="activeItem.model">
                                        <static_map  v-if="activeItem.model.route_location" :system_setting="system_setting" :item="activeItem.model.route_location"
                                                    :key="activeItem" :conf="conf"
                                                    ></static_map>
                                    </div>
                                    <div class="card w-full">
                                        <div class="card-header">
                                            
                                            <div class="card-title m-0 flex  gap-4" v-if="activeItem.model">
                                                <div class="bg-light overflow-hidden rounded-full symbol-50px w-50px">
                                                    <img :src="activeItem.model.picture" alt="image" class="h-10 w-10">
                                                </div>
                                                <div class="w-full ">
                                                    <h5 class="text-sm mb-0" v-text="translate('Customer Info')"></h5>
                                                    <div class="font-bold" v-text="activeItem.model.name"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive table-card">
                                                <table class="table table-borderless align-middle mb-0 w-full">
                                                    <tbody  v-if="activeItem.model">
                                                        
                                                        <tr>
                                                            <td class="fw-medium py-2" v-text="translate('ID')"></td>
                                                            <td class="py-2">#<span id="t-no" v-text="activeItem.applicant_id"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium py-2" v-text="translate('First Name')"></td>
                                                            <td id="t-client" class="py-2" v-text="activeItem.model.name"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium py-2" v-text="translate('Mobile')"></td>
                                                            <td id="d-date" class="py-2" v-text="activeItem.model.mobile"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium py-2" v-text="translate('email')"></td>
                                                            <td id="d-date" class="py-2" v-text="activeItem.model.email"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium py-2" v-text="translate('gender')"></td>
                                                            <td id="d-date" class="py-2" v-text="activeItem.model.gender"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-bold py-2" ><span class="font-bold text-lg" v-text="translate('Application info')"></span></td>
                                                            <td class="font-bold py-2" ><hr /></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium py-2" v-text="translate('Message')"></td>
                                                            <td id="d-date" class="py-2 font-bold" v-text="activeItem.message"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium py-2" v-text="translate('Status')"></td>
                                                            <td id="d-date" class="py-2 font-bold" v-text="activeItem.status"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-bold py-2" ><span class="font-bold text-lg" v-text="translate('Subscription info')"></span></td>
                                                            <td class="font-bold py-2" ><hr /></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium py-2" v-text="translate('Package')"></td>
                                                            <td id="d-date" class="py-2 font-bold" v-if="activeItem.subscription && activeItem.subscription.package" v-text="activeItem.subscription.package.name"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium py-2" v-text="translate('total_cost')"></td>
                                                            <td id="d-date" class="py-2 font-bold" v-if="activeItem.subscription" v-text="activeItem.subscription.total_cost"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium py-2" v-text="translate('payment_type')"></td>
                                                            <td id="d-date" class="py-2 font-bold" v-if="activeItem.subscription" v-text="activeItem.subscription.payment_type"></td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-auto flex gap-6 w-300px py-2" v-if="activeItem.status == 'new'">
                                
                                <div class="text-center"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                    @click="confirmItem" v-text="translate('Approve')"></a></div>
                                <div class="text-center"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center rounded-lg border-1 border-dark text-dark"
                                    @click="rejectItem" v-text="translate('Reject')"></a></div>
                            </div>
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
import static_map from '@/components/maps/static_map.vue';
import tooltip from '@/components/includes/tooltip.vue';

export default
    {
        components: {
            'datatabble': Vue3EasyDataTable,
            SideFormCreate,
            SideFormUpdate,
            close_icon,
            delete_icon,
            car_icon,
            form_field,
            static_map,
            dashboard_card_white,
            tooltip,
        },
        name: 'Route trips',
        emits: ['callback'],
        setup(props, { emit }) {

            const showAddSide = ref(false);
            const showEditSide = ref(false);
            const activeItem = ref({});
            const activeTab = ref('Info');
            const content = ref({});
            const center = ref({});
            const fillable = ref(['Info', 'Confirm']);

            if (props.item) {
                activeItem.value = props.item
                activeItem.value.date = props.item.date ?? today()
            } else {
                activeItem.value.date = today()
            }

            const users = (props.userslist) ? ref(props.userslist) : ref([]);

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
                params.append('type', 'BusinessApplicant.update' )
                handleRequest(params, '/api/update').then(response => {
                    handleAccess(response)
                })
            }


            const back = () => {
                emit('callback');
            }

            const confirmItem = () => {
                if (window.confirm(translate('Confirm and add subscription to your business'))) {
                    activeItem.value.status = 'approved';
                    saveItem();
                }
            }

            const rejectItem = () => {
                if (window.confirm(translate('Confirm and reject this member'))) {
                    activeItem.value.status = 'rejected';
                    saveItem();
                }
            }


            const progressWidth = () => {
                let requiredData = ['driver_id', 'status'];

                return getProgressWidth(requiredData, activeItem);
            }


            return {
                users,
                progressWidth,
                showAddSide,
                showEditSide,
                content,
                fillable,
                center,
                activeItem,
                activeTab,
                rejectItem,
                confirmItem,
                translate,
                formatCustomTime,
                saveItem,
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
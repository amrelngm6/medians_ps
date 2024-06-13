<template>
    <div class="w-full flex overflow-auto">
        <div v-if="loader" :key="loader" class="bg-white fixed w-full h-full top-0 left-0" style="z-index:99999; opacity: .9;">
            <img class="m-auto w-500px" :src="'/uploads/loader.gif'" />
        </div>
        <div class=" w-full relative">
            <close_icon class="absolute top-4 right-4 z-10 cursor-pointer" @click="back" />
            <div class=" card w-full py-10">
                <div class="w-full stepper stepper-links ">
                    
                    <div class="w-full" v-if="activeItem">
                        <div class="" >
                            <div class="card-body pt-0 mx-auto max-w-xl" :key="users">

                                <div class="max-w-xxl mx-auto ">
                                    <div class="card">
                                        <div class="card-header">
                                            
                                            <div class="card-title m-0 flex  gap-4" v-if="activeItem.driver">
                                                <div class="bg-light overflow-hidden rounded-full symbol-50px w-50px">
                                                    <img :src="activeItem.driver.picture" alt="image" class="">
                                                </div>
                                                <div class="w-full ">
                                                    <h5 class="text-sm mb-0" v-text="translate('Driver Info')"></h5>
                                                    <div class="font-bold" v-text="activeItem.driver.name"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive table-card">
                                                <table class="table table-borderless align-middle mb-0 w-full">
                                                    <tbody  v-if="activeItem.driver">
                                                        
                                                        <tr>
                                                            <td class="fw-medium py-2" v-text="translate('ID')"></td>
                                                            <td class="py-2">#<span id="t-no" v-text="activeItem.applicant_id"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium py-2" v-text="translate('First Name')"></td>
                                                            <td id="t-client" class="py-2" v-text="activeItem.driver.first_name"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium py-2" v-text="translate('Last Name')"></td>
                                                            <td id="t-client" class="py-2" v-text="activeItem.driver.last_name"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium py-2" v-text="translate('Mobile')"></td>
                                                            <td id="d-date" class="py-2" v-text="activeItem.driver.mobile"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium py-2" v-text="translate('email')"></td>
                                                            <td id="d-date" class="py-2" v-text="activeItem.driver.email"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium py-2" v-text="translate('License number')"></td>
                                                            <td id="d-date" class="py-2" v-text="activeItem.driver.driver_license_number"></td>
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
                                                            <td class="fw-medium py-2" v-text="translate('Created at')"></td>
                                                            <td id="d-date" class="py-2" v-text="activeItem.created_at"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium py-2" v-text="translate('Last update')"></td>
                                                            <td id="d-date" class="py-2" v-text="activeItem.updated_at"></td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-auto flex gap-6 w-300px">
                                
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
import editable_map_location from '@/components/includes/editable_map_location.vue';
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
            const fillable = ref(['Info', 'Confirm']);

            if (props.item) {
                activeItem.value = props.item
                activeItem.value.date = props.item.date ?? today()
            } else {
                activeItem.value.date = today()
            }

            const users = (props.userslist) ? ref(props.userslist) : ref([]);

            const saveItem = () => {
                loader.value = true
                var params = new URLSearchParams();
                let array = JSON.parse(JSON.stringify(activeItem.value));
                let keys = Object.keys(array)
                let k, d, value = '';
                for (let i = 0; i < keys.length; i++) {
                    k = keys[i]
                    d = typeof array[k] === 'object' ? JSON.stringify(array[k]) : array[k]
                    params.append('params[' + k + ']', d)
                }
                params.append('type', 'DriverApplicant.update' )
                handleRequest(params, '/api/update').then(response => {
                    loader.value = false
                    handleAccess(response)
                })
            }


            const back = () => {
                emit('callback');
            }

            const confirmItem = () => {
                if (window.confirm(translate('Confirm and add driver to your team'))) {
                    activeItem.value.status = 'approved';
                    saveItem();
                }
            }

            const rejectItem = () => {
                if (window.confirm(translate('Confirm and reject this driver'))) {
                    activeItem.value.status = 'rejected';
                    saveItem();
                }
            }


            const progressWidth = () => {
                let requiredData = ['driver_id', 'status'];

                return getProgressWidth(requiredData, activeItem);
            }


            return {
                loader,
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
            'setting',
            'item',
            'userslist',
            'usertype',
            'drivers',
            'vehicles',
        ],

    };
</script>
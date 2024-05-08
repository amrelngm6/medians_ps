<template>
    <div class="w-full ">
        
        <div v-if="loader" :key="loader" class="bg-white fixed w-full h-full top-0 left-0" style="z-index:99999; opacity: .9;">
            <img class="m-auto w-500px" :src="'/uploads/loader.gif'" />
        </div>
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
                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6" v-text="translate('Event title')" ></label>
                                            <input :required="true" autocomplete="off" name="params[title]" class="form-control form-control-solid" :placeholder="translate('Event title')" type="text" v-model="activeItem.title">
                                            <hr class="block mt-6 my-2 opacity-10" />

                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6" v-text="translate('Receiver model')" ></label>
                                            <input :required="true" autocomplete="off" :placeholder="translate('Receiver model')" v-model="activeItem.receiver_model" name="params[receiver_model]" class="form-control form-control-solid" type="text">
                                            <hr class="block mt-6 my-2 opacity-10" />

                                            <label  v-text="translate('Model')" class="col-lg-4 col-form-label required fw-semibold fs-6" ></label>
                                            <input :placeholder="translate('Model')" v-model="activeItem.model" name="params[model]" :required="true" autocomplete="off" class="form-control form-control-solid" type="text">
                                            <hr class="block mt-6 my-2 opacity-10" />

                                        </div>
                                    </div>
                                </div>
                                <p class="text-center mt-10"><a href="javascript:;" class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger" @click="activeTab = 'Confirm'" v-text="translate('Next')"></a></p>
                            </div>

                            <div class="" v-if="activeTab == 'Cost'" :key="activeTab">
                                <div class="card-body pt-0"  >
                                    <div class="settings-form" >
                                        <div class="max-w-xl mb-6 mx-auto row" >

                                            <label  v-text="translate('Action field')" class="col-lg-4 col-form-label required fw-semibold fs-6" ></label>
                                            <input :placeholder="translate('Action field if model updated')" v-model="activeItem.action_field" name="params[action_field]" :required="true" autocomplete="off" class="form-control form-control-solid" type="text">
                                            <hr class="block mt-6 my-2 opacity-10" />

                                            <div v-if="activeItem.action_field != ''">
                                                <label  v-text="translate('Action value')" class="col-lg-4 col-form-label required fw-semibold fs-6" ></label>
                                                <input :placeholder="translate('Action value if action field filled')" v-model="activeItem.action_value" name="params[action_value]" :required="true" autocomplete="off" class="form-control form-control-solid" type="text">
                                                <hr class="block mt-6 my-2 opacity-10" />
                                            </div>

                                                        <!-- 
			[ 'key'=> "action", 'title'=> translate('Action'), 'withLabel'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title',  'required'=> true, 'data'=>[
				['action'=>'create','title'=>translate('On Create')],
				['action'=>'update','title'=>translate('On Update')],
				['action'=>'delete','title'=>translate('On delete')],
			] ],
			[ 'key'=> "action_field", 'title'=> translate('action_field'), 'fillable'=> true, 'column_type'=>'text' ],
			[ 'key'=> "action_value", 'title'=> translate('action_value'), 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "subject", 'title'=> translate('subject'), 'fillable'=> true, 'column_type'=>'text', 'required'=> true ],
			[ 'key'=> "template_id", 'title'=> translate('Email template'), 'withLabel'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title',  'required'=> true, 
				'data'=> $this->emailTemplatesRepo->get()
			],
            [ 'key'=> "body_text", 'title'=> translate('Notification text'), 'fillable'=> true, 'column_type'=>'textarea', 'required'=> true ],
            [ 'key'=> "status", 'title'=> translate('Status'), 'fillable'=> true, 'column_type'=>'checkbox' ],
             -->
                                        </div>
                                    </div>
                                </div>
                                <p class="text-center mt-10"><a href="javascript:;" class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger" @click="activeTab = 'Confirm'" v-text="translate('Next')"></a></p>
                            </div>

                            <div class="w-full  mx-auto" v-if="activeTab == 'Confirm'" :key="activeTab">
                                
                                <div class="w-full flex gap-10">
                                    <div class="w-full">
                                        <trip_map @markerclicked="markerClicked" class="rounded-xl shadow-md mx-4" :system_setting="system_setting" :conf="conf" :trip="activeItem"  />
                                    </div>
                                    <div class="w-full">
                                        <hr class="block mt-6 my-2 opacity-10" />
                                        <div class="bg-gray-200 shadow-md mb-10 rounded-xl">
                                            <div class="card-header border-0 pt-9">
                                                <div class="card-title m-0 flex  gap-4" v-if="activeItem.model">
                                                    <div class="symbol symbol-50px w-50px bg-light">
                                                        <img  :src="activeItem.model.picture" alt="image" class="p-3" >
                                                    </div>
                                                    <div class="w-full ">
                                                        <div class="font-semibold" v-text="activeItem.model.name"></div>
                                                        <div class="" v-text="activeItem.model.mobile"></div>
                                                    </div>
                                                </div>
                                                <label class=" flex gap-2 cursor-pointer">
                                                    <div class="pt-3">
                                                        <span class="relative badge badge-light fw-bold me-auto px-4 py-3" >
                                                            <form_field class="flex-end" :item="activeItem"
                                                                :column="{ key: 'status', title: translate('Status'), column_type: 'select', text_key:'title', 
                                                                data: tripsStatusList,  hide_text:true }">
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
                                                        <div class="timeline-icon me-4"><vue-feather type="circle" class="fs-2 text-success"></vue-feather></div>

                                                        <div class="timeline-content mb-10 mt-n2">
                                                            <div class="overflow-auto pe-3">
                                                                <div class="fs-5 fw-semibold mb-2" v-if="activeItem" v-text="activeItem.pickup_address"></div>

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
                                                                <div class="fs-5 fw-semibold mb-2" v-if="activeItem" v-text="activeItem.destination_address"></div>

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
                                                
                                                <div class="w-full flex gap-4" v-if="activeItem">
                                                    
                                                    <div class="flex gap-4 min-w-250px  " v-if="activeItem.driver">
                                                        <img :src="activeItem.driver.picture" class="rounded-full bg-white border-1 border border-gray-600 p-1 w-12 h-12" />
                                                        <div class="block gap-4 w-full">
                                                            <span class="w-full block font-semibold" v-text="translate('Driver')"></span>
                                                            <span class="w-full block" v-text="activeItem.driver.name"></span>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="w-150px flex gap-4" v-if="activeItem.vehicle">
                                                        <car_icon />
                                                        <div class="block gap-4">
                                                            <span class="w-full block font-semibold" v-text="translate('Vehicle')"></span>
                                                            <span class="w-full block" v-text="activeItem.vehicle.plate_number"></span>
                                                        </div>
                                                    </div>

                                                    <div class="w-125px flex-end" v-if="activeItem.date">
                                                        <span class="w-full block font-semibold" v-text="translate('Trip date')"></span>
                                                        <div class="w-full flex gap-4">
                                                            <span class=" " v-text="activeItem.date"></span>
                                                            <span class=" " v-text="activeItem.start_time"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex gap-6 pb-4 font-semibold text-lg">
                                                
                                            <div class="flex gap-6 w-full">
                                                <div v-text="translate('Subtotal')"></div>
                                                <div v-text="currency.symbol +''+ activeItem.subtotal"></div>
                                            </div>

                                            <div class="flex gap-6 w-full">
                                                <div v-text="translate('Discount')"></div>
                                                <div v-text="currency.symbol +''+ activeItem.discount_amount"></div>
                                            </div>

                                            <div class="flex gap-6 w-full">
                                                <div v-text="translate('Total cost')"></div>
                                                <div v-text="currency.symbol +''+ activeItem.total_cost"></div>
                                            </div>

                                        </div>

                                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-12 p-6 gap-4"><i class="vue-feather vue-feather--alert-octagon ki-duotone ki-information fs-2tx text-warning me-4" data-name="alert-octagon" data-tags="warning,alert,danger" data-type="alert-octagon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon vue-feather__content"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg></i><div class="d-flex flex-stack flex-grow-1"><div class="fw-semibold"><h4 class="text-gray-900 fw-bold" v-text="translate(activeItem.payment_status)"></h4><div class="fs-6 text-gray-700">
                                                <div v-text="translate('Payment status')"></div>
                                        </div></div></div></div>
                                    </div>
                                </div>
                                <p class="text-center mt-10"><a href="javascript:;" class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger" @click="saveTrip" v-text="translate('Submit')"></a></p>
                            </div>

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

import 'vue3-easy-data-table/dist/style.css';
import Vue3EasyDataTable from 'vue3-easy-data-table';

import { defineAsyncComponent, getCurrentInstance, ref } from 'vue';
import { translate, getProgressWidth, handleRequest, deleteByKey, showAlert, handleAccess, getPositionAddress, findPlaces, getPlaceDetails,today } from '@/utils.vue';

const form_field = defineAsyncComponent(() =>
    import('@/components/includes/form_field.vue')
);
import tooltip from '@/components/includes/tooltip.vue';

export default
    {
        components: {
            'datatabble': Vue3EasyDataTable,
            delete_icon,
            close_icon,
            form_field,
            tooltip,
        },
        name: 'Taxi trips',
        emits: ['callback'],
        setup(props, { emit }) {

            const loader = ref(false);
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
            const fillable = ref(["Info", 'Content', 'Fields',  'Confirm']);
            const places = ref([]);
            const showPlaceSearch = ref(false);
            const pickup_placeSearch = ref('');
            const destination_placeSearch = ref('');
            const tripsStatusList = ref([
                {title: translate("Active"), status: 'on'},
                {title:translate("Pending"), status: 0},
            ]);

            if (props.active_tab) {
                activeTab.value = props.active_tab;
            }
            if (props.item) {
                activeItem.value = props.item
            }

            const saveEvent = () => {
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
                let type = array.trip_id > 0 ? 'update' : 'create';
                params.append('type', 'NotificationEvent.' + type)
                
                const currentInstance =  getCurrentInstance();

                if (currentInstance)
                    currentInstance.root.data.loader = true;
    
                handleRequest(params, '/api/' + type).then(response => {
                    handleAccess(response)
                    loader.value = false;
                })
            }

            
            const back = () => {
                emit('callback');
            }

            const progressWidth = () => 
            {
                let requiredData = ['template_id', 'title', 'receiver_model','status'];
                
                return getProgressWidth(requiredData, activeItem);
            }

            return {
                loader,
                progressWidth,
                content,
                fillable,
                activeItem,
                activeTab,
                translate,
                searchText,
                collapsed,
                saveEvent,
                back
            };
        },

        props: [
            'conf',
            'path',
            'system_setting',
            'item',
            'active_tab',
        ],

    };
</script>
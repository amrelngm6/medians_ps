<template>
    <div class="w-full flex overflow-auto">
        <div class=" w-full relative">
            
            
        <div class="modal fade show" v-if="showModal" :key="showModal" id="kt_modal_adjust_balance" tabindex="-1" aria-modal="true" role="dialog" data-select2-id="select2-data-kt_modal_adjust_balance" style="background: rgba(0,0,0,.5);display: block;z-index: 9999;">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-650px" data-select2-id="select2-data-134-3oj8">
                <!--begin::Modal content-->
                <div class="modal-content" data-select2-id="select2-data-133-wj88">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bold" v-text="translate('Field details')"></h2>

                    </div>

                    <div class="modal-body mx-5 mx-xl-15 my-7"   v-if="activeItem.fields[activeField]">
                        <div class="w-full row">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6"
                                v-text="translate('Field title')"></label>
                            <input :required="true" autocomplete="off" 
                                class="form-control form-control-solid"
                                :placeholder="translate('Title of the field')" type="text"
                                v-model="activeItem.fields[activeField].title">
                        </div>
                        
                        <div class="w-full row">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6"
                                v-text="translate('Field code')"></label>
                            <input :required="true" autocomplete="off" 
                                class="form-control form-control-solid"
                                :placeholder="translate('Code of the field')" type="text"
                                v-model="activeItem.fields[activeField].code">
                        </div>
                        
                        <div class="w-full row">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6"
                                v-text="translate('Field type')"></label>
                            <select 
                                class="form-control form-control-solid"
                                :placeholder="translate('Type of the field')" type="number"
                                v-model="activeItem.fields[activeField].type">
                                <option value="text" v-text="translate('Text')"></option>
                                <option value="number" v-text="translate('Number')"></option>
                                <option value="email" v-text="translate('Email')"></option>
                                <option value="phone" v-text="translate('Phone')"></option>
                                <option value="textarea" v-text="translate('Textarea')"></option>
                            </select>
                        </div>
                        
                        <div class="text-center">
                            <button type="reset" id="kt_modal_adjust_balance_cancel" class="btn btn-light me-3" v-text="translate('Discard')" @click="showModal = false"></button>

                            <button @click="showModal = false" type="submit" id="kt_modal_adjust_balance_submit" class="btn btn-primary">
                                <span class="indicator-label" v-text="translate('Submit')"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            

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
                            <div class="card-body pt-0">
                                <div class="settings-form">
                                    <div class="max-w-xl mb-6 mx-auto row">

                                        <input name="params[payment_method_id]" type="hidden">

                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6" :for="'input' + i"
                                            v-text="translate('Name')"></label>
                                        <input :required="true" autocomplete="off" name="params[name]"
                                            class="form-control form-control-solid" :placeholder="translate('Payment method name')"
                                            v-model="activeItem.name">
                                        <hr class="block mt-6 my-2 opacity-10" />
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6" :for="'input' + i"
                                            v-text="translate('Description')"></label>
                                        <textarea :required="true" autocomplete="off" name="params[description]"
                                            class="form-control form-control-solid" :placeholder="translate('Description')"
                                            v-model="activeItem.description"> </textarea>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center mt-10"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                    @click="activeTab = 'Fields'" v-text="translate('Next')"></a></p>
                        </div>
                        <div class="" v-if="activeTab == 'Fields'" :key="activeTab">
                            <div class="card-body pt-0">
                                <div class="settings-form">
                                    
                                    <vue-csv-import
                v-model="csv"
                :fields="{
                    name: {required: false, label: 'full_name'}, 
                    mobile: {required: false, label: 'phone_number'}, 
                    whatsapp: {required: false, label: 'Whatsapp'}, 
                    job_title: {required: false, label: 'job_title'}, 
                    email: {required: false, label: 'Email'}, 
                }"
            >
                <vue-csv-toggle-headers></vue-csv-toggle-headers>
                <vue-csv-errors></vue-csv-errors>
                <vue-csv-input></vue-csv-input>
                <vue-csv-submit></vue-csv-submit>
                <vue-csv-table-map autoMatch="true" autoMatchIgnoreCase="true"></vue-csv-table-map>
            </vue-csv-import>
                                </div>
                            </div>
                            <p class="text-center mt-10"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                    @click="activeTab = 'Picture'" v-text="translate('Next')"></a></p>
                        </div>

                        <div class="" v-if="activeTab == 'Picture'" :key="activeTab">
                            
                            <div class="text-center mb-13">
                                <h1 class="mb-3" v-text="translate('Change logo')"></h1>

                                <div class="text-gray-400 font-semibold "
                                    v-text="translate('Set payment method picture')"></div>
                            </div>
                            
                            <vue-medialibrary-field class="max-w-xl mx-auto":key="activeItem" @input="setPicture" :filepath="activeItem.picture ?? '/uploads/image/default_profile.png'" :api_url="conf.url"></vue-medialibrary-field>

                            <p class="text-center mt-10"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                    @click="activeTab = 'Confirm'" v-text="translate('Next')"></a></p>
                        </div>
                        <div class="w-full  mx-auto" v-if="activeTab == 'Confirm'" :key="activeTab">

                            <div class="max-w-6xl mx-auto">
                                
                                <div class="max-w-xl mx-auto gap-10">
                                    <div class="w-full flex">
                                        <div class="w-full">
                                            <div class="card-header border-0 flex gap-4">
                                                <div class="card-title gap-4"> 
                                                    <img class="w-10 h-10 rounded-full" :src="activeItem.picture" />
                                                    <h2 v-text="activeItem.name"></h2> 
                                                </div>
                                            </div>

                                            <div class="card-body py-0">
                                                <div class="fs-5 fw-semibold text-gray-500 mb-4" v-text="activeItem.description"></div>
                                            </div>
                                        </div>
                                        <div class="mx-auto pt-4">

                                            <label class=" flex gap-2 cursor-pointer">
                                                <form_field class="flex-end" :item="activeItem"
                                                    :column="{ key: 'status', title: translate('Status'), column_type: 'checkbox', hide_text:true }">
                                                </form_field>
                                                <div class="pt-3">
                                                    <span class="badge badge-light fw-bold me-auto px-4 py-3" v-text="!activeItem.status ? 'Pending' : 'Active'"></span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="max-w-xl mx-auto gap-10">

                                    <div class="card mb-6 mb-xl-9 bg-inverse-success">
                                        <div class="card-body py-0">
                                            <div class="d-flex flex-wrap flex-stack mb-5">
                                                <div class="d-flex ">
                                                    <div
                                                        class="border border-dashed border-gray-300 w-150px rounded my-3 p-4 me-6">
                                                        <span class="fs-1 fw-bold text-gray-800 lh-1">
                                                            <span class="counted"
                                                                v-text="activeItem.fields ? activeItem.fields.length : 0"></span>
                                                            <span class="fs-6 fw-semibold text-muted d-block lh-1 pt-2"
                                                                v-text="translate('Fields')"></span>
                                                        </span>

                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <p class="text-center mt-10"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                    @click="savePaymentMethod" v-text="translate('Submit')"></a></p>
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
import route_map from '@/components/maps/route_map.vue';
import field from '@/components/includes/Field.vue';

import {VueCsvToggleHeaders, VueCsvSubmit, VueCsvMap, VueCsvInput, VueCsvErrors, VueCsvImport,VueCsvTableMap, VueCsvImportPlugin} from 'vue-csv-import';


export default
    {
        components: {
            'vue-medialibrary-field': field,
            'datatabble': Vue3EasyDataTable,
            VueCsvToggleHeaders, VueCsvSubmit, VueCsvMap, VueCsvInput, VueCsvErrors, VueCsvImport, VueCsvTableMap, VueCsvImportPlugin,
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
        name: 'PaymentMethods',
        emits: ['callback'],
        setup(props, { emit }) {

            const showEditSide = ref(false);
            const activeItem = ref({});
            const activeTab = ref('Info');
            const content = ref({});
            const fillable = ref(['Info', 'Fields' , 'Picture', 'Confirm']);

            if (props.item) {
                activeItem.value = props.item
            }

            const savePaymentMethod = () => {
                var params = new URLSearchParams();
                let array = JSON.parse(JSON.stringify(activeItem.value));
                let keys = Object.keys(array)
                let k, d, value = '';
                for (let i = 0; i < keys.length; i++) {
                    k = keys[i]
                    d = typeof array[k] === 'object' ? JSON.stringify(array[k]) : array[k]
                    params.append('params[' + k + ']', d)
                }

                let type = array.payment_method_id > 0 ? 'update' : 'create';
                params.append('type', 'PaymentMethod.' + type)
                handleRequest(params, '/api/' + type).then(response => {
                    handleAccess(response)
                })
            }

            const back = () => {
                emit('callback');
            }


            const progressWidth = () => {
                let requiredData = ['name', 'description',  'double_cost_month', 'double_cost_quarter', 'double_cost_year', 'status'];

                return getProgressWidth(requiredData, activeItem);
            }

            const switchField = (field, key) => {
                console.log(field, key)
                activeField.value = key;
                showModal.value = true
            }
            const addField = () => {
                if (!activeItem.value.fields)
                {
                    activeItem.value.fields = [{'title': ''}];
                } else {
                    activeItem.value.fields.push({'title':''})
                }
                
                activeField.value = activeItem.value.fields.length - 1;
                showModal.value = true
            }

            const activeField = ref(0);
            const showModal = ref(false);
            
            const setPicture = (a) => {
                console.log(a)
                activeItem.value.picture = a.value;
            }
            return {
                setPicture,
                showModal,
                switchField,
                addField,
                activeField,
                progressWidth,
                showEditSide,
                content,
                fillable,
                activeItem,
                activeTab,
                translate,
                savePaymentMethod,
                back
            };
        },

        props: [
            'conf',
            'path',
            'system_setting',
            'setting',
            'item',
            'drivers',
            'vehicles',
        ],

    };
</script>
<style lang="css">
  .card table {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
  
  .card table td, .card table th {
    border: 1px solid #ddd;
    padding: 8px;
  }
  
  .card table tr:nth-child(even){background-color: #f2f2f2;}
  
  .card table tr:hover {background-color: #ddd;}
  
  .card table th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
  }
  </style>
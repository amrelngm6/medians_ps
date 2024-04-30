<template>
    <div class="w-full " >

        <div v-if="!showWizard" class="px-4 mb-6 py-4 rounded-lg shadow-md bg-white dark:bg-gray-700 flex w-full">
            <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
        </div>
        
        <div class="w-full flex gap-4"  v-if="!showWizard">
            
            <div class="card card-flush h-md-50 mb-5 mb-xl-10 w-full">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">   
                        <div class="d-flex align-items-center">
                            <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start" v-text="currency.symbol"></span>
                            <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2" v-text="content.total_completed_amount"></span>
                        </div>
                        <span class="text-gray-500 pt-1 fw-semibold fs-6" v-text="translate('Total collected amount')"></span>
                    </div>
                </div>

                <div class="px-4 pt-2 pb-4 d-flex align-items-center">
                    <div class="d-flex flex-center me-5 pt-2"></div>
                    <div class="d-flex flex-column content-justify-center w-100">
                        <div class="d-flex gap-4 fs-6 fw-semibold align-items-center" v-for="withdrawal in content.completed_by_payment_methods">
                            <div class=" rounded-2  my-3"><img class="w-10 h-10" :src="'/uploads/img/payment_methods/'+withdrawal.payment_method.toLowerCase()+'.png'" /></div>
                            <div class="text-gray-500 flex-grow-1 me-4" v-text="withdrawal.payment_method"></div>
                            <div class="fw-bolder text-gray-700 text-xxl-end" v-text="currency.symbol+''+ (withdrawal.total_amount)"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="!showWizard" class="mx-2 bg-white px-4 rounded shadow-sm py-2 ">
            <div class="card-header align-items-center py-5 gap-2 gap-md-5 w-full flex ">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <input type="text"  v-model="searchValue" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-125px " placeholder="Search Report">
                    </div>
                    <div id="kt_ecommerce_report_views_export" class="d-none"><div class="dt-buttons btn-group flex-wrap">      <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="kt_ecommerce_report_views_table" type="button"><span>Copy</span></button> <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="kt_ecommerce_report_views_table" type="button"><span>Excel</span></button> <button class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="kt_ecommerce_report_views_table" type="button"><span>CSV</span></button> <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="kt_ecommerce_report_views_table" type="button"><span>PDF</span></button> </div></div>
                </div>
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5 w-200px">
                    <div class="w-150px">
                        <select v-model="searchField" class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Rating" data-kt-ecommerce-order-filter="rating" data-select2-id="select2-data-9-zple" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                            <option v-for="col in content.columns" v-text="col.text"  :value="col.value" ></option>
                        </select>
                    </div>
                </div>

                <div class="card-toolbar w-full flex-end">

                    <div class="w-full">
                        <vue-tailwind-datepicker 
                            :formatter="formatter"
                            @update:model-value="handleSelectedDate($event)"
                            :separator="' - '+translate('To')+' - '"
                            v-model="dateValue" />
                    </div>

                </div>
            </div>
            <datatabble 
                :search-field="searchField"
                :search-value="searchValue"
                alternating
                class="align-middle fs-6 gy-5 table table-row-dashed px-6" :body-text-direction="translate('is_rtl')" fixed-checkbox v-if="content.columns" :headers="content.columns" :items="content.items" >

                <template #item-amount="item">
                    <span v-text="currency.symbol+''+item.amount"> </span>
                </template>

                <template #item-delete="item">
                    <button v-if="!item.not_removeable" class="p-2 hover:text-gray-600 text-red-500" @click="handleAction('delete', item)">
                        <vue-feather class="w-5" type="x-circle"></vue-feather>
                    </button>
                </template>
                <template #item-edit="item">
                    <button class="p-2 hover:text-gray-600 text-red-500" @click="handleAction('edit', item)">
                        <vue-feather class="w-5" type="edit"></vue-feather>
                    </button>
                </template>
            </datatabble>
        </div>
    </div>
</template>
<script>

import 'vue3-easy-data-table/dist/style.css';
import Vue3EasyDataTable from 'vue3-easy-data-table';
import {ref} from 'vue';
import {translate, handleGetRequest, deleteByKey} from '@/utils.vue';
import VueTailwindDatepicker from "vue-tailwind-datepicker";
import dashboard_card_white from '@/components/includes/dashboard_card_white.vue';
import withdrawal_wizard from '@/components/wizards/withdrawalWizard.vue';
    
export default
{
    components: {
        'datatabble': Vue3EasyDataTable,
        withdrawal_wizard,
        VueTailwindDatepicker,
        dashboard_card_white,

    },
    
    setup(props) {
        
        const dateValue = ref({
            startDate: "",
            endDate: "",
        });

        const formatter = ref({
            date: "YYYY-MM-DD",
            month: "MMM",
        });
        
        const showWizard = ref(false);

        const url =  props.conf.url+props.path+'?load=json';

        const content =  ref({
                title: '',
                items: [],
                columns: [],
            });
        
        const activeItem = ref({});

        const showLoader = ref(null);

        const searchField = ref("withdrawal_id");
        const searchValue = ref("");

        function load()
        {
            handleGetRequest( url ).then(response=> {
                content.value = JSON.parse(JSON.stringify(response))
                searchField.value = content.value.columns[1].value;
            });
        }
        
        load();

        function closeSide (data) 
        {
            showWizard.value = false;
        }

        /**
         * Handle actions from datatable buttons
         * Called From 'dataTableActions' component
         * 
         * @param String actionName 
         * @param Object data
         */  
        function  handleAction(actionName, data) {
            switch(actionName) 
            {
                case 'edit':
                    activeItem.value = data;
                    showWizard.value = true; 
                    break;  

                case 'delete':
                    deleteByKey('withdrawal_id', data, 'Withdrawal.delete');
                    break;  
            }
        }

        const handleSelectedDate = (event) => {
            console.log(event);
            handleGetRequest( props.conf.url+props.path+'?start_date='+event.startDate+'&end_date='+event.endDate+'&load=json' ).then(response=> {
            console.log(response);
                content.value = JSON.parse(JSON.stringify(response))
            });
        }
        
        return {
            handleSelectedDate,
            dateValue,
            formatter,
            showWizard,
            closeSide,
            url ,
            content,
            activeItem,
            showLoader,
            translate,
            searchField,
            searchValue,
            handleAction
        };
    },
    props: [
        'path',
        'setting',
        'system_setting',
        'conf',
        'auth',
        'currency'
    ],
};
</script>

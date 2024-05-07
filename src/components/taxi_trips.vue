<template>
    <div class="w-full overflow-auto" >

        <div class=" " v-if="!showOptions && !showWizard && content.items && !content.items.length">
            <div class="card">
                <div class="card-body">
                    <div class="card-px text-center pt-15 pb-15">
                        <h2 class="fs-2x fw-bold mb-0" v-text="content.title"></h2>
                        <p class="text-gray-400 fs-4 font-semibold py-7"
                            v-text="translate('Empty data')"></p>
                        <a v-text="translate('add_new')" @click="showOptions = true"
                            href="javascript:;" class="text-white btn btn-primary er fs-6 px-8 py-4"></a>
                    </div>

                    <div class="text-center pb-15 px-5">
                        <img :src="'/uploads/img/start-wizard.png'" alt="" class="mx-auto mw-100 h-200px h-sm-325px">
                    </div>
                </div>
            </div>
        </div>
        
        <taxi_trip_wizard @callback="showWizard = false" :active_tab="defaultTab" :conf="conf" :currency="currency"
                v-if="showWizard && activeItem.usertype" :usertype="activeItem.usertype"
                :userslist="usersList" :key="showWizard" :vehicles="content.vehicles" :drivers="content.drivers"
                :system_setting="system_setting" :item="activeItem" :business_setting="business_setting" />

                
        <taxi_trip_track_wizard @callback="showTrackWizard = false" :conf="conf" :currency="currency"
                v-if="showTrackWizard && activeItem.usertype"  :key="showTrackWizard" 
                :system_setting="system_setting" :item="activeItem" :business_setting="business_setting" />

        <usertype_picker :alias="translate('Need taxi trip')" :disable_students="true" v-if="!showWizard && showOptions" :key="showOptions" :auth="auth" :item="activeItem" @callback="setType" />
        
        <div  v-if="!showWizard && !showOptions && !showTrackWizard && content " class=" w-full relative">

            <main v-if="content.items && content.items.length"  :key="content.items" class=" flex-1 overflow-x-hidden overflow-y-auto  w-full">
                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-md bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                    <a href="javascript:;" class="uppercase p-2 mx-2 text-center text-white w-32 rounded-lg bg-danger" @click="showOptions = true" v-text="translate('add_new')"></a>
                </div>
                <div class="w-full bg-white" >

                    <div class="card-header align-items-center py-5 gap-2 gap-md-5 w-full flex ">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
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
                        :search-value="searchValue" alternating   class="align-middle fs-6 gy-5 table table-row-dashed px-6" :body-text-direction="translate('is_rtl')" fixed-checkbox v-if="content.columns" :headers="content.columns" :items="content.items" >

                        <template #item-picture="item">
                            <img :src="item.picture" class="w-8 h-8 rounded-full" />
                        </template>

                        <template #item-driver="item">
                            <div class="w-full relative flex gap-2 cursor-pointer" @click="handleAction('driver', item)">
                                <img  class="rounded-full w-8 h-8 rounded-[50px] border-2 border-purple-800" :src="(item.driver && item.driver.picture) ? item.driver.picture : 'https://via.placeholder.com/37x37'" /> 
                                <span class="font-semibold  p-1" v-if="item.driver" v-text="item.driver.name"></span>
                            </div>
                        </template>

                        <template #item-model="item">
                            <div class="w-full relative flex gap-2">
                                <img  class="rounded-full w-8 h-8 rounded-[50px] border-2 border-purple-800" :src="(item.model && item.model.picture) ? item.model.picture : 'https://via.placeholder.com/37x37'" /> 
                                <span class="  p-1" v-if="item.model" v-text="item.model.name"></span>
                            </div>
                        </template>

                        <template #item-total_cost="item">
                            <span class="py-2" v-text="currency.symbol+''+item.total_cost"></span>
                        </template>
                        <template #item-subtotal="item">
                            <span class="py-2" v-text="currency.symbol+''+item.total_cost"></span>
                        </template>
                        <template #item-status="item">
                            <p v-if="item.status == 'scheduled'" class="py-2" v-text="translate(item.status)"></p>
                            <span v-if="item.status == 'started'" class="" v-text="translate(item.status)"></span>
                            <p v-if="item.status == 'started'" class="cursor-pointer fw-bold" @click="showTrackWizard = true, activeItem = item" v-text="translate('Live Track')"></p>
                            <p v-if="item.status == 'completed'" class="py-2 text-green-600" v-text="translate(item.status)"></p>
                            <p v-if="item.status == 'cancelled'" class="py-2 text-red-600" v-text="translate(item.status)"></p>
                        </template>

                        <template #item-details="item">
                            <button v-if="!item.not_editable" class="p-2  hover:text-gray-600 text-purple" @click="handleAction('edit', item)">
                                <vue-feather class="w-5" type="edit"></vue-feather>
                            </button>
                        </template>
                        <template #item-delete="item">
                            <button v-if="!item.not_removeable" class="p-2 hover:text-gray-600 text-red-500" @click="handleAction('delete', item)">
                                <delete_icon class="w-5"/>
                            </button>
                        </template>
                    </datatabble>
                </div>
            </main>
        </div>
    </div>
</template>
<script>

import delete_icon from '@/components/svgs/trash.vue';
import car_icon from '@/components/svgs/car.vue';
import route_icon from '@/components/svgs/route.vue';

import 'vue3-easy-data-table/dist/style.css';
import Vue3EasyDataTable from 'vue3-easy-data-table';

import {defineAsyncComponent, ref} from 'vue';
import {translate, handleGetRequest, handleRequest, deleteByKey, showAlert} from '@/utils.vue';

const maps = defineAsyncComponent(() =>
  import('@/components/includes/map.vue')
);

const trip_page = defineAsyncComponent(() => import('@/components/trip_page.vue') );
const usertype_picker = defineAsyncComponent(() => import('@/components/includes/usertype_picker.vue') );
const taxi_trip_wizard = defineAsyncComponent(() => import('@/components/wizards/taxiTripWizard.vue') );
const taxi_trip_track_wizard = defineAsyncComponent(() => import('@/components/wizards/taxiTripTrackWizard.vue') );

import VueTailwindDatepicker from "vue-tailwind-datepicker";

export default
{
    components: {
        'datatabble': Vue3EasyDataTable,
        maps,
        delete_icon,
        car_icon,
        route_icon,
        trip_page,
        usertype_picker,
        taxi_trip_wizard,
        VueTailwindDatepicker,
        taxi_trip_track_wizard,
    },
    name: 'Taxi trips',
    
    setup(props) {

        const dateValue = ref({
            startDate: "",
            endDate: "",
        });

        const formatter = ref({
            date: "YYYY-MM-DD",
            month: "MMM",
        });

        const url =  props.conf.url+props.path+'?load=json';

        const defaultTab = ref(null);
        const showTrackWizard = ref(null);
        const activeItem = ref({});
        const content = ref({});
        const usersList = ref([]);
        const showTrip =  ref(false);
        const showWizard =  ref(false);
        const showOptions =  ref(false);

        const searchValue = ref("");
        const searchField = ref("#");

        const load = () => {
            handleGetRequest(url).then(response => {
                content.value = JSON.parse(JSON.stringify(response))
                searchField.value = content.value.columns[1].value;
            });
        }
        load();


        /**
         * Handle actions from datatable buttons
         * Called From 'dataTableActions' component
         * 
         * @param String actionName 
         * @param Object data
         */
        const handleAction = (actionName, data) => 
        {
            switch (actionName) 
            {
                case 'view':
                    break;

                case 'edit':
                    defaultTab.value = null;
                    activeItem.value = data;
                    showWizard.value = true;
                    break;

                case 'driver':
                    defaultTab.value = 'Driver'
                    showWizard.value = true
                    break;  

                case 'delete':
                    deleteByKey('trip_id', data, 'TaxiTrip.delete');
                    break;
            }
        }

        

        const handleUsersList = () => {
            
            if (activeItem.value.usertype == 'employee')
                usersList.value = content.value.employees;
            
            
            if (activeItem.value.usertype == 'supervisor')
                usersList.value = content.value.supervisors;
        }


        const setType = (type) => {
            activeItem.value.usertype = type;
            showOptions.value = false;
            showWizard.value = true;
            handleUsersList();
        }


        const handleSelectedDate = (event) => {
            handleGetRequest( props.conf.url+props.path+'?start_date='+event.startDate+'&end_date='+event.endDate+'&load=json' ).then(response=> {
                content.value = JSON.parse(JSON.stringify(response))
            });
        }
        
        return {
            defaultTab,
            handleSelectedDate,
            usersList,
            showTrackWizard,
            showWizard,
            setType,
            showOptions,
            showTrip,
            url,
            content,
            activeItem,
            searchValue,
            searchField,
            translate,
            handleAction,
            dateValue,
            formatter,
        };
    },
    
    props: [
        'path',
        'lang',
        'business_setting',
        'system_setting',
        'conf',
        'auth',
        'currency'
    ],
};

</script>
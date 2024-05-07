<template>
    <div class="w-full overflow-auto" >
        <div class=" " v-if="!showWizard && content.items && !content.items.length">
            <div class="card">
                <div class="card-body">
                    <div class="card-px text-center pt-15 pb-15">
                        <h2 class="fs-2x fw-bold mb-0" v-text="content.title"></h2>
                        <p class="text-gray-400 fs-4 font-semibold py-7"
                            v-text="translate('Empty data')"></p>
                    </div>

                    <div class="text-center pb-15 px-5">
                        <img :src="'/uploads/img/start-wizard.png'" alt="" class="mx-auto mw-100 h-200px h-sm-325px">
                    </div>
                </div>
            </div>
        </div>
        <trip_wizard @callback="showWizard = false" :conf="conf"
                v-if="showWizard" 
                :userslist="usersList" :key="showWizard" :vehicles="content.vehicles" :drivers="content.drivers"
                :system_setting="system_setting" :item="activeItem" :business_setting="business_setting" />

        <div  v-if="!showWizard && !showOptions && content && !showTrip " class=" w-full relative">

            <main v-if="content.items && content.items.length" :key="content.items" class=" flex-1 overflow-x-hidden overflow-y-auto  w-full">
                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-md bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
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
                        :search-value="searchValue" alternating  class="align-middle fs-6 gy-5 table table-row-dashed px-6" :body-text-direction="translate('is_rtl')" fixed-checkbox v-if="content.columns" :headers="content.columns" :items="content.items" >

                        <template #item-locations="item">
                            
                            <div class="w-full h-8 relative flex cursor-pointer" @click="handleAction('locations', item)">
                                <div v-for="(location, i) in item.locations" :style="'left: '+(20 * i)+'px'" class="rounded-full w-8 h-8 left-0 top-0 absolute" >
                                    <img  v-if="i < 3" :key="i" class="rounded-full w-8 h-8 rounded-[50px] border-2 border-purple-800" :src="(location.model && location.model.picture) ? location.model.picture : 'https://via.placeholder.com/37x37'" /> 
                                </div>
                                <span class="flex absolute pt-2" :style="'left: '+((20 * (item.locations.length < 3 ? item.locations.length : 3) ) + 20)+'px'"> <route_icon /><span class="font-semibold  px-1" v-if="item.locations" v-text="item.locations.length"></span></span>
                            </div>
                            
                        </template>

                        <template #item-driver="item">
                            <div class="w-full relative flex cursor-pointer gap-2" @click="handleAction('driver', item)">
                                <img  class="rounded-full w-8 h-8 rounded-[50px] border-2 border-purple-800" :src="(item.driver && item.driver.picture) ? item.driver.picture : 'https://via.placeholder.com/37x37'" /> 
                                <span class="font-semibold  px-1" v-if="item.driver" v-text="item.driver.name"></span>
                            </div>
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
const trip_wizard = defineAsyncComponent(() => import('@/components/wizards/tripWizard.vue') );
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
        trip_wizard,
        VueTailwindDatepicker
    },
    name: 'Route trips',
    
    setup(props) {


        const url =  props.conf.url+props.path+'?load=json';

        const activeTrip = ref(null);
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
                    activeItem.value = data;
                    showWizard.value = true;
                    break;

                case 'delete':
                    deleteByKey('trip_id', data, 'Trip.delete');
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

        
        const dateValue = ref({
            startDate: "",
            endDate: "",
        });

        const formatter = ref({
            date: "YYYY-MM-DD",
            month: "MMM",
        });
        
        const handleSelectedDate = (event) => {
            handleGetRequest( props.conf.url+props.path+'?start_date='+event.startDate+'&end_date='+event.endDate+'&load=json' ).then(response=> {
                content.value = JSON.parse(JSON.stringify(response))
            });
        }
        
        return {
            handleSelectedDate,
            usersList,
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
    ],
};

</script>
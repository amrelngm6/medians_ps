<template>
    <div class="w-full flex overflow-auto" >
        
        <div  v-if="content " class=" w-full relative">
            
            <route_wizard @callback="showWizard=false" v-if="showWizard" :key="showWizard" :drivers="content.drivers" :supervisors="content.supervisors" :vehicles="content.vehicles" :system_setting="system_setting" :item="activeItem" :business_setting="business_setting" :conf="conf" ></route_wizard>
            
            <div class=" " v-if="!showWizard && content.items && !content.items.length ">
                <div class="card">
                    <div class="card-body">
                        <div class="card-px text-center pt-15 pb-15">
                            <h2 class="fs-2x fw-bold mb-0" v-text="content.title"></h2>
                            <p class="text-gray-400 fs-4 font-semibold py-7" v-text="translate('Add your first route using this below wizard')"></p>
                            <a v-text="translate('add_new')" @click="addRouteWizard" href="javascript:;" class="text-white btn btn-primary er fs-6 px-8 py-4" ></a>
                        </div>

                        <div class="text-center pb-15 px-5">
                            <img :src="'/src/assets/img/1.png'" alt="" class="mx-auto mw-100 h-200px h-sm-325px">          
                        </div>
                    </div>
                </div>
            </div>

            <main class=" flex-1 overflow-x-hidden overflow-y-auto  w-full relative" v-if="content.items && !showWizard && content.items.length">
                <div class="px-4 mb-6 py-4 rounded-lg shadow-md bg-white dark:bg-gray-700 flex w-full">
                    
                    <h1  class="font-bold text-lg w-full" v-text="content.title"></h1>
                </div>
                <div class="w-full bg-white" >
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5 w-full flex px-4">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <input type="text"  v-model="searchValue" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Search Report">
                            </div>
                        </div>
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">

                            <div class="w-150px">
                                <select v-model="searchField" class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Rating" data-kt-ecommerce-order-filter="rating" data-select2-id="select2-data-9-zple" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                    <option v-for="col in content.columns" v-text="col.text" :value="col.value"></option>
                                </select>
                            </div>
                        </div>
    
                        <a href="javascript:;" v-if="!showWizard" class="uppercase p-2 mx-2 text-center text-white w-32 rounded-lg bg-danger" @click="addRouteWizard" v-text="translate('add_new')"></a>

                    </div>
                    <datatabble 
                        :search-field="searchField"
                        :search-value="searchValue" alternating class="align-middle fs-6 gy-5 table table-row-dashed px-6" :body-text-direction="translate('lang') == 'ar' ? 'right' : 'left'" fixed-checkbox v-if="content.columns" :headers="content.columns" :items="content.items" >

                        <template #item-picture="item">
                            <img :src="item.picture" class="w-8 h-8 rounded-full" />
                        </template>

                        <template #item-route_locations="item">
                            
                            <div class="w-full h-8 relative flex">
                                <div v-for="(location, i) in item.route_locations" :style="'left: '+(20 * i)+'px'" class="rounded-full w-8 h-8 left-0 top-0 absolute" >
                                    <img  v-if="i < 3" :key="i" class="rounded-full w-8 h-8 rounded-[50px] border-2 border-purple-800" :src="(location.student && location.student.picture) ? location.student.picture : 'https://via.placeholder.com/37x37'" /> 
                                </div>
                                <span class="flex absolute pt-2" :style="'left: '+((20 * (item.route_locations.length < 3 ? item.route_locations.length : 3) ) + 20)+'px'"> <route_icon /><span class="font-semibold  px-1" v-if="item.route_locations" v-text="item.route_locations.length"></span></span>
                            </div>
                            
                        </template>

                        <template #item-edit="item">
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
                <!-- END New releases -->
            </main>
        </div>
    </div>
</template>
<script>

import delete_icon from '@/components/svgs/trash.vue';
import route_icon from '@/components/svgs/route.vue';
import car_icon from '@/components/svgs/car.vue';

import 'vue3-easy-data-table/dist/style.css';
import Vue3EasyDataTable from 'vue3-easy-data-table';

import {defineAsyncComponent, ref} from 'vue';
import {translate, handleGetRequest, handleRequest, deleteByKey, showAlert, handleAccess, getPositionAddress, findPlaces, getPlaceDetails} from '@/utils.vue';


const maps = defineAsyncComponent(() =>
  import('@/components/includes/map.vue')
);

const form_field = defineAsyncComponent(() =>
  import('@/components/includes/form_field.vue')
);

import editable_map_location from '@/components/includes/editable_map_location.vue';
import route_wizard from '@/components/wizards/routeWizard.vue';
import tooltip from '@/components/includes/tooltip.vue';



export default 
{
    components:{
        'datatabble': Vue3EasyDataTable,
        maps,
        delete_icon,
        car_icon,
        route_icon,
        form_field,
        editable_map_location,
        route_wizard, 
        tooltip
    },
    name:'Routes',
    setup(props) {

        const url =  props.conf.url+props.path+'?load=json';

        const showEditSide = ref(false);
        const activeItem = ref({});
        const content = ref({});
        const center = ref({});
        const showWizard =  ref(false);
        const fillable =  ref(['Info', 'Time','Start location','End location','Driver']);
        const places =  ref([]);
        const showPlaceSearch =  ref(false);
        const start_placeSearch =  ref('');
        const searchValue = ref("");
        const searchField = ref("#");
        

        const closeSide = () => {
            showEditSide.value = false;
        }


        const load = () => {
            handleGetRequest( url ).then(response=> {
                content.value = JSON.parse(JSON.stringify(response))
                searchField.value = content.value.columns[1].value;
            });
        }
        
        load();

        /**
         * Get current location
         */
        const getUserLocation = async () => 
        {
            if (navigator.geolocation) 
            {
                navigator.geolocation.getCurrentPosition
                (
                    position => {
                        activeItem.value.start_latitude = position.coords.latitude;
                        activeItem.value.start_longitude = position.coords.longitude;
                        activeItem.value.end_latitude = position.coords.latitude;
                        activeItem.value.end_longitude = position.coords.longitude;
                    },
                    error => { 
                        
                        activeItem.value.start_latitude = 30.06;
                        activeItem.value.start_longitude = 31.21;
                        activeItem.value.end_latitude = 30.06;
                        activeItem.value.end_longitude = 31.21;
                        showAlert(error.message) 
                    }
                );

            } else {
                showAlert('location error')
            }
        }

        const addRouteWizard = () => 
        {
            activeItem.value = {};
            showWizard.value = true;
            getUserLocation();
        }
        
        const  startPlaceChanged = async () =>
        {
            let result = start_placeSearch.value.length > 3 ? await findPlaces(props.system_setting.google_map_api, start_placeSearch.value, props.business_setting.country) : ''
            places.value = result.predictions;
        }

        const updateStartMarker = async (position) =>
        {
            activeItem.value.start_latitude =  position.lat();
            activeItem.value.start_longitude =  position.lng();
            activeItem.value.start_address = await getPositionAddress(position.lat(),position.lng())
        } 
        
        const updateEndMarker = (position) =>
        {
            activeItem.value.end_latitude =  position.lat();
            activeItem.value.end_longitude =  position.lng();
        } 

        const clickMarker = (item, index, event) =>
        {
        }



        /**
         * Handle actions from datatable buttons
         * Called From 'dataTableActions' component
         * 
         * @param String actionName 
         * @param Object data
         */  
         const handleAction =  (actionName, data) =>  {
            switch(actionName) 
            {

                case 'view':
                    break;

                case 'edit':
                    activeItem.value = data;
                    showWizard.value = true
                    break;  

                case 'delete':
                    deleteByKey('route_id', data, 'Route.delete');
                    break;  

                    
                case 'close':
                    
                    showEditSide.value = false;
                    activeItem.value = {};
                    break;
            }
        }

        const waypoints = ref([])


        const setPlaceMarker = async (placeInfo) => 
        {
            activeItem.value.start_address = placeInfo.description

            const placesService = new google.maps.places.PlacesService(document.createElement('div'));

            let placeId = placeInfo.place_id;

            placesService.getDetails({ placeId }, (place, status) => 
            {
                if (status === google.maps.places.PlacesServiceStatus.OK && place) 
                {
                    const location = place.geometry.location;
                    
                    activeItem.value.start_longitude = location.lng()
                    activeItem.value.start_latitude = location.lat()

                    places.value = []
                    showPlaceSearch.value = false
                } else {
                    console.error('Failed to fetch place details');
                }
            });
            
        }

        const showTip = ref({});
        
        return {
            showTip,
            setPlaceMarker,
            showPlaceSearch,
            startPlaceChanged,
            start_placeSearch,
            places,
            waypoints,
            showEditSide,
            url,
            content,
            fillable,
            center,
            activeItem,
            searchValue,
            searchField,
            translate,
            clickMarker,
            updateStartMarker,
            updateEndMarker,
            getUserLocation,
            showWizard,
            closeSide,
            addRouteWizard,
            handleAction,
        };
    },

    props: [
        'path',
        'lang',
        'system_setting',
        'business_setting',
        'setting',
        'conf',
        'auth',
    ],
    
};
</script>
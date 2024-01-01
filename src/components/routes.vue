<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div  v-if="content " class=" w-full relative">

            <maps v-if="center" :conf="conf" :setting="setting" :key="center" :center="center"  @click-marker="clickMarker" :waypoints="waypoints" :showroute="false"></maps>

            <div :style="collapsed ? 'max-height:240px' : 'max-height:calc(100vh - 140px)'" class="mx-16 h-full absolute top-4 rounded-lg p-4   bg-white rounded-xl flex-col justify-start items-start inline-flex">
                <div class="self-stretch py-4 flex-col justify-center items-start flex">
                    <div class="text-black text-lg font-semibold" v-text="translate('Routes')"></div>
                    <div class="py-2 self-stretch text-zinc-600 text-base  tracking-wide" v-text="translate('Routes description')"></div>
                </div>
                <div v-if="!collapsed" class="w-full self-stretch pt-2 flex-col justify-center items-start flex">
                    <input class="w-full bg-gray-100 rounded-lg px-4 py-2 " :placeholder="translate('find by name and address')" v-model="searchText" v-on:change="searchTextChanged"  v-on:input="searchTextChanged" v-on:keydown="searchTextChanged" />
                </div>
                <div :key="collapsed" v-if="!collapsed && content.items" class=" max-h-[400px] overflow-auto my-4 w-full self-stretch py-4  ">

                    <div v-for="(route, index) in content.items" :key="route.active" class="w-full">
                        <div  v-if="route.active" :class="route.selected ? 'text-fuchsia-600' : 'bg-gray-50'"  class="mb-4 w-full  rounded-lg justify-start items-center inline-flex">
                            <div class="w-full grow shrink basis-0 px-6 py-4 flex-col justify-center items-start gap-4 inline-flex">
                                <div class="w-full self-stretch justify-start items-start inline-flex cursor-pointer">
                                    <div @click="setLocationsMarkers(route, index)"  class="w-full grow shrink basis-0 flex-col justify-start items-start inline-flex">
                                        <div :class="route.selected ? 'text-fuchsia-600' : 'text-gray-800'" v-text="route.route_name" class="self-stretch text-base font-semibold  tracking-tight"></div>
                                        <div class="py-1 self-stretch text-slate-500 text-sm font-semibold leading-relaxed tracking-wide"  v-text="route.description"></div>
                                    </div>
                                    <div  class="gap-2 py-2 flex justify-start items-start gap-2.5 inline-flex">
                                        <div class="px-3 py-2 bg-purple-800 rounded justify-center items-center flex cursor-pointer"  @click="handleAction('edit', route)">
                                            <div class="text-center text-white   uppercase tracking-tight text-sm"> 
                                                <vue-feather class="w-5" type="edit"></vue-feather>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="w-full" /> 
                                <div class="w-full h-8 relative flex">
                                    <div class="rounded-full left-0 top-0 absolute " :style="'left: '+(20 * i)+'px'" v-for="(location, i) in route.pickup_locations" >
                                        <img v-if="i < 3" class="rounded-full w-8 h-8 rounded-[50px] border-2 border-purple-800" :src="(location.student && location.student.picture) ? location.student.picture : 'https://via.placeholder.com/37x37'" /> 
                                    </div>
                                    <span class="absolute pt-2 flex" :style="'left: '+((20 * (route.pickup_locations.length < 3 ? route.pickup_locations.length : 3) ) + 20)+'px'"><route_icon /> <span class="font-semibold  px-1" v-if="route.pickup_locations" v-text="route.pickup_locations.length"></span></span>
                                    <div class="right-0 absolute flex self-stretch text-slate-500 text-base font-normal "> <car_icon class="w-8"  /><span v-if="route.vehicle" class="font-semibold text-sm p-2" v-text="route.vehicle.plate_number"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div
                    class="flex self-stretch grow shrink basis-0  justify-between items-center inline-flex">
                    <div class="menu-dark rounded-lg text-white text-xs font-medium px-4 py-3 uppercase cursor-pointer" @click="showAddSide = true,activeItem = {}; " v-text="translate('add new')"></div>
                    <div @click="collapsed = !collapsed" class="cursor-pointer p-2 block text-center "><i class="fa " :class="collapsed ? 'fa-circle-down' : 'fa-circle-up'"></i><p class="font-semibold" v-text="collapsed ? translate('Expand') : translate('Collapse')"></p></div>
                </div>
            </div>

            <hr class="mt-2" />
            
            <main class=" flex-1 overflow-x-hidden overflow-y-auto  w-full relative">
                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                    <a href="javascript:;" class="uppercase p-2 mx-2 text-center text-white w-32 rounded-lg menu-dark hover:bg-purple-800" @click="showAddSide = true,activeItem = {}; ">{{translate('add_new')}}</a>
                </div>
                <hr class="mt-2" />
                <div class="w-full " >

                    <datatabble :body-text-direction="translate('lang') == 'ar' ? 'right' : 'left'" fixed-checkbox v-if="content.columns" :headers="content.columns" :items="content.items" >

                        <template #item-picture="item">
                            <img :src="item.picture" class="w-8 h-8 rounded-full" />
                        </template>

                        <template #item-pickup_locations="item">
                            
                            <div class="w-full h-8 relative flex">
                                <div  v-for="(location, i) in item.pickup_locations" :style="'left: '+(20 * i)+'px'" class="rounded-full w-8 h-8 left-0 top-0 absolute" >
                                    <img v-if="i < 3" :key="i" class="rounded-full w-8 h-8 rounded-[50px] border-2 border-purple-800" :src="(location.student && location.student.picture) ? location.student.picture : 'https://via.placeholder.com/37x37'" /> 
                                </div>
                                <span class="flex absolute pt-2" :style="'left: '+((20 * (item.pickup_locations.length < 3 ? item.pickup_locations.length : 3) ) + 20)+'px'"> <route_icon /><span class="font-semibold  px-1" v-if="item.pickup_locations" v-text="item.pickup_locations.length"></span></span>
                            </div>
                            
                        </template>

                        <template #item-edit="item">
                            <button v-if="!item.not_editable" class="p-2  hover:text-gray-600 text-purple" @click="handleAction('edit', item)">
                                <vue-feather class="w-5" type="edit"></vue-feather>
                            </button>
                        </template>
                        <template #item-delete="item">
                            <button v-if="!item.not_removeable" class="p-2 hover:text-gray-600 text-purple" @click="handleAction('delete', item)">
                                <delete_icon class="w-4"/>
                            </button>
                        </template>
                    </datatabble>

                    <side-form-create @callback="closeSide"  :conf="conf" model="Routes.create" v-if="showAddSide && content && content.fillable" :columns="content.fillable"  class="col-md-3" />

                    <side-form-update @callback="closeSide" :key="activeItem" :conf="conf" model="Routes.update" :item="activeItem" :model_id="activeItem.route_id" index="route_id" v-if="showEditSide && !showAddSide " :columns="content.fillable"  class="col-md-3" />
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
import {translate, handleGetRequest, handleRequest, deleteByKey, showAlert} from '@/utils.vue';

const maps = defineAsyncComponent(() =>
  import('@/components/includes/map.vue')
);
const SideFormCreate = defineAsyncComponent(() =>
  import('@/components/includes/side-form-create.vue')
);

const SideFormUpdate = defineAsyncComponent(() =>
  import('@/components/includes/side-form-update.vue')
);


export default 
{
    components:{
        'datatabble': Vue3EasyDataTable,
        SideFormCreate,
        SideFormUpdate,
        maps,
        delete_icon,
        car_icon,
        route_icon,
    },
    name:'Routes',
    setup(props) {

        const url =  props.conf.url+props.path+'?load=json';

        const showAddSide = ref(false);
        const showEditSide = ref(false);
        const showProfilePage = ref(null);
        const activeItem = ref({});
        const content = ref({});
        const center = ref({});
        const locations =  ref([]);
        const showList =  ref(true);
        const searchText =  ref('');
        const locationError =  ref(null);
        const collapsed =  ref(false);

        const closeSide = () => {
            showAddSide.value = false;
            showEditSide.value = false;
        }


        const load = () => {
            handleGetRequest( url ).then(response=> {
                content.value = JSON.parse(JSON.stringify(response))
                searchTextChanged();

            });
        }
        
        load();

        /**
         * Get current location
         */
        const getUserLocation = async () => 
        {

            if (navigator.geolocation) {
                console.log('position 1')
                 navigator.geolocation.getCurrentPosition(
                    position => {
                        center.value = {lat: position.coords.latitude, lng: position.coords.longitude};
                    },
                    error => {
                        showAlert(error.message, 5000)

                    }
                );
 

            } else {
                locationError.value = "Geolocation is not supported by this browser.";
            }
        }
        
        getUserLocation();

        const searchTextChanged = () =>
        {   

            for (let i = 0; i < content.value.items.length; i++) {
                content.value.items[i].active = searchText.value.trim() ? checkSimilar(content.value.items[i]) : 1;
            }
        }

        const checkSimilar = (item) =>
        {
            let a = (item.route_name).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
            return a ? a : ((item.description).toLowerCase().includes(searchText.toLowerCase()) ? true : false);
        } 

        const setLocationsMarkers = (route, i) =>
        {   
            activeItem.value = route;

            for (let a = 0; a < content.value.items.length; a++) 
                content.value.items[a].selected = false;
                
            content.value.items[i].selected = true; 
            waypoints.value = setLocationsPickups(route);
        }
        
        const updateMarker = (item, index, event) =>
        {
        } 

        const clickMarker = (item, index, event) =>
        {
            console.log(item)
            console.log(index)
            console.log(event)
            // activeItem.value.latitude = event.latLng.lat();
            // activeItem.value.longitude = event.latLng.lng();
            // handleAction('edit', activeItem.value);
        }

        const setLocationsPickups = (route) => 
        {
            let loc;
            let locations_ = [];
            let blueIcon = props.conf.url+'uploads/images/blue_pin.gif';
            let vehicleIcon = props.conf.url+'uploads/images/car.svg';
            let destinationIcon = props.conf.url+'uploads/images/destination.svg';

            for (let i = 0; i < route.pickup_locations.length; i++) {
                loc = route.pickup_locations[i];
                locations_[i] = {title: loc.student_name, icon:  blueIcon, origin: { lat: parseFloat(loc.latitude), lng: parseFloat(loc.longitude) }, destination: { lat: parseFloat(loc.latitude), lng: parseFloat(loc.longitude) } }
            }

            // Add Vehicle current location marker
            let VehicleMarker = {icon: vehicleIcon, origin: { lat: parseFloat(route.vehicle.last_latitude), lng: parseFloat(route.vehicle.last_longitude) }, destination: { lat: parseFloat(route.vehicle.last_latitude), lng: parseFloat(route.vehicle.last_longitude) } }
            locations_[locations_.length] = VehicleMarker;

            // Add Route destination location marker
            let DestinationMarker = {drag:true, icon: destinationIcon, origin: VehicleMarker.origin, destination: { lat: parseFloat(route.latitude), lng: parseFloat(route.longitude) } }
            locations_[locations_.length] = DestinationMarker;
            
            // Update center to first Pickup location
            center.value = locations_[0].destination;

            return locations_;
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
                    showAddSide.value = false; 
                    showEditSide.value = true; 
                    showProfilePage.value = true;
                    break;  

                case 'delete':
                    deleteByKey('driver_id', data, 'Driver.delete');
                    break;  

                    
                case 'close':
                    
                    showEditSide.value = false;
                    showAddSide.value = false;
                    showProfilePage.value = false;
                    activeItem.value = {};
                    break;
            }
        }

        const waypoints = ref([])

        return {
            showAddSide,
            waypoints,
            showEditSide,
            url,
            content,
            center,
            activeItem,
            translate,
            setLocationsPickups,
            clickMarker,
            updateMarker,
            setLocationsMarkers,
            checkSimilar,
            searchTextChanged,
            searchText,
            getUserLocation,
            collapsed,
            closeSide,
            handleAction
        };
    },

    props: [
        'path',
        'lang',
        'setting',
        'conf',
        'auth',
    ],
    
};
</script>
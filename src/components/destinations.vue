<template>
    <div class="w-full flex overflow-auto" >
        <div class=" w-full">

            <main v-if="content && !showLoader" class="relative flex-1 overflow-x-hidden overflow-y-auto  w-full">
                <maps :showroute="false" @update-marker="updateMarker" @click-marker="clickMarker" :setting="setting" :draggable="true" v-if="locations.length" :key="center" :center="center" :waypoints="locations"></maps>
                <div :key="content.items" v-if="content.items" :style="collapsed ? 'max-height:240px' : 'max-height:calc(100vh - 140px)'" class="mx-16 h-full absolute top-4 rounded-lg p-4 w-96  bg-white rounded-xl flex-col justify-start items-start inline-flex">
                    <div class="self-stretch py-4 flex-col justify-center items-start flex">
                        <div class="text-black text-lg font-semibold" v-text="translate('Destinations')"></div>
                        <div class="py-2 self-stretch text-zinc-600 text-base  tracking-wide" v-text="translate('Destinations description')"></div>
                    </div>
                    <div v-if="!collapsed" class="w-full self-stretch pt-2 flex-col justify-center items-start flex">
                        <input class="w-full bg-gray-100 rounded-lg px-4 py-2 " :placeholder="translate('find by name and address')" v-model="searchText" v-on:change="searchTextChanged"  v-on:input="searchTextChanged" v-on:keydown="searchTextChanged" />
                    </div>
                    <div :key="collapsed" v-if="!collapsed" class=" max-h-[400px] overflow-auto my-4 w-full self-stretch py-4  ">
                        <div v-for="(destination, i) in content.items" :key="destination"  class="pt-2 w-full self-stretch justify-start items-center inline-flex ">
                            <div v-if="destination.active" class="grow shrink basis-0 gap-4 justify-start items-center flex">
                                <div class="justify-start items-center flex">
                                    <img class="w-10 h-10 rounded-full shadow-inner border-2 border-black"
                                        :src="(destination.student && destination.student.picture) ? destination.student.picture : 'https://via.placeholder.com/60x6'" />
                                </div>
                                <div @click="setLocationsMarkers(destination, i)" class="grow shrink basis-0 flex-col justify-center items-start gap-[3px] inline-flex cursor-pointer">
                                    <div class="text-black font-semibold text-base " v-text="destination.student_name"></div>
                                    <div class="self-stretch text-slate-500 text-sm font-normal " v-text="destination.location_name + ' - ' + destination.address"></div>
                                </div>
                            </div>
                            <div class="justify-center items-center flex">
                                <div class="w-10 h-10 p-2  bg-purple-800 rounded justify-center items-center flex mr-2 cursor-pointer"  @click="handleAction('edit', destination)">
                                    <div class="text-center text-xs text-white   uppercase tracking-tight"> <vue-feather class="w-5" type="edit"></vue-feather></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex self-stretch grow shrink basis-0 justify-between items-center inline-flex">
                        <div class="menu-dark rounded-lg text-white text-xs font-medium px-4 py-3 uppercase cursor-pointer" @click="showAddSide = true,activeItem = {}; " v-text="translate('add new')"></div>
                        <div @click="collapsed = !collapsed" class="cursor-pointer p-2 block text-center "> <i class="fa " :class="collapsed ? 'fa-circle-down' : 'fa-circle-up'"></i><p class="font-semibold" v-text="collapsed ? translate('Expand') : translate('Collapse')"></p></div>
                    </div>
                </div>

                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-md bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                    <a href="javascript:;"
                        class="uppercase p-2 mx-2 text-center text-white w-32 rounded-lg bg-danger"
                        @click="showLoader = true, showAddSide = true, activeItem = {}, showLoader = false;">{{ translate('add_new') }}</a>
                </div>
                <hr class="mt-2" />
                <div class="w-full bg-white">
                    
                    <datatabble :body-text-direction="translate('is_rtl')" fixed-checkbox v-if="content.columns" :headers="content.columns" :items="content.items" >

                        <template #item-picture="item">
                            <img :src="item.picture" class="w-8 h-8 rounded-full" />
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

                    <side-form-create @callback="closeSide" :conf="conf" model="Destination.create"
                    v-if="showAddSide && content && content.fillable" :columns="content.fillable" class="col-md-3" />

                    <side-form-update @callback="closeSide" :conf="conf" model="Destination.update" :item="activeItem"
                    :model_id="activeItem.destination_id" index="destination_id" v-if="showEditSide && !showAddSide"
                    :columns="content.fillable" class="col-md-3" />

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
    components: {
        'datatabble': Vue3EasyDataTable,
        SideFormCreate,
        SideFormUpdate,
        maps,
        delete_icon,
        car_icon,
        route_icon,
    },
    name: 'Destinations',
    
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
                setAllLocations(content.value.items);
                searchTextChanged();
            });
        }
        
        load();

        const setAllLocations = (items) =>
        {
            let array = [];
            for (let i = 0; i < items.length; i++) {
                array[i] = handleObject(items[i]);
            }
            locations.value = array;
        } 

        const setLocationsMarkers = (destination, i) => 
        {
            activeItem.value = destination;

            for (let a = 0; a < content.value.items.length; a++) 
                content.value.items[a].selected = false;
                
            content.value.items[i].selected = true; 
            let newObject = handleObject(destination);
            locations.value = [newObject];
            center.value = newObject.destination;
        }

        /**
         * Get current location
         */
         const getUserLocation = async () => 
        {

            if (navigator.geolocation) {
                 navigator.geolocation.getCurrentPosition(
                    position => {
                        center.value = {lat: position.coords.latitude, lng: position.coords.longitude};
                    },
                    error => {
                        showAlert(error.message, 5000)

                    }
                );
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
            let a = (item.student_name).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
            return a ? a : ((item.location_name).toLowerCase().includes(searchText.toLowerCase()) ? true : false);
        } 

        
        const updateMarker = (item) =>
        {
            activeItem.value = item;
            handleAction('edit', item)
        } 

        const clickMarker = (item, index, event) =>
        {
            activeItem.value = event;
            activeItem.value.latitude = event.destination.lat;
            activeItem.value.longitude = event.destination.lng;
            handleAction('edit', activeItem.value);
        }
        
        const handleObject = (data) =>
        {
            data.icon =  props.conf.url+'uploads/images/blue_pin.gif'
            data.origin = data.destination = { lat: parseFloat(data.latitude), lng: parseFloat(data.longitude) } 
            data.drag = true; 
            return data;
        }

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
                    showEditSide.value = true;
                    showAddSide.value = false;
                    activeItem.value = data
                    break;

                case 'delete':
                    deleteByKey('destination_id', data, 'Destination.delete');
                    break;
            }
        }

        
        return {
            locations,
            showAddSide,
            showEditSide,
            url,
            content,
            center,
            activeItem,
            translate,
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
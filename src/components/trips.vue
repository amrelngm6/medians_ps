<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">

        <div  v-if="showTrip" class=" w-full relative">
            <trip_page :conf="conf" @close="callback" :trip="activeItem"></trip_page>
        </div>    
            
        <div  v-if="content && !showTrip " class=" w-full relative">

            <maps v-if="center" :conf="conf" :key="center" :setting="setting" :center="center" @click-marker="clickMarker" @update-marker="updateMarker" :showroute="false" :waypoints="locations" @interval-callback="callback"></maps>

            <div :style="collapsed ? 'max-height:240px' : 'max-height:calc(100vh - 140px)'"  class="mx-14 h-full absolute top-4 rounded-lg p-4   bg-white rounded-xl flex-col justify-start items-start inline-flex">
                <div class="self-stretch py-4 flex-col justify-center items-start flex">
                    <div class="text-black text-lg font-semibold" v-text="translate('Trips')"></div>
                    <div class="py-2 self-stretch text-zinc-600 text-base  tracking-wide" v-text="translate('Trips description')"></div>
                </div>
                <div v-if="!collapsed" class="w-full self-stretch pt-2 flex-col justify-center items-start flex">
                    <input class="w-full bg-gray-100 rounded-lg px-4 py-2 " :placeholder="translate('find by name and address')" v-model="searchText" v-on:change="searchTextChanged"  v-on:input="searchTextChanged" v-on:keydown="searchTextChanged" />
                </div>
                <div :key="collapsed" v-if="content.items" class=" max-h-[400px] overflow-auto my-4 w-full self-stretch py-4  ">
                    <div v-if="!collapsed" v-for="(trip, index) in content.items" :key="trip.active" class="w-full">
                        <div  v-if="trip.active  && trip.trip_status == 'Scheduled'" :class="trip.selected ? 'text-gray-600' : 'bg-gray-50'"  class="mb-4 w-full  rounded-lg justify-start items-center inline-flex">
                            <div  class="w-full grow shrink basis-0 px-6 py-4 flex-col justify-center items-start gap-4 inline-flex" v-if="trip.vehicle">
                                <div class="w-full self-stretch justify-start items-start inline-flex cursor-pointer">
                                    <div @click="setLocationsMarkers(trip, index)"  class="w-full grow shrink basis-0 justify-start items-start flex gap-4">
                                        <img :src="trip.driver.picture" class="w-10 h-10" />
                                        <div :class="trip.selected ? 'text-purple-600' : 'text-gray-800'" v-if="trip.driver.name" class="self-stretch text-base font-semibold  tracking-tight">
                                            <span  v-text="trip.driver.name" ></span>
                                            <div class="self-stretch text-slate-500 text-base font-normal "> <i class="fa fa-car "></i><span v-if="trip.vehicle" class="font-semibold text-sm px-2" v-text="trip.vehicle.plate_number"></span></div>
                                            <div class="self-stretch text-slate-500 text-sm text-muted "> <i class="fa fa-map-location "></i><span v-if="trip.route" class="font-semibold text-sm px-2" v-text="trip.route.route_name"></span></div>
                                        </div>
                                    </div>
                                    <div  class="gap-2 py-2  justify-start items-start gap-2.5 inline-flex">
                                        <div class="mb-2 px-3 py-2 bg-primary rounded-full justify-center items-center flex cursor-pointer"  @click="setLocationsMarkers(trip, index)" >
                                            <div class="text-center text-xs text-white   uppercase tracking-tight "> <i class="fa fa-location-dot"></i></div>
                                        </div>
                                        <div class="mb-2 px-3 py-2 bg-primary rounded-full justify-center items-center flex cursor-pointer"  @click="handleAction('edit', trip)" >
                                            <div class="text-center text-xs text-white   uppercase tracking-tight "> <i class="fa fa-edit"></i></div>
                                        </div>
                                   </div>
                                </div>
                                <hr class="w-full" />
                                <div class="w-full relative flex">
                                    <div class="w-full relative">
                                        <h3 class="py-2 text-sm mb-10" v-text="translate('Waiting pickups')"></h3>
                                        <img :style="(lang.lang == 'en' ? 'left: ' : 'right: ') +(20 * i)+'px'" class="rounded-full w-8 h-8 left-0 bottom-1 absolute rounded-[50px] border-2 border-purple-800" v-if="tripLocation && tripLocation.status == 'waiting'" v-for="(tripLocation, i) in filterLocations(trip.pickup_locations, 'waiting')" :src="(tripLocation && tripLocation.location && tripLocation.location.picture) ? tripLocation.location.picture : 'https://via.placeholder.com/37x37'" /> 
                                        <span class="bottom-2 absolute pt-2" :style="(lang.lang == 'en' ? 'left: ' : 'right: ') +((20 * trip.waiting_locations.length) + 20)+'px'"><i class="fa fa-location-dot text-sm"></i> <span class="font-semibold  px-1" v-if="trip.pickup_locations" v-text="trip.waiting_locations.length"></span></span>
                                    </div>
                                    <div class="w-full relative">
                                        <h3 class="py-2 text-sm mb-10" v-text="translate('Active pickups')"></h3>
                                        <img :style="(lang.lang == 'en' ? 'left: ' : 'right: ') +(20 * i)+'px'" class="rounded-full w-8 h-8 left-0 bottom-1 absolute rounded-[50px] border-2 border-purple-800" v-if="tripLocation && tripLocation.status == 'moving'" v-for="(tripLocation, i) in filterLocations(trip.pickup_locations, 'moving')" :src="(tripLocation && tripLocation.location && tripLocation.location.picture) ? tripLocation.location.picture : 'https://via.placeholder.com/37x37'" /> 
                                        <span class="bottom-2 absolute pt-2" :style="(lang.lang == 'en' ? 'left: ' : 'right: ') +((20 * trip.moving_locations_count) + 20)+'px'"><i class="fa fa-location-dot text-sm"></i> <span class="font-semibold  px-1" v-if="trip.pickup_locations" v-text="trip.moving_locations_count"></span></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="flex self-stretch grow shrink basis-0 justify-between items-center inline-flex">
                    <div @click="collapsed = !collapsed" class="cursor-pointer p-2 block text-center "><i class="fa " :class="collapsed ? 'fa-circle-down' : 'fa-circle-up'"></i><p class="font-semibold" v-text="collapsed ? translate('Expand') : translate('Collapse')"></p></div>
                </div>
            </div>

            <hr class="mt-2" />

            <main v-if="content"  :key="content.items" class=" flex-1 overflow-x-hidden overflow-y-auto  w-full">
                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                </div>
                <hr class="mt-2" />
                <div class="w-full " >
                    
                    <datatabble :body-text-direction="translate('lang') == 'ar' ? 'right' : 'left'" fixed-checkbox v-if="content.columns" :headers="content.columns" :items="content.items" >

                        <template #item-picture="item">
                            <img :src="item.picture" class="w-8 h-8 rounded-full" />
                        </template>

                        <template #item-edit="item">
                            <button v-if="!item.not_editable" class="p-2  hover:text-gray-600 text-purple" @click="handleAction('edit', item)">
                                <i class="fa fa-edit"></i>
                            </button>
                        </template>
                        <template #item-delete="item">
                            <button v-if="!item.not_removeable" class="p-2 hover:text-gray-600 text-purple" @click="handleAction('delete', item)">
                                <delete_icon class="w-4"/>
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

import 'vue3-easy-data-table/dist/style.css';
import Vue3EasyDataTable from 'vue3-easy-data-table';

import {defineAsyncComponent, ref} from 'vue';
import {translate, handleGetRequest, handleRequest, deleteByKey, showAlert} from '@/utils.vue';

const maps = defineAsyncComponent(() =>
  import('@/components/includes/map.vue')
);

const trip_page = defineAsyncComponent(() =>
  import('@/components/trip_page.vue')
);

export default
{
    components: {
        'datatabble': Vue3EasyDataTable,
        maps,
        delete_icon,
        trip_page,
    },
    name: 'Destinations',
    
    setup(props) {

        const url =  props.conf.url+props.path+'?load=json';

        const activeTrip = ref(null);
        const showProfilePage = ref(null);
        const activeItem = ref({});
        const content = ref({});
        const center = ref({});
        const locations =  ref([]);
        const showList =  ref(true);
        const searchText =  ref('');
        const locationError =  ref(null);
        const collapsed =  ref(false);
        const showMap =  ref(false);

        const closeSide = () => {
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

        const setLocationsMarkers = (trip, i) => 
        {
            activeItem.value = trip;

            for (let a = 0; a < content.value.items.length; a++) 
                content.value.items[a].selected = false;
                
            content.value.items[i].selected = true; 

            
            let a, o;
            let yellowIcon = props.conf.url+'uploads/images/yellow_pin.gif';
            let blueIcon = props.conf.url+'uploads/images/blue_pin.gif';
            let vehicleIcon = props.conf.url+'uploads/images/car.svg';
            let destinationIcon = props.conf.url+'uploads/images/destination.svg';
            
            let loc = [];
            let vehcileLocation = { lat: parseFloat(trip.vehicle.last_latitude), lng: parseFloat(trip.vehicle.last_longitude) };
            loc[0] = {drag:true, status: 'waiting', icon: vehicleIcon, origin: vehcileLocation, destination: vehcileLocation }

            for (let i = 0; i < trip.pickup_locations.length; i++) {
                a = trip.pickup_locations[i];
                o = i ? trip.pickup_locations[i-1].location : a.location;
                loc[i+1] = {status: a.status, icon: (a.status == 'waiting' ? blueIcon : yellowIcon), origin: { lat: parseFloat(o.latitude), lng: parseFloat(o.longitude) }, destination: { lat: parseFloat(a.location.latitude), lng: parseFloat(a.location.longitude) } }
            }

            loc[loc.length] = {drag:true, icon: destinationIcon, origin: { lat: 0, lng: 0 }, destination: { lat: parseFloat(trip.route.latitude), lng: parseFloat(trip.route.longitude) } }
            
            showMap.value = !showMap.value
            center.value = loc[0].destination;
            console.log(loc)
            
            return loc;
        }

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
                    activeItem.value = data
                    break;

                case 'delete':
                    deleteByKey('destination_id', data, 'Destination.delete');
                    break;
            }
        }

        const filterLocations = (locationsList, newstatus) =>
        {
            let data = [];
            
            for (let i = 0; i < locationsList.length; i++) {
                (locationsList[i].status == newstatus) ?? data.push(locationsList[i]);
            }

            return data;
        }   

        
        const setLocationsPickups = (trip) =>
        {
            activeTrip.value = trip
        }
        

        const editFields = (data, show = true) =>
        {
            showTrip.value = show;
            activeItem.value = data
        }


        return {
            editFields,
            activeTrip,
            setLocationsPickups,
            filterLocations,
            locations,
            url,
            content,
            center,
            showMap,
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

// export default 
// {
//     components:{
//         'datatabble': Vue3EasyDataTable,
//         trip_page,
//         translate,
//         maps,
//     },
//     name:'Trips',
//     data() {
//         return {
//             url: this.conf.url+this.path+'?load=json',
//             content: {
//                 title: '',
//                 items: [],
//                 columns: [],
//             },

//             activeItem:{},
//             center:{lat:31, lng:30},
//             activeTrip:null,
//             showAddSide:false,
//             showLoader: true,
//             locations: [],
//             showList: true,
//             showMap: true,
//             showTrip: false,
//             collapsed: false,
//             searchText: '',
//         }
//     },

//     computed: {
//         bindings() {

//             this.content.columns.push({
//                     key: this.translate("actions"),
//                     component: dataTableSideActions,
//                     sortable: false,
//                 });

//             return {

//                 columns: this.content.columns,
//                 fillable: this.content.fillable,
//                 data: this.content.items
//             }
//         }
//     },
//     props: [
//         'path',
//         'lang',
//         'setting',
//         'conf',
//         'auth',
//     ],
//     mounted() 
//     {
//         this.load()
//         setInterval(() => {
//             // this.load()
//         }, 10000);
//     },

//     methods: 
//     {
        
//         editFields(data, show = true)
//         {
//             this.showTrip = show;
//             this.activeItem = data
//         },
//         callback()
//         {
//             this.editFields(null, false)
//             this.showTrip = false;
//         },
//         filterLocations(locations, status)
//         {
//             let data = [];
            
//             for (let i = 0; i < locations.length; i++) {
//                 if (locations[i].status == status)
//                 {
//                     data.push(locations[i]);
//                 }
//             }

//             return data;
//         },

//         setLocationsMarkers(trip, i)
//         {   

//             for (let a = 0; a < this.content.items.length; a++) 
//                 this.content.items[a].selected = false;
                
//             this.content.items[i].selected = true; 
//             this.locations = this.setLocationsPickups(trip);
//         },  
        
//         clickMarker(item, event)
//         {
            
//         },

//         updateMarker(item, event)
//         {
//             var params = new URLSearchParams();
//             params.append('type', 'Vehicle.update')
//             params.append('params[vehicle_id]', this.activeTrip.vehicle_id)
//             params.append('params[last_latitude]', item.destination.lat)
//             params.append('params[last_longitude]', item.destination.lng)
//             handleRequest(params, '/api/update').then(response => {
//                 this.$alert(response.result)
//             })

//         },  
        
//         setLocationsPickups(trip)
//         {
//             this.activeTrip = trip
//             let a, o;
//             this.locations = [];
//             this.locations[this.locations.length] = {drag:true, status: 'waiting', icon: this.conf.url+'uploads/images/car.svg', origin: { lat: parseFloat(trip.vehicle.last_latitude), lng: parseFloat(trip.vehicle.last_longitude) }, destination: { lat: parseFloat(trip.vehicle.last_latitude), lng: parseFloat(trip.vehicle.last_longitude) } }
//             for (let i = 0; i < trip.pickup_locations.length; i++) {
//                 a = trip.pickup_locations[i].location;
//                 o = i ? trip.pickup_locations[i-1].location : trip.pickup_locations[i].location;
//                 this.locations[i+1] = {status: trip.pickup_locations[i].status, icon: this.conf.url+ 'uploads/images/'+ (trip.pickup_locations[i].status == 'waiting' ? 'blue_pin.gif' : 'yellow_pin.gif'), origin: { lat: parseFloat(o.latitude), lng: parseFloat(o.longitude) }, destination: { lat: parseFloat(a.latitude), lng: parseFloat(a.longitude) } }
//             }
//             this.locations[this.locations.length] = {drag:true, icon: this.conf.url+'uploads/images/destination.svg', origin: { lat: 0, lng: 0 }, destination: { lat: parseFloat(trip.route.latitude), lng: parseFloat(trip.route.longitude) } }
//             this.showMap = !this.showMap
//             this.center = this.locations[0].destination;
//             return this.locations;
//         },  

//         /**
//          * Handle actions from datatable buttons
//          * Called From 'dataTableActions' component
//          * 
//          * @param String actionName 
//          * @param Object data
//          */  
//         handleAction(actionName, data) {
//             switch(actionName) 
//             {
//                 case 'view':
//                     // window.open(this.conf.url+data.content.prefix)
//                     break;  

//                 case 'edit':
//                     this.editFields(data);
//                     break;  

//                 case 'delete':
//                     this.$parent.deleteByKey('vehicle_id', data.vehicle_id, 'Vehicle.delete');
//                     break;  
//             }
//         },


//         setValues(data) {
//             this.content = JSON.parse(JSON.stringify(data)); 
//             if (this.activeTrip && this.content && this.content.items)
//             {
//                 for (let i = 0; i < this.content.items.length; i++) {
//                     const a = this.content.items[i];
//                     if (a.trip_id == this.activeTrip.trip_id)
//                     {
//                         this.setLocationsPickups(a); 
//                     }
//                 }
                
//             }
//             return this
//         },
        

</script>
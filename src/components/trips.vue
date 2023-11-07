<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">

        <div  v-if="showTrip" class=" w-full relative">
            <trip_page @close="editFields" :trip="activeItem"></trip_page>
        </div>    
            
        <div  v-if="content && !showTrip " class=" w-full relative">

            <maps :center="locations[0]" @click-marker="clickMarker" @update-marker="updateMarker" :showroute="true" :waypoints="locations" @interval-callback="callback"></maps>

            <div style="max-height:calc(100vh - 140px)" class="h-full absolute top-4 rounded-lg p-4   bg-white rounded-xl flex-col justify-start items-start inline-flex">
                <div class="self-stretch py-4 flex-col justify-center items-start flex">
                    <div class="text-black text-lg font-semibold" v-text="__('Trips')"></div>
                    <div class="py-2 self-stretch text-zinc-600 text-base  tracking-wide" v-text="__('Trips description')"></div>
                </div>
                <div class="w-full self-stretch pt-2 flex-col justify-center items-start flex">
                    <input class="w-full bg-gray-100 rounded-lg px-4 py-2 " :placeholder="__('find by name and address')" v-model="searchText" v-on:change="searchTextChanged"  v-on:input="searchTextChanged" v-on:keydown="searchTextChanged" />
                </div>
                <div v-if="content.items" class=" max-h-[400px] overflow-auto my-4 w-full self-stretch py-4  ">

                    <div v-for="(trip, index) in content.items" :key="trip.active" class="w-full">
                        <div  v-if="showList  && trip.active  && trip.trip_status == 'Scheduled'" :class="trip.selected ? 'text-gray-600' : 'bg-gray-50'"  class="mb-4 w-full  rounded-lg justify-start items-center inline-flex">
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
                                    <div  class="gap-2 py-2 flex justify-start items-start gap-2.5 inline-flex">
                                        <div class="px-3 py-2 bg-primary rounded-full justify-center items-center flex cursor-pointer"  @click="setLocationsMarkers(trip, index)" >
                                            <div class="text-center text-xs text-white   uppercase tracking-tight "> <i class="fa fa-location-dot"></i></div>
                                        </div>
                                   </div>
                                </div>
                                <hr class="w-full" />
                                <div class="w-full relative flex">
                                    <div class="w-full relative">
                                        <h3 class="py-2 text-sm mb-10" v-text="__('Waiting pickups')"></h3>
                                        <img :style="(lang.lang == 'en' ? 'left: ' : 'right: ') +(20 * i)+'px'" class="rounded-full w-8 h-8 left-0 bottom-1 absolute rounded-[50px] border-2 border-purple-800" v-if="tripLocation.status == 'waiting'" v-for="(tripLocation, i) in filterLocations(trip.pickup_locations, 'waiting')" :src="(tripLocation && tripLocation.location && tripLocation.location.picture) ? tripLocation.location.picture : 'https://via.placeholder.com/37x37'" /> 
                                        <span class="bottom-2 absolute pt-2" :style="(lang.lang == 'en' ? 'left: ' : 'right: ') +((20 * trip.waiting_locations.length) + 20)+'px'"><i class="fa fa-location-dot text-sm"></i> <span class="font-semibold  px-1" v-if="trip.pickup_locations" v-text="trip.waiting_locations.length"></span></span>
                                    </div>
                                    <div class="w-full relative">
                                        <h3 class="py-2 text-sm mb-10" v-text="__('Active pickups')"></h3>
                                        <img :style="(lang.lang == 'en' ? 'left: ' : 'right: ') +(20 * i)+'px'" class="rounded-full w-8 h-8 left-0 bottom-1 absolute rounded-[50px] border-2 border-purple-800" v-if="tripLocation.status == 'moving'" v-for="(tripLocation, i) in filterLocations(trip.pickup_locations, 'moving')" :src="(tripLocation && tripLocation.location && tripLocation.location.picture) ? tripLocation.location.picture : 'https://via.placeholder.com/37x37'" /> 
                                        <span class="bottom-2 absolute pt-2" :style="(lang.lang == 'en' ? 'left: ' : 'right: ') +((20 * trip.moving_locations_count) + 20)+'px'"><i class="fa fa-location-dot text-sm"></i> <span class="font-semibold  px-1" v-if="trip.pickup_locations" v-text="trip.moving_locations_count"></span></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <hr class="mt-2" />

            <main v-if="content"  :key="content.items" class=" flex-1 overflow-x-hidden overflow-y-auto  w-full">
                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                </div>
                <hr class="mt-2" />
                <div class="w-full flex gap gap-6" >
                    <data-table ref="devices_orders" @actionTriggered="handleAction" v-bind="bindings"/>
                </div>
            </main>
        </div>
    </div>
</template>
<script>
import dataTableSideActions from './includes/data-table-side-actions.vue';

export default 
{
    components:{
        dataTableSideActions,
    },
    name:'Trips',
    data() {
        return {
            url: this.conf.url+this.path+'?load=json',
            content: {
                title: '',
                items: [],
                columns: [],
            },

            activeItem:{},
            activeTrip:null,
            showAddSide:false,
            showEditSide:false,
            showLoader: true,
            locations: [],
            showList: true,
            showMap: true,
            showTrip: false,
            searchText: '',
        }
    },

    computed: {
        bindings() {

            this.content.columns.push({
                    key: this.__("actions"),
                    component: dataTableSideActions,
                    sortable: false,
                });

            return {

                columns: this.content.columns,
                fillable: this.content.fillable,
                data: this.content.items
            }
        }
    },
    props: [
        'path',
        'lang',
        'setting',
        'conf',
        'auth',
    ],
    mounted() 
    {
        this.load()

        setInterval(() => {
            this.load()
        }, 10000);
    },

    methods: 
    {
        editFields(data, show = true)
        {
            this.showTrip = show;
            this.activeItem = trip
        },
        callback()
        {
            console.log(this.locations);
        },
        filterLocations(locations, status)
        {
            let data = [];
            
            for (let i = 0; i < locations.length; i++) {
                if (locations[i].status == status)
                {
                    data.push(locations[i]);
                }
            }

            return data;
        },

        searchTextChanged()
        {
            this.showList = false;
            for (let i = 0; i < this.content.items.length; i++) {
                this.content.items[i].active = this.searchText.trim() ? this.checkSimilar(this.content.items[i]) : 1;
            }
            this.showList = true;
        },

        checkSimilar(item)
        {
            let a = (item.driver.name).toLowerCase().includes(this.searchText.toLowerCase()) ? true : false;
            return a ? a : ((item.vehicle.plate_number).toLowerCase().includes(this.searchText.toLowerCase()) ? true : false);
        },
        setLocationsMarkers(trip, i)
        {   

            for (let a = 0; a < this.content.items.length; a++) 
                this.content.items[a].selected = false;
                
            this.content.items[i].selected = true; 
            this.locations = this.setLocationsPickups(trip);
        },  
        
        clickMarker(item, event)
        {
            
        },

        updateMarker(item, event)
        {
            var params = new URLSearchParams();
            params.append('type', 'Vehicle.update')
            params.append('params[vehicle_id]', this.activeTrip.vehicle_id)
            params.append('params[last_latitude]', item.destination.lat)
            params.append('params[last_longitude]', item.destination.lng)
            this.$parent.handleRequest(params, '/api/update').then(response => {
                this.$alert(response.result)
            })

        },  
        
        setLocationsPickups(trip)
        {
            this.activeTrip = trip
            let a, o;
            this.locations = [];
            this.locations[this.locations.length] = {drag:true, status: 'waiting', icon: this.conf.url+'uploads/images/car.svg', origin: { lat: parseFloat(trip.vehicle.last_latitude), lng: parseFloat(trip.vehicle.last_longitude) }, destination: { lat: parseFloat(trip.vehicle.last_latitude), lng: parseFloat(trip.vehicle.last_longitude) } }
            for (let i = 0; i < trip.pickup_locations.length; i++) {
                a = trip.pickup_locations[i].location;
                o = i ? trip.pickup_locations[i-1].location : trip.pickup_locations[i].location;
                this.locations[i+1] = {status: trip.pickup_locations[i].status, icon: this.conf.url+ 'uploads/images/'+ (trip.pickup_locations[i].status == 'waiting' ? 'blue_pin.gif' : 'yellow_pin.gif'), origin: { lat: parseFloat(o.latitude), lng: parseFloat(o.longitude) }, destination: { lat: parseFloat(a.latitude), lng: parseFloat(a.longitude) } }
            }
            this.locations[this.locations.length] = {drag:true, icon: this.conf.url+'uploads/images/destination.svg', origin: { lat: 0, lng: 0 }, destination: { lat: parseFloat(trip.route.latitude), lng: parseFloat(trip.route.longitude) } }
            this.showMap = !this.showMap
            
            return this.locations;
        },  

        /**
         * Handle actions from datatable buttons
         * Called From 'dataTableActions' component
         * 
         * @param String actionName 
         * @param Object data
         */  
        handleAction(actionName, data) {
            switch(actionName) 
            {
                case 'view':
                    // window.open(this.conf.url+data.content.prefix)
                    break;  

                case 'edit':
                    this.showEditSide = true; 
                    this.showAddSide = false; 
                    this.activeItem = data
                    break;  

                case 'delete':
                    this.$parent.deleteByKey('vehicle_id', data.vehicle_id, 'Vehicle.delete');
                    break;  
            }
        },

        load()
        {
            this.$parent.handleGetRequest( this.url ).then(response=> {
                this.setValues(response)
                this.searchTextChanged()
            });
        },

        filterKeys(object)
        {
            let filledData = Object.keys(object).reduce((acc, curr) => {
                if (object[curr]) {
                    acc[curr] = object[curr];
                }
                return acc;
            }, {});
            return filledData;
        },
        
        setValues(data) {
            this.content = JSON.parse(JSON.stringify(data)); 
            if (this.activeTrip)
            {
                for (let i = 0; i < this.content.items.length; i++) {
                    const a = this.content.items[i];
                    if (a.trip_id == this.activeTrip.trip_id)
                    {
                        this.setLocationsPickups(a); 
                    }
                }
                
            }
            return this
        },
        __(i)
        {
            return this.$root.$children[0].__(i);
        }
    }
};
</script>
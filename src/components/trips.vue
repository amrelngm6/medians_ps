<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div  v-if="content && !showLoader" class=" w-full relative">

            <maps :key="locations" :waypoints="locations"></maps>
            <div style="max-height:calc(100vh - 140px)" class="h-full absolute top-4 rounded-lg p-4 w-96  bg-white rounded-xl flex-col justify-start items-start inline-flex">
                <div class="self-stretch p-10 flex-col justify-center items-start flex">
                    <div class="text-black text-lg font-semibold" v-text="__('Trips')"></div>
                    <div class="py-2 self-stretch text-zinc-600 text-base  tracking-wide" v-text="__('Trips description')"></div>
                </div>
                <div class="w-full self-stretch pt-2 flex-col justify-center items-start flex">
                    <input class="w-full bg-gray-100 rounded-lg px-4 py-2 " :placeholder="__('find by name and address')" v-model="searchText" v-on:change="searchTextChanged"  v-on:input="searchTextChanged" v-on:keydown="searchTextChanged" />
                </div>
                <div v-if="content.items" class=" max-h-[400px] overflow-auto my-4 w-full self-stretch p-10  ">

                    <div v-for="(trip, index) in content.items" :key="trip.active" class="w-full">
                        <div  v-if="showList  && trip.active" :class="trip.selected ? 'text-fuchsia-600' : 'bg-gray-50'"  class="mb-4 w-full  rounded-lg justify-start items-center inline-flex">
                            <div  class="w-full grow shrink basis-0 px-6 py-4 flex-col justify-center items-start gap-4 inline-flex" v-if="trip.vehicle">
                                <div class="w-full self-stretch justify-start items-start inline-flex cursor-pointer">
                                    <div @click="setLocationsMarkers(trip, index)"  class="w-full grow shrink basis-0 justify-start items-start flex gap-4">
                                        <img :src="trip.driver.picture" class="w-10 h-10" />
                                        <div :class="trip.selected ? 'text-fuchsia-600' : 'text-gray-800'" v-text="trip.driver.name" v-if="trip.driver.name" class="pt-2 self-stretch text-base font-semibold  tracking-tight"></div>
                                    </div>
                                    <div  class="gap-2 py-2 flex justify-start items-start gap-2.5 inline-flex">
                                        <div class="px-3 py-2 bg-primary rounded-full justify-center items-center flex cursor-pointer"  @click="setLocationsMarkers(trip, index)" >
                                            <div class="text-center text-xs text-white   uppercase tracking-tight "> <i class="fa fa-location-dot"></i></div>
                                        </div>
                                        <div class="px-3 py-2 bg-purple-800 rounded justify-center items-center flex cursor-pointer"  @click="handleAction('edit', trip)">
                                            <div class="text-center text-xs text-white   uppercase tracking-tight "> <i class="fa fa-edit"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="w-full" />
                                <div class="w-full h-8 relative flex">
                                    <img :style="'left: '+(20 * i)+'px'" v-for="(location, i) in trip.pickup_locations" class="rounded-full w-8 h-8 left-0 top-0 absolute rounded-[50px] border-2 border-purple-800" :src="(location.student && location.student.picture) ? location.student.picture : 'https://via.placeholder.com/37x37'" /> 
                                    <span class="absolute pt-2" :style="'left: '+((20 * trip.pickup_locations.length) + 20)+'px'"><i class="fa fa-location-dot text-sm"></i> <span class="font-semibold  px-1" v-if="trip.pickup_locations" v-text="trip.pickup_locations.length"></span></span>
                                    <div class="right-0 absolute  self-stretch text-slate-500 text-base font-normal "> <i class="fa fa-car px-2"></i><span v-if="trip.vehicle" class="font-semibold text-sm" v-text="trip.vehicle.plate_number"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div
                    class="self-stretch grow shrink basis-0 p-[25px] bg-neutral-50 justify-between items-center inline-flex">
                    <div class="bg-fuchsia-600 rounded-lg text-white text-xs font-medium px-3 py-2 uppercase cursor-pointer" @click="showLoader = true, showAddSide = true,activeItem = {}, showLoader = false; " v-text="__('add new')"></div>
                </div>
            </div>

            <hr class="mt-2" />

            <main v-if="content && !showLoader" class=" flex-1 overflow-x-hidden overflow-y-auto  w-full">
                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                    <a href="javascript:;" class="uppercase p-2 mx-2 text-center text-white w-32 rounded bg-gradient-purple hover:bg-red-800" @click="showLoader = true, showAddSide = true,activeItem = {}, showLoader = false; ">{{__('add_new')}}</a>
                </div>
                <hr class="mt-2" />
                <div class="w-full flex gap gap-6" >
                    <data-table ref="devices_orders" @actionTriggered="handleAction" v-bind="bindings"/>

                    <side-form-create :conf="conf" model="Trip.create" v-if="showAddSide && content && content.fillable" :columns="content.fillable"  class="col-md-3" />

                    <side-form-update :conf="conf" model="Trip.update" :item="activeItem" :model_id="activeItem.trip_id" index="trip_id" v-if="showEditSide && !showAddSide " :columns="content.fillable"  class="col-md-3" />

                </div>
                <!-- END New releases -->
            </main>
        </div>
    </div>
</template>
<script>
import dataTableActions from './includes/data-table-actions.vue';

export default 
{
    components:{
        dataTableActions,
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
            showAddSide:false,
            showEditSide:false,
            showLoader: true,
            locations: [],
            showList: true,
            searchText: '',
        }
    },

    computed: {
        bindings() {

            this.content.columns.push({
                    key: this.__("actions"),
                    component: dataTableActions,
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
    },

    methods: 
    {

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
        setLocationsMarkers(route, i)
        {   

            for (let a = 0; a < this.content.items.length; a++) 
                this.content.items[a].selected = false;
                
            this.content.items[i].selected = true; 
            this.locations = this.setLocationsPickups(route);
        },  
        
        setLocationsPickups(route)
        {
            
            let a;
            let locations = [];
            // = parseFloat(location.latitude);
            for (let i = 0; i < route.pickup_locations.length; i++) {
                a = route.pickup_locations[i].location;
                locations[i] = {icon: this.conf.url+'uploads/images/blue_pin.gif', origin: { lat: parseFloat(a.latitude), lng: parseFloat(a.longitude) }, destination: { lat: parseFloat(a.latitude), lng: parseFloat(a.longitude) } }
            }
            locations[locations.length] = {icon: this.conf.url+'uploads/images/car.svg', origin: { lat: parseFloat(route.vehicle.last_latitude), lng: parseFloat(route.vehicle.last_longitude) }, destination: { lat: parseFloat(route.vehicle.last_latitude), lng: parseFloat(route.vehicle.last_longitude) } }
            return locations;
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
            this.showLoader = true;
            this.$parent.handleGetRequest( this.url ).then(response=> {
                this.setValues(response)
                this.showLoader = false;
                this.searchTextChanged()

                // this.$alert(response)
            });
        },
        
        setValues(data) {
            this.content = JSON.parse(JSON.stringify(data)); return this
        },
        __(i)
        {
            return this.$root.$children[0].__(i);
        }
    }
};
</script>
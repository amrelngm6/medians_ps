<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div class=" w-full relative">

            <maps :key="locations" :waypoints="locations"></maps>
            <div style="max-height:calc(100vh - 140px)" class="h-full absolute top-4 rounded-lg p-4 w-96  bg-white rounded-xl flex-col justify-start items-start inline-flex">
                <div class="self-stretch p-10 flex-col justify-center items-start flex">
                    <div class="text-black text-lg font-semibold" v-text="__('Routes')"></div>
                    <div class="py-2 self-stretch text-zinc-600 text-base  tracking-wide" v-text="__('Routes description')"></div>
                </div>
                <div  class=" max-h-[400px] overflow-auto my-4 w-full self-stretch p-10  ">
                    <div v-for="(route, index) in content.items" class="w-full self-stretch justify-start items-center inline-flex">
                        <div class="grow shrink basis-0 gap-4 justify-start items-center flex">
                            <div class="justify-start items-center flex">
                                <img class="w-10 h-10 rounded-full shadow-inner border-2 border-black"
                                    src="https://via.placeholder.com/60x60" />
                            </div>
                            <div @click="setLocationsMarkers(route, index)"  class="grow shrink basis-0 flex-col justify-center items-start inline-flex cursor-pointer">
                                <div :class="route.selected ? 'text-fuchsia-600' : 'text-black'" class=" font-semibold text-base " v-text="route.route_name"></div>
                                <div class="self-stretch text-slate-500 text-base font-normal "><i class="fa fa-map-pin text-sm"></i> <span class="px-1" v-if="route.pickup_locations" v-text="route.pickup_locations.length"></span> - <span v-if="route.vehicle" class="text-sm" v-text="route.vehicle.plate_number"></span></div>
                            </div>
                        </div>
                        <div class="justify-center items-center flex">
                            <div class="px-3 py-2 bg-fuchsia-600 rounded justify-center items-center flex mr-2 cursor-pointer"  @click="handleAction('edit', route)">
                                <div class="text-center text-xs text-white   uppercase tracking-tight "> <i class="fa fa-edit"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="self-stretch grow shrink basis-0 p-[25px] bg-neutral-50 justify-between items-center inline-flex">
                    <div @click="showAddSide = true" class="bg-fuchsia-600 rounded-lg text-white text-xs font-medium px-3 py-2 uppercase cursor-pointer" >Add new student</div>
                </div>
            </div>

            <hr class="mt-2" />

            
            <main v-if="content && !showLoader" class=" flex-1 overflow-x-hidden overflow-y-auto  w-full relative">
                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                    <a href="javascript:;" class="uppercase p-2 mx-2 text-center text-white w-32 rounded bg-gradient-purple hover:bg-red-800" @click="showLoader = true, showAddSide = true,activeItem = {}, showLoader = false; ">{{__('add_new')}}</a>
                </div>
                <hr class="mt-2" />
                <div class="w-full flex gap gap-6" >
                    <data-table ref="devices_orders" @actionTriggered="handleAction" v-bind="bindings"/>

                    <side-form-create :conf="conf" model="Routes.create" v-if="showAddSide && content && content.fillable" :columns="content.fillable"  class="col-md-3" />

                    <side-form-update :conf="conf" model="Routes.update" :item="activeItem" :model_id="activeItem.route_id" index="route_id" v-if="showEditSide && !showAddSide " :columns="content.fillable"  class="col-md-3" />

                </div>
                <!-- END New releases -->
            </main>
        </div>
    </div>
</template>
<script>
import dataTableActions from './includes/data-table-actions.vue';
import sideFormCreate from './includes/side-form-create.vue';
import sideFormUpdate from './includes/side-form-update.vue';

export default 
{
    components:{
        dataTableActions,
        sideFormCreate,
        sideFormUpdate,
    },
    name:'Students',
    data() {
        return {
            url: this.conf.url+this.path+'?load=json',
            content: {
                title: '',
                items: [],
                columns: [],
            },
            locations: [],
            activeItem:{},
            showAddSide:false,
            showEditSide:false,
            showLoader: true,
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

        
        setLocationsMarkers(route, i)
        {   

            for (let a = 0; a < this.content.items.length; a++) 
                this.content.items[a].selected = false;
                
            this.content.items[i].selected = true; 
            this.locations = this.setLocationsPickups(route.pickup_locations);
        },  
        
        setLocationsPickups(pickup_locations)
        {
            
            let a;
            let locations = [];
            // = parseFloat(location.latitude);
            for (let i = 0; i < pickup_locations.length; i++) {
                a = pickup_locations[i];
                locations[i] = {icon: this.conf.url+'uploads/images/blue_pin.gif', origin: { lat: parseFloat(a.latitude), lng: parseFloat(a.longitude) }, destination: { lat: parseFloat(a.latitude), lng: parseFloat(a.longitude) } }
            }

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
                    this.$parent.deleteByKey('route_id', data.route_id, 'Routes.delete');
                    break;  
            }
        },

        load()
        {
            this.showLoader = true;
            this.$parent.handleGetRequest( this.url ).then(response=> {
                this.setValues(response)
                this.showLoader = false;
                // this.$alert(response)
            });
        },
        
        setValues(data) {
            
            this.content = JSON.parse(JSON.stringify(data));
            let a;
            for (let i = 0; i < this.content.items.length; i++) {
                a = this.content.items[i];
                this.locations[i] = {icon: this.conf.url+'uploads/images/blue_pin.gif', origin: { lat: 30.0581227357153761, lng: 31.21921983886761 }, destination: { lat: parseFloat(a.latitude), lng: parseFloat(a.longitude) } }
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
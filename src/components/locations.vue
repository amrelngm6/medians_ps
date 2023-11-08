<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div class=" w-full">

            <main v-if="content && !showLoader" class="relative flex-1 overflow-x-hidden overflow-y-auto  w-full">
                <maps @update-marker="updatedLocation" @click-marker="updatedLocation" v-if="locations.length" :key="center" :center="center" :waypoints="locations"></maps>
                <div  :style="collapsed ? 'max-height:240px' : 'max-height:calc(100vh - 140px)'" class="mx-16 h-full absolute top-4 rounded-lg p-4 w-96  bg-white rounded-xl flex-col justify-start items-start inline-flex">
                    <div class="self-stretch py-4 flex-col justify-center items-start flex">
                        <div class="text-black text-lg font-semibold" v-text="__('Pickup locations')"></div>
                        <div class="py-2 self-stretch text-zinc-600 text-base  tracking-wide" v-text="__('Pickup locations description')"></div>
                    </div>
                    <div v-if="!collapsed" class="w-full self-stretch pt-2 flex-col justify-center items-start flex">
                        <input class="w-full bg-gray-100 rounded-lg px-4 py-2 " :placeholder="__('find by name and address')" v-model="searchText" v-on:change="searchTextChanged"  v-on:input="searchTextChanged" v-on:keydown="searchTextChanged" />
                    </div>
                    <div :key="collapsed" v-if="!collapsed" class=" max-h-[400px] overflow-auto my-4 w-full self-stretch py-4  ">
                        <div v-for="location in content.items" :key="location.active" v-if="showList && location.active"  class="pt-2 w-full self-stretch justify-start items-center inline-flex ">
                            <div v-if="location.active" class="grow shrink basis-0 gap-4 justify-start items-center flex">
                                <div class="justify-start items-center flex">
                                    <img class="w-10 h-10 rounded-full shadow-inner border-2 border-black"
                                        :src="(location.student && location.student.picture) ? location.student.picture : 'https://via.placeholder.com/60x6'" />
                                </div>
                                <div @click="setLocationsMarkers(location)" class="grow shrink basis-0 flex-col justify-center items-start gap-[3px] inline-flex cursor-pointer">
                                    <div class="text-black font-semibold text-base " v-text="location.student_name"></div>
                                    <div class="self-stretch text-slate-500 text-sm font-normal " v-text="location.location_name + ' - ' + location.address"></div>
                                </div>
                            </div>
                            <div class="justify-center items-center flex">
                                <div class="px-3 py-2 bg-purple-800 rounded justify-center items-center flex mr-2 cursor-pointer"  @click="handleAction('edit', location)">
                                    <div class="text-center text-xs text-white   uppercase tracking-tight"> <i class="fa fa-edit"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex self-stretch grow shrink basis-0 justify-between items-center inline-flex">
                        <div class="menu-dark rounded-lg text-white text-xs font-medium px-4 py-3 uppercase cursor-pointer" @click="showLoader = true, showAddSide = true,activeItem = {}, showLoader = false; " v-text="__('add new')"></div>
                        <div @click="collapsed = !collapsed" class="cursor-pointer p-2 block text-center "><i class="fa " :class="collapsed ? 'fa-circle-down' : 'fa-circle-up'"></i><p class="font-semibold" v-text="collapsed ? __('Expand') : __('Collapse')"></p></div>
                    </div>
                </div>

                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                    <a href="javascript:;"
                        class="uppercase p-2 mx-2 text-center text-white w-32 rounded-lg menu-dark hover:bg-purple-800"
                        @click="showLoader = true, showAddSide = true, activeItem = {}, showLoader = false;">{{ __('add_new') }}</a>
                </div>
                <hr class="mt-2" />
                <div class="w-full flex gap gap-6">
                    
                    <data-table ref="devices_orders" @actionTriggered="handleAction" v-bind="bindings" />

                    <side-form-create :conf="conf" model="PickupLocation.create"
                        v-if="showAddSide && content && content.fillable" :columns="content.fillable" class="col-md-3" />

                    <side-form-update :conf="conf" model="PickupLocation.update" :item="activeItem"
                        :model_id="activeItem.pickup_id" index="pickup_id" v-if="showEditSide && !showAddSide"
                        :columns="content.fillable" class="col-md-3" />

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
        components: {
            dataTableActions,
        },
        name: 'Locations',
        data() {
            return {
                url: this.conf.url + this.path + '?load=json',
                content: {
                    title: '',
                    items: [],
                    columns: [],
                },
                
                locations: [],
                activeItem: {},
                showAddSide: false,
                showEditSide: false,
                showLoader: true,
                collapsed: false,
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
        mounted() {
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
                let a = (item.student_name).toLowerCase().includes(this.searchText.toLowerCase()) ? true : false;
                return a ? a : ((item.location_name).toLowerCase().includes(this.searchText.toLowerCase()) ? true : false);
            },

            updatedLocation(item, index)
            {
                item.latitude = item.destination.lat;
                item.longitude = item.destination.lng;
                this.handleAction('edit', item)
                console.log(item);
            },  
            setLocationsMarkers(location)
            {   
                this.locations = [this.handleObject(location)];
                this.center = this.locations[0].destination;
            },  

            /**
             * Handle actions from datatable buttons
             * Called From 'dataTableActions' component
             * 
             * @param String actionName 
             * @param Object data
             */
            handleAction(actionName, data) {
                switch (actionName) {
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

            load() {
                this.showLoader = true;
                this.$parent.handleGetRequest(this.url).then(response => {
                    this.setValues(response)
                    this.showLoader = false;
                    this.searchTextChanged()
                    // this.$alert(response)
                });
            },

            setValues(data) {

                this.content = JSON.parse(JSON.stringify(data));
                for (let i = 0; i < this.content.items.length; i++) {
                    this.locations[i] = this.handleObject(this.content.items[i]);
                }
                this.center = this.locations[0].destination;
                return this
            },

            /**
             * Handle object
             * @param {Model Object} i 
             */
            handleObject(data)
            {
                data.icon =  this.conf.url+'uploads/images/blue_pin.gif'
                data.origin = data.destination = { lat: parseFloat(data.latitude), lng: parseFloat(data.longitude) } 
                data.drag = true; 
                return data;
            },  
            __(i) {
                return this.$root.$children[0].__(i);
            }
        }
    };
</script>
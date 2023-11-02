<template>
    <div class=" w-full">
        <div class="grid xl:grid-cols-12 lg:grid-cols-12 grid-cols-1 gap-6" v-if="!showLoader">
            <div class="xl:col-span-3 lg:col-span-5">
                <div class="card px-4 py-6 mb-6">
                    <div class="text-center">

                        <img :src="activeItem.picture" alt=""
                            class=" rounded-full p-1 bg-gray-100 dark:bg-gray-700 mx-auto">
                        <h4 class="mb-1 mt-3 text-lg dark:text-gray-300" v-text="activeItem.name"></h4>
                        <p class="text-gray-400 mb-4 dark:text-gray-400" v-text="activeItem.email"></p>

                        <button type="button" @click="$emit('edit', activeItem)" class="bg-gray-50 border  border-1 hover:bg-primary mb-3 px-6 py-2 rounded-lg text-primary"
                            v-text="__('Edit')"></button>
                    </div>

                    <hr class="mt-5 dark:border-gray-600">

                    <div class="text-start mt-6 text-sm">
                        <div class="space-y-7">
                            <p class="text-zinc-400 dark:text-gray-400 flex gap-4"><strong
                                    v-text="__('First name')"></strong> <span class="ms-2"
                                    v-text="activeItem.first_name"></span></p>
                            <p class="text-zinc-400 dark:text-gray-400 flex gap-4"><strong
                                    v-text="__('Last name')"></strong> <span class="ms-2"
                                    v-text="activeItem.last_name"></span></p>
                            <p class="text-zinc-400 dark:text-gray-400 flex gap-4"><strong v-text="__('Email')"></strong>
                                <span class="ms-2" v-text="activeItem.email"></span></p>
                            <p class="text-zinc-400 dark:text-gray-400 flex gap-4"><strong v-text="__('Phone')"></strong>
                                <span class="ms-2" v-text="activeItem.contact_number"></span></p>
                            <p class="text-zinc-400 dark:text-gray-400 flex gap-4"><strong
                                    v-text="__('License number')"></strong> <span class="ms-2"
                                    v-text="activeItem.driver_license_number"></span></p>
                            <p class="text-zinc-400 dark:text-gray-400 flex gap-4 items-start"><strong class="flex-shrink"
                                    v-text="__('address')"></strong> <span class="ms-2" v-text="activeItem.address"></span>
                            </p>
                        </div>
                    </div>
                    <hr class="my-5 dark:border-gray-600">

                </div> <!-- end card -->
            </div>

            <div class="xl:col-span-9 lg:col-span-7">
                <div class="card">
                    <div class="p-6">
                        <div class="w-full">
                            <nav class="lg:flex items-center justify-around rounded-xl space-x-3 bg-gray-100 p-2 dark:bg-gray-900/30"
                                aria-label="Tabs" role="tablist">
                                <button @click="setActiveStatus('info')" type="button"
                                    v-text="__('Info')"
                                    :class="activeStatus == 'info' ? 'menu-dark text-white font-semibold' : 'text-gray-500'"
                                    class="hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white active">
                                </button> <!-- button-end -->
                                <button @click="setActiveStatus('trips')" type="button"
                                    v-text="__('Trips')"
                                    :class="activeStatus == 'trips' ? 'menu-dark text-white font-semibold' : 'text-gray-500'"
                                    class="hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white">
                                </button> <!-- button-end -->
                                <button @click="setActiveStatus('reviews')"  type="button"
                                v-text="__('Reviews')"
                                    :class="activeStatus == 'reviews' ? 'menu-dark text-white font-semibold' : 'text-gray-500'"
                                    class="hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white">
                                </button> <!-- button-end -->
                                <button type="button"  @click="setActiveStatus('help_messages')"
                                    :class="activeStatus == 'help_messages' ? 'menu-dark text-white font-semibold' : 'text-gray-500'"
                                    v-text="__('Help messages')"
                                    class="hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white">
                                </button> <!-- button-end -->
                            </nav> <!-- nav-end -->

                            <div class="mt-3 overflow-hidden">
                                <div id="basic-tabs-1" 
                                    class="transition-all duration-300 transform">
                                    <div class="grid grid-cols-1 lg:grid-cols-2  gap-6 w-full border-b border-gray-100" v-if="activeStatus == 'help_messages'">

                                        <div class="col-span-4 4xl:col-span-6 2md:col-span-12" v-for="help_message in activeItem.help_messages">
                                            <div class="dark:border-border-dark dark:border-dashed border border-border-light border-dashed p-4 flex flex-col gap-5">
                                                <div class="flex items-start justify-between"> 
                                                    <span class="grid p-3 rounded-full sm:p-2 bg-danger place-content-center"><svg class="svg-inline--fa fa-figma w-6 h-6 text-white" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="figma" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M14 95.7924C14 42.8877 56.8878 0 109.793 0H274.161C327.066 0 369.954 42.8877 369.954 95.7924C369.954 129.292 352.758 158.776 326.711 175.897C352.758 193.019 369.954 222.502 369.954 256.002C369.954 308.907 327.066 351.795 274.161 351.795H272.081C247.279 351.795 224.678 342.369 207.666 326.904V415.167C207.666 468.777 163.657 512 110.309 512C57.5361 512 14 469.243 14 416.207C14 382.709 31.1945 353.227 57.2392 336.105C31.1945 318.983 14 289.5 14 256.002C14 222.502 31.196 193.019 57.2425 175.897C31.196 158.776 14 129.292 14 95.7924ZM176.288 191.587H109.793C74.2172 191.587 45.3778 220.427 45.3778 256.002C45.3778 291.44 73.9948 320.194 109.381 320.416C109.518 320.415 109.655 320.415 109.793 320.415H176.288V191.587ZM207.666 256.002C207.666 291.577 236.505 320.417 272.081 320.417H274.161C309.737 320.417 338.576 291.577 338.576 256.002C338.576 220.427 309.737 191.587 274.161 191.587H272.081C236.505 191.587 207.666 220.427 207.666 256.002ZM109.793 351.795C109.655 351.795 109.518 351.794 109.381 351.794C73.9948 352.015 45.3778 380.769 45.3778 416.207C45.3778 451.652 74.6025 480.622 110.309 480.622C146.591 480.622 176.288 451.186 176.288 415.167V351.795H109.793ZM109.793 31.3778C74.2172 31.3778 45.3778 60.2173 45.3778 95.7924C45.3778 131.368 74.2172 160.207 109.793 160.207H176.288V31.3778H109.793ZM207.666 160.207H274.161C309.737 160.207 338.576 131.368 338.576 95.7924C338.576 60.2173 309.737 31.3778 274.161 31.3778H207.666V160.207Z"></path></svg><!-- <i class="fa-brands fa-figma w-6 h-6 text-white"></i> Font Awesome fontawesome.com --></span><span class="text-content3 text-2xs">3hr Ago </span></div>
                                                    <div class="flex flex-col gap-2"> 
                                                    <div> 
                                                        <p class="text-title text-sm font-semibold mb-1 dark:text-white" v-text="help_message.subject"> </p>
                                                        <p class="text-content3 text-2xs truncate"  v-text="help_message.message"></p>
                                                    </div>
                                                    <div class="absolute right-0  flex items-center justify-between gap-1"> 
                                                        <span class="bg-blue-50 px-4 py-1 text-secondary badge-sm rounded-5 " v-text="help_message.status"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full border-b border-gray-100" v-if="activeStatus == 'info'">
                                        <div class="mt-6 w-full">
                                            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
                                                <dashboard_card_white  icon="/uploads/img/products_icome.png" classes="bg-gradient-success" class="border border-1" :title="__('Completed trips')" :value="activeItem.last_trips.length"></dashboard_card_white>
                                                <dashboard_card_white  icon="/uploads/img/products_icome.png" classes="bg-gradient-info" class="border border-1" :title="__('Pickup locations')" :value="activeItem.total_pickups_count"></dashboard_card_white>
                                                <dashboard_card_white  icon="/uploads/img/products_icome.png" classes="bg-gradient-danger" class="border border-1" :title="__('Reviews')" :value="'0'"></dashboard_card_white>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full border-b border-gray-100" v-if="activeStatus == 'trips' && activeItem.last_trips">

                                        <div class="relative overflow-hidden "
                                            v-for="(trip, index) in activeItem.last_trips" v-if="index <= limitCount">
                                            <!-- Center Border Line -->
                                            <div
                                                class="absolute border-s-2 border border-gray-300 h-full top-20 start-10 -z-10 dark:border-white/10">
                                            </div>

                                            <div class="md:text-start mb-5 mt-5">
                                                <h5 class="font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded "
                                                    v-text="__('Trip number') + ' #' + trip.trip_id"></h5>
                                                <p class="text-muted text-sm" v-text="trip.trip_date"></p>
                                            </div>

                                            <!--  -->
                                            <div class="space-y-4" v-for="location in trip.pickup_locations">
                                                <div class="text-start">
                                                    <div class="absolute start-7 mt-6">
                                                        <div class="relative">
                                                            <div
                                                                class="w-8 h-8 flex justify-center items-center rounded-full bg-white text-info dark:bg-gray-800">
                                                                <img :src="location.model.picture" class="rounded-full"
                                                                    alt="">
                                                            </div>
                                                            <div
                                                                class="absolute top-4 -end-6 w-12 h-[2px] bg-gray-400 -z-10">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="grid grid-cols-1">
                                                        <div class="md:col-start-1 col-span-2">
                                                            <div
                                                                class="flex md:flex-nowrap flex-wrap items-center gap-6 ms-10 md:mt-0 mt-5">
                                                                <div class="ms-10">
                                                                    <h2 class="p-2 rounded bg-gradient-to-r text-primary flex items-center justify-center text-sm ml-16 "
                                                                        v-text="location.boarding_time"></h2>
                                                                </div>
                                                                <div class="relative me-5 md:ps-0 ps-10">
                                                                    <div class="pt-3">
                                                                        <h4 class="mb-1.5 text-base dark:text-gray-300"
                                                                            v-if="location.model"
                                                                            v-text="location.model.name"></h4>
                                                                        <p class="mb-4 text-gray-500 dark:text-gray-400"
                                                                            v-if="location.location"
                                                                            v-text="location.location.address"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div> <!-- tabs-with-underline-1 end -->
                            </div> <!-- tab-end -->
                        </div>
                    </div>
                </div>
                <p class="text-center" v-if="showLoadMore && activeStatus == 'trips'">
                    <span class="mx-auto menu-dark px-4 py-3 rounded-xl text-white cursor-pointer text-white rounded-lg"
                        @click="loadmore()" v-text="__('Load more')"></span>
                </p>
            </div>
        </div>
    </div>
</template>
<script>

import dashboard_card from './includes/dashboard_card';
import dashboard_card_white from './includes/dashboard_card_white';
import dashboard_center_squares from './includes/dashboard_center_squares';

export default
    {
        components:{
            dashboard_center_squares,
            dashboard_card_white,
            dashboard_card,
        },
        data() {
            return {
                content: {
                    items: []
                },
                activeItem: {},
                showAddSide: false,
                showEditSide: false,
                showLoader: false,
                showLoadMore: true,
                limitCount: 3,
                activeStatus: 'info',
            }
        },

        props: [
            'path',
            'lang',
            'setting',
            'conf',
            'auth',
            'item',
        ],
        mounted() {
            this.activeItem = this.item;
            console.log(this.activeItem)
        },

        methods:
        {

            loadmore() {
                this.showLoader = true;
                this.limitCount += 5;
                if (this.limitCount > this.activeItem.last_trips.length) {
                    this.showLoadMore = false;
                }
                this.showLoader = false;
            },

            setActiveStatus(status) {
                this.showLoader = true;
                this.activeStatus = status;
                this.showLoader = false;
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
                        this.$root.$children[0].deleteByKey('driver_id', data, 'Driver.delete');
                        break;
                }
            },

            load() {
                this.showLoader = true;
                this.$root.$children[0].handleGetRequest(this.url).then(response => {
                    this.setValues(response)
                    this.showLoader = false;
                });
            },

            setValues(data) {
                this.content = JSON.parse(JSON.stringify(data)); return this
            },
            __(i) {
                return this.$root.$children[0].__(i);
            }
        }
    };
</script>
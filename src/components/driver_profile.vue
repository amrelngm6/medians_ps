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

                        <button type="button" @click="update" class="bg-gray-50 border  border-1 hover:bg-primary mb-3 px-6 py-2 rounded-lg text-primary"
                            v-text="translate('Edit')"></button>
                        <button type="button" @click="close" class=" hover:bg-primary mb-3 px-6 py-2  text-danger"
                            >  <span v-text="translate('Back')"></span></button>
                    </div>

                    <hr class="mt-5 dark:border-gray-600">

                    <div class="text-start mt-6 text-sm">
                        <div class="space-y-7">
                            <p class="text-zinc-400 dark:text-gray-400 flex gap-4"><strong
                                    v-text="translate('First name')"></strong> <span class="ms-2"
                                    v-text="activeItem.first_name"></span></p>
                            <p class="text-zinc-400 dark:text-gray-400 flex gap-4"><strong
                                    v-text="translate('Last name')"></strong> <span class="ms-2"
                                    v-text="activeItem.last_name"></span></p>
                            <p class="text-zinc-400 dark:text-gray-400 flex gap-4"><strong v-text="translate('Email')"></strong>
                                <span class="ms-2" v-text="activeItem.email"></span></p>
                            <p class="text-zinc-400 dark:text-gray-400 flex gap-4"><strong v-text="translate('Phone')"></strong>
                                <span class="ms-2" v-text="activeItem.contact_number"></span></p>
                            <p class="text-zinc-400 dark:text-gray-400 flex gap-4"><strong
                                    v-text="translate('License number')"></strong> <span class="ms-2"
                                    v-text="activeItem.driver_license_number"></span></p>
                            <p class="text-zinc-400 dark:text-gray-400 flex gap-4 items-start"><strong class="flex-shrink"
                                    v-text="translate('address')"></strong> <span class="ms-2" v-text="activeItem.address"></span>
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
                                    v-text="translate('Info')"
                                    :class="activeStatus == 'info' ? 'menu-dark text-white font-semibold' : 'text-gray-500'"
                                    class="hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white active">
                                </button> <!-- button-end -->
                                <button @click="setActiveStatus('trips')" type="button"
                                    v-text="translate('Trips')"
                                    :class="activeStatus == 'trips' ? 'menu-dark text-white font-semibold' : 'text-gray-500'"
                                    class="hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white">
                                </button> <!-- button-end -->
                                <button type="button"  @click="setActiveStatus('help_messages')"
                                    :class="activeStatus == 'help_messages' ? 'menu-dark text-white font-semibold' : 'text-gray-500'"
                                    v-text="translate('Help messages')"
                                    class="hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white">
                                </button> <!-- button-end -->
                                <button @click="setActiveStatus('reviews')"  type="button"
                                v-text="translate('Reviews')"
                                    :class="activeStatus == 'reviews' ? 'menu-dark text-white font-semibold' : 'text-gray-500'"
                                    class="hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white">
                                </button> <!-- button-end -->
                            </nav> <!-- nav-end -->

                            <div class="mt-3 overflow-hidden">
                                <div id="basic-tabs-1" 
                                    class="transition-all duration-300 transform">
                                    <div class="grid grid-cols-1 lg:grid-cols-2  gap-6 w-full border-b border-gray-100" v-if="activeStatus == 'help_messages'">

                                        <div class="w-full relative" v-for="help_message in activeItem.help_messages">
                                            <div class="dark:border-border-dark dark:border-dashed border border-border-light border-dashed p-4 flex flex-col gap-5">
                                                <div class="flex items-start justify-between"> 
                                                    <span class="border border-1 grid p-3 rounded-full sm:p-2  place-content-center"><help_icon class="text-primary w-10 h-10" /></span>
                                                    <span class="text-content3 text-2xs text-muted p-3" v-text="help_message.date"></span>
                                                </div>
                                                <div class="flex flex-col gap-2"> 
                                                    <div> 
                                                        <p class="text-title text-sm font-semibold mb-1 dark:text-white" v-text="help_message.subject"> </p>
                                                        <p class="text-content3 text-2xs truncate"  v-text="help_message.message"></p>
                                                    </div>
                                                    <div :class="translate('lang') == 'ar' ? 'left-0' : 'right-0'" class="absolute   flex items-center justify-between gap-1"> 
                                                        <span class="bg-blue-50 px-4 py-1 text-secondary badge-sm rounded-5 " v-text="help_message.status"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full border-b border-gray-100" v-if="activeStatus == 'info'">
                                        <div class="mt-6 w-full">
                                            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
                                                <dashboard_card_white  icon="/uploads/img/products_icome.png" classes="bg-gradient-success" class="border border-1" :title="translate('Completed trips')" :value="activeItem.last_trips ? activeItem.last_trips.length : '0'"></dashboard_card_white>
                                                <dashboard_card_white  icon="/uploads/img/products_icome.png" classes="bg-gradient-info" class="border border-1" :title="translate('Pickup locations')" :value="activeItem.total_pickups_count"></dashboard_card_white>
                                                <dashboard_card_white  icon="/uploads/img/products_icome.png" classes="bg-gradient-danger" class="border border-1" :title="translate('Reviews')" :value="'0'"></dashboard_card_white>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full border-b border-gray-100" v-if="activeStatus == 'trips' && activeItem.last_trips">
                                        <div class="w-full" v-for="(trip, index) in activeItem.last_trips" :key="limitCount">

                                        <div class="relative overflow-hidden  mb-10 pb-10 border-b"
                                            v-if="limitCount > index"  >
                                            <!-- Center Border Line -->
                                            <div
                                                :class="translate('lang') == 'ar' ? 'right-4' : 'left-4'" class="absolute border-s-2  border border-gray-300 h-full top-20 start-10 -z-10 dark:border-white/10">
                                            </div>

                                            <div class="md:text-start lg:flex mb-5 mt-5">
                                                <div class="w-full">
                                                    <h5 class="font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded "
                                                    v-text="translate('Trip number') + ' #' + trip.trip_id"></h5>
                                                    <p class="text-muted text-sm" v-text="trip.trip_date"></p>
                                                </div>
                                                <div class="w-full">
                                                    <h5 class="font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded "
                                                    v-text="trip.duration"></h5>
                                                    <p class="text-muted text-sm" v-text="translate('Duration')"></p>
                                                </div>
                                                <div class="w-full">
                                                    <h5 class="font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded "
                                                    v-text="trip.distance+' KM'"></h5>
                                                    <p class="text-muted text-sm" v-text="translate('Distance')"></p>
                                                </div>
                                            </div>

                                            <!--  -->
                                            <div class="space-y-4" v-for="location in trip.pickup_locations" :key="trip">
                                                <div class="text-start">
                                                    <div class="absolute start-7 mt-6">
                                                        <div class="relative">
                                                            <div
                                                                class="w-9 h-9 flex justify-center items-center rounded-full bg-white text-info dark:bg-gray-800">
                                                                <img :src="'/app/image.php?w=100&h=100&src='+ location.model.picture" class="rounded-full"
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
                                                                class="flex md:flex-nowrap items-center gap-6 ms-10 md:mt-0 mt-5">
                                                                <div class="ms-10">
                                                                    <h2 :class="translate('lang') == 'ar' ? 'bg-gradient-to-l' : 'bg-gradient-to-r'"
                                                                        class="font-semibold p-2 rounded  text-primary flex items-center justify-center text-sm mx-16 "
                                                                        v-text="location.boarding_time ? location.time : translate('Waiting')"></h2>
                                                                </div>
                                                                <div class="relative me-5 md:ps-0 ps-10 overflow-auto">
                                                                    <div class="pt-3">
                                                                        <h4 class="mb-1.5 text-base dark:text-gray-300"
                                                                            v-if="location.model" v-text="location.model.name">
                                                                        </h4>
                                                                        <p style="white-space: nowrap;" :style="{'white-space':'nowrap'}" class="mb-4 text-gray-500 dark:text-gray-400"
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

                                    </div>
                                </div> <!-- tabs-with-underline-1 end -->
                            </div> <!-- tab-end -->
                        </div>
                    </div>
                </div>
                <p class="text-center" :key="showLoadMore" v-if="showLoadMore && activeStatus == 'trips'">
                    <span class="mx-auto menu-dark px-4 py-3 rounded-xl text-white cursor-pointer text-white rounded-lg"
                        @click="loadmore()" v-text="translate('Load more')"></span>
                </p>
            </div>
        </div>
    </div>
</template>
<script>

import dashboard_card_white from '@/components/includes/dashboard_card_white.vue';
import help_icon from '@/components/svgs/help.vue';
import close_icon from '@/components/svgs/Close.vue';
import {defineAsyncComponent, ref} from 'vue';
import {translate, handleGetRequest, handleRequest, deleteByKey, showAlert} from '@/utils.vue';

export default
{
    components: {
        help_icon,
        close_icon,
        dashboard_card_white,
    },  
    emits: [
        'update','close'
    ],
    setup(props,  { emit }) {

        const url =  props.conf.url+'driver/'+props.item.driver_id+'?load=json';
        
        const content =  ref({
            title: '',
            items: [],
            columns: [],
        });
        
        const activeItem = ref({});
        const showLoadMore = ref(true);
        const activeStatus = ref('info');
        const limitCount = ref(5);


        const load = () => {
            handleGetRequest( url ).then(response=> {
                activeItem.value = JSON.parse(JSON.stringify(response))
            });
        }
        
        load();

        const closeSide = () => {
            showAddSide.value = false;
            showEditSide.value = false;
        }

        const update = () => {
            emit('edit', 'edit', activeItem.value);
        }

        const close = () => {
            emit('close', 'close', activeItem.value);
        }

        const loadmore = () => {
            let len = activeItem.value.last_trips.length;
            limitCount.value += 5;
            
            if (limitCount.value > len) {
                showLoadMore.value = null;
            }
        }


        const setActiveStatus = (newVal) => {
            activeStatus.value = newVal
        }


        /**
         * Handle actions from datatable buttons
         * Called From 'dataTableActions' component
         * 
         * @param String actionName 
         * @param Object data
         */  
        function handleAction  (actionName, data)   {
            switch(actionName) 
            {

                case 'view':
                    activeItem.value = JSON.parse(JSON.stringify(data));
                    showProfilePage.value = true;
                    break;

                case 'edit':
                    activeItem.value = data;
                    showAddSide.value = false; 
                    showEditSide.value = true; 
                    showProfilePage.value = true;
                    break;  

                case 'delete':
                    deleteByKey(props.object_key, data, props.object_name + '.delete');
                    break;  

                    
                case 'close':
                    
                    showEditSide.value = false;
                    showAddSide.value = false;
                    showProfilePage.value = false;
                    break;
            }
        }

        activeItem.value = props.item;

        return {
            url,
            content,
            activeItem,
            activeStatus,
            limitCount,
            showLoadMore,
            update,
            close,
            loadmore,
            setActiveStatus,
            closeSide,
            translate,
            handleAction
        };
    },

    props: [
        'item',
        'path',
        'lang',
        'setting',
        'conf',
        'auth',
    ],
};    
</script>
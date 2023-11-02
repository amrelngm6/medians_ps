<template>
    <div class=" w-full">
        <div class="grid xl:grid-cols-12 lg:grid-cols-12 grid-cols-1 gap-6" v-if="!showLoader">
                    <div class="xl:col-span-3 lg:col-span-5">
                        <div class="card  p-6 mb-6">
                            <div class="text-center">

                                <img :src="activeItem.picture" alt="" class=" rounded-full p-1 bg-gray-100 dark:bg-gray-700 mx-auto">
                                <h4 class="mb-1 mt-3 text-lg dark:text-gray-300" v-text="activeItem.name"></h4>
                                <p class="text-gray-400 mb-4 dark:text-gray-400" v-text="activeItem.email"></p>
                                
                                <button type="button" class="btn bg-primary/90 hover:bg-primary rounded btn-sm text-white mb-3" v-text="__('Edit')"></button>
                            </div>

                            <hr class="mt-5 dark:border-gray-600">

                            <div class="text-start mt-6">
                                <div class="space-y-7">
                                    <p class="text-zinc-400 dark:text-gray-400 flex gap-4"><strong v-text="__('First name')"></strong> <span class="ms-2" v-text="activeItem.first_name"></span></p>
                                    <p class="text-zinc-400 dark:text-gray-400 flex gap-4"><strong v-text="__('Last name')"></strong> <span class="ms-2" v-text="activeItem.last_name"></span></p>
                                    <p class="text-zinc-400 dark:text-gray-400 flex gap-4"><strong v-text="__('Email')"></strong> <span class="ms-2" v-text="activeItem.email"></span></p>
                                    <p class="text-zinc-400 dark:text-gray-400 flex gap-4"><strong v-text="__('Phone')"></strong> <span class="ms-2" v-text="activeItem.contact_number"></span></p>
                                    <p class="text-zinc-400 dark:text-gray-400 flex gap-4"><strong v-text="__('License number')"></strong> <span class="ms-2" v-text="activeItem.driver_license_number"></span></p>
                                    <p class="text-zinc-400 dark:text-gray-400 flex gap-4 items-start"><strong class="flex-shrink" v-text="__('address')"></strong> <span class="ms-2" v-text="activeItem.address"></span></p>
                                </div>
                            </div>
                            <hr class="my-5 dark:border-gray-600">

                        </div> <!-- end card -->
                    </div>

                    <div class="xl:col-span-9 lg:col-span-7">
                        <div class="card">
                            <div class="p-6">

                                <div class="flex justify-between items-center">
                                    <h4 class="uppercase mb-1 dark:text-gray-300">Nav Pills</h4>
                                </div> <!-- card-title end -->

                                <div class="pt-5">
                                    <nav class="lg:flex items-center justify-around rounded-xl space-x-3 bg-gray-100 p-2 dark:bg-gray-900/30" aria-label="Tabs" role="tablist">
                                        <button @click="setActiveStatus('info')" type="button" :class="activeStatus == 'info' ? 'bg-white':''" class="hover:bg-white hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap text-gray-500 dark:text-white active">
                                            Info
                                        </button> <!-- button-end -->
                                        <button @click="setActiveStatus('trips')" type="button" :class="activeStatus == 'trips' ? 'bg-white':''"  class="hover:bg-white hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap text-gray-500 dark:text-white" >
                                            Trips
                                        </button> <!-- button-end -->
                                        <button type="button" class="hover:bg-white hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap text-gray-500 dark:text-white">
                                            Tasks
                                        </button> <!-- button-end -->
                                        <button type="button" class="hover:bg-white hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap text-gray-500 dark:text-white">
                                            Files
                                        </button> <!-- button-end -->
                                    </nav> <!-- nav-end -->

                                    <div class="mt-3 overflow-hidden">
                                        <div id="basic-tabs-1" role="tabpanel" aria-labelledby="basic-tabs-item-1" class="transition-all duration-300 transform">
                                            <div class="space-y-7"  v-if="activeItem.last_trips">

                                                <div class="relative overflow-hidden"  v-for="trip in activeItem.last_trips">
                                                    <!-- Center Border Line -->
                                                    <div class="absolute border-s-2 border border-gray-300 h-full top-20 start-10 -z-10 dark:border-white/10"></div>

                                                    <div class="md:text-start mb-5 mt-5">
                                                        <h5 class="bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded px-2" v-text="__('Trip number')+' #'+ trip.trip_id"></h5>
                                                        <span v-text="trip.trip_date"></span>
                                                    </div>

                                                    <!--  -->
                                                    <div class="space-y-4" v-for="location in trip.pickup_locations">
                                                        <div class="text-start">
                                                            <div class="absolute start-7 mt-6">
                                                                <div class="relative">
                                                                    <div class="w-8 h-8 flex justify-center items-center rounded-full bg-white text-info dark:bg-gray-800">
                                                                        <img :src="location.model.picture" class="rounded-full" alt="">
                                                                    </div>
                                                                    <div class="absolute top-4 -end-6 w-12 h-[2px] bg-gray-400 -z-10"></div>
                                                                </div>
                                                            </div>
                                                            <div class="grid grid-cols-1">
                                                                <div class="md:col-start-1 col-span-2">
                                                                    <div class="flex md:flex-nowrap flex-wrap items-center gap-6 ms-10 md:mt-0 mt-5">
                                                                        <div class="ms-10">
                                                                            <h2 class="p-2 rounded bg-gradient-to-r text-primary flex items-center justify-center text-sm ml-16 " v-text="location.boarding_time"></h2>
                                                                        </div>
                                                                        <div class="relative me-5 md:ps-0 ps-10">
                                                                            <div class="pt-3">
                                                                                <h4 class="mb-1.5 text-base dark:text-gray-300" v-if="location.model" v-text="location.model.name"></h4>
                                                                                <p class="mb-4 text-gray-500 dark:text-gray-400" v-if="location.location" v-text="location.location.address"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="relative overflow-hidden">
                                                    <!-- Center Border Line -->
                                                    <div class="absolute border-s-2 border border-gray-300 h-full top-20 start-10 -z-10 dark:border-white/10"></div>

                                                    <div class="md:text-start mb-5 mt-5">
                                                        <h5 class="bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded px-2">
                                                            Last Week
                                                        </h5>
                                                    </div>

                                                    <!--  -->
                                                    <div class="space-y-4">
                                                        <div class="text-start">
                                                            <div class="absolute start-7 mt-7">
                                                                <div class="relative">
                                                                    <div class="w-6 h-6 flex justify-center items-center rounded-full bg-white text-info dark:bg-gray-800">
                                                                        <i class="uil uil-record-audio"></i>
                                                                    </div>
                                                                    <div class="absolute top-3 -end-6 w-12 h-[2px] bg-gray-400 -z-10"></div>
                                                                </div>
                                                            </div>
                                                            <div class="grid grid-cols-1">
                                                                <div class="md:col-start-1 col-span-2">
                                                                    <div class="flex md:flex-nowrap flex-wrap items-center gap-6 ms-10 md:mt-0 mt-5">
                                                                        <div class="ms-10">
                                                                            <h2 class="p-2 rounded bg-primary/20 text-primary flex items-center justify-center">02 hours ago</h2>
                                                                        </div>
                                                                        <div class="relative me-5 md:ps-0 ps-10">
                                                                            <div class="pt-3">
                                                                                <h4 class="mb-1.5 text-base dark:text-gray-300">Designing Shreyu Admin</h4>
                                                                                <p class="mb-4 text-gray-500 dark:text-gray-400">Shreyu Admin - A responsive admin and dashboard template</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="text-start">
                                                            <div class="absolute start-7 mt-7">
                                                                <div class="relative">
                                                                    <div class="w-6 h-6 flex justify-center items-center rounded-full bg-white text-info dark:bg-gray-800">
                                                                        <i class="uil uil-record-audio"></i>
                                                                    </div>
                                                                    <div class="absolute top-3 -end-6 w-12 h-[2px] bg-gray-400 -z-10"></div>
                                                                </div>
                                                            </div>
                                                            <div class="grid grid-cols-1">
                                                                <div class="md:col-start-1 col-span-2">
                                                                    <div class="flex md:flex-nowrap flex-wrap items-center gap-6 ms-10 md:mt-0 mt-5">
                                                                        <div class="ms-10">
                                                                            <h2 class="p-2 rounded bg-primary/20 text-primary flex items-center justify-center">21 hours ago</h2>
                                                                        </div>
                                                                        <div class="relative me-5 md:ps-0 ps-10">
                                                                            <div class="pt-3">
                                                                                <h4 class="mb-1.5 text-base dark:text-gray-300">UX and UI for Ubold Admin</h4>
                                                                                <p class="mb-4 text-gray-500 dark:text-gray-400">Ubold Admin - A responsive admin and dashboard template</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="text-start">
                                                            <div class="absolute start-7 mt-7">
                                                                <div class="relative">
                                                                    <div class="w-6 h-6 flex justify-center items-center rounded-full bg-white text-info dark:bg-gray-800">
                                                                        <i class="uil uil-record-audio"></i>
                                                                    </div>
                                                                    <div class="absolute top-3 -end-6 w-12 h-[2px] bg-gray-400 -z-10"></div>
                                                                </div>
                                                            </div>
                                                            <div class="grid grid-cols-1">
                                                                <div class="md:col-start-1 col-span-2">
                                                                    <div class="flex md:flex-nowrap flex-wrap items-center gap-6 ms-10 md:mt-0 mt-5">
                                                                        <div class="ms-10">
                                                                            <h2 class="p-2 rounded bg-primary/20 text-primary flex items-center justify-center">22 hours ago</h2>
                                                                        </div>
                                                                        <div class="relative me-5 md:ps-0 ps-10">
                                                                            <div class="pt-3">
                                                                                <h4 class="mb-1.5 text-base dark:text-gray-300">UX and UI for Shreyu Admin</h4>
                                                                                <p class="mb-4 text-gray-500 dark:text-gray-400">Shreyu Admin - A responsive admin and dashboard template</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="relative overflow-hidden">
                                                    <!-- Center Border Line -->
                                                    <div class="absolute border-s-2 border border-gray-300 h-full top-20 start-10 -z-10 dark:border-white/10"></div>

                                                    <div class="md:text-start mb-5 mt-5">
                                                        <h5 class="bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded px-2">
                                                            Last Month
                                                        </h5>
                                                    </div>

                                                    <!--  -->
                                                    <div class="space-y-4">
                                                        <div class="text-start">
                                                            <div class="absolute start-7 mt-7">
                                                                <div class="relative">
                                                                    <div class="w-6 h-6 flex justify-center items-center rounded-full bg-white text-info dark:bg-gray-800">
                                                                        <i class="uil uil-record-audio"></i>
                                                                    </div>
                                                                    <div class="absolute top-3 -end-6 w-12 h-[2px] bg-gray-400 -z-10"></div>
                                                                </div>
                                                            </div>
                                                            <div class="grid grid-cols-1">
                                                                <div class="md:col-start-1 col-span-2">
                                                                    <div class="flex md:flex-nowrap flex-wrap items-center gap-6 ms-10 md:mt-0 mt-5">
                                                                        <div class="ms-10">
                                                                            <h2 class="p-2 rounded bg-primary/20 text-primary flex items-center justify-center">02 hours ago</h2>
                                                                        </div>
                                                                        <div class="relative me-5 md:ps-0 ps-10">
                                                                            <div class="pt-3">
                                                                                <h4 class="mb-1.5 text-base dark:text-gray-300">Designing Shreyu Admin</h4>
                                                                                <p class="mb-4 text-gray-500 dark:text-gray-400">Shreyu Admin - A responsive admin and dashboard template</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="text-start">
                                                            <div class="absolute start-7 mt-7">
                                                                <div class="relative">
                                                                    <div class="w-6 h-6 flex justify-center items-center rounded-full bg-white text-info dark:bg-gray-800">
                                                                        <i class="uil uil-record-audio"></i>
                                                                    </div>
                                                                    <div class="absolute top-3 -end-6 w-12 h-[2px] bg-gray-400 -z-10"></div>
                                                                </div>
                                                            </div>
                                                            <div class="grid grid-cols-1">
                                                                <div class="md:col-start-1 col-span-2">
                                                                    <div class="flex md:flex-nowrap flex-wrap items-center gap-6 ms-10 md:mt-0 mt-5">
                                                                        <div class="ms-10">
                                                                            <h2 class="p-2 rounded bg-primary/20 text-primary flex items-center justify-center">21 hours ago</h2>
                                                                        </div>
                                                                        <div class="relative me-5 md:ps-0 ps-10">
                                                                            <div class="pt-3">
                                                                                <h4 class="mb-1.5 text-base dark:text-gray-300">UX and UI for Ubold Admin</h4>
                                                                                <p class="mb-4 text-gray-500 dark:text-gray-400">Ubold Admin - A responsive admin and dashboard template</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="text-start">
                                                            <div class="absolute start-7 mt-7">
                                                                <div class="relative">
                                                                    <div class="w-6 h-6 flex justify-center items-center rounded-full bg-white text-info dark:bg-gray-800">
                                                                        <i class="uil uil-record-audio"></i>
                                                                    </div>
                                                                    <div class="absolute top-3 -end-6 w-12 h-[2px] bg-gray-400 -z-10"></div>
                                                                </div>
                                                            </div>
                                                            <div class="grid grid-cols-1">
                                                                <div class="md:col-start-1 col-span-2">
                                                                    <div class="flex md:flex-nowrap flex-wrap items-center gap-6 ms-10 md:mt-0 mt-5">
                                                                        <div class="ms-10">
                                                                            <h2 class="p-2 rounded bg-primary/20 text-primary flex items-center justify-center">22 hours ago</h2>
                                                                        </div>
                                                                        <div class="relative me-5 md:ps-0 ps-10">
                                                                            <div class="pt-3">
                                                                                <h4 class="mb-1.5 text-base dark:text-gray-300">UX and UI for Shreyu Admin</h4>
                                                                                <p class="mb-4 text-gray-500 dark:text-gray-400">Shreyu Admin - A responsive admin and dashboard template</p>
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
                    </div>
                </div>
    </div>
</template>
<script>

export default
{   

    data()
    {
        return {
            content: {
                items:[]
            },
            activeItem: {},
            showAddSide:false,
            showEditSide:false,
            showLoader: false,
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
    mounted() 
    {
        this.activeItem = this.item;
        console.log(this.activeItem)
    },

    methods: 
    {
        setActiveStatus(status)
        {
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
                    this.$root.$children[0].deleteByKey('driver_id', data, 'Driver.delete');
                    break;  
            }
        },

        load()
        {
            this.showLoader = true;
            this.$root.$children[0].handleGetRequest( this.url ).then(response=> {
                this.setValues(response)
                this.showLoader = false;
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
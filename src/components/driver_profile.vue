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
                                            <div class="space-y-7">
                                                <div class="relative overflow-hidden">
                                                    <!-- Center Border Line -->
                                                    <div class="absolute border-s-2 border border-gray-300 h-full top-20 start-10 -z-10 dark:border-white/10"></div>

                                                    <div class="md:text-start mb-5 mt-5">
                                                        <h5 class="bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded px-2">
                                                            This Week
                                                        </h5>
                                                    </div>

                                                    <!--  -->
                                                    <div class="space-y-4" v-if="content.trips">
                                                        <div class="text-start" v-for="trip in content.trips">
                                                            <div class="absolute start-7 mt-6">
                                                                <div class="relative">
                                                                    <div class="w-8 h-8 flex justify-center items-center rounded-full bg-white text-info dark:bg-gray-800">
                                                                        <img :src="activeItem.picture" class="h-14 rounded-full" alt="">
                                                                    </div>
                                                                    <div class="absolute top-4 -end-6 w-12 h-[2px] bg-gray-400 -z-10"></div>
                                                                </div>
                                                            </div>
                                                            <div class="grid grid-cols-1">
                                                                <div class="md:col-start-1 col-span-2">
                                                                    <div class="flex md:flex-nowrap flex-wrap items-center gap-6 ms-10 md:mt-0 mt-5">
                                                                        <div class="ms-10">
                                                                            <h2 class="p-2 rounded bg-primary/20 text-primary flex items-center justify-center text-sm ml-16">02 hours ago</h2>
                                                                        </div>
                                                                        <div class="relative me-5 md:ps-0 ps-10">
                                                                            <div class="pt-3">
                                                                                <h4 class="mb-1.5 text-base dark:text-gray-300" ></h4>
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

                                        <div id="basic-tabs-2" role="tabpanel" aria-labelledby="basic-tabs-item-2" class="transition-all duration-300 transform hidden">
                                            <h2 class="uppercase my-3 dark:text-gray-300">Messages</h2>
                                            <div class="divide-y dark:divide-gray-600">
                                                <div class="overflow-hidden py-2.5 relative">
                                                    <div class="block float-left me-3.5"><img src="assets/images/users/avatar-2.jpg" class="h-14 rounded-full" alt=""></div>
                                                    <p class="text-gray-700 block mb-0.5 font-semibold dark:text-gray-300">John Jack</p>
                                                    <p class="text-gray-400">The languages only differ in their grammar</p>
                                                </div>
                                                <div class="overflow-hidden py-2.5 relative">
                                                    <div class="block float-left me-3.5"><img src="assets/images/users/avatar-3.jpg" class="h-14 rounded-full" alt=""></div>
                                                    <p class="text-gray-700 block mb-0.5 font-semibold dark:text-gray-300">Theodore</p>
                                                    <p class="text-gray-400">Everyone realizes why a new common language</p>
                                                </div>
                                                <div class="overflow-hidden py-2.5 relative">
                                                    <div class="block float-left me-3.5">
                                                        <h2 class="h-14 w-14 rounded-full text-xl flex items-center justify-center text-primary bg-primary/20">M</h2>
                                                    </div>
                                                    <p class="text-gray-700 block mb-0.5 font-semibold dark:text-gray-300">Michael</p>
                                                    <p class="text-gray-400">To an English person, it will seem like simplified</p>
                                                </div>
                                                <div class="overflow-hidden py-2.5 relative">
                                                    <div class="block float-left me-3.5"><img src="assets/images/users/avatar-5.jpg" class="h-14 rounded-full" alt=""></div>
                                                    <p class="text-gray-700 block mb-0.5 font-semibold dark:text-gray-300">Tony Lindsey</p>
                                                    <p class="text-gray-400">If several languages coalesce the grammar</p>
                                                </div>
                                                <div class="overflow-hidden py-2.5 relative">
                                                    <div class="block float-left me-3.5">
                                                        <h2 class="h-14 w-14 rounded-full text-xl flex items-center justify-center text-primary bg-primary/20">R</h2>
                                                    </div>
                                                    <p class="text-gray-700 block mb-0.5 font-semibold dark:text-gray-300">Robert Wilke</p>
                                                    <p class="text-gray-400">Their separate existence is a myth</p>
                                                </div>
                                                <div class="overflow-hidden py-2.5 relative">
                                                    <div class="block float-left me-3.5"><img src="assets/images/users/avatar-7.jpg" class="h-14 rounded-full" alt=""></div>
                                                    <p class="text-gray-700 block mb-0.5 font-semibold dark:text-gray-300">James</p>
                                                    <p class="text-gray-400">The European languages are members.</p>
                                                </div>
                                                <div class="overflow-hidden py-2.5 relative">
                                                    <div class="block float-left me-3.5">
                                                        <h2 class="h-14 w-14 rounded-full text-xl flex items-center justify-center text-primary bg-primary/20">B</h2>
                                                    </div>
                                                    <p class="text-gray-700 block mb-0.5 font-semibold dark:text-gray-300">Brian</p>
                                                    <p class="text-gray-400">At vero eos et accusamus et iusto odio</p>
                                                </div>
                                                <div class="overflow-hidden py-2.5 relative">
                                                    <div class="block float-left me-3.5"><img src="assets/images/users/avatar-5.jpg" class="h-14 rounded-full" alt=""></div>
                                                    <p class="text-gray-700 block mb-0.5 font-semibold dark:text-gray-300">Aaron Nickel</p>
                                                    <p class="text-gray-400">Itaque earum rerum hic tenetur a sapiente</p>
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <a href="#" class="btn bg-primary text-white btn-sm rounded">Load more</a>
                                            </div>

                                        </div> <!-- tabs-with-underline-2 end -->

                                        <div id="basic-tabs-3" role="tabpanel" aria-labelledby="basic-tabs-item-3" class="transition-all duration-300 transform active hidden">
                                            <h2 class="uppercase text-lg mb-5 dark:text-gray-300">Projects</h2>
                                            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
                                                <div class="card dark:border-gray-600">
                                                    <div class="p-5">
                                                        <div>
                                                            <div class="flex justify-between items-center">
                                                                <h5 class="text-xs text-success">Web Design</h5>
                                                                <div class="bg-success text-xs text-white rounded py-px px-1.5 font-medium" role="alert">
                                                                    <span>Complated</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <div class="py-3">
                                                                <h5 class="my-2"><a href="apps-project-detail.html" class="text-base text-dark dark:text-gray-300">Landing page Design</a></h5>
                                                                <p class="text-gray-500 text-sm mb-5 dark:text-gray-400">If several languages coalesce, the grammar of the resulting language is more regular.</p>

                                                                <div class="flex items-center gap-3">
                                                                    <a href="javascript: void(0);">
                                                                        <img class="inline-block h-10 w-10 rounded-full border-2 border-white dark:border-gray-700" src="assets/images/users/avatar-2.jpg" alt="Image Description">
                                                                    </a>
                                                                    <a href="javascript: void(0);">
                                                                        <img class="inline-block h-10 w-10 rounded-full border-2 border-white dark:border-gray-700" src="assets/images/users/avatar-3.jpg" alt="Image Description">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-t dark:border-gray-600">
                                                        <div class="p-5">
                                                            <div class="flex items-center gap-4 mb-5">
                                                                <div class="hs-tooltip inline-block [--placement:bottom]">
                                                                    <button type="button" class="hs-tooltip-toggle">
                                                                        <i class="uil uil-calender text-lg me-1"></i> <span class="align-text-bottom">15 Dec</span>
                                                                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                            Due date
                                                                            <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-1/2 -z-10 rounded-[1px] absolute"></div>
                                                                        </span>
                                                                    </button>
                                                                </div>

                                                                <div class="hs-tooltip inline-block [--placement:bottom]">
                                                                    <button type="button" class="hs-tooltip-toggle">
                                                                        <i class="uil uil-bars text-lg me-1"></i><span class="align-text-bottom">56</span>
                                                                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                            Tasks
                                                                            <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-[45%] -z-10 rounded-[1px] absolute"></div>
                                                                        </span>
                                                                    </button>
                                                                </div>

                                                                <div class="hs-tooltip inline-block [--placement:bottom]">
                                                                    <button type="button" class="hs-tooltip-toggle">
                                                                        <i class="uil uil-comments-alt text-lg me-1"></i><span class="align-text-bottom">224</span>
                                                                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                            Comments
                                                                            <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-[45%] -z-10 rounded-[1px] absolute"></div>
                                                                        </span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="hs-tooltip [--placement:bottom] pb-2">
                                                                <button type="button" class="hs-tooltip-toggle">
                                                                    <div class="flex w-80 h-[6px] bg-light rounded-full overflow-hidden dark:bg-gray-700">
                                                                        <div class="flex flex-col justify-center overflow-hidden bg-success" role="progressbar" style="width: 100%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                    <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                        100% Completed
                                                                        <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-[45%] -z-10 rounded-[1px] absolute"></div>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card dark:border-gray-600">
                                                    <div class="p-5">
                                                        <div>
                                                            <div class="flex justify-between items-center">
                                                                <h5 class="text-xs text-warning">Android</h5>
                                                                <div class="bg-warning text-xs text-white rounded py-px px-1.5 font-medium" role="alert">
                                                                    <span>Pending</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <div class="py-3">
                                                                <h5 class="my-2"><a href="apps-project-detail.html" class="text-base text-dark dark:text-gray-300">App Design and Develop</a></h5>
                                                                <p class="text-gray-500 text-sm mb-5 dark:text-gray-400">To achieve this, it would be necessary to have uniform grammar and more common words.</p>

                                                                <div class="flex items-center gap-3">
                                                                    <a href="javascript: void(0);">
                                                                        <img class="inline-block h-10 w-10 rounded-full border-2 border-white dark:border-gray-700" src="assets/images/users/avatar-4.jpg" alt="Image Description">
                                                                    </a>
                                                                    <a href="javascript: void(0);">
                                                                        <img class="inline-block h-10 w-10 rounded-full border-2 border-white dark:border-gray-700" src="assets/images/users/avatar-5.jpg" alt="Image Description">
                                                                    </a>
                                                                    <a href="javascript: void(0);">
                                                                        <div class="relative inline-flex">
                                                                            <button class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-warning/20 border-2 border-white font-medium text-warning shadow-sm align-middle dark:border-gray-600 transition-all text-sm">
                                                                                <span class="font-medium leading-none">2+</span>
                                                                            </button>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-t dark:border-gray-600">
                                                        <div class="p-5">
                                                            <div class="flex items-center gap-4 mb-5">
                                                                <div class="hs-tooltip inline-block [--placement:bottom]">
                                                                    <button type="button" class="hs-tooltip-toggle">
                                                                        <i class="uil uil-calender text-lg me-1"></i> <span class="align-text-bottom">28 Nov</span>
                                                                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                            Due date
                                                                            <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-1/2 -z-10 rounded-[1px] absolute"></div>
                                                                        </span>
                                                                    </button>
                                                                </div>

                                                                <div class="hs-tooltip inline-block [--placement:bottom]">
                                                                    <button type="button" class="hs-tooltip-toggle">
                                                                        <i class="uil uil-bars text-lg me-1"></i><span class="align-text-bottom">62</span>
                                                                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                            Tasks
                                                                            <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-[45%] -z-10 rounded-[1px] absolute"></div>
                                                                        </span>
                                                                    </button>
                                                                </div>

                                                                <div class="hs-tooltip inline-block [--placement:bottom]">
                                                                    <button type="button" class="hs-tooltip-toggle">
                                                                        <i class="uil uil-comments-alt text-lg me-1"></i><span class="align-text-bottom">196</span>
                                                                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                            Comments
                                                                            <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-[45%] -z-10 rounded-[1px] absolute"></div>
                                                                        </span>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <div class="hs-tooltip [--placement:bottom] pb-2">
                                                                <button type="button" class="hs-tooltip-toggle">
                                                                    <div class="flex w-80 h-[6px] bg-light rounded-full overflow-hidden dark:bg-gray-700">
                                                                        <div class="flex flex-col justify-center overflow-hidden bg-warning" role="progressbar" style="width: 66%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                    <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                        100% Completed
                                                                        <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-[45%] -z-10 rounded-[1px] absolute"></div>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card dark:border-gray-600">
                                                    <div class="p-5">
                                                        <div>
                                                            <div class="flex justify-between items-center">
                                                                <h5 class="text-xs text-success">Web Design</h5>
                                                                <div class="bg-success text-xs text-white rounded py-px px-1.5 font-medium" role="alert">
                                                                    <span>Complated</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <div class="py-3">
                                                                <h5 class="my-2"><a href="apps-project-detail.html" class="text-base text-dark dark:text-gray-300">New Admin Design</a></h5>
                                                                <p class="text-gray-500 text-sm mb-5 dark:text-gray-400">To an English person, it will seem like simplified english, as a skeptical Cambridge.</p>

                                                                <div class="flex items-center gap-3">
                                                                    <a href="javascript: void(0);">
                                                                        <div class="relative inline-flex">
                                                                            <button class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-primary/20 border-2font-medium text-primary shadow-sm align-middle transition-all text-sm">
                                                                                <span class="font-semibold text-base leading-none">H</span>
                                                                            </button>
                                                                        </div>
                                                                    </a>
                                                                    <a href="javascript: void(0);">
                                                                        <img class="inline-block h-10 w-10 rounded-full border-2 border-white dark:border-gray-700" src="assets/images/users/avatar-7.jpg" alt="Image Description">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-t dark:border-gray-600">
                                                        <div class="p-5">
                                                            <div class="flex items-center gap-4 mb-5">
                                                                <div class="hs-tooltip inline-block [--placement:bottom]">
                                                                    <button type="button" class="hs-tooltip-toggle">
                                                                        <i class="uil uil-calender text-lg me-1"></i> <span class="align-text-bottom">19 Nov</span>
                                                                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                            Due date
                                                                            <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-1/2 -z-10 rounded-[1px] absolute"></div>
                                                                        </span>
                                                                    </button>
                                                                </div>

                                                                <div class="hs-tooltip inline-block [--placement:bottom]">
                                                                    <button type="button" class="hs-tooltip-toggle">
                                                                        <i class="uil uil-bars text-lg me-1"></i><span class="align-text-bottom">69</span>
                                                                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                            Tasks
                                                                            <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-[45%] -z-10 rounded-[1px] absolute"></div>
                                                                        </span>
                                                                    </button>
                                                                </div>

                                                                <div class="hs-tooltip inline-block [--placement:bottom]">
                                                                    <button type="button" class="hs-tooltip-toggle">
                                                                        <i class="uil uil-comments-alt text-lg me-1"></i><span class="align-text-bottom">201</span>
                                                                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                            Comments
                                                                            <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-[45%] -z-10 rounded-[1px] absolute"></div>
                                                                        </span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="hs-tooltip [--placement:bottom] pb-2">
                                                                <button type="button" class="hs-tooltip-toggle">
                                                                    <div class="flex w-80 h-[6px] bg-light rounded-full overflow-hidden dark:bg-gray-700">
                                                                        <div class="flex flex-col justify-center overflow-hidden bg-success" role="progressbar" style="width: 100%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                    <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                        100% Completed
                                                                        <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-[45%] -z-10 rounded-[1px] absolute"></div>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card dark:border-gray-600">
                                                    <div class="p-5">
                                                        <div>
                                                            <div class="flex justify-between items-center">
                                                                <h5 class="text-xs text-warning">Android</h5>
                                                                <div class="bg-warning text-xs text-white rounded py-px px-1.5 font-medium" role="alert">
                                                                    <span>Pending</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <div class="py-3">
                                                                <h5 class="my-2"><a href="apps-project-detail.html" class="text-base text-dark dark:text-gray-300">Custom Software Development</a></h5>
                                                                <p class="text-gray-500 text-sm mb-5 dark:text-gray-400">Their separate existence is a myth. For science, music, sport, etc uses the vocabulary</p>

                                                                <div class="flex items-center gap-3">
                                                                    <a href="javascript: void(0);">
                                                                        <img class="inline-block h-10 w-10 rounded-full border-2 border-white dark:border-gray-700" src="assets/images/users/avatar-6.jpg" alt="Image Description">
                                                                    </a>
                                                                    <a href="javascript: void(0);">
                                                                        <div class="relative inline-flex">
                                                                            <button class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-danger/20 font-medium text-danger shadow-sm align-middle transition-all text-sm">
                                                                                <span class="font-semibold leading-none">K</span>
                                                                            </button>
                                                                        </div>
                                                                    </a>
                                                                    <a href="javascript: void(0);">
                                                                        <img class="inline-block h-10 w-10 rounded-full border-2 border-white dark:border-gray-700" src="assets/images/users/avatar-7.jpg" alt="Image Description">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-t dark:border-gray-600">
                                                        <div class="p-5">
                                                            <div class="flex items-center gap-4 mb-5">
                                                                <div class="hs-tooltip inline-block [--placement:bottom]">
                                                                    <button type="button" class="hs-tooltip-toggle">
                                                                        <i class="uil uil-calender text-lg me-1"></i> <span class="align-text-bottom">02 Nov</span>
                                                                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                            Due date
                                                                            <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-1/2 -z-10 rounded-[1px] absolute"></div>
                                                                        </span>
                                                                    </button>
                                                                </div>

                                                                <div class="hs-tooltip inline-block [--placement:bottom]">
                                                                    <button type="button" class="hs-tooltip-toggle">
                                                                        <i class="uil uil-bars text-lg me-1"></i><span class="align-text-bottom">72</span>
                                                                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                            Tasks
                                                                            <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-[45%] -z-10 rounded-[1px] absolute"></div>
                                                                        </span>
                                                                    </button>
                                                                </div>

                                                                <div class="hs-tooltip inline-block [--placement:bottom]">
                                                                    <button type="button" class="hs-tooltip-toggle">
                                                                        <i class="uil uil-comments-alt text-lg me-1"></i><span class="align-text-bottom">184</span>
                                                                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                            Comments
                                                                            <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-[45%] -z-10 rounded-[1px] absolute"></div>
                                                                        </span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="hs-tooltip [--placement:bottom] pb-2">
                                                                <button type="button" class="hs-tooltip-toggle">
                                                                    <div class="flex w-80 h-[6px] bg-light rounded-full overflow-hidden dark:bg-gray-700">
                                                                        <div class="flex flex-col justify-center overflow-hidden bg-warning" role="progressbar" style="width: 66%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                    <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                        100% Completed
                                                                        <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-[45%] -z-10 rounded-[1px] absolute"></div>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card dark:border-gray-600">
                                                    <div class="p-5">
                                                        <div>
                                                            <div class="flex justify-between items-center">
                                                                <h5 class="text-xs text-success">Web Design</h5>
                                                                <div class="bg-success text-xs text-white rounded py-px px-1.5 font-medium" role="alert">
                                                                    <span>Complated</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <div class="py-3">
                                                                <h5 class="my-2"><a href="apps-project-detail.html" class="text-base text-dark dark:text-gray-300">Brand logo design</a></h5>
                                                                <p class="text-gray-500 text-sm mb-5 dark:text-gray-400">Everyone realizes why a new common language refuse to pay expensive translators.</p>

                                                                <div class="flex items-center gap-3">
                                                                    <a href="javascript: void(0);">
                                                                        <div class="relative inline-flex">
                                                                            <button class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-success/20 text-success font-medium shadow-sm align-middle transition-all text-sm">
                                                                                <span class="font-semibold leading-none">D</span>
                                                                            </button>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-t dark:border-gray-600">
                                                        <div class="p-5">
                                                            <div class="flex items-center gap-4 mb-5">
                                                                <div class="hs-tooltip inline-block [--placement:bottom]">
                                                                    <button type="button" class="hs-tooltip-toggle">
                                                                        <i class="uil uil-calender text-lg me-1"></i> <span class="align-text-bottom">11 Oct</span>
                                                                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                            Due date
                                                                            <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-1/2 -z-10 rounded-[1px] absolute"></div>
                                                                        </span>
                                                                    </button>
                                                                </div>

                                                                <div class="hs-tooltip inline-block [--placement:bottom]">
                                                                    <button type="button" class="hs-tooltip-toggle">
                                                                        <i class="uil uil-bars text-lg me-1"></i><span class="align-text-bottom">64</span>
                                                                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                            Tasks
                                                                            <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-[45%] -z-10 rounded-[1px] absolute"></div>
                                                                        </span>
                                                                    </button>
                                                                </div>

                                                                <div class="hs-tooltip inline-block [--placement:bottom]">
                                                                    <button type="button" class="hs-tooltip-toggle">
                                                                        <i class="uil uil-comments-alt text-lg me-1"></i><span class="align-text-bottom">173</span>
                                                                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                            Comments
                                                                            <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-[45%] -z-10 rounded-[1px] absolute"></div>
                                                                        </span>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <div class="hs-tooltip [--placement:bottom] pb-2">
                                                                <button type="button" class="hs-tooltip-toggle">
                                                                    <div class="flex w-80 h-[6px] bg-light rounded-full overflow-hidden dark:bg-gray-700">
                                                                        <div class="flex flex-col justify-center overflow-hidden bg-success" role="progressbar" style="width: 100%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                    <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                        100% Completed
                                                                        <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-[45%] -z-10 rounded-[1px] absolute"></div>
                                                                    </span>
                                                                </button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card dark:border-gray-600">
                                                    <div class="p-5">
                                                        <div>
                                                            <div class="flex justify-between items-center">
                                                                <h5 class="text-xs text-success">Web Design</h5>
                                                                <div class="bg-success text-xs text-white rounded py-px px-1.5 font-medium" role="alert">
                                                                    <span>Complated</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <div class="py-3">
                                                                <h5 class="my-2"><a href="apps-project-detail.html" class="text-base text-dark dark:text-gray-300">Website Redesign</a></h5>
                                                                <p class="text-gray-500 text-sm mb-5 dark:text-gray-400">The languages only differ in their grammar pronunciation and their most common words.</p>

                                                                <div class="flex items-center gap-3">
                                                                    <a href="javascript: void(0);">
                                                                        <img class="inline-block h-10 w-10 rounded-full border-2 border-white dark:border-gray-700" src="assets/images/users/avatar-9.jpg" alt="Image Description">
                                                                    </a>
                                                                    <a href="javascript: void(0);">
                                                                        <img class="inline-block h-10 w-10 rounded-full border-2 border-white dark:border-gray-700" src="assets/images/users/avatar-10.jpg" alt="Image Description">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-t dark:border-gray-600 z-30">
                                                        <div class="p-5">
                                                            <div class="flex items-center gap-4 mb-5">
                                                                <div class="hs-tooltip inline-block [--placement:bottom]">
                                                                    <button type="button" class="hs-tooltip-toggle">
                                                                        <i class="uil uil-calender text-lg me-1"></i> <span class="align-text-bottom">11 Oct</span>
                                                                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                            Due date
                                                                            <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-1/2 -z-10 rounded-[1px] absolute"></div>
                                                                        </span>
                                                                    </button>
                                                                </div>

                                                                <div class="hs-tooltip inline-block [--placement:bottom]">
                                                                    <button type="button" class="hs-tooltip-toggle">
                                                                        <i class="uil uil-bars text-lg me-1"></i><span class="align-text-bottom">71</span>
                                                                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                            Tasks
                                                                            <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-[45%] -z-10 rounded-[1px] absolute"></div>
                                                                        </span>
                                                                    </button>
                                                                </div>

                                                                <div class="hs-tooltip inline-block [--placement:bottom]">
                                                                    <button type="button" class="hs-tooltip-toggle">
                                                                        <i class="uil uil-comments-alt text-lg me-1"></i><span class="align-text-bottom">163</span>
                                                                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                            Comments
                                                                            <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-[45%] -z-10 rounded-[1px] absolute"></div>
                                                                        </span>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <div class="hs-tooltip [--placement:bottom] pb-2">
                                                                <button type="button" class="hs-tooltip-toggle">
                                                                    <div class="flex w-80 h-[6px] bg-light rounded-full overflow-hidden dark:bg-gray-700">
                                                                        <div class="flex flex-col justify-center overflow-hidden bg-success" role="progressbar" style="width: 100%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                    <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible transition-opacity bg-black px-2 py-1 rounded text-white z-50 absolute open opacity-0 hidden" role="tooltip" data-popper-placement="top" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate(109px, 81px);">
                                                                        100% Completed
                                                                        <div class="bg-black w-2.5 h-2.5 rotate-45 -top-1 start-[45%] -z-10 rounded-[1px] absolute"></div>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- tabs-with-underline-3 end -->
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
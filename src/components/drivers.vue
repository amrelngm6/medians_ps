<template>
    <div class=" w-full pb-20">

        <div class="relative w-full" v-if="showProfile">
            <driver_profile :key="activeItem" :item="activeItem" @edit="handleAction"></driver_profile>
        </div>

        <main v-if="content && !showProfile && !showLoader" class=" flex-1 overflow-x-hidden overflow-y-auto  w-full  mb-20">
            <!-- New releases -->
            <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                <a href="javascript:;" class="uppercase p-2 mx-2 text-center text-white w-32 rounded-lg menu-dark hover:bg-purple-800" @click="showLoader = true, showAddSide = true,activeItem = {}, showLoader = false; ">{{__('add_new')}}</a>
            </div>

            <div class="relative card ribbon-box border shadow-none mb-lg-0" >
                <div class="card-body">
                    <div class="ribbon ribbon-primary round-shape" v-text="__('Important')"></div>
                    <h5 class="fs-14 text-end ml-20" v-text="__('Before Create Account')"></h5>
                    <div class="ribbon-content mt-4 text-muted">
                        <div class="mb-0" v-html="__('Before Create driver note')"></div>
                    </div>
                </div>
            </div>

            <div class="sm:grid sm:space-y-0 space-y-6 xl:!grid-cols-3 md:grid-cols-2 gap-6" v-if="!showLoader">

                <div class="box mb-0 overflow-hidden p-4 bg-white rounded-xl" v-for="driver in content.items">
                    <div class="box-body space-y-5">
                        <div class="flex">
                            <div class="sm:flex sm:space-x-3 sm:space-y-0 space-y-4 rtl:space-x-reverse"><img
                                    class="avatar avatar-lg rounded-sm" :src="driver.picture" alt="Image Description">
                                <div class="space-y-1 my-auto">
                                    <h5 class="font-semibold text-base leading-none" v-text="driver.name"></h5>
                                    <p class="text-gray-500 dark:text-white/70 font-semibold text-xs truncate max-w-[9rem]"
                                        v-text="driver.email"></p>
                                    <p class="text-primary dark:text-primary text-xs font-semibold"
                                        v-text="driver.contact_number"></p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="box-footer mt-6">
                        <div class="grid grid-cols-12 gap-x-3">
                            <div class="sm:col-span-2 col-span-4 "><span @click="handleAction('view', driver)"
                                    class="cursor-pointer inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 rounded-sm border font-medium bg-white text-gray-500 shadow-sm align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10"><i
                                        class="fa fa-eye  py-1  px-2"></i></span></div>
                            <div @click="handleAction('edit', driver)" class="sm:col-span-8 col-span-4"><span
                                    class="cursor-pointer inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 w-full rounded-sm border font-medium bg-white text-gray-500 shadow-sm align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10"><i
                                        class="fa fa-edit py-1"></i> <span class="text-base  "
                                        v-text="__('Edit')"></span></span></div>
                            <div class="sm:col-span-2 col-span-4">
                                <div class="hs-dropdown ti-dropdown flex justify-end"><span
                                        @click="handleAction('delete', driver)"
                                        class="cursor-pointer hs-dropdown-toggle ti-dropdown-toggle inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 rounded-sm border font-medium bg-white text-gray-500 shadow-sm align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10"><i
                                            class="fa fa-trash text-danger py-1 px-2"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </main>

        <side-form-update :conf="conf" model="Driver.update" :item="activeItem" :model_id="activeItem.driver_id"
            :index="activeItem.driver_id" v-if="showEditSide && !showAddSide" :columns="content.fillable"
            class="col-md-3" />

        <side-form-create :conf="conf" model="Driver.create" v-if="showAddSide && content && content.fillable" :columns="content.fillable"  class="col-md-3" />
    </div>
</template>
<script>

export default
    {

        data() {
            return {
                url: this.conf.url + this.path + '?load=json',
                content: {
                    items: []
                },
                activeItem: {},
                showAddSide: false,
                showProfile: false,
                showEditSide: false,
                showLoader: true,
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
                        this.showEditSide = false;
                        this.showAddSide = false;
                        this.showProfile = true;
                        this.activeItem = data
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
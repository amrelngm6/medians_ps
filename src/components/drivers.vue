<template>
    <div class=" w-full">
        <!-- Rounded Ribbon -->
        <div class="relative card ribbon-box border shadow-none mb-lg-0">
            <div class="card-body">
                <div class="ribbon ribbon-primary round-shape">Important</div>
                <h5 class="fs-14 text-end">Add new driver</h5>
                <div class="ribbon-content mt-4 text-muted">
                    <p class="mb-0">When you create new driver you should make sure that you have the right <b>Email</b>.
                        Because the generated password will be sent to him</p>
                </div>
            </div>
        </div>

        <div class="sm:grid sm:space-y-0 space-y-6 xl:!grid-cols-3 md:grid-cols-2 gap-6">
           
            <div class="box mb-0 overflow-hidden p-4 bg-white rounded-xl" v-for="driver in content.items">
                <div class="box-body space-y-5">
                    <div class="flex">
                        <div class="sm:flex sm:space-x-3 sm:space-y-0 space-y-4 rtl:space-x-reverse"><img
                                class="avatar avatar-lg rounded-sm"
                                src="data:image/jpeg;base64,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"
                                alt="Image Description">
                            <div class="space-y-1 my-auto">
                                <h5 class="font-semibold text-base leading-none" v-text="driver.name"></h5>
                                <p class="text-gray-500 dark:text-white/70 font-semibold text-xs truncate max-w-[9rem]" v-text="driver.email"></p>
                                <p class="text-primary dark:text-primary text-xs font-semibold" v-text="driver.mobile"></p>
                            </div>
                        </div>
                        <div class="ltr:ml-auto rtl:mr-auto"><a href="/synto-ts/preview/pagecomponent/contacts/"><i
                                    class="fa fa text-base text-danger hover:text-danger"></i></a></div>
                    </div>
                </div>
                <div class="box-footer mt-2">
                    <div class="grid grid-cols-12 gap-x-3">
                        <div class="sm:col-span-2 col-span-4 "><span
                                class="cursor-pointer inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 rounded-sm border font-medium bg-white text-gray-500 shadow-sm align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10"
                                ><i
                                    class="fa fa-phone  py-1"></i></span></div>
                        <div @click="handleAction('edit', driver)" class="sm:col-span-8 col-span-4"><span
                                class="cursor-pointer inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 w-full rounded-sm border font-medium bg-white text-gray-500 shadow-sm align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10"
                                ><i
                                    class="fa fa-edit py-1"></i> <span
                                    class="text-base  " v-text="__('Edit')"></span></span></div>
                        <div class="sm:col-span-2 col-span-4">
                            <div class="hs-dropdown ti-dropdown flex justify-end"><span
                                    class="cursor-pointer hs-dropdown-toggle ti-dropdown-toggle inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 rounded-sm border font-medium bg-white text-gray-500 shadow-sm align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10"><i
                                        class="fa fa-ellipsis py-1"></i></span>
                                        </div></div>
                    </div>
                </div>
            </div>
        </div>

        <side-form-create :conf="conf" model="Driver.create" v-if="showAddSide && content && content.fillable" :columns="content.fillable"  class="col-md-3" />

        <side-form-update :conf="conf" model="Driver.update" :item="activeItem" :model_id="activeItem.driver_id" :index="activeItem.driver_id" v-if="showEditSide && !showAddSide " :columns="content.fillable"  class="col-md-3" />


        <!-- <data_table_page ref="data_table" :conf="conf" :path="path" :setting="setting" :auth="auth" object_name="Driver" -->
            <!-- object_key="driver_id"></data_table_page> -->
    </div>
</template>
<script>

export default
{   

    data()
    {
        return {
            url: this.conf.url+this.path+'?load=json',
            content: {
                items:[]
            },
            activeItem: {},
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
<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div class=" w-full">

            <main v-if="setting && !showLoader" class=" flex-1 overflow-x-hidden overflow-y-auto  w-full">
                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="__('settings')"></h1>
                </div>
                <hr class="mt-2" />
                <div class="w-full flex gap gap-6">
                    <div class="w-full">
                        <form action="/api/update" method="POST" data-refresh="1" id="add-device-form" class="action  py-0 m-auto rounded-lg pb-10" v-if="showForm">

                            <input name="type" type="hidden" value="Settings.update">

                            <div class="w-full flex gap-4" v-if="activeTab == 'basic'">
                                
                                <div class="card" >
                                    <div class="card-body pt-0">
                                        <div class="settings-form">
                                            
                                            <label class="block pb-3">
                                                <span class="text-gray-700"><span v-text="__('enable_notifications')"></span></span>
                                                <input name="params[enable_notifications]" type="checkbox" class="h-4 w-4 mx-4 p-2 rounded border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" value="1"  v-model="setting.enable_notifications">
                                            </label>
                                            <hr />
                                        </div>
                                    </div>    
                                </div>    

                            </div>





                            <button class="uppercase h-12 mt-3 text-white w-40 mx-auto rounded bg-red-700 hover:bg-red-800">{{__('Save')}}</button>
                        </form>
                    </div>
                    <div class="col-md-3" >
                        <ul class="bg-white p-4 rounded-lg">
                            <li :class="tab.link == activeTab ? 'font-bold' : ''" class="cursor-pointer py-2 px-1 border-b border-gray-200 py-2" :key="index" v-for="(tab, index) in setting_tabs" @click="switchTab(tab)" v-text="tab.title"></li>
                        </ul>
                    </div>
                </div>
                <!-- END New releases -->
            </main>
        </div>
    </div>
</template>
<script>
export default 
{
    name:'Settings',
    data() {
        return {
            url: this.conf.url+this.path+'?load=json',
            content: {

                title: '',
                startdate: '',
                enddate: '',
                products: [],
                stockList: [],
            },
            setting_tabs: [
                {title:this.__('Basic_Details'), link:'basic'},
            ],
            activeItem:null,
            activeTab:'basic',
            showAddSide:false,
            showEditSide:false,
            showLoader: false,
            showForm:true,
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
    },

    methods: 
    {
        switchTab(tab)
        {
            this.showForm = false;
            this.activeTab = tab.link;
            this.showForm = true;
        },
        
        __(i)
        {
            return this.$root.$children[0].__(i);
        }
    }
};
</script>
<style lang="css">
    .rtl #side-cart-container
    {
        right: auto;
        left:0;
    }
</style>
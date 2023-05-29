<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div class=" w-full">

            <main v-if="content && !showLoader" class=" flex-1 overflow-x-hidden overflow-y-auto  w-full">
                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="__('settings')"></h1>
                </div>
                <hr class="mt-2" />
                <div class="w-full flex gap gap-6">
                    <div class="w-full">
                        <form action="/api/update" method="POST" data-refresh="1" id="add-device-form" class="action  py-0 m-auto rounded-lg pb-10" v-if="showForm && content.setting">

                            <input name="type" type="hidden" value="SystemSettings.update">

                            <div class="w-full flex gap-4" v-if="activeTab == 'basic'">
                                <div class="card w-full " >                             
                                    <div class="card-header pt-0">
                                        <span class="text-gray-700 font-semibold"><span v-text="__('SMTP_INFO')"></span></span> 
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="settings-form mt-2">
                                            <label class="block pb-3">
                                                <span class="text-gray-700"><span v-text="__('SMTP_SENDER')"></span><span class="star-red">*</span></span>
                                                <input name="params[smtp_sender]" type="email" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="__('SMTP_SENDER')"  :value="content.setting.smtp_sender">
                                            </label>

                                            <label class="block py-3">
                                                <span class="text-gray-700"><span v-text="__('SMTP_USER')"></span><span class="star-red">*</span></span>
                                                <input name="params[smtp_user]" type="text" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="__('SMTP_USER')"  :value="content.setting.smtp_user">
                                            </label>
                                            <label class="block py-3">
                                                <span class="text-gray-700"><span v-text="__('SMTP_PASSWORD')"></span><span class="star-red">*</span></span>
                                                <input name="params[smtp_password]" type="text" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="__('SMTP_PASSWORD')"  :value="content.setting.smtp_password">
                                            </label>

                                        </div>
                                    </div>
                                </div>

                                <div class="w-full ">                               
                                    <div class="card">
                                        <div class="card-header pt-0">
                                            <span class="text-gray-700 font-semibold"><span></span></span> 
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="settings-form">

                                                <label class="block py-3">
                                                    <span class="text-gray-700"><span v-text="__('SMTP_HOST')"></span><span class="star-red">*</span></span>
                                                    <input name="params[smtp_host]" type="text" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="__('SMTP_HOST')"  :value="content.setting.smtp_host">
                                                </label>                                                
                                                <label class="block py-3">
                                                    <span class="text-gray-700"><span v-text="__('SMTP_PORT')"></span><span class="star-red">*</span></span>
                                                    <input name="params[smtp_port]" type="number" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="__('SMTP_USER')"  :value="content.setting.smtp_port">
                                                </label>
                                                
                                                <label class="block py-3">
                                                    <span class="text-gray-700">{{__('SMTP_AUTH')}} <span class="star-red">*</span></span>
                                                    <select class="select h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600 " name="params[smtp_auth]" :value="content.setting.smtp_auth">
                                                        <option value="1">True</option>
                                                        <option value="0">False</option>
                                                    </select>
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="w-full flex gap-4" v-if="activeTab == 'address'">
                                <div class="card" >
                                    <div class="card-body pt-0">
                                        <div class="settings-form">
                                            <div class="form-group">
                                                <label>{{__('Address')}}  <span class="star-red">*</span></label>
                                                <input name="params[settings][address]" type="text" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" placeholder="Enter Address Line 2" required :value="content.setting.address">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{__('City')}} <span class="star-red">*</span></label>
                                                        <input name="params[settings][city]" type="text" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" required :value="content.setting.city">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{__('Country')}} </label>
                                                        <select class="select h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600 " name="params[settings][country]" :value="content.setting.country">
                                                            <option value="Egypt">Egypt</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="w-full flex gap-4" v-if="activeTab == 'google'">
                                <div class="card w-full" >
                                    <div class="card-header pt-0">
                                        <span class="text-gray-700 font-semibold"><span v-text="__('GOOGLE_AUTH')"></span></span> 
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="settings-form">
                                            <div class="form-group">

                                                <label class="block py-3">
                                                    <span class="text-gray-700"><span v-text="__('google_login_api_key')"></span></span>
                                                    <input name="params[google_login_key]" type="text" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="__('google_login_api_key')"  :value="content.setting.google_login_key">
                                                </label>

                                                <label class="block py-3">
                                                    <span class="text-gray-700"><span v-text="__('google_login_api_secret')"></span></span>
                                                    <input name="params[google_login_secret]" type="text" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="__('google_login_api_secret')"  :value="content.setting.google_login_secret">
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="w-full flex gap-4" v-if="activeTab == 'payment_methods'">
                                
                                <div class="card w-full" >
                                    <div class="card-header pt-0">
                                        <span class="text-gray-700 font-semibold"><span v-text="__('PAYPAL_API')"></span></span> 
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="settings-form">
                                            <div class="form-group">

                                                <label class="block py-3">
                                                    <span class="text-gray-700"><span v-text="__('PayPal_API_KEY')"></span></span>
                                                    <input name="params[paypal_api_key]" type="text" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="__('paypal_api_key')"  :value="content.setting.paypal_api_key">
                                                </label>

                                                <label class="block py-3">
                                                    <span class="text-gray-700"><span v-text="__('PayPal_api_secret')"></span></span>
                                                    <input name="params[paypal_api_secret]" type="text" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="__('paypal_api_secret')"  :value="content.setting.paypal_api_secret">

                                                </label>

                                            </div>
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
            url: this.conf.url+'system_settings?load=json',
            content: {
                setting: {},
            },
            setting_tabs: [
                {title:this.__('Basic_Details'), link:'basic'},
                {title:this.__('payment_methods'), link:'payment_methods'},
                // {title:this.__('Address_Details'), link:'address'},
                {title:this.__('GOOGLE_AUTH'), link:'google'},
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
        'conf',
        'auth',
    ],
    mounted() 
    {
        this.load()
    },

    methods: 
    {
        switchTab(tab)
        {
            this.showForm = false;
            this.activeTab = tab.link;
            this.showForm = true;
        },
        
        load()
        {
            this.showLoader = true;
            this.$parent.handleGetRequest( this.url ).then(response=> {
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
<style lang="css">
    .rtl #side-cart-container
    {
        right: auto;
        left:0;
    }
</style>
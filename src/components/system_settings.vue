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
                                                <span class="text-gray-700"><span v-text="__('SMTP_SENDER')"></span></span>
                                                <input name="params[smtp_sender]" type="email" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="__('SMTP_SENDER')"  :value="content.setting.smtp_sender">
                                            </label>

                                            <label class="block py-3">
                                                <span class="text-gray-700"><span v-text="__('SMTP_USER')"></span></span>
                                                <input name="params[smtp_user]" type="text" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="__('SMTP_USER')"  :value="content.setting.smtp_user">
                                            </label>
                                            <label class="block py-3">
                                                <span class="text-gray-700"><span v-text="__('SMTP_PASSWORD')"></span></span>
                                                <input name="params[smtp_password]" type="text" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="__('SMTP_PASSWORD')">
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
                                                    <span class="text-gray-700"><span v-text="__('SMTP_HOST')"></span></span>
                                                    <input name="params[smtp_host]" type="text" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="__('SMTP_HOST')"  :value="content.setting.smtp_host">
                                                </label>                                                
                                                <label class="block py-3">
                                                    <span class="text-gray-700"><span v-text="__('SMTP_PORT')"></span></span>
                                                    <input name="params[smtp_port]" type="number" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="__('SMTP_USER')"  :value="content.setting.smtp_port">
                                                </label>
                                                
                                                <label class="block py-3">
                                                    <span class="text-gray-700">{{__('SMTP_AUTH')}} </span>
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



                            <div class="w-full flex gap-4" v-if="activeTab == 'site_content'">
                                
                                <div class="card w-full" >
                                    <div class="card-header pt-0">
                                        <span class="text-gray-700 font-semibold"><span v-text="__('site_content')"></span></span> 
                                    </div>
                                    <div class="card-body py-6">
                                        <a href="/admin/editor" target="_blank" class="pt-2 text-center block uppercase h-12 mt-3 text-white w-40 mx-auto rounded bg-red-700 hover:bg-red-800">{{__('Open editor')}}</a>
                                    </div>
                                </div>
                            </div>



                            <div class="w-full flex gap-4" v-if="activeTab == 'payment_methods'">
                                
                                <div class="card w-full" >
                                    <div class="card-header flex gap-6 pt-0">
                                        <svg width="30px" height="30px" viewBox="-3.5 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <defs> </defs>
                                            <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g id="Color-" transform="translate(-804.000000, -660.000000)" fill="#022B87">
                                                    <path d="M838.91167,663.619443 C836.67088,661.085983 832.621734,660 827.440097,660 L812.404732,660 C811.344818,660 810.443663,660.764988 810.277343,661.801472 L804.016136,701.193856 C803.892151,701.970844 804.498465,702.674333 805.292267,702.674333 L814.574458,702.674333 L816.905967,688.004562 L816.833391,688.463555 C816.999712,687.427071 817.894818,686.662083 818.95322,686.662083 L823.363735,686.662083 C832.030541,686.662083 838.814901,683.170138 840.797138,673.069296 C840.856106,672.7693 840.951363,672.194809 840.951363,672.194809 C841.513828,668.456868 840.946827,665.920407 838.91167,663.619443 Z M843.301017,674.10803 C841.144899,684.052874 834.27133,689.316292 823.363735,689.316292 L819.408334,689.316292 L816.458414,708 L822.873846,708 C823.800704,708 824.588458,707.33101 824.733611,706.423525 L824.809211,706.027531 L826.284927,696.754676 L826.380183,696.243184 C826.523823,695.335698 827.313089,694.666708 828.238435,694.666708 L829.410238,694.666708 C836.989913,694.666708 842.92604,691.611256 844.660308,682.776394 C845.35583,679.23045 845.021677,676.257496 843.301017,674.10803 Z" id="Paypal"> </path>
                                                </g>
                                            </g>
                                        </svg>
                                        <span class="text-gray-700 font-semibold"><span v-text="__('PAYPAL_API')"></span></span> 

                                    </div>
                                    <div class="card-body p-0 px-6">
                                        <div class="settings-form">
                                            <div class="form-group">

                                                <label class="block py-3">
                                                    <span class="text-gray-700">{{__('paypal_mode')}} <span class="star-red">*</span></span>
                                                    <select class="select h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600 " name="params[paypal_mode]" :value="content.setting.paypal_mode">
                                                        <option value="SANDBOX">SANDBOX</option>
                                                        <option value="LIVE">LIVE</option>
                                                    </select>
                                                </label>

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

                            <button v-if="activeTab != 'site_content'" class="uppercase h-12 mt-3 text-white w-40 mx-auto rounded bg-red-700 hover:bg-red-800">{{__('Save')}}</button>
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
            url: this.conf.url+this.path+'system_settings?load=json',
            content: {
                setting: {},
            },
            setting_tabs: [
                {title:this.__('Basic_Details'), link:'basic'},
                {title:this.__('site_content'), link:'site_content'},
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
<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div class=" w-full">

            <main v-if="content" class=" flex-1 overflow-x-hidden overflow-y-auto  w-full">
                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="translate('settings')"></h1>
                </div>
                <hr class="mt-2" />
                <div class="w-full lg:flex gap gap-6">
                    <div class="w-full mb-6">
                        <form action="/api/update" method="POST" data-refresh="1" id="add-device-form" class="action  py-0 m-auto rounded-lg pb-10" v-if="content.setting">

                            <input name="type" type="hidden" value="SystemSettings.update">

                            <div class="w-full " v-if="activeTab == 'basic'">

                                <div class="card w-full " >
                                    <div class="card-body pt-0">
                                        <div class="settings-form">
                                            <label class="block py-3" >
                                                <input name="params[logo]" type="hidden" :value="content.setting.logo">
                                                <div class="w-full block  cursor-pointer">
                                                    <span class="text-gray-700 w-20">{{translate('Logo')}} <span class="star-red">*</span></span>
                                                    <vue-medialibrary-field name="params[logo]" :api_url="conf.url" :filepath="content.setting.logo"></vue-medialibrary-field>
                                                </div>

                                            </label>


                                            <label class="block py-3">
                                                <span class="text-gray-700">{{translate('Sitename')}} <span class="star-red">*</span></span>
                                                <input name="params[sitename]" type="text" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" required :placeholder="translate('Sitename')" :value="content.setting.sitename">
                                            </label>

                                            <label class="block py-3">
                                                <span class="text-gray-700">{{translate('Language')}} <span class="star-red">*</span></span>
                                                <select class="select h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600 " name="params[lang]" :value="content.setting.lang">
                                                    <option value="english">English</option>
                                                    <option value="arabic">العربية</option>
                                                </select>
                                            </label>

                                        </div>
                                    </div>
                                </div>

                                <div class="w-full ">                               
                                    <div class="card">
                                        <div class="card-body pt-0">
                                            <div class="settings-form">

                                                <label class="block py-3">
                                                    <label>{{translate('Enable debugging')}} <span class="star-red">*</span></label>
                                                    <select class="select h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600 " name="params[enable_debug]" :value="content.setting.enable_debug">
                                                        <option value="1" v-text="translate('enabled')" ></option>
                                                        <option value="0" v-text="translate('disabled')" ></option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full " v-if="activeTab == 'notifications'">
                                <div class="card w-full " >                             
                                    <div class="card-header pt-0">
                                        <span class="text-gray-700 font-semibold"><span v-text="translate('notifications')"></span></span> 
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="settings-form mt-2">
                                            <label class="block pb-3">
                                                <span class="text-gray-700"><span v-text="translate('enable_notifications')"></span></span>
                                                <input name="params[enable_notifications]" type="checkbox" class="h-4 w-4 mx-4 p-2 rounded border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" value="1"  v-model="content.setting.enable_notifications">
                                            </label>
                                            <hr />

                                            <label class="block py-3">
                                                <span class="text-gray-700"><span v-text="translate('welcome_message_subject')"></span></span>
                                                <input name="params[welcome_message_subject]" type="text" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="translate('welcome_message_subject')"  v-model="content.setting.welcome_message_subject">
                                            </label>
                                            <label class="block py-3">
                                                <span class="text-gray-700"><span v-text="translate('welcome_message_icon')"></span></span>
                                                <input name="params[welcome_message_icon]" type="text" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="translate('welcome_message_icon')"  v-model="content.setting.welcome_message_icon">
                                            </label>
                                            <label class="block py-3">  
                                                <span class="text-gray-700"><span v-text="translate('welcome_message')"></span></span>
                                                <textarea name="params[notifications_welcome_message]" rows="3" class=" mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="translate('welcome_message')" v-model="content.setting.notifications_welcome_message"></textarea>
                                            </label>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="w-full " v-if="activeTab == 'map'">
                                <div class="card w-full " >                             
                                    <div class="card-header pt-0">
                                        <span class="text-gray-700 font-semibold"><span v-text="translate('Map')"></span></span> 
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="settings-form mt-2">
                                            <label class="block pb-3">
                                                <span class="text-gray-700"><span v-text="translate('Google Map API')"></span></span>
                                                <input name="params[google_map_api]" type="text" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="translate('Google Map API')"  v-model="content.setting.google_map_api">
                                            </label>
                                            <hr />

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full lg:flex gap-4" v-if="activeTab == 'smtp'">

                                <div class="card w-full " >                             
                                    <div class="card-header pt-0">
                                        <span class="text-gray-700 font-semibold"><span v-text="translate('SMTP_INFO')"></span></span> 
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="settings-form mt-2">
                                            <label class="block pb-3">
                                                <span class="text-gray-700"><span v-text="translate('SMTP_SENDER')"></span></span>
                                                <input name="params[smtp_sender]" type="email" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="translate('SMTP_SENDER')"  :value="content.setting.smtp_sender">
                                            </label>

                                            <label class="block py-3">
                                                <span class="text-gray-700"><span v-text="translate('SMTP_USER')"></span></span>
                                                <input name="params[smtp_user]" type="text" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="translate('SMTP_USER')"  :value="content.setting.smtp_user">
                                            </label>
                                            <label class="block py-3">
                                                <span class="text-gray-700"><span v-text="translate('SMTP_PASSWORD')"></span></span>
                                                <input name="params[smtp_password]" type="text" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="translate('SMTP_PASSWORD')">
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
                                                    <span class="text-gray-700"><span v-text="translate('SMTP_HOST')"></span></span>
                                                    <input name="params[smtp_host]" type="text" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="translate('SMTP_HOST')"  :value="content.setting.smtp_host">
                                                </label>                                                
                                                <label class="block py-3">
                                                    <span class="text-gray-700"><span v-text="translate('SMTP_PORT')"></span></span>
                                                    <input name="params[smtp_port]" type="number" class="h-10 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" :placeholder="translate('SMTP_USER')"  :value="content.setting.smtp_port">
                                                </label>
                                                
                                                <label class="block py-3">
                                                    <span class="text-gray-700">{{translate('SMTP_AUTH')}} </span>
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

                            <button class="uppercase mt-3 text-white mx-auto rounded-lg bg-purple-800 hover:bg-red-800 px-4 py-2">{{translate('Save')}}</button>
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

import {ref } from 'vue';
import {translate,handleGetRequest } from '@/utils.vue';
import field from '@/components/includes/Field.vue';

export default 
{
    components: {
        'vue-medialibrary-field': field,
        translate
    },
    name:'Settings',
    setup(props) {
        
        const url =  props.conf.url+props.path+'?load=json';
                
        const content =  ref({
            title: '',
            settings: [],
        });
        
        const setting_tabs =  [
            {title:translate('Basic Details'), link:'basic'},
            {title:translate('Notifications'), link:'notifications'},
            {title:translate('SMTP setting'), link:'smtp'},
            {title:translate('Google Map API'), link:'map'},
        ];

        const load = () => {
            handleGetRequest( url ).then(response=> {
                content.value = JSON.parse(JSON.stringify(response))
            });
        }
        
        load();

        const activeTab =  ref('basic');

        const switchTab = (tab) => 
        {
            console.log(tab)
            console.log(tab.link)
            activeTab.value = tab.link;
        }

        return {
            url,
            content,
            switchTab,
            activeTab,
            translate,
            setting_tabs
        };
    },
    props: [
        'path',
        'lang',
        'setting',
        'conf',
        'auth',
    ]
};
</script>
<style lang="css">
    .rtl #side-cart-container
    {
        right: auto;
        left:0;
    }
</style>
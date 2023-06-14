<template>
    <div>
        <div v-if="show" class="left-4">
            <!-- component -->
            <div class="w-full relative">
                <navbar v-if="auth" style="z-index: 99999;" :setting="setting" :lang="lang" :conf="conf" :auth="auth"></navbar>
                <a href="javascript:;" class="mainmenu-close w-6 text-lg absolute top-4 mx-6 block" style="z-index:99999" @click="showSide = !showSide"><i class="fa fa-bars"></i></a>
                <div class="gap gap-6 h-full flex w-full overflow-hidden py-4 pb-0 px-4">
                    <side-menu :samepage="activeTab" :auth="auth" :url="conf.url ? conf.url : '/'" :menus="main_menu" v-if="auth  && showSide" class="sidebar mx-1" id="sidebar" style="z-index:999">
                    </side-menu>

                    <div v-if="auth" class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
                        <div class="w-full">
                            <transition   :duration="550">
                                <component ref="activeTab" :types-list="typesList"  :key="activeTab" :path="activeTab" :system_setting="system_setting" :setting="setting" :lang="lang" :conf="conf" :auth="auth" :is="component"></component>
                            </transition>

                        </div>
                    </div>
                    <div v-else class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
                        <login form_action="/" ></login>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
const axios = require('axios').default;


import login from './components/login-dashboard.vue' // Used if sessions expired but needs refresh
import SideMenu from './components/side-menu.vue'
import navbar from './components/navbar.vue'
import dashboard from './components/dashboard.vue' // Dashboard for branch admin
import master_dashboard from './components/master_dashboard.vue' // Dashboard for Master
import categories from './components/categories.vue'
import expenses from './components/expenses.vue'
import payments from './components/payments.vue'
import devices_orders from './components/devices_orders.vue'
import calendar from './components/calendar.vue'
import games from './components/games.vue'
import manage_devices from './components/manage_devices.vue'
import products from './components/products.vue'
import invoices from './components/invoices.vue'
import invoice from './components/invoice.vue'
import stock from './components/stock.vue'
import settings from './components/settings.vue'
import system_settings from './components/system_settings.vue'
import users from './components/users.vue'
import customers from './components/customers.vue'
import reports from './components/reports.vue'
import get_started from './components/get-started.vue'
import plans from './components/plans.vue'
import plan_features from './components/plan_features.vue'
import branches from './components/branches.vue'
import plan_subscriptions from './components/plan_subscriptions.vue'
import pages from './components/pages.vue'
import notifications_events from './components/notifications_events.vue'
import notifications from './components/notifications.vue'
import booking_follow from './components/booking_follow.vue'

export default {
    name: 'app',
    components: {
        login,
        SideMenu,
        dashboard,
        master_dashboard,
        categories,
        expenses,
        payments,
        devices_orders,
        calendar,
        games,
        manage_devices,
        products,
        invoices,
        invoice,
        stock,
        settings,
        system_settings,
        users,
        customers,
        reports,
        get_started,
        plans,
        plan_features,
        plan_subscriptions,
        branches,
        pages,
        notifications,
        notifications_events,
        booking_follow,
        navbar
    },
    data() {
        return {

            date: '',
            activeItem: null,
            showAddSide: false,
            showEditSide: false,
            showTab: true,
            component: {},
            activeTab: 'dashboard',
            status: null,
            lang: {},
            auth: {},
            setting: {},
            system_setting: {},
            conf: {},
            main_menu: [],
            typesList: [],
            show: false,
            showSide: true,
            showModal: false,
            activeModal: null,
        };
    },
    mounted() {
        
        const t = this;

        this.setProps();

        $(window).on('popstate', function(e) {
            t.switchTab({link:window.location.pathname.replace('/','')})
        });

        jQuery(document).on('submit', 'form',function (e) {
            e.preventDefault();
            t.submit(this, e)
        })

        this.showSide =  (window.screen.availWidth > 1000 ) ? true : false;

        // Check if Native notifications enabled  from Master
        if (this.system_setting && this.system_setting.enable_notifications)
            this.notify()

    },
    methods: 
    {

        /**
         * Check notifications permission
         * Send welcome notification
         */ 
        notify (title, body) 
        {

            if (this.system_setting.notifications_welcome_message)
                return null;

            if ("Notification" in window) 
            {
                if (Notification.permission !== "granted") {
                    Notification.requestPermission().then(permission => {
                        if (permission === "granted") {
                            const notification = new Notification(this.system_setting.notifications_welcome_subject, {
                                body: this.system_setting.notifications_welcome_message,
                                icon: this.system_setting.notifications_welcome_icon
                            });
                        }
                    });
                }
            }
        },


        /**
         * Get the props for App root
         */
        setProps()
        {
            const mountEl = document.querySelector("#root-parent");
            let props = { ...mountEl.dataset };
            this.auth = props ? JSON.parse(props.auth) : {};
            this.main_menu = props ? JSON.parse(props.menu) : {};
            this.lang = props ? JSON.parse(props.lang) : {};
            this.setting = props ? JSON.parse(props.setting) : {};
            this.system_setting = props ? JSON.parse(props.system_setting) : {};
            this.conf = props ? JSON.parse(props.conf) : {};
            this.activeTab = (props && props.page) ? props.page : this.defaultPage();
            this.component = (props && props.component) ? props.component : this.defaultPage();
            this.typesList = (props && props.typesList) ? props.typesList : [];
            this.show = true
        },


        /**
         * Switch between Tabs
         */ 
        switchTab(tab) {
            if (!tab.sub)
            {
                this.show = false
                this.activeTab = (tab && tab.link) ? tab.link : this.defaultPage();
                this.component = (tab && tab.component) ? tab.component : this.activeTab;
                this.show = true
                history.pushState({menu: tab}, '', this.conf.url+this.activeTab);
            }
        },
        
        /**
         * The default page to load if 
         * loaded component is not found
         */
        defaultPage()
        {
            if (this.auth && this.auth.role_id === 1)
                return 'master_dashboard';


            if (this.auth && this.auth.role_id === 3)
                return 'dashboard';


            return 'get_started';

        }, 

        /**
         * If the route is invoice 
         * load its custom component
         */  
        checkIsInvoice()
        {
            return this.activeTab.includes('invoices/show') ? true : null;

        },
        setValues(data) {
            this.content = JSON.parse(JSON.stringify(data)); return this
        },

        delete(item, type) {
            
            if (!window.confirm(this.__('confirm_delete')))
            {
                return null;
            }

            var params = new URLSearchParams();
            params.append('type', type)
            params.append('params[id]', item.id)
            this.handleRequest(params, '/api/delete').then(response => {
                this.$alert(response.result)
            })
        },

        /**
         * Handle login access result 
         * 
         */
        handleAccess(response) 
        {
            if (response && (response.success == 1 || response.success))
            {
                this.$alert(response.result).then(() => {
                    location.reload();
                });

            } else {

                response ? this.$alert(response.error ? response.error : response.result) : '';
            }


        },

        submit(element, props)
        {
            let Things = jQuery(element).serializeArray()
            var params = new URLSearchParams();
            Things.map(function(n){
                params.append([n['name']],  n['value']);
            });

            this.handleRequest(params, jQuery(element).attr('action')).then(response => {
                this.handleAccess(response)
            })
        },
        async handleRequest(params, url = '/api') {

            // Demo json data
            return await axios.post(url, params.toString()).then(response => {
                return response.data;
            });
        },

        async handleGetRequest(url) {

            var t = this;
            // Demo json data
            return await axios.get(url).then(response => {
                t.showLoader = false;

                if (response.data.status)
                    return response.data.result;
                else
                    return response.data;
            });
        },
        __(i) {
                
            let key = i.toLowerCase().replaceAll(' ', '_');
            let k = i.replaceAll('_', ' ');
            let un_key = k.charAt(0).toUpperCase() + k.slice(1);

            return this.lang[key] ? this.lang[key] : un_key;

        }
    }
}
</script>
<style>
@import './assets/webfonts/fontawesome.min.css';
@import './assets/bootstrap-grid.min.css';
@import './assets/media-library.css';
@import './assets/style.css';
@import './assets/theme.css';
@import './assets/plugins.css';
</style>
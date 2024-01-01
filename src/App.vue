<template>
    <div>

        <div class="left-4">
            <!-- component -->
            
            <div class="w-full relative">
                <navbar v-if="auth" style="z-index: 9999;" :setting="system_setting" :lang="lang" :conf="conf" :auth="auth"></navbar>
                <a href="javascript:;" class="mainmenu-close px-4  text-lg absolute top-4 mx-6 block" style="z-index:999" @click="showSide = !showSide"><vue-feather type="menu"></vue-feather></a>
                <div class="gap gap-6 h-full flex w-full overflow-hidden pt-6 px-4 bg-white ">
                    <side-menu :samepage="activeTab" :auth="auth" :url="conf.url ? conf.url : '/'" :key="main_menu" :menus="main_menu" v-if="auth  && showSide" class="sidebar mx-1" id="sidebar" style="z-index:999"></side-menu>

                    <div @click="checkMobileMenu()" v-if="auth" class="w-full flex overflow-auto" style="height: 85vh; z-index: 999;">
                        <div class="w-full">
                            <transition   :duration="550">
                                <component ref="activeTab" :types-list="typesList"  :key="activeComponent" :path="activeTab" :system_setting="system_setting" :setting="setting" :lang="lang" :conf="conf" :auth="auth" :is="activeComponent"></component>
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


import {defineAsyncComponent} from 'vue';
import SideMenu from '@/components/side-menu.vue'; 
import navbar from '@/components/navbar.vue'; 
import dashboard from '@/components/dashboard.vue'; 
import trips from '@/components/trips.vue'; 
import vehicles from '@/components/vehicles.vue'; 
import HelpMessages from '@/components/help_messages.vue'; 
import notifications_events from '@/components/notifications_events.vue'; 
import {translate, handleRequest, showAlert} from '@/utils.vue';

const students = defineAsyncComponent(() =>
  import('@/components/students.vue')
);
const parents = defineAsyncComponent(() =>
  import('@/components/parents.vue')
);

const drivers = defineAsyncComponent(() =>
  import('@/components/drivers.vue')
);

const events = defineAsyncComponent(() =>
  import('@/components/events.vue')
);

const roles = defineAsyncComponent(() =>
  import('@/components/roles.vue')
);

const settings = defineAsyncComponent(() =>
  import('@/components/settings.vue')
);

const system_settings = defineAsyncComponent(() =>
  import('@/components/system_settings.vue')
);

const routes = defineAsyncComponent(() =>
  import('@/components/routes.vue')
);

const locations = defineAsyncComponent(() =>
  import('@/components/locations.vue')
);

const destinations = defineAsyncComponent(() =>
  import('@/components/destinations.vue')
);

const users = defineAsyncComponent(() =>
  import('@/components/users.vue')
);

export default {
    name: 'app',
    components: {
        SideMenu,
        navbar,
        dashboard,
        trips,
        vehicles,
        students,
        parents,
        drivers,
        roles,
        routes,
        system_settings,
        settings,
        locations,
        destinations,
        events,
        notifications_events,
        users,
        translate,
        'help_messages':HelpMessages,
    },
    data() {
        return {
            date: '',
            activeItem: null,
            showAddSide: false,
            showEditSide: false,
            showTab: true,
            activeComponent: 'dashboard',
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

        // $(window).on('popstate', function(e) {
        //     t.switchTab({link:window.location.pathname.replace('/','')})
        // });
        
        $(document).on('submit', 'form',function (e) {
            e.preventDefault();
            t.submit(this, e)
        })

        this.showSide =  (window.screen.availWidth > 1000 ) ? true : false;

        // Check if Native notifications enabled  from Master
        if (this.system_setting && this.system_setting.enable_notifications)
            // this.notify()

        this.checkMobileMenu()    

    },
    methods: 
    {
        /**
         * Check if the user has access 
         * to specific permission
         */
        can(i)
        {
            if (!this.auth )
                return null;

            if (i && this.auth.permissions)
                return this.auth.permissions[i]
                
            return null;
        },
        checkAccess(currentPermissions, permission)
        {
            if (currentPermissions)
                return currentPermissions[permission];
            
            return null;
        },

        /**
         * Close menu at mobile and 
         * small screen devices
         */
        checkMobileMenu()
        {
            if (window.innerWidth < 800)
            {
                this.showSide = false;
            }
        },

          
        /**
         * Check notifications permission
         * Send welcome notification
         */ 
        notify (title, body) 
        {

            if (this.system_setting.notifications_welcome_message)
                return null;

        },


        /**
         * Get the props for App root
         */
        setProps()
        {
            console.log('set props')

            const mountEl = document.getElementById("root-parent");
            let props = { ...mountEl.dataset };
            this.auth = props ? JSON.parse(props.auth) : {};
            this.main_menu = props ? JSON.parse(props.menu) : {};
            this.lang = props ? JSON.parse(props.lang) : {};
            this.setting = props ? JSON.parse(props.setting) : {};
            this.system_setting = props ? JSON.parse(props.system_setting) : {};
            this.conf = props ? JSON.parse(props.conf) : {};
            this.activeTab = (props && props.page) ? props.page : this.defaultPage();
            this.activeComponent = (props && props.component) ? props.component : this.defaultPage();
            this.show = true
            console.log(this.activeComponent);

        },


        /**
         * Switch between Tabs
         */ 
        switchTab(tab) {
            if (!tab.sub)
            {
                console.log('switch')
                this.show = false
                this.activeTab = (tab && tab.link) ? tab.link : this.defaultPage();
                this.activeComponent = (tab && tab.component) ? tab.component : this.activeTab;
                this.show = true
                history.pushState({menu: JSON.parse(JSON.stringify(tab))}, '', this.conf.url+this.activeTab);
                this.checkMobileMenu()
            }
        },
        
        /**
         * The default page to load if 
         * loaded component is not found
         */
        defaultPage()
        {
            return 'dashboard';
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


        /**
         * Handle login access result 
         * 
         */
        handleAccess(response) 
        {
            if (response && (response.success && response.reload))
            {
                showAlert(response.result, 3500);
                setTimeout(() => {
                    location.reload();
                }, 2000);

            } else {
                response ? showAlert(response.result, 3000) : null;
            }


        },

        submit(element, props)
        {
            let Things = $(element).serializeArray()
            var params = new URLSearchParams();
            Things.map(function(n){
                params.append([n['name']],  n['value']);
            });

            handleRequest(params, $(element).attr('action')).then(response => {
                this.handleAccess(response)
            })
        },

    }
}
</script>
<style>
/* @import './assets/webfonts/fontawesome.min.css'; */
@import './assets/bootstrap-grid.min.css';
@import './assets/tailwind.min.css';
@import './assets/media-library.css';
@import './assets/style.css';
@import './assets/theme.css';
@import './assets/plugins.css';

</style>
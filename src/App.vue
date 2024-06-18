<template>
    <div>

        <div v-if="loader" class="bg-white fixed w-full h-full top-0 left-0" style="z-index:99999; opacity: .9;">
            <img class="m-auto w-500px" :src="'/uploads/loader.gif'" />
        </div>
        <div class="left-4">
            <!-- component -->
            
            <div class="w-full relative">
                
                <navbar @togglemenu="toggleMenuClass" :langs="langs" v-if="auth" style="z-index: 9999;" :system_setting="system_setting" :lang="lang" :conf="conf" :auth="auth" ></navbar>
                <!-- <a href="javascript:;" class="mainmenu-close px-4  text-lg absolute top-4 mx-6 block" style="z-index:999" @click="showSide = !showSide"><vue-feather type="menu"></vue-feather></a> -->
                <div class="gap gap-6 h-full flex w-full overflow-hidden   ">
                    <side-menu @callback="switchTab" :samepage="activeTab" :system_setting="system_setting" :auth="auth" :url="conf.url ? conf.url : '/'" :key="menuClass" :menus="main_menu" class="sidebar " id="sidebar" v-if="showSide" :menuclass="menuClass" style="z-index:9999"></side-menu>
                    
                    <div @click="checkMobileMenu()" v-if="auth" class="w-full flex overflow-auto" >
                        <div class="w-full" v-if="checkAccess()">
                            <transition  :duration="1000">
                                <component @callback="switchTab" class="pt-8 px-1 min-h-400px" ref="activeTab" :setting="setting" :types-list="typesList"  :key="activeTab" :path="activeTab" :system_setting="system_setting" :lang="lang" :conf="conf" :auth="auth" :is="activeComponent" :currency="currency"></component>
                            </transition>
                        </div>
                        <div class="w-full" v-if="!checkAccess() && !loader">
                          <get_started :currency="currency" :system_setting="system_setting" :setting="setting" :lang="lang" :conf="conf" :auth="auth"></get_started>
                        </div>

                    </div>
                    <div v-else class="w-full flex overflow-auto" >
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
import master_dashboard from '@/components/master_dashboard.vue'; 
import trips from '@/components/trips.vue'; 
import HelpMessages from '@/components/help_messages.vue'; 
import notifications_events from '@/components/notifications_events.vue'; 
import {translate, handleAccess, handleRequest, handleGetRequest, showAlert} from '@/utils.vue';

const get_started = defineAsyncComponent(() => import('@/components/wizards/get-started.vue') );

// Default data table pages
const students = defineAsyncComponent(() => import('@/components/datatable_pages/students.vue') );
const events = defineAsyncComponent(() => import('@/components/datatable_pages/events.vue') );
const parents = defineAsyncComponent(() => import('@/components/datatable_pages/parents.vue') );
const companies = defineAsyncComponent(() => import('@/components/datatable_pages/companies.vue') );
const schools = defineAsyncComponent(() => import('@/components/datatable_pages/schools.vue') );
const employees = defineAsyncComponent(() => import('@/components/datatable_pages/employees.vue') );
const vehicle_types = defineAsyncComponent(() => import('@/components/datatable_pages/vehicle_types.vue') );
const supervisors = defineAsyncComponent(() => import('@/components/datatable_pages/supervisors.vue') );
const vehicles = defineAsyncComponent(() => import('@/components/datatable_pages/supervisors.vue') );
const languages = defineAsyncComponent(() => import('@/components/datatable_pages/languages.vue') );
const gallery = defineAsyncComponent(() => import('@/components/datatable_pages/gallery.vue') );
const newsletter_subscribers = defineAsyncComponent(() => import('@/components/datatable_pages/newsletter_subscribers.vue') );
const notifications = defineAsyncComponent(() => import('@/components/datatable_pages/notifications.vue') );
const email_templates = defineAsyncComponent(() => import('@/components/email_templates.vue') );
const data_table = defineAsyncComponent(() => import('@/components/datatable_pages/data_table_page.vue') );


const drivers = defineAsyncComponent(() => import('@/components/driver/drivers.vue') );

const roles = defineAsyncComponent(() => import('@/components/roles.vue') );

const settings = defineAsyncComponent(() => import('@/components/settings/settings.vue') );

const system_settings = defineAsyncComponent(() => import('@/components/settings/system_settings.vue') );

const routes = defineAsyncComponent(() => import('@/components/routes.vue') );


const locations = defineAsyncComponent(() => import('@/components/locations.vue') );

const users = defineAsyncComponent(() => import('@/components/users.vue') );

const pages = defineAsyncComponent(() => import('@/components/pages.vue') );

const taxi_trips = defineAsyncComponent(() => import('@/components/taxi_trips.vue') );

const app_settings = defineAsyncComponent(() => import('@/components/settings/app_settings.vue') );

const parent_app_settings = defineAsyncComponent(() => import('@/components/settings/parent_app_settings.vue') );

const profile = defineAsyncComponent(() => import('@/components/profile/profile.vue') );

const packages = defineAsyncComponent(() => import('@/components/packages.vue') );

const payment_methods = defineAsyncComponent(() => import('@/components/payment_methods.vue') );

const package_subscriptions = defineAsyncComponent(() => import('@/components/package_subscriptions.vue') );

const driver_applicants = defineAsyncComponent(() => import('@/components/driver_applicants.vue') );

const student_applicants = defineAsyncComponent(() => import('@/components/student_applicants.vue') );

const transactions = defineAsyncComponent(() => import('@/components/transactions.vue') );

const invoices = defineAsyncComponent(() => import('@/components/invoices.vue') );

const vacations = defineAsyncComponent(() => import('@/components/vacations.vue') );

const wallets = defineAsyncComponent(() => import('@/components/wallet/wallets.vue') );

const withdrawals = defineAsyncComponent(() => import('@/components/wallet/withdrawals.vue') );

const driver_page = defineAsyncComponent(() => import('@/components/driver/profile.vue') );

const collected_cash = defineAsyncComponent(() => import('@/components/wallet/collected_cash.vue') );

const translations = defineAsyncComponent(() => import('@/components/translations.vue') );


const contact_forms = defineAsyncComponent(() => import('@/components/contact_forms.vue') );

const menus = defineAsyncComponent(() => import('@/components/menus.vue') );




export default {
    name: 'app',
    components: {
        data_table,
        SideMenu,
        navbar,
        dashboard,
        master_dashboard,
        trips,
        taxi_trips,
        vehicles,
        vehicle_types,
        students,
        parents,
        drivers,
        roles,
        routes,
        system_settings,
        settings,
        locations,
        events,
        notifications,
        notifications_events,
        users,
        schools,
        companies,
        employees,
        pages,
        packages,
        app_settings,
        parent_app_settings,
        profile,
        payment_methods,
        package_subscriptions,
        supervisors,
        driver_applicants,
        student_applicants,
        transactions,
        invoices,
        vacations,
        wallets,
        withdrawals,
        driver_page,
        collected_cash,
        languages,
        translations,
        newsletter_subscribers,
        contact_forms,
        gallery,
        menus,
        email_templates,
        get_started,
        translate,
        'help_messages':HelpMessages,
      },
      data() {
        return {
            langs: [],
            date: '',
            loader: true,
            activeItem: null,
            showAddSide: false,
            showEditSide: false,
            showTab: true,
            activeComponent: 'dashboard',
            activeTab: 'dashboard',
            status: null,
            lang: {},
            auth: {},
            currency: {},
            setting: {},
            system_setting: {},
            setting: {},
            conf: {},
            url: '/',
            main_menu: [],
            typesList: [],
            showSide: true,
            showModal: false,
            activeModal: null,
            menuClass: ''
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
        checkAccess()
        {
          if (this.auth && this.auth.role_id == 1){
            return true;
          }

          if (!this.auth)
            return false;

          return true;
        },

        /**
         * Close menu at mobile and 
         * small screen devices
         */
        checkMobileMenu()
        {
            if (window.innerWidth < 800)
            {
                this.menuClass = '';
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

            const mountEl = document.getElementById("root-parent");
            let propsSet = { ...mountEl.dataset };
            handleGetRequest('/api/load_config?component='+propsSet.component).then(response => {
                this.setPropsData(response, response.app, propsSet.page)
                this.loader = false;
            })
        },

        /**
         * Get the props for App root
         */
        setPropsData(response, app, page)
        {
            if (app && response)
            {
                this.url = app.conf ? app.conf.url : '/';
                this.activeTab = page ?? this.defaultPage();
                this.auth = app.auth ?? {};
                this.main_menu = response.menu ?? {};
                this.setting = app.setting ?? {};
                this.system_setting = app.setting ?? {};
                this.setting = app.setting ?? {};
                this.conf = app['CONF'] ?? {};
                this.activeComponent = response.component ?? this.defaultPage();
                this.currency = app.currency ?? {};
                this.lang = response.lang_json ?? {};
                this.langs = response.langs ?? {};
                this.menuClass = ' '
            }
            
        },


        /**
         * Switch between Tabs
         */ 
        switchTab(tab) {
            if (!tab.sub)
            {
                this.activeTab = (tab && tab.link) ? tab.link : this.defaultPage();
                this.activeComponent = (tab && tab.component) ? tab.component : this.activeTab;
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

        toggleMenuClass() {
            this.showSide = true ; 
            this.menuClass = 'drawer drawer-start drawer-on' 
        },

        submit(element, props)
        {
            this.loader = true;
            let Things = $(element).serializeArray()
            var params = new URLSearchParams();
            Things.map(function(n){
                params.append([n['name']],  n['value']);
            });
            
            var t = this;

            handleRequest(params, $(element).attr('action')).then(response => {
                t.loader = false;
                handleAccess(response)

            }).catch(error => {
                showAlert(error)
            })
        },

    }
}
</script>
<style src="@vueform/multiselect/themes/default.css"></style>

<style>
@import './assets/bootstrap-grid.min.css';
@import './assets/tailwind.min.css';
@import './assets/media-library.css';
@import './assets/style.bundle.css';


/* we will explain what these classes do next! */
.v-enter-active,
.v-leave-active {
  transition: all 0.8s ease-in-out;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
  position: absolute ;
  /* top:0; */
  transition: all 0.1s ease-in-out;
}

@media (min-width: 1024px)
{
    .flex.flex-wrap.lg\:flex-nowrap
    {
        flex-wrap: nowrap !important;
    }
}
</style>
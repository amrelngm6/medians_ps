/*
 |--------------------------------------------------------------------------
 | Components
 |--------------------------------------------------------------------------
 | Import JS components.
*/

/**
 * Vue JS
*/
import Vue from 'vue';
window.Vue = require('vue');

/**
 * Sweet alert
 */ 
import VueSimpleAlert from "vue-simple-alert";
Vue.use(VueSimpleAlert);

/** 
 * Used for calendar Comonent
 */ 
import PortalVue from "portal-vue";
Vue.use(PortalVue);


/**
 * Axios for http requests
 */ 
import axios from 'axios';
Vue.prototype.$http = axios

/**
 * Custom component 
 * for main calendar 
 */ 
import {MediansCalendar}  from 'medians-calendar';

/**
 * Date picker
 */ 
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';

import moment from 'moment';


/**
 * Calendar components
 */ 
Vue.component('calendar_products', () => import('./components/calendar-products-list.vue'));
Vue.component('calendar_products_selected', () => import('./components/calendar-products-selected.vue'));
Vue.component('calendar_active_item', () => import('./components/calendar-active-item.vue'));
Vue.component('calendar_new_item', () => import('./components/calendar-new-item.vue'));
Vue.component('calendar_modal', () => import('./components/calendar-booking-modal.vue'));
Vue.component('calendar_booking_confirm', () => import('./components/calendar-booking-confirm.vue'));
Vue.component('calendar', () => import('./components/calendar.vue'));



/**
 * APP General components
 */ 
Vue.component('date_picker', () => DatePicker);
Vue.component('login-dashboard', () => import('./login-dashboard.vue'));
Vue.component('side-menu', () => import('./side-menu.vue'));
Vue.component('side_cart', () => import('./side_cart.vue'));
Vue.component('customers_form', () => import('./customers_form.vue'));
Vue.component('users_form', () => import('./users_form.vue'));
Vue.component('user_modal', () => import('./user_modal.vue'));
Vue.component('forms', () => import('./forms.vue'));
Vue.component('vue-medialibrary-manager', () => import('./components/Manager.vue'));
Vue.component('vue-medialibrary-field', () => import('./components/Field.vue'));




const VueApp = new Vue(
{
    el: '#app',

    data() {
        return {
            langs:{},
            date: '',
            activeItem:null,
            activeModal:'',
            showModal:false,
            showSide:true,
            showAddSide:false,
            showEditSide:false,
            showTab:true,
            activeTab:'step1',

        };
    },

    components: {
        moment,
        DatePicker,
        axios,
        MediansCalendar
    },
    beforeCreate: function() {

    },
    mounted() {

    }, 
    methods: {
        /**
         * Switch between tabs
         */
        setTab(tab)
        {
            this.activeTab = null; 
            this.showTab = false;  
            this.activeTab = tab; 
            var t = this;
            setTimeout(function(){
               t.showTab = true; 
           }, 100)
        },

        /**
         * Datepicker Change url handler 
         */ 
        openPageByDate(url, event)
        {

            let start = url.includes('?') ? '&' : '?';
            url += start + 'start=' + event[0].getFullYear() +'-'+(event[0].getMonth() + 1) +'-'+ event[0].getDate();    
            url += '&end=' + event[1].getFullYear() +'-'+(event[1].getMonth() + 1) +'-'+ event[1].getDate();    

            let [path, params] = url.split("?");
            let result = path + '?' + new URLSearchParams(Object.fromEntries(new URLSearchParams(params))).toString()

            window.location.href = result;
        },

        /**
         * Display modal 
         */ 
        viewModal(element, id)
        {
            jQuery('#modal-details').removeClass('hidden')
            this.showModal = !this.showModal;
            this.activeModal = element;

            return this.checkRefById(id);
        },

        viewSide(element)
        {
            jQuery('#modal-sidebar').removeClass('hidden')
            this.showSide = !this.showSide;
            this.activeModal = element;

            return this;
        },

        checkRefById(id)
        {
            var t = this;
            setTimeout(function() {
                console.log(t.$refs[t.activeModal].checkById(id))
            }, 500);
            return t;
        },


        changeStatus(status, model, id)
        {   
            const params = new URLSearchParams([]);
            params.append('model', model);
            params.append('id', id);
            params.append('status', status);
            this.handleRequest(params, '/api/updateStatus').then(response=> {
                window.location.reload();
                this.$alert(data);
            });

        },

        setActiveItem(item)
        {
            this.activeItem = item;
        },
        showSidebar()
        {
            this.showSide = !this.showSide;
        },  

        
        /**
         * Handle POST request
         * @params URLSearchParams()   
         * @url String 
         * and return its response
         */
        async handleRequest(params, url = '/api') {

            // Demo json data
            return await axios.post(url, params.toString()).then(response => 
            {
                if (response.data)
                    return response.data;
            });
        },
        
        /**
         * Handle Get request
         * @url String 
         * and return its response
         */ 
        async handleGetRequest(url) {

            // Demo json data
            return await axios.get(url).then(response => 
            {
                if (response.data)
                    return response.data;
                else 
                    return response;
            });
        },


        /**
         * Debug console.log 
         * for Vue components
         */ 
        log(data)
        {
            console.log(data)
        },

        /**
         * Used inside the twig files 
         * To set the language array
         */ 
        setLangs(langs)
        {
            this.langs = langs;
        },

        /**
         * Translate function
         */ 
        __(i)
        {
            return this.langs[i];
        }
    }
});

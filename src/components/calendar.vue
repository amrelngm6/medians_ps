<template>
    <div class=" w-full">
        <div class="w-full lg:flex gap gap-2" v-if="content.typesList" :key="activeCategories">
            <div v-for="category in content.typesList" :key="category.selected" @click="selectCategory(category)" class="cursor-pointer py-2 px-4 rounded" :class="{'font-bold':category.selected}"  >
                <span v-text="category.name"></span>
            </div>
        </div>
        <calendar_status_list></calendar_status_list>
        <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
            <div class=" w-full">
                <calendar_get_started :categories="content.typesList" v-if="content.title && !content.devicesList.length"></calendar_get_started>

                <main_calendar
                v-if="content.devicesList.length && !showLoader"
                :key="activeCategories"
                ref="calendar"
                :settings="setting"
                :devices="devices"
                ></main_calendar>
            </div>
        </div>
    </div>
</template>
<script>
const axios = require('axios').default;

import main_calendar from './main-calendar.vue'
import calendar_get_started from './calendar-get-started.vue'
import calendar_status_list from './calendar-status-list.vue'

export default 
{
    components: {
        main_calendar,
        calendar_status_list,
        calendar_get_started
    },
    name:'categories',
    data() {
        return {
            url: '/calendar?load=json',
            content: {

                title: '',
                model: '',
                devicesList: [],
                typesList: [],
            },

            devices:[],
            activeCategories:[],
            activeItem:null,
            showAddSide:false,
            showEditSide:false,
            showLoader: false,
        }
    },
    props: [
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
        selectCategory(category = {})
        {
            this.activeCategories[category.id] = !this.activeCategories[category.id]
            category.selected = !category.selected
            this.filterDevicesByCategory()
        },
        filterCategories()
        {
            
            this.showLoader = true
            if (this.content.typesList)
            {
                for (var i = this.content.typesList.length - 1; i >= 0; i--) {
                    this.content.typesList[i].selected = true;
                    this.activeCategories[this.content.typesList[i].id] = (this.content.typesList[i]) ? true : false;
                }
            }
            this.showLoader = false
            return this.activeCategories;
        },
        filterDevicesByCategory()
        {
            this.devices = [];
            for (var i = this.content.devicesList.length - 1; i >= 0; i--) {
                if (this.content.devicesList[i] && this.activeCategories[this.content.devicesList[i].type])
                {
                    this.devices[i] = this.content.devicesList[i]
                }
            }
            return this.devices;
        },
        load()
        {
            this.showLoader = true;
            this.$parent.handleGetRequest( this.url ).then(response=> {
                this.setValues(response).filterCategories()
                this.showLoader = false;
                // this.$alert(response)
            });
        },
        
        async handleRequest(params, url = '/api') {

            // Demo json data
            return await this.$parent.handleRequest(params, url);
        },

        async handleGetRequest(url) {

            return await this.$parent.handleGetRequest(url);
        },
        setValues(data) {
            this.content = JSON.parse(JSON.stringify(data)); 
            return this

        },
        log(i)
        {
            return console.log(i);
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
<template>
    <div class=" w-full">
        <div class="w-full lg:flex gap gap-2" v-if="content.typesList">
            <div v-for="category in content.typesList" :key="category.selected" @click="selectCategory(category)" class="cursor-pointer py-2 px-4 rounded" :class="{'font-bold':category.selected}"  >
                <span v-text="category.name"></span>
            </div>
        </div>
        <calendar_status_list></calendar_status_list>
        <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
            <div class=" w-full">
                <calendar_get_started :categories="content.typesList" v-if="!content.devicesList.length"></calendar_get_started>

                <main_calendar
                v-if="content.devicesList.length"
                :key="activeCategory"
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
            activeCategory:0,
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
        selectCategory(category)
        {
            let this.devices = [];

            for (var i = this.content.devicesList.length - 1; i >= 0; i--) {
                if (this.content.devicesList[i] && this.content.devicesList[i].type == category.id)
                {
                    this.devices[i] = this.content.devicesList[i]
                }
            }
            category.selected = !category.selected
            this.activeCategory = category.id
        },
        load()
        {
            this.showLoader = true;
            this.$parent.handleGetRequest( this.url ).then(response=> {
                this.setValues(response)
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
            this.content.activeCategory
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
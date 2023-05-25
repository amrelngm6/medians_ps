<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div class=" w-full">

            <main v-if="content && !showLoader" class=" flex-1 overflow-x-hidden overflow-y-auto  w-full">
                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                </div>

                <div class="w-full lg:flex gap gap-2 pt-2">
                    <dashboard_card  classes="bg-gradient-purple" :title="__('Today_orders')" :value="content.todayOrders"></dashboard_card>
                    <dashboard_card  classes="bg-gradient-warning" :title="__('Last_week_orders')" :value="content.lastWeekOrders"></dashboard_card>
                    <dashboard_card  classes="bg-gradient-info" :title="__('Last_30_Days')" :value="content.lastMonthOrders"></dashboard_card>
                </div>
                <hr class="" />
                <div class="w-full flex gap gap-6">
                    <data-table ref="devices_orders" @actionTriggered="handleAction" v-bind="bindings"/>

                </div>
            </div>

        </div>
    </div>
</template>
<script>
import moment from 'moment';
import dataTableLink from './includes/data-table-link.vue';
import dashboard_card from './includes/dashboard_card';


export default 
{
    components:{
        dashboard_card,
    },
    name:'invoices',
    data() {
        return {
            url: this.conf.url+this.path+'&load=json',
            content: {
                title: '',
                items: [],
                columns: [],
            },

            activeItem:{},
            showAddSide:false,
            showEditSide:false,
            showLoader: true,
        }
    },

    computed: {
        bindings() {

            this.content.columns[1] = {
                    key: this.__("code"),
                    component: dataTableLink,
                    sortable: true,
                };


            return {

                columns: this.content.columns,
                data: this.content.items
            }
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
        this.load()
    },

    methods: 
    {

        /**
         * Handle actions from datatable buttons
         * Called From 'dataTableActions' component
         * 
         * @param String actionName 
         * @param Object data
         */  
        handleAction(actionName, data) {
            switch(actionName) 
            {
                case 'view':
                    // window.open(this.conf.url+data.content.prefix)
                    break;  

                case 'edit':
                    this.showEditSide = true; 
                    this.showAddSide = false; 
                    this.activeItem = data
                    break;  

                case 'delete':
                    this.$parent.delete(data, 'Product.delete');
                    break;  
            }
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
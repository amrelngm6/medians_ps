<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div class=" w-full relative">
            <div v-if="showLoader" class="mx-auto mt-10 absolute top-0 left-0 right-0 bottom-0 m-auto w-40 h-40" >
                <img :src="conf.url+'uploads/images/loader.gif'"  />
            </div>
            <main v-if="content && !showLoader" class=" flex-1 overflow-x-hidden overflow-y-auto  w-full">
                <!-- Begin -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                </div>
                <hr class="mt-2" />
                <div class="w-full flex gap gap-6">
                    <data-table ref="devices_orders" @actionTriggered="handleAction" v-bind="bindings"/>

                </div>
                <!-- END New releases -->
            </main>
        </div>
    </div>
</template>
<script>
import moment from 'moment';
import dataTableActions from './includes/data-table-actions.vue';

export default 
{
    components: {
        moment,
        dataTableActions
    },
    name:'products',
    data() {
        return {
            url: this.conf.url+this.path+'?load=json',
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

            // this.content.columns.push({
            //         key: this.__("actions"),
            //         component: dataTableActions,
            //         sortable: false,
            //     });

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
        timeFormat (time)
        {
            return moment(time).format('YYYY-MM-DD hh:mm a')
        },
        __(i)
        {
            return this.$root.$children[0].__(i);
        }
    }
};
</script>
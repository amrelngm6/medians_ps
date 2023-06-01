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
                    <a href="javascript:;" class="uppercase p-2 mx-2 text-center text-white w-32 rounded bg-gradient-purple hover:bg-red-800" @click="showLoader = true, showAddSide = true,showLoader = false; ">{{__('add_new')}}</a>
                </div>
                <hr class="mt-2" />
                <div class="w-full flex gap gap-6">
                    <data-table ref="devices_orders" @actionTriggered="handleAction" v-bind="bindings"/>


                    <div class="col-md-3" v-if="showAddSide">
                        <div class="mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 ">
                            <form action="/api/create" method="POST" data-refresh="1" id="add-device-form" class="action  py-0 m-auto rounded-lg max-w-xl pb-10">
                                <div class="w-full flex">
                                    <h1 class="w-full m-auto max-w-xl text-base mb-10 ">{{__('ADD_new')}}</h1>
                                    <span class="cursor-pointer py-1 px-2" @click="showAddSide = false"><close_icon /></span>
                                </div>
                                <input name="type"  type="hidden" value="Expense.create" > 

                                <div class="w-full py-2">
                                    <label class="w-40 mt-6 ">{{__('name')}}</label>
                                    <input name="params[name]" required="" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" > 
                                </div>

                                <div class="w-full py-2">
                                    <label class="w-40 mt-6  ">{{__('Amount')}}</label>
                                    <input required name="params[amount]" type="number" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600"> 
                                </div>

                                <div class="w-full py-2">
                                    <label class="w-40 mt-6  ">{{__('date')}}</label>
                                    <input  :value="today" name="params[date]" type="date" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600"> 
                                </div>

                                <div class="w-full py-2">
                                    <label class="w-40 mt-6 ">{{__('invoice_id')}}</label>
                                    <input name="params[invoice_id]" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600"> 
                                </div>

                                <div class="w-full py-2">
                                    <label class="w-40 mt-6 ">{{__('notes')}}</label>
                                    <textarea name="params[notes]" class="h-40 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('Notes')" ></textarea> 
                                </div>


                                <button class="uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800" v-text="__('save')"></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3" v-if="showEditSide">
                        <div class="mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 ">
                            <form action="/api/update" method="POST" data-refresh="1" id="add-device-form" class="action  py-0 m-auto rounded-lg max-w-xl pb-10">
                                <div class="w-full flex">
                                    <h1 class="w-full m-auto max-w-xl text-base mb-10 ">{{__('Update')}}</h1>
                                    <span class="cursor-pointer py-1 px-2" @click="showEditSide = false"><close_icon /></span>
                                </div>
                                <input name="type"  type="hidden" value="Expense.create" > 

                                <div class="w-full py-2">
                                    <label class="w-40 mt-6 ">{{__('name')}}</label>
                                    <input name="params[name]" required="" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :value="activeItem.name"> 
                                </div>

                                <div class="w-full py-2">
                                    <label class="w-40 mt-6  ">{{__('Amount')}}</label>
                                    <input disabled name="params[amount]" type="number" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :value="activeItem.amount"> 
                                </div>

                                <div class="w-full py-2">
                                    <label class="w-40 mt-6  ">{{__('date')}}</label>
                                    <input disabled name="params[date]" type="date" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :value="activeItem.date"> 
                                </div>

                                <div class="w-full py-2">
                                    <label class="w-40 mt-6 ">{{__('invoice_id')}}</label>
                                    <input name="params[invoice_id]" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :value="activeItem.name"> 
                                </div>

                                <div class="w-full py-2">
                                    <label class="w-40 mt-6 ">{{__('notes')}}</label>
                                    <textarea name="params[notes]" class="h-40 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('Notes')" >{{activeItem.notes}}</textarea> 
                                </div>


                                <button class="uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800" v-text="__('Update')"></button>
                            </form>
                        </div>
                    </div>
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

            this.content.columns.push({
                    key: this.__("actions"),
                    component: dataTableActions,
                    sortable: false,
                });

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
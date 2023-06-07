<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div class=" w-full">

            <main v-if="content && !showLoader" class=" flex-1 overflow-x-hidden overflow-y-auto  w-full">
                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                    <a href="javascript:;" class="uppercase p-2 mx-2 text-center text-white w-32 rounded bg-gradient-purple hover:bg-red-800" @click="showLoader = true, showAddSide = true,activeItem = {}, showLoader = false; ">{{__('add_new')}}</a>
                </div>
                <hr class="mt-2" />
                <div class="w-full flex gap gap-6">
                    <data-table ref="devices_orders" @actionTriggered="handleAction" v-bind="bindings"/>

                    <div class="col-md-3 sidebar-create-form" v-if="showAddSide">
                        <div class="mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 ">
                            <form action="/api/create" method="POST" data-refresh="1" id="add-device-form" class="action  py-0 m-auto rounded-lg max-w-xl pb-10">
                                <div class="w-full flex">
                                    <h1 class="w-full m-auto max-w-xl text-base mb-10 ">{{__('ADD_new')}}</h1>
                                    <span class="cursor-pointer py-1 px-2" @click="showAddSide = false"><close_icon /></span>
                                </div>
                                <input name="type" type="hidden" value="Product.create">
                                <input name="params[status]" type="hidden" value="1">
                                <input name="params[name]" required="" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('name')">
                                <input name="params[price]" required="" type="number" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('Product_price')">
                                <textarea name="params[description]" rows="3" class=" mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('description')"></textarea>

                                <label class="block mt-3">
                                    <span class="block mb-2" v-text="__('category')"></span>
                                    <select name="params[type]" class="form-checkbox p-2 px-3 w-full text-orange-600 border border-1 border-gray-400 rounded-lg">
                                        <option v-for="type in content.typesList" :value="type.id" v-text="type.name"></option>
                                    </select>
                                </label>


                                <button class="uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800" v-text="__('save')"></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3 mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700  sidebar-edit-form" v-if="showEditSide && !showAddSide ">
                        <div class="w-full">

                            <div class="w-full flex">
                                <h1 class="w-full m-auto max-w-xl text-base mb-10 " v-text="__('update')"></h1>
                                <span class="cursor-pointer py-1 px-2" @click="showEditSide = false"><close_icon /></span>
                            </div>
                            <div >
                                <form action="/api/update" method="POST" data-refresh="1" id="add-device-form" class="action py-0 m-auto rounded-lg max-w-xl pb-10">


                                    <input name="type" type="hidden" value="Product.update">
                                    <input name="params[id]" type="hidden" v-model="activeItem.id">

                                    <span class="block mb-2" v-text="__('name')"></span>
                                    <input name="params[name]" required="" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('name')" v-model="activeItem.name">

                                    <textarea name="params[description]" rows="3" class=" mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('description')" v-model="activeItem.description"></textarea>

                                    <div class="w-full block gap gap-2">
                                        <label class="w-40 mt-6  ">{{__('price')}}</label>
                                        <input name="params[price]" type="number" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" v-model="activeItem.price"> 
                                    </div>

                                    <label class="block mt-3">
                                        <span class="block mb-2" v-text="__('category')"></span>
                                        <select v-model="activeItem.type" name="params[type]" class="form-checkbox p-2 px-3 w-full text-orange-600 border border-1 border-gray-400 rounded-lg">
                                            <option v-for="type in content.typesList" :value="type.id" v-text="type.name"></option>
                                        </select>
                                    </label>

                                    <label class="inline-flex items-center mt-3">
                                        <input name="params[status]" type="checkbox"  v-model="activeItem.status" class="form-checkbox h-5 w-5 text-orange-600">
                                        <span class="ml-2 text-gray-700  mx-2" >{{__('PUBLISH')}}</span>
                                    </label>

                                    <button class="uppercase h-10 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800">{{__('Update')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END New releases -->
            </main>
        </div>
    </div>
</template>
<script>

import dataTableTitleImg from './includes/data-table-title-img.vue';
import dataTableActions from './includes/data-table-actions.vue';

export default 
{
    components:{
        dataTableTitleImg,
        dataTableActions,
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


            this.content.columns[1]= {
                    key: this.__("title"),
                    component: dataTableTitleImg,
                    sortable: false,
                };

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
<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div class=" w-full">

            <main v-if="content && !showLoader" class=" flex-1 overflow-x-hidden overflow-y-auto  w-full">
                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                    <a href="javascript:;" class="uppercase p-2 mx-2 text-center text-white w-32 rounded-lg menu-dark hover:bg-purple-800" @click="showLoader = true, showAddSide = true,activeItem = {}, showLoader = false; ">{{translate('add_new')}}</a>
                </div>
                <hr class="mt-2" />
                <div class="w-full flex gap gap-6 overflow-x-auto">
                    
                    <datatabble :body-text-direction="translate('lang') == 'ar' ? 'right' : 'left'" fixed-checkbox v-if="content.columns" :headers="content.columns" :items="content.items" >

                        <template #item-edit="item">
                            <button v-if="!item.not_editable" class="p-2 hover:text-gray-600 text-purple" @click="handleAction('edit', item)">
                                <vue-feather class="w-5" type="edit"></vue-feather>
                            </button>
                        </template>
                        <template #item-delete="item">
                            <button v-if="!item.not_removeable" class="p-2 hover:text-red-400 text-red-500 " @click="handleAction('delete', item)">
                                <delete_icon class="w-5"/>
                            </button>
                        </template>
                    </datatabble>
                    <!-- <data-table ref="devices_orders" @actionTriggered="handleAction" v-bind="bindings"/> -->

                    <div class="col-md-3 sidebar-create-form" v-if="showAddSide">
                        <div class=" mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 ">
                            <form action="/api/create" method="POST" data-refresh="1" id="add-device-form" class="action  py-0 m-auto rounded-lg max-w-xl pb-10">
                                <div class="w-full flex">
                                    <h1 class="w-full m-auto max-w-xl text-base mb-10 ">{{translate('ADD_new')}}</h1>
                                    <span class="cursor-pointer py-1 px-2" @click="showAddSide = false"><close_icon /></span>
                                </div>
                                <input name="type" type="hidden" value="NotificationEvent.create">

                                <input name="params[title]" required="" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="translate('event title')">

                                <input name="params[subject]" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="translate('subject')">

                                <textarea name="params[body]" type="text" rows="4" class="mt-3 rounded-lg w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="translate('body')"></textarea>

                                <textarea name="params[body_text]" type="text" rows="4" class="mt-3 rounded-lg w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="translate('Notification text')"></textarea>

                                <label class="block mt-3">
                                    <span class="block mb-2" v-text="translate('model')"></span>
                                    <select name="params[model]" class="form-checkbox p-2 px-3 w-full text-orange-600 border border-1 border-gray-400 rounded-lg">
                                        <option v-for="(model, index) in content.models" :value="model" v-text="index"></option>
                                    </select>
                                </label>

                                <label class="block mt-3">
                                    <span class="block mb-2" v-text="translate('action')"></span>
                                    <select name="params[action]" class="form-checkbox p-2 px-3 w-full text-orange-600 border border-1 border-gray-400 rounded-lg">
                                        <option value="create" v-text="translate('Create')"></option>
                                        <option value="update" v-text="translate('Update')"></option>
                                        <option value="delete" v-text="translate('Delete')"></option>
                                    </select>
                                </label>

                                <input name="params[action_field]" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="translate('action_field')">

                                <input name="params[action_value]" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="translate('action_value')">

                                <label class="block mt-3">
                                    <span class="block mb-2" v-text="translate('receiver_model')"></span>
                                    <select name="params[receiver_model]" class="form-checkbox p-2 px-3 w-full text-orange-600 border border-1 border-gray-400 rounded-lg">
                                        <option value="Medians\Drivers\Domain\Driver" v-text="translate('Driver')"></option>
                                        <option value="Medians\Parents\Domain\Parents" v-text="translate('Parent')"></option>
                                        <option value="Medians\Users\Domain\User" v-text="translate('User')"></option>
                                    </select>
                                </label>
                                
                                <div v-if="!showLoader"  class="py-4 flex gap gap-2 cursor-pointer" @click="setActiveStatus(activeItem)">
                                    <span class="text-gray-700" v-text="translate('Status')"></span>
                                    <span :class="!activeItem.status ? 'bg-inverse-dark' : ''" class="mx-2 mt-1 bg-red-400 block h-4 relative rounded-full w-8" style="direction: ltr;" ><a class="absolute bg-white block h-4 relative right-0 rounded-full w-4" :style="{left: activeItem.status ? '16px' : 0}"></a></span>
                                    <span  v-text="activeItem.status ? translate('Active') : translate('Pending')" class=" font-semibold inline-flex items-center px-2 py-1 rounded-full text-xs font-medium "></span>
                                    <input v-model="activeItem.status"  type="checkbox" class="hidden" :name="'params[status]'" />
                                </div>

                                <button class="uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800" v-text="translate('save')"></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3 mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700  sidebar-edit-form" v-if="showEditSide && !showAddSide ">
                        <div class="mt-10 w-full">

                            <div class=" mt-2 w-full flex">
                                <h1 class="w-full m-auto max-w-xl text-base mb-10 " v-text="translate('update')"></h1>
                                <span class="cursor-pointer py-1 px-2" @click="showEditSide = false"><close_icon /></span>
                            </div>
                            <div >
                                <form action="/api/update" method="POST" data-refresh="1" id="add-device-form" class="action py-0 m-auto rounded-lg max-w-xl pb-10">


                                    <input name="type" type="hidden" value="NotificationEvent.update">
                                    <input name="params[id]" type="hidden" v-model="activeItem.id">


                                    <input name="params[title]" required="" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="translate('event title')" v-model="activeItem.title">

                                    <input name="params[subject]" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="translate('subject')"  v-model="activeItem.subject">

                                    <textarea name="params[body]" type="text" rows="4" class="mt-3 rounded-lg w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="translate('body')"  v-model="activeItem.body"></textarea>

                                    <textarea name="params[body_text]" type="text" rows="4" class="mt-3 rounded-lg w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="translate('Notification text')" v-model="activeItem.body_text"></textarea>

                                    <label class="block mt-3">
                                        <span class="block mb-2" v-text="translate('model')"></span>
                                        <select name="params[model]" class="form-checkbox p-2 px-3 w-full text-orange-600 border border-1 border-gray-400 rounded-lg"  v-model="activeItem.model">
                                            <option v-for="(model, index) in content.models" :value="model" v-text="index"></option>
                                        </select>
                                    </label>

                                    <label class="block mt-3">
                                        <span class="block mb-2" v-text="translate('action')"></span>
                                        <select name="params[action]" class="form-checkbox p-2 px-3 w-full text-orange-600 border border-1 border-gray-400 rounded-lg"  v-model="activeItem.action">
                                            <option value="create" v-text="translate('Create')"></option>
                                            <option value="update" v-text="translate('Update')"></option>
                                            <option value="delete" v-text="translate('Delete')"></option>
                                        </select>
                                    </label>

                                    <input name="params[action_field]" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="translate('action_field')"  v-model="activeItem.action_field">

                                    <input name="params[action_value]" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="translate('action_value')"  v-model="activeItem.action_value">

                                    <label class="block mt-3">
                                        <span class="block mb-2" v-text="translate('receiver_model')"></span>
                                        <select name="params[receiver_model]" class="form-checkbox p-2 px-3 w-full text-orange-600 border border-1 border-gray-400 rounded-lg"  v-model="activeItem.receiver_model">
                                            <option value="Medians\Drivers\Domain\Driver" v-text="translate('Driver')"></option>
                                            <option value="Medians\Parents\Domain\Parents" v-text="translate('Parent')"></option>
                                            <option value="Medians\Users\Domain\User" v-text="translate('User')"></option>
                                        </select>
                                    </label>
                                    
                                    <div v-if="activeItem && !showLoader"  class="py-4 flex gap gap-2 cursor-pointer" @click="setActiveStatus(activeItem)">
                                        <span class="text-gray-700" v-text="translate('Status')"></span>
                                        <span :class="!activeItem.status ? 'bg-inverse-dark' : ''" class="mx-2 mt-1 bg-red-400 block h-4 relative rounded-full w-8" style="direction: ltr;" ><a class="absolute bg-white block h-4 relative right-0 rounded-full w-4" :style="{left: activeItem.status ? '16px' : 0}"></a></span>
                                        <span  v-text="activeItem.status ? translate('Active') : translate('Pending')" class=" font-semibold inline-flex items-center px-2 py-1 rounded-full text-xs font-medium "></span>
                                        <input v-model="activeItem.status"  type="checkbox" class="hidden" :name="'params[status]'" />
                                    </div>                                    

                                    <button class="uppercase h-10 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800">{{translate('Update')}}</button>
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

import {defineAsyncComponent, ref} from 'vue';
import {translate, handleGetRequest, handleRequest, deleteByKey, showAlert} from '@/utils.vue';
import close_icon from '@/components/svgs/Close.vue';
import delete_icon from '@/components/svgs/trash.vue';

import 'vue3-easy-data-table/dist/style.css';
import Vue3EasyDataTable from 'vue3-easy-data-table';


export default
{
    components: {
        'datatabble': Vue3EasyDataTable,
        translate,
        close_icon,
        delete_icon
    },  
    setup(props) {

        const url =  props.conf.url+props.path+'?load=json';
        
        const showAddSide = ref(false);
        const showEditSide = ref(false);
        const showDetails = ref(null);
        const activeItem = ref({});

        const content =  ref({
            title: '',
            items: [],
            columns: [],
        });

        const load = () => {
            handleGetRequest( url ).then(response=> {
                content.value = JSON.parse(JSON.stringify(response))
            });
        }
        
        load();

        const closeSide = () => {
            showAddSide.value = false;
            showEditSide.value = false;
        }

        
        const setActiveStatus = (item) => {
            item.status = !item.status;
        }

        

        /**
         * Handle actions from datatable buttons
         * Called From 'dataTableActions' component
         * 
         * @param String actionName 
         * @param Object data
         */  
        const handleAction =  (actionName, data) =>  {
            console.log(actionName);
            switch(actionName) 
            {

                case 'view':
                    showEditSide.value = false;
                    showAddSide.value = false;
                    showDetails.value = true;
                    activeItem.value = data
                    break;

                case 'save':
                    showEditSide.value = false;
                    showAddSide.value = false;
                    showDetails.value = true;
                    savePermissions(data);
                    break;

                case 'edit':
                    showEditSide.value = true;
                    showDetails.value = false;
                    showAddSide.value = false;
                    activeItem.value = data
                    break;

                case 'delete':
                    deleteByKey('id', data, 'NotificationEvent.delete');
                    break;

                case 'close':
                    
                    showEditSide.value = false;
                    showAddSide.value = false;
                    showDetails.value = false;
                    break;
            }
        }

        return {
            showAddSide,
            showEditSide,
            url,
            content,
            activeItem,
            showDetails,
            setActiveStatus,
            closeSide,
            translate,
            handleAction
        };
    },

    props: [
        'path',
        'lang',
        'setting',
        'conf',
        'auth',
    ],
};


</script>
<style lang="css">
    .rtl #side-cart-container
    {
        right: auto;
        left:0;
    }
</style>
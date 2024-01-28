<template>
    <div class="w-full flex overflow-auto" >
        <div  v-if="content && auth" class=" w-full relative">
            
            <subscription_wizard @callback="showWizard = false"
                v-if="showWizard && activeItem.usertype == 'employee'" :usertype="activeItem.usertype"
                :userslist="content.employees" :key="showWizard" :packages="content.packages"
                :system_setting="system_setting" :item="activeItem" :business_setting="business_setting" />

            <subscription_wizard @callback="showWizard = false"
                v-if="showWizard && activeItem.usertype == 'supervisor'" :usertype="activeItem.usertype"
                :userslist="content.supervisors" :key="showWizard" :packages="content.packages"
                :system_setting="system_setting" :item="activeItem" :business_setting="business_setting" />

            <subscription_wizard @callback="showWizard = false"
                v-if="showWizard && activeItem.usertype == 'student'" :usertype="activeItem.usertype"
                :userslist="content.students" :key="showWizard" :packages="content.packages"
                :system_setting="system_setting" :item="activeItem" :business_setting="business_setting" />

            <usertype_picker :alias="translate('Subsribe to package')" :disable_students="true" v-if="!showWizard && showOptions" :key="showOptions" :auth="auth" :item="activeItem" @callback="setType" />

            <div class=" " v-if="!showWizard && !showOptions && content.items && !content.items.length ">
                <div class="card">
                    <div class="card-body">
                        <div class="card-px text-center pt-15 pb-15">
                            <h2 class="fs-2x fw-bold mb-0" v-text="content.title"></h2>
                            <p class="text-gray-400 fs-4 font-semibold py-7" v-text="translate('Add your first pickup using this below wizard')"></p>
                            <a v-text="translate('add_new')" @click="addLocationWizard" href="javascript:;" class="text-white btn btn-primary er fs-6 px-8 py-4" ></a>
                        </div>

                        <div class="text-center pb-15 px-5">
                            <img :src="'/src/asset/img/1.png'" alt="" class="mx-auto mw-100 h-200px h-sm-325px">          
                        </div>
                    </div>
                </div>
            </div>

            <main class=" flex-1 overflow-x-hidden overflow-y-auto  w-full relative" v-if="content.items && content.items.length && !showWizard">
                <div class="px-4 mb-6 py-4 rounded-lg shadow-md bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                    <a href="javascript:;" v-if="!showWizard" class="uppercase p-2 mx-2 text-center text-white w-32 rounded-lg bg-danger" @click="addLocationWizard" v-text="translate('add_new')"></a>
                </div>
                <hr class="mt-2" />
                <div class="w-full bg-white" >

                    <datatabble  class="align-middle fs-6 gy-5 table table-row-dashed px-6" :body-text-direction="translate('lang') == 'ar' ? 'right' : 'left'" fixed-checkbox v-if="content.columns" :headers="content.columns" :items="content.items" >

                        <template #item-name="item">
                            <div class="w-full flex gap-4" v-if="item.model" >
                                <img :src="item.model.picture" class="w-8 h-8 rounded-full" />
                                <span v-text="item.model.name"></span>
                            </div>
                        </template>


                        <template #item-edit="item">
                            <button v-if="!item.not_editable" class="p-2  hover:text-gray-600 text-purple" @click="handleAction('edit', item)">
                                <vue-feather class="w-5" type="edit"></vue-feather>
                            </button>
                        </template>
                        <template #item-delete="item">
                            <button v-if="!item.not_removeable" class="p-2 hover:text-gray-600 text-red-500" @click="handleAction('delete', item)">
                                <delete_icon class="w-5"/>
                            </button>
                        </template>
                    </datatabble>
                </div>
                <!-- END New releases -->
            </main>
        </div>
    </div>
</template>
<script>

import delete_icon from '@/components/svgs/trash.vue';
import route_icon from '@/components/svgs/route.vue';
import car_icon from '@/components/svgs/car.vue';

import 'vue3-easy-data-table/dist/style.css';
import Vue3EasyDataTable from 'vue3-easy-data-table';

import {defineAsyncComponent, ref} from 'vue';
import {translate, handleGetRequest, handleRequest, deleteByKey, showAlert, handleAccess, getPositionAddress, findPlaces, getPlaceDetails} from '@/utils.vue';

const maps = defineAsyncComponent(() =>
  import('@/components/includes/map.vue')
);

const form_field = defineAsyncComponent(() =>
  import('@/components/includes/form_field.vue')
);

import usertype_picker from '@/components/includes/usertype_picker.vue';
import editable_map_location from '@/components/includes/editable_map_location.vue';
import subscription_wizard from '@/components/wizards/subscriptionWizard.vue';
import employee_location_wizard from '@/components/wizards/routeLocationWizard.vue';

export default 
{
    components:{
        'datatabble': Vue3EasyDataTable,
        maps,
        delete_icon,
        car_icon,
        route_icon,
        form_field,
        editable_map_location,
        subscription_wizard, 
        employee_location_wizard, 
        usertype_picker, 
    },
    name:'Routes',
    setup(props) {

        const url =  props.conf.url+props.path+'?load=json';

        const activeItem = ref({});
        const content = ref({});
        const showWizard =  ref(false);
        const showOptions =  ref(false);

        const closeSide = () => {
            showWizard.value = false;
        }


        const load = () => {
            handleGetRequest( url ).then(response=> {
                content.value = JSON.parse(JSON.stringify(response))
            });
        }
        
        load();

        const addLocationWizard = () => 
        {
            activeItem.value = {};
            showOptions.value = true;
        }
        
        const setType = (type) => {
            activeItem.value.usertype = type;
            showOptions.value = false;
            showWizard.value = true;
        }



        /**
         * Handle actions from datatable buttons
         * Called From 'dataTableActions' component
         * 
         * @param String actionName 
         * @param Object data
         */  
         const handleAction =  (actionName, data) =>  {
            switch(actionName) 
            {

                case 'view':
                    break;

                case 'edit':
                    activeItem.value = data;
                    showWizard.value = true
                    break;  

                case 'delete':
                    deleteByKey('location_id', data, 'RouteLocation.delete');
                    break;  

                    
                case 'close':
                    showEditSide.value = false;
                    activeItem.value = {};
                    break;
            }
        }


        return {
            setType,
            url,
            content,
            activeItem,
            translate,
            showWizard,
            showOptions,
            closeSide,
            addLocationWizard,
            handleAction,
        };
    },

    props: [
        'path',
        'lang',
        'system_setting',
        'business_setting',
        'setting',
        'conf',
        'auth',
    ],
    
};
</script>
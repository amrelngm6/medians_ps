<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div class=" w-full">

            <main v-if="content && !showLoader" class=" flex-1 overflow-x-hidden overflow-y-auto  w-full">
                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                    <a href="javascript:;" class="uppercase p-2 mx-2 text-center text-white w-32 rounded-lg menu-dark hover:bg-purple-800" @click="openCreate()">{{translate('add_new')}}</a>
                </div>
                <hr class="mt-2" />
                <div class="w-full ">
                    
                    <datatabble :body-text-direction="translate('lang') == 'ar' ? 'right' : 'left'" fixed-checkbox v-if="content.columns" :headers="content.columns" :items="content.items" >

                        <template #item-picture="item">
                            <img :src="item.picture" class="w-8 h-8 rounded-full" />
                        </template>

                        
                        <template #item-students="item">
                            
                            <div class="w-full h-8 relative flex">
                                <div  v-for="(student, i) in item" >
                                    {{ i }}
                                    <div  :style="'left: '+(20 * i)+'px'" class="rounded-full w-8 h-8 left-0 top-0 absolute" >
                                        <img :key="i" class="rounded-full w-8 h-8 rounded-[50px] border-2 border-purple-800" :src="(student && student.picture) ? student.picture : 'https://via.placeholder.com/37x37'" /> 
                                    </div>
                                </div>
                                <span class="flex absolute pt-2" :style="'left: '+((20 * (item.length < 3 ? item.length : 3) ) + 20)+'px'"> <route_icon /><span class="font-semibold  px-1" v-if="item.pickup_locations" v-text="item.pickup_locations.length"></span></span>
                            </div>
                            
                        </template>


                        <template #item-edit="item">
                            <button v-if="!item.not_editable" class="p-2  hover:text-gray-600 text-purple" @click="handleAction('edit', item)">
                                <vue-feather class="w-5" type="edit"></vue-feather>
                            </button>
                        </template>
                        <template #item-delete="item">
                            <button v-if="!item.not_removeable" class="p-2 hover:text-gray-600 text-red-500" @click="handleAction('delete', item)">
                                <close_icon class="w-4"/>
                            </button>
                        </template>
                    </datatabble>
                </div>
                
                <side_form_create ref="activeFormCreate" @callback="closeSide" :conf="conf" :model="object_name+'.create'" v-if="showAddSide && !showEditSide" :columns="content.fillable"  class="col-md-3" />
            
                <side-form-update ref="activeFormUpdate" @callback="closeSide" :key="activeItem" :conf="conf" :model="object_name+'.update'" v-if="showEditSide && !showAddSide" :item="activeItem" :model_id="activeItem[object_key]" :index="object_key"  :columns="content.fillable"  class="col-md-3" />

            </main>
        </div> 
    </div>
</template>
<script>

import 'vue3-easy-data-table/dist/style.css';
import Vue3EasyDataTable from 'vue3-easy-data-table';
import {defineAsyncComponent, ref} from 'vue';
const SideFormCreate = defineAsyncComponent(() =>
  import('@/components/includes/side-form-create.vue')
);
const SideFormUpdate = defineAsyncComponent(() =>
  import('@/components/includes/side-form-update.vue')
);

import close_icon from '@/components/svgs/trash.vue';
import {translate, handleGetRequest, deleteByKey} from '@/utils.vue';



export default 
{
    components:{
        'datatabble': Vue3EasyDataTable,
        'side_form_create': SideFormCreate,
        SideFormUpdate,
        translate,
        close_icon
    },
    setup(props) {
        
        const showAddSide = ref(false);
        const showEditSide = ref(false);

        const url =  props.conf.url+props.path+'?load=json';

        const content =  ref({
                title: '',
                items: [],
                columns: [],
            });
        
        const activeItem = ref({});

        const showLoader = ref(null);

        function openCreate() 
        {
            showAddSide.value = true; 
            showEditSide.value = false; 
        }

        function load()
        {
            handleGetRequest( url ).then(response=> {
                content.value = JSON.parse(JSON.stringify(response))
            });
        }
        
        load();

        function closeSide (data) 
        {
            showAddSide.value = false;
            showEditSide.value = false;
        }

        /**
         * Handle actions from datatable buttons
         * Called From 'dataTableActions' component
         * 
         * @param String actionName 
         * @param Object data
         */  
        function  handleAction(actionName, data) {
            switch(actionName) 
            {
                case 'edit':
                    console.log(data)
                    activeItem.value = data;
                    showAddSide.value = false; 
                    showEditSide.value = true; 
                    break;  

                case 'delete':
                    deleteByKey(props.object_key, data, props.object_name + '.delete');
                    break;  
            }
        }

        
        return {
            showAddSide,
            showEditSide,
            closeSide,
            openCreate,
            url ,
            content,
            activeItem,
            showLoader,
            translate,
            handleAction
        }
        
    },
    props: [
        'path',
        'lang',
        'setting',
        'conf',
        'auth',
        'object_name',
        'object_key',
    ],
    
};
</script>
<template>
    <div class="w-full " >
        
        <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
            <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
        </div>
        <hr class="mt-2" />
        <div class="w-full">
            
            <datatabble :body-text-direction="translate('lang') == 'ar' ? 'right' : 'left'" fixed-checkbox v-if="content.columns" :headers="content.columns" :items="content.items" >

                <template #item-picture="item">
                    <img :src="item.picture" class="w-8 h-8 rounded-full" />
                </template>


                <template #item-students="item">
                    
                    <div class="w-full h-8 relative flex">
                        <div  v-for="(student, i) in item.students" :style="'left: '+(20 * i)+'px'" class="rounded-full w-8 h-8 left-0 top-0 absolute" >
                            <img v-if="i < 3" :key="i" class="rounded-full w-8 h-8 rounded-[50px] border-2 border-purple-800" :src="(student && student.picture) ? student.picture : 'https://via.placeholder.com/37x37'" /> 
                        </div>
                        <span class="flex absolute pt-2" :style="'left: '+((20 * (item.students.length < 3 ? item.students.length : 3) ) + 20)+'px'"> <route_icon /><span class="font-semibold  px-1" v-if="item.students" v-text="item.students.length"></span></span>
                    </div>
                    
                </template>


                <template #item-edit="item">
                    <button v-if="!item.not_editable" class="p-2  hover:text-gray-600 text-purple" @click="handleAction('edit', item)">
                        <vue-feather class="w-5" type="edit"></vue-feather>
                    </button>
                </template>
                <template #item-delete="item">
                    <button v-if="!item.not_removeable" class="p-2 hover:text-gray-600 text-red-500" @click="handleAction('delete', item)">
                        <vue-feather class="w-5" type="x-circle"></vue-feather>
                    </button>
                </template>
            </datatabble>
        </div>
    </div>
</template>
<script>

import 'vue3-easy-data-table/dist/style.css';
import Vue3EasyDataTable from 'vue3-easy-data-table';
import {ref} from 'vue';
import {translate, handleGetRequest, deleteByKey} from '@/utils.vue';
    
export default
{
    components: {
        'datatabble': Vue3EasyDataTable,
    },
    
    setup(props) {
        
        const showEditSide = ref(false);

        const url =  props.conf.url+props.path+'?load=json';

        const content =  ref({
                title: '',
                items: [],
                columns: [],
            });
        
        const activeItem = ref({});

        const showLoader = ref(null);

        function load()
        {
            handleGetRequest( url ).then(response=> {
                content.value = JSON.parse(JSON.stringify(response))
            });
        }
        
        load();

        function closeSide (data) 
        {
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
                    activeItem.value = data;
                    showEditSide.value = true; 
                    break;  

                case 'delete':
                    deleteByKey(props.object_key, data, props.object_name + '.delete');
                    break;  
            }
        }

        
        return {
            showEditSide,
            closeSide,
            url ,
            content,
            activeItem,
            showLoader,
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
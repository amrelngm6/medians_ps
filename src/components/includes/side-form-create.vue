<template>
    <div class="sidebar-create-form" >
        <div class="p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 ">
            <form action="/api/create" method="POST" data-refresh="1" id="add-device-form" class="action  py-0 m-auto rounded-lg max-w-xl pb-10">
                <div class="w-full flex">
                    <h1 class="w-full m-auto max-w-xl text-base mb-10 " v-text="__('ADD_new')"></h1>
                    <span class="cursor-pointer py-1 px-2" @click="emitClose(model)"><close_icon /></span>
                </div>
                <input name="type" type="hidden" :value="model">
                <input name="params[active]" type="hidden" value="1">
                
                <input v-if="model_id && column && column.column_type == 'hidden'" :name="'params['+column.key+']'" type="hidden" v-model="column.default">
                
                <div class="py-1 w-full" v-for="column in columns" v-if="columns">

                    <input :required="column.required" v-if="isInput(column.column_type)" :name="'params['+column.key+']'"  autocomplete="off" :type="column.column_type" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="column.title">

                    <input v-if="column.column_type == 'password'" autocomplete="off" :name="'params['+column.key+']'" :type="column.column_type" class="h-12 mb-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="column.title">

                    <textarea  :required="column.required"  v-if="column.column_type == 'textarea'" :name="'params['+column.key+']'" rows="4" class="mt-3 rounded-lg w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="column.title"></textarea>

                    <select :name="'params['+column.key+']'" :type="column.column_type" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" v-if="column.data && column.column_type == 'select'"  :placeholder="column.title">
                        <option value="0" v-if="!column.required" v-text="__('-- Choose') +' '+ column.title"></option>
                        <option v-for="option in column.data" :value="option[column.column_key ? column.column_key : column.key]" v-text="option[column.text_key]"></option>
                    </select>

                    <div v-if="column.column_type == 'checkbox' && !showLoader"  class="flex gap gap-2 cursor-pointer" @click="setActiveStatus(column)">
                        <span :for="column.key" class="block" v-text="column.title"></span>
                        <span :class="!column.active ? 'bg-inverse-dark' : ''" class="mx-2 mt-1 bg-red-400 block h-4 relative rounded-full w-8" style="direction: ltr;" ><a class="absolute bg-white block h-4 relative right-0 rounded-full w-4" :style="{left: column.active ? '16px' : 0}"></a></span>
                        <span  v-text="column.active ? __('Active') : __('Pending')" class=" font-semibold inline-flex items-center px-2 py-1 rounded-full text-xs font-medium "></span>
                        <input v-model="column.active"  type="checkbox" class="hidden" :name="'params['+column.key+']'" />
                    </div>
                    
                    <vue-medialibrary-field :key="item" v-if="column.column_type == 'file'" :name="'params['+column.key+']'"  v-model="item.picture" :api_url="conf.url"></vue-medialibrary-field>

                    <vue-medialibrary-field :key="item" v-if="column.column_type == 'profile_image' " :name="'params['+column.key+']'" :filepath="null"  :api_url="conf.url"></vue-medialibrary-field>

                </div>

                <button class="uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800" v-text="__('save')"></button>
            </form>
        </div>
    </div>
</template>
<script>
import close_icon from '@/components/svgs/Close.vue';
import field from '@/components/includes/Field.vue';
import { translate } from '@/utils.vue';


export default 
{
    components: {
        'vue-medialibrary-field': field,
        close_icon
    },
    props: [
        'conf',
        'columns',
        'model',
    ],
    data() {
        return {
            file: '',
            showLoader: false,
        }
    },
    methods: {
        emitClose(model)
        {
            model ? this.$emit('callback', model) : '';
        },

        isInput(val)
        {
            switch (val) 
            {
                case 'text':
                case 'number':
                case 'email':
                case 'time':
                case 'date':
                case 'phone':
                case '':
                    return true;
                    break;
            }
            return false;
        },   
        setActiveStatus(column) {
            column.active = !column.active;
        },
        __(i)
        {
            return translate(i);
        }
     
    }

};
</script>

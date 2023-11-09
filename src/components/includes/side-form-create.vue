<template>
    <div class="sidebar-create-form" >
        <div class="mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 ">
            <form action="/api/create" method="POST" data-refresh="1" id="add-device-form" class="action  py-0 m-auto rounded-lg max-w-xl pb-10">
                <div class="w-full flex">
                    <h1 class="w-full m-auto max-w-xl text-base mb-10 " v-text="$parent.__('ADD_new')"></h1>
                    <span class="cursor-pointer py-1 px-2" @click="$parent.showAddSide = false"><close_icon /></span>
                </div>
                <input name="type" type="hidden" :value="model">
                <input name="params[active]" type="hidden" value="1">
                
                <input v-if="model_id && column && column.column_type == 'hidden'" :name="'params['+column.key+']'" type="hidden" v-model="column.default">
                
                <div class="py-1 w-full" v-for="column in columns" v-if="columns">

                    <input v-if="isInput(column.column_type)" :name="'params['+column.key+']'"  autocomplete="off" :type="column.column_type" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="column.title">

                    <input v-if="column.column_type == 'password'" autocomplete="off" :name="'params['+column.key+']'" :type="column.column_type" class="h-12 mb-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="column.title">

                    <input v-if="column.column_type == 'checkbox'"  type="checkbox" :name="'params['+column.key+']'" v-model="item[column.key]" />

                    <select :name="'params['+column.key+']'" :type="column.column_type" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" v-if="column.data && column.column_type == 'select'"  :placeholder="column.title">
                        <option v-if="!column.required" v-text="$parent.__('-- Choose') +' '+ column.title"></option>
                        <option v-for="option in column.data" :value="option[column.column_key ? column.column_key : column.key]" v-text="option[column.text_key]"></option>
                    </select>

                    <vue-medialibrary-field v-if="column.column_type == 'file'" :name="'params['+column.key+']'" key="upload-file" v-model="file" :api_url="conf.url"></vue-medialibrary-field>

                </div>

                <button class="uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800" v-text="$parent.__('save')"></button>
            </form>
        </div>
    </div>
</template>
<script>

export default 
{
    props: [
        'conf',
        'columns',
        'model',
    ],
    data() {
        return {
            file: ''
        }
    },
    methods: {
        
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
    }

};
</script>

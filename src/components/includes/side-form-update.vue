<template>
    <div class="sidebar-create-form " >
        <div class="mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700" >
            <form action="/api/update" method="POST" data-refresh="1" id="add-device-form" class="action py-0 m-auto rounded-lg max-w-xl pb-10">
                <div class="w-full flex">
                    <h1 class="w-full m-auto max-w-xl text-base mb-10 " v-text="$parent.__('update')"></h1>
                    <span class="cursor-pointer py-1 px-2" @click="$parent.showEditSide = false"><close_icon /></span>
                </div>
                <input name="type" type="hidden" :value="model">
                <input name="params[active]" type="hidden" value="1">
                
                <div class="py-1 w-full" v-for="column in columns" v-if="columns ">
                    
                    <input v-if="model_id && column && column.column_type == 'hidden'" :name="'params['+column.key+']'" type="hidden" v-model="item[column.key]">

                    <div class="w-full" v-if="column && column.fillable" >
                        <span class="block mb-2" v-text="column.title" v-if="column.column_type != 'hidden'"></span>

                        <input v-if="isInput(column.column_type)" :name="'params['+column.key+']'" :type="column.column_type" class="h-12 mb-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="column.title" v-model="item[column.key]">
                    
                        <input v-if="column.column_type == 'password'" autocomplete="false" :name="'params['+column.key+']'" :type="column.column_type" class="h-12 mb-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="column.title">
                        
                        <label v-if="column.column_type == 'checbox'" class="inline-flex items-center mt-3">
                            <input :name="'params['+column.key+']'" type="checkbox" class="form-checkbox h-5 w-5 text-orange-600" v-model="item[column.key]"><span class="ml-2 mx-2 text-gray-700" v-text="__('Checked')"></span>
                        </label>

                        <input :name="'params['+column.key+']'" :type="column.column_type" class="mb-3 rounded border text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" >
                        
                        <select v-if="column.data && column.column_type == 'select'" v-model="item[column.key]" :name="'params['+column.key+']'" :type="column.column_type" class="h-12 mb-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600"   :placeholder="column.title">
                            <option v-if="!column.required" v-text="$parent.__('select') +' '+ column.title"></option>
                            <option v-for="option in column.data" :value="option[ column.column_key ? column.column_key : column.key]" v-text="option[column.text_key]"></option>
                        </select>
                        
                        <vue-medialibrary-field v-if="column.column_type == 'file'" :name="'params['+column.key+']'" key="upload-file" v-model="item.picture" :api_url="conf.url"></vue-medialibrary-field>
                    </div>
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
        'columns',
        'model',
        'model_id',
        'item',
        'index',
        'conf',
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
                case 'number':
                case '':
                    return true;
                    break;
            }
            return false;
        },        
    }
};
</script>

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
                <input v-if="model_id" :name="'params['+index+']'" type="hidden" v-model="model_id">
                
                <div class="py-1 w-full" v-for="column in columns" v-if="columns">
                    <div class="w-full" v-if="column && isInput(column.column_type) && column.fillable" >
                        <span class="block mb-2" v-text="column.title"></span>
                        <input :name="'params['+column.key+']'" :type="column.column_type" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="column.title" v-model="item[column.key]">
                    </div>
                    
                    <div class="w-full" v-if="column && column.data && column.column_type == 'select' ">
                        <span class="block mb-2" v-text="column.title"></span>
                        <select v-model="item[column.key]" :name="'params['+column.key+']'" :type="column.column_type" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" v-if="column.fillable"  :placeholder="column.title">
                            <option v-if="!column.required" v-text="$parent.__('select')"></option>
                            <option v-for="option in column.data" :value="option[column.key]" v-text="option[column.text_key]"></option>
                        </select>
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
    ],


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

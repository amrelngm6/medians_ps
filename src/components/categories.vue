<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div class=" w-full">
            
            <main v-if="content && !showLoader" class=" flex-1 overflow-x-hidden overflow-y-auto  w-full">
                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full">{{content.title}}</h1>
                    <a href="javascript:;" class="uppercase p-2 mx-2 text-center text-white w-32 rounded bg-gradient-purple hover:bg-red-800" @click="showLoader = true, showAddSide = true,showLoader = false; ">{{__('add_new')}}</a>
                </div>
                <hr class="mt-2" />
                <div class="w-full flex gap gap-6">
                    <div class="w-full">
                        <div v-if="content.categories" class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 ">

                            <table class="table dark:text-gray-400 text-gray-800 border-separate space-y-6 text-sm w-full">
                                <thead class="mb-10  text-gray-500 pb-10">
                                    <tr class=" ">
                                        <th class="p-2 text-default w-4 ">#</th>
                                        <th class="p-2 text-default " v-text="__('name')"></th>
                                        <th class="p-2 text-center ">{{__('REL_ITEMS')}}</th>
                                        <th class="p-2 text-center ">{{__('Status')}}</th>
                                        <th class="p-2 text-center ">{{__('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="category in content.categories" class="dark:bg-gray-800 text-center">
                                        <td class="p-2 border-1 border-t  border-gray-200">
                                            <div class="flex ">
                                                <div class="ml-3 text-default">
                                                    <div class="font-medium">{{category.id}}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-2  text-default border-1 border-t  border-gray-200">
                                            {{category.name}}
                                        </td>
                                        <td class="p-2   border-1 border-t  border-gray-200">
                                            {{category.devices_count ? category.devices_count : category.products_count}}
                                        </td>
                                        <td class="p-2 border-1 border-t  border-gray-200">
                                            <span class="bg-red-400 {% if category.status %} bg-green-400 {% endif %}  text-gray-50 rounded-md px-2">{{category.status ? 'on' : 'off'}}</span>
                                        </td>
                                        <td class="p-2 border-1 border-t  border-gray-200">
                                            <a @click="showEditSide = true; showAddSide = false; activeItem = category"  class="text-gray-400 hover:text-gray-100  mx-2">
                                                <i class="material-icons-outlined text-base">edit</i>
                                            </a>
                                             <a v-if="category.devices_count < 1 && category.products_count < 1" data-ajax="true" data-confirm="true" :data-request-id="category.id" data-request-type="Category.delete" data-type="post" :href="conf.url+'api/delete'" class="text-gray-400 hover:text-gray-100  ml-2" :title="__('Remove_this_category')"><i class="material-icons-round text-base">delete_outline</i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else >
                        <!-- {% include 'views/admin/includes/nodata.html.twig' %} -->
                        </div>
                    </div>
                    <div class="col-md-3" v-if="showAddSide">
                        <div class="mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 ">
                            <form action="/api/create" method="POST" data-refresh="1" id="add-device-form" class="action  py-0 m-auto rounded-lg max-w-xl pb-10">
                                <div class="w-full flex">
                                    <h1 class="w-full m-auto max-w-xl text-base mb-10 " v-text="__('ADD_NEW_category')"></h1>
                                    <span class="cursor-pointer py-1 px-2" @click="showAddSide = false"><close_icon /></span>
                                </div>
                                <input name="type" type="hidden" value="Category.create">
                                <input name="params[model]" type="hidden" :value="content.model">
                                <input name="params[status]" type="hidden" value="on">
                                <input name="params[name]" required="" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('name')">
                                <button class="uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800" v-text="__('save')"></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3 mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 " v-if="showEditSide && !showAddSide ">
                        <div class="w-full flex">
                            <h1 class="w-full m-auto max-w-xl text-base mb-10 " v-text="__('edit_category')"></h1>
                            <span class="cursor-pointer py-1 px-2" @click="showEditSide = false"><close_icon /></span>
                        </div>
                        <div >
                            <form action="/api/update" method="POST" data-refresh="1" id="add-device-form" class="action py-0 m-auto rounded-lg max-w-xl pb-10">

                                <input name="type"  type="hidden" value="Category.update" > 
                                <input name="params[id]"  type="hidden" :value="activeItem.id" > 
                                <input name="params[name]" required="" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('Category')" v-model="activeItem.name"> 

                                <label class="inline-flex items-center mt-3">
                                    <input name="params[status]" type="checkbox" class="form-checkbox h-5 w-5 text-orange-600" v-model="activeItem.status"><span class="ml-2 mx-2 text-gray-700">{{__('Status')}}</span>
                                </label>
                                
                                <button class="uppercase h-10 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800">{{__('Update')}}</button>
                            </form>
                        
                            <a data-ajax="true" data-confirm="true" :data-request-id="activeItem.id" data-request-type="Category.delete" data-type="post" :href="conf.url+'api/delete'" class="uppercase block text-center  pb-1 mt-1 text-white w-full rounded text-gray-700 hover:bg-red-800 hover:text-white">{{__('Remove this category')}}</a>

                        </div>
                    </div>
                </div>
                <!-- END New releases -->
            </main>
        </div>
    </div>
</template>
<script>


export default 
{
    name:'categories',
    data() {
        return {
            url: this.conf.url+this.path+'?load=json',
            content: {

                title: '',
                model: '',
                categories: [],
            },

            activeItem:null,
            showAddSide:false,
            showEditSide:false,
            showLoader: false,
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
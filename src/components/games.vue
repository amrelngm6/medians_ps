<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div class=" w-full">

            <main v-if="content && !showLoader" class=" flex-1 overflow-x-hidden overflow-y-auto  w-full">
                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                    <a href="javascript:;" class="uppercase p-2 mx-2 text-center text-white w-32 rounded bg-gradient-purple hover:bg-red-800" @click="showLoader = true, showAddSide = true,showLoader = false; ">{{__('add_new')}}</a>
                </div>
                <hr class="mt-2" />
                <div class="w-full flex gap gap-6">
                    <div class="w-full">
                        <div v-if="content.games" class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 ">

                            <table class="table dark:text-gray-400 text-gray-800 border-separate space-y-6 text-sm w-full">
                                <thead class="mb-10  text-gray-500 pb-10">
                                    <tr class=" ">
                                        <th class="p-2 text-default w-4 ">#</th>
                                        <th class="p-2 text-default " v-text="__('name')"></th>
                                        <th class="p-2 text-center ">{{__('category')}}</th>
                                        <th class="p-2 text-center ">{{__('connected_devices')}}</th>
                                        <th class="p-2 text-center ">{{__('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr  :key="index" v-for="(game, index) in content.games" class="dark:bg-gray-800 text-center">
                                        <td class="p-2 border-1 border-t  border-gray-200">
                                            <div class="flex ">
                                                <div class="ml-3 text-default">
                                                    <div class="font-medium">{{game.id}}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-2  text-default border-1 border-t  border-gray-200">
                                            <div class="w-full flex gap-4">
                                            <img class="w-8 h-8 rounded inline-block " :src="game.picture"> <span class="px-2"> {{game.name}}</span>
                                                
                                            </div>
                                        </td>
                                        <td class="p-2 border-1 border-t  border-gray-200">
                                            {{game.cat.name}}
                                        </td>
                                        <td class="p-2 border-1 border-t  border-gray-200">
                                            {{game.devices_count}}
                                        </td>
                                        <td class="p-2 border-1 border-t  border-gray-200">
                                            <a @click="activeItem = null;showEditSide = true; showAddSide = false; activeItem = game;  " class="text-gray-400 hover:text-gray-100  mx-2" href="javascript:;">
                                                <i class="material-icons-outlined text-base">edit</i>
                                            </a>
                                            <a v-if="game.devices_count < 1" data-ajax="true" data-confirm="true" :data-request-id="game.id" data-request-type="Game.delete" data-type="post" :href="conf.url+'api/delete'" class="text-gray-400 hover:text-gray-100  ml-2" :title="__('Remove_this_game')"><i class="material-icons-round text-base">delete_outline</i></a>
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
                                    <h1 class="w-full m-auto max-w-xl text-base mb-10 ">{{__('ADD_NEW_game')}}</h1>
                                    <span class="cursor-pointer py-1 px-2" @click="showAddSide = false"><close_icon /></span>
                                </div>
                                <input name="type" type="hidden" value="Game.create">
                                <input name="params[status]" type="hidden" value="1">
                                <span class="block mb-2" v-text="__('name')"></span>
                                <input name="params[name]" required="" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('name')">
                                <label class="block mt-3">
                                    <span class="block mb-2" v-text="__('category')"></span>
                                    <select name="params[category]" class="form-checkbox p-2 px-3 w-full text-orange-600 border border-1 border-gray-400 rounded-lg">
                                        <option  :key="index" v-for="(type, index) in content.typesList" :value="type.id" v-text="type.name"></option>
                                    </select>
                                </label>
                                <button class="uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800" v-text="__('save')"></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3 mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 " v-if="showEditSide && !showAddSide ">


                        <div class="w-full flex">
                            <h1 class="w-full m-auto max-w-xl text-base mb-10 " v-text="__('edit_game')"></h1>
                            <span class="cursor-pointer py-1 px-2" @click="showEditSide = false"><close_icon /></span>
                        </div>
                        <div >
                            <form action="/api/update" method="POST" data-refresh="1" id="add-device-form" class="action py-0 m-auto rounded-lg max-w-xl pb-10">

                                <input name="type" type="hidden" value="Game.update">
                                <input name="params[id]" type="hidden" v-model="activeItem.id">
                                <span class="block mb-2" v-text="__('name')"></span>

                                <input name="params[name]" required="" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('game')" v-model="activeItem.name">
                                <span class="block my-2" v-text="__('picture')"></span>
                            
                                <vue-medialibrary-field name="params[picture]" :key="activeItem.id" :api_url="conf.url" v-model="activeItem.picture"></vue-medialibrary-field>

                                <label class="block mt-3">
                                    <span class="block mb-2" v-text="__('category')"></span>
                                    <select v-model="activeItem.category" name="params[category]" class="form-checkbox p-2 px-3 w-full text-red-600 border border-1 border-gray-400 rounded-lg">
                                        <option  :key="index" v-for="(type, index) in content.typesList" :value="type.id" v-text="type.name"></option>
                                    </select>
                                </label>
                                
                                <button class="uppercase h-10 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800">{{__('Update')}}</button>
                            </form>
                        
                            <a @click="$parent.delete(activeItem, 'Games.delete')" class="uppercase block text-center  pb-1 mt-1 text-white w-full rounded text-gray-700 hover:bg-red-800 hover:text-white">{{__('Remove_this_game')}}</a>

                        </div>
                    </div>
                </div>
                <!-- END New releases -->
            </main>
        </div>
    </div>
</template>
<script>
import vue_medialibrary_field from './Field.vue';

export default 
{
    components: {
        vue_medialibrary_field
    },
    name:'games',
    data() {
        return {
            url: this.conf.url+'games?load=json',
            content: {

                title: '',
                games: [],
                typesList: [],
            },

            activeItem:null,
            showAddSide:false,
            showEditSide:false,
            showLoader: false,
        }
    },
    props: [
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
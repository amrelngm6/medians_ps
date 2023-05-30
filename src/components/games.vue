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
                        <div v-if="content.games" class="grid lg:grid-cols-2 mb-6 py-4 gap gap-6 ">

                            <div  :key="index" v-for="(game, index) in content.games" class="text-default gap gap-6 bg-white rounded-lg shadow-lg p-4 lg:flex md:flex flex-col md:flex-row my-2">
                                <div class="md:w-1/2 lg:w-1/2 w-full">
                                    <img width="200" height="200" :src="game.picture" :alt="game.title" class="w-full h-48 w-48 object-cover rounded-lg">
                                </div>
                                <div class="md:w-1/2 lg:w-1/2 w-full  text-default mt-4 md:mt-0">
                                    <h2 class="text-xl pt-2 mt-4 font-bold mb-2 w-full " v-text="game.name"></h2>
                                    <p class="text-gray-700 mb-2" v-text="game.cat ? game.cat.name : ''"></p>
                                    <p class="text-gray-700 mb-2"><span v-text="__('connected_devices')"></span>: <b class="font-bold" v-text="game.devices_count"></b></p>
                                    <div class="flex ">
                                        <button @click="activeItem = null;showEditSide = true; showAddSide = false; activeItem = game;  "  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" v-text="__('edit')"></button>
                                    </div>
                                </div>
                            </div>

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


                                <span class="block my-2" v-text="__('picture')"></span>
                                <vue-medialibrary-field name="params[picture]" :api_url="conf.url" v-model="picture"></vue-medialibrary-field>

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
                            
                                <label class="block mt-3">
                                    <span class="block mb-2" v-text="__('category')"></span>
                                    <select v-model="activeItem.category" name="params[category]" class="form-checkbox p-2 px-3 w-full text-red-600 border border-1 border-gray-400 rounded-lg">
                                        <option  :key="index" v-for="(type, index) in content.typesList" :value="type.id" v-text="type.name"></option>
                                    </select>
                                </label>
                                
                                <span class="block my-2" v-text="__('picture')"></span>
                                <vue-medialibrary-field name="params[picture]" :key="activeItem.id" :api_url="conf.url" v-model="activeItem.picture"></vue-medialibrary-field>

                                <button class="uppercase py-2 h-10 mt-4 text-white w-full rounded bg-red-700 hover:bg-red-800">{{__('Update')}}</button>
                            </form>
                        
                            <a @click="$parent.delete(activeItem, 'Game.delete')" class="cursor-pointer uppercase block text-center   text-white w-full rounded text-gray-700 hover:bg-red-800 hover:text-white py-2 mt-2">{{__('Remove_this_game')}}</a>

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
    name:'games',
    data() {
        return {
            url: this.conf.url+this.path+'games?load=json',
            content: {

                title: '',
                games: [],
                typesList: [],
            },

            activeItem:{},
            picture:null,
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
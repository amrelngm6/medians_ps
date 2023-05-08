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

                    <div class="row " @click="showDropdown = false">

                        <div :key="index" v-for="(device, index) in content.devicesList" class="col-6 col-sm-4 col-lg-2"  :class="{'opacity-5': device.status != 1 }">
                            <div class="album  transform transition duration-400 hover:scale-105 cursor-pointer">
                                <div :class="device.playing ? 'active' : ''" class="album__cover ">
                                    <img :src="conf.url+'assets/img/ps.png'" alt="">
                                        <!-- <a > -->
                                    <a @click="showEditSide = true; showAddSide = false; activeItem = device">
                                        <i class="text-gray-200 material-icons-outlined text-base">edit</i>
                                    </a>
                                </div>
                                <div class="album__title">
                                    <h4><a @click="showEditSide = true; showAddSide = false; activeItem = device" class="text-sm text-red-600 font-bold">{{device.title}}</a></h4>
                                    <span v-text="device.playing_time"></span>
                                    <span v-text="device.category ? device.category.name :''"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3" v-if="showAddSide">
                        <div class="mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 ">
                            <form action="/api/create" method="POST" data-refresh="1" id="add-device-form" class="action  py-0 m-auto rounded-lg max-w-xl pb-10">
                                <div class="w-full flex">
                                    <h1 class="w-full m-auto max-w-xl text-base mb-10 ">{{__('ADD_device')}}</h1>
                                    <span class="cursor-pointer py-1 px-2" @click="showAddSide = false"><close_icon /></span>
                                </div>
                                <input name="type" type="hidden" value="Device.create">
                                <input name="params[status]" type="hidden" value="1">
                                <span class="block mb-2" v-text="__('name')"></span>
                                <input name="params[title]" required="" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('name')">
                                <label class="block my-3">
                                    <span class="block mb-2" v-text="__('category')"></span>
                                    <select name="params[type]" class="form-checkbox p-2 px-3 w-full text-orange-600 border border-1 border-gray-400 rounded-lg">
                                        <option v-for="type in content.typesList" :value="type.id" v-text="type.name"></option>
                                    </select>
                                </label>

                                <div class="w-full flex gap gap-4">
                                    <div class="w-full">
                                        <label class="block pt-5">{{__('Single_price')}}</label>
                                        <input name="params[prices][single_price]" type="number" class="h-12 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" placeholder="Single price" >
                                    </div>
                                    <div class="w-full">
                                        <label class="block pt-5">{{__('Multi_price')}}</label>
                                        <input name="params[prices][multi_price]" type="number" class="h-12 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" placeholder="Multi price" >
                                    </div>
                                </div>


                                <button class="uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800" v-text="__('save')"></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3 mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 " v-if="showEditSide && !showAddSide ">


                        <div class="w-full flex">
                            <h1 class="w-full m-auto max-w-xl text-base mb-10 " v-text="__('edit_device')"></h1>
                            <span class="cursor-pointer py-1 px-2" @click="showEditSide = false"><close_icon /></span>
                        </div>
                        <div >
                            <form action="/api/update" method="POST" data-refresh="1" id="add-device-form" class="action py-0 m-auto rounded-lg max-w-xl pb-10">

                                <input name="type" type="hidden" value="Device.update">
                                <input name="params[id]" type="hidden" v-model="activeItem.id">
                                <input name="params[picture]" type="hidden" v-model="activeItem.file ? activeItem.file : activeItem.photo">
                                <span class="block mb-2" v-text="__('Name')"></span>
                                <input  name="params[title]" required="" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" placeholder="Device Title" v-model="activeItem.title"> 

                                <label class="block my-3" >
                                    <span class="block mb-2" v-text="">{{__('Category')}}</span>
                                    <select v-model="activeItem.type" name="params[type]" class="form-checkbox p-1 px-3 w-full text-orange-600 border border-1 border-gray-400 rounded-lg">
                                        <option v-for="type in content.typesList" :value="type.id" v-text="type.name"></option>
                                    </select>
                                </label>

                                <div class="block my-3 relative" v-if="showGames">

                                    <input type="checkbox" class="hidden" :name="'params[selected_games][]'" :key="activeItem.games" v-for="(game, index) in activeItem.games" v-if="game" checked :value="game.id" >

                                    <span class="block mb-2" v-text="">{{__('Games')}}</span>

                                    <div class="form-control cursor-pointer  py-3 px-2 w-full lg:w-64 box border rounded-lg h-auto" @click="openDropdown">
                                        <span class="w-auto inline-block" style="display: inline-block;" v-for="(game, index) in activeItem.games">
                                            <span v-if="game" class="m-1 bg-gradient-purple text-gray-100 rounded-lg w-auto h-8 py-1 flex gap gap-2 text-xs mx-1" @click="unelectGame(index)" >
                                                <img :src="conf.url+game.picture" class="w-6 h-6 mx-1  rounded rounded-full" />
                                                <span class="p-1" v-text="game.name"></span>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="w-full absolute bg-white h-48 overflow-y-auto rounded-lg bg-white" v-if="showDropdown">
                                        <ul v-if="content.games && content.games.length > 0" class=" p-2 h-40 overflow-auto">
                                            <li class="" :key="index" v-for="(game, index) in content.games" >
                                                <span v-if="game" class="w-full block p-2 text-base hover:bg-blue-100 ">
                                                    <span class="cursor-pointer block w-full" v-if="!activeItem.games || !activeItem.games[index]" @click="selectGame(index)" v-text="game.name"></span>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="w-full flex gap gap-4 my-3" >
                                    <div class="w-full">
                                        <label class="block pt-5">{{__('Single_price')}}</label>
                                        <input name="params[prices][single_price]" type="number" class="h-12 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" placeholder="Single price" v-model="activeItem.price.single_price">
                                    </div>
                                    <div class="w-full">
                                        <label class="block pt-5">{{__('Multi_price')}}</label>
                                        <input name="params[prices][multi_price]" type="number" class="h-12 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" placeholder="Multi price" v-model="activeItem.price.multi_price">
                                    </div>
                                </div>

                                <label class="flex gap gap-2 items-center mt-3">
                                    <input name="params[status]" type="checkbox" class="form-checkbox h-5 w-5 text-orange-600" v-model="activeItem.status" >
                                    <span class="ml-2 mx-2 text-gray-700">{{__('Status')}}</span>
                                </label>
                                
                                <button class="uppercase h-10 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800">{{__('Update')}}</button>
                            </form>

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
    components: {
    },
    name:'devices/manage',
    data() {
        return {
            url: this.conf.url+'devices/manage?load=json',
            content: {

                title: '',
                devicesList: [],
                games: [],
                typesList: [],
            },
            selectGames:[],
            activeItem:{games:[]},
            showAddSide:false,
            showEditSide:false,
            showLoader: false,
            showGames: true,
            showDropdown: false,
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
        selectGame(index)
        {

            this.showGames = false
            this.activeItem.games[index] = this.content.games[index]
            this.showDropdown = false
            this.showGames = true
            console.log(this.activeItem.games)

        },
        openDropdown()
        {
            this.showDropdown = true
        },
        unelectGame(index)
        {
            this.showLoader = true
            if (this.activeItem.games)
            {
                this.activeItem.games[index] = null; 
            } 
            this.showLoader = false
            console.log(this.activeItem.games)
        },
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
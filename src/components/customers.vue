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
                        <div v-if="content.users" class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 ">
                            <table class="table dark:text-gray-400 text-gray-800 border-separate space-y-6 text-sm w-full">
                                <thead class="dark:bg-gray-800 bg-white text-gray-500">
                                    <tr>
                                        <th class="p-2 text-default px-4">{{__('Name')}}</th>
                                        <th class="p-2 text-center">{{__('phone')}}</th>
                                        <th class="p-2 text-center">{{__('email')}}</th>
                                        <th class="p-2 text-center">{{__('Status')}}</th>
                                        <th class="p-2 text-center">{{__('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(user, index) in content.users" class="dark:bg-gray-800 text-center">
                                        <td class="p-2 text-default">
                                            <div class="font-medium">{{user.first_name}} {{user.last_name}}</div>
                                        </td>
                                        <td class="p-2 font-bold ">
                                            {{user.phone}}
                                        </td>
                                        <td class="p-2 font-bold ">
                                            {{ user.email }}
                                        </td>
                                        <td class="p-2">
                                            <span :class="user.active ? 'bg-green-400' : 'bg-red-400'" class="text-gray-50 rounded-md px-2" v-text="user.active ? 'on' : 'off'"></span>
                                        </td>
                                        <td class="p-2 ">
                                            <a v-if="user.id == auth.id || auth.role_id == 1" @click="showEditSide = true; showAddSide = false; activeItem = user" href="javascript:;" class="text-gray-400 hover:text-gray-100  mx-2">
                                                <i class="material-icons-outlined text-base">edit</i>
                                            </a>
                                            <!-- <a href="javascript:;"  @click="$parent.delete(user, 'Users.delete')"   class="text-gray-400 hover:text-gray-100  mx-2">
                                                <i class="material-icons-outlined text-base">delete</i>
                                            </a> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3" v-if="showAddSide">
                        <div class="mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 ">
                            <form action="/api/create" method="POST" data-refresh="1" id="add-device-form" class="action  py-0 m-auto rounded-lg max-w-xl pb-10">
                                <div class="w-full flex">
                                    <h1 class="w-full m-auto max-w-xl text-base mb-10 ">{{__('ADD_new')}}</h1>
                                    <span class="cursor-pointer py-1 px-2" @click="showAddSide = false"><close_icon /></span>
                                </div>
                                <input name="type" type="hidden" value="Users.create">
                                <input name="params[active]" type="hidden" value="1">
                                
                                <span class="block mb-2" v-text="__('first_name')"></span>
                                <input name="params[first_name]" required="true" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('first_name')" v-model="activeItem.first_name">

                                <span class="block mb-2 mt-3" v-text="__('last_name')"></span>
                                <input name="params[last_name]" required="true" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('last_name')" v-model="activeItem.last_name">

                                <span class="block mb-2 mt-3" v-text="__('email')"></span>
                                <input name="params[email]" required="true" type="email" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('email')" v-model="activeItem.email">

                                <span class="block mb-2 mt-3" v-text="__('mobile')"></span>
                                <input name="params[phone]" required="true" type="number" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('mobile')" v-model="activeItem.phone">

                                <button class="uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800" v-text="__('save')"></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3 mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 " v-if="showEditSide && !showAddSide ">

                        <div class="w-full flex">
                            <h1 class="w-full m-auto max-w-xl text-base mb-10 " v-text="__('update')"></h1>
                            <span class="cursor-pointer py-1 px-2" @click="showEditSide = false"><close_icon /></span>
                        </div>
                        <div >
                            <form action="/api/update" method="POST" data-refresh="1" id="add-device-form" class="action py-0 m-auto rounded-lg max-w-xl pb-10">

                                <input name="type" type="hidden" value="Users.update">
                                <input name="params[id]" type="hidden" v-model="activeItem.id">

                                <span class="block mb-2" v-text="__('first_name')"></span>
                                <input name="params[first_name]" required="true" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('first_name')" v-model="activeItem.first_name">

                                <span class="block mb-2 mt-3" v-text="__('last_name')"></span>
                                <input name="params[last_name]" required="true" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('last_name')" v-model="activeItem.last_name">

                                <span class="block mb-2 mt-3" v-text="__('email')"></span>
                                <input name="params[email]" required="true" type="email" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('email')" v-model="activeItem.email">

                                <span class="block mb-2 mt-3" v-text="__('mobile')"></span>
                                <input name="params[phone]" required="true" type="number" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('mobile')" v-model="activeItem.phone">

                                <label class="inline-flex items-center mt-3">
                                    <input name="params[active]" type="checkbox"  v-model="activeItem.active" class="form-checkbox h-5 w-5 text-orange-600">
                                    <span class="ml-2 text-gray-700  mx-2" >{{__('PUBLISH')}}</span>
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
    name:'Users',
    data() {
        return {
            url: this.conf.url+'users?load=json',
            content: {

                title: this.__('users'),
                users: [],
                typesList: [],
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
<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div class=" w-full">
            <main v-if="content && !showLoader" class=" flex-1 overflow-x-hidden overflow-y-auto  w-full">
                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                    <a href="javascript:;" class="menu-dark uppercase p-2 mx-2 text-center text-white w-32 rounded bg-gradient-purple hover:bg-red-800" @click="showLoader = true, showAddSide = true,showLoader = false, activeItem = {}; ">{{__('add_new')}}</a>
                </div>
                <hr class="mt-2" />
                <div class="w-full flex gap gap-6">

                    <div v-if="content.users" class="w-full">
                        <div v-for="role in content.roles" class="w-full pb-4">
                            <h3  class="pb-b flex gap-4"><span v-text="role.name"></span> <span class="pt-2 text-sm text-muted" v-text="role.id > 1 ? __('Theese users can manage your account only') : ''"></span></h3>
                            <hr />
                            <div class="w-full grid lg:grid-cols-3 gap gap-6">
                                <div v-if="user && user.role_id == role.id" :key="user" v-for="user in content.users" class="mb-2 rounded-lg flex items-center space-x-4 gap gap-4  bg-white p-4 ">
                                    <div class="flex-shrink-0 ">
                                        <div class="relative">
                                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                            <img class="relative w-12 h-12 rounded-full" :src="user.photo" alt="User avatar">
                                        </div>
                                    </div>
                                    <div class="flex-grow w-full">
                                        <div class="text-lg font-medium text-gray-900">{{user.first_name}} {{user.last_name}}</div>
                                        <div class="text-sm font-medium text-gray-500" v-text="user.phone"></div>
                                        <div class="text-sm font-medium text-gray-500" v-text="user.email"></div>
                                    </div>
                                    <div class="text-center">
                                        <span  v-text="user.active ? __('Active') : __('Pending')" class="hover:bg-purple-800 hover:text-gray-100 inline-flex items-center px-6 py-1 rounded-full text-xs font-medium "></span>
                                        <span  v-text="__('edit')" class="hover:bg-purple-800 hover:text-gray-100 my-2 inline-flex items-center px-6  py-1 rounded-full text-xs pb-2 font-medium bg-blue-100 text-blue-800 cursor-pointer" v-if="user.id == auth.id || auth.role_id == 1" @click="showEditSide = true; showAddSide = false; activeItem = user">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <side-form-create :conf="conf" model="User.create" v-if="showAddSide && content && content.fillable" :columns="content.fillable"  class="col-md-3" />

                    <side-form-update :conf="conf" model="User.update" :item="activeItem" :model_id="activeItem.id" index="id" v-if="showEditSide && !showAddSide " :columns="content.fillable"  class="col-md-3" />

                </div>
                <!-- END New releases -->
            </main>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Users',
    data() {
        return {
            url: this.conf.url +this.path+ '?load=json',
            content: {

                title: this.__('users'),
                roles: [],
                users: [],
            },

            activeItem: null,
            showAddSide: false,
            showEditSide: false,
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
    mounted() {
        this.load()
    },

    methods: {

        /**
         * Check if the user is Master
         */
        isMaster()
        {
            return (this.auth && this.auth.role_id == 1);
        } , 

        load() {
            this.showLoader = true;
            this.$parent.handleGetRequest(this.url).then(response => {
                this.setValues(response)
                this.showLoader = false;
                // this.$alert(response)
            });
        },

        setValues(data) {
            this.content = JSON.parse(JSON.stringify(data));
            return this
        },
        __(i) {
            return this.$root.$children[0].__(i);
        }
    }
};
</script>
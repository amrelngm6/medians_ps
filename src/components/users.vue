<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div class=" w-full">
            <main v-if="content" class=" flex-1 overflow-x-hidden overflow-y-auto  w-full">
                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                    <a href="javascript:;" class="menu-dark uppercase p-2 mx-2 text-center text-white w-32 rounded bg-gradient-purple hover:bg-red-800" @click="showAddSide = true, activeItem = {}; ">{{translate('add_new')}}</a>
                </div>
                <hr class="mt-2" />
                <div class="w-full flex gap gap-6">

                    <div v-if="content && content.users" :key="content.users" class="w-full">
                        <div v-for="role in content.roles" class="w-full pb-4">
                            <h3  class="pb-b flex gap-4"><span v-text="role.name"></span> <span class="pt-2 text-sm text-muted" v-text="role.id > 1 ? translate('Theese users can manage your account only') : ''"></span></h3>
                            <hr />
                            <div class="w-full grid lg:grid-cols-3 gap gap-6">
                                <div v-if="sameRole(user, role)" v-for="user in content.users" class="mb-2 rounded-lg flex items-center space-x-4 gap gap-4  bg-white p-4 ">
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
                                        <div class="flex gap gap-2 cursor-pointer" @click="setActiveStatus(user)">
                                            <span :class="!user.active ? 'bg-inverse-dark' : ''" class="mt-1 bg-red-400 block h-4 relative rounded-full w-8" style="direction: ltr;" ><a class="absolute bg-white block h-4 relative right-0 rounded-full w-4" :style="{left: user.active ? '16px' : 0}"></a></span>
                                            <span  v-text="user.active ? translate('Active') : translate('Pending')" class=" font-semibold inline-flex items-center px-2 py-1 rounded-full text-xs font-medium "></span>
                                        </div>

                                        <span  v-text="translate('edit')" class="hover:bg-purple-800 hover:text-gray-100 my-2 inline-flex items-center px-6  py-1 rounded-full text-xs pb-2 font-medium bg-blue-100 text-blue-800 cursor-pointer" v-if="user.id == auth.id || auth.role_id == 1" @click="showEditSide = true; showAddSide = false; activeItem = user"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <side-form-create @callback="closeSide" :conf="conf" model="User.create" v-if="showAddSide && content && content.fillable" :columns="content.fillable"  class="col-md-3" />

                    <side-form-update @callback="closeSide" :conf="conf" model="User.update" :item="activeItem" :model_id="activeItem.id" index="id" v-if="showEditSide && !showAddSide " :columns="content.fillable"  class="col-md-3" />

                </div>
                <!-- END New releases -->
            </main>
        </div>
    </div>
</template>
<script>
import {defineAsyncComponent, ref} from 'vue';
import {translate, handleGetRequest, handleRequest, deleteByKey, showAlert} from '@/utils.vue';

const SideFormCreate = defineAsyncComponent(() =>
  import('@/components/includes/side-form-create.vue')
);

const SideFormUpdate = defineAsyncComponent(() =>
  import('@/components/includes/side-form-update.vue')
);


export default {
    
    components: {
        SideFormCreate,
        SideFormUpdate,
    },  
    name: 'Users',
    setup(props) {

        const url =  props.conf.url+props.path+'?load=json';

        const showAddSide = ref(false);
        const showEditSide = ref(false);
        const activeItem = ref({});
        const content =  ref({});

        const load = () => {
            handleGetRequest( url ).then(response=> {
                content.value = JSON.parse(JSON.stringify(response))
            });
        }
        
        load();
        
        const closeSide = () => {
            showAddSide.value = false;
            showEditSide.value = false;
        }

        const setActiveStatus = (user) => {
            user.active = !user.active;
            var params = new URLSearchParams();
            params.append('type', 'User.updateStatus')
            params.append('params', JSON.stringify(user))
            handleRequest(params, '/api/update').then(response => {
                showAlert(response.result);
            })
        }
        
        const sameRole = (user, role) => 
        {
            console.log(user)
            console.log(role)
            if (user.role_id == role.role_id)
            {
                return true 
            } 
            return false;
        }
        
        return {
            url,
            showAddSide,
            showEditSide,
            content,
            activeItem,
            setActiveStatus,
            closeSide,
            sameRole,
            translate,
        };
    },

    props: [
        'path',
        'lang',
        'setting',
        'conf',
        'auth',
    ]
};
</script>
<template>
    <div class=" w-full pb-20">

        <driver_profile v-if="activeItem.driver_id" :key="activeItem" @edit="handleAction" @close="handleAction" :conf="conf" :item="activeItem" ></driver_profile>

        <main v-if="content && !showProfilePage" class="px-4 flex-1 overflow-x-hidden overflow-y-auto  w-full  mb-20">
            <!-- New releases -->
            <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                <a href="javascript:;" class="uppercase p-2 mx-2 text-center text-white w-32 rounded-lg menu-dark hover:bg-purple-800" @click="showAddSide = true,activeItem = {}" v-text="translate('add_new')"></a>
            </div>

            <div class="relative card ribbon-box border shadow-none mb-lg-0" >
                <div class="card-body">
                    <div class="ribbon ribbon-primary round-shape" v-text="translate('Important')"></div>
                    <h5 class="fs-14 text-end ml-20" v-text="translate('Before Create Account')"></h5>
                    <div class="ribbon-content mt-4 text-muted">
                        <div class="mb-0" v-html="translate('Before Create driver note')"></div>
                    </div>
                </div>
            </div>

            <div class="sm:grid sm:space-y-0 space-y-6 xl:!grid-cols-3 md:grid-cols-2 gap-6" >

                <div class="box mb-0 overflow-hidden p-4 bg-white rounded-xl" v-for="driver in content.items">
                    <div class="box-body space-y-5">
                        <div class="flex">
                            <div class="w-full flex space-x-3 space-y-0 space-y-4 rtl:space-x-reverse"><img
                                    class="avatar avatar-lg rounded-sm" :src="driver.picture" alt="Image Description">
                                <div class="w-full space-y-1 my-auto">
                                    <h5 @click="handleAction('view', driver)" class="cursor-pointer font-semibold text-base leading-none" v-text="driver.name"></h5>
                                    <p class="text-gray-500 dark:text-white/70 font-semibold text-xs truncate max-w-[9rem]"
                                        v-text="driver.email"></p>
                                    <p class="text-primary dark:text-primary text-xs font-semibold"
                                        v-text="driver.contact_number"></p>
                                </div>
                                <div class="flex gap gap-2 cursor-pointer" @click="setActiveStatus(driver)">
                                    <span :class="driver.status ? '': 'bg-inverse-dark' " class="w- mt-1 bg-red-400 block h-4 relative rounded-full w-8" style="direction: ltr;" ><a class="absolute bg-white block h-4 relative right-0 rounded-full w-4" :style="{left: driver.status ? '16px' : 0}"></a></span>
                                    <span  v-text="driver.status ? translate('Active') : translate('Pending')" class=" font-semibold  px-2 py-1 rounded-full text-xs font-medium "></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer mt-6">
                        <div class="grid grid-cols-12 gap-x-3">
                            <div class="sm:col-span-2 col-span-4 "><span @click="handleAction('view', driver)"
                                    class="cursor-pointer inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 rounded-sm border font-medium bg-white text-gray-500 shadow-sm align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10"><i
                                        class="fa fa-eye  py-1  px-2"></i></span></div>
                            <div @click="handleAction('edit', driver)" class="sm:col-span-8 col-span-4"><span
                                    class="cursor-pointer inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 w-full rounded-sm border font-medium bg-white text-gray-500 shadow-sm align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10"><i
                                        class="fa fa-edit py-1"></i> <span class="text-base  "
                                        v-text="translate('Edit')"></span></span></div>
                            <div class="sm:col-span-2 col-span-4">
                                <div class="hs-dropdown ti-dropdown flex justify-end"><span
                                        @click="handleAction('delete', driver)" class="cursor-pointer hs-dropdown-toggle ti-dropdown-toggle inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 rounded-sm border font-medium bg-white text-red-500 hover:text-red-400 shadow-sm align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10">

                                        <delete_icon class="w-4" />
                                    </span>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            
        </main>

        <side-form-update :conf="conf" model="Driver.update" :item="activeItem" :model_id="activeItem.driver_id"
            :index="activeItem.driver_id" v-if="showEditSide && !showAddSide" :columns="content.fillable"
            class="col-md-3" @callback="closeSide" />

        <side-form-create  @callback="closeSide" :conf="conf" model="Driver.create" v-if="showAddSide && content && content.fillable" :columns="content.fillable"  class="col-md-3" />
    </div>
</template>
<script>
import {defineAsyncComponent, ref} from 'vue';
import {translate, handleGetRequest, handleRequest, deleteByKey, showAlert} from '@/utils.vue';
import delete_icon from '@/components/svgs/delete_icon.vue';

const SideFormCreate = defineAsyncComponent(() =>
  import('@/components/includes/side-form-create.vue')
);

const SideFormUpdate = defineAsyncComponent(() =>
  import('@/components/includes/side-form-update.vue')
);

const DriverProfile = defineAsyncComponent(() =>
  import('@/components/driver_profile.vue')
);

export default
{
    components: {
        SideFormCreate,
        SideFormUpdate,
        delete_icon,
        'driver_profile': DriverProfile
    },  
    setup(props) {

        const url =  props.conf.url+props.path+'?load=json';
        
        const showAddSide = ref(false);
        const showEditSide = ref(false);
        const showProfilePage = ref(null);
        const activeItem = ref({});

        const content =  ref({
            title: '',
            items: [],
            columns: [],
            fillable: [],
        });

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

        
        const setActiveStatus = (driver) => {
            driver.status = !driver.status;
            var params = new URLSearchParams();
            params.append('type', 'Driver.update')
            params.append('params[driver_id]', driver.driver_id)
            params.append('params[status]', driver.status)
            handleRequest(params, '/api/update').then(response => {
                showAlert(response.result);
            })
        }


        /**
         * Handle actions from datatable buttons
         * Called From 'dataTableActions' component
         * 
         * @param String actionName 
         * @param Object data
         */  
        const handleAction =  (actionName, data) =>  {
            console.log(actionName);
            switch(actionName) 
            {

                case 'view':
                    activeItem.value = JSON.parse(JSON.stringify(data));
                    showProfilePage.value = true;
                    break;

                case 'edit':
                    activeItem.value = data;
                    showAddSide.value = false; 
                    showEditSide.value = true; 
                    showProfilePage.value = true;
                    break;  

                case 'delete':
                    deleteByKey('driver_id', data, 'Driver.delete');
                    break;  

                    
                case 'close':
                    
                    showEditSide.value = false;
                    showAddSide.value = false;
                    showProfilePage.value = false;
                    activeItem.value = {};
                    break;
            }
        }

        return {
            showAddSide,
            showEditSide,
            url,
            content,
            activeItem,
            showProfilePage,
            setActiveStatus,
            closeSide,
            translate,
            handleAction
        };
    },

    props: [
        'path',
        'lang',
        'setting',
        'conf',
        'auth',
    ],
};
</script>
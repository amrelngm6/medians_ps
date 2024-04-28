<template>
    <div class=" w-full pb-20">

        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-12 p-6">
                <vue-feather type="alert-octagon" class="ki-duotone ki-information fs-2tx text-warning me-4"></vue-feather>        
                <div class="d-flex flex-stack flex-grow-1 ">
                    <div class=" fw-semibold">
                        <h4 class="text-gray-900 fw-bold" v-text="translate('Important')"></h4>
                        <div class="fs-6 text-gray-700 "  >
                            <div v-html="translate('Before Create driver note')"></div>
                        </div>
                    </div>
                </div>
            </div>

        <div class=" " v-if="!showWizard && !showOptions && content.items && !content.items.length">
                <div class="card">
                    <div class="card-body">
                        <div class="card-px text-center pt-15 pb-15">
                            <h2 class="fs-2x fw-bold mb-0" v-text="content.title"></h2>
                            <p class="text-gray-400 fs-4 font-semibold py-7"
                                v-text="translate('Add your first driver using this below wizard')"></p>
                            <a v-text="translate('add_new')" @click="showOptions = true, activeItem = {}"
                                href="javascript:;" class="text-white btn btn-primary er fs-6 px-8 py-4"></a>
                        </div>

                        <div class="text-center pb-15 px-5">
                            <img :src="'/src/assets/img/1.png'" alt="" class="mx-auto mw-100 h-200px h-sm-325px">
                        </div>
                    </div>
                </div>
            </div>

        <main v-if="content && !showProfilePage && content.items.length" class="px-4 flex-1 overflow-x-hidden overflow-y-auto  w-full  mb-20">
            <!-- New releases -->
            <div class="px-4 mb-6 py-4 rounded-lg shadow-md bg-white dark:bg-gray-700 flex w-full">
                <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                <a href="javascript:;" class="uppercase p-2 mx-2 text-center text-white w-32 rounded-lg bg-danger"
                    @click="showAddSide = true, activeItem = {}" v-text="translate('add_new')"></a>
            </div>

            
            <div class="sm:grid sm:space-y-0 space-y-6 xl:!grid-cols-3 md:grid-cols-2 gap-6 rounded py-2">

                <div  v-for="driver in content.items" class="">
                    <div class="grid grid-cols-12 gap-x-6 bg-white p-4 rounded shadow-md">
                        <div class="d-flex gap-7 align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-circle symbol-100px cursor-pointer" @click="handleAction('view', driver)">
                                <img :src="driver.photo" alt="image">
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <h3 class="mb-0" v-text="driver.name"></h3>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="ki-duotone ki-sms fs-2"><span class="path1"></span><span class="path2"></span></i>
                                    <a href="#" class="text-muted text-hover-primary" v-text="driver.email"></a>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="ki-duotone ki-phone fs-2"><span class="path1"></span><span
                                            class="path2"></span></i> <a href="#" class="text-muted text-hover-primary" v-text="driver.mobile"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer mt-6">
                        <div class="grid grid-cols-12 gap-x-3">
                            <div class="sm:col-span-2 col-span-4 "><span @click="handleAction('view', driver)"
                                    class="px-3 shadow-md rounded cursor-pointer inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 rounded-sm border font-medium bg-white text-gray-500 align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10"><i
                                        class="fa fa-eye  py-1  px-2"></i></span></div>
                            <div @click="handleAction('edit', driver)" class="sm:col-span-8 col-span-4"><span
                                    class="px-3 shadow-md rounded cursor-pointer inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 w-full rounded-sm border font-medium bg-white text-gray-500 align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10"><i
                                        class="fa fa-edit py-1"></i> <span class="text-base  "
                                        v-text="translate('Edit')"></span></span></div>
                            <div class="sm:col-span-2 col-span-4">
                                <div class="hs-dropdown ti-dropdown flex justify-end">
                                    <div @click="handleAction('delete', driver)"
                                        class="w-full px-3 shadow-md rounded cursor-pointer hs-dropdown-toggle ti-dropdown-toggle inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 rounded-sm border font-medium bg-white text-red-500 hover:text-red-400  align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10">
                                        <delete_icon class="w-4" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <side-form-update :conf="conf" model="Driver.update" :item="activeItem" :model_id="activeItem.driver_id"
            :index="activeItem.driver_id" v-if="showEditSide && !showAddSide" :columns="content.fillable" class="col-md-3"
            @callback="closeSide" />

        <side-form-create @callback="closeSide" :conf="conf" model="Driver.create"
            v-if="showAddSide && content && content.fillable" :columns="content.fillable" class="col-md-3" />
    </div>
</template>
<script>
import { defineAsyncComponent, ref } from 'vue';
import { translate, handleGetRequest, handleRequest, deleteByKey, showAlert } from '@/utils.vue';
import delete_icon from '@/components/svgs/trash.vue';

const SideFormCreate = defineAsyncComponent(() =>
    import('@/components/includes/side-form-create.vue')
);

const SideFormUpdate = defineAsyncComponent(() =>
    import('@/components/includes/side-form-update.vue')
);


export default
    {
        components: {
            SideFormCreate,
            SideFormUpdate,
            delete_icon,
        },
        emits: ['switchTab'],
        setup(props, {emit}) {

            const url = props.conf.url + props.path + '?load=json';

            const showAddSide = ref(false);
            const showEditSide = ref(false);
            const showProfilePage = ref(null);
            const activeItem = ref({});

            const content = ref({
                title: '',
                items: [],
                columns: [],
                fillable: [],
            });

            const load = () => {
                handleGetRequest(url).then(response => {
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
            const handleAction = (actionName, data) => {
                switch (actionName) {

                    case 'view':
                        return emit('callback', {link:'admin/driver_profile?driver_id='+data.driver_id,component:'driver_page'});
                        break;

                    case 'edit':
                        activeItem.value = data;
                        showAddSide.value = false;
                        showEditSide.value = true;
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
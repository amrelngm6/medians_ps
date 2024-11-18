<template>
    <div class=" w-full">
        <item_details :item="activeItem" v-if="showEditSide && content" :doctors="content.doctors" :categories="content.categories" ref="activeForumPost" @callback="closeMessage" />
        <div class="container-fluid" v-if="!showEditSide">

            <div class="card">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-xl-row p-7">
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid me-xl-15 mb-20 mb-xl-0">



                            <!--begin::posts-->
                            <div class="mb-0">
                                <!--begin::Search form-->
                                <form method="post" action="#" v-if="content.showSearchForm" class="form mb-15">
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative">
                                        <i
                                            class="ki-duotone ki-magnifier fs-1 text-primary position-absolute top-50 translate-middle ms-9"><span
                                                class="path1"></span><span class="path2"></span></i>
                                        <input type="text" class="form-control form-control-lg form-control-solid ps-14"
                                            name="search" value="" placeholder="Search">
                                    </div>
                                    <!--end::Input wrapper-->
                                </form>
                                <!--end::Search form-->

                                <!--begin::Heading-->
                                <h1 class="text-gray-900 mb-10" v-text="content.title"></h1>
                                <!--end::Heading-->

                                <!--begin::posts List-->
                                <div v-for="post in content.items" class="w-full">
                                    <div v-if="post.status == activeStatus" @click="activeItem = post, showEditSide = true" class="w-full flex-col justify-start items-start gap-10 inline-flex bg-gray-100 p-4 rounded-lg shadow-md bg-white mb-4">
                                        <div class=" flex-col justify-start items-start gap-2.5 flex">
                                            <div class="mt-2 justify-start items-start gap-2.5 inline-flex">
                                                <div class="px-2.5 py-1 bg-blue-100 rounded-lg justify-center items-center gap-2.5 flex">
                                                    <div class=" font-normal text-sm leading-none" v-text="post.category ? post.category.title : ''"></div>
                                                </div>
                                            </div>
                                            <a href="javascript:;"  class="pt-1 text-lg font-semibold leading-relaxed purple-color hover:text-gray-500" v-text="post.subject"></a>
                                        </div>
                                        <div class="flex w-full">
                                            <div class="w-full justify-start items-center gap-2 inline-flex" v-if="post.doctor">
                                                <div class=" relative flex">
                                                    <img class="w-10 h-10 relative rounded-full" :src="post.doctor ? post.doctor.picture : ''">
                                                </div>
                                                <div class=" justify-between items-center flex">
                                                    <div class="flex-col justify-start items-start inline-flex" >
                                                        <div class="justify-start items-center gap-1 inline-flex">
                                                            <div class=" text-sm font-semibold text-gray-500" v-text="post.doctor.title"></div>
                                                        </div>
                                                        <div class=" text-sm  pt-1 font-normal leading-none text-gray-800" v-text="translate('Answered By')"></div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="justify-start gap-10 flex items-center p-2">
                                                <div class="flex gap-1 text-sm mx-2 font-normal relative items-center">
                                                    <span class="tooltiptext" v-text="translate('Views')"></span>
                                                    <span class="pt-2" v-text="post.views_sum_times"></span>
                                                    <img :src="'/src/front_assets/svg/views.svg'" width="40"></div>
                                                <div class="flex gap-1 text-sm mx-2 font-normal relative items-center">
                                                    <span class="tooltiptext"  v-text="translate('Comments')"></span>
                                                    <span class="pt-2" v-text="post.comments.length"></span>
                                                    <img :src="'/src/front_assets/svg/comments.svg'" width="40"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::posts List-->
                            </div>
                            <!--end::posts-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Sidebar-->
                        <div class="flex-column flex-lg-row-auto w-100 mw-lg-300px mw-xxl-350px">

                            <!--begin::More channels-->
                            <div class="card-rounded flex gap-10 mb-15 py-3 px-6">
                                <!--begin::status-list-->
                                <div class="d-flex align-items-center mb-10 gap-2 " v-for="statusItem in statusList">
                                    <!--begin::Icon-->
                                    <vue-feather class="w-6 pb-2" :type="statusItem.icon"></vue-feather>
                                    <!--end::Icon-->

                                    <!--begin::Info-->
                                    <div class="d-flex flex-column cursor-pointer "
                                        @click="switchStatus(statusItem.status)" >
                                        <h5 class="" :class="statusItem.status == activeStatus ? 'text-danger' : 'text-gray-500'" v-text="statusItem.text"></h5>

                                        <!--begin::Section-->
                                        <!-- <div class="fw-semibold"> -->
                                            <!--begin::Desc-->
                                            <!-- <span class="text-muted" v-text="statusItem.desc"></span> -->
                                            <!--end::Desc-->
                                        <!-- </div> -->
                                        <!--end::Section-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::status-list-->

                            </div>
                            <!--end::More channels-->
                        </div>
                        <!--end::Sidebar-->
                    </div>
                    <!--end::Layout-->
                </div>
                <!--end::Card body-->
            </div>
            
        </div>
    </div>
</template>
<script>

import item_details from '@/components/forum/item.vue';


import { defineAsyncComponent, ref } from 'vue';
import { translate, handleGetRequest, handleRequest, deleteByKey, showAlert } from '@/utils.vue';

export default
    {
        components: {
            item_details,
            translate
        },

        setup(props) {

            const url = props.conf.url + props.path + '?load=json';

            const content = ref({});
            const activeItem = ref({});
            const showAddSide = ref(false);
            const showEditSide = ref(false);
            const activeStatus = ref('0');


            const closeMessage = () => {
                showEditSide.value = false;
                activeItem.value = null;
            }

            const switchStatus = (option) => {
                activeStatus.value = option
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
                        // window.open(conf.url+data.content.prefix)
                        break;

                    case 'edit':
                        activeItem.value = data
                        break;

                    case 'delete':
                        deleteByKey(props.object_key, data, props.object_name + '.delete');
                        break;
                }
            }

            const load = () => {
                handleGetRequest(url).then(response => {
                    content.value = JSON.parse(JSON.stringify(response));
                });
            }

            load();

            let statusList = [{ text: translate('Inactive'), status: '0', icon: 'delete', desc: translate('New posts those not opened yet') }, { text: translate('Active'), status: 'on', icon: 'check-square', desc: translate('posts needs customer reply') }];

            return {
                content,
                activeItem,
                closeMessage,
                switchStatus,
                showAddSide,
                showEditSide,
                activeStatus,
                statusList,
                translate
            }
        },
        props: [
            'path',
            'langs',
            'setting',
            'conf',
            'auth',
        ],
    };
</script>
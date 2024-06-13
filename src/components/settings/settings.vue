<template>
    <div class="w-full " v-if="content">

        <div class="card mb-9">
            <div class="card-body pt-9 pb-0">
                <!--begin::Details-->
                <div class="d-flex flex-wrap flex-sm-nowrap mb-6" v-if="auth && auth.business">
                    <!--begin::Image-->
                    <div v-if="item" class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                        <img class="mw-50px mw-lg-75px" :src="item.logo" alt="image">
                    </div>
                    <!--end::Image-->

                    <div class="flex-grow-1">
                        <div class="justify-content-between align-items-start flex-wrap mb-2">
                            <div class="d-flex w-full">
                                <div class="d-flex align-items-center mb-1 flex-auto" v-if="auth && auth.business">
                                    <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bold me-3" v-text="auth.business.business_name"></a>
                                    <span class="badge badge-light-success me-auto"></span>
                                </div>
                                <div class="d-flex flex-wrap fw-semibold fs-5 text-gray-500 ">
                                    <a @click="showEditSide = true" href="javascript:;" class="pt-2 pb-1 gap-4 text-white btn btn-danger btn-active " >
                                        <span v-text="translate('Edit')"></span>
                                        <vue-feather class="w-25px px-1 " type="edit-3"></vue-feather>
                                    </a>
                                </div>
                            </div>
                            <div  class="d-flex flex-wrap fw-semibold fs-6 mb-2 pe-2">
                                <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                    <vue-feather class="w-5 mx-1" type="eye"></vue-feather>
                                    <span v-text="auth.business.type"></span>
                                </a>
                            </div>
                        </div>
                            
                        <div class="d-flex flex-wrap justify-content-start">
                            <div class="d-flex flex-wrap" v-if="content.stats">
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bold" v-text="auth.business.subscription.plan_name"></div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-500" v-text="translate('Plan')"></div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bold" v-text="content.stats.drivers_count"></div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-500" v-text="translate('Drivers')"></div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bold" v-text="content.stats.vehicles_count"></div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-500" v-text="translate('Vehicles')"></div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bold" v-text="content.stats.trips_count"></div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-500" v-text="translate('Trips')"></div>
                                </div>
                                <!--end::Stat-->
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="separator"></div>

                <!--begin::Nav-->
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                    <li v-for="(row,k) in content.fillable" class="nav-item">
                        <a @click="switchTab(k)" v-text="handleTabName(k)" class="nav-link text-active-primary py-5 me-6 " :class="activeTab == k ? 'active' : ''"  href="javascript:;"></a>
                    </li>
                </ul>
                <!--end::Nav-->
            </div>
        </div>



        <div class=" w-full">
            <form action="/api/update" method="POST" data-refresh="1" id="system-setting-form" class="action  px-4 m-auto rounded-lg pb-10" >

                <input name="type" type="hidden" value="Settings.update">

                <div class="w-full "  v-for="(row,k) in content.fillable">
                    <div class="card w-full py-10" v-if="activeTab == k">
                        <div class="card-body pt-0"  >
                            <div class="settings-form" >
                                <div class="row mb-6"   v-for="(field, i) in row" >
                
                                    <label class="col-lg-4 col-form-label " :class="field.required ? 'required' : ''" :for="'input'+i"  v-if="field.column_type != 'hidden'">
                                        <p class="fw-bold fs-4 w-full" v-text="field.title" ></p>
                                        <p v-text="field.help_text" v-if="field.help_text" ></p>
                                    </label>
                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <form_field :column="field" :model="null"  :item="item" :conf="conf"></form_field>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                <button class="uppercase mt-3 text-white mx-auto rounded-lg bg-purple-800 hover:bg-red-800 px-4 py-2">{{translate('Save')}}</button>
            </form>
        </div>

        <side-form-update @callback="closeSide" :conf="conf" model="Business.update" :item="auth.business" :model_id="auth.business.business_id" index="id" v-if="showEditSide && auth && auth.business " :columns="content.business_fillable"  class="col-md-3" />
    </div>
</template>
<script>

import {ref } from 'vue';
import {translate,handleGetRequest,isInput, setActiveStatus, handleName, handleTabName } from '@/utils.vue';
import field from '@/components/includes/Field.vue';
import form_field from '@/components/includes/form_field.vue';
import SideFormUpdate from '@/components/includes/side-form-update.vue';

export default 
{
    components: {
        SideFormUpdate,
        'vue-medialibrary-field': field,
        form_field,
        translate
    },
    name:'Settings',
    setup(props) {
        
        const url =  props.conf.url+props.path+'?load=json';

        const showEditSide = ref(false);

        const content =  ref({
            title: '',
            settings: [],
        });
        
        const item =  ref({});

        const load = () => {
            handleGetRequest( url ).then(response=> {
                content.value = JSON.parse(JSON.stringify(response))
                item.value = content.value.setting
            });
        }
        
        load();

        const closeSide = () => {
            showEditSide.value = false;
        }

        const activeTab =  ref('basic');

        const switchTab = (tab) => 
        {
            activeTab.value = tab;
        }

        return {
            url,
            showEditSide,
            content,
            item,
            isInput,
            setActiveStatus,
            closeSide,
            handleTabName,
            handleName,
            switchTab,
            activeTab,
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
<style lang="css">
    .rtl #side-cart-container
    {
        right: auto;
        left:0;
    }
</style>
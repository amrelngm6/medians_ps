<template>
    <div class="w-full mb-5 mb-xl-10">
       
            <div class="card p-6" v-if="activeItem">
                <div class="d-flex flex-wrap flex-sm-nowrap">
                    <div class="me-7 mb-4">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                            <img :src="activeItem.picture ?? '/uploads/images/default_profile.png'" class="w-20" alt="image" />
                            <div
                                class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                            </div>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1"
                                        v-text="activeItem.name"></a>
                                </div>
                                <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                        <vue-feather class="w-5 mx-1" type="smartphone"></vue-feather>
                                        <span v-text="activeItem.mobile"></span>
                                    </a>
                                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                        <vue-feather class="w-5 mx-1" type="at-sign"></vue-feather>
                                        <span v-text="activeItem.email"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex my-4">
                                <a @click="back" href="javascript:;" class="text-white btn btn-sm btn-primary me-3" v-text="translate('Back')"></a>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap flex-stack">
                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                <div class="d-flex flex-wrap" v-if="activeItem.route">
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="fs-2 fw-bold" v-text="activeItem.route.route_name"></div>
                                        </div>
                                        <div class="fw-semibold fs-6 text-gray-500" v-text="translate('Route')"></div>
                                    </div>
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div class="fs-2 fw-bold" v-text="activeItem.vehicle ? activeItem.vehicle.plate_number : ''"></div>
                                            </div>
                                        </div>
                                        <div class="fw-semibold fs-6 text-gray-500" v-text="translate('Vehicle')"></div>
                                    </div>
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div class="fs-2 fw-bold" v-text="content.stats.trips_count"></div>
                                            </div>
                                        </div>
                                        <div class="fw-semibold fs-6 text-gray-500" v-text="translate('Trips')"></div>
                                    </div>
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div class="fs-2 fw-bold" v-text="content.stats.taxi_trips_count"></div>
                                            </div>
                                        </div>
                                        <div class="fw-semibold fs-6 text-gray-500" v-text="translate('Taxi Trips')"></div>
                                    </div>
                                    <!--end::Stat-->

                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Wrapper-->

                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Info-->
                </div>
            </div>
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                <li class="nav-item mt-2" v-for="tab in tabsList">
                    <a @click="setActiveTab(tab.link)" :class="activeTab == tab.link ? 'active' : ''"
                        class="nav-link text-active-primary ms-0 me-10 py-5 " href="javascript:;" v-text="tab.title"></a>
                </li>
            </ul>

        <div class="w-full pt-9 pb-0">
            <div class="d-flex flex-column flex-lg-row">
                <div class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
                    
                    <account_tab  v-if="activeTab == 'account'" :overview="content.overview" :item="activeItem" :currency="currency"/>
                   
                    <info_tab :conf="conf" v-if="activeTab == 'business_info'" :overview="content.overview" :item="activeItem"  :currency="currency"/>

                    <setting_tab :conf="conf" v-if="activeTab == 'settings'" :fillable="content.fillable" :item="activeItem"  :system_setting="system_setting" :currency="currency"/>

                    <withdrawal_tab :conf="conf" :auth="auth" v-if="activeTab == 'wallet'" :withdrawals="content.withdrawals" :wallet="content.wallet"  :system_setting="system_setting" :item="activeItem" :currency="currency" />

                    <collected_cash_tab :conf="conf" :auth="auth" v-if="activeTab == 'collected_cash'" :collected_cash="content.collected_cash" :wallet="content.wallet"  :system_setting="system_setting" :item="activeItem" :currency="currency" />

                    <taxi_trips_tab :conf="conf" :auth="auth" v-if="activeTab == 'taxi_trips'" :trips="content.taxi_trips"  :system_setting="system_setting" :item="activeItem" :currency="currency" />
                    
                    <trips_tab :conf="conf" :auth="auth" v-if="activeTab == 'trips'" :trips="content.trips" :wallet="content.wallet"  :system_setting="system_setting" :item="activeItem" :currency="currency" />
                    

                </div>  
                
            </div>
            
        </div>
        <side-form-update @callback="closeSide" :conf="conf" model="Driver.update" :item="activeItem"
            :model_id="activeItem.driver_id" index="id" v-if="showEditSide" :columns="content.fillable" class="col-md-3" />

    </div>
</template>
<script>

import { defineAsyncComponent, ref } from 'vue';
import { translate, handleGetRequest, handleName, isInput, setActiveStatus, handleRequest, handleAccess, deleteByKey, showAlert } from '@/utils.vue';

const SideFormCreate = defineAsyncComponent(() =>
    import('@/components/includes/side-form-create.vue')
);

const SideFormUpdate = defineAsyncComponent(() =>
    import('@/components/includes/side-form-update.vue')
);

const form_field = defineAsyncComponent(() => import('@/components/includes/form_field.vue') );
const account_tab = defineAsyncComponent(() => import('@/components/driver/account.vue') );
const withdrawal_tab = defineAsyncComponent(() => import('@/components/driver/withdrawal.vue') );
const setting_tab = defineAsyncComponent(() => import('@/components/driver/setting.vue') );
const info_tab = defineAsyncComponent(() => import('@/components/driver/info.vue') );
const trips_tab = defineAsyncComponent(() => import('@/components/driver/trips.vue') );
const taxi_trips_tab = defineAsyncComponent(() => import('@/components/driver/taxi_trips.vue') );
const collected_cash_tab = defineAsyncComponent(() => import('@/components/driver/collected_cash.vue') );

export default {

    components: {
        SideFormUpdate,
        SideFormCreate,
        account_tab,
        form_field,
        withdrawal_tab,
        setting_tab,
        taxi_trips_tab,
        trips_tab,
        info_tab,
        collected_cash_tab

    },
    name: 'Drivers',
    emits:['callback'],
    setup(props, {emit}) {
        console.log('loaded profile')
        const url = props.conf.url + props.path + '?load=json';

        const showAddSide = ref(false);
        const showEditSide = ref(false);
        const activeItem = ref({});
        const content = ref({});
        const activeTab = ref('account');
        const tabsList = ref([
            { title: translate('Account'), link: 'account' },
            { title: translate('Settings'), link: 'settings' },
            { title: translate('Route Trips'), link: 'trips' },
            { title: translate('Taxi trips'), link: 'taxi_trips' },
            { title: translate('Collected cash'), link: 'collected_cash'},
            { title: translate('Wallet'), link: 'wallet' },
        ]);

        

        const setActiveTab = (tab) => {
            activeTab.value = tab;
        }

        const load = () => {
            handleGetRequest(url).then(response => {
                content.value = JSON.parse(JSON.stringify(response));
                activeItem.value = content.value.driver;
            });
        }
        
        load();
        
        const closeSide = () => {
            showAddSide.value = false;
            showEditSide.value = false;
        }



        const back = () => 
        {
            return emit('callback', {link:'admin/drivers',component:'drivers'});
        }

        const checkFeatureLimit = (features, code) => 
        {
            if ( features)
            {
                for (let i = 0; i < features.length; i++) {
                    const element = features[i];
                    if (element.code == code+'.count')
                    {
                        return element.access_value;
                    }
                }
            }
            return 0;
        }


        

        
        

        
        return {
            checkFeatureLimit,
            back,
            url,
            showAddSide,
            showEditSide,
            content,
            setActiveTab,
            tabsList,
            activeTab,
            activeItem,
            closeSide,
            setActiveStatus,
            isInput,
            handleName,
            translate,
        };
    },

    props: [
        'path',
        'lang',
        'setting',
        'system_setting',
        'business_setting',
        'conf',
        'auth',
        'currency'
    ]
};
</script>
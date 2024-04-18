<template>
    <div class="w-full mb-5 mb-xl-10">
        <div class="w-full pt-9 pb-0">
            <div class="d-flex flex-column flex-lg-row">
    <!--begin::Content-->
    <div class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
        <!--begin::Card-->
<div class="card card-flush pt-3 mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header">
        <!--begin::Card title-->
        <div class="card-title">
            <h2 class="fw-bold">Product Details</h2>
        </div>
        <!--begin::Card title-->

        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <a href="/metronic8/demo1/apps/subscriptions/add.html" class="btn btn-light-primary">Update Product</a>
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-3">
        <!--begin::Section-->
        <div class="mb-10">
            <!--begin::Title-->
            <h5 class="mb-4">Billing Address:</h5>
            <!--end::Title-->

            <!--begin::Details-->
            <div class="d-flex flex-wrap py-5">
                <!--begin::Row-->
                <div class="flex-equal me-5">
                    <!--begin::Details-->
                    <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2 m-0">
                        <!--begin::Row-->
                        <tbody><tr>
                            <td class="text-gray-500 min-w-175px w-175px">Bill to:</td>
                            <td class="text-gray-800 min-w-200px">
                                <a href="/metronic8/demo1/pages/apps/customers/view.html" class="text-gray-800 text-hover-primary">smith@kpmg.com</a>
                            </td>
                        </tr>
                        <!--end::Row-->

                        <!--begin::Row-->
                        <tr>
                            <td class="text-gray-500">Customer Name:</td>
                            <td class="text-gray-800">
                                Emma Smith                            </td>
                        </tr>
                        <!--end::Row-->

                        <!--begin::Row-->
                        <tr>
                            <td class="text-gray-500">Address:</td>
                            <td class="text-gray-800">
                                Floor 10, 101 Avenue of 
                                the Light Square, New York, NY, 10050.
                            </td>
                        </tr>
                        <!--end::Row-->

                        <!--begin::Row-->
                        <tr>
                            <td class="text-gray-500">Phone:</td>
                            <td class="text-gray-800">(555) 555-1234</td>
                        </tr>
                        <!--end::Row-->
                    </tbody></table>
                    <!--end::Details-->
                </div>
                <!--end::Row-->

                <!--begin::Row-->
                <div class="flex-equal">
                    <!--begin::Details-->
                    <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2 m-0">
                        <!--begin::Row-->
                        <tbody><tr>
                            <td class="text-gray-500 min-w-175px w-175px">Subscribed Product:</td>
                            <td class="text-gray-800 min-w-200px">
                                <a href="#" class="text-gray-800 text-hover-primary">Basic Bundle</a>
                            </td>
                        </tr>
                        <!--end::Row-->

                        <!--begin::Row-->
                        <tr>
                            <td class="text-gray-500">Subscription Fees:</td>
                            <td class="text-gray-800">
                                $149.99 / Year
                            </td>
                        </tr>
                        <!--end::Row-->

                        <!--begin::Row-->
                        <tr>
                            <td class="text-gray-500">Billing method:</td>
                            <td class="text-gray-800">
                                Annually
                            </td>
                        </tr>
                        <!--end::Row-->

                        <!--begin::Row-->
                        <tr>
                            <td class="text-gray-500">Currency:</td>
                            <td class="text-gray-800">USD - US Dollar</td>
                        </tr>
                        <!--end::Row-->
                    </tbody></table>
                </div>
            </div>
        </div>
    </div>
    <!--end::Card body-->
    
    <!--begin::Card-->
    <div class="card card-flush pt-3 mb-5 mb-xl-10" v-if="activeTab == 'invoices'">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2 v-text="translate('Invoices')"></h2>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body pt-2" v-if="content.invoices">
            <table id="kt_customer_details_invoices_table_1" class="table align-middle table-row-dashed fs-6 fw-bold gs-0 gy-4 p-0 m-0">
                <thead class="border-bottom border-gray-200 fs-7 text-uppercase fw-bold">
                    <tr class="text-start text-gray-500">
                        <th class="min-w-100px" v-text="translate('Code')"></th>
                        <th class="min-w-100px" v-text="translate('Amount')"></th>
                        <th class="min-w-100px" v-text="translate('Status')"></th>                                    
                        <th class="min-w-125px" v-text="translate('Date')"></th>
                        <th class="w-100px" v-text="translate('Plan')"></th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-semibold text-gray-600">
                    <tr v-for="invoice in content.invoices">
                        <td><a href="#" class="text-gray-600 text-hover-primary" v-text="invoice.code"></a></td>
                        <td class="text-success"  v-text="invoice.total_amount+''+system_setting.currency"></td>
                        <td><span class="badge badge-light-warning" v-text="invoice.status"></span></td>
                        <td v-text="invoice.date"></td>
                        <td v-text="invoice.item && invoice.item.item ? invoice.item.item.name : ''"></td>
                    </tr>
                </tbody>
            </table>
                    
            <!--end::Tab Content-->
        </div>
        <!--end::Card body-->
    </div>
</div>
<!--end::Card-->
    


</div>  

<div class="flex-column flex-lg-row-auto w-lg-250px w-xl-300px mb-10 order-1 order-lg-2">
        <!--begin::Card-->
<div class="card card-flush mb-0" data-kt-sticky="true" data-kt-sticky-name="subscription-summary" data-kt-sticky-offset="{default: false, lg: '200px'}" data-kt-sticky-width="{lg: '250px', xl: '300px'}" data-kt-sticky-left="auto" data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
    <!--begin::Card header-->
    <div class="card-header">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>Summary</h2>
        </div>
        <!--end::Card title-->

        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::More options-->
            <a href="#" class="btn btn-sm btn-light btn-icon" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                <i class="ki-duotone ki-dots-square fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>            </a>
            <!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-6 w-200px py-4" data-kt-menu="true">
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3">
            Pause Subscription
        </a>
    </div>
    <!--end::Menu item-->
    
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-kt-subscriptions-view-action="delete">
           Edit Subscription
        </a>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link text-danger px-3" data-kt-subscriptions-view-action="edit">
            Cancel Subscription
        </a>
    </div>
    <!--end::Menu item-->
</div>
<!--end::Menu-->
            <!--end::More options-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0 fs-6">
        <!--begin::Section-->
        <div class="mb-7">
                        
            <!--begin::Details-->
            <div class="d-flex align-items-center">
                <!--begin::Avatar-->
                <div class="symbol symbol-60px symbol-circle me-3">
                                                                <img alt="Pic" :src="'/metronic8/demo1/assets/media/avatars/300-5.jpg'">
                                    </div>
                <!--end::Avatar-->

                <!--begin::Info-->
                <div class="d-flex flex-column">
                    <!--begin::Name-->
                    <a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-2">Sean Bean</a>
                    <!--end::Name-->

                    <!--begin::Email-->
                    <a href="#" class="fw-semibold text-gray-600 text-hover-primary">sean@dellito.com</a>
                    <!--end::Email-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->
        </div>
        <!--end::Section-->

        <!--begin::Seperator-->
        <div class="separator separator-dashed mb-7"></div>
        <!--end::Seperator-->

        <!--begin::Section-->
        <div class="mb-7">
            <!--begin::Title-->
            <h5 class="mb-4">Product details</h5>
            <!--end::Title-->

            <!--begin::Details-->
            <div class="mb-0">
                <!--begin::Plan-->
                <span class="badge badge-light-info me-2">Basic Bundle</span>
                <!--end::Plan-->

                <!--begin::Price-->
                <span class="fw-semibold text-gray-600">$149.99 / Year</span>
                <!--end::Price-->
            </div>
            <!--end::Details-->
        </div>
        <!--end::Section-->

        <!--begin::Seperator-->
        <div class="separator separator-dashed mb-7"></div>
        <!--end::Seperator-->

        <!--begin::Section-->
        <div class="mb-10">
            <!--begin::Title-->
            <h5 class="mb-4">Payment Details</h5>
            <!--end::Title-->

            <!--begin::Details-->
            <div class="mb-0">
                <!--begin::Card info-->
                <div class="fw-semibold text-gray-600 d-flex align-items-center">
                    Mastercard

                    <img :src="'/metronic8/demo1/assets/media/svg/card-logos/mastercard.svg'" class="w-35px ms-2" alt="">
                </div>
                <!--end::Card info-->

                <!--begin::Card expiry-->
                <div class="fw-semibold text-gray-600">Expires Dec 2024</div>
                <!--end::Card expiry-->
            </div>
            <!--end::Details-->
        </div>
        <!--end::Section-->

        <!--begin::Seperator-->
        <div class="separator separator-dashed mb-7"></div>
        <!--end::Seperator-->

        <!--begin::Section-->
        <div class="mb-10">
            <!--begin::Title-->
            <h5 class="mb-4">Subscription Details</h5>
            <!--end::Title-->

            <!--begin::Details-->
            <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2">
                <!--begin::Row-->
                <tbody><tr class="">
                    <td class="text-gray-500">Subscription ID:</td>
                    <td class="text-gray-800">sub_4567_8765</td>
                </tr>
                <!--end::Row-->

                <!--begin::Row-->
                <tr class="">
                    <td class="text-gray-500">Started:</td>
                    <td class="text-gray-800">15 Apr 2021</td>
                </tr>
                <!--end::Row-->

                <!--begin::Row-->
                <tr class="">
                    <td class="text-gray-500">Status:</td>
                    <td><span class="badge badge-light-success">Active</span></td>
                </tr>
                <!--end::Row-->

                <!--begin::Row-->
                <tr class="">
                    <td class="text-gray-500">Next Invoice:</td>
                    <td class="text-gray-800">15 Apr 2022</td>
                </tr>
                <!--end::Row-->
            </tbody></table>
            <!--end::Details-->
        </div>
        <!--end::Section-->

        <!--begin::Actions-->
        <div class="mb-0">
            <a href="" class="btn btn-primary" id="kt_subscriptions_create_button">                
                Edit Subscription
            </a>
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->    </div>
    <!--end::Sidebar-->
</div>
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap">
                <!--begin: Pic-->
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img :src="auth.photo" class="w-20" alt="image" />
                        <div
                            class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                        </div>
                    </div>
                </div>
                <!--end::Pic-->

                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::User-->
                        <div class="d-flex flex-column">
                            <!--begin::Name-->
                            <div class="d-flex align-items-center mb-2">
                                <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1"
                                    v-text="auth.name"></a>
                            </div>
                            <!--end::Name-->

                            <!--begin::Info-->
                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                    <vue-feather class="w-5 mx-1" type="eye"></vue-feather>
                                    <span v-text="auth.role.name"></span>
                                </a>
                                <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                    <vue-feather class="w-5 mx-1" type="smartphone"></vue-feather>
                                    <span v-text="auth.phone"></span>
                                </a>
                                <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                    <vue-feather class="w-5 mx-1" type="at-sign"></vue-feather>
                                    <span v-text="auth.email"></span>
                                </a>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::User-->

                        <!--begin::Actions-->
                        <div class="d-flex my-4">
                            <a @click="showEditSide = true" href="javascript:;" class="text-white btn btn-sm btn-primary me-3" v-text="translate('Edit')"></a>
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Title-->

                    <!--begin::Stats-->
                    <div class="d-flex flex-wrap flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column flex-grow-1 pe-8">
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap" v-if="activeItem.business && content">
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bold" v-text="activeItem.business.subscription.plan_name"></div>
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
                            <!--end::Stats-->
                        </div>
                        <!--end::Wrapper-->

                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->

            <!--begin::Navs-->
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                <!--begin::Nav item-->
                <li class="nav-item mt-2" v-for="tab in tabsList">
                    <a v-if="checkRole(activeItem.role_id, tab.link)" @click="setActiveTab(tab.link)" :class="activeTab == tab.link ? 'active' : ''"
                        class="nav-link text-active-primary ms-0 me-10 py-5 " href="javascript:;" v-text="tab.title"></a>
                </li>
                <!--end::Nav item-->
            </ul>
            <!--begin::Navs-->
             <!--begin::Row-->
             <div class="flex-equal" v-if="activeTab == 'account' && activeItem.business && activeItem.business.subscription">
                    <!--begin::Details-->
                    <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2 m-0">
                        <!--begin::Row-->
                        <tbody><tr>
                            <td class="text-gray-500" v-text="translate('Plan')"></td>
                            <td class="text-gray-800" v-text="activeItem.business.subscription.plan_name"></td>
                        </tr>
                        <tr>
                            <td class="text-gray-500" v-text="translate('Start date')"></td>
                            <td class="text-gray-800" v-text="activeItem.business.subscription.start_date"></td>
                        </tr>
                        <tr>
                            <td class="text-gray-500" v-text="translate('End date')"></td>
                            <td class="text-gray-800" v-text="activeItem.business.subscription.end_date"></td>
                        </tr>
                    </tbody></table>
                </div>
            <div class="card mb-5 mb-xl-10" id="kt_profile_details_view" v-if="activeTab == 'account'">
                <div class="card-body p-9">
                    <div class="row my-4 py-4 border-b border-gray-200" v-for="field in content.overview">
                        <label class="col-lg-4 fw-semibold text-muted" v-text="field.title"></label>
                        <div class="col-lg-8">
                            <span class="fw-bold fs-6 text-gray-800" v-text="field.key"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-5 mb-xl-10" id="kt_profile_details_view" v-if="activeTab == 'business_info'">
                <div class="card-body p-9">
                    <div class="row my-4 py-4 border-b border-gray-200" >
                        <label class="col-lg-4 fw-semibold text-muted" v-text="translate('Business name')"></label>
                        <div class="col-lg-8">
                            <span class="fw-bold fs-6 text-gray-800" v-text="activeItem.business.business_name"></span>
                        </div>
                    </div>
                    <div class="row my-4 py-4 " >
                        <label class="col-lg-4 fw-semibold text-muted" v-text="translate('Business type')"></label>
                        <div class="col-lg-8">
                            <span class="fw-bold fs-6 text-gray-800" v-text="activeItem.business.type"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-5 mb-xl-10" id="kt_profile_details_view" v-if="activeTab == 'subscriptions'">

                <div class="card  mb-5 mb-xl-10">
                    <!--begin::Card body-->
                    <div class="card-body">

                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-7">
                                <!--begin::Heading-->
                                <h3 class="mb-2"><span v-text="translate('Active until')"></span> <span v-text="activeItem.business.subscription.end_date"></span></h3>
                                <p class="fs-6 text-gray-600 fw-semibold mb-6 mb-lg-15" v-text="translate('Upgrade Notification Note')"></p>
                                <!--end::Heading-->

                                <!--begin::Info-->
                                <div class="fs-5 mb-2">
                                    <span class="text-gray-800 fw-bold me-1" >$<span v-text="activeItem.business.subscription.plan.monthly_cost"></span></span>
                                    <span class="text-gray-600 fw-semibold" v-text="translate('Monthly')"></span>
                                </div>
                                <!--end::Info-->

                                <!--begin::Notice-->
                                <div class="flex fs-6 text-gray-600 fw-semibold gap-4"  v-if="activeItem.business">
                                    <span v-text="translate('Your current plan') "></span>
                                    <span class="font-semibold" v-text="activeItem.business.subscription.plan_name "></span>
                                </div>
                                <!--end::Notice-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-5">
                                <!--begin::Heading-->
                                <div class="d-flex text-muted fw-bold fs-5 mb-3">
                                    <span class="flex-grow-1 text-gray-800" v-text="translate('Plan Subscription Days')"></span>
                                    <span class="text-gray-800"><span v-text="activeItem.business.subscription.past_days"></span> of <span v-text="activeItem.business.subscription.total_days"></span> <span v-text="translate('Days')"></span></span>
                                </div>
                                <!--end::Heading-->

                                <!--begin::Progress-->
                                <div class="progress h-8px bg-light-primary mb-2">                                    
                                    <div class="progress-bar bg-danger" role="progressbar" :style="{width: calcDaysWidth(activeItem)+'%'}" ></div>
                                </div>
                                <!--end::Progress-->

                                <!--begin::Description-->
                                <div class="fs-6 text-gray-600 fw-semibold mb-10"><span v-text="activeItem.business.subscription.left_days"></span> <span v-text="translate('Remaining Plan Days')"></span></div>
                                <!--end::Description-->

                                <!--begin::Action-->
                                <div class="d-flex justify-content-end pb-0 px-0">
                                    <button class="btn btn-danger text-white" @click="upgradePlan" v-text="translate('Upgrade Plan')"></button>
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Card body-->
                </div>

            </div>

            <div class="card mb-5 mb-xl-10" id="kt_profile_details_view" v-if="activeTab == 'settings'">
                <div class="card-body p-9">
                    <form action="/api/update" method="POST" data-refresh="1" id="system-setting-form"
                        class="action  px-4 m-auto rounded-lg pb-10">

                        <input name="type" type="hidden" value="User.update">

                        <div class="w-full " v-for="(field, i) in content.fillable">
                            <div class="card w-full ">
                                <div class="card-body pt-0">
                                    <div class="settings-form">
                                        <div class="row mb-6">
                                            
                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6"
                                                :for="'input' + i" v-text="field.title"
                                                v-if="field.column_type != 'hidden'"></label>
                                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                                <form_field :callback="closeSide" :column="field" :model="null"  :item="activeItem" :conf="conf"></form_field>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button
                            class="uppercase mt-3 text-white mx-auto rounded-lg bg-purple-800 hover:bg-red-800 px-4 py-2">{{ translate('Save') }}</button>
                    </form>

                </div>
            </div>
        </div>
        <side-form-update @callback="closeSide" :conf="conf" model="User.update" :item="activeItem"
            :model_id="activeItem.id" index="id" v-if="showEditSide" :columns="content.fillable" class="col-md-3" />

    </div>
</template>
<script>

import { defineAsyncComponent, ref } from 'vue';
import { translate, handleGetRequest, handleName, isInput, setActiveStatus, handleRequest, deleteByKey, showAlert } from '@/utils.vue';

const SideFormCreate = defineAsyncComponent(() =>
    import('@/components/includes/side-form-create.vue')
);

const SideFormUpdate = defineAsyncComponent(() =>
    import('@/components/includes/side-form-update.vue')
);

const form_field = defineAsyncComponent(() =>
    import('@/components/includes/form_field.vue')
);

export default {

    components: {
        SideFormCreate,
        SideFormUpdate,
        form_field,

    },
    name: 'Users',
    setup(props) {

        const url = props.conf.url + props.path + '?load=json';

        const showAddSide = ref(false);
        const showEditSide = ref(false);
        const activeItem = ref({});
        const content = ref({});
        const activeTab = ref('account');
        const tabsList = ref([
            { title: translate('Account'), link: 'account' },
            { title: translate('Settings'), link: 'settings' },
            { title: translate('Business info'), link: 'business_info' },
            { title: translate('Subscriptions'), link: 'subscriptions' },
            { title: translate('Invoices'), link: 'invoices' },
        ]);

        const calcDaysWidth = () => {
            let subscription = activeItem.value.business.subscription

            if (subscription.plan.type == 'paid')
            {
                return (subscription.past_days / subscription.total_days) * 100 ;
            }
            
        }

        const setActiveTab = (tab) => {
            activeTab.value = tab;
        }

        const load = () => {
            handleGetRequest(url).then(response => {
                content.value = JSON.parse(JSON.stringify(response));
                activeItem.value = content.value.user;
            });
        }

        load();

        const closeSide = () => {
            showAddSide.value = false;
            showEditSide.value = false;
        }

        const sameRole = (user, role) => {
            if (user.role_id == role.role_id) {
                return true
            }
            return false;
        }

        const checkRole = (role_id, tab) => {
            
            if (role_id == 1 && (tab == 'business_info' || tab == 'subscriptions')) 
                return false

            return true;
        }

        const upgradePlan = () => 
        {
            window.location.href = props.conf.url+'admin/get_started';
        }

        return {
            upgradePlan,
            url,
            showAddSide,
            showEditSide,
            content,
            setActiveTab,
            tabsList,
            activeTab,
            activeItem,
            checkRole,
            closeSide,
            sameRole,
            calcDaysWidth,
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
    ]
};
</script>
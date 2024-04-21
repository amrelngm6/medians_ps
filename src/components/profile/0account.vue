<template>
    <div class="w-full mb-5 mb-xl-10">

                    <div class="card card-flush pt-3 mb-5 mb-xl-10"  >
                        <div class="card-header">
                            <div class="card-title">
                                <h2 class="fw-bold" v-text="translate('Profile')"></h2>
                            </div>
                        </div>
                        <div class="card-body pt-3">
                            <!--begin::Section-->
                            <div class="mb-10">
                                <!--begin::Title-->
                                <h5 class="mb-4" v-text="translate('Account information')"></h5>
                                <div class="d-flex flex-wrap py-5">
                                    <!--begin::Row-->
                                    <div class="flex-equal me-5">
                                        <!--begin::Details-->
                                        <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2 m-0">
                                            <!--begin::Row-->
                                            <tbody>
                                            <tr v-for="field in content.overview">
                                                <td class="text-gray-500" v-text="field.title"></td>
                                                <td class="text-gray-800 fw-bold" v-text="field.key"></td>
                                            </tr>
                                        </tbody></table>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <div class="flex-equal" v-if="activeItem.business && activeItem.business.subscription">
                                        <!--begin::Details-->
                                        <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2 m-0">
                                            <!--begin::Row-->
                                            <tbody><tr>
                                                <td class="text-gray-500" v-text="translate('Plan')"></td>
                                                <td class="text-gray-800 fw-bold" v-text="activeItem.business.subscription.plan_name"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-500" v-text="translate('Start date')"></td>
                                                <td class="text-gray-800 fw-semibold" v-text="activeItem.business.subscription.start_date"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-500" v-text="translate('End date')"></td>
                                                <td class="text-gray-800" v-text="activeItem.business.subscription.end_date"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
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

                    <div class="card card-flush pt-3 mb-5 mb-xl-10" v-if="activeTab == 'invoices'">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 v-text="translate('Invoices')"></h2>
                            </div>
                        </div>
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
                        </div>
                    </div>

                    
                    <div class="card card-flush pt-3 mb-5 mb-xl-10" v-if="activeTab == 'withdrawal'">
                        <div class="card  card-xxl-stretch mb-5 mb-xxl-10">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 v-text="translate('Earnings')"></h3>
                                </div>
                            </div>
                            <div class="card-body pb-0">
                                <span class="fs-5 fw-semibold text-gray-600 pb-5 d-block" v-text="translate('This is do not consider the debit balance')"></span>
                                <div class="d-flex flex-wrap justify-content-between pb-6">
                                    <div class="d-flex flex-wrap">
                                        <div class="border border-dashed border-gray-300 w-125px rounded my-3 p-4 me-6">                    
                                            <span class="fs-2x fw-bold text-gray-800 lh-1" v-if="content.wallet">
                                                <span v-text="content.wallet ? (system_setting.currency+''+(content.wallet.credit_balance ?? '0')) : '0'"></span>
                                            </span>
                                            <span class="fs-6 fw-semibold text-gray-500 d-block lh-1 pt-2" v-text="translate('Wallet balance')"></span>
                                        </div>
                                        <div class="border border-dashed border-gray-300 w-125px rounded my-3 p-4 me-6" v-if="auth.business">   
                                            <span class="fs-2x fw-bold text-gray-800 lh-1" v-if="auth.business.subscription">
                                                <span class="counted" v-text="auth.business.subscription.is_paid ? system_setting.comission_paid_plan : system_setting.comission_free_plan"></span>%
                                            </span>
                                            <span class="fs-6 fw-semibold text-gray-500 d-block lh-1 pt-2" v-text="translate('Business Commisiion')"></span>
                                        </div>
                                        <div class="border border-dashed border-gray-300 w-125px rounded my-3 p-4 me-6">
                                            <span class="fs-2x fw-bold text-gray-800 lh-1">
                                                <span  v-text="system_setting.currency"></span>
                                                <span  v-text="content.wallet ? (content.wallet.debit_balance ?? '0') : '0'"></span>
                                            </span>
                                            <span class="fs-6 fw-semibold text-gray-500 d-block lh-1 pt-2" v-text="translate('Debit balance')"></span>
                                        </div>
                                    </div>
                                    <a href="#" @click="showWizard = true" class="btn btn-bg-info text-white text-white px-6 flex-shrink-0 align-self-center" v-text="translate('Withdraw Earnings')"></a>             
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <div class="card-title flex gap-4">
                                <h2 class="w-full" v-text="translate('Withdrawal requests')"></h2>
                            </div>
                        </div>
                        <div class="card-body pt-2" v-if="content.business_withdrawals">
                            <table id="kt_customer_details_invoices_table_1" class="table align-middle table-row-dashed fs-6 fw-bold gs-0 gy-4 p-0 m-0">
                                <thead class="border-bottom border-gray-200 fs-7 text-uppercase fw-bold">
                                    <tr class="text-start text-gray-500">
                                        <th class="min-w-100px" v-text="translate('Payment method')"></th>
                                        <th class="min-w-100px" v-text="translate('Amount')"></th>
                                        <th class="min-w-100px" v-text="translate('Status')"></th>                                    
                                        <th class="min-w-125px" v-text="translate('Date')"></th>
                                        <th class="min-w-125px" v-text="translate('Cancel')"></th>
                                    </tr>
                                </thead>
                                <tbody class="fs-6 fw-semibold text-gray-600">
                                    <tr v-for="withdrawal in content.business_withdrawals">
                                        <td v-text="withdrawal.payment_method"></td>
                                        <td class="text-success"  v-text="system_setting.currency+''+withdrawal.amount"></td>
                                        <td><span class="badge badge-light-warning" v-text="withdrawal.status"></span></td>
                                        <td v-text="withdrawal.date"></td>
                                        <td>
                                            <a href="javascript:;" @click="cancelRequest(withdrawal)" class="btn btn-danger text-white px-6 flex-shrink-0 align-self-center" v-text="translate('Cancel')"></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


    </div>  
                
</template>
<script>

import { ref } from 'vue';
import { translate, handleGetRequest, handleName, isInput, setActiveStatus, handleRequest, handleAccess, deleteByKey, showAlert } from '@/utils.vue';

export default {

    components: {
    },
    setup() {


        return {
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
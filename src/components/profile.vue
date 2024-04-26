<template>
    <div class="w-full mb-5 mb-xl-10">

        <div class="modal fade show" v-if="showWizard" :key="showWizard" id="kt_modal_adjust_balance" tabindex="-1" aria-modal="true" role="dialog" data-select2-id="select2-data-kt_modal_adjust_balance" style="background: rgba(0,0,0,.5);display: block;z-index: 9999;">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-650px" data-select2-id="select2-data-134-3oj8">
                <!--begin::Modal content-->
                <div class="modal-content" data-select2-id="select2-data-133-wj88">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bold" v-text="translate('Withdraw from balance')"></h2>
                        <!--end::Modal title-->

                        <!--begin::Close-->
                        <div id="kt_modal_adjust_balance_close" @click="showWizard = false" class="btn ">
                            <vue-feather type="close" />
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->

                    <!--begin::Modal body-->
                    <div class="modal-body mx-5 mx-xl-15 my-7"  v-if="content.wallet">
                        <!--begin::Balance preview-->
                        <div class="d-flex text-center mb-9">
                            <div class="w-50 border border-dashed border-gray-300 rounded mx-2 p-4">
                                <div class="fs-6 fw-semibold mb-2 text-muted" v-text="translate('Current Balance')"></div>
                                <div class="fs-2 fw-bold" kt-modal-adjust-balance="current_balance" v-text="currency.sumbol+''+(content.wallet.credit_balance ?? '0')"></div>
                            </div>
                            <div class="w-50 border border-dashed border-gray-300 rounded mx-2 p-4">
                                <div class="fs-6 fw-semibold mb-2 text-muted" v-text="translate('Debit balance')"></div>
                                <div class="fs-2 fw-bold" kt-modal-adjust-balance="current_balance" v-text="currency.sumbol+''+(content.wallet.debit_balance ?? '0')"></div>
                            </div>
                        </div>
                        <!--end::Balance preview-->

                        <!--begin::Form-->
                        <div id="kt_modal_adjust_balance_form" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <label class="required fs-6 fw-semibold form-label mb-2" v-text="translate('Withdraw amount')"></label>
                                <input id="kt_modal_inputmask" type="number" class="form-control form-control-solid" v-model="withdrawRequest.amount" :max="content.wallet.credit_balance" inputmode="text">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                            
                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <label class="required fs-6 fw-semibold form-label mb-2" v-text="translate('Payment method')"></label>
                                <select  v-model="withdrawRequest.payment_method" class="form-select form-select-solid fw-bold" >
                                    <option value="paypal">PayPal</option>
                                    <option value="paystack">PayStack</option>
                                    <option value="bank">Bank transfer</option>
                                    <option value="vodafone_cash">Vodafone cash</option>
                                </select>
                            </div>

                            <div class="w-full" v-if="withdrawRequest.payment_method" v-for="(paymentInfo, key) in payment_fields[withdrawRequest.payment_method]">
                                <div class="fv-row mb-7 fv-plugins-icon-container"  >
                                    <label class="required fs-6 fw-semibold form-label mb-2" v-text="paymentInfo.title"></label>
                                    <input id="kt_modal_inputmask" type="text" class="form-control form-control-solid" v-model="withdrawRequest.field[paymentInfo.code]" >
                                </div>
                            </div>
                            
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mb-2" v-text="translate('Add notes')"></label>
                                <textarea class="form-control form-control-solid rounded-3 mb-5" v-model="withdrawRequest.notes"></textarea>
                            </div>
                            <!--begin::Actions-->
                            <div class="text-center">
                                <button type="reset" id="kt_modal_adjust_balance_cancel" class="btn btn-light me-3" v-text="translate('Discard')" @click="showWizard = false"></button>

                                <button @click="sendWithdrawRequest" type="submit" id="kt_modal_adjust_balance_submit" class="btn btn-primary">
                                    <span class="indicator-label" v-text="translate('Submit')"></span>
                                </button>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
            <div class="card p-6">
                <div class="d-flex flex-wrap flex-sm-nowrap">
                    <div class="me-7 mb-4">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                            <img :src="auth.photo" class="w-20" alt="image" />
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
                                        v-text="auth.name"></a>
                                </div>
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
                            </div>
                            <div class="d-flex my-4">
                                <a @click="showEditSide = true" href="javascript:;" class="text-white btn btn-sm btn-primary me-3" v-text="translate('Edit')"></a>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap flex-stack">
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
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div class="fs-2 fw-bold" v-text="content.stats.drivers_count"></div>
                                                <div class="fs-6 fw-bold px-1" >/</div>
                                                <div class="fs-6 fw-bold" v-if="activeItem.business.subscription" v-text="checkFeatureLimit(activeItem.business.subscription.plan_features, 'Driver')"></div>
                                            </div>
                                        </div>
                                        <div class="fw-semibold fs-6 text-gray-500" v-text="translate('Drivers')"></div>
                                    </div>
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div class="fs-2 fw-bold" v-text="content.stats.vehicles_count"></div>
                                                <div class="fs-6 fw-bold px-1" >/</div>
                                                <div class="fs-6 fw-bold" v-if="activeItem.business.subscription" v-text="checkFeatureLimit(activeItem.business.subscription.plan_features, 'Vehicle')"></div>
                                            </div>
                                        </div>
                                        <div class="fw-semibold fs-6 text-gray-500" v-text="translate('Vehicles')"></div>
                                    </div>
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div class="fs-2 fw-bold" v-text="content.stats.trips_count"></div>
                                                <div class="fs-6 fw-bold px-1" >/ --</div>
                                            </div>
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
            </div>
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                <li class="nav-item mt-2" v-for="tab in tabsList">
                    <a v-if="checkRole(activeItem.role_id, tab.link)" @click="setActiveTab(tab.link)" :class="activeTab == tab.link ? 'active' : ''"
                        class="nav-link text-active-primary ms-0 me-10 py-5 " href="javascript:;" v-text="tab.title"></a>
                </li>
            </ul>

        <div class="w-full pt-9 pb-0">
            <div class="d-flex flex-column flex-lg-row">
                <div class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
                    <div class="card card-flush pt-3 mb-5 mb-xl-10"  v-if="activeTab == 'account'">
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
                                        <td class="text-success"  v-text="invoice.total_amount+''+currency.sumbol"></td>
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
                                                <span v-text="content.wallet ? (currency.sumbol+''+(content.wallet.credit_balance ?? '0')) : '0'"></span>
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
                                                <span  v-text="currency.sumbol"></span>
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
                                        <td class="text-success"  v-text="currency.sumbol+''+withdrawal.amount"></td>
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

                <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-300px mb-10 order-1 order-lg-2" v-if="activeItem.business">
                    <div class="card card-flush mb-0" data-kt-sticky="true" data-kt-sticky-name="subscription-summary" data-kt-sticky-offset="{default: false, lg: '200px'}" data-kt-sticky-width="{lg: '250px', xl: '300px'}" data-kt-sticky-left="auto" data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
                        <div class="card-header">
                            <div class="card-title"><h2 v-text="translate('Summary')"></h2></div>
                        </div>
                        <div class="card-body pt-0 fs-6">
                            <div class="mb-7">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-60px symbol-circle me-3">
                                        <img alt="Pic" :src="activeItem.picture ?? '/uploads/images/default_profile.png'">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-2" v-text="activeItem.name"></a>
                                        <a href="#" class="fw-semibold text-gray-600 text-hover-primary" v-text="activeItem.email"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="separator separator-dashed mb-7"></div>
                            <div class="mb-7" v-if="activeItem.business && activeItem.business.subscription">
                                <h5 class="mb-4" v-text="translate('Plan')"></h5>
                                <div class="mb-0">
                                    <span class="text-lg me-2" v-text="activeItem.business.subscription.plan_name"></span>
                                    <span class="fw-semibold text-gray-600" v-text="activeItem.business.subscription.plan ? (cost() + '' + currency.sumbol + ' /'+ activeItem.business.subscription.type) : ''"></span>
                                </div>
                            </div>
                            <!--end::Section-->
                            <div class="separator separator-dashed mb-7"></div>
                            <div class="mb-7" v-if="activeItem.business ">
                                <h5 class="mb-4" v-text="translate('Business')"></h5>
                                <div class="mb-4 fs-bold" v-text="activeItem.business.business_name"></div>
                            </div>
                            <!--end::Section-->

                            <!--begin::Seperator-->
                            <div class="separator separator-dashed mb-7"></div>
                            <!--end::Seperator-->

                            <!--begin::Section-->
                            <div class="mb-10" v-if="activeItem.business && activeItem.business.subscription">
                                <!--begin::Title-->
                                <h5 class="mb-4" v-text="translate('Subscription Details')"></h5>
                                <!--end::Title-->

                                <!--begin::Details-->
                                <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2">
                                    <!--begin::Row-->
                                    <tbody>
                                        <tr class="">
                                        <td class="text-gray-500" v-text="translate('Subscription ID')"></td>
                                        <td class="text-gray-800" v-text="activeItem.business.subscription.subscription_id"></td>
                                    </tr>
                                    </tbody>
                                    <tbody><tr class="">
                                        <td class="text-gray-500" v-text="translate('Upcoming renewal')"></td>
                                        <td class="text-gray-800" v-text="activeItem.business.subscription.end_date"></td>
                                    </tr>
                                </tbody></table>
                                <!--end::Details-->
                            </div>
                            <div class="mb-0">
                                <a href="javascript:;" class="btn btn-primary" id="kt_subscriptions_create_button">                
                                    Cancel Subscription
                                </a>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Card body-->
                    </div>
                </div>
            </div>

            
        </div>
        <side-form-update @callback="closeSide" :conf="conf" model="User.update" :item="activeItem"
            :model_id="activeItem.id" index="id" v-if="showEditSide" :columns="content.fillable" class="col-md-3" />

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
        const showWizard = ref(false);
        const activeItem = ref({});
        const content = ref({});
        const withdrawRequest = ref({'field':{}});
        const activeTab = ref('account');
        const tabsList = ref([
            { title: translate('Account'), link: 'account' },
            { title: translate('Settings'), link: 'settings' },
            { title: translate('Business info'), link: 'business_info' },
            { title: translate('Subscriptions'), link: 'subscriptions' },
            { title: translate('Invoices'), link: 'invoices' },
            { title: translate('Withdrawal'), link: 'withdrawal' },
        ]);


        
        const payment_fields = ref({
            'paypal': [
                { title: translate('Fullname'), type: '', code: 'fullname' },
                { title: translate('Email'), type: '', code: 'email' },
                { title: translate('Mobile'), type: '', code: 'mobile' },
            ],
            'paystack': [
                { title: translate('Fullname'), type: '', code: 'fullname' },
                { title: translate('Email'), type: '', code: 'email' },
                { title: translate('Mobile'), type: '', code: 'mobile' },
            ],
            'bank': [
                { title: translate('Fullname'), type: '', code: 'fullname' },
                { title: translate('Email'), type: '', code: 'email' },
                { title: translate('Mobile'), type: '', code: 'mobile' },
                { title: translate('Bank name'), type: '', code: 'bank_account_name' },
                { title: translate('Account name'), type: '', code: 'bank_name' },
                { title: translate('Account IBAN'), type: '', code: 'bank_iban' },
            ],
            'vodafone_cash': [
                { title: translate('Fullname'), type: '', code: 'fullname' },
                { title: translate('Mobile'), type: '', code: 'mobile' },
            ],
        });

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
            
            if (role_id == 1 && (tab == 'business_info' || tab == 'subscriptions' || tab == 'invoices' || tab == 'withdrawal')) 
                return false

            return true;
        }

        const upgradePlan = () => 
        {
            window.location.href = props.conf.url+'admin/get_started';
        }

        const cost = () => 
        {
            if ( activeItem.value.business && activeItem.value.business.subscription && activeItem.value.business.subscription.plan )
            {
                return  activeItem.value.business.subscription.type == 'monthly' ? activeItem.value.business.subscription.plan.monthly_cost : activeItem.value.business.subscription.plan.yearly_cost;
            }
            return 0;
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


        
        const sendWithdrawRequest = () => {
            if (!withdrawRequest.value.amount || withdrawRequest.value.amount < 1)
            {
                return showAlert(translate('Amount is required'));
            }
            
            if (withdrawRequest.value.amount > content.value.wallet.credit_balance)
            {
                return showAlert(translate('Balance is not enough'));
            }

            if (window.confirm(translate('Confirm to submit')))
            {
                var params = new URLSearchParams();
                params.append('type', 'BusinessWithdrawal.create')
                params.append('params[amount]', withdrawRequest.value.amount)
                params.append('params[wallet_id]', content.value.wallet.wallet_id)
                params.append('params[notes]', withdrawRequest.value.notes)
                params.append('params[field]', JSON.stringify(withdrawRequest.value.field))
                params.append('params[payment_method]', withdrawRequest.value.payment_method)
                handleRequest(params, '/api/create').then(response => {
                    handleAccess(response)
                });
            }

        }
        
        
        
        const cancelRequest = (withdrawal) => {
            
            if (window.confirm(translate('confirm_delete')))
            {
                var params = new URLSearchParams();
                params.append('type', 'BusinessWithdrawal.delete')
                params.append('params[withdrawal_id]', withdrawal.withdrawal_id)
                handleRequest(params, '/api/delete').then(response => {
                    handleAccess(response)
                });
            }
        }
        
        return {
            payment_fields,
            cancelRequest,
            sendWithdrawRequest,
            withdrawRequest,
            checkFeatureLimit,
            cost,
            upgradePlan,
            url,
            showAddSide,
            showEditSide,
            showWizard,
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
        'currency'
    ]
};
</script>
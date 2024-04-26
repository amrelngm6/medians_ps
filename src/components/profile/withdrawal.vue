<template>
    <div class="w-full" >
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
                    <div class="modal-body mx-5 mx-xl-15 my-7"  v-if="wallet">
                        <!--begin::Balance preview-->
                        <div class="d-flex text-center mb-9">
                            <div class="w-50 border border-dashed border-gray-300 rounded mx-2 p-4">
                                <div class="fs-6 fw-semibold mb-2 text-muted" v-text="translate('Current Balance')"></div>
                                <div class="fs-2 fw-bold" kt-modal-adjust-balance="current_balance" v-text="currency.sumbol+''+(wallet.credit_balance ?? '0')"></div>
                            </div>
                            <div class="w-50 border border-dashed border-gray-300 rounded mx-2 p-4">
                                <div class="fs-6 fw-semibold mb-2 text-muted" v-text="translate('Debit balance')"></div>
                                <div class="fs-2 fw-bold" kt-modal-adjust-balance="current_balance" v-text="currency.sumbol+''+(wallet.debit_balance ?? '0')"></div>
                            </div>
                        </div>
                        <!--end::Balance preview-->

                        <!--begin::Form-->
                        <div id="kt_modal_adjust_balance_form" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <label class="required fs-6 fw-semibold form-label mb-2" v-text="translate('Withdraw amount')"></label>
                                <input id="kt_modal_inputmask" type="number" class="form-control form-control-solid" v-model="withdrawRequest.amount" :max="wallet.credit_balance" inputmode="text">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                            <div class="fv-row mb-7 fv-plugins-icon-container" v-if="payment_fields" :key="payment_fields">
                                <label class="required fs-6 fw-semibold form-label mb-2" v-text="translate('Payment method')"></label>
                                <select  v-model="withdrawRequest.payment_method" class="form-select form-select-solid fw-bold" >
                                    <option v-for="method in payment_fields" v-text="method.name" :value="method.code"></option>
                                </select>
                            </div>

                            <div class="w-full" v-if="withdrawRequest.payment_method" v-for="method in payment_fields">
                                <div class="w-full" v-if="withdrawRequest.payment_method == method.code" v-for="(paymentInfo, key) in method.fields">
                                    <div class="fv-row mb-7 fv-plugins-icon-container"  >
                                        <label class="required fs-6 fw-semibold form-label mb-2" v-text="paymentInfo.title"></label>
                                        <input id="kt_modal_inputmask" type="text" class="form-control form-control-solid" v-model="withdrawRequest.field[paymentInfo.code]" >
                                    </div>
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
        <div class="card card-flush pt-3 mb-5 mb-xl-10" >
            <div class="card  card-xxl-stretch mb-5 mb-xxl-10">
                <div class="card-header">
                    <div class="card-title">
                        <h3 v-text="translate('Earnings')"></h3>
                    </div>
                </div>
                <div class="card-body pb-0">
                    <span class="fs-5 fw-semibold text-gray-600 pb-5 d-block"
                        v-text="translate('This is do not consider the debit balance')"></span>
                    <div class="d-flex flex-wrap justify-content-between pb-6">
                        <div class="d-flex flex-wrap">
                            <div class="border border-dashed border-gray-300 w-125px rounded my-3 p-4 me-6">
                                <span class="fs-2x fw-bold text-gray-800 lh-1" v-if="wallet">
                                    <span
                                        v-text="wallet ? (currency.sumbol + '' + (wallet.credit_balance ?? '0')) : '0'"></span>
                                </span>
                                <span class="fs-6 fw-semibold text-gray-500 d-block lh-1 pt-2"
                                    v-text="translate('Wallet balance')"></span>
                            </div>
                            <div class="border border-dashed border-gray-300 w-125px rounded my-3 p-4 me-6"
                                v-if="auth.business">
                                <span class="fs-2x fw-bold text-gray-800 lh-1" v-if="auth.business.subscription">
                                    <span class="counted"
                                        v-text="auth.business.subscription.is_paid ? system_setting.comission_paid_plan : system_setting.comission_free_plan"></span>%
                                </span>
                                <span class="fs-6 fw-semibold text-gray-500 d-block lh-1 pt-2"
                                    v-text="translate('Business Commisiion')"></span>
                            </div>
                            <div class="border border-dashed border-gray-300 w-125px rounded my-3 p-4 me-6">
                                <span class="fs-2x fw-bold text-gray-800 lh-1">
                                    <span v-text="currency.sumbol"></span>
                                    <span v-text="wallet ? (wallet.debit_balance ?? '0') : '0'"></span>
                                </span>
                                <span class="fs-6 fw-semibold text-gray-500 d-block lh-1 pt-2"
                                    v-text="translate('Debit balance')"></span>
                            </div>
                        </div>
                        <a href="#" @click="showWizard = true"
                            class="btn btn-bg-info text-white text-white px-6 flex-shrink-0 align-self-center"
                            v-text="translate('Withdraw Earnings')"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card  mb-5 mb-xl-10">
            <div class="card-header">
                <div class="card-title flex gap-4">
                    <h2 class="w-full" v-text="translate('Withdrawal requests')"></h2>
                </div>
            </div>
            <div class="card-body pt-2" v-if="business_withdrawals">
                <table id="kt_customer_details_invoices_table_1"
                    class="table align-middle table-row-dashed fs-6 fw-bold gs-0 gy-4 p-0 m-0">
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
                        <tr v-for="withdrawal in business_withdrawals">
                            <td v-text="withdrawal.payment_method"></td>
                            <td class="text-success" v-text="currency.sumbol + '' + withdrawal.amount"></td>
                            <td><span class="badge badge-light-warning" v-text="withdrawal.status"></span></td>
                            <td v-text="withdrawal.date"></td>
                            <td>
                                <a href="javascript:;" @click="cancelRequest(withdrawal)"
                                    class="btn btn-danger text-white px-6 flex-shrink-0 align-self-center"
                                    v-text="translate('Cancel')"></a>
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
import { translate, showAlert, handleAccess, handleRequest, handleGetRequest } from '@/utils.vue';

export default {

    components: {
    },
    setup(props) {

        const activeItem = ref({});
        const content = ref({});
        const withdrawRequest = ref({'field':{}});
        const showWizard = ref(false);

        activeItem.value = props.item;

        
        const payment_fields = ref([]);
        const loadPaymentMethods = () => {
            
            handleGetRequest('/admin/payment_methods?load=json').then(response => {
                console.log(response)
                payment_fields.value = response.items;
            });
        }

        loadPaymentMethods()

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

        const sendWithdrawRequest = () => {
            if (!withdrawRequest.value.amount || withdrawRequest.value.amount < 1)
            {
                return showAlert(translate('Amount is required'));
            }
            
            if (withdrawRequest.value.amount > props.wallet.credit_balance)
            {
                return showAlert(translate('Balance is not enough'));
            }

            if (window.confirm(translate('Confirm to submit')))
            {
                var params = new URLSearchParams(); 
                params.append('type', 'BusinessWithdrawal.create')
                params.append('params[amount]', withdrawRequest.value.amount)
                params.append('params[wallet_id]', props.wallet.wallet_id)
                params.append('params[notes]', withdrawRequest.value.notes)
                params.append('params[field]', JSON.stringify(withdrawRequest.value.field))
                params.append('params[payment_method]', withdrawRequest.value.payment_method)
                handleRequest(params, '/api/create').then(response => {
                    handleAccess(response)
                });
            }

        }
        

        return {
            payment_fields,
            activeItem,
            cancelRequest,
            withdrawRequest,
            sendWithdrawRequest,
            translate,
            showWizard,
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
        'item',
        'wallet',
        'business_withdrawals',
        'currency'
    ]
};
</script>
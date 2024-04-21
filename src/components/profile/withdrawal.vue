<template>
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
                                    v-text="wallet ? (system_setting.currency + '' + (wallet.credit_balance ?? '0')) : '0'"></span>
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
                                <span v-text="system_setting.currency"></span>
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
        <div class="card-header">
            <div class="card-title flex gap-4">
                <h2 class="w-full" v-text="translate('Withdrawal requests')"></h2>
            </div>
        </div>
        <div class="card-body pt-2" v-if="content.business_withdrawals">
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
                    <tr v-for="withdrawal in content.business_withdrawals">
                        <td v-text="withdrawal.payment_method"></td>
                        <td class="text-success" v-text="system_setting.currency + '' + withdrawal.amount"></td>
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
</template>
<script>

import { ref } from 'vue';
import { translate } from '@/utils.vue';

export default {

    components: {
    },
    setup(props) {

        const activeItem = ref({});

        activeItem.value = props.item;

        return {
            activeItem,
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
        'item',
        'wallet',
        'business_withdrawals',
    ]
};
</script>
<template>
    <div class="w-full" >
        
        <div class="card card-flush pt-3 mb-5 mb-xl-10" >
                
            <div class="card-header">
                <div class="card-title flex gap-4">
                    <h2 class="w-full" v-text="translate('Collected cash')"></h2>
                </div>
            </div>
            <div class="card-body pt-2" v-if="collected_cash">
                <table id="kt_customer_details_invoices_table_1"
                    class="table align-middle table-row-dashed fs-6 fw-bold gs-0 gy-4 p-0 m-0">
                    <thead class="border-bottom border-gray-200 fs-7 text-uppercase fw-bold">
                        <tr class="text-start text-gray-500">
                            <th class="min-w-100px" v-text="translate('Amount')"></th>
                            <th class="min-w-125px" v-text="translate('Date')"></th>
                        </tr>
                    </thead>
                    <tbody class="fs-6 fw-semibold text-gray-600">
                        <tr v-for="collected in collected_cash" v-if="collected">
                            <td class="text-success" v-text="system_setting.currency + '' + collected.amount"></td>
                            <td v-text="collected.date"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>

import { ref } from 'vue';
import { translate, showAlert, handleAccess, handleRequest } from '@/utils.vue';

export default {

    components: {
    },
    setup(props) {

        const activeItem = ref({});
        const collectedCashRequest = ref({'field':{}});
        const showWizard = ref(false);

        activeItem.value = props.item;

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

        const sendcollectedCashRequest = () => {
            if (!collectedCashRequest.value.amount || collectedCashRequest.value.amount < 1)
            {
                return showAlert(translate('Amount is required'));
            }
            
            if (collectedCashRequest.value.amount > props.wallet.debit_balance)
            {
                return showAlert(translate('Balance is not enough'));
            }

            if (window.confirm(translate('Confirm to submit')))
            {
                var params = new URLSearchParams();
                params.append('type', 'CollectedCash.create')
                params.append('params[amount]', collectedCashRequest.value.amount)
                params.append('params[wallet_id]', props.wallet.wallet_id)
                params.append('params[notes]', collectedCashRequest.value.notes)
                handleRequest(params, '/api/create').then(response => {
                    handleAccess(response)
                });
            }

        }
        

        return {
            activeItem,
            cancelRequest,
            collectedCashRequest,
            sendcollectedCashRequest,
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
        'collected_cash',
    ]
};
</script>
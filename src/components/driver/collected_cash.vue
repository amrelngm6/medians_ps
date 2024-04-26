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
                            <th class="min-w-100px" v-text="translate('ID')"></th>
                            <th class="min-w-100px" v-text="translate('Amount')"></th>
                            <th class="min-w-125px" v-text="translate('Date')"></th>
                        </tr>
                    </thead>
                    <tbody class="fs-6 fw-semibold text-gray-600">
                        <tr v-for="collected in collected_cash" >
                            <td v-text="collected.collection_id"></td>
                            <td class="text-success" v-text="currency.symbol + '' + collected.amount"></td>
                            <td v-text="collected.date"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>

import { translate } from '@/utils.vue';

export default {

    components: {
    },
    setup(props) {

        return {
            translate
        };
    },

    
    props: [
        'path',
        'lang',
        'setting',
        'system_setting',
        'conf',
        'auth',
        'collected_cash',
        'currency'
    ]
};
</script>
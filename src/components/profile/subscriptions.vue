<template>
    <div class="w-full mb-5 mb-xl-10">

        <div class="card mb-5 mb-xl-10" id="kt_profile_details_view"  v-if="activeItem.business">

            <div class="card  mb-5 mb-xl-10">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-7">
                            <h3 class="mb-2"><span v-text="translate('Active until')"></span> <span v-text="activeItem.business.subscription.end_date"></span></h3>
                            <p class="fs-6 text-gray-600 fw-semibold mb-6 mb-lg-15" v-text="translate('Upgrade Notification Note')"></p>
                            <div class="fs-5 mb-2">
                                <span class="text-gray-800 fw-bold me-1" ><span v-text="currency.symbol"></span><span v-text="activeItem.business.subscription.plan.monthly_cost"></span></span>
                                <span class="text-gray-600 fw-semibold" v-text="translate('Monthly')"></span>
                            </div>
                            <div class="flex fs-6 text-gray-600 fw-semibold gap-4"  v-if="activeItem.business">
                                <span v-text="translate('Your current plan') "></span>
                                <span class="font-semibold" v-text="activeItem.business.subscription.plan_name "></span>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="d-flex text-muted fw-bold fs-5 mb-3">
                                <span class="flex-grow-1 text-gray-800" v-text="translate('Plan Subscription Days')"></span>
                                <span class="text-gray-800"><span v-text="activeItem.business.subscription.past_days"></span> of <span v-text="activeItem.business.subscription.total_days"></span> <span v-text="translate('Days')"></span></span>
                            </div>
                            <div class="progress h-8px bg-light-primary mb-2">                                    
                                <div class="progress-bar bg-danger" role="progressbar" :style="{width: calcDaysWidth(activeItem)+'%'}" ></div>
                            </div>
                            <div class="fs-6 text-gray-600 fw-semibold mb-10"><span v-text="activeItem.business.subscription.left_days"></span> <span v-text="translate('Remaining Plan Days')"></span></div>
                            <div class="d-flex justify-content-end pb-0 px-0">
                                <button class="btn btn-danger text-white" @click="upgradePlan" v-text="translate('Upgrade Plan')"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card  mb-5 mb-xl-10">

            <div class="card-header">
                <div class="card-title flex gap-4">
                    <h2 class="w-full" v-text="translate('Subscriptions history')"></h2>
                </div>
            </div>
            <div class="card-body pt-2" v-if="subscriptions">
                <table id="kt_customer_details_invoices_table_1"
                    class="table align-middle table-row-dashed fs-6 fw-bold gs-0 gy-4 p-0 m-0">
                    <thead class="border-bottom border-gray-200 fs-7 text-uppercase fw-bold">
                        <tr class="text-start text-gray-500">
                            <th class="min-w-100px" v-text="translate('plan')"></th>
                            <th class="min-w-100px" v-text="translate('Start')"></th>
                            <th class="min-w-100px" v-text="translate('End')"></th>
                            <th class="min-w-125px" v-text="translate('payment type')"></th>
                            <th class="min-w-125px" v-text="translate('Type')"></th>
                        </tr>
                    </thead>
                    <tbody class="fs-6 fw-semibold text-gray-600">
                        <tr v-for="subscription in subscriptions">
                            <td class="fw-bold" v-text="subscription.plan_name"></td>
                            <td v-text="subscription.start_date"></td>
                            <td v-text="subscription.end_date"></td>
                            <td v-text="subscription.type"></td>
                            <td v-text="translate(subscription.is_paid ? 'Paid' : 'Unpaid')"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
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

        const calcDaysWidth = () => {
            let subscription = activeItem.value.business.subscription

            if (subscription.plan.type == 'paid')
            {
                return (subscription.past_days / subscription.total_days) * 100 ;
            }
        }
        const upgradePlan = () => 
        {
            window.location.href = props.conf.url+'admin/get_started';
        }

        return {
            upgradePlan,
            calcDaysWidth,
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
        'overview',
        'subscriptions'
    ]
};
</script>
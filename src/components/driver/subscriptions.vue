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
                                <span class="text-gray-800 fw-bold me-1" >$<span v-text="activeItem.business.subscription.plan.monthly_cost"></span></span>
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
    ]
};
</script>
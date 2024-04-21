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
                                <tr v-for="field in overview">
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
        'overview',
    ]
};
</script>
<template>
    <div class="w-full card mb-5 mb-xl-10">
        <div class="card-header">
                <div class="card-title flex gap-4">
                    <h2 class="w-full" v-text="translate('Latest trips')"></h2>
                </div>
            </div>
            <div class="card-body pt-2" v-if="trips">
                <table id="kt_customer_details_invoices_table_1"
                    class="table align-middle table-row-dashed fs-6 fw-bold gs-0 gy-4 p-0 m-0">
                    <thead class="border-bottom border-gray-200 fs-7 text-uppercase fw-bold">
                        <tr class="text-start text-gray-500">
                            
                            <th class="min-w-100px" v-text="translate('ID')"></th>
                            <th class="min-w-100px" v-text="translate('Locations')"></th>
                            <th class="min-w-100px" v-text="translate('Route')"></th>
                            <th class="min-w-100px" v-text="translate('Type')"></th>
                            <th class="min-w-100px" v-text="translate('Status')"></th>
                            <th class="min-w-125px" v-text="translate('Date')"></th>
                        </tr>
                    </thead>
                    <tbody class="fs-6 fw-semibold text-gray-600">
                        <tr v-for="trip in trips">
                            <td v-text="trip.trip_id"></td>
                            <td v-text="trip.locations.length"></td>
                            <td v-text="trip.route.route_name ?? ''"></td>
                            <td><span class=" " :class="trip.trip_type == 'going' ? 'badge-light-warning' : 'badge-light-success'" v-text="trip.trip_type"></span></td>
                            <td><span  v-text="trip.status"></span></td>
                            <td v-text="trip.date"></td>
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

        const upgradePlan = () => 
        {
            window.location.href = props.conf.url+'admin/get_started';
        }

        return {
            upgradePlan,
            activeItem,
            translate,
        };
    },

    props: [
        'path',
        'lang',
        'setting',
        'system_setting',
        'setting',
        'conf',
        'auth',
        'item',
        'trips',
    ]
};
</script>
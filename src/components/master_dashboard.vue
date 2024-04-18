<template>
    <div class="w-full overflow-auto" >

        <div class="top-0 py-2 w-full px-4 bg-gray-50 mt-0 sticky rounded" style="z-index:9">
            <div class="w-full flex gap-6">
                <h3 class="text-base lg:text-lg whitespace-nowrap" v-text="translate('Dashboard Reports')"></h3> 
                
                <div class="w-full">
                    <vue-tailwind-datepicker 
                        class="text-lg"
                        :formatter="formatter"
                        @update:model-value="handleSelectedDate($event)"
                        :separator="' - '+translate('To')+' - '"
                        v-model="dateValue" />
                </div>
            </div>
        </div>

        <div class="block w-full overflow-x-auto py-2">
            <div v-if="lang &&  setting" class="w-full overflow-y-auto overflow-x-hidden px-2 mt-6" >
                <div class="">
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
                        <dashboard_card_white  icon="/uploads/img/booking-unpaid.png" classes="bg-gradient-danger" :title="translate('Invoices')" :value="content.invoices_count"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/booking-paid.png" classes="bg-gradient-info" :title="translate('Businesses')" :value="content.businesses_count"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/booking_income.png" classes="bg-gradient-success" :title="translate('Customers')" :value="content.customers_count"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/products_icome.png" classes="bg-gradient-warning" :title="translate('Help messages')" :value="content.help_messages_count"></dashboard_card_white>
                    </div>
                    
                    <div class="w-full gap-4 lg:flex">
                        <div class="w-full">
                            <h4 class="text-base lg:text-lg " v-text="translate('Routes Trips')"></h4> 
                            <div class="w-full bg-white p-4 mb-4 rounded-lg" v-if="content.trips_charts">
                                <ag-charts-vue :key="line_options" :options="line_options"> </ag-charts-vue>
                            </div>
                        </div>
                        <div class="w-full">
                            <h4 class="text-base lg:text-lg " v-text="translate('Private Trips')"></h4> 
                            <div class="w-full bg-white p-4 mb-4 rounded-lg" v-if="content.private_trips_charts">
                                <ag-charts-vue :key="line_options2" :options="line_options2"> </ag-charts-vue>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="w-full lg:flex gap gap-6 pb-6">
                    <div class="card mb-0 w-1/3">
                        
                        <div class="w-full p-4">
                            <div class="w-full flex gap-2">
                                <h4 class="w-full ml-4" v-text="translate('Top businesses')"></h4>
                                <a href="/admin/companies" class="w-24" v-text="translate('Companies')"></a>
                                <a href="/admin/schools" class="w-24" v-text="translate('Schools')"></a>
                            </div>
                            <p class="text-sm text-gray-500 px-4 mb-6" v-text="translate('top_businesses_who_have_most_route_locations')"></p>
                        </div>
                        <div class="card-body w-full">
                            <div class="w-full" v-if="content.top_businesses">
                                <ag-charts-vue :key="pie_options" :options="pie_options"> </ag-charts-vue>
                            </div>
                        </div>
                    </div>
                    <div class="card w-1/3 lg:w-1/3 lg:mb-0">
                        
                        <div class="w-full p-4">
                            <div class="w-full flex ">
                                <h4 class="w-full ml-4" v-text="translate('New subscriptions')"></h4>
                                <a href="/admin/plan_subscriptions" class="w-20" v-text="translate('View all')"></a>
                            </div>
                            <p class="text-sm text-gray-500 px-4 mb-2" v-text="translate('Latest subscriptions request has been sent')"></p>
                        </div>
                        <div class="card-body w-full">
                            <div class="w-full ">
                                <div class="table-responsive w-full">
                                    <table class="w-full table table-striped table-nowrap custom-table mb-0 datatable">
                                        <thead>
                                            <tr>
                                                <th v-text="translate('User')"></th>
                                                <th v-text="translate('subscription')"></th>
                                                <th v-text="translate('Type')"></th>
                                            </tr>
                                        </thead>
                                        <tbody v-if="content.plan_subscriptions"  :key="content.plan_subscriptions">
                                            <tr :key="index" v-for="(subscription, index) in content.plan_subscriptions"  >
                                                <td>
                                                    <div class="flex gap-4 w-full" v-if="subscription && subscription.user">
                                                        <img width="48" height="48" class="h-10 w-10 rounded-full" :src="'/app/image.php?w=50&h=50&src='+(subscription.user.picture ?? '/uploads/images/default_profile.png')" />
                                                        <div class="text-left">
                                                            <p class="m-0" v-text="subscription.user.name"></p>
                                                            <p class="m-0" v-text="subscription.user.business ? subscription.user.business.business_name : ''"></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td v-text="subscription.plan_name ?? ''"></td>
                                                <td v-text="subscription.type"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card w-1/3 lg:w-1/3 lg:mb-0">
                        
                        <div class="w-full p-4">
                            <div class="w-full flex ">
                                <h4 class="w-full ml-4" v-text="translate('Latest help messages')"></h4>
                                <a href="/admin/help_messages" class="w-20" v-text="translate('View all')"></a>
                            </div>
                            <p class="text-sm text-gray-500 px-4 mb-2" v-text="translate('Latest tickets & help messages sent by users')"></p>
                        </div>
                        <div class="card-body w-full">
                            <div class="w-full">
                                <div class="table-responsive w-full">
                                    <table class="w-full table table-striped table-nowrap custom-table mb-0 datatable">
                                        <thead>
                                            <tr>
                                                <th v-text="translate('name')"></th>
                                                <th v-text="translate('title')"></th>
                                                <th v-text="translate('date')"></th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr :key="index" v-for="(message, index) in content.latest_help_messages" >
                                                <td>
                                                    <div v-if="message.user" class="flex gap-2">
                                                        <img :src="message.user.picture ?? '/uploads/images/default_profile.png'" width="40" height="40" class="w-10 h-10 rounded" />
                                                        <div>
                                                            <p class="m-0" v-text="message.user.name"></p>
                                                            <span class="text-xs"v-text="message.user.usertype"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-red-500" v-text="message.title"></td>
                                                <td v-text="dateFormat(message.created_at)"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {ref} from 'vue';
import moment from 'moment';
import dashboard_card from '@/components/includes/dashboard_card.vue';
import dashboard_card_white from '@/components/includes/dashboard_card_white.vue';
import dashboard_center_squares from '@/components/includes/dashboard_center_squares.vue';
import {translate, handleGetRequest} from '@/utils.vue';

import { AgChartsVue } from 'ag-charts-vue3';
import VueTailwindDatepicker from "vue-tailwind-datepicker";

export default 
{
    components:{
        dashboard_center_squares,
        dashboard_card_white,
        dashboard_card,
        AgChartsVue,
        VueTailwindDatepicker
    },
    name:'categories',
    setup(props) {

        const url =  ref(props.path + '?load=json');

        const line_options = ref();
        const line_options2 = ref();
        const pie_options = ref();
        const column_options = ref();

        const content = ref({});

        const activeDate = ref();

        
        const load = (path) =>
        {
            handleGetRequest( path ).then(response=> {
                content.value = JSON.parse(JSON.stringify(response)); 
                setCharts(response)
            });
        }

    
        /**
         * Switch date filters
         * 
         */
        const switchDate = (start) =>
        {
            let filters = '&'
            filters += 'start=' + start 
            filters += '&end='
            filters += (start == 'yesterday') ? 'yesterday' : 'today';

            // Update active date filters
            activeDate.value = start;

            // Load new data
            load(url.value + filters); 
        }

        switchDate('-30days');

        /**
         * Date Time format 
         */
         const dateTimeFormat = (date) =>
        {
            return moment(date).format('YYYY-MM-DD HH:mm a');
        }

        /**
         * Date Time format 
         */
         const dateFormat = (date) =>
        {
            return moment(date).format('YYYY-MM-DD');
        }


        const optionsbar = ref();

        
        /**
         * Set charts based on their values type
         */ 
        const setCharts = (data) => {

            // Line charts for sales in last days 
            line_options.value  =  {

                // Line charts Data 
                data: content.value.trips_charts,

                // Series: Defines which chart type and data to use
                series: [
                    { type: 'bar', xKey: 'label', yKey: 'y' },
                    // { type: 'line', xKey: 'label', yKey: 'y' },
                ],
            };

            // Line charts for sales in last days 
            line_options2.value  =  {

                // Line charts Data 
                data: content.value.private_trips_charts,

                // Series: Defines which chart type and data to use
                series: [
                    { type: 'bar', xKey: 'label', yKey: 'y' },
                    // { type: 'line', xKey: 'label', yKey: 'y' },
                ],
            };

            
            // Line charts for sales in last days 
            pie_options.value  =  {

                // Line charts Data 
                data: content.value.top_businesses,

                // Series: Defines which chart type and data to use
                series: [
                    { type: 'pie', legendItemKey: 'business_name', angleKey: 'y' },
                ],
            };
        }



        const dateValue = ref({
            startDate: "",
            endDate: "",
        });

        const formatter = ref({
            date: "YYYY-MM-DD",
            month: "MMM",
        });

        const handleSelectedDate = (event) => {
            handleGetRequest( props.conf.url+props.path+'?start_date='+event.startDate+'&end_date='+event.endDate+'&load=json' ).then(response=> {
                content.value = JSON.parse(JSON.stringify(response))
                setCharts(content);
            });
        }
        
        return {
            handleSelectedDate,
            switchDate,
            optionsbar,
            translate,
            line_options,
            line_options2,
            pie_options,
            content,
            activeDate,
            dateTimeFormat,
            dateFormat,
            dateValue,
            formatter,
            
        }
    },
    props: [
        'lang',
        'setting',
        'conf',
        'path',
        'auth',
    ]
};
</script>
<style lang="css">
    .rtl #side-cart-container
    {
        right: auto;
        left:0;
    }
    canvas {
        max-width: 100%;
    }
</style>
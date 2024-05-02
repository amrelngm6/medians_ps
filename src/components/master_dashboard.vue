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

        <dashboard_chart v-if="line_options" :key="line_options" :options="line_options" /> 
        <!-- <dashboard_chart v-if="content.trips_charts" :key="content" :content="content.trips_charts" :title="translate('Route trips')" />  -->
        <!-- <dashboard_chart v-if="content.top_businesses" :key="content" :content="content" :title="translate('top_businesses')" />  -->

        <div class="block w-full overflow-x-auto py-2">
            <div v-if="lang &&  setting" class="w-full overflow-y-auto overflow-x-hidden px-2 mt-6" >
                <div class="w-full gap-6 flex ">
                    <div class="card card-flush h-md-50 mb-5 mb-xl-10 w-full">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">   
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start" v-text="currency.symbol"></span>
                                    <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2" v-text="content.total_invoices_amount"></span>
                                </div>
                                <span class="text-gray-500 pt-1 fw-semibold fs-6" v-text="translate('Total invoices amount')"></span>
                            </div>
                        </div>

                        <div class="px-4 pt-2 pb-4 d-flex align-items-center">
                            <div class="d-flex flex-center me-5 pt-2"></div>
                            <div class="d-flex flex-column content-justify-center w-100">
                                <div class="d-flex gap-4 fs-6 fw-semibold align-items-center" v-for="invoice in content.payment_methods_invoices_amount">
                                    <div class=" rounded-2  my-3"><img class="w-10 h-10" :src="'/uploads/img/payment_methods/'+invoice.payment_method.toLowerCase()+'.png'" /></div>
                                    <div class="text-gray-500 flex-grow-1 me-4" v-text="invoice.payment_method"></div>
                                    <div class="fw-bolder text-gray-700 text-xxl-end" v-text="currency.symbol+''+invoice.value"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex flex-column h-100 w-full">
                        <div class="w-full flex gap-4">
                            <div class="mb-7 w-full">
                                <div class="d-flex flex-stack mb-6">
                                    <div class="flex-shrink-0 me-5">
                                        <span class="text-gray-500 fs-7 fw-bold me-2 d-block lh-1 pb-1" v-text="translate('Welcome')"></span>
                                        <span class="text-gray-800 fs-1 fw-bold" v-text="auth.name"></span>
                                        <span class="badge badge-light-primary flex-shrink-0 align-self-center py-3 px-4 fs-7" v-text="translate('Active')"></span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center flex-wrap d-grid gap-2">
                                    <div class="d-flex align-items-center me-5 me-xl-13">
                                        <img :src="system_setting['logo'] ?? '/uploads/images/default_logo.png'" class="h-20" alt="">                                                    
                                    </div>                    
                                </div>
                            </div>
                            <img :src="'/uploads/img/dashboard-placeholder.svg'" />

                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
                        <dashboard_card_white  icon="/uploads/img/booking-unpaid.png" classes="bg-dark" text_class="text-gray-300" value_class="text-white" :title="translate('Invoices')" :value="content.invoices_count"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/booking-paid.png" classes="bg-info" text_class="text-gray-300" value_class="text-white"  :title="translate('Businesses')" :value="content.businesses_count"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/booking_income.png" classes="bg-success"  text_class="text-gray-300" value_class="text-white"  :title="translate('Customers')" :value="content.customers_count"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/products_icome.png" classes="bg-danger"  text_class="text-gray-300" value_class="text-white"  :title="translate('Help messages')" :value="content.help_messages_count"></dashboard_card_white>
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
                            <p class="text-sm text-gray-500 px-4 mb-2" v-text="translate('Latest plan subscriptions')"></p>
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
                <div class="card  w-full  no-mobile">
                    <div class="w-full flex p-4">
                        <h4 class="w-full " v-text="translate('Latest invoices')"></h4>
                        <a href="/admin/invoices" class="w-20" v-text="translate('View all')"></a>
                    </div>
                    <div class="card-body w-full">
                        <div class="w-full">
                            <div class="table-responsive w-full">
                                <table class="w-full table table-striped table-nowrap custom-table mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th v-text="translate('User')"></th>
                                            <th v-text="translate('Amount')"></th>
                                            <th v-text="translate('Payment method')"></th>
                                            <th v-text="translate('Code')"></th>
                                            <th v-text="translate('date')"></th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <tr :key="index" v-for="(invoice, index) in content.latest_invoices" >
                                            <td>
                                                <div v-if="invoice.user" class="flex gap-2">
                                                    <img :src="invoice.user.picture ?? '/uploads/images/default_profile.png'" width="40" height="40" class="w-10 h-10 rounded" />
                                                    <div>
                                                        <p class="m-0" v-text="invoice.user.name"></p>
                                                        <small  v-if="invoice.user" class="text-xs" v-text="invoice.user.usertype"></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td v-text="currency.symbol + '' + invoice.total_amount"></td>
                                            <td v-text="invoice.payment_method"></td>
                                            <td v-text="invoice.code"></td>
                                            <td v-text="dateTimeFormat(invoice.created_at)"></td>
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
</template>
<script>
import {ref} from 'vue';
import moment from 'moment';
import dashboard_card from '@/components/includes/dashboard_card.vue';
import dashboard_chart from '@/components/includes/dashboard_chart.vue';
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
        dashboard_chart,
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
                setCharts(JSON.parse(JSON.stringify(response)))
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

        
        const labels = ref([]);
        const route_data = ref([]);
        const private_data = ref([]);
        /**
         * Set charts based on their values type
         */ 
        const setCharts = (data) => {

            
            if (data)
            {
                filterLabels();

                for (let i = 0; i < labels.value.length; i++)  {
                    route_data.value[i] = filterData(labels.value[i], content.value.trips_charts ) ?? 0
                    private_data.value[i] = filterData(labels.value[i], content.value.private_trips_charts) ?? 0
                }

                line_options.value  =  {
                    labels: labels.value.filter(item => item !== ""),
                    datasets: [
                    {
                        label: translate('Private Trips'),
                        backgroundColor: 'rgba(151, 187, 205, 0.2)',
                        borderColor: 'rgba(151, 187, 205, 1)',
                        pointBackgroundColor: 'rgba(151, 187, 205, 1)',
                        pointBorderColor: '#fff',
                        data: private_data.value
                    },{
                        label: translate('Routes Trips'),
                        backgroundColor: 'rgba(151, 187, 205, 0.2)',
                        borderColor: 'rgba(151, 187, 205, 1)',
                        pointBackgroundColor: 'rgba(151, 187, 205, 1)',
                        pointBorderColor: '#fff',
                        data: route_data.value
                    }
                    ]
                };
            }

            // Line charts for sales in last days 
            line_options2.value  =  {

                // Line charts Data 
                data: data.private_trips_charts,

                // Series: Defines which chart type and data to use
                series: [
                    { type: 'bar', xKey: 'label', yKey: 'y' },
                    // { type: 'line', xKey: 'label', yKey: 'y' },
                ],
            };

            
            // Line charts for sales in last days 
            pie_options.value  =  {

                // Line charts Data 
                data: data.top_businesses,

                // Series: Defines which chart type and data to use
                series: [
                    { type: 'pie', legendItemKey: 'business_name', angleKey: 'y' },
                ],
            };
        }

        const filterLabels =  async () => {
            for (let i = 0; i < content.value.trips_charts.length; i++)  {
                labels.value[i] = content.value.trips_charts[i].label;
            }
            for (let i = 0; i < content.value.private_trips_charts.length; i++)  {
                const privateElement = content.value.private_trips_charts[i];
                if (!labels.value.find((element) => element == privateElement.label))
                {
                    labels.value[i+content.value.trips_charts.length] = privateElement.label;
                }
            }
            
        }

        const filterData =  async (label, list) => 
        {

            for (let i = 0; i < list.length; i++)  {
                const trip = list[i];
                if (trip.label == label && list[i].y)
                {
                    return  trip.y;
                }
            }
            
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
        'system_setting',
        'conf',
        'path',
        'auth',
        'currency'
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
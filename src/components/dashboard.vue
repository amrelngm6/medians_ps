<template>
    <div class="w-full overflow-auto" style="height: 85vh; z-index: 9999;">

        <div class="top-0 py-2 w-full px-4 bg-gray-50 mt-0 sticky rounded" style="z-index:9">
            <div class="w-full flex gap-6">
                <h3 class="text-base lg:text-lg whitespace-nowrap" v-text="translate('Dashboard Reports')"></h3> 
                <ul class="w-full flex gap-4 ">
                    <li v-for="item in dates_filters" @click="switchDate(item.value)" :class="(activeDate == item.value) ? 'font-semibold' : ''" class="cursor-pointer" v-text="translate(item.title)"></li>
                </ul>
            </div>
        </div>

        <div class="block w-full overflow-x-auto py-2">
            <div v-if="lang &&  setting" class="w-full overflow-y-auto overflow-x-hidden px-2 mt-6" >
                <div class="">
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
                        <dashboard_card_white  icon="/uploads/img/booking-unpaid.png" classes="bg-gradient-danger" :title="translate('active_trips')" :value="content.active_trips_count"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/booking-paid.png" classes="bg-gradient-info" :title="translate('completed_trips')" :value="content.completed_trips_count"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/booking_income.png" classes="bg-gradient-success" :title="translate('total_trips')" :value="content.total_trips_count"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/products_icome.png" classes="bg-gradient-warning" :title="translate('help_messages')" :value="content.help_messages_count"></dashboard_card_white>
                    </div>
                    
                    <div class="w-full bg-white p-4 mb-4 rounded-lg">
                        <ag-charts-vue ref="lines" :key="line_options" :options="line_options"> </ag-charts-vue>
                    </div>
                    <div class="row mt-6">
                        <dashboard_card class="col-md-3 col-sm-12" classes="bg-gradient-success" :title="translate('Vehciles')" :value="content.vehicles_count"></dashboard_card>
                        <dashboard_card class="col-md-3 col-sm-12" classes="bg-gradient-danger" :title="translate('Drivers')" :value="content.drivers_count"></dashboard_card>
                        <dashboard_card class="col-md-3 col-sm-12" classes="bg-gradient-primary" :title="translate('Routes')" :value="content.routes_count"></dashboard_card>
                        <dashboard_card class="col-md-3 col-sm-12" classes="bg-gradient-purple" :title="translate('Pickup locations')" :value="content.pickup_locations_count" ></dashboard_card>
                    </div>
                </div>
                
                <div class="w-full lg:flex gap gap-6 pb-6">
                    <div class="card mb-0 w-2/3">
                        <h4 class="p-4 ml-4" v-text="translate('Top drivers')"></h4>
                        <p class="text-sm text-gray-500 px-4 mb-6" v-text="translate('top_drivers_who_have_most_trips')"></p>
                        <div class="card-body w-full">
                            <div class="w-full">
                                <!-- <ag-charts-vue ref="columns" :key="column_options" :options="column_options"> </ag-charts-vue> -->
                            </div>
                        </div>
                    </div>
                    <div class="card w-1/3 lg:w-1/3 lg:mb-0">
                        <h4 class="p-4 ml-4" v-text="translate('Latest students')"></h4>
                        <p class="text-sm text-gray-500 px-4 mb-6" v-text="translate('latest_students_has_been_added')"></p>
                        <div class="card-body w-full">
                            <div class="w-full ">
                                <div class="table-responsive w-full">
                                    <table class="w-full table table-striped table-nowrap custom-table mb-0 datatable">
                                        <thead>
                                            <tr>
                                                <th colspan="2" v-text="translate('Student')"></th>
                                                <th v-text="translate('Contact')"></th>
                                            </tr>
                                        </thead>
                                        <tbody v-if="content.latest_students">
                                            <tr :key="index" v-for="(student, index) in content.latest_students" class="text-center" v-if="student">
                                                <td><img width="48" height="48" class="rounded" :src="'/app/image.php?w=50&h=50&src='+student.picture" /></td>
                                                <td v-text="student.first_name"></td>
                                                <td  v-text="student.contact_number"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:flex gap gap-6 pb-6 ">

                    <div class="card  w-full  no-mobile">
                        <div class="w-full flex p-4">
                            <h4 class="w-full " v-text="translate('Latest help messages')"></h4>
                            <a href="/admin/help_messages" class="w-20" v-text="translate('View all')"></a>
                        </div>
                        <div class="card-body w-full">
                            <div class="w-full">
                                <div class="table-responsive w-full">
                                    <table class="w-full table table-striped table-nowrap custom-table mb-0 datatable">
                                        <thead>
                                            <tr>
                                                <th v-text="translate('name')"></th>
                                                <th v-text="translate('subject')"></th>
                                                <th v-text="translate('message')"></th>
                                                <th v-text="translate('date')"></th>
                                                <th v-text="translate('status')"></th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr :key="index" v-for="(message, index) in content.latest_help_messages" class="text-center">
                                                <td class="flex gap-2">
                                                    <img v-if="message.user" :src="message.user.picture" width="24" height="24" class="rounded" />
                                                    <span v-if="message.user" v-text="message.user.name"></span>
                                                </td>
                                                <td v-text="message.subject"></td>
                                                <td class="text-red-500" v-text="message.message"></td>
                                                <td v-text="dateTimeFormat(message.created_at)"></td>
                                                <td v-text="message.date"></td>
                                                <td v-text="message.status"></td>
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

export default 
{
    components:{
        dashboard_center_squares,
        dashboard_card_white,
        dashboard_card,
        AgChartsVue,
        // medians_datepicker,
    },
    name:'categories',

    setup(props) {

        const url =  props.conf.url+props.path+'?load=json';

        const line_options = ref();
        const pie_options = ref();
        const column_options = ref();

        const content = ref({});

        const activeDate = ref('today');

        const dates_filters = [
            {title: translate('Today'), value: 'today'},
            {title: translate('Yesterday'), value: 'yesterday'},
            {title: translate('Last week'), value: '-7days'},
            {title: translate('Last month'), value: '-30days'},
            {title: translate('Last year'), value: '-365days'}
        ];

        
        const load = (url) =>
        {
            handleGetRequest( url ).then(response=> {
                setCharts(response)
                content.value = JSON.parse(JSON.stringify(data)); 
            });
        }

        load();

    
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

        /**
         * Date Time format 
         */
        const dateTimeFormat = (date) =>
        {
            return moment(date).format('YYYY-MM-DD HH:mm a');
        }


        
        /**
         * Set charts based on their values type
         */ 
        const setCharts = (data) => {
            
            // // Pie charts for most played Games
            // pie_options.value = JSON.parse(JSON.stringify(charts_options.value));
            // pie_options.value.data[0] = {
            //     type: "pie",
            //     yValueFormatString: "#,### "+translate('Students'),
            //     dataPoints: content.value.latest_students
            // }
            
            // // Column charts for most played on devices
            // let columnOptions = JSON.parse(JSON.stringify(charts_options.value));
            // columnOptions.axisY.title = translate('Trips count')
            // columnOptions.data[0] = {
            //     type: "column",
            //     yValueFormatString: "#,### "+translate('Trips count'),
            //     dataPoints: content.value.top_drivers
            // }

            // column_options.value = columnOptions;

            // Line charts for sales in last days 
            let lineOptions =  {
                data: [
                    { month: 'Jan', avgTemp: 2.3, iceCreamSales: 162000 },
                    { month: 'Mar', avgTemp: 6.3, iceCreamSales: 302000 },
                    { month: 'May', avgTemp: 16.2, iceCreamSales: 800000 },
                    { month: 'Jul', avgTemp: 22.8, iceCreamSales: 1254000 },
                    { month: 'Sep', avgTemp: 14.5, iceCreamSales: 950000 },
                    { month: 'Nov', avgTemp: 8.9, iceCreamSales: 200000 },
                ],
                // Series: Defines which chart type and data to use
                series: [{ type: 'bar', xKey: 'month', yKey: 'iceCreamSales' }],
                
            };

            line_options.value = lineOptions;
        }


        return {
            translate,
            line_options,
            dates_filters,
            content,
            activeDate,
            date:null,
            dateTimeFormat,
            charts_options:{
                animationEnabled: true,
                exportEnabled: true,
                axisX: {
                  labelTextAlign: "right"
                },

                axisY: {
                  title: translate('trips_count'),
                  suffix: ""
                },
                data: [{}]
            }
        }
    },
    props: [
        'lang',
        'setting',
        'conf',
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
</style>
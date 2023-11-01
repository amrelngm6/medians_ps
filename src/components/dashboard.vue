<template>
    <div class="w-full overflow-auto" style="height: 85vh; z-index: 9999;">


        <div class="top-0 py-2 w-full px-2 bg-gray-100 mt-0 sticky" style="z-index:9">
            <div class="w-full flex gap-6">
                <h3 class="text-base lg:text-lg whitespace-nowrap" v-text="__('Dashboard Reports')"></h3> 
                <ul class="w-full flex gap-4 ">
                    <li v-for="item in dates_filters" v-if="item" @click="switchDate(item.value)" :class="(activeDate == item.value) ? 'font-semibold' : ''" class="cursor-pointer" v-text="__(item.title)"></li>
                </ul>
            </div>
        </div>

        <div class="block w-full overflow-x-auto py-2">
            <div v-if="lang && !showLoader && setting" class="w-full overflow-y-auto overflow-x-hidden px-2 mt-6" >
                <div class="">
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
                        <dashboard_card_white  icon="/uploads/img/booking-unpaid.png" classes="bg-gradient-danger" :title="__('active_trips')" :value="content.active_trips_count"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/booking-paid.png" classes="bg-gradient-info" :title="__('completed_trips')" :value="content.completed_trips_count"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/booking_income.png" classes="bg-gradient-success" :title="__('total_trips')" :value="content.total_trips_count"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/products_icome.png" classes="bg-gradient-warning" :title="__('help_messages')" :value="content.help_messages_count"></dashboard_card_white>
                    </div>
                    <div class="w-full bg-white p-4 mb-4 rounded-lg" v-if="content.trips_charts && content.trips_charts.length">
                        <CanvasJSChart v-if="showCharts && content.trips_charts.length" :key="line_options" :options="line_options"/>
                    </div>
                    <div class="row mt-6">
                        <dashboard_card classes="bg-gradient-success" :title="__('Vehciles')" :value="content.vehicles_count"></dashboard_card>
                        <dashboard_card classes="bg-gradient-danger" :title="__('Drivers')" :value="content.drivers_count"></dashboard_card>
                        <dashboard_card classes="bg-gradient-primary" :title="__('Routes')" :value="content.routes_count"></dashboard_card>
                        <dashboard_card classes="bg-gradient-purple" :title="__('Pickup locations')" :value="content.pickup_locations_count" ></dashboard_card>
                    </div>
                </div>
                <div class="w-full lg:flex gap gap-6 pb-6">
                    <dashboard_center_squares :content="content" :setting="setting" />
                    <div class="card mb-0 w-full">
                        <h4 class="p-4 ml-4" v-text="__('most_played_games')"></h4>
                        <p class="text-sm text-gray-500 px-4 mb-6" v-text="__('top_5_games_used_for_playing')"></p>
                        <div class="card-body w-full">
                            <div class="w-full">
                                <CanvasJSChart v-if="content.most_played_games && showCharts && content.most_played_games.length" :key="pie_options" :options="pie_options"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:flex gap gap-6 pb-6">
                    <div class="card mb-0 w-2/3">
                        <h4 class="p-4 ml-4" v-text="__('most_played_devices')"></h4>
                        <p class="text-sm text-gray-500 px-4 mb-6" v-text="__('top_5_devices_used_for_playing')"></p>
                        <div class="card-body w-full">
                            <div class="w-full">
                                <CanvasJSChart v-if="showCharts && content.most_played_devices && content.most_played_devices.length" :key="column_options" :options="column_options"/>
                            </div>
                        </div>
                    </div>
                    <div class="card w-1/3 lg:w-1/3 lg:mb-0">
                        <h4 class="p-4 ml-4" v-text="__('Top drivers')"></h4>
                        <p class="text-sm text-gray-500 px-4 mb-6" v-text="__('latest_5_bookings_has_been_paid')"></p>
                        <div class="card-body w-full">
                            <div class="w-full ">
                                <div class="table-responsive w-full">
                                    <table class="w-full table table-striped table-nowrap custom-table mb-0 datatable">
                                        <thead>
                                            <tr>
                                                <th colspan="2" v-text="__('Driver')"></th>
                                                <th v-text="__('Trips')"></th>
                                            </tr>
                                        </thead>
                                        <tbody v-if="content.top_drivers">
                                            <tr :key="index" v-for="(driver, index) in content.top_drivers" class="text-center" v-if="driver">
                                                <td><img :src="driver.picture" /></td>
                                                <td v-text="driver.name"></td>
                                                <td  v-text="driver.last_trips_count"></td>
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
                        <h4 class="p-4 ml-4" v-text="__('latest_sold_products')"></h4>
                        <hr />
                        <div class="card-body w-full">
                            <div class="w-full">
                                <div class="table-responsive w-full">
                                    <table class="w-full table table-striped table-nowrap custom-table mb-0 datatable">
                                        <thead>
                                            <tr>
                                                <th v-text="__('name')"></th>
                                                <th v-text="__('price')"></th>
                                                <th v-text="__('date')"></th>
                                                <th v-text="__('invoice')"></th>
                                                <th v-text="__('by')"></th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr :key="index" v-for="(item, index) in content.latest_order_products" class="text-center">
                                                <td>
                                                    <a :href="'/admin/products/edit/'+item.product.id">{{item.product.name}}</a>
                                                </td>
                                                <td class="text-red-500">{{item.product.price}} {{setting.currency}}</td>
                                                <td v-text="dateTimeFormat(item.created_at)"></td>
                                                <td><a target="_blank" :href="'/admin/invoices/show/'+item.invoice.code">{{item.invoice.code}}</a></td>
                                                <td v-text="item.user ? item.user.name : ''"></td>
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
import dashboard_card from './includes/dashboard_card';
import dashboard_card_white from './includes/dashboard_card_white';
import dashboard_center_squares from './includes/dashboard_center_squares';
import moment from 'moment';
import CanvasJSChart from './canvasjs/CanvasJSVueComponent.vue';

export default 
{
    components:{
        dashboard_center_squares,
        dashboard_card_white,
        dashboard_card,
        CanvasJSChart
        // medians_datepicker,
    },
    name:'categories',
    data() {
        return {
            url: '/dashboard?load=json',
            content: {

                pie_options:{},
                column_options:{},
                line_options:{},
                most_played_devices: [],
                latest_paid_order_devices: [],
                latest_order_products: [],
                trips_charts: [],
                revenue: 0,
                most_played_games: [],
                latest_paid_bookings: 0,
                latest_sold_products: 0,
            },
            dates_filters:[
                {title: this.__('Today'), value: 'today'},
                {title: this.__('Yesterday'), value: 'yesterday'},
                {title: this.__('Last week'), value: '-7days'},
                {title: this.__('Last month'), value: '-30days'},
                {title: this.__('Last year'), value: '-365days'}
            ],
            activeDate:'today',
            date:null,
            filters:null,
            showLoader: false,
            showCharts: false,
            charts_options:{
                animationEnabled: true,
                exportEnabled: true,
                axisX: {
                  labelTextAlign: "right"
                },

                axisY: {
                  title: this.__('trips_count'),
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
    ],
    mounted: function() 
    {
        this.load(this.url)
    },

    methods: 
    {
        /**
         * Switch date filters
         * 
         */
        switchDate(start)
        {
            this.filters = '&'
            this.filters += 'start=' + start 
            this.filters += '&end='
            this.filters += (start == 'yesterday') ? 'yesterday' : 'today';

            // Update active date filters
            this.activeDate = start;

            // Load new data
            this.load(this.url+this.filters); 
        },


        /**
         * Date Time format 
         */
        dateFormat(date)
        {
            return moment(date).format('YYYY-MM-DD');
        },

        /**
         * Date Time format 
         */
        dateTimeFormat(date)
        {
            return moment(date).format('YYYY-MM-DD HH:mm a');
        },

        /**
         * 
         */
        changeLoad()
        {
            console.log('changed')
            // console.log(this.load(this.url+'&start='+))
        },  
        load(url)
        {
            // this.showLoader = true;
            this.$parent.handleGetRequest( url ).then(response=> {
                this.setValues(response).setCharts(response)
                // this.showLoader = false;
                // this.$alert(response)
            });
        },

        setValues(data) {
            this.content = JSON.parse(JSON.stringify(data)); 
            return this

        },

        /**
         * Set charts based on their values type
         */ 
        setCharts(data) {
            
            this.showCharts = false
            
            // Pie charts for most played Games
            this.pie_options = JSON.parse(JSON.stringify(this.charts_options));
            this.pie_options.data[0] = {
                type: "pie",
                yValueFormatString: "#,### "+this.__('booking'),
                dataPoints: this.content.most_played_games
            }
            
            // Column charts for most played on devices
            this.column_options = JSON.parse(JSON.stringify(this.charts_options));
            this.column_options.axisY.title = this.__('Trips count')
            this.column_options.data[0] = {
                type: "column",
                yValueFormatString: "#,### "+this.__('Drivers'),
                dataPoints: this.content.top_drivers
            }

            // Line charts for sales in last days 
            this.line_options = JSON.parse(JSON.stringify(this.charts_options));
            this.line_options.theme = 'light2'
            this.line_options.axisY.suffix = this.setting.currency
            this.line_options.axisY.title = this.__('Trips')
            this.line_options.toolTip = {shared: true}
            this.line_options.data[0] = {
                type: "line",
                color: '#003c58',
                showInLegend: true,
                yValueFormatString: "#,### "+this.__('Trips'),
                dataPoints: this.content.trips_charts
            }
            
            this.showCharts = true
        },


        __(i)
        {
            return this.$parent.__(i);
        }
    }
};
</script>
<style lang="css">
    .rtl #side-cart-container
    {
        right: auto;
        left:0;
    }
</style>
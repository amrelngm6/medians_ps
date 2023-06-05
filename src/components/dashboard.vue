<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">

        <div class="block w-full overflow-x-auto">
        
            <div v-if="lang && !showLoader && setting" class="w-full overflow-y-auto overflow-x-hidden px-2" >
                <div class="pb-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
                        <dashboard_card_white  icon="/uploads/img/booking-unpaid.png" classes="bg-gradient-danger" :title="__('active_bookings')" :value="content.active_order_devices_count"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/booking-paid.png" classes="bg-gradient-info" :title="__('bookings')" :value="content.order_devices_count"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/products_icome.png" classes="bg-gradient-warning" :title="__('sold_products')" :value="setting.currency + content.order_products_revenue"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/booking_income.png" classes="bg-gradient-success" :title="__('bookings_income')" :value="setting.currency + content.bookings_income"></dashboard_card_white>
                    </div>
                    <div class="w-full bg-white p-4 mb-4 rounded-lg">
                        <CanvasJSChart v-if="showCharts && content.orders_charts.length" :key="line_options" :options="line_options"/>
                    </div>
                    <div class="row pt-4">
                        <dashboard_card classes="bg-gradient-success" :title="__('income')" :value="setting.currency + content.income"></dashboard_card>
                        <dashboard_card classes="bg-gradient-purple" :title="__('expenses')" :value="setting.currency + content.expenses"></dashboard_card>
                        <dashboard_card classes="bg-gradient-primary" :title="__('revenue')" :value="setting.currency + content.revenue" ></dashboard_card>
                    </div>
                </div>
                <div class="w-full lg:flex gap gap-6 pb-6">
                    <dashboard_center_squares :content="content" />
                    <div class="card mb-0 w-full">
                        <h4 class="p-4 ml-4" v-text="__('most_played_games')"></h4>
                        <p class="text-sm text-gray-500 px-4 mb-6" v-text="__('top_5_games_used_for_playing')"></p>
                        <div class="card-body w-full">
                            <div class="w-full">
                                <CanvasJSChart v-if="showCharts && content.most_played_games.length" :key="pie_options" :options="pie_options"/>
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
                                <CanvasJSChart v-if="showCharts && content.most_played_devices.length" :key="column_options" :options="column_options"/>
                            </div>
                        </div>
                    </div>
                    <div class="card w-1/3 lg:w-1/3 lg:mb-0">
                        <h4 class="p-4 ml-4" v-text="__('latest_paid_order_devices')"></h4>
                        <p class="text-sm text-gray-500 px-4 mb-6" v-text="__('latest_5_bookings_has_been_paid')"></p>
                        <div class="card-body w-full">
                            <div class="w-full ">
                                <div class="table-responsive w-full">
                                    <table class="w-full table table-striped table-nowrap custom-table mb-0 datatable">
                                        <thead>
                                            <tr>
                                                <th v-text="__('name')"></th>
                                                <th v-text="__('duration')"></th>
                                                <th v-text="__('total_amount')"></th>
                                            </tr>
                                        </thead>
                                        <tbody v-if="content.latest_paid_order_devices">
                                            <tr :key="index" v-for="(item, index) in content.latest_paid_order_devices" class="text-center">
                                                <td v-text="item.device ? item.device.name : ''"></td>
                                                <td>{{item.duration_time}}</td>
                                                <td v-text="(item.total_cost ? item.total_cost : '') + setting.currency"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:flex gap gap-6 pb-6">

                    <div class="card  w-full  ">
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
                                        <tbody v-if="content.latest_order_products">
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
                revenue: 0,
                most_played_games: [],
                latest_paid_bookings: 0,
                latest_sold_products: 0,
            },
            date:null,
            showLoader: false,
            showCharts: false,
            charts_options:{
                animationEnabled: true,
                exportEnabled: true,
                axisX: {
                  labelTextAlign: "right"
                },

                axisY: {
                  title: this.__('bookings_count'),
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
            this.showLoader = true;
            this.$parent.handleGetRequest( url ).then(response=> {
                this.setValues(response).setCharts(response)
                this.showLoader = false;
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
            this.column_options.axisY.title = this.__('devices')
            this.column_options.data[0] = {
                type: "column",
                yValueFormatString: "#,### "+this.__('booking'),
                dataPoints: this.content.most_played_devices
            }

            // Line charts for sales in last days 
            this.line_options = JSON.parse(JSON.stringify(this.charts_options));
            this.line_options.theme = 'light2'
            this.line_options.axisY.suffix = this.setting.currency
            this.line_options.axisY.title = this.__('sales')
            this.line_options.toolTip = {shared: true}
            this.line_options.data[0] = {
                type: "line",
                color: '#003c58',
                showInLegend: true,
                yValueFormatString: "#,### "+this.__('sales'),
                dataPoints: this.content.orders_charts
            }
            
            this.line_options.data[1] = {
                type: "line",
                color: '#ff6361',
                showInLegend: true,
                yValueFormatString: "#,### "+this.__('expenses'),
                dataPoints: this.content.expenses_charts
            }

            console.log(this.line_options);
            
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
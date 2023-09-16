<template>
    <div class="container mx-auto overflow-auto" style="height: 85vh; z-index: 9999;">


        <div class="top-0 py-2 w-full px-2 bg-gray-100 mt-0 sticky" style="z-index:9">
            <div class="w-full flex gap-6">
                <h3 class="text-base lg:text-lg whitespace-nowrap" v-text="__('Dashboard Reports')"></h3> 
                <ul class="w-full flex gap-4 ">
                    <li v-for="item in dates_filters" v-if="item" @click="switchDate(item.value)" :class="(activeDate == item.value) ? 'font-semibold' : ''" class="cursor-pointer" v-text="__(item.title)"></li>
                </ul>
            </div>
        </div>

        <div class="block w-full overflow-x-auto py-2">
            <div v-if="lang && !showLoader && content" class="w-full overflow-y-auto overflow-x-hidden px-2 mt-6" >
                <div class="">
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
                        <dashboard_card_white  icon="/uploads/img/booking-unpaid.png" classes="bg-gradient-danger" :title="__('active_conversations')" :value="content.active_conversations_count"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/booking-paid.png" classes="bg-gradient-info" :title="__('Ended conversation')" :value="content.ended_conversation_count"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/products_icome.png" classes="bg-gradient-warning" :title="__('Ended conversation')" :value="content.ended_conversation_count"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/booking_income.png" classes="bg-gradient-success" :title="__('messages count')" :value="content.messages_count"></dashboard_card_white>
                    </div>
                    <div class="w-full bg-white p-4 mb-4 rounded-lg" v-if="content.messages_charts && content.messages_charts.length">
                        <CanvasJSChart v-if="showCharts && content.messages_charts.length" :key="line_options" :options="line_options"/>
                    </div>
                    <div class="row mt-6">
                        <div class="bg-gray-100 w-full h-screen grid justify-center content-center">
                            <div class="w-fit rounded-[25px] bg-white p-8 aspect">
                                <div class="h-12">
                                    <svg class="h-6 w-6 h-full fill-white stroke-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                    </svg>
                                </div>
                                <div class="my-2">
                                    <h2 class="text-4xl font-bold"><span v-text="content.messages_count"></span> +</h2>
                                </div>

                                <div>
                                    <p class="mt-2 font-sans text-base font-medium text-gray-500" v-text="__('Messages count')"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row mt-6">
                        <dashboard_card classes="bg-gradient-success" :title="__('income')" :value="setting.currency +''+ content.income"></dashboard_card>
                        <dashboard_card classes="bg-gradient-danger" :title="__('expenses')" :value="setting.currency +''+ content.expenses"></dashboard_card>
                        <dashboard_card classes="bg-gradient-primary" :title="__('tax')" :value="setting.currency +''+ content.tax"></dashboard_card>
                        <dashboard_card classes="bg-gradient-purple" :title="__('revenue')" :value="setting.currency +''+ content.revenue" ></dashboard_card>
                    </div> -->
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
            this.column_options.axisY.title = this.__('bookings_count')
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
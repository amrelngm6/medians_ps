<template>
    <div class="overflow-auto" style="height: 85vh; z-index: 9999;">

        <div class="container mx-auto ">

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
                            <dashboard_card_white  icon="/uploads/img/booking-paid.png" classes="bg-gradient-info" :title="__('pending conversations')" :value="content.pending_conversations_count"></dashboard_card_white>
                            <dashboard_card_white  icon="/uploads/img/products_icome.png" classes="bg-gradient-warning" :title="__('Ended conversations')" :value="content.ended_conversations_count"></dashboard_card_white>
                            <dashboard_card_white  icon="/uploads/img/booking_income.png" classes="bg-gradient-success" :title="__('messages count')" :value="content.messages_count"></dashboard_card_white>
                        </div>
                        <div class="w-full bg-white p-4 mb-4 rounded-lg" v-if="content.messages_charts && content.messages_charts.length">
                            <CanvasJSChart v-if="showCharts && content.messages_charts.length" :key="line_options" :options="line_options"/>
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
                {title: this.__('Today'), value: 'yesterday'},
                {title: this.__('Yesterday'), value: '-2days'},
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
            
            // // Pie charts for most played Games
            // this.pie_options = JSON.parse(JSON.stringify(this.charts_options));
            // this.pie_options.data[0] = {
            //     type: "pie",
            //     yValueFormatString: "#,### "+this.__('booking'),
            //     dataPoints: this.content.most_played_games
            // }
            
            // // Column charts for most played on devices
            // this.column_options = JSON.parse(JSON.stringify(this.charts_options));
            // this.column_options.axisY.title = this.__('bookings_count')
            // this.column_options.data[0] = {
            //     type: "column",
            //     yValueFormatString: "#,### "+this.__('booking'),
            //     dataPoints: this.content.most_played_devices
            // }

            // Line charts for sales in last days 
            this.line_options = JSON.parse(JSON.stringify(this.charts_options));
            this.line_options.theme = 'light2'
            this.line_options.axisY.suffix = '#'
            this.line_options.axisY.title = this.__('Messages')
            this.line_options.toolTip = {shared: true}
            this.line_options.data[0] = {
                type: "line",
                color: '#003c58',
                showInLegend: true,
                yValueFormatString: "#,### "+this.__('Messages'),
                dataPoints: this.content.messages_charts
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
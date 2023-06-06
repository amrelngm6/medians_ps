<template>
    <div class="w-full overflow-auto" style="height: 85vh; z-index: 9999;">


        <div class="top-0 py-2 w-full px-2 bg-gray-100 mt-0 sticky" style="z-index:9">
            <div class="w-full flex gap-6">
                <h3 class="whitespace-nowrap" v-text="__('Dashboard Reports')"></h3> 
                <ul class="w-full flex gap-4 mt-2">
                    <li v-for="item in dates_filters" v-if="item" @click="switchDate(item.value)" :class="(activeDate == item.value) ? 'font-semibold' : ''" class="cursor-pointer" v-text="__(item.title)"></li>
                </ul>
            </div>
        </div>

        <div class="block w-full overflow-x-auto py-2">
            <div v-if="lang && !showLoader && system_setting" class="w-full overflow-y-auto overflow-x-hidden px-2 mt-6" >
                <div class="pb-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
                        <dashboard_card_white  icon="/uploads/img/booking-unpaid.png" classes="bg-gradient-danger" :title="__('new_branches')" :value="content.new_branches"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/products_icome.png" classes="bg-gradient-warning" :title="__('new_subscribers')" :value="content.new_subscribers"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/booking_income.png" classes="bg-gradient-success" :title="__('new_customers')" :value="content.new_customers"></dashboard_card_white>
                        <dashboard_card_white  icon="/uploads/img/booking-paid.png" classes="bg-gradient-info" :title="__('Subscription Payments')" :value="system_setting.currency ? system_setting.currency +''+ content.total_payments : 0"></dashboard_card_white>
                    </div>
                    <div class="w-full bg-white p-4 mb-4 rounded-lg">
                        <CanvasJSChart v-if="showCharts && content.branches_charts.length" :key="line_options" :options="line_options"/>
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

                line_options:{},
                branches_charts: [],
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
                  title: this.__('performance'),
                  suffix: ""
                },
                data: [{}]
            }
        }
    },
    props: [
        'lang',
        'setting',
        'system_setting',
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
            this.filters += '&end=today';

            // Update active date filters
            this.activeDate = start;

            // Load new data
            this.load(this.url+this.filters); 
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
            
            // Line charts for sales in last days 
            this.line_options = JSON.parse(JSON.stringify(this.charts_options));
            this.line_options.theme = 'light2'
            this.line_options.axisY.suffix = this.setting.currency
            this.line_options.axisY.title = this.__('branches_count')
            this.line_options.toolTip = {shared: true}
            this.line_options.data[0] = {
                type: "line",
                color: '#003c58',
                showInLegend: true,
                yValueFormatString: this.setting.currency+"#,### "+this.__('branches'),
                dataPoints: this.content.branches_charts
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
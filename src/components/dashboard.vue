<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">


        <div class="block w-full overflow-x-auto">

            <medians_datepicker :value="date"  @selected="changeLoad" name="uniquename"></medians_datepicker>

            <div v-if="lang && !showLoader" class="w-full overflow-y-auto overflow-x-hidden px-2" >
                <div class="mb-6">
                    <div class="row pt-2">
                        <dashboard_card  classes="bg-gradient-danger" :title="lang.active_bookings" :value="content.active_order_devices_count"></dashboard_card>
                        <dashboard_card  classes="bg-gradient-info" :title="lang.today_bookings" :value="content.today_order_devices_count"></dashboard_card>
                        <dashboard_card  classes="bg-gradient-warning" :title="lang.today_sold_products" :value="content.today_order_products_count"></dashboard_card>
                        <dashboard_card  classes="bg-gradient-success" :title="lang.today_income" :value="content.today_income"></dashboard_card>
                        <dashboard_card  classes="bg-gradient-purple" :title="lang.today_payments" :value="content.today_payments"></dashboard_card>
                        <dashboard_card  classes="bg-gradient-primary" :title="lang.today_revenue" :value="content.today_revenue" classes="bg-gradient-danger"></dashboard_card>

                    </div>
                </div>
                <div class="w-full lg:flex gap gap-6 ">
                    <div class="card mb-0 w-full">
                        <h4 class="p-4 ml-4" v-text="lang.latest_unpaid_bookings"></h4>
                        <hr />
                        <div class="card-body w-full">
                            <div class="col-md-12">
                                <div class="table-responsive w-full">
                                    <table class="w-full table table-striped table-nowrap custom-table mb-0 datatable">
                                        <thead>
                                            <tr>
                                                <th class="w-10">#</th>
                                                <th v-text="lang.name"></th>
                                                <th v-text="lang.duration"></th>
                                                <th v-text="lang.game"></th>
                                            </tr>
                                        </thead>
                                        <tbody v-if="content.latest_unpaid_order_devices">
                                            <tr :key="index" v-for="(item, index) in latest_unpaid_order_devices" class="text-center">
                                                <td>
                                                    {{item.id}}
                                                </td>
                                                <td>
                                                    <a href="/products/calendar" data-bs-toggle="modal" data-bs-target="#leads-details" v-text="item.device ? item.device.name : ''"></a>
                                                </td>
                                                <td>{{item.duration_time}}</td>
                                                <td v-text="item.game ? item.game.name : ''"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-0 w-full">
                        <h4 class="p-4 ml-4" v-text="lang.latest_paid_bookings"></h4>
                        <hr />
                        <div class="card-body w-full">
                            <div class="col-md-12">
                                <div class="table-responsive w-full">
                                    <table class="w-full table table-striped table-nowrap custom-table mb-0 datatable">
                                        <thead>
                                            <tr>
                                                <th class="w-10">#</th>
                                                <th v-text="lang.name"></th>
                                                <th v-text="lang.duration"></th>
                                                <th v-text="lang.game"></th>
                                            </tr>
                                        </thead>
                                        <tbody v-if="content.latest_paid_order_devices">
                                            <tr :key="index" v-for="(item, index) in content.latest_paid_order_devices" class="text-center">
                                                <td>
                                                    {{item.id}}
                                                </td>
                                                <td>
                                                    <a href="/products/calendar" data-bs-toggle="modal" data-bs-target="#leads-details">{{item.device.name}}</a>
                                                </td>
                                                <td>{{item.duration_time}}</td>
                                                <td v-text="item.game ? item.game.name : ''"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card my-10 w-full ">
                    <h4 class="p-4 ml-4" v-text="lang.latest_sold_products"></h4>
                    <hr />
                    <div class="card-body w-full">
                        <div class="col-md-12">
                            <div class="table-responsive w-full">
                                <table class="w-full table table-striped table-nowrap custom-table mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th class="w-10">#</th>
                                            <th v-text="lang.name"></th>
                                            <th v-text="lang.price"></th>
                                            <th v-text="lang.date"></th>
                                            <th v-text="lang.invoice"></th>
                                            <th v-text="lang.by"></th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="content.latest_order_products">
                                        <tr :key="index" v-for="(item, index) in content.latest_order_products" class="text-center">
                                            <td>{{item.product.id}}</td>
                                            <td>
                                                <a :href="'/products/edit/'+item.product.id">{{item.product.name}}</a>
                                            </td>
                                            <td class="text-red-500">{{item.product.price}} {{setting.currency}}</td>
                                            <td>{{item.created_at | date('Y-m-d H:i a')}}</td>
                                            <td><a target="_blank" :href="'/invoices/show/'+item.invoice.code">{{item.invoice.code}}</a></td>
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
</template>
<script>
import dashboard_card from './includes/dashboard_card';
// import medians_datepicker from 'medians_datepicker';


export default 
{
    components:{
        dashboard_card,
        // medians_datepicker,
    },
    name:'categories',
    data() {
        return {
            url: '/dashboard?load=json',
            content: {

                latest_unpaid_order_devices: [],
                latest_paid_order_devices: [],
                latest_order_products: [],
                today_revenue: 0,
                latest_unpaid_bookings: 0,
                latest_paid_bookings: 0,
                latest_sold_products: 0,
            },
            date:null,
            showLoader: false,
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
        // jQuery(document).ready(function(){

            // $('input[name="dates"]').daterangepicker();
        // })
    },

    methods: 
    {
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
                this.setValues(response)
                this.showLoader = false;
                // this.$alert(response)
            });
        },
        
        setValues(data) {
            this.content = JSON.parse(JSON.stringify(data)); return this
        },
        __(i)
        {
            return this.$root.$children[0].__(i);
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
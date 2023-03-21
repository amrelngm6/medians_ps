<template>
    <div class="block w-full overflow-x-auto">
        
        <div v-if="lang && !showLoader" class="w-full overflow-y-auto overflow-x-hidden px-2" >
            <div class="mb-6">
                <div class="row pt-2">
                    <dashboard_card :value="lang.active_bookings" :title="content.active_order_devices_count"></dashboard_card>
                    <div class="col-md-3">
                        <div class="card bg-gradient-danger card-img-holder text-white h-100">
                            <div class="card-body">
                                <img src="/assets/img/circle.png" class="card-img-absolute" alt="circle-image">
                                <h4 class="font-weight-normal mb-3" v-text=""></h4>
                                <span class="text-2xl" v-text=""></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-gradient-info card-img-holder text-white h-100">
                            <div class="card-body">
                                <img src="/assets/img/circle.png" class="card-img-absolute" alt="circle-image">
                                <h4 class="font-weight-normal mb-3" v-text="lang.today_bookings">  </h4>
                                <span class="text-2xl" v-text="content.today_order_devices_count"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-gradient-success card-img-holder text-white h-100">
                            <div class="card-body">
                                <img src="/assets/img/circle.png" class="card-img-absolute" alt="circle-image">
                                <h4 class="font-weight-normal mb-3" v-text="lang.today_sold_products"></h4>
                                <span class="text-2xl" v-text="content.today_order_products_count"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-gradient-danger card-img-holder text-white h-100">
                            <div class="card-body">
                                <img src="/assets/img/circle.png" class="card-img-absolute" alt="circle-image">
                                <h4 class="font-weight-normal mb-3" v-text="lang.today_revenue"></h4>
                                <span class="text-2xl" v-text="content.today_revenue"></span>
                            </div>
                        </div>
                    </div>
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
                                                <a href="/products/calendar" data-bs-toggle="modal" data-bs-target="#leads-details">{{item.device.name}}</a>
                                            </td>
                                            <td>{{item.duration_time}}</td>
                                            <td>{{item.game.name}}</td>
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
                                            <td>{{item.game.name}}</td>
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
                                        <td>{{item.user.name}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import dashboard_card from './includes/dashboard_card';
export default 
{
    components:{
        dashboard_card
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
        this.load()
    },

    methods: 
    {
        load()
        {
            this.showLoader = true;
            this.$parent.handleGetRequest( this.url ).then(response=> {
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
<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div class=" w-full">
            <div v-if="content && !showLoader"  class=" w-full px-4 overflow-y-auto h-full">
                <div class="crms-title flex bg-white mb-6 gap gap-6">
                    <div class="w-full">
                        <h3 class="gap gap-6 flex page-title m-0">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="feather-user"></i>
                            </span> 
                            <span>{{content.title}}</span> 
                        </h3>
                    </div>
                    <div class="">
                        <ul class="breadcrumb text-right bg-white float-end m-0 ps-0 pe-0 flex gap gap-6">
                            <li class="breadcrumb-item w-20"><a href="javascript:;">{{__('Dashboard')}}</a></li>
                            <li class="breadcrumb-item w-28 active">{{content.title}}</li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                        <div v-if="content.orders" class="card mb-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-nowrap custom-table mb-0 datatable w-full">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="p-2 text-center">{{__('Device')}}</th>
                                                <th class="p-2 text-center">{{__('Code')}}</th>
                                                <th class="p-2 text-center">{{__('Cost')}}</th>
                                                <th class="p-2 text-center">{{__('Time')}}</th>
                                                <th class="p-2 text-center">{{__('by')}}</th>
                                                <th class="p-2 text-center">{{__('Status')}}</th>
                                                <th class="p-2 text-center">{{__('Action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="order in content.orders" class="dark:bg-gray-800">
                                                <td class="text-center w-12">
                                                    <img class="rounded-full h-12 w-12  object-cover" :src="conf.url+'assets/img/ps.png'" alt="unsplash image">
                                                </td>
                                                <td class="p-2 text-center">
                                                    <div class="flex align-items-center">
                                                        <div class="mx-auto ">
                                                            <div class="font-medium" v-text="order.order_device ? order.order_device.device.title : ''"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="p-2 ">

                                                    <a href="javascript:;" @click="$parent.switchTab({link: 'invoices/show/'+order.code})" v-text="order.code"></a>
                                                </td>
                                                <td class="p-2 font-bold">
                                                    {{setting.currency}} {{order.total_cost}}   
                                                </td>
                                                <td class="p-2">
                                                    <span v-text="moment(order.created_at).format('YYYY-MM-DD HH:mm A')">
                                                        {{ order.created_at }}
                                                    </span>
                                                </td>
                                                <td class="p-2 px-1 font-medium text-md" v-text="order.cashier ? order.cashier.name : ''"></td>
                                                <td class="p-2 px-1 font-medium text-md">{{ order.status   }}</td>
                                                <td class="p-2 ">
                                                    <a @click="$parent.switchTab({link: 'invoices/show/'+order.code})" href="javascript:;" class="text-gray-400 hover:text-gray-100  mx-2">
                                                        <i class="material-icons-outlined text-base">edit</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">

                        <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 ">
                            <div id="jh-stats-positive" class="block justify-center px-4 py-4 bg-white border border-gray-300 rounded">
                                <div>
                                    <div class="hidden">
                                        <p class="flex items-center justify-end text-green-500 text-md">
                                            <span class="font-bold">6%</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M20 15a1 1 0 002 0V7a1 1 0 00-1-1h-8a1 1 0 000 2h5.59L13 13.59l-3.3-3.3a1 1 0 00-1.4 0l-6 6a1 1 0 001.4 1.42L9 12.4l3.3 3.3a1 1 0 001.4 0L20 9.4V15z"/></svg>
                                        </p>
                                    </div>
                                    <p class="text-3xl font-semibold text-center text-gray-800">{{content.todayOrders}}</p>
                                    <p class="text-lg text-center text-gray-500">{{__('Today_orders')}}</p>
                                </div>
                            </div>
                
                            <div id="jh-stats-negative" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 rounded sm:mt-0">
                                <div>
                                    <div class="hidden">
                                        <p class="flex items-center justify-end text-red-500 text-md">
                                            <span class="font-bold">6%</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M20 9a1 1 0 012 0v8a1 1 0 01-1 1h-8a1 1 0 010-2h5.59L13 10.41l-3.3 3.3a1 1 0 01-1.4 0l-6-6a1 1 0 011.4-1.42L9 11.6l3.3-3.3a1 1 0 011.4 0l6.3 6.3V9z"/></svg>
                                        </p>
                                    </div>
                                    <p class="text-3xl font-semibold text-center text-gray-800">{{content.lastWeekOrders}}</p>
                                    <p class="text-lg text-center text-gray-500">{{__('Last_week_orders')}}</p>
                                </div>
                            </div>

                            <div id="jh-stats-neutral" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 rounded sm:mt-0">
                                <div>
                                    <div class="hidden">
                                        <p class="flex items-center justify-end text-gray-500 text-md">
                                            <span class="font-bold">0%</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M17 11a1 1 0 010 2H7a1 1 0 010-2h10z"/></svg>
                                        </p>
                                    </div>
                                    <p class="text-3xl font-semibold text-center text-gray-800">{{content.lastMonthOrders}}</p>
                                    <p class="text-lg text-center text-gray-500">{{__('Last_30_Days')}}</p>
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
export default 
{
    name:'invoices',
    data() {
        return {
            url: this.conf.url+this.path+'&load=json',
            content: {

                title: '',
                todayOrders: 0,
                lastWeekOrders: 0,
                lastMonthOrders: 0,
                orders: [],
            },

            activeItem:null,
            showAddSide:false,
            showEditSide:false,
            showLoader: false,
        }
    },
    props: [
        'path',
        'lang',
        'setting',
        'conf',
        'auth',
    ],
    mounted() 
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
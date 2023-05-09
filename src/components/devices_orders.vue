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
                    <div class="col-md-12">
                        <div v-if="content.events" class="card mb-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-nowrap custom-table mb-0 datatable w-full">
                                        <thead>
                                                <th class="w-10">#</th>
                                                <th class="text-default">{{__('Device')}}/{{__('Game')}}</th>
                                                <th>{{__('Start_time')}}</th>
                                                <th>{{__('duration')}}</th>
                                                <th>{{__('Status')}}</th>
                                                <th>{{__('Order')}}</th>
                                                <th>{{__('Subtotal')}}</th>
                                                <th>{{__('Customer')}}</th>
                                                <th>{{__('By')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="mt-2">
                                            <tr :key="index" v-for="(item, index) in content.events" class="text-center">
                                                <td>{{item.id}}</td>
                                                <td class="text-default"><b>{{item.device.name}}</b> <span v-if="item.game" class="block w-full py-1 text-xs" v-text="item.game ? item.game.name : ''"></span></td>
                                                <td>{{item.start_time }}</td>
                                                <td>{{item.duration_time}}</td>
                                                <td>{{item.status}}</td>
                                                <td>
                                                    <a class="text-purple-600" :href="'/invoices/show/'+item.order_code">{{item.order_code}}</a>
                                                </td>
                                                <td><b class="text-red-500">{{item.subtotal + item.products_subtotal}} {{item.currency}}</b></td>
                                                <td>{{item.customer.name}}</td>
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

        </div>
    </div>
</template>
<script>
export default 
{
    name:'devices_orders',
    data() {
        return {
            url: this.conf.url+this.path+'&load=json',
            content: {

                title: '',
                events: [],
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
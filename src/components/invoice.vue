<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div class=" w-full">

            <div v-if="content && !showLoader"  class=" w-full px-4 overflow-y-auto h-full">
                <h1 class="font-bold text-lg "></h1>
                <div class="card invoice-info-card  mx-auto col-md-10">
                    <div class="card-body" v-if="content.order">
                        <div class="invoice-item invoice-item-one">
                            <div class="row">
                                <div class="col-md-6">
                                   <div class="invoice-logo mx-auto text-center">
                                        <img :src="conf.url+setting.logo" alt="logo">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="invoice-head">
                                        <h2 class="text-lg">{{content.title}}</h2>
                                        <p class="text-sm">{{__('Invoice_Number')}} : {{content.order.code}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-item invoice-item-two">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="invoice-info">
                                        <strong class="customer-text-one">{{__('Billed_to')}}</strong>
                                        <h6 class="invoice-name">{{content.order.customer ? content.order.customer.name : __('Guest')}}</h6>
                                        <p class="invoice-details invoice-details-two">
                                            {{content.order.customer ? content.order.customer.phone : ''}} <br>
                                        </p>
                                    </div>

                                    <div class="invoice-info text-default ">
                                        <strong class="customer-text-one">{{__('Payment_Details')}}</strong>
                                        <p class=" text-default">
                                            {{__('Payment_method')}}: <b class="text-red-500">{{content.order.payment_method}}</b>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="invoice-info ">
                                        <strong class="customer-text-one">{{__('Invoice_From')}}</strong>
                                        <h6 class="invoice-name">{{setting.sitename}}</h6>
                                        <p class="text-default">
                                            {{setting.address}}<br>
                                            {{setting.city}} - {{setting.country}}
                                        </p>
                                    </div>

                                    <div class="invoice-info text-default " v-if="content.order && content.order.cashier">
                                        <p class=" text-default w-full lg flex">
                                            <strong class="customer-text-one">{{__('Cashier')}}</strong>
                                            : <b class="text-red-500 p-1 px-4" v-text="content.order.cashier ? content.order.cashier.name : ''"></b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-issues-box">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="invoice-issues-date">
                                        <p>{{__('Issue_Date')}} : {{content.order.date}}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="invoice-issues-date">
                                        <p>{{__('Status')}} : {{__(content.order.status ? content.order.status : '-')}}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="invoice-issues-date">
                                        <p>{{__('Subtotal')}} : {{content.order.subtotal}}{{setting.currency}} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-item invoice-table-wrap w-full">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="invoice-table  w-full table table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>{{__('duration')}}</th>
                                                    <th>{{__('Category')}}</th>
                                                    <th>{{__('Rate')}}/{{__('Item')}}</th>
                                                    <th>{{__('Qty')}}/{{__('Duration')}}</th>
                                                    <th class="text-end">{{__('Amount')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody v-for="(orderdevice, index) in content.order.order_devices" class="text-center">
                                                <tr >
                                                    <td>{{orderdevice.device.name}}</td>
                                                    <td>{{__('Booking')}}</td>
                                                    <td>{{orderdevice.device_cost}} {{setting.currency}}</td>
                                                    <td>{{orderdevice.duration_hours}}</td>
                                                    <td class="text-end">{{orderdevice.subtotal}} {{setting.currency}}</td>
                                                </tr>

                                                <tr v-for="(device_product, i) in orderdevice.products" v-if="orderdevice.products">
                                                    <td>{{device_product.product.name}}</td>
                                                    <td>{{__('Product')}}</td>
                                                    <td>{{device_product.price}} {{setting.currency}}</td>
                                                    <td>{{device_product.qty}}</td>
                                                    <td class="text-end">{{device_product.subtotal}} {{setting.currency}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-lg-6 col-md-6">
                                <div class="invoice-terms">
                                    <h6>{{__('Notes')}}:</h6>
                                    <p class="mb-0">{{setting.invoice_notes}}</p>
                                </div>
                                <div class="invoice-terms">
                                    <h6>{{__('Terms_and_Conditions')}}:</h6>
                                    <p class="mb-0">{{setting.invoice_terms}}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="invoice-total-card">
                                    <div class="invoice-total-box">
                                        <div class="invoice-total-inner w-full">
                                            <p class="mb-0 w-full flex gap gap-6"> <span class="w-full">{{__('Sub_total')}} </span><span class="w-40 text-center">{{content.order.subtotal}} {{setting.currency}}</span></p>
                                            <p class="w-full flex "><span class="w-full">{{__('Tax') }}</span><span class="w-40 text-center">{{content.order.tax}} {{setting.currency}}</span></p>
                                            <p class="w-full flex "><span class="w-full">{{__('Discount')}}</span> <span class="w-40 text-center">{{content.order.discount}} {{setting.currency}}</span></p>
                                        </div>
                                        <div class="invoice-total-footer">
                                            <h4 class="w-full flex "><span class="w-full">{{__('Total_Amount')}}</span> <span class="w-40 text-center">{{content.order.total_cost}} {{setting.currency}}</span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-sign text-end flex w-full">
                            <div class="w-full">
                                <img  class="img-fluid d-inline-block w-12 h-12" :src="conf.url+setting.logo" alt="logo">
                                <span class="d-block">{{setting.sitename}}</span>
                            </div>
                            <div class="w-full text-center">
                              <img class="mx-auto" :src="'/invoices/qr_code/'+content.order.code" width="100">
                            </div>
                            <div class="w-full text-left">
                                <a href="javascript:;" @click="printInvoice()" class="w-full font-thin uppercase flex items-center p-4 my-2 transition-colors duration-200 justify-start text-gray-500"><span class="text-left"><i class="fa fa-print"></i></span><span class="text-sm font-semibold">Print</span></a>
                                <iframe id="printarea" :src="'/invoices/print/'+content.order.code" style="display: none;" width="1" height="1" ></iframe>
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
    name:'invoice',
    data() {
        return {
            url: this.conf.url+this.path+'?load=json',
            content: {

                title: '',
                order: {},
            },
            code:'test',
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
            });
        },
        
        setValues(data) {
            this.content = JSON.parse(JSON.stringify(data)); return this
        },
        printInvoice()
        {
              var iframe = document.getElementById("printarea");
              var iframeWindow = iframe.contentWindow;
              iframeWindow.print();
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
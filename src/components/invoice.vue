<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div class=" w-full">

            <div v-if="content && !showLoader"  class=" w-full px-4 overflow-y-auto h-full">

                <div class="flex items-center flex-wrap justify-between px-8 mb-6 bg-white rounded-t-md rounded-b-md shadow-xs py-6">
                    <div class="relative">
                        <h5 class="font-normal mb-0"><span v-text="__('Invoice_Number')"></span> : #<span v-text="content.order.code"></span></h5>
                        <p class="mb-0 text-tiny"><span v-text="__('Issue_Date')"></span> : <span v-text="content.order.date"></span></p>
                    </div>
                    <div class="flex sm:justify-end flex-wrap sm:space-x-6 mt-5 md:mt-0">
                        <img width="50" :src="setting.logo" alt="logo">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 2xl:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white rounded-t-md rounded-b-md shadow-xs px-8 py-8">
                        <h5 v-text="__('Invoice_From')">Invoice From</h5>
                        <hr class="my-4" />
                        <div class="relative overflow-x-auto " v-id="content.order && content.order.cashier">
                            <table class="w-full text-base text-default text-gray-500">
                                <tbody>
                                    <tr class="bg-white border-b border-gray6 last:border-0 text-start mx-9">
                                        <td class="py-3 font-normal text-[#55585B] w-[50%]" v-text="__('Name')">
                                            Name
                                        </td>
                                        <td class="py-3 whitespace-nowrap ">
                                            <a href="#" v-if="content.order && content.order.cashier" class="flex items-center justify-end space-x-5 text-end text-heading text-hover-primary">
                                                <span class="font-medium " v-text="setting.sitename">Medians PS</span>
                                            </a>
                                        </td>                                            
                                    </tr>              
                                    <tr  class="bg-white border-b border-gray6 last:border-0 text-start mx-9">
                                        <td class="py-3 font-normal text-[#55585B] w-[50%]" v-text="__('Cashier')">
                                            Cashier
                                        </td>
                                        <td class="py-3 whitespace-nowrap ">
                                            <a href="#" v-if="content.order && content.order.cashier" class="flex items-center justify-end space-x-5 text-end text-heading text-hover-primary gap gap-2">
                                                <img class="w-8 h-8 rounded-full" :src="content.order.cashier.photo" alt="">
                                                <span class="font-medium " v-text="content.order.cashier.name">Shahnewaz Sakil</span>
                                            </a>
                                        </td>                                            
                                    </tr>                                                                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="bg-white rounded-t-md rounded-b-md shadow-xs px-8 py-8">
                        <h5 v-text="__('Billed_to')">Billed to </h5>
                        <hr class="my-4" />
                        <div class="relative overflow-x-auto ">
                            <table class="w-full text-base text-default text-gray-500">
                                <tbody>
                                    <tr class="bg-white border-b border-gray6 last:border-0 text-start mx-9">
                                        <td class="py-3 font-normal text-[#55585B] w-[40%]" v-text="__('Customer')">
                                            Customer
                                        </td>
                                        <td class="py-3 text-end" v-text="content.order.customer ? content.order.customer.name : __('Guest')">
                                            Amr
                                        </td>                                            
                                    </tr>
                                    <tr class="bg-white border-b border-gray6 last:border-0 text-start mx-9">
                                        <td class="py-3 font-normal text-[#55585B] w-[40%]" v-text="__('mobile')">
                                            Mobile
                                        </td>
                                        <td class="py-3 whitespace-nowrap text-end" v-text="content.order.customer ? content.order.customer.mobile : '0' ">
                                            3169 Hamilton Drive
                                        </td>                                            
                                    </tr>                                                           
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white rounded-t-md rounded-b-md shadow-xs px-8 py-8">
                        <h5>Order Summary</h5>
                        <hr class="my-4" />
                        <div class="relative overflow-x-auto ">
                            <table class="w-full text-base text-default text-gray-500">
                                <tbody>
                                    <tr class="bg-white border-b border-gray6 last:border-0 text-start mx-9">
                                        <td class="py-3 font-normal text-[#55585B] w-[50%]">
                                            Order Date
                                        </td>
                                        <td class="py-3 whitespace-nowrap text-end">
                                            04/05/2023
                                        </td>                                            
                                    </tr>                                                           
                                    <tr class="bg-white border-b border-gray6 last:border-0 text-start mx-9">
                                        <td class="py-3 font-normal text-[#55585B] w-[50%]" v-text="__('Payment_method')">
                                            Payment Method 
                                        </td>
                                        <td class="py-3 text-end" v-text="content.order.payment_method">
                                            Cash
                                        </td>                                            
                                    </tr>                                                           
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="invoice-issues-box">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="invoice-issues-date">
                                <p><span v-text="__('Issue_Date')"> __('Issue_Date') </span> : <span v-text="content.order.date">content.order.date</span></p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="invoice-issues-date">
                                <p><span v-text="__('Status')"> __('Status') </span> : <span v-text="__(content.order.status ? content.order.status : '-')">__(content.order.status ? content.order.status : '-')</span></p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="invoice-issues-date">
                                <p><span v-text="__('Subtotal')"> __('Subtotal') </span> : <span v-text="content.order.subtotal+setting.currency">__(content.order.status ? content.order.status : '-')</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 2xl:col-span-8">
                        <div class="bg-white rounded-t-md rounded-b-md shadow-xs py-8">
                            <div class="relative overflow-x-auto  mx-8">
                                <table class="w-full text-base text-left text-gray-500">
                                    
                                    <thead class="bg-white">
                                        <tr class="border-b border-gray6 text-tiny">

                                            <th v-text="__('Name')" scope="col" class="pr-8 py-3 text-tiny text-text2 uppercase font-semibold">
                                                Product 
                                            </th>
                                            <th v-text="__('type')" scope="col" class="px-3 py-3 text-tiny text-text2 uppercase font-semibold w-[170px] text-end">
                                                Unit Price
                                            </th>
                                            <th v-text="__('Rate')+' / '+__('item')" scope="col" class="px-3 py-3 text-tiny text-text2 uppercase font-semibold w-[170px] text-end">
                                                Rate / Item
                                            </th>
                                            <th v-text="__('qty')+' / '+__('Duration')" scope="col" class="px-3 py-3 text-tiny text-text2 uppercase font-semibold w-[170px] text-end">
                                                Quantity
                                            </th>
                                            <th v-text="__('Amount')" scope="col" class="px-3 py-3 text-tiny text-text2 uppercase font-semibold w-[170px] text-end">
                                                Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody v-for="(orderdevice, index) in content.order.order_devices" class="text-center">
                                        <tr v-if="orderdevice" class="bg-white border-b border-gray6 last:border-0 text-start mx-9">
                                            <td class="pr-8 py-5 whitespace-nowrap">
                                                <a v-if="orderdevice.device" href="#" class="">
                                                    <span class="font-medium text-heading text-hover-primary transition" v-text="orderdevice.device.name"></span>
                                                </a>
                                            </td>
                                            <td class="px-3 py-3 font-normal text-[#55585B] text-end" v-text="__('Booking')">
                                            </td>
                                            <td class="px-3 py-3 font-normal text-[#55585B] text-end" v-text="orderdevice.device_cost+setting.currency">
                                            </td>
                                            <td class="px-3 py-3 font-normal text-[#55585B] text-end" v-text="orderdevice.duration_hours">
                                            </td>
                                            <td class="px-3 py-3 font-normal text-[#55585B] text-end" v-text="orderdevice.total_cost">
                                            </td>
                                        </tr>              

                                        <tr v-for="(device_product, i) in orderdevice.products" v-if="orderdevice.products">
                                            <td v-text="device_product.product.name"></td>
                                            <td v-text="__('Product')"></td>
                                            <td v-text="device_product.price+' '+setting.currency"></td>
                                            <td v-text="device_product.qty"></td>
                                            <td class="text-end" v-text="device_product.subtotal+' '+setting.currency"></td>
                                        </tr>                                                                     
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 2xl:col-span-4">
                        <div class="bg-white rounded-t-md rounded-b-md shadow-xs py-8 px-8">
                            <h5>Order Price</h5>
                            <div class="relative overflow-x-auto">
                                <table class="w-full text-base text-left text-gray-500">
                                    <tbody v-if="content.order">
                                                                                 
                                        <tr class="bg-white border-b border-gray6 last:border-0 text-start mx-9">
                                            <td class="pr-3 py-3 pt-6 font-normal text-[#55585B] text-start" v-text="__('Sub_total')">
                                                Subtotal
                                            </td>
                                            <td class="px-3 py-3 pt-6 font-normal text-[#55585B] text-end" v-text="content.order.tax+' '+setting.currency">
                                            </td>
                                        </tr>            
                                                                                 
                                        <tr class="bg-white border-b border-gray6 last:border-0 text-start mx-9">
                                            <td class="pr-3 py-3 pt-6 font-normal text-[#55585B] text-start" v-text="__('Tax')">
                                                Tax
                                            </td>
                                            <td class="px-3 py-3 pt-6 font-normal text-[#55585B] text-end" v-text="content.order.subtotal+' '+setting.currency">
                                            </td>
                                        </tr>                   
                                                                                 
                                        <tr class="bg-white border-b border-gray6 last:border-0 text-start mx-9">
                                            <td class="pr-3 py-3 pt-6 font-normal text-[#55585B] text-start" v-text="__('Discount')">
                                                Discount
                                            </td>
                                            <td class="px-3 py-3 pt-6 font-normal text-[#55585B] text-end" v-text="content.order.discount+' '+setting.currency">
                                            </td>
                                        </tr>                                              
                                        <tr class="bg-white border-b border-gray6 last:border-0 text-start mx-9">
                                            <td class="pr-3 py-3 font-normal text-[#55585B] text-start" v-text="__('Total_Amount')">
                                                Total:
                                            </td>
                                            <td class="px-3 py-3 text-[#55585B] text-end text-lg font-semibold"  v-text="content.order.total_cost+' '+setting.currency">
                                            </td>
                                        </tr>                                          
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="invoice-sign text-end flex w-full bg-white p-2">
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

                <div class="w-full my-2">
                    <div class="invoice-terms">
                        <h6 v-text="__('Notes')"></h6>
                        <p class="mb-0" v-text="setting.invoice_notes"></p>
                    </div>
                    <div class="invoice-terms">
                        <h6 v-text="__('Terms_and_Conditions')"></h6>
                        <p class="mb-0" v-text="setting.invoice_terms"></p>
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
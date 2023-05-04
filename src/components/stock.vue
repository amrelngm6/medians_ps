<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div class=" w-full">

            <main v-if="content && !showLoader" class=" flex-1 overflow-x-hidden overflow-y-auto  w-full">
                <!-- New releases -->
                <div class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full">
                    <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
                    <div class="w- relative" style="z-index:9">
                        <date_picker @change="openPageByDate($event)" :placeholder="content.startdate+' - '+content.enddate" range format="YYYY-MM-DD"></date_picker>
                    </div>
                    <a href="javascript:;" class="uppercase p-2 mx-2 text-center text-white w-32 rounded bg-gradient-purple hover:bg-red-800" @click="showLoader = true, showAddSide = true,showLoader = false; ">{{__('add_new')}}</a>
                </div>
                <hr class="mt-2" />
                <div class="w-full flex gap gap-6">
                    <div class="w-full">
                        <div v-if="content.stockList" class="px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 ">
                            <table class="table dark:text-gray-400 text-gray-800 border-separate space-y-6 text-sm w-full">
                                <thead class="dark:bg-gray-800 bg-white text-gray-500">
                                    <tr>
                                        <th class="p-2 text-default px-4">{{__('Item')}}</th>
                                        <th class="p-2 ">{{__('Qty')}}</th>
                                        <th class="p-2 ">{{__('Type')}}</th>
                                        <th class="p-2 ">{{__('date')}}</th>
                                        <th class="p-2 ">{{__('By')}}</th>
                                        <th class="p-2 ">{{__('Invoice')}}</th>
                                        <th class="p-2 text-center">{{__('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(stock, index) in content.stockList" class="dark:bg-gray-800 text-center">
                                        <td class="p-2 border-1 border-t  border-gray-200">
                                            <div class="flex ">
                                                <img class="rounded-full h-12 w-12  object-cover" :src="conf.url+'assets/img/cup.jpg'" alt="unsplash image">
                                                <div class="ml-3 text-default">
                                                    <div class="font-medium">{{stock.product.name}}</div>
                                                    <div class="text-gray-500 text-sm">{{stock.product.description}}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-2 font-bold border-1 border-t  border-gray-200">
                                            {{stock.stock}}
                                        </td>
                                        <td class="p-2 border-1 border-t  border-gray-200">
                                            {{__(stock.type)}}
                                        </td>
                                        <td class="p-2 border-1 border-t  border-gray-200">
                                            {{stock.date}}
                                        </td>
                                        <td class="p-2 border-1 border-t  border-gray-200">
                                            {{stock.user.name}}
                                        </td>
                                        <td class="p-2 border-1 border-t  border-gray-200">
                                            <a v-if="stock.invoice" target="_blank" :href="conf.url+'invoices/show/'+stock.invoice.code">{{__('Invoice')}}</a>
                                        </td>
                                        <td class="p-2 border-1 border-t  border-gray-200">
                                            <!-- <a @click="showEditSide = true; showAddSide = false; activeItem = product"  class="text-gray-400 hover:text-gray-100  mx-2"> -->
                                                <!-- <i class="material-icons-outlined text-base">edit</i> -->
                                            <!-- </a> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3" v-if="showAddSide">
                        <div class="mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 ">
                            <form action="/api/create" method="POST" data-refresh="1" id="add-device-form" class="action  py-0 m-auto rounded-lg max-w-xl pb-10">
                                <div class="w-full flex">
                                    <h1 class="w-full m-auto max-w-xl text-base mb-10 ">{{__('ADD_new')}}</h1>
                                    <span class="cursor-pointer py-1 px-2" @click="showAddSide = false"><close_icon /></span>
                                </div>
                                <input type="hidden" name="type" value="Stock.create" > 
                                <input type="hidden" name="params[type]" value="add" > 

                                <label class="pt-5 block">{{__('Product')}}:</label>
                                <select name="params[product_id]" required="" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('product')">
                                    <option v-for="product in content.products" :value="product.id" v-text="product.name"></option>
                                </select>

                                <label class="pt-5 block">{{__('Qty')}}:</label>
                                <input name="params[stock]"  required="" type="number" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('Start_stock')"> 
                                
                                <label class="pt-5 block">{{__('Purchase_amount')}}:</label>
                                <input name="params[payment][amount]" type="number" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('Paid_amount')"> 
                                
                                <label class="pt-5 block">{{__('Invoice Number')}}:</label>
                                <input name="params[payment][invoice_id]" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('Invoice_number')"> 
                                

                                <button class="uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800" v-text="__('save')"></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3 mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 " v-if="showEditSide && !showAddSide ">

                    </div>
                </div>
                <!-- END New releases -->
            </main>
        </div>
    </div>
</template>
<script>



export default 
{
    components:{
    },
    name:'products',
    data() {
        return {
            url: this.conf.url+'stock?load=json',
            content: {

                title: '',
                startdate: '',
                enddate: '',
                products: [],
                stockList: [],
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
        openPageByDate(event)
        {
        },
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
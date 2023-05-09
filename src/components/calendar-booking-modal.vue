<template>
    <div class="container calendar">

        <div class="relative w-full h-full  pt-2" v-if="activeItem && activeItem.status && (activeItem.status == 'completed' || activeItem.status == 'paid') ">

            <div class="pt-8 mt-12 relative mx-auto w-full bg-white p-6 rounded-lg overflow-y-auto" style="max-width: 600px; " v-if="showPopup" >

                <div class="w-full  mt-2 mb-4 pt-2 pb-6" style="max-height: 500px;" >

                    <div v-if="activeItem.status == 'paid'"  class="bg-red-200 rounded-md py-2 px-4 gap gap-1 flex " role="alert">
                        <strong v-text="__('alert')"></strong> <span v-text="__('order_status_is')"></span> <b class="font-semibold" v-text="__(activeItem.status)"></b>. <a target="_blank" href="javascript:;" @click="openURL('/invoices/show/'+activeItem.order_code, '_blank')" ><b v-text="__('show_invoice')"></b></a>
                        <button @click="hidePopup" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div v-if="activeItem.status == 'completed'"  class="bg-yellow-200 rounded-md py-2 px-4 gap-2 gap flex" role="alert">
                        <strong v-text="__('alert')"></strong> <span v-text="__('order_status_is')"></span> <b class="font-semibold" v-text="__(activeItem.status)"></b>.
                        <button @click="hidePopup" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div class="w-full block gap-4 py-2 border-b  border-gray-200">
                        <label class="w-full mt-10 " v-text="__('game')"></label>

                        <div  class="w-full block gap-4 my-2 text-gray-600 overflow-x-auto">
                            <div class="overflow-x-auto w-full flex gap gap-6"  >
                                <label class="inline-block cursor-pointer py-2 w-40 my-2 rounded-lg text-center font-semibold bg-purple-600 text-white" >
                                    <img class="mx-auto w-6 h-6 rounded-full my-2" :src="activeItem.game ? activeItem.game.picture : ''">
                                    <span v-text="activeItem.game ? activeItem.game.name : ''"></span> 
                                </label>
                                <div class="inline-block cursor-pointer py-2 w-32 my-2  text-default" style="direction: ltr">
                                    <div class="block">
                                        <span class="w-full block" v-text="__('price')"></span>
                                        <div class="py-2 text-md text-purple-600 font-semibold" v-if="activeItem.device && activeItem.device.price">
                                            <span v-if="activeItem.booking_type == 'single'" v-text="activeItem.device.price.single_price"></span>
                                            <span v-if="activeItem.booking_type == 'multi'" v-text="activeItem.device.price.multi_price"></span>
                                            <span >x</span>
                                            <span v-text="activeItem.duration_hours"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="inline-block cursor-pointer py-2 w-32 my-2  text-default" style="direction: ltr">
                                    <div class="block">
                                        <span class="w-full block"  v-text="__('duration')"></span>
                                        <div class="py-2 text-md text-purple-600 font-semibold" v-if="activeItem.duration_time">
                                            <span v-text="activeItem.duration_time"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="inline-block cursor-pointer py-2 w-32 my-2 text-default" style="direction: ltr">
                                    <div class="block">
                                        <span class="w-full block text" v-text="__('cost')"></span>
                                        <div class="py-2 text-lg text-purple-600 font-semibold" v-if="activeItem.subtotal">
                                            <span v-text="activeItem.subtotal"></span>
                                            <span class="text-sm" v-text="activeItem.currency"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Applicable products -->
                    <div class="w-full block" v-if="activeItem.products && showSelectedProducts && activeItem.products.length">
                        <calendar_products_selected ref="selected_products" :item="activeItem"  ></calendar_products_selected>
                    </div>

                    <!-- Applicable products -->
                    <div class="w-full block" v-if="products && products.length">
                        <calendar_products ref="applicable_products" :item="activeItem" :products="products" ></calendar_products>
                    </div>

                    <span class=" text-md font-semibold w-full block py-4" v-text="__('duration')"></span>

                    <div class="w-full flex gap-4 gap  text-md  pb-2">
                        
                        <div class="w-full block pb-2 border-b border-gray-200">
                            <label class="w-full py-2 text-gray-400" v-text="__('start')"></label>
                            <span class="w-full text-md text-red-600 block" v-text='activeItem.start_time'></span>
                        </div>
                        <div class="w-full block  pb-2 border-b border-gray-200">
                            <label class="w-full py-2 text-gray-400" v-text="__('end')"></label>
                            <span class="w-full text-md  text-red-600  block" v-text='activeItem.end_time'></span>
                        </div>
                        <div class="w-full block  pb-2 border-b border-gray-200">
                            <label class="w-full py-2 text-gray-400 " v-text="__('date')"></label>
                            <span class="w-full   text-red-600  block" v-text='activeItem.date'></span>
                        </div>
                    </div>

                    <span class="text-md font-semibold w-full block py-4" v-text="__('information')"></span>

                    <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                        <label class="w-full text-gray-400"  v-text="__('Customer')"></label>
                        <span class="w-full text-md p-2 text-gray-600 font-semibold"  v-text="activeItem.customer.name +' - '+ activeItem.customer.mobile"></span>
                    </div>
                    
                    <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                        <label class="w-full text-gray-400"  v-text="__('type')"></label>
                        <span class="w-full text-md p-2 text-red-600 font-semibold" v-text="activeItem.booking_type"></span>
                    </div>

                    <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                        <label class="w-full text-gray-400"  v-text="__('subtotal')"></label>
                        <span class="w-full text-lg p-2 text-red-600 font-semibold gap gap-1" >
                            <span v-text="subtotal()"></span>
                            <span v-text="activeItem.currency"></span>
                        </span>
                    </div>

                    <div class="w-full flex gap-6 my-2 text-gray-600 pb-6" v-if="!activeItem.order_code && activeItem.status == 'completed'">
                        <label @click="addToCart(activeItem) " class="cursor-pointer py-2 w-full mx-2 rounded-2xl text-center font-semibold bg-purple-600 text-white" >
                            <span  v-text="__('pay')" ></span>
                        </label>
                    </div>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
const axios = require('axios').default;

export default {
    data() {

        return {
                
                showSelectedProducts: true,
                showPopup: true,
                showMoreProducts: false,
                activeItem: {},
                products: [],
            };
        },
        props: [
            'modal',
        ],
        
        mounted() {
            if (this.modal)
            {
                this.activeItem = JSON.parse(JSON.stringify(this.modal));
                this.loadProducts();
            }
        },
        methods: {

            hidePopup(type = true)
            {
                this.$parent.hidePopup(type)
            },

            
            addToCart(activeItem)
            {
                this.$parent.addToCart(activeItem)
            },
            products_subtotal()
            {
                let subtotal = 0;

                if (this.activeItem.products && this.activeItem.products.length)
                {
                    for (var i = this.activeItem.products.length - 1; i >= 0; i--) {
                        if (this.activeItem.products[i])
                        {
                            subtotal =   (Number(this.activeItem.products[i].subtotal) + Number(subtotal));
                        }
                    }
                }
                return subtotal;
            },

            subtotal()
            {

                let subtotal = Number(this.activeItem.subtotal);

                if (this.products_subtotal())
                {
                    let productsCost = Number(this.products_subtotal()) ; 
                    subtotal = (productsCost > 0) ? ( subtotal + productsCost ) : subtotal;
                }

                return subtotal
            },
            /**
             * Open url in new tab
             */
            openURL(url, type = '_blank')
            {
                window.open(url, type)
            },

            query()
            {
                const params = new URLSearchParams([]);
                params.append('type', 'OrderDevice');
                params.append('model', 'OrderDevice');
                params.append('id',  this.activeItem.id);
                this.showSelectedProducts = false
                this.handleRequest(params, '/api').then(response => {
                    this.activeItem = response
                    this.showSelectedProducts = true
                })
            },

            loadProducts()
            {
                const params = new URLSearchParams([]);
                params.append('type', 'Products');
                params.append('model', 'Products');
                params.append('id',  this.activeItem.id);
                this.showSelectedProducts = false
                this.handleRequest(params, '/api').then(response => {
                    this.products = response
                    this.showSelectedProducts = true
                })
            },

            async handleRequest(params, url='/') {

                // Demo json data
                return await axios.post(url, params.toString()).then(response => 
                {
                    if (response.data.status)
                        return response.data.result;
                    else 
                        return response.data;
                });
            }, 
            __(i)
            {
                return this.$parent.__(i);
            }
        }
    }
</script>

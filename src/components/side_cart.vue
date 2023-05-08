<template>
    <div class="block w-full overflow-x-auto">

        <div v-if="showCart && Items && Items.length ">
            
            <div v-if="showLoader">
                 
            </div>
            <div v-if="!showLoader" id="side-cart-container" class="pt-8 fixed right-0 top-0 bg-white p-6 h-screen overflow-y-auto w-96 max-w-full" style="z-index:9; max-height: 100vh;" >
            <!-- <div v-if="Items && !showLoader"> -->
                

                <div class="modal-body pt-2">
                    <div class="mx-auto w-full pt-8">
                        <div class="w-full flex gap gap-2">
                            <h1 class="w-full font-semibold text-2xl border-b py-4" v-text="__('order_summary')"></h1>
                            <!-- <button type="button" class="btn-close xs-close text-lg absolute" style="left:auto; right: auto; margin: 5px;" data-bs-dismiss="modal">X</button> -->
                        </div>
                        <div v-if="Items" class="w-full">
                            <div v-for="(item, i) in Items" class="w-full block" :key="i" >
                                <div  class="flex justify-between mt-10 mb-5" v-if="item" >
                                    <span class="font-semibold text-sm" v-if="item.device"> 
                                        <span v-text="item.device.name"></span><br /> 
                                        <span class="text-xs text-gray-400 " v-if="item.game" v-text="item.game.name"></span>
                                        <span class="text-xs text-red-400" @click="removeFromCart(item)" v-text="__('remove')"></span>
                                    </span>
                                    <span style="direction:ltr;" class="font-semibold text-sm"><span v-text="item.subtotal"></span> <small v-if="setting" class="text-xs" v-text="setting.currency"></small> <br /> <span class="text-xs text-gray-400" v-text="item.duration_time"></span></span>
                                </div>
                                <div v-if="item && item.products">
                                    
                                    <div v-for="(product, i) in item.products" class="w-full block" :key="i" >
                                        <div  class="flex justify-between mt-10 mb-5" v-if="product && item && item.products" >
                                            <span class="font-semibold text-sm" > 
                                                <span v-text="product.product.name"></span><br /> 
                                                <span class="text-xs text-gray-400 " v-if="product.qty" v-text="'X '+product.qty"></span>
                                            </span>
                                            <span class="font-semibold text-sm"><span v-text="product.price"></span> <small v-if="setting" class="text-xs" v-text="setting.currency"></small> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="py-10 ">
                            <label for="promo" class="font-semibold inline-block mb-3 text-sm uppercase"  v-text="__('promo_code')"></label>
                            <div class="flex w-full gap gap-1">
                                <input type="text" id="promo" placeholder="Enter your code" class="p-2 text-sm w-full">
                                <button class="bg-red-500 hover:bg-red-600 px-5 py-2 text-sm text-white uppercase"  v-text="__('apply')"></button>
                            </div>
                        </div> -->
                        <hr />
                        <div class="w-full flex gap-1 mt-4">
                            <label class="font-medium inline-block w-full my-3 text-sm uppercase" v-text="__('payment_method')"></label>
                            <select class="block p-2 text-gray-600 w-full text-sm" v-model="payment_method">
                                <option value="Cash">Cash</option>
                            </select>
                        </div>
                        <div class="border-t mt-6 w-full">
                            <div class="flex font-semibold justify-between py-2 text-sm uppercase border-b">
                                <span class="w-full" v-text="__('subtotal')"></span>
                                <span class="flex w-full text-right text-md gap gap-1 ">
                                    <span v-text="subtotal"></span>
                                    <span v-text="setting.currency"></span>
                                </span>
                            </div>
                            <div class="flex font-semibold justify-between py-2 text-sm uppercase border-b">
                                <span class="w-full" v-text="__('tax')"></span>
                                <span class="flex w-full text-right text-md gap gap-1 ">
                                    <span v-text="tax"></span>
                                    <span v-text="setting.currency"></span>
                                </span>
                            </div>
                            <div class="flex font-semibold justify-between py-2 text-sm uppercase border-b">
                                <span class="w-full" v-text="__('discount')"></span>
                                <span class="flex w-full text-right text-md gap gap-1 text-red-400">
                                    <input v-model="discount" type="number" @keyup="calc()" :placeholder="__('discount_amount')" class="p-2 text-sm w-full">
                                    <span v-text="setting.currency"></span>
                                </span>
                            </div>
                            <div class="flex font-semibold justify-between py-2 text-sm uppercase border-b">
                                <span class="w-full" v-text="__('total_amount')"></span>
                                <span class="flex w-full text-right text-lg gap gap-1 text-red-400">
                                    <span v-text="total_cost"></span>
                                    <span v-text="setting.currency"></span>
                                </span>
                            </div>
                            <button class="bg-gradient-primary font-semibold hover:bg-purple-600 py-3 text-sm text-white uppercase w-32 mx-auto block rounded-lg my-6 " @click="checkout" v-text="__('checkout')"></button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</template>
<script>
const axios = require('axios').default;

export default 
{
    data() {
        return {
            payment_method:'Cash',
            id:0,
            activeItem: {},
            ItemsIds: [],
            Items: [],
            discount:0,
            subtotal:0,
            tax:0,
            total_cost:0,
            showLoader: false,
            showCart: true
        }
    },
    props: [
        'setting',
        'currency',
        'cart_items'
    ],
    mounted: function() 
    {
        if (this.cart_items)
        {
            this.Items = this.cart_items;
        }
            this.mapSubtotal().mapTax().mapTotal();
    },

    methods: 
    {   

        /**
         * Reset calculator 
         * 
         */
        calc()
        {
            this.mapSubtotal().mapTax().mapTotal();
        } ,

        /**
         * Add to cart
         */
        removeFromCart(item)
        {
            if (!item || item && !item.id)
                return null

            this.ItemsIds = [];
            this.showLoader = true
            for (var i = this.Items.length - 1; i >= 0; i--) {
                if (this.Items[i] && this.Items[i].id == item.id)
                {
                    delete this.Items[i];
                } else if (this.Items[i]) {
                    this.ItemsIds.push(this.Items[i].id);
                }
            }

            this.mapSubtotal().mapTax().mapTotal();
            this.showLoader = false
        } ,
        /**
         * Add to cart
         */
        addToCart(item)
        {
            this.checkDuplicate(item);
            this.mapSubtotal().mapTax().mapTotal();
        } ,
        /**
         * Check duplicate
         */
        checkDuplicate(item)
        {
            if (!(this.ItemsIds.indexOf(item.id) != -1))
            {
                this.Items.push(item);
                this.ItemsIds.push(item.id);
            }

            return this;
        },    
        mapTotal()
        {
            let subtotal = Number(this.subtotal);
            let tax = Number(this.tax);
            let discount = this.discount ? Number(this.discount) : 0;

            this.total_cost = (subtotal + tax - (discount)).toFixed(2);

            return this;
        },  
        mapTax()
        {
            let subtotal = Number(this.subtotal);
            this.tax =  this.setting.tax > 0  ? (subtotal * ( Number(this.setting.tax) / 100 )).toFixed(2) : 0;
            return this; 
        },    
        mapSubtotal()
        {
            this.subtotal = 0;
            for (var i = this.Items.length - 1; i >= 0; i--) {

                this.subtotal += this.Items[i] && this.Items[i].subtotal ?  Number(this.Items[i].subtotal) : 0 
                if (this.Items[i] && this.Items[i].products && this.Items[i].products.length > 0)
                {
                    for (var p = this.Items[i].products.length - 1; p >= 0; p--) 
                    {
                        this.subtotal += this.Items[i].products[p] ? 
                        Number(this.Items[i].products[p].price)
                        : 0; 
                    }
                }
            }
            return this;
        },
        checkout()
        {   
            this.showLoader = true;
            const params = new URLSearchParams([]);
            params.append('type', 'checkout');
            params.append('params[cart]', JSON.stringify(this.Items));
            params.append('params[total_cost]', JSON.stringify(this.total_cost));
            params.append('params[subtotal]', JSON.stringify(this.subtotal));
            params.append('params[tax]', JSON.stringify(this.tax));
            params.append('params[discount]', JSON.stringify(this.discount));
            params.append('params[payment_method]', this.payment_method);
            this.handleRequest(params, '/api/checkout').then(response=> {
                this.showLoader = false;
                this.$alert(response)
                this.Items = []
                this.$parent.reloadEvents()
                this.$parent.hidePopup()
            });

        },

        async handleRequest(params, url = '/api') {

            // Demo json data
            return await axios.post(url, params.toString()).then(response => 
            {
                if (response.data.status)
                    return response.data.result;
                else 
                    return response.data;
            });
        },
    
        async handleGetRequest(url) {

            var t = this;
            // Demo json data
            return await axios.get(url).then(response => 
            {
                t.showLoader = false;

                if (response.data.status)
                    return response.data.result;
                else 
                    return response.data;
            });
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
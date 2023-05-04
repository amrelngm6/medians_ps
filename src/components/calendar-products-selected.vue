<template>
    <div class="w-full block" >
        
        <!-- Purchased products -->
        <div v-if="activeItem && activeItem.products && activeItem.products.length" class=" pb-4 ">
            <div class="border border-gray-200 w-full flex p-2">
                <div class="w-auto">
                    <svg fill="#000000" width="25px" height="25px" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><path d="M888 320H577q-5 0-7.5-3.5T568 309q9-35 34-56 6-5 13-1 33 19 70.5 11.5t60.5-38 20.5-68.5T737 92t-65.5-29.5-68.5 21-37.5 61T577 215q3 4 2 8t-4 7q-35 28-47 79-1 5-5 8t-9 3H308q-6 0-11-3.5t-6-9.5l-27-145q-2-14-12.5-22.5T228 131H98q-14 0-25 10.5T62 167v5q1 16 11.5 26.5T99 209h84q4 0 7.5 2.5t3.5 6.5l108 564q3 19 20 28 8 4 18 4h54q-23 6-36.5 25.5t-11 43 20.5 39 41.5 15.5 41-15.5 20.5-39-11-43-37-25.5h296q-23 6-37 25.5t-11 43 20.5 39T732 937t41.5-15.5 20-39-11-43T746 814h60q15 0 25.5-10t10.5-25v-8q0-15-11-26t-26-11H386q-6 0-10-3.5t-6-8.5l-10-54q-1-8 4-14t13-6h459q13 0 22.5-8t11.5-20l52-258q3-16-7-29t-27-13z"/></svg>
                </div>
                <span @click="showDetails = !showDetails" class="cursor-pointer text-md font-semibold w-full block px-1 text-purple-600" v-text="__('purchased_products')"></span>
            </div>

            <div class="w-full" v-if="showDetails">
                <div v-for="product in activeItem.products" v-if="product" class="font-semibold w-full flex gap-4 py-2 border-b border-gray-200">
                    <label class="w-full " v-text="product.product_name"></label>
                    <span class="w-20 flex text-md p-2 text-right"> 
                        <span v-text="product.price"></span>
                        <span class="px-1 text-sm" v-text="activeItem.currency"></span>
                    </span>
                    <span class="w-16 text-md py-2 text-red-600" v-if="activeItem.status != 'paid'" @click="removeProduct(product)" v-text="__('remove')"></span>
                </div>
                <div class="font-semibold w-full flex gap-4 py-2 border-b border-gray-200 ">
                    <label class="w-full text-purple-600" ></label>
                    <input disabled class="w-full text-lg p-2 text-purple-600" style="direction:ltr" :value="subtotal()+' '+activeItem.currency">
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
            
            showDetails: true,
            showMoreProducts: false,
            activeItem: {},
        };
    },
    props: [
        'item',
        'products'
    ],
    
    mounted() {
        this.activeItem = this.item
    },
    methods: {
  
        subtotal()
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

        /**
         * View more products
         */
        viwMoreProducts()
        {
            this.showMoreProducts = !this.showMoreProducts;
        },
        
        removeProduct(product)
        {
            if (window.confirm(this.__('confirm_delete_product')))
            {
                const params = new URLSearchParams([]);
                params.append('type', 'OrderDevice.removeProduct');
                params.append('params[product]', JSON.stringify(product));
                this.handleRequest(params, '/api/delete').then(response => {
                    this.$parent.query()
                })
            }

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

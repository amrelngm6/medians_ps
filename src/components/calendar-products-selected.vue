<template>
    <div class="w-full block" >
        
        <!-- Purchased products -->
        <div v-if="activeItem && activeItem.products && activeItem.products.length" class=" pb-4">
            <span class="text-md font-semibold w-full block py-4" v-text="__('purchased_products')"></span>
            <div v-for="product in activeItem.products" v-if="product" class="font-semibold w-full flex gap-4 py-2 border-b border-gray-200">
                <label class="w-full text-purple-600" v-text="product.product_name"></label>
                <span class="w-40 text-md p-2 text-red-600" v-if="activeItem.status != 'paid'" @click="removeProduct(product)" v-text="__('remove')"></span>
                <span class="w-20 flex text-md p-2 text-right"> 
                    <span v-text="product.price"></span>
                    <span class="px-1 text-sm" v-text="activeItem.currency"></span>
                </span>
            </div>
            <div class="font-semibold w-full flex gap-4 py-2 border-b border-gray-200 ">
                <label class="w-full text-purple-600" ></label>
                <input disabled class="w-full text-lg p-2 text-red-600 text-right" :value="subtotal()+' '+activeItem.currency">
            </div>
        </div>

    </div>
</template>

<script>
const axios = require('axios').default;

export default {
    data() {

        return {
                
                showPopup: true,
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
                const params = new URLSearchParams([]);
                params.append('type', 'OrderDevice.removeProduct');
                params.append('params[product]', JSON.stringify(product));
                this.handleRequest(params, '/api/delete').then(response => {
                    this.$parent.query()
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

<template>
    <div class="w-full block" >
        <div v-if="products && products.length && activeItem && activeItem.status != 'paid'" class=" pb-4">
            <span class="text-red-600 text-md font-semibold w-full block my-4 cursor-pointer py-2 px-4 rounded-lg border border-gray-200" @click="viwMoreProducts()" v-text="__('add_products')"></span>
            <div v-if="showMoreProducts">
                <div v-for="(product, index) in products" :key="index" class="">
                    <div v-if="product" class="font-semibold w-full flex gap-4 py-2 border-b border-gray-200">
                        <label class="w-full text-purple-600" v-text="product.name"></label>
                        <span class="w-40 text-md p-2 text-red-600 cursor-pointer"   @click="addProduct(product)" v-text="__('add_cart')"></span>
                        <span class="w-20 flex text-md p-2 text-right"> 
                            <span v-text="product.price"></span>
                            <span class="px-1 text-sm" v-text="activeItem.currency"></span>
                        </span>
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

            /**
             * View more products
             */
            viwMoreProducts()
            {
                this.showMoreProducts = !this.showMoreProducts;
            } ,
            
            addProduct(product)
            {
                const params = new URLSearchParams([]);
                params.append('type', 'OrderDevice.addProduct');
                params.append('model', 'OrderDevice');
                params.append('params[product]', JSON.stringify(product));
                params.append('params[device]', JSON.stringify(this.activeItem));
                this.handleRequest(params, '/api/create').then(response => {
                    this.$parent.query()
                    this.$alert(response)
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

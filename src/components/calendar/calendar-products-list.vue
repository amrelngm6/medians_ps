<template>
    <div class="w-full block" >
        <div v-if="products && products.length && activeItem && activeItem.status != 'paid'" class=" py-4">

            <div class="border border-gray-200 w-full flex p-2">
                <div class="w-auto">
                    <svg fill="#000000" width="25px" height="25px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <title>alt-list</title>
                        <path d="M0 26.016q0 2.496 1.76 4.224t4.256 1.76h20q2.464 0 4.224-1.76t1.76-4.224v-20q0-2.496-1.76-4.256t-4.224-1.76h-20q-2.496 0-4.256 1.76t-1.76 4.256v20zM4 26.016v-20q0-0.832 0.576-1.408t1.44-0.608h20q0.8 0 1.408 0.608t0.576 1.408v20q0 0.832-0.576 1.408t-1.408 0.576h-20q-0.832 0-1.44-0.576t-0.576-1.408zM8 24h6.016v-5.984h-6.016v5.984zM8 14.016h6.016v-6.016h-6.016v6.016zM10.016 22.016v-2.016h1.984v2.016h-1.984zM10.016 12v-1.984h1.984v1.984h-1.984zM16 22.016h8v-2.016h-8v2.016zM16 12h8v-1.984h-8v1.984z"></path>
                    </svg>
                </div>
                <span @click="viwMoreProducts()" v-text="__('add_products')" class="cursor-pointer text-md font-semibold w-full block px-1 text-purple-600" ></span>
            </div>
            <div v-if="showMoreProducts" class="overflow-y-auto py-6 my-4" style="max-height:180px">
                <div v-for="(product, index) in products" :key="index" class="">
                    <div v-if="product" class="font-semibold w-full flex gap-4 py-2 border-b border-gray-200">
                        <label class="w-full px-4 " v-text="product.name"></label>
                        <span class="w-16 flex text-md py-2 text-right"> 
                            <span v-text="product.price"></span>
                            <span class="px-1 text-sm" v-text="activeItem.currency"></span>
                        </span>
                        <span class="w-16 text-md py-2 text-red-600 cursor-pointer"   @click="addProduct(product)" v-text="__('add')"></span>
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

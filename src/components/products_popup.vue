<template>

    <div class="relative" style="z-index: 999">
        <div class="fixed top-0 left-0 w-full h-full"  style="z-index: 99;">
            <div class="absolute top-0 left-0 w-full h-full" @click="hidePopup" style="background: rgba(0,0,0,.6);"></div>
            <div class="absolute top-0 left-0  right-0 bottom-0 m-auto w-40 h-40" v-if="!activeItem" >
                <img src="/uploads/images/loader.gif"  />
            </div>
            <div class="left-0 right-0 fixed mx-auto w-full " v-if="activeItem" style="max-width: 600px; z-index: 99; top: 30px;" >
                
		        <div class="relative w-full h-full  pt-2">
		            
		            <!-- Event modal -->
		            <div class="pt-8 pb-2 mt-12 relative mx-auto w-full bg-white p-6 rounded-lg overflow-y-auto" style="max-width: 600px; max-height: 500px;"  v-if="activeItem">


		                <!-- Applicable products -->
		                <div  class="w-full block" v-if="activeItem.products  && activeItem.products.length">
		                    <calendar_products_selected ref="selected_products" :item="activeItem"  ></calendar_products_selected>
		                </div>

		                <!-- Applicable products -->
		                <div class="w-full block" v-if="activeItem.id && products && products.length">
		                    <calendar_products @add-product="load()" ref="applicable_products" v-if="setting" :currency="setting.currency" :item="activeItem" :products="products" ></calendar_products>
		                </div>

		            </div>

		        </div>
	        </div>
        </div>
    </div>
</template>

<script>

export default {
    components: {
    },
    data() {

        return {
                
                showLoader: false,
                showUpdate: false,
                showMoreProducts: false,
                activeItem: {},
                games: [],
                products: [],
                showConfirm:false,

            };
        },
        props: [
            'setting',
            'products',
            'item'
        ],
        
        mounted() {
            this.activeItem = this.item
        },
        methods: {

        	query(){
                this.$emit('add-product');
            },
            load()
        	{
        		this.$emit('add-product');
        	},

        	/**
        	 * Hide modal
        	 */
        	 hidePopup()
        	 {
        	 	this.$parent.hideProductsPopup()
        	 }, 

            /**
             * Translate content
             */  
            __(i)
            {
                return this.$root.$children[0].__(i);
            }
        }
    }
</script>

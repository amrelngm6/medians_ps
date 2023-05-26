<template>
    <div class="">

        <div v-if="activeItem && show" >

            <div class="w-full block gap-4 py-2 border-b  border-gray-200">
                <label class="w-full mt-10 " v-text="__('game')"></label>

                <div  class="w-full block gap-4 my-2 text-gray-600 overflow-x-auto">
                    <div class="overflow-x-auto w-full flex gap gap-6"  >
                        <label class="block cursor-pointer py-2 w-40 my-2 rounded-lg text-center font-semibold bg-purple-600 text-white" >
                            <img class="mx-auto w-6 h-6 rounded-full my-2" :src="activeItem.game ? activeItem.game.picture : ''">
                            <span v-text="activeItem.game ? activeItem.game.name : ''"></span> 
                        </label>
                        <div class="block cursor-pointer py-2 w-32 my-2  text-default" style="direction: ltr">
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
                        <div class="block cursor-pointer py-2 w-32 my-2  text-default" style="direction: ltr">
                            <div class="block">
                                <span class="w-full block"  v-text="__('duration')"></span>
                                <div class="py-2 text-md text-purple-600 font-semibold" v-if="activeItem.duration_time">
                                    <span v-text="activeItem.duration_time"></span>
                                </div>
                            </div>
                        </div>
                        <div class=" cursor-pointer py-2 w-32 my-2 text-default" style="direction: ltr">
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
            <div class="w-full block" v-if="activeItem.products  && activeItem.products.length">
                <calendar_products_selected ref="selected_products" :item="activeItem"  ></calendar_products_selected>
            </div>

            <span class=" text-md font-semibold w-full block py-2" v-text="__('duration')"></span>
            <div class="w-full flex gap-4 gap  text-md  py-2">
                
                <div class="w-full block  pb-2 border-b border-gray-200">
                    <label class="w-full py-2 text-gray-400 " v-text="__('date')"></label>
                    <span class="w-full   text-purple-600  block" v-text='activeItem.date'></span>
                </div>
                <div class="w-full block pb-2 border-b border-gray-200">
                    <label class="w-full py-2 text-gray-400" v-text="__('start')"></label>
                    <span class="w-full text-md text-purple-600 block" v-text="formatTime(activeItem.start_time)"></span>
                </div>
                <div class="w-full block  pb-2 border-b border-gray-200">
                    <label class="w-full py-2 text-gray-400" v-text="__('end')"></label>
                    <span class="w-full text-md  text-purple-600  block" v-text="formatTime(activeItem.end_time)"></span>
                </div>
            </div>
            <div class="w-full block  pb-2 border-b border-gray-200">
                <p v-if="activeItem.extra_time && activeItem.extra_time.value" class="font-semibold flex ">
                    <span v-text="extraTimeText()"></span>
                    <span class="text-purple-600 px-2" v-if="extraTimeText()" v-text="activeItem.extra_time.text"></span>
                </p>
            </div>
            
            <span class="text-md font-semibold w-full block py-2" v-text="__('information')"></span>
            <div class="w-full flex gap-4 py-1 border-b border-gray-200 mb-2" v-if="activeItem.customer">
                <span class="text-md w-full block py-2" v-text="__('Customer')"></span>
                <span class="w-full text-md p-2 text-gray-600 font-semibold"  v-text="activeItem.customer.name +' - '+ activeItem.customer.mobile"></span>
            </div>

            <div class="w-full flex gap-4 py-1 border-b border-gray-200">
                <label class="w-full text-gray-400"  v-text="__('type')"></label>
                <span class="w-full text-md p-2 text-gray-600 font-semibold" v-text="activeItem.booking_type"></span>
            </div>

            <div class="w-full flex gap-4 py-1 border-b border-gray-200">
                <label class="w-full text-gray-400"  v-text="__('subtotal')"></label>
                <span class="w-full text-lg pb-2 text-purple-600  gap gap-1" >
                    <span v-text="subtotal()"></span>
                    <span v-text="activeItem.currency"></span>
                </span>
            </div>
        </div>
    </div>
</template>
<script>
import moment from 'moment';

export default {
    data() {
        return {
            show: true,
        };
    },
    props: [
        'activeItem',
    ],
    
    mounted() {
    },
    methods: {

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
            return subtotal ? subtotal.toFixed(2) : 0;
        },
        formatTime(time)
        {
            return moment(time).format('hh:mm a')
        },
        subtotal()
        {

            let subtotal = Number(this.activeItem.subtotal);
            let productsCost = Number(this.products_subtotal());

            if (productsCost > 0)
            {
                subtotal = (productsCost > 0) ? ( subtotal + productsCost ) : subtotal;
            }

            return subtotal
        },
        extraTimeText()
        {
            if (this.activeItem.extra_time.value > 5)
            {
                return this.__('Extra time is');
            } else if (this.activeItem.extra_time.value < -5) {
                return this.__('Missing time is');
            }
        },
        __(i)
        {
            return this.$parent.__(i);
        }
    }
}
</script>

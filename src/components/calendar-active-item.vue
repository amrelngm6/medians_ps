<template>
    <div class="w-full" >

        <div class="relative w-full h-full  pt-2" v-if="!showLoader && activeItem && !showConfirm && (!activeItem.status || activeItem.status == 'active' || activeItem.status == 'new')">
            
            <!-- Event modal -->
            <div class="pt-8 pb-2 mt-12 relative mx-auto w-full bg-white p-6 rounded-lg overflow-y-auto" style="max-width: 600px; max-height: 500px;" >

                <div class="w-full pt-8 block gap-4 py-2 border-b  border-gray-200">
                    
                    <div class="w-full flex mt-10">
                        <div @click="setShowConfirm()" v-if="activeItem.id && activeItem.status == 'active'" class="cursor-pointer absolute left-0 top-4 ml-4 ">
                            <div class="w-full flex gap gap-4">
                            <span class="text-base font-semibold text-red-600 border-red-600 border rounded-lg py-2 px-4" v-text="__('finish')"></span>
                            </div>
                        </div>
                        
                        <label class="absolute top-4 " style="left: auto; right:10px;" v-if="activeItem.device" v-text="activeItem.device.title"></label>
                    </div>
                        
                    <label class="block" v-text="__('game')"></label>

                    <div  class="w-full block gap-4 my-2 text-gray-600 overflow-x-auto">
                        <div class="overflow-x-auto  flex gap gap-6" v-if="games" :style='{"min-width": games.length*35+"%"}' >
                            <label v-for="(game, index) in games"
                                :key="index"  
                                @click="activeItem.game_id = game.id;  submit('Event.update')"
                                :for="'single-'+game.id"  
                                class="block cursor-pointer py-2 w-40 my-2 rounded-lg text-center font-semibold" 
                                :class="activeItem.game_id == game.id ? 'bg-purple-600 hover:bg-purple-600 text-white  hover:text-white' : 'border-purple-600 text-purple-800'" >
                                    <img class="mx-auto w-6 h-6 rounded-full my-2" :src="game.picture">
                                    <span v-text="game.name"></span> 
                                    <input @change="submit('Event.update')"  :id="'id-'+game.id" v-model="activeItem.game_id" :value="game.id" type="radio" name="game_id" class="hidden">
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Applicable products -->
                <div  class="w-full block" v-if="activeItem.status != 'new' && activeItem.products  && activeItem.products.length">
                    <calendar_products_selected ref="selected_products" :item="activeItem"  ></calendar_products_selected>
                </div>

                <!-- Applicable products -->
                <div class="w-full block" v-if="activeItem.status != 'new' && activeItem.id && products && products.length">
                    <calendar_products ref="applicable_products" :item="activeItem" :products="products" ></calendar_products>
                </div>

                <div class="w-full flex gap-4 py-1 border-b border-gray-200 mb-2" v-if="activeItem.customer">
                    <span class="text-md font-semibold w-full block py-2" v-text="__('Customer')"></span>
                    <span class="w-full text-md p-2 text-gray-600 font-semibold"  v-text="activeItem.customer.name +' - '+ activeItem.customer.mobile"></span>
                </div>
                
                <div class="w-full block" v-if="activeItem">
                    <calendar_booking_info_editable :active-item="activeItem"></calendar_booking_info_editable>
                </div>

                <div v-if="!activeItem.id" class="mt-10 w-32 block mx-auto text-white  font-semibold py-2 border-b border-gray-200">
                    <label @click="$parent.storeInfo(activeItem)" class="cursor-pointer px-4 py-2 rounded-lg bg-gradient-primary block"  v-text="__('start_playing')"></label>
                </div>
                <div class="w-full flex mt-10">
                    <div @click="startPlaying()" v-if="activeItem.id && activeItem.status == 'new'" class="mx-auto cursor-pointer block w-32 py-2">
                        <span class="text-base font-semibold text-red-600 border-red-600 border rounded-lg py-2 px-4 hover:bg-purple-600 hover:text-white hover:border-purple-600" v-text="__('start_playing')"></span>
                    </div>
                    <div v-if="activeItem.id" class="w-32 block mx-auto text-white text-center font-semibold py-2 border-b border-gray-200">
                        <label @click="cancelBooking()" class="cursor-pointer px-4 py-2 rounded-lg bg-red-600 hover:bg-purple-600 text-white" v-text="__('cancel booking')"></label>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
const axios = require('axios').default;
import calendar_booking_info_editable from './calendar-booking-info-editable.vue';

export default {
    components: {
        calendar_booking_info_editable
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
            'modal',
        ],
        
        mounted() {
            if (this.modal)
            {
                this.activeItem = JSON.parse(JSON.stringify(this.modal));
                this.query();
            }
        },
        methods: {

            /**
             * Cancel booking with confirmation
             *
             */
            cancelBooking()
            {
                if (window.confirm(this.__('confirm_cancel_booking')))
                    this.$parent.submit('Event.cancel', this.activeItem);
            },

            /**
             * Start playing for new bookings
             */
            startPlaying()
            {
                this.activeItem.status = 'active'; 
                this.$parent.submit('Event.update', this.activeItem)
            },  
            setShowConfirm()
            {
                this.$parent.activeItem = this.activeItem;
                this.$parent.showConfirm = true;
                this.showConfirm = true
            },
            setHideConfirm()
            {
                this.$parent.showConfirm = false;
                this.showConfirm = false
            },
            products_subtotal()
            {
                let subtotal = 0;

                if (this.activeItem.products)
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

            updateInfo(activeItem)
            {
                this.showLoader = true
                this.showUpdate = true
                this.$parent.updateInfo(activeItem)
                this.showLoader = false


            },


            /**
             * Update event data
             */
            submit(type) {
                
                this.$parent.todayEvents = null

                const params = new URLSearchParams([]);
                params.append('type', type);
                params.append('params[event]', JSON.stringify(this.activeItem));
                this.handleRequest(params, '/api/update').then(data => { 
                    console.log(data)
                    this.$parent.checkBookingTotify()
                });
            },



            query()
            {
                if (!this.activeItem.id)
                    return this;

                this.showLoader = true
                const params = new URLSearchParams([]);
                params.append('type', 'OrderDevice');
                params.append('model', 'OrderDevice');
                params.append('id',  this.activeItem.id);
                this.handleRequest(params, '/api').then(response => {
                    this.activeItem = response
                    this.activeItem.start = response.start_time.slice(11, 16);
                    this.activeItem.end = response.end_time.slice(11, 16);
                    this.games = response.device.games;
                    this.products = response.device.products;
                    this.showLoader = false

                })
            },
            addProduct(product)
            {
                const params = new URLSearchParams([]);
                params.append('type', 'OrderDevice.addProduct');
                params.append('model', 'OrderDevice');
                params.append('params[product]', JSON.stringify(product));
                params.append('params[device]', JSON.stringify(this.activeItem));
                this.handleRequest(params, '/api/create').then(response => {
                    this.query()
                    this.$alert(response)
                })
            },
            removeProduct(product)
            {
                const params = new URLSearchParams([]);
                params.append('type', 'OrderDevice.removeProduct');
                params.append('params[product]', JSON.stringify(product));
                this.handleRequest(params, '/api/delete').then(() => {
                    this.query()
                })
            },

            async handleRequest(params, url='/') {

                var t = this;
                // t.showLoader = true
                // Demo json data
                return await axios.post(url, params.toString()).then(response => 
                {
                    // t.showLoader = false

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

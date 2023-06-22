<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">

        <div class=" w-full" v-if="content.devicesList.length < 1">
           <calendar_get_started :categories="content.typesList" v-if="content.title && !content.devicesList.length"></calendar_get_started>
        </div>
        <div class=" w-full" v-if="content.devicesList && lang">
        
            <products_popup v-if="productsPopup" @add-product="load()" ref="applicable_products" :setting="setting" :item="activeItem.active_booking" :products="content.products" ></products_popup>

            <div class="text-base font-medium tracking-widest text-center mb-4 mx-auto rounded-lg flex gap-6 px-2 py-2" >
                <p :class="item.val == activeStatus ? 'px-4 bg-white rounded-full' : ''" v-for="item in filterList" class="cursor-pointer py-2"  v-text="item.title" @click="switchStatus(item.val)"></p>
            </div>
            <div class="w-full grid lg:grid-cols-3 xl:grid-cols-4 gap-6 " style="padding-bottom: 50px;">
                <div class="relative bg-white rounded-lg w-full" style="z-index:9" v-if="checkView(device)"  v-for="device in content.devicesList" >
                    <div class="flex gap-2 w-full p-6">
                        <div>
                            <ps_icon class="w-12 h-12  rounded-lg" ></ps_icon>
                        </div>
                        <div class="w-full">
                            <p class="  text-lg font-medium" v-text="device.name"></p>
                            <p class=" mt-2 text-sm font-medium text-gray-400" v-text="device.category ? device.category.name : '' "></p>
                        </div>
                        <div v-if="device.active_booking"   :title="__(device.active_booking.booking_type)">
                            <users_group_icon :title="__('Multi')" v-if="device.active_booking.booking_type == 'multi'" class="w-8 mb-2 mx-auto"></users_group_icon>
                            <users_icon v-if="device.active_booking.booking_type == 'single'" class="w-8 mb-2 mx-auto"></users_icon>
                        </div>
                        <div class="transform -rotate-180 w-80 h-0.5 absolute border-gray-300" ></div>
                    </div>
                    <div class=" w-full p-4"  v-if="!device.active_booking">
                        <div class="mx-auto w-full flex gap-6 relative bg-white shadow rounded-xl" >
                            <div class="w-full cursor-pointer" @click="setTimeType('limited', device)">
                                <div class="flex items-center justify-center flex-1 h-full px-11 py-3 bg-white border-2 rounded-md border-pink-900">
                                    <p class="text-xs font-black tracking-wide text-center text-pink-900 uppercase" v-text="__('Limited time')"></p>
                                </div>
                            </div>
                            <div class="w-full cursor-pointer" @click="setTimeType('open', device)">
                                <div class="flex items-center justify-center flex-1 h-full px-2 py-3 bg-gray-800 rounded-md">
                                    <p class="text-xs font-bold tracking-wide text-center text-white uppercase" v-text="__('Open time')"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" w-full p-4"  v-if="device.active_booking">
                        <div class="mx-auto w-full flex gap-6 relative bg-white shadow rounded-xl" >
                            <div class="w-full cursor-pointer" @click="addProduct( device)">
                                <div class="flex items-center justify-center flex-1 h-full px-11 py-3 bg-white border-2 rounded-md border-pink-900">
                                    <p class="text-xs font-black tracking-wide text-center text-pink-900 uppercase" v-text="__('sideboard')"></p>
                                </div>
                            </div>
                            <div class="w-full cursor-pointer" @click="endBooking(device)">
                                <div class="flex items-center justify-center flex-1 h-full px-2 py-3 bg-gray-800 rounded-md">
                                    <p class="text-xs font-bold tracking-wide text-center text-white uppercase" v-text="__('finish')"></p>
                                </div>
                            </div>
                        </div>

                        <div class="block mx-auto cursor-pointer mt-4" @click="addBooking(device)">
                            <div class="flex items-center justify-center flex-1 h-full px-2 py-3 bg-gray-800 rounded-md">
                                <p class="text-xs font-bold tracking-wide text-center text-white uppercase" v-text="__('add new booking')"></p>
                            </div>
                        </div>
                    </div>
                    <div v-if="activeItem.id == device.id ">
                        
                        <div class=" w-full p-4" v-if="showLimitedTimeOptions && activeTimeType == 'limited'">
                            <div class="mx-auto w-full flex gap-6 relative  " >
                                <div v-for="limit in LimitedHours" class="w-full py-2 cursor-pointer" :class="limit.val == end_time_minutes ? 'bg-gray-800 text-white rounded-lg' : ''" @click="switchLimitedTime(limit.val)" >
                                    <p class="text-xs font-semibold tracking-wide text-center  uppercase" v-text="limit.title"></p>
                                </div>
                            </div>
                        </div>
                        <div class=" w-full p-4" v-if="showTeamOptions && activeTimeType">
                            <div class="mx-auto w-full flex gap-6 relative text-gray-300 text-center" >
                                <div class="w-full py-2 cursor-pointer" :class="activeBookingType == 'single' ? 'text-gray-800' : ''" @click="setOrder('single')">
                                    <users_icon  class="w-10 mb-2 mx-auto"></users_icon>
                                    <p class="" v-text="__('Single')"></p>
                                </div>
                                <div class="w-full py-2 cursor-pointer" :class="activeBookingType == 'multi' ? 'text-gray-800' : ''"  @click="setOrder('multi')">
                                    <users_group_icon class="w-10 mb-2 mx-auto"></users_group_icon>
                                    <p class="" v-text="__('Multi')"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full"  v-if="setting && (device.active_booking || (device.pending_bookings && device.pending_bookings.length))">
                        <div class="relative bg-white rounded-lg p-2" style="top: 10px; z-index: 9;"></div>
                        <div class=" px-4 py-4 pb-6   bg-gray-800 shadow rounded-lg w-full">
                            <div class="w-full" v-if="device.active_booking">
                                <div class="active-booking-flash py-2 text-base font-semibold flex space-x-56 items-end justify-end w-full" >
                                    <p class=" tracking-widest text-center text-white uppercase w-full text-default" v-text="device.active_booking.duration_now"></p>
                                    <p class=" tracking-widest text-center text-white uppercase" >
                                        <span class="text-xs" v-text="setting.currency"></span>
                                        <span v-text="device.active_booking.subtotal_now"></span>
                                    </p>
                                </div>

                                <div class="py-2 text-base font-semibold flex space-x-56 items-end justify-end w-full" v-if="device.active_booking && device.active_booking.products && device.active_booking.products.length" v-for="product in device.active_booking.products">

                                    <p class=" tracking-widest text-center text-white uppercase w-full text-default" v-text="product.product_name"></p>
                                    <p v-if="" class=" tracking-widest text-center text-white uppercase " >
                                        <span class="text-xs" v-text="setting.currency"></span>
                                        <span v-text="product.subtotal"></span>
                                    </p>
                                </div>
                            </div>

                            <div v-if="device.pending_bookings" v-for="pending_booking in device.pending_bookings">
                                <div class="py-2 text-base font-semibold flex space-x-56 items-end justify-end w-full" >
                                    <p class=" tracking-widest text-center text-white uppercase  w-full text-default" v-text="pending_booking.duration_time"></p>
                                    <p v-if="" class=" tracking-widest text-center text-white uppercase " >
                                        <span class="text-xs" v-text="setting.currency"></span>
                                        <span v-text="pending_booking.subtotal"></span>
                                    </p>
                                </div>
                                <div class="py-2 text-base font-semibold flex space-x-56 items-end justify-end w-full" v-if="pending_booking && pending_booking.products && pending_booking.products.length" v-for="product in pending_booking.products">

                                    <p class=" tracking-widest text-center text-white uppercase w-full text-default" v-text="product.product_name"></p>
                                    <p v-if="" class=" tracking-widest text-center text-white uppercase " >
                                        <span class="text-xs" v-text="setting.currency"></span>
                                        <span v-text="product.subtotal"></span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div v-if="!device.active_booking" class="mt-4 cursor-pointer absolute right-0 left-0 mx-auto top-auto bottom-0 w-40" style="bottom: -20px;">
                            <div class="flex items-center justify-center flex-1 h-full px-11 py-3 bg-white border-2 rounded-md border-pink-900" @click="addToCart(device)" >
                                <span v-text="__('Pay')" class=" active-booking-flash text-xs font-semibold tracking-wide text-center text-pink-900 uppercase "></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full h-full fixed top-0 left-0" v-if="showCart" style="z-index:999">
            <div v-if="showCart" @click="showCart = false ; hideProductsPopup" class="fixed h-full w-full top-0 left-0 bg-gray-800" style="opacity: .6; z-index:9"></div>
            <side_cart class="pt-8" :key="showCart"  ref="side_cart" :cart_items="cart_items" :setting="setting" :currency="setting.currency"></side_cart>
        </div>
    </div>
</template>
<script>
import ps_icon from './svgs/ps.vue'
import users_icon from './svgs/users.vue'
import users_group_icon from './svgs/users_group.vue'
import products_popup from './products_popup.vue'


export default 
{
    components: {
        ps_icon,
        users_icon,
        users_group_icon,
        products_popup,
    },
    name:'devices/manage',
    data() {
        return {
            url: this.conf.url+this.path+'?load=json',
            content: {

                title: '',
                devicesList: [],
                products: [],
                games: [],
                typesList: [],
            },
            selectGames:[],
            activeItem:{games:[]},
            showAddSide:false,
            showEditSide:false,
            showLoader: false,
            showGames: true,
            showDropdown: false,

            activeStatus: 'all',
            filterList : [
                {title: this.__('Busy devices'), val: 'unavailable'},
                {title: this.__('Available devices'), val: 'available'},
                {title: this.__('All'), val: 'all'},
                // {title: this.__('Unpaid bookings'), val: 'unpaid'},
            ],

            showLimitedTimeOptions: false,
            activeTimeType: null,
            showTeamOptions: null,
            activeBookingType: null,
            end_time_minutes: null,
            LimitedHours:[
                {title:this.__('One hour'), val:60},
                {title:this.__('2 hours'), val:120},
                {title:this.__('3 hours'), val:180}
            ],
            productsPopup: null,
            showCart: null,

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
        let t = this
        this.load()

        setInterval(function () {
            t.load()
        }, 60000)
    },

    methods: 
    {
        hidePopup(){},
        reloadEvents(response = null){

            if (response && response.order)
                window.open(this.conf.url+'admin/invoices/show/'+ response.order.code)

            this.load()
        },

        /**
         * Add item to cart
         */
        addToCart(device)
        {
            let data = [];
            if (device && device.pending_bookings && device.pending_bookings.length)
            {
                data = device.pending_bookings;
            }

            if (device && device.active_booking)
                data.push(device.active_booking);

            this.cart_items = data;

            this.showCart = true;

        },


        /**
         * Hide the products popup
         */
        hideProductsPopup()
        {
            this.productsPopup = false
        },  

        /**
         * Finish active booking and 
         * Add new booking
         */
        addBooking(device)
        {
            device.active_booking.status = 'completed'; 
            if (window.confirm(this.__('confirm_add_booking')))
                this.submit('Booking.update', device.active_booking, 'update');

        },    

        /**
         * Check if the device status matches 
         * with the current filters status
         */ 
        checkView(device)
        {
            if (this.activeStatus == 'all')
                return true;

            if (device && device.pending_bookings && device.pending_bookings.length > 0 && this.activeStatus == 'unavailable')
                return true;

            if (device && device.active_booking && this.activeStatus == 'unavailable')
                return true;

            if (device && !device.active_booking && !device.pending_bookings.length && this.activeStatus == 'available')
                return true;

            return false
        },

        /**
         * Switch Status
         */
        switchStatus(val)
        {
            this.activeStatus = val;
        },


        /**
         * Switch time type 
         * Limited  / Open
         */
        setTimeType(type, device)
        {
            this.showLimitedTimeOptions = (type == 'limited') ? true : false
            this.showTeamOptions = (type == 'open') ? true : false
            this.activeTimeType = type
            this.activeItem = device;
            this.activeBookingType = null;
            this.end_time_minutes = null;

        },

        /**
         * Switch limited time 
         * Limited  / Open
         */
        switchLimitedTime(val)
        {
            this.end_time_minutes = val
            this.showTeamOptions = true
            this.activeItem.max_time = val;
        },



        /**
         * add Product to booking
         */
        addProduct(device)
        {
            this.activeItem = device
            this.productsPopup = true
        },

        /**
         * End booking
         */
        endBooking(device)
        {
            let booking = JSON.parse(JSON.stringify(device.active_booking))

            if (booking)
                 booking.status = 'completed';

            if (window.confirm(this.__('confirm_complete_booking'))){
                this.submit('Booking.update', booking, 'update');
                this.cart_items = [];
                this.addToCart(device)
            }



        },

        /**
         * Cancel booking with confirmation
         *
         */
        cancelBooking(device)
        {
            this.activeItem = device;

            if (window.confirm(this.__('confirm_cancel_booking')))
                this.$parent.submit('Event.cancel', this.activeItem);
        },


        /**
         * JHandle  order and submit
         */
        setOrder(type)
        {
            this.activeBookingType = type
            this.submit('Booking.create', this.activeItem)
        },   


        /**
         * Update / Create event data
         */
        submit(type, item = null, request_type = 'create') {

            item.max_time = this.end_time_minutes
            item.booking_type = this.activeBookingType

            const params = new URLSearchParams([]);
            params.append('type', type);
            params.append('params', JSON.stringify(item));

            this.$parent.handleRequest(params, '/api/'+request_type).then(() => { 
                this.load();
                this.showLimitedTimeOptions = false
                this.showTeamOptions = false
                this.end_time_minutes = 0
            });
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
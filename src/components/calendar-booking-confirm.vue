<template>
    <div class="container calendar">

        <div class="relative w-full h-full" v-if="activeItem && activeItem.status == 'active'">

            <div class="mt-10 relative mx-auto w-full bg-white px-6 rounded-lg overflow-y-auto" style="max-width: 600px;">

                <div class="w-full  mt-2 mb-4 pt-2 pb-6" style="max-height: 500px;" >

                    <calendar_booking_info :active-item="activeItem"></calendar_booking_info>

                    <!-- Confirm overlay -->
                    <div class="relative mx-auto w-full bg-white px-6 rounded-lg" style="max-width:600px;z-index:99;">
                        <div class="bg-blue-200 rounded-md py-2 px-4" role="alert">
                            <strong v-text="__('confirm')"></strong> <span class="mx-2" v-text="__('confirm_complete_booking')"></span> 
                            <button @click="showConfirm = false" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <div  class="my-2 cursor-pointer w-full text-white  font-semibold py-2 border-b border-gray-200">
                            <label @click="activeItem.status = 'completed'; $parent.submit('Event.update', activeItem); addToCart(activeItem)" class="w-32 mx-auto py-2 rounded-lg bg-gradient-primary block text-center cursor-pointer" v-text="__('confirm')"></label>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</template>

<script>
const axios = require('axios').default;

export default {
    components: {
    },
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
            }
        },
        methods: {

            hidePopup(type = true)
            {
                this.$root.$refs.medians_calendar.hidePopup(type)
            },

            
            addToCart(activeItem)
            {
                this.$parent.addToCart(activeItem)
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

<template>
    <div class="container calendar">

        <div class="relative w-full h-full" v-if="activeItem && activeItem.status == 'active'">

            <div class="mt-10 relative mx-auto w-full bg-white px-6 rounded-lg overflow-y-auto" style="max-width: 600px;">

                <div class="w-full  mt-2 mb-4 pt-2 pb-6" style="max-height: 500px;" >

                    <calendar_booking_info :key="activeItem" :active-item="activeItem"></calendar_booking_info>

                    <!-- Confirm overlay -->
                    <div class="relative pb-2  mx-auto w-full bg-white px-6 rounded-lg" style="max-width:600px;z-index:99;">

                        <div class="bg-blue-200 rounded-md py-2 px-4" role="alert">
                            <strong v-text="__('confirm')"></strong> <span class="mx-2" v-text="__('confirm_complete_booking')"></span> 
                        </div>

                        <div class="w-full flex mt-10">
                            <div @click="activeItem.status = 'completed'; $parent.submit('Event.update', activeItem); addToCart(activeItem)" class="mx-auto cursor-pointer block w-32 py-2">
                                <span class="cursor-pointer px-4 py-2 rounded-lg bg-red-600 hover:bg-purple-600 text-white" v-text="__('confirm')"></span>
                            </div>
                            <div v-if="activeItem.id" class="w-32 block mx-auto text-white text-center font-semibold py-2 border-b border-gray-200">
                                <label @click="setHideConfirm()" class="text-base font-semibold text-red-600 border-red-600 border rounded-lg py-1 px-4 hover:bg-purple-600 hover:text-white hover:border-purple-600" v-text="__('Back')"></label>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
</template>

<script>
import moment from 'moment';
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
                this.activeItem.status == 'active' ? this.handleTimes() : '';
            }
        },
        methods: {

            /**
             * Hide confirm block
             * 
             */
            setHideConfirm()
            {
                this.$parent.showConfirm = false;
            },  

            /**
             * Handle time at confirm screen
             * with the actual booking time
             */
            handleTimes()
            {

                let now = moment()
                // var booking_duration = moment(this.activeItem.end_time).duration(moment(this.activeItem.end_time).diff(moment(this.activeItem.start_time)));


                var duration = moment.duration(now.diff(moment(this.activeItem.start_time)));
                let hours = moment(now).diff(this.activeItem.start_time, "hours");
                let minutes = parseInt(duration.asMinutes()) % 60;
                let m = minutes > 9 ? minutes : '0'+minutes;
                let time =  (hours > 9 ? hours : '0'+hours) + ( ':'+m );

                if (this.activeItem.status == 'active' && duration.asMinutes() > 0)
                {
                    this.activeItem.extra_time = this.extraTime();
                    this.activeItem.end_time = now;
                    this.activeItem.duration_hours = (duration.asHours()).toFixed(2);
                    this.activeItem.duration_time = time
                    this.activeItem.subtotal = (this.activeItem.duration_hours * this.activeItem.device_cost).toFixed(2);
                    this.activeItem.duration = duration.asMinutes()
                    this.activeItem.to = moment(this.activeItem.start_time).add(duration.asMinutes(),'minutes').format('YYYY-MM-DD HH:mm:ss')
                }

                console.log(this.activeItem)
            } ,

            extraTime()
            {
                let actual_minutes = moment(this.activeItem.date+' '+this.activeItem.end).diff(this.activeItem.start_time, "minutes");

                let current_hours = moment().diff(this.activeItem.start_time, "hours");
                let current_minutes = moment().diff(this.activeItem.start_time, "minutes");

                let minutes = parseInt((current_minutes - actual_minutes).toFixed(2)) % 60;
                
                return {text: this.toHoursAndMinutes((current_minutes - actual_minutes).toFixed(0)), value: (current_minutes - actual_minutes)}; 
            },

            toHoursAndMinutes(totalMinutes) {
              const hours = totalMinutes > 59 ? Math.floor(totalMinutes / 60) : 0;
              const minutes = (totalMinutes > 59 ? totalMinutes % 60 : (totalMinutes > 0 ? totalMinutes : totalMinutes.replace('-', '')));
              return hours > 9 ? hours : '0'+parseInt(hours) +':'+ (minutes > 9 ? minutes : '0'+minutes) ;
            },
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

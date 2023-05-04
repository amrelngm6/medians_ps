<template>
    <div class=" w-full">
        <div v-if="activeItem" >
            <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                <label class="w-full" v-text="__('start')"></label>
                <input @change="submit('Event.update')" class="w-full"  step="900" type="time" v-model="activeItem.start">
            </div>
            <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                <label class="w-full"  v-text="__('end')"></label>
                <input @change="submit('Event.update')" :min="activeItem.start"  step="900" class="w-full" type="time" v-model="activeItem.end">
            </div>
            <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                <label class="w-full"  v-text="__('date')"></label>
                <input disabled class="w-full" type="date" v-model="activeItem.date">
            </div>
            <div class="w-full flex gap-6 my-2 text-gray-600" v-if="activeItem.status != 'new'">
                <label @click="updateBookingType('single', 'Event.update')" for="single"  class="cursor-pointer py-2 w-full mx-2 rounded-lg text-center font-semibold" :class="activeItem.booking_type == 'single' ? 'bg-purple-600 text-white' : ''"   >
                    <span v-text="__('single')"></span> 
                    <input id="signle" v-model="activeItem.booking_type" value="single" type="radio" name="booking_type" class="hidden">
                </label>
                <label @click="updateBookingType('multi', 'Event.update')"  for="multi" class="cursor-pointer py-2 w-full mx-2 rounded-lg text-center font-semibold" :class="activeItem.booking_type == 'multi' ? 'bg-purple-600 text-white' : ''"   > 
                    <span v-text="__('multi')"></span>
                    <input id="multi"  v-model="activeItem.booking_type" value="multi" type="radio" name="booking_type"  class="hidden">
                </label>
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

        updateBookingType(type, event)
        {
            this.activeItem.booking_type = type;
            this.submit(event)
        },
        submit(val)
        {
            this.$parent.submit(val);
        },

        __(i)
        {
            return this.$parent.__(i);
        }
    }
}
</script>

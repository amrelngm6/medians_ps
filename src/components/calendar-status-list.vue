<template>
    <div class="w-full">
        <div >
            <div class="flex flex-wrap">
                <div class="flex items-center mr-4 mb-2">
                    <div class="w-3 h-3 rounded-full bg-purple-600 mr-2"></div>
                    <div v-text="__('active')"></div>
                </div>
                <div class="flex items-center mr-4 mb-2">
                    <div class="w-3 h-3 rounded-full new bg-gradient-purple mr-2"></div>
                    <div v-text="__('new')"></div>
                </div>
                <div class="flex items-center mr-4 mb-2">
                    <div class="w-3 h-3 rounded-full bg-red-500 mr-2"></div>
                    <div v-text="__('completed')"></div>
                </div>
                <div class="flex items-center mr-4 mb-2">
                    <div class="w-3 h-3 rounded-full bg-orange-500 mr-2"></div>
                    <div v-text="__('paid')"></div>
                </div>
                <div class="flex items-center mr-4 mb-2">
                    <div class="w-3 h-3 rounded-full bg-gray-300 mr-2"></div>
                    <div v-text="__('canceled')"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Bookings_status_list',
    components: {},
    props: {},
    methods: {
        __(i)
        {
            return this.$parent.__(i);
        }
    }
}
</script>

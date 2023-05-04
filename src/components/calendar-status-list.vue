<template>
    <div class="w-full">
        <div >
            <span class="cursor-pointer m-2 py-2 px-4 text-center text-purple font-semibold hover:text-red-600" v-text="__('status_options')" @click="showStatusList = !showStatusList"></span>
            
            <div class="flex flex-wrap py-4" v-if="showStatusList">
                <div class="flex items-center mx-4 mb-2 cursor-pointer " id="active-status" @click="switchClass('active', 'active-status')">
                    <div class="w-3 h-3 rounded-full bg-purple-600 mx-2"></div>
                    <div v-text="__('active')"></div>
                </div>
                <div class="flex items-center mx-4 mb-2 cursor-pointer " id="new-status"  @click="switchClass('new','new-status')">
                    <div class="w-3 h-3 rounded-full new bg-gradient-purple mx-2"></div>
                    <div v-text="__('new')"></div>
                </div>
                <div class="flex items-center mx-4 mb-2 cursor-pointer " id="completed-status"  @click="switchClass('completed','completed-status')">
                    <div class="w-3 h-3 rounded-full bg-red-500 mx-2"></div>
                    <div v-text="__('completed')"></div>
                </div>
                <div class="flex items-center mx-4 mb-2 cursor-pointer " id="paid-status"  @click="switchClass('paid','paid-status')">
                    <div class="w-3 h-3 rounded-full bg-orange-500 mx-2"></div>
                    <div v-text="__('paid')"></div>
                </div>
                <div class="flex items-center mx-4 mb-2 cursor-pointer " id="canceled-status"   @click="switchClass('canceled','canceled-status')">
                    <div class="w-3 h-3 rounded-full bg-gray-300 mx-2"></div>
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

    data() {
        return {
            showStatusList: false
        }
    }, 
    methods: {
        switchClass(status, targetId)
        {
            jQuery('.animated.'+status).toggleClass('hidden')
            jQuery('#'+targetId).toggleClass('opacity-5')
        },
        __(i)
        {
            return this.$parent.__(i);
        }
    }
}
</script>

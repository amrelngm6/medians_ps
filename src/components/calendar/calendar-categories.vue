<template>
    <div class="w-full">
        <span class="cursor-pointer m-2 py-2 px-4 text-center text-purple font-semibold hover:text-red-600" v-text="__('Categories')" @click="showCalendarCategories = !showCalendarCategories"></span>
        <div class="lg:flex w-full py-4" v-if="showCalendarCategories">
            <div v-for="category in categories" :key="category.selected" @click="showCalendarCategories = false; $parent.selectCategory(category);showCalendarCategories = true" class="cursor-pointer py-2 px-4 rounded"   >
                <span v-text="category.name"></span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'calendar_categories',
    components: {},
    props: ['categories'],

    data() {
        return {
            showCalendarCategories: false
        }
    }, 
    methods: {

        __(i)
        {
            return this.$parent.__(i);
        }
    }
}
</script>

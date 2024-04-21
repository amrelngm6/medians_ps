<template>
    
    <a href="#" :class="classes" class="card hoverable card-xl-stretch mb-xl-8">
        <!--begin::Body-->
        <div class="card-body">
            <img width="25" height="25" class="mx-auto" :src="icon" />

            <div :class="value_class" class="fw-bold fs-2 mb-2 mt-5"  v-text="value"> </div>

            <div :class="text_class" class="fw-semibold text-gray-400"  v-text="title"></div>
        </div>
        <!--end::Body-->
    </a>

</template>
<script>

export default 
{
    props: [
        'title',
        'value',
        'classes',
        'icon',
    ],

};
</script>

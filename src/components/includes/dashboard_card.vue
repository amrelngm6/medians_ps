<template>
    <div class="col-md-3">
        <div class="card bg-gradient-danger card-img-holder text-white h-100">
            <div class="card-body">
                <img src="/assets/img/circle.png" class="card-img-absolute" alt="circle-image">
                <h4 class="font-weight-normal mb-3" v-text="title"></h4>
                <span class="text-2xl" v-text="value"></span>
            </div>
        </div>
    </div>
</template>
<script>

export default 
{
    props: [
        'title',
        'value',
    ],

};
</script>

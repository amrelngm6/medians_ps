<template>
    <div class=" w-full">
        <!-- Rounded Ribbon -->
        <div class="relative card ribbon-box border shadow-none mb-lg-0">
            <div class="card-body">
                <div class="ribbon ribbon-primary round-shape">Important</div>
                <h5 class="fs-14 text-end">Add new driver</h5>
                <div class="ribbon-content mt-4 text-muted">
                    <p class="mb-0">When you create new driver you should make sure that you have the right <b>Email</b>. Because the generated password will be sent to him</p>
                </div>
            </div>
        </div>
        <data_table_page ref="data_table" :conf="conf" :path="path" :setting="setting" :auth="auth" object_name="Driver" object_key="driver_id" ></data_table_page>
    </div>
</template>
<script>

export default 
{

    props: [
        'path',
        'lang',
        'setting',
        'conf',
        'auth',
    ],
};
</script>
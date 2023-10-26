<template>
    <div class=" w-full">
        <data_table_page :conf="conf" :setting="setting" :auth="auth" object_name="Parents" object_key="parent_id" class="col-md-3" />
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
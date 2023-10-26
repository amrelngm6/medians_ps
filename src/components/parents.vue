<template>
    <div class=" w-full">
        <data_table_page :conf="conf" :setting="setting" :auth="auth" object_name="Parents" object_key="parent_id" ></data_table_page>
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
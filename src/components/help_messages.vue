<template>
    <div class=" w-full">
        <data_table_page :conf="conf" :path="path" :setting="setting" :auth="auth" object_name="HelpMessage" object_key="message_id" ></data_table_page>
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
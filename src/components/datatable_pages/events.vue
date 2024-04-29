<template>
    <div class=" w-full">
        <data_table_page ref="data_table" :conf="conf" :path="path" :setting="setting" :auth="auth" object_name="Event" object_key="event_id" ></data_table_page>
    </div>
</template>
<script>

import data_table_page from './data_table_page.vue';

export default 
{
    components: {
        data_table_page,
    },
    props: [
        'path',
        'lang',
        'setting',
        'conf',
        'auth',
    ],
};
</script>
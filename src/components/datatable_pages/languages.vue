<template>
    <div class=" w-full">
        <data_table_page :currency="currency" ref="data_table" :conf="conf" :path="path" :setting="setting" :auth="auth" object_name="Language" object_key="language_id" ></data_table_page>
    </div>
</template>
<script>

import data_table_page from '@/components/datatable_pages/data_table_page.vue';

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
        'currency'
    ],
};
</script>
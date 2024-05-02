<template>
    <div class=" w-full">
        <data_table_page ref="data_table" :conf="conf" :path="path" :setting="setting" :auth="auth" object_name="Gallert" object_key="gallery_id" ></data_table_page>
    </div>
</template>
<script>

import {defineAsyncComponent} from 'vue';
const data_table_page = defineAsyncComponent(() =>
  import('@/components/datatable_pages/data_table_page.vue')
);

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
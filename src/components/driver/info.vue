<template>
    <div class="w-full card mb-5 mb-xl-10" id="kt_profile_details_view">

                    
    </div>  
                
</template>
<script>

import { ref } from 'vue';
import { translate } from '@/utils.vue';

export default {

    components: {
    },
    setup(props) {

        const activeItem = ref({});

        activeItem.value = props.item;

        return {
            activeItem,
            translate,
        };
    },

    props: [
        'path',
        'lang',
        'setting',
        'system_setting',
        'setting',
        'conf',
        'auth',
        'item',
        'overview',
    ]
};
</script>
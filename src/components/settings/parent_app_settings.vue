<template>
    <div class="w-full " >
        <setting :setting="setting" :conf="conf" :auth="auth" :path="path"></setting>
    </div>
</template>
<script>

import setting from './app_settings.vue';

export default  
{
    components: {
        setting
    },
    name:'App Settings',
    setup(props) {
        
       

        return {
        };
    },
    props: [
        'path',
        'lang',
        'setting',
        'conf',
        'auth',
    ]
};
</script>
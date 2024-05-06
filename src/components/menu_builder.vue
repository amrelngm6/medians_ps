<template>
    <div class=" w-full">
        <h2>Draggable Menu Builder</h2>
        <draggable v-model="menuItems" group="menu" @end="onDragEnd">
        <div v-for="(item, index) in menuItems" :key="item.id" class="menu-item">
            {{ item.label }}
        </div>
        </draggable>
        <button @click="saveMenu">Save Menu</button>
    </div>
</template>
<script>

import {ref} from 'vue';
import draggable from 'vuedraggable'

export default 
{
    components: {
        draggable,
    },
    setup(props) {
        const menuItems =  ref([
                {
                name: "task 1",
                tasks: [
                    {
                    name: "task 2",
                    tasks: []
                    }
                ]
                },
                {
                name: "task 3",
                tasks: [
                    {
                    name: "task 4",
                    tasks: []
                    }
                ]
                },
                {
                name: "task 5",
                tasks: []
                }
            ]
        );
        const saveMenu = () => {

        };
        
        const onDragEnd = () => {

        };

        return {
            menuItems,
            onDragEnd,
            saveMenu
        };
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
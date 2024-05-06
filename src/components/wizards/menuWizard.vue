<template>
  <div class=" w-full">
    
    <div v-if="loader" :key="loader" class="bg-white fixed w-full h-full top-0 left-0" style="z-index:99999; opacity: .9;">
        <img class="m-auto w-500px" :src="'/uploads/loader.gif'" />
    </div>
    <h2 v-text="item.name"></h2>
    <p v-text="translate('Drag & Drop your link for menu') + ' ' + item.type"></p>

    <div class="flex">
      <VueDraggable class="shadow-sm shadow-sm flex flex-col gap-2 p-4 w-300px h-300px m-auto bg-white overflow-auto"
        v-model="list1" animation="150" ghostClass="ghost" group="people" >
        <div v-for="item in list1" :key="item.page_id" class="cursor-move h-30 bg-gray-500/5 rounded p-3">
          {{ item.name }}
        </div>
      </VueDraggable>
      <VueDraggable class="shadow-sm shadow-sm flex flex-col gap-2 p-4 w-300px h-300px m-auto bg-white overflow-auto"
        v-model="list2" animation="150" group="people" ghostClass="ghost" @update="saveItem" @add="saveItem"
        @remove="saveItem">
        <div v-for="item in list2" :key="item.page_id" class="cursor-move h-30 bg-gray-500/5 rounded p-3 my-1">
          {{ item.page ? item.page.name : item.name }}
        </div>
      </VueDraggable>
    </div>
    <div class="flex justify-between">
      <preview-list :list="list1" />
      <preview-list :list="list2" />
    </div>

  </div>
</template>
<script>

import { handleAccess, handleRequest, translate } from '@/utils.vue';
import { ref } from 'vue';
import { VueDraggable } from 'vue-draggable-plus'

export default
  {
    components: {
      VueDraggable,
    },
    setup(props) {
      const loader = ref(false);
      const list1 = ref([
        {
          name: 'Joao',
          page_id: 1
        },
        {
          name: 'Jean',
          page_id: 2
        },
        {
          name: 'Johanna',
          page_id: 3
        },
        {
          name: 'Juan',
          page_id: 4
        }
      ])
      

      const list2 = ref([]);
      list2.value = props.active_links ?? list2.value;
      
      const handleSelected = () => {
        // Concatenate the arrays
        const combinedArray = props.pages.concat(list2.value);
        // Create a set to remove duplicates
        const uniqueObjectsSet = new Set(combinedArray.map(JSON.stringify));

        // Convert the set back to an array
        list1.value =  Array.from(uniqueObjectsSet).map(JSON.parse);
      }
      
      handleSelected();

      const onUpdate = () => {
        saveItem();
      }
      const onAdd = () => {
        saveItem();
        console.log('add')
      }
      const remove = () => {
        saveItem();
        console.log('remove')
      }

      
      const saveItem = () => {
          loader.value = true;
          var params = new URLSearchParams();
          params.append('params[type]', props.item.type )
          params.append('params[items]', JSON.stringify(list2.value) )
          params.append('type', 'Menu.update' )
          handleRequest(params, '/api/update').then(response => {
              loader.value = false;
              handleAccess(response)
          })
      }
      console.log(list2.value)
      console.log(list1.value)

      return {
        loader,
        list1,
        list2,
        translate,
        saveItem,
        onUpdate,
        onAdd,
        remove
      };
    },
    props: [
      'path',
      'lang',
      'setting',
      'conf',
      'auth',
      'pages',
      'active_links',
      'item',
    ],
  };
</script>
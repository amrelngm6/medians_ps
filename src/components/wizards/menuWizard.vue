<template>
  <div class=" w-full">
    
    <div v-if="loader" :key="loader" class="bg-white fixed w-full h-full top-0 left-0" style="z-index:99999; opacity: .9;">
        <img class="m-auto w-500px" :src="'/uploads/loader.gif'" />
    </div>
    <h2 v-text="item.name"></h2>
    <p v-text="translate('Drag & Drop your link for menu') + ' ' + item.type"></p>

    <div class="flex">
      <VueDraggable class="shadow-sm shadow-sm flex flex-col gap-2 p-4 w-300px h-300px m-auto bg-white overflow-auto"
        v-model="allPages" animation="150" ghostClass="ghost" group="people" >
        <div v-for="item in allPages" :key="item.page_id" class="cursor-move h-30 bg-gray-500/5 rounded p-3">
          {{ item.name }}
        </div>
      </VueDraggable>
      <VueDraggable class="shadow-sm shadow-sm flex flex-col gap-2 p-4 w-300px h-300px m-auto bg-white overflow-auto"
        v-model="selectedPages" animation="150" group="people" ghostClass="ghost" @update="saveItem" @add="saveItem"
        @remove="saveItem">
        <div v-for="item in selectedPages" :key="item.page_id" class="cursor-move h-30 bg-gray-500/5 rounded p-3 my-1">
          {{ item.page ? item.page.name : item.name }}
        </div>
      </VueDraggable>
    </div>
    <div class="flex justify-between">
      <preview-list :list="allPages" />
      <preview-list :list="selectedPages" />
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
      const allPages = ref([])
      

      const selectedPages = ref([]);
      allPages.value = props.pages ??  [];
      selectedPages.value = props.active_links ?? [];
      
      const handleSelected = () => {
        // Concatenate the arrays
        const combinedArray = props.pages.concat(selectedPages.value);
        // Create a set to remove duplicates
        const uniqueObjectsSet = new Set(combinedArray.map(JSON.stringify));

        // Convert the set back to an array
        allPages.value =  Array.from(uniqueObjectsSet).map(JSON.parse);
      }
      
      // handleSelected();

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
          params.append('params[items]', JSON.stringify(selectedPages.value.filter(e=> e != null)) )
          params.append('type', 'Menu.update' )
          handleRequest(params, '/api/update').then(response => {
              loader.value = false;
              handleAccess(response)
          })
      }
      console.log(selectedPages.value)
      console.log(allPages.value)

      return {
        loader,
        allPages,
        selectedPages,
        translate,
        saveItem,
        onUpdate,
        onAdd,
        remove
      };
    },
    props: [
      'path',
      'langs',
      'setting',
      'conf',
      'auth',
      'pages',
      'active_links',
      'item',
    ],
  };
</script>
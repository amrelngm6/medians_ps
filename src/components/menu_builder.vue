<template>
    <div class="row">
      <div class="col-3" v-if="list1">
        <h3>Draggable 1</h3>
        <draggable class="list-group" :list="list1" group="people" @change="log">
          <div
            class="list-group-item"
            v-for="(element, index) in list1"
            :key="element.name"
          >
            {{ element.name }} {{ index }}
          </div>
        </draggable>
      </div>
  
      <div class="col-3" v-if="list2">
        <h3>Draggable 2</h3>
        <draggable class="list-group" :list="list2" group="people" @change="log">
          <div
            class="list-group-item"
            v-for="(element, index) in list2"
            :key="element.name"
          >
            {{ element.name }} {{ index }}
          </div>
        </draggable>
      </div>
  
      <rawDisplayer class="col-3" :value="list1" title="List 1" />
  
      <rawDisplayer class="col-3" :value="list2" title="List 2" />
    </div>
  </template>
  <script>
import draggable from 'vuedraggable'
  
  export default {
    name: "two-lists",
    display: "Two Lists",
    order: 1,
    components: {
      draggable
    },
    setup() {

        
      const add  =  () => {
        this.list.push({ name: "Juan" });
      };
      const replace  =  () =>  {
        this.list = [{ name: "Edgard" }];
      };
      const clone =  () => {
        return {
          name: el.name + " cloned"
        };
      };
      const log  =  () =>  {
        window.console.log(evt);
      }


      return {
        add,
        replace,
        log,
        clone,
        list1: [
          { name: "John", id: 1 },
          { name: "Joao", id: 2 },
          { name: "Jean", id: 3 },
          { name: "Gerard", id: 4 }
        ],
        list2: [
          { name: "Juan", id: 5 },
          { name: "Edgard", id: 6 },
          { name: "Johnson", id: 7 }
        ]
      };
    },
    methods: {
    }
  };
  </script>
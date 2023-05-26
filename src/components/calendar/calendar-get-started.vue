<template>
    <div class=" w-full">
        <div class="card" style="direction:ltr;">
            <form action="/api/create" method="POST" id="start-form" class="w-full ajax-form">
                <div class="card-body">
                    <div class="flex text-center " >
                        <div :class="activeTab > 0 ? 'border-gray-600' : 'border-gray-300'" @click="setTab(1)" class="pt-2 w-32 h-10 rounded-full rounded border ">1</div>
                        <div style="height: 1px; margin: auto 5px;" class=" w-full relative overflow-hidden"><span class="border border-b  w-full block m-auto top-0 bottom-0 absolute" :class="activeTab > 0 ? 'border-gray-600' : 'border-gray-300'" > </span></div>
                        <div :class="activeTab > 1 ? 'border-gray-600' : 'border-gray-300'" @click="setTab(2)" class="pt-2 w-32 h-10 rounded-full rounded border ">2</div>
                        <div style="height: 1px; margin: auto 5px;" class=" w-full relative overflow-hidden"><span class="border border-b  w-full block m-auto top-0 bottom-0 absolute" :class="activeTab > 2 ? 'border-gray-600' : 'border-gray-300'"> </span></div>
                        <div :class="activeTab > 2 ? 'border-gray-600' : 'border-gray-300'" @click="setTab(3)" class="pt-2 w-32 h-10 rounded-full rounded border border-gray-300">3</div>
                        <div style="height: 1px; margin: auto 5px;" class=" w-full relative overflow-hidden"><span class="border border-b w-full block m-auto top-0 bottom-0 absolute" :class="activeTab > 3 ? 'border-gray-600' : 'border-gray-300'"> </span></div>
                        <div :class="activeTab > 3 ? 'border-gray-600' : 'border-gray-300'" @click="setTab(4)" class="pt-2 w-32 h-10 rounded-full rounded border ">4</div>
                    </div>
                    <div class="cd-horizontal-timeline loaded">
                        <div class="events-content" >
                            <ol style="direction:rtl;">
                                <li  :class="(activeTab == 1) ? 'selected' : ''">
                                    <h3><small v-text="__('add_new_category')"></small></h3>
                                    <div class="m-t-40">
                                        <div class=" p-8 py-0 mx-auto rounded-lg max-w-xl pb-10">
                                            <label class="block pt-5">{{__('category')}}</label>
                                            <input type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" :placeholder="__('category')" v-model="new_category" value="Playstation"> 
                                            <button type="button" @click="addCategory()" class="uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800">{{__('next')}}</button>
                                        </div>
                                    </div>
                                </li>
                                <li  :class="(activeTab == 2) ? 'selected' : ''">
                                    <h3><small v-text="__('First_step')"></small></h3>
                                    <div class="m-t-40">
                                        <div class=" p-8 py-0 mx-auto rounded-lg max-w-xl pb-10">
                                            <h1 class="m-auto max-w-xl text-2xl mb-10 text-center">{{__('please_add_your_devices_first')}}</h1>
                                            <input name="type" type="hidden" value="Device.create" > 
                                            <input name="params[device][status]"  type="hidden" value="1" > 
                                            <label class="block pt-5">{{__('device_name')}}</label>
                                            <input name="params[device][title]" required="" type="text" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" placeholder="Device Title" value="First device"> 


                                            <label class="block pt-5">{{__('type')}}</label>

                                            <select v-if="cats && cats.length > 0" name="params[device][type]" required="" class="h-12 mt-3 rounded w-full border px-3 text-gray-700  focus:border-blue-100 dark:bg-gray-800  dark:border-gray-600" placeholder="">
                                            <option v-for="type in cats" value="{{type.id}}">{{type.name}}</option>
                                            </select>
                                            
                                            <button type="button"  @click="setTab(2)" class="uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800">{{__('next')}}</button>
                                        </div>
                                    </div>
                                </li>
                                <li  :class="(activeTab == 3) ? 'selected' : ''">
                                    <h3> <small>{{__('third_step')}}</small></h3>
                                    <div class="m-t-40">
                                        
                                        <label class="block pt-5">{{__('single_price')}}</label>
                                        <input name="params[device][prices][single_price]" type="number" class="h-12 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" placeholder="Single price" required>

                                        <label class="block pt-5">{{__('multi_price')}}</label>
                                        <input name="params[device][prices][multi_price]" type="number" class="h-12 mt-3 rounded w-full border px-3 text-gray-400  focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600" placeholder="Multi price" required>

                                        <button type="submit"  class="uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800">{{__('save')}}</button>

                                    </div>
                                </li>
                                <li  :class="(activeTab == 4) ? 'selected' : ''">
                                    <h3> <small>{{__('fourth_step')}}</small></h3>
                                    <div class="m-t-40">
                                        {{__('start')}}
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
const axios = require('axios').default;

export default 
{
    components: {
    },
    name:'Calendar Get started',
    data() {
        return {
            activeTab:1,
            new_category:''
        }
    },
    props: [
        'lang',
        'setting',
        'categories',
        'conf',
        'auth',
    ],
    mounted() 
    {
        this.cats = this.categories;
        (this.cats.length > 0) ? this.setTab(2) : '';
    },

    methods: 
    {

        addCategory()
        {
            if (!this.new_category)
            {
                this.$alert(this.__('name_empty'))
            }
            let t = this;
            var params = new URLSearchParams();
            params.append('type', 'Category.create')
            params.append('params[name]', this.new_category)
            params.append('params[model]', "Medians\\Devices\\Domain\\Device")
            params.append('params[status]', "on")
            this.handleRequest(params, '/api/create').then(response => {
                t.$alert(response.result)
                t.handleGetRequest('/calendar?load=json').then(response => {
                    t.cats = response.typesList
                    t.setTab(2)
                })
            })

        },
        setTab(tab)
        {
            this.activeTab = tab;
        },
        async handleRequest(params, url = '/api') {
            return await this.$parent.handleRequest(params, url);
        },
        async handleGetRequest(url) {
            return await this.$parent.handleGetRequest(url);
        },
        __(i)
        {
            return this.$root.$children[0].__(i);
        }
    }
};
</script>
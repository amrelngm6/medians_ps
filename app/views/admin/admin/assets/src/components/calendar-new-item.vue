<template>
    <div class="w-full" >

        <div class="relative w-full h-full" v-if="!showLoader && activeItem && !activeItem.id">
            
            <!-- Event modal -->
            <div class="top-20 relative mx-auto w-full bg-white p-6 rounded-lg overflow-y-auto" style="max-width: 600px; max-height: 500px;" >

                <div class="w-full block gap-4 py-2 border-b  border-gray-200">
                    <label class="block w-full mt-10" v-text="__('game')"></label>

                    <div  class="w-full block gap-4 my-2 text-gray-600 overflow-x-auto">
                        <div class="overflow-x-auto" v-if="activeItem.device && activeItem.device.games" :style='{"min-width": activeItem.device.games.length*35+"%"}' >
                            <label v-for="(game, index) in activeItem.device.games"
                                :key="index"  
                                @click="activeItem.game_id = game.id;  updateInfo(activeItem)"
                                :for="'single-'+game.id"  
                                class="inline-block cursor-pointer py-2 w-40 my-2 rounded-2xl text-center font-semibold" 
                                :class="activeItem.game_id == game.id ? 'bg-purple-600 text-white' : 'border-purple-600 text-purple-800'" >
                                    <img class="mx-auto w-6 h-6 rounded-full my-2" :src="game.picture">
                                    <span v-text="game.name"></span> 
                                    <input @change="updateInfo(activeItem)"  :id="'id-'+game.id" v-model="activeItem.game_id" :value="game.id" type="radio" name="game_id" class="hidden">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                    <label class="w-full" v-text="__('start')"></label>
                    <input @change="updateInfo(activeItem)" class="w-full" type="time" v-model="activeItem.start">
                </div>
                <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                    <label class="w-full"  v-text="__('end')"></label>
                    <input @change="updateInfo(activeItem)" :min="activeItem.start" class="w-full" type="time" v-model="activeItem.end">
                </div>
                
                <div class="w-full flex gap-4 py-2 border-b border-gray-200">
                    <label class="w-full"  v-text="__('date')"></label>
                    <input disabled class="w-full" type="date" v-model="modal.date">
                </div>
                <div class="w-full flex gap-6 my-2 text-gray-600">
                    <label @click="activeItem.booking_type = 'single';  updateInfo(activeItem)" for="single"  class="cursor-pointer py-2 w-full mx-2 rounded-2xl text-center font-semibold" :class="activeItem.booking_type == 'single' ? 'bg-purple-600 text-white' : ''"   >
                        <span v-text="__('single')"></span> 
                        <input id="signle" v-model="activeItem.booking_type" value="single" type="radio" name="booking_type" class="hidden">
                    </label>
                    <label @click="activeItem.booking_type = 'multi'; updateInfo(activeItem)"  for="multi" class="cursor-pointer py-2 w-full mx-2 rounded-2xl text-center font-semibold" :class="activeItem.booking_type == 'multi' ? 'bg-purple-600 text-white' : ''"   > 
                        <span v-text="__('multi')"></span>
                        <input id="multi"  v-model="activeItem.booking_type" value="multi" type="radio" name="booking_type"  class="hidden">
                    </label>
                </div>
                <div v-if="!activeItem.id" class="mt-10 w-32 block mx-auto text-white  font-semibold py-2 border-b border-gray-200">
                    <label @click="submit('Event.create', activeItem)" class="cursor-pointer px-4 py-2 rounded-lg bg-gradient-primary block"  v-text="__('start_playing')"></label>
                </div>
                <div v-if="activeItem.id && showUpdate" class="mt-10 w-32 block mx-auto text-white text-center font-semibold py-2 border-b border-gray-200">
                    <label @click="submit('Event.update', activeItem)" class="cursor-pointer px-4 py-2 rounded-lg bg-gradient-primary" v-text="__('update')"></label>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
const axios = require('axios').default;

export default {
    data() {

        return {
                
                showLoader: false,
                activeItem: {},

            };
        },
        props: [
            'modal',
            'games'
        ],
        
        mounted() {
            if (this.modal)
            {
                this.activeItem = this.modal;
                console.log(this.modal);
            }
        },
        methods: {

            updateInfo(activeItem)
            {
                this.showLoader = true
                // this.updateInfo(activeItem)
                this.showLoader = false
            },


            /**
             * Update event data
             */
            submit(type, newitem = null) {

                let item = newitem ? newitem : this.activeItem;

                let request_type = item.id ? 'update' : 'create';

                const params = new URLSearchParams([]);
                item.start_time = this.current_day+ ' ' +item.start
                item.end_time = this.current_day+ ' ' +item.end
                params.append('type', type);
                params.append('params[event]', JSON.stringify(item));
                this.handleRequest(params, '/api/'+request_type).then(data => { 
                    this.$parent.reloadEvents();
                    this.$parent.hidePopup()
                });
            },



            async handleRequest(params, url='/') {

                var t = this;
                t.showLoader = true
                // Demo json data
                return await axios.post(url, params.toString()).then(response => 
                {
                    t.showLoader = false

                    if (response.data.status)
                        return response.data.result;
                    else 
                        return response.data;
                 
                });
            },
            __(i)
            {
                return this.$root.langs[i];
            }
        }
    }
</script>

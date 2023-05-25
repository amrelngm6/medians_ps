<template>
    <div class="w-full" >

        <div class="relative w-full h-full  pt-2" v-if="!showLoader && activeItem && !activeItem.id">
            
            <!-- Event modal -->
            <div class="pt-8 mt-12 relative mx-auto w-full bg-white p-6 rounded-lg overflow-y-auto" style="max-width: 600px; max-height: 500px;" >

                <div class="w-full block gap-4 py-2 border-b  border-gray-200">
                    <label class="block w-full mt-10" v-text="__('game')"></label>

                    <div  class="w-full block gap-4 my-2 text-gray-600 overflow-x-auto">
                        <div class="overflow-x-auto flex gap gap-6" v-if="activeItem.device && activeItem.device.games" :style='{"min-width": activeItem.device.games.length*35+"%"}' >
                            <label v-for="(game, index) in activeItem.device.games"
                                :key="index"  
                                @click="activeItem.game_id = game.id;  updateInfo(activeItem)"
                                :for="'single-'+game.id"  
                                class="block cursor-pointer py-2 w-40 my-2 rounded-lg text-center font-semibold" 
                                :class="activeItem.game_id == game.id ? 'bg-purple-600 text-white' : 'border-purple-600 text-purple-800'" >
                                    <img class="mx-auto w-6 h-6 rounded-full my-2" :src="game.picture">
                                    <span v-text="game.name"></span> 
                                    <input @change="updateInfo(activeItem)"  :id="'id-'+game.id" v-model="activeItem.game_id" :value="game.id" type="radio" name="game_id" class="hidden">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="w-full flex gap-4 py-2 border-b border-gray-200 ">
                    <div class="w-full flex gap gap-6">
                        <label class="w-full" v-text="__('Customer')"></label> 
                        <small class="cursor-pointer px-2 font-semibold text-purple w-20" @click="addNewCustomer = true" v-text="__('New cusomter')"></small>
                    </div>
                    <div class="w-full relative">
                        <input type="hidden" v-model="activeItem.customer.mobile">
                        <input type="hidden" v-model="activeItem.customer_id">
                        <input v-on:keyup="findCustomer()" class="w-full rounded w-full border border-gray-200 px-4 py-2" type="text" v-model="search_mobile" :placeholder="__('Mobile')" v-if="!addNewCustomer">
                        <div class="absolute top-0 left-0 mr-2 mt-2 text-lg cursor-pointer" style="height:20px; width: 20px;" @click="customers = false" v-if="customers.length">x</div>

                        <div class="absolute top-0 left-0 w-full block bg-white p-4 border" v-if="customers.length && !addNewCustomer" style="top: 30px;">
                            <span class="block w-full py-2 border-b-1 border-gray-200 my-2 cursor-pointer" v-for="customer in customers" @click="setCustomer(customer)" >
                                <span class="block w-full font-semibold" v-text="customer.name"></span>
                                <span class="block w-full" v-text="customer.mobile"></span>
                            </span>
                        </div>

                        <div class="w-full block bg-white p-4 border flex text-center" v-if="addNewCustomer" >
                            <input class="mb-2 w-full rounded w-full border border-gray-200 px-4 py-2" type="text" v-model="newCustomer.name" :placeholder="__('Name')">
                            <input class="mb-2 w-full rounded w-full border border-gray-200 px-4 py-2" type="text" v-model="newCustomer.mobile" :placeholder="__('Mobile')">
                            <div class="w-full flex ">
                                <span v-text="__('Add')" class="block w-full my-2 cursor-pointer text-red-600 border-red-600 border rounded-lg py-2 px-4 hover:bg-purple-600 hover:text-white hover:border-purple-600"  @click="createCustomer(newCustomer)" ></span>
                                <span v-text="__('cancel')" class="block w-full my-2 cursor-pointer py-2"  @click="addNewCustomer = false" ></span>
                            </div>
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
                    <label @click="activeItem.booking_type = 'single';  updateInfo(activeItem)" for="single"  class="cursor-pointer py-2 w-full mx-2 rounded-lg text-center font-semibold hover:bg-purple-600 hover:text-white " :class="activeItem.booking_type == 'single' ? 'bg-purple-600 text-white' : ''"   >
                        <span v-text="__('single')"></span> 
                        <input id="signle" v-model="activeItem.booking_type" value="single" type="radio" name="booking_type" class="hidden">
                    </label>
                    <label @click="activeItem.booking_type = 'multi'; updateInfo(activeItem)"  for="multi" class="cursor-pointer py-2 w-full mx-2 rounded-lg text-center font-semibold hover:bg-purple-600 hover:text-white " :class="activeItem.booking_type == 'multi' ? 'bg-purple-600 text-white' : ''"   > 
                        <span v-text="__('multi')"></span>
                        <input id="multi"  v-model="activeItem.booking_type" value="multi" type="radio" name="booking_type"  class="hidden">
                    </label>
                </div>
                <div class="w-full flex">
                    <div class="w-full text-center">
                        <div v-if="!activeItem.id" class="mt-10 w-32 block mx-auto text-white  font-semibold py-2 border-b border-gray-200">
                            <label @click="submit('Event.create', activeItem, 'active')" class="text-center cursor-pointer px-4 py-2 rounded-lg bg-gradient-primary block hover:bg-purple-600 hover:text-white "  v-text="__('start_playing')"></label>
                        </div>
                    </div>
                    <div class="w-full text-center">
                        <div v-if="!activeItem.id" class="mt-10 w-32 block mx-auto text-purple  font-semibold py-2 border-b border-gray-200">
                            <label @click="submit('Event.create', activeItem, 'new')" class="hover:bg-purple-600 hover:text-white text-center cursor-pointer px-4 py-2 rounded-lg  block"  v-text="__('create_booking')"></label>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
const axios = require('axios').default;
// import SSH2Promise from 'ssh2-promise';

export default {
    data() {

        return {
                
                showLoader: false,
                addNewCustomer : false,
                search_mobile: '',
                customers: [],
                newCustomer: {},
                activeItem: {customer:{}},

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
                this.activeItem.customer = {}
            }
        },
        methods: {

            /**
             * Foucus out of input
             */
            foucusOut()
            {
                if (this.activeItem.customer && this.activeItem.customer.mobile)
                {
                    this.search_mobile = this.activeItem.customer.mobile + ' - ' + this.activeItem.customer.name; 
                } else {
                    this.search_mobile = ''; 
                    this.customers = []
                }
            },  

            /**
             * Find customer by mobile
             */
            findCustomer()
            {
                if (this.search_mobile)
                {
                    const params = new URLSearchParams([]);
                    params.append('type', 'Customer');
                    params.append('search_text', this.search_mobile);
                    this.handleRequest(params, '/api/search').then((response) => { 
                        this.customers = response.result;
                    });
                }
                // this.updateInfo(activeItem)
            },

            /**
             * create customer by mobile
             */
            createCustomer(customer)
            {
                if (customer && customer.name && customer.mobile)
                {
                    const params = new URLSearchParams([]);
                    params.append('type', 'Customer.create');
                    params.append('params[customer]', JSON.stringify(customer));
                    this.handleRequest(params, '/api/create').then((response) => { 
                        response.error ? this.$alert(response.result) : '';
                        if (response.success)
                        {
                            this.setCustomer(response.result)
                            this.addNewCustomer = false
                            this.customers = []
                        }
                    });
                } else {
                    this.$alert(this.__('NOT_VALID'))
                }

                // this.updateInfo(activeItem)
            },

            /**
             * Find customer by mobile
             */
            setCustomer(customer)
            {
                this.activeItem.customer = customer;
                this.activeItem.customer_id = customer.id
                this.customers = []
                this.search_mobile = this.activeItem.customer.name + ' - ' + this.activeItem.customer.mobile
            },

            updateInfo()
            {
                this.showLoader = true
                // this.updateInfo(activeItem)
                this.showLoader = false
            },


            /**
             * Update event data
             */
            submit(type, newitem = null,status = 'active') {

                let item = newitem ? newitem : this.activeItem;

                let request_type = item.id ? 'update' : 'create';

                const params = new URLSearchParams([]);
                item.start_time = this.current_day+ ' ' +item.start
                item.end_time = this.current_day+ ' ' +item.end
                item.status = status
                params.append('type', type);
                params.append('params[event]', JSON.stringify(item));

                this.showLoader = true
                this.handleRequest(params, '/api/'+request_type).then(() => { 
                    this.showLoader = false
                    this.$parent.reloadEvents();
                    this.$parent.hidePopup()
                });
            },



            async handleRequest(params, url='/') {

                var t = this;
                // Demo json data
                return await axios.post(url, params.toString()).then(response => 
                {

                    if (response.data.status)
                        return response.data.result;
                    else 
                        return response.data;
                 
                });
            },
            __(i)
            {
                return this.$parent.__(i);
            },


            async executeCommand() {
                // const ssh = new SSH2Promise({
                //   host: '192.168.1.10',
                //   port: 22,
                //   username: 'desktop-ddtq7ab\m ewais@192.168.1.10',
                //   password: '1',
                // });

                // try {
                //   await ssh.connect();
                //   const result = await ssh.exec('"C:/nircmd.exe" standby');
                //   console.log(result);
                // } catch (err) {
                //   console.error(err);
                // } finally {
                //   ssh.close();
                // }
            },
        }
    }
</script>

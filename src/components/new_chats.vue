<template>
    <div class=" " v-if="$parent.new_contacts && $parent.new_contacts.length">
        <h1 class="text-xl text-center mx-auto pt-6 ">Pick your customer</h1>
        <p class=" text-center mx-auto pb-6 pt-2 ">You should pick any customer ASAP to help him </p>
        <div class="container mx-auto w-full row grid overflow-auto" style="max-height: calc(100vh - 90px); padding-bottom:100px" >
            <section class="text-gray-600 body-font mt-12 col-6"  v-for="conversation in $parent.new_contacts">
                <div class="container px-2 py-24 mx-auto " v-if="conversation">
                    <div class="p-5 bg-white flex items-center mx-auto border-b  mb-10 border-gray-200 rounded-lg sm:flex-row flex-col">
                        <div class="w-full flex-grow sm:text-left text-center mt-6 sm:mt-0" v-if="conversation.contact">
                            <p class="leading-relaxed text-lg text-gray-600" v-html="conversation.contact.message_emojis && conversation.contact.last_message.message_emojis ? conversation.contact.last_message.message_emojis : conversation.contact.last_message.message_text" ></p>
                            <div class="py-4 "></div>
                            <div class="md:flex font-bold text-gray-600">
                                <div class="w-full md:w-1/2 flex space-x-3">
                                    <div class="w-1/2">
                                        <h2 class="text-gray-500">Name</h2>
                                        <p v-if="conversation.contact" v-html="conversation.contact.name"></p>
                                    </div>
                                    <div class="w-1/2">
                                        <h2 class="text-gray-500">Number</h2>
                                        <p v-if="conversation.contact" v-html="conversation.wa_id"></p>
                                    </div>
                                    <div class="w-1/2">
                                        <h2 class="text-gray-500">Waiting time</h2>
                                        <p v-if="conversation.contact && conversation.contact.last_message" v-html="conversation.contact.last_message.time_ago"></p>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <button @click="joinChat(conversation.wa_id)" class="w-1/2 block mx-auto rounded-full bg-gray-900 hover:shadow-lg font-semibold text-white px-6 py-2">Join Chat</button>
                            
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
const axios = require('axios').default;

export default {
    name: 'app',
    components: {
    },
    data() {
        return {

            url: '/get_new_chats',
            date: '',
            activeItem: null,
            showLoader: false,
            showEditSide: false,
            showTab: true,
            component: {},
            activeTab: 'dashboard',
            status: null,
            lang: {},
            auth: {},
            setting: {},
            system_setting: {},
            conf: {},
            main_menu: [],
            content: {contacts:[]},
            contacts:[],
            show: false,
            showSide: true,
            showModal: false,
            activeModal: null,
        };
    },
    mounted() {
        this.setValues($parent.new_contacts)
        var t = this;
    },

    methods: 
    {
        
        markRead(contact)
        {
            if (contact && contact.last_message)
                (this.$parent.$refs && this.$parent.$refs.activeTab) ? this.$parent.$refs.activeTab.setReadMsg(contact.last_message.id) : null;
        },

        joinConversation(contact)
        {
            if (contact && contact.last_message)
                this.$parent.$refs ? this.joinChat(contact.last_message.sender_id) : null;
        },
        selectContact(contact)
        {

            this.activeItem = contact
            this.showDropdown = false
            
            console.log(this.activeItem)
            this.$parent.$refs.activeTab.active_contact = contact.wa_id
            this.$parent.$refs.activeTab.active_contact_name = contact.name
            this.$parent.$refs.activeTab.load()
            
            jQuery('.tyn-aside-item.js-toggle-main').removeClass('active')
            jQuery('#contact'+contact.id).addClass('active')
        },
        openDropdown()
        {
            this.showDropdown = true
        },
        unelectContact(index)
        {
            this.showLoader = true
            if (this.content.contacts)
            {
                this.content.contacts[index] = null; 
            } 
            this.showLoader = false
        },
        
        joinChat(id = null)
        {
            var params = new URLSearchParams();
            params.append('type', 'WP')
            params.append('contact_id',id)
            this.$parent.handleRequest( params, '/join_contact/'+id ).then(response=> {
                this.load()
            });
        },
        
        load()
        {
            this.showLoader = true;
            this.$parent.handleGetRequest( this.url ).then(response=> {
                this.setValues(response)
                this.showLoader = false;
                // this.$alert(response)
            });
        },
        
        setValues(data) {
            this.content = JSON.parse(JSON.stringify(data)); return this
             
        },
        __(i)
        {
            return this.$root.$children[0].__(i);
        }
    }
}
</script>
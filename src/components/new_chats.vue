<template>
    <div class=" " v-if="content.contacts && content.contacts.length">
        
        <section class="text-gray-600 body-font mt-12" v-for="conversation in content.contacts">
            <div class="container px-5 py-24 mx-auto " v-if="conversation">
                <div class="p-5 bg-white flex items-center mx-auto border-b  mb-10 border-gray-200 rounded-lg sm:flex-row flex-col">
                    <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                        <p class="leading-relaxed text-base" >Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
                        <div class="py-4 "></div>
                        <div class="md:flex font-bold text-gray-800">
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
                                    <p v-if="conversation.last_message" v-html="conversation.last_message.time_ago"></p>
                                </div>
                            </div>
                        </div>
                        <button class="w-1/2 block mx-auto rounded-full bg-gray-900 hover:shadow-lg font-semibold text-white px-6 py-2">Join Chat</button>
                        <a class="mt-3 text-indigo-500 inline-flex items-center">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                        </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>
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
        this.load()
        var t = this;
        setInterval(function(){
            t.load()
        }, 6000);
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
            console.log(data)
            this.content = JSON.parse(JSON.stringify(data)); return this
             
        },
        __(i)
        {
            return this.$root.$children[0].__(i);
        }
    }
}
</script>
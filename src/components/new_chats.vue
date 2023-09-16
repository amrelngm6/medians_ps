<template>
    <div class=" " v-if="$parent.new_contacts && $parent.new_contacts.length">
        <h1 class="text-xl text-center mx-auto pt-6 ">Pick your customer</h1>
        <p class=" text-center mx-auto pb-6 pt-2 ">You should pick any customer ASAP to help him </p>
        <div class="container mx-auto w-full overflow-auto" style="max-height: calc(100vh - 90px); padding-bottom:100px">
            <div v-for="conversation in $parent.new_contacts" id="tynChatHead" class="my-2 tyn-chat-head bg-white p-2">
                <ul class="tyn-list-inline d-md-none ms-n1">
                    <li><button class="btn btn-icon btn-md btn-pill btn-transparent js-toggle-main"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                viewBox="0 0 16 16" class="bi bi-arrow-left">
                                <path fill-rule="evenodd"
                                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z">
                                </path>
                            </svg></button></li>
                </ul>
                <div class="tyn-media-group">
                    <div class="tyn-media tyn-size-lg d-none d-sm-inline-flex"><img src="/uploads/user.svg" alt=""></div>
                    <div class="tyn-media tyn-size-rg d-sm-none"><img src="/uploads/user.svg" alt=""></div>
                    <div class="tyn-media-col">
                        <div class="tyn-media-row">
                            <h6 class="name">Daralteb</h6>
                        </div>
                        <div class="tyn-media-row has-dot-sap"><span class="meta" v-text="conversation.wa_id" ></span></div>
                    </div>
                </div>
                <ul class="tyn-list-inline gap gap-3 ms-auto">
                    <li><p class="font-bold text-base" v-html="conversation.message_emojis ? conversation.message_emojis : conversation.message_text"></p></li>
                    <li><button class="btn btn-icon btn-light  has-tooltip" @click="joinChat(conversation.wa_id)" 
                            data-original-title="null"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" viewBox="0 0 16 16" class="bi bi-layout-sidebar-inset-reverse">
                                <path
                                    d="M2 2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h12z">
                                </path>
                                <path d="M13 4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V4z"></path>
                            </svg></button></li>
                </ul>
            </div>
        </div>
        <div class="container mx-auto w-full row grid overflow-auto"
            style="max-height: calc(100vh - 90px); padding-bottom:100px">
            <section class="text-gray-600 body-font mt-12 col-6" v-for="conversation in $parent.new_contacts">
                <div class="container px-2 py-24 mx-auto " v-if="conversation">
                    <div
                        class="p-5 bg-white flex items-center mx-auto border-b  mb-10 border-gray-200 rounded-lg sm:flex-row flex-col">
                        <div class="w-full flex-grow sm:text-left text-center mt-6 sm:mt-0" v-if="conversation.contact">
                            <p class="leading-relaxed text-lg text-gray-600"
                                v-html="conversation.contact.message_emojis && conversation.contact.last_message.message_emojis ? conversation.contact.last_message.message_emojis : conversation.contact.last_message.message_text">
                            </p>
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
                                        <p v-if="conversation.contact && conversation.contact.last_message"
                                            v-html="conversation.contact.last_message.time_ago"></p>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <button @click="joinChat(conversation.wa_id)"
                                class="w-1/2 block mx-auto rounded-full bg-gray-900 hover:shadow-lg font-semibold text-white px-6 py-2">Join
                                Chat</button>

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
            content: { contacts: [] },
            contacts: [],
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

        markRead(contact) {
            if (contact && contact.last_message)
                (this.$parent.$refs && this.$parent.$refs.activeTab) ? this.$parent.$refs.activeTab.setReadMsg(contact.last_message.id) : null;
        },

        joinConversation(contact) {
            if (contact && contact.last_message)
                this.$parent.$refs ? this.joinChat(contact.last_message.sender_id) : null;
        },
        selectContact(contact) {

            this.activeItem = contact
            this.showDropdown = false

            console.log(this.activeItem)
            this.$parent.$refs.activeTab.active_contact = contact.wa_id
            this.$parent.$refs.activeTab.active_contact_name = contact.name
            this.$parent.$refs.activeTab.load()

            jQuery('.tyn-aside-item.js-toggle-main').removeClass('active')
            jQuery('#contact' + contact.id).addClass('active')
        },
        openDropdown() {
            this.showDropdown = true
        },
        unelectContact(index) {
            this.showLoader = true
            if (this.content.contacts) {
                this.content.contacts[index] = null;
            }
            this.showLoader = false
        },

        joinChat(id = null) {
            var params = new URLSearchParams();
            params.append('type', 'WP')
            params.append('contact_id', id)
            this.$parent.handleRequest(params, '/join_contact/' + id).then(response => {
                this.load()
            });
        },

        load() {
            this.showLoader = true;
            this.$parent.handleGetRequest(this.url).then(response => {
                this.setValues(response)
                this.showLoader = false;
                // this.$alert(response)
            });
        },

        setValues(data) {
            this.content = JSON.parse(JSON.stringify(data)); return this

        },
        __(i) {
            return this.$root.$children[0].__(i);
        }
    }
}
</script>
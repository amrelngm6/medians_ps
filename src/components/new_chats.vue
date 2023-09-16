<template>
    <div class="w-full" >
        <div class="container mx-auto mt-4 " >
            <h1 class="text-xl  mx-auto pt-6 " v-text="__('new chats')"></h1>
            <p class="mx-auto pb-6 pt-2 " v-text="__('new chats note')"> </p>
            <div class="container mx-auto w-full overflow-auto" v-if="$parent.new_contacts && $parent.new_contacts.length" style="max-height: calc(100vh - 150px); padding-bottom:100px">
                <div v-for="conversation in $parent.new_contacts" class="w-full my-4 ">
                    <div id="tynChatHead" class="tyn-chat-head bg-white p-2">

                        <div class="tyn-media-group" v-if="conversation.contact">
                            <div class="tyn-media tyn-size-lg d-none d-sm-inline-flex"><img src="/uploads/user.svg" alt=""></div>
                            <div class="tyn-media tyn-size-rg d-sm-none"><img src="/uploads/user.svg" alt=""></div>
                            <div class="tyn-media-col">
                                <div class="tyn-media-row">
                                    <h6 class="name" v-text="conversation.contact.name"></h6>
                                </div>
                                <div class="tyn-media-row has-dot-sap"><span class="meta" v-text="conversation.wa_id" ></span></div>
                            </div>
                        </div>
                        <p class=" px-4 chat-list-msg-web font-bold text-base" v-html="conversation.contact.last_message.message_emojis ? conversation.contact.last_message.message_emojis : conversation.contact.last_message.message_text"></p>
                        <ul class="tyn-list-inline gap gap-3 ms-auto" v-if="conversation.contact.last_message">
                            <li><button @click="joinChat(conversation.wa_id)" class="hover:bg-gray-600  text-sm block mx-auto rounded-full bg-gray-900 hover:shadow-lg font-semibold text-white px-6 py-2">Join Chat</button></li>
                        </ul>
                    </div>
                    <p class=" bg-white px-4 rounded-full py-2 mt-3 mb-4 chat-list-msg-mobile font-bold text-base " v-html="conversation.contact.last_message.message_emojis ? conversation.contact.last_message.message_emojis : conversation.contact.last_message.message_text"></p>
                </div>
            </div>
            <emptydata v-if="!$parent.new_contacts.length"></emptydata>

            <!-- <div class="container mx-auto w-full row grid overflow-auto"
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
            </div> -->
        </div>
    </div>
</template>

<script>
const axios = require('axios').default;
import emptydata from './includes/emptydata.vue'

export default {
    name: 'app',
    components: {
        emptydata
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
        this.setValues(this.$parent.new_contacts)
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

            this.$parent.switchTab({link: "messages"});
            this.activeItem = contact
            this.showDropdown = false
            var t = this;
            setTimeout(function(){
                t.$parent.$refs.activeTab.active_contact = contact.wa_id
                t.$parent.$refs.activeTab.active_contact_name = contact.name
                t.$parent.$refs.activeTab.load()
            })

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
            var t = this;
            var params = new URLSearchParams();
            params.append('type', 'WP')
            params.append('contact_id', id)
            this.$parent.handleRequest(params, '/join_contact/' + id).then(response => {
                if (response && response.contact) {
                    t.selectContact(response.contact);
                } else {
                    this.load
                }
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
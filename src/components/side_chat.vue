<template>
    <div class=" ">
        <div class=" w-full p-2 h-full">
            <div class="tyn-aside ">
                <div class="tyn-aside-head">
                    <div class="tyn-aside-head-text">
                        <h3 class="tyn-aside-title">Chats</h3>
                    </div>
                    <div class="tyn-aside-head-tools">
                        <ul class="link-group gap gx-3">
                            <li class="dropdown hidden">
                                <button class="link" data-bs-toggle="modal" data-bs-target="#newChat">
                                    <!-- plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg>
                                    <span>New</span>
                                </button>
                            </li><!-- li -->
                            <li class="dropdown">
                                <button class="link dropdown-toggle" data-bs-toggle="dropdown" data-bs-offset="0,10">
                                    <!-- filter -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                                        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                    <span>Filter</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="tyn-list-links nav nav-tabs border-0">
                                        <li>
                                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#all-chats">
                                                <!-- chat-square-text -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-square-text" viewBox="0 0 16 16">
                                                    <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                                    <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                                                </svg>
                                                <span>All Chats</span>
                                            </button>
                                        </li>
                                        <li>
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#active-contacts">
                                                <!-- person-check -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                                                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                                                    <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z" />
                                                </svg>
                                                <span>Active Contacts</span>
                                            </button>
                                        </li>
                                        <li>
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#archived-chats">
                                                <!-- archive -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive" viewBox="0 0 16 16">
                                                    <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                                                </svg>
                                                <span>Archived Chats</span>
                                            </button>
                                        </li>
                                        <li>
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#spam-messages">
                                                <!-- bookmark-x -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-x" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M6.146 5.146a.5.5 0 0 1 .708 0L8 6.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 7l1.147 1.146a.5.5 0 0 1-.708.708L8 7.707 6.854 8.854a.5.5 0 1 1-.708-.708L7.293 7 6.146 5.854a.5.5 0 0 1 0-.708z" />
                                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                                </svg>
                                                <span>Spam Messages</span>
                                            </button>
                                        </li>
                                        <li>
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#trash-bin">
                                                <!-- trash -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                                <span>Trash Bin</span>
                                            </button>
                                        </li>
                                    </ul><!-- .nav -->
                                </div><!-- .dropdown-menu -->
                            </li><!-- li -->
                        </ul><!-- .link-group -->
                    </div><!-- .tyn-aside-head-tools -->
                </div><!-- .tyn-aside-head -->
                <div class="tyn-aside-body" data-simplebar>

                    <div class="tyn-aside-search mt-4 hidden">
                        <div class="form-group tyn-pill">
                            <div class="form-control-wrap">
                                <div class="form-control-icon start">
                                    <!-- search -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </div>
                                <input type="text" class="form-control form-control-solid" id="search" placeholder="Search contact / chat">
                            </div>
                        </div>
                    </div><!-- .tyn-aside-search -->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="all-chats" tabindex="0" role="tabpanel"  v-if="!showLoader && content.contacts.length">
                            <ul class="tyn-aside-list" v-if="content && content.contacts">
                                <li v-for="contact in content.contacts" :id="'contact'+contact.id" class="my-2 tyn-aside-item js-toggle-main ">
                                    <div class="tyn-media-group">
                                        <div @click="selectContact(contact)"  class="tyn-media tyn-size-lg">
                                            <img src="/uploads/user.svg" alt="">
                                        </div>
                                        <div class="tyn-media-col" @click="selectContact(contact)" >
                                            <div class="tyn-media-row">
                                                <h6 class="name" v-text="contact.name"></h6>
                                            </div>
                                            <div class="tyn-media-row has-dot-sap"  :class="(contact.msg && !contact.msg.read && contact.msg.income ) ? 'text-green-400' : ''">
                                                <svg style="width:45px" v-if="contact.msg && !contact.msg.income" :class="contact.msg && contact.msg.read ? 'text-blue-400' : 'text-gray-400'"  viewBox="0 0 18 18" height="18" width="18" version="1.1" x="0px" y="0px" enable-background="new 0 0 18 18" xml:space="preserve"><path fill="currentColor" d="M17.394,5.035l-0.57-0.444c-0.188-0.147-0.462-0.113-0.609,0.076l-6.39,8.198 c-0.147,0.188-0.406,0.206-0.577,0.039l-0.427-0.388c-0.171-0.167-0.431-0.15-0.578,0.038L7.792,13.13 c-0.147,0.188-0.128,0.478,0.043,0.645l1.575,1.51c0.171,0.167,0.43,0.149,0.577-0.039l7.483-9.602 C17.616,5.456,17.582,5.182,17.394,5.035z M12.502,5.035l-0.57-0.444c-0.188-0.147-0.462-0.113-0.609,0.076l-6.39,8.198 c-0.147,0.188-0.406,0.206-0.577,0.039l-2.614-2.556c-0.171-0.167-0.447-0.164-0.614,0.007l-0.505,0.516 c-0.167,0.171-0.164,0.447,0.007,0.614l3.887,3.8c0.171,0.167,0.43,0.149,0.577-0.039l7.483-9.602 C12.724,5.456,12.69,5.182,12.502,5.035z"></path></svg>
                                                <p class="content w-full"  :class="contact.msg.read ? 'font-normal' : 'font-semibold'" v-if="contact.msg" v-html="contact.msg.message_emojis ? contact.msg.message_emojis : contact.msg.message_text"></p>
                                                <span class="meta" v-if="contact.msg" v-html="contact.msg.time_ago"></span>
                                            </div>
                                        </div>
                                        <div class="tyn-media-option tyn-aside-item-option">
                                            <ul class="tyn-media-option-list">
                                                <li class="dropdown">
                                                    <button class="btn btn-icon btn-white btn-pill dropdown-toggle" data-bs-toggle="dropdown" data-bs-offset="0,0" data-bs-auto-close="outside">
                                                        <!-- three-dots -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                                        </svg>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="tyn-list-links">
                                                            <li><p class="my-0 px-3 py-2 gap-2 text-sm cursor-pointer flex" @click="markRead(contact)">
                                                                    <!-- check -->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                                                    </svg>
                                                                    <span>Mark as Read</span>
                                                                </p></li>
                                                                
                                                            <li><p class="my-0 px-3 py-2 gap-2 text-sm cursor-pointer flex" @click="joinConversation(contact)">
                                                                    <!-- exclamation-triangle -->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                                                        <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
                                                                        <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z" />
                                                                    </svg>
                                                                    <span>Join</span>
                                                                </p></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li><!-- .tyn-aside-item -->

                            </ul>
                        </div><!-- .tab-pane -->
                        <div class="tab-pane" id="trash-bin" tabindex="0" role="tabpanel">
                            <div class="tyn-aside-row text-center">
                                <h6>Nothing in trash</h6>
                                <p> Lets delete someting to test it. </p>
                            </div>
                        </div><!-- .tab-pane -->
                    </div><!-- .tab-content -->
                </div><!-- .tyn-aside-body -->
            </div><!-- .tyn-aside -->
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

            url: '/load_contacts',
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
        // this.load()
        var t = this;
        setInterval(function(){
            // t.load()
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
            this.$parent.handleGetRequest( this.url ).then(response=> {
                this.setValues(response)
                // this.$alert(response)
            });
        },
        
        setValues(data) {
            console.log(data)
            this.showLoader = true;
            this.content = JSON.parse(JSON.stringify(data)); return this
            this.showLoader = false;
             
        },
        __(i)
        {
            return this.$root.$children[0].__(i);
        }
    }
}
</script>
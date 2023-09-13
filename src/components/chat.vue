<template>
    <div class="tyn-main tyn-chat-content" id="tynMain">
        <div v-if="!messages || messages && messages.length < 1">
            <div class="tyn-profile-head" v-for="contact in contacts()">
                <div class="tyn-profile-info">
                    <div class="tyn-media-group align-items-start">
                        <div class="tyn-media tyn-media-bordered tyn-size-4xl tyn-profile-avatar">
                            <img src="images/user.svg" alt="">
                        </div>
                        <div class="tyn-media-col">
                            <div class="tyn-media-row">
                                <h4 class="name"><span v-html="contact.name"></span> <span class="username" v-html="contact.wa_id"></span></h4>
                            </div>
                            <div class="tyn-media-row has-dot-sap">
                                <span class="content">287 Contacts</span>
                                <span class="meta">8 Mutual</span>
                            </div>
                        </div>
                    </div><!-- .tyn-media-group -->
                </div><!-- .tyn-profile-info -->
            </div>
        </div>
        <div class="w-full" v-if="messages && messages.length">
            <div class="tyn-chat-head bg-white p-2" id="tynChatHead">
                <ul class="tyn-list-inline d-md-none ms-n1">
                    <li>
                        <button class="btn btn-icon btn-md btn-pill btn-transparent js-toggle-main">
                            <!-- arrow-left -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                            </svg>
                        </button>
                    </li>
                </ul>
                <div class="tyn-media-group">
                    <div class="tyn-media tyn-size-lg d-none d-sm-inline-flex">
                        <img src="/uploads/user.svg" alt="">
                    </div>
                    <div class="tyn-media tyn-size-rg d-sm-none">
                        <img src="/uploads/user.svg" alt="">
                    </div>
                    <div class="tyn-media-col">
                        <div class="tyn-media-row">
                            <h6 class="name" v-text="active_contact_name"></h6>
                        </div>
                        <div class="tyn-media-row has-dot-sap">
                            <span class="meta" v-text="active_contact"></span>
                        </div>
                    </div>
                </div>
                <ul class="tyn-list-inline gap gap-3 ms-auto ">

                    <li class="hidden "><button class="btn btn-icon btn-light js-toggle-chat-search ">
                            <!-- search -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button></li>
                    <li><button class="btn btn-icon btn-light js-toggle-chat-options" v-tooltip="'Show customer info'" @click="switchAside">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-layout-sidebar-inset-reverse" viewBox="0 0 16 16">
                                <path
                                    d="M2 2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h12z" />
                                <path d="M13 4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V4z" />
                            </svg>
                        </button></li>
                </ul>
                <div class="tyn-chat-search" id="tynChatSearch">
                    <div class="flex-grow-1">
                        <div class="form-group">
                            <div class="form-control-wrap form-control-plaintext-wrap">
                                <div class="form-control-icon start">
                                    <!-- search -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </div>
                                <input type="text" class="form-control form-control-plaintext" id="searchInThisChat"
                                    placeholder="Search in this chat">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap gap-3">
                        <ul class="tyn-list-inline ">
                            <li><button class="btn btn-icon btn-sm btn-transparent">
                                    <!-- chevron-up -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-chevron-up" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z" />
                                    </svg>
                                </button></li>
                            <li><button class="btn btn-icon btn-sm btn-transparent">
                                    <!-- chevron-down -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </button></li>
                        </ul>
                        <ul class="tyn-list-inline ">
                            <li><button class="btn btn-icon btn-md btn-light js-toggle-chat-search">
                                    <!-- x-lg -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path
                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                    </svg>
                                </button></li>
                        </ul>
                    </div>
                </div>
            </div><!-- .tyn-chat-head -->
            <div class="tyn-chat-body js-scroll-to-end" id="tynChatBody">
                <div class="tyn-reply" id="tynReply">

                    <div v-for="message in messages" :class="message.income ? 'incoming' : 'outgoing'"
                        class="tyn-reply-item ">
                        <div class="tyn-reply-group">
                            <div class="tyn-reply-bubble"
                                :class="(message.reply_message && message.message_type != 'reaction' && message.reply_message.id) ? 'block' : ''"
                                @click="setReadMsg(message.id)">
                                <span v-if="message.reaction && message.reaction.id"
                                    class="p-1 bg-white absolute left-0 bottom-0 w-8 h-8 rounded-full"
                                    v-html="message.reaction.message_emojis"
                                    style="max-width: none;left: -20px; z-index: 9;"></span>

                                <div v-if="message.reply_message && message.message_type != 'reaction' && message.reply_message.id"
                                    class="p-1 bg-gray-100 relative left-0 bottom-0 w-auto rounded-full"
                                    style="max-width: none;">
                                    <chat-msg-block :isreply="1" :income="message.income"
                                        :message="message.reply_message"></chat-msg-block>
                                </div>
                                <div v-if="message">
                                    <chat-msg-block :message="message"></chat-msg-block>
                                </div>
                            </div><!-- .tyn-reply-bubble -->
                        </div><!-- .tyn-reply-group -->
                    </div><!-- .tyn-reply-item -->

                </div><!-- .tyn-reply -->
            </div><!-- .tyn-chat-body -->
            <div class="tyn-chat-form w-full bg-white px-4 " id="tynChatForm">
                <div class="tyn-chat-form-insert pb-2">
                    <ul class="tyn-list-inline gap gap-3">

                        <li class="d-none d-sm-block" v-tooltip="'Upload image'"><label
                                class="btn btn-icon btn-light btn-md btn-pill">
                                <!-- card-image -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-card-image" viewBox="0 0 16 16">
                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                    <path
                                        d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" />
                                </svg>
                                <input type="file" class="hidden hide" accept="image/*" @change="uploadImage($event)" />
                            </label></li>

                        <li class="d-none d-sm-block"><label v-tooltip="'Upload File'"
                                class="btn btn-icon btn-light btn-md btn-pill">
                                <!-- card-image -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-filetype-docx" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5Zm-6.839 9.688v-.522a1.54 1.54 0 0 0-.117-.641.861.861 0 0 0-.322-.387.862.862 0 0 0-.469-.129.868.868 0 0 0-.471.13.868.868 0 0 0-.32.386 1.54 1.54 0 0 0-.117.641v.522c0 .256.04.47.117.641a.868.868 0 0 0 .32.387.883.883 0 0 0 .471.126.877.877 0 0 0 .469-.126.861.861 0 0 0 .322-.386 1.55 1.55 0 0 0 .117-.642Zm.803-.516v.513c0 .375-.068.7-.205.973a1.47 1.47 0 0 1-.589.627c-.254.144-.56.216-.917.216a1.86 1.86 0 0 1-.92-.216 1.463 1.463 0 0 1-.589-.627 2.151 2.151 0 0 1-.205-.973v-.513c0-.379.069-.704.205-.975.137-.274.333-.483.59-.627.257-.147.564-.22.92-.22.357 0 .662.073.916.22.256.146.452.356.59.63.136.271.204.595.204.972ZM1 15.925v-3.999h1.459c.406 0 .741.078 1.005.235.264.156.46.382.589.68.13.296.196.655.196 1.074 0 .422-.065.784-.196 1.084-.131.301-.33.53-.595.689-.264.158-.597.237-.999.237H1Zm1.354-3.354H1.79v2.707h.563c.185 0 .346-.028.483-.082a.8.8 0 0 0 .334-.252c.088-.114.153-.254.196-.422a2.3 2.3 0 0 0 .068-.592c0-.3-.04-.552-.118-.753a.89.89 0 0 0-.354-.454c-.158-.102-.361-.152-.61-.152Zm6.756 1.116c0-.248.034-.46.103-.633a.868.868 0 0 1 .301-.398.814.814 0 0 1 .475-.138c.15 0 .283.032.398.097a.7.7 0 0 1 .273.26.85.85 0 0 1 .12.381h.765v-.073a1.33 1.33 0 0 0-.466-.964 1.44 1.44 0 0 0-.49-.272 1.836 1.836 0 0 0-.606-.097c-.355 0-.66.074-.911.223-.25.148-.44.359-.571.633-.131.273-.197.6-.197.978v.498c0 .379.065.704.194.976.13.271.321.48.571.627.25.144.555.216.914.216.293 0 .555-.054.785-.164.23-.11.414-.26.551-.454a1.27 1.27 0 0 0 .226-.674v-.076h-.765a.8.8 0 0 1-.117.364.699.699 0 0 1-.273.248.874.874 0 0 1-.401.088.845.845 0 0 1-.478-.131.834.834 0 0 1-.298-.393 1.7 1.7 0 0 1-.103-.627v-.495Zm5.092-1.76h.894l-1.275 2.006 1.254 1.992h-.908l-.85-1.415h-.035l-.852 1.415h-.862l1.24-2.015-1.228-1.984h.932l.832 1.439h.035l.823-1.439Z">
                                    </path>
                                </svg>
                                <input type="file" class="hidden hide" accept="document/*" @change="uploadFile($event)" />
                            </label></li>

                    </ul>
                </div>
                <div class="tyn-chat-form-enter">
                    <textarea class="tyn-chat-form-input" id="tynChatInput" @keydown.enter.exact="validate(event)"
                        v-model="chat_message"></textarea>
                    <ul class="tyn-list-inline me-n2 my-1">
                        <!-- <li><button class="btn btn-icon btn-white btn-md btn-pill">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mic-fill" viewBox="0 0 16 16">
                                    <path d="M5 3a3 3 0 0 1 6 0v5a3 3 0 0 1-6 0V3z" />
                                    <path d="M3.5 6.5A.5.5 0 0 1 4 7v1a4 4 0 0 0 8 0V7a.5.5 0 0 1 1 0v1a5 5 0 0 1-4.5 4.975V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 .5-.5z" />
                                </svg>
                            </button></li> -->
                        <li><button class="btn btn-icon btn-white btn-md btn-pill" @click="validate()">
                                <!-- send-fill -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-send-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                                </svg>
                            </button></li>
                    </ul>
                </div>
            </div><!-- .tyn-chat-form -->
            <div v-if="showAside" class="tyn-chat-content-aside w-full show-aside bg-white" id="tynChatAside"
                data-simplebar>
                <div class="tyn-chat-cover">
                    <img src="/uploads/user.svg" alt="">
                </div>
                <div class="tyn-media-group tyn-media-vr tyn-media-center mt-n4">
                    <div class="tyn-media tyn-size-xl border border-2 border-white">
                        <img src="/uploads/user.svg" alt="">
                    </div>
                    <div class="tyn-media-col">
                        <div class="tyn-media-row">
                            <h6 class="name" v-html="active_contact_name"></h6>
                        </div>
                        <div class="tyn-media-row has-dot-sap">
                            <span class="meta" v-html="active_contact"></span>
                        </div>
                    </div>
                </div>
                <div class="tyn-aside-row p-2">
                    <ul class="nav nav-btns nav-btns-stretch nav-btns-light">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#chat-media" type="button">
                                <!-- images -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-images" viewBox="0 0 16 16">
                                    <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    <path
                                        d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z" />
                                </svg>
                                <span>Media</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link " data-bs-toggle="tab" data-bs-target="#chat-options" type="button">
                                <!-- sliders -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-sliders" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z" />
                                </svg>
                                <span>Options</span>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content px-2">
                    <div class="tab-pane  show active" id="chat-media" tabindex="0">
                        <div class="tyn-aside-row py-0">
                            <ul class="nav nav-tabs nav-tabs-line">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#chat-media-images"
                                        type="button"> Images </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#chat-media-videos"
                                        type="button"> Videos </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#chat-media-audio"
                                        type="button"> Audio </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#chat-media-files"
                                        type="button"> Files </button>
                                </li>
                            </ul>
                        </div>
                        <div class="tyn-aside-row">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="chat-media-images" tabindex="0">
                                    <div class="row g-3">
                                        <div class="col-4" v-for="message in messages"
                                            v-if="message.message_type == 'image'">
                                            <a :href="message.media_path" class="glightbox tyn-thumb"
                                                data-gallery="side-image-gallery">
                                                <img :src="message.media_path" class="tyn-image" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div><!-- .tab-pane -->
                                <div class="tab-pane" id="chat-media-videos" tabindex="0">
                                    <div class="row g-3">
                                        <div class="col-6" v-for="message in messages"
                                            v-if="message.message_type == 'video' || message.is_video">
                                            <a :href="message.media_path" class="glightbox tyn-video"
                                                data-gallery="side-video-gallery">
                                                <img src="/uploads/images/video.jpg" class="tyn-image" alt="">
                                                <div class="tyn-video-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div><!-- .tab-pane -->
                                <div class="tab-pane" id="chat-media-audio" tabindex="0">
                                    <div class="row g-3">
                                        <div class="col-6" v-for="message in messages"
                                            v-if="message.message_type == 'audio'">
                                            <a :href="message.media_path" class="glightbox tyn-video"
                                                data-gallery="side-video-gallery">
                                                <img src="/uploads/images/video.jpg" class="tyn-image" alt="">
                                                <div class="tyn-video-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div><!-- .tab-pane -->
                                <div class="tab-pane" id="chat-media-files" tabindex="0">
                                    <ul class="tyn-media-list gap gap-3">
                                        <li v-for="message in messages" v-if="message.message_type == 'document'">
                                            <a :href="message.media_path" class="tyn-file">
                                                <div class="tyn-media-group">
                                                    <div class="tyn-media tyn-size-lg text-bg-light">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-filetype-docx"
                                                            viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5Zm-6.839 9.688v-.522a1.54 1.54 0 0 0-.117-.641.861.861 0 0 0-.322-.387.862.862 0 0 0-.469-.129.868.868 0 0 0-.471.13.868.868 0 0 0-.32.386 1.54 1.54 0 0 0-.117.641v.522c0 .256.04.47.117.641a.868.868 0 0 0 .32.387.883.883 0 0 0 .471.126.877.877 0 0 0 .469-.126.861.861 0 0 0 .322-.386 1.55 1.55 0 0 0 .117-.642Zm.803-.516v.513c0 .375-.068.7-.205.973a1.47 1.47 0 0 1-.589.627c-.254.144-.56.216-.917.216a1.86 1.86 0 0 1-.92-.216 1.463 1.463 0 0 1-.589-.627 2.151 2.151 0 0 1-.205-.973v-.513c0-.379.069-.704.205-.975.137-.274.333-.483.59-.627.257-.147.564-.22.92-.22.357 0 .662.073.916.22.256.146.452.356.59.63.136.271.204.595.204.972ZM1 15.925v-3.999h1.459c.406 0 .741.078 1.005.235.264.156.46.382.589.68.13.296.196.655.196 1.074 0 .422-.065.784-.196 1.084-.131.301-.33.53-.595.689-.264.158-.597.237-.999.237H1Zm1.354-3.354H1.79v2.707h.563c.185 0 .346-.028.483-.082a.8.8 0 0 0 .334-.252c.088-.114.153-.254.196-.422a2.3 2.3 0 0 0 .068-.592c0-.3-.04-.552-.118-.753a.89.89 0 0 0-.354-.454c-.158-.102-.361-.152-.61-.152Zm6.756 1.116c0-.248.034-.46.103-.633a.868.868 0 0 1 .301-.398.814.814 0 0 1 .475-.138c.15 0 .283.032.398.097a.7.7 0 0 1 .273.26.85.85 0 0 1 .12.381h.765v-.073a1.33 1.33 0 0 0-.466-.964 1.44 1.44 0 0 0-.49-.272 1.836 1.836 0 0 0-.606-.097c-.355 0-.66.074-.911.223-.25.148-.44.359-.571.633-.131.273-.197.6-.197.978v.498c0 .379.065.704.194.976.13.271.321.48.571.627.25.144.555.216.914.216.293 0 .555-.054.785-.164.23-.11.414-.26.551-.454a1.27 1.27 0 0 0 .226-.674v-.076h-.765a.8.8 0 0 1-.117.364.699.699 0 0 1-.273.248.874.874 0 0 1-.401.088.845.845 0 0 1-.478-.131.834.834 0 0 1-.298-.393 1.7 1.7 0 0 1-.103-.627v-.495Zm5.092-1.76h.894l-1.275 2.006 1.254 1.992h-.908l-.85-1.415h-.035l-.852 1.415h-.862l1.24-2.015-1.228-1.984h.932l.832 1.439h.035l.823-1.439Z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div class="tyn-media-col">
                                                        <h6 class="name"
                                                            v-html="message.message_text ? message.message_text : message.media_title">
                                                        </h6>
                                                        <div class="meta" v-text="message.time_ago"></div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                    </ul>
                                </div><!-- .tab-pane -->
                                <div class="tab-pane" id="chat-media-links" tabindex="0">
                                    <ul class="tyn-media-list gap gap-3">

                                        <li>
                                        </li>
                                    </ul>
                                </div><!-- .tab-pane -->
                            </div>
                        </div>
                    </div><!-- .tab-pane -->
                    <div class="tab-pane " id="chat-options" tabindex="0">
                        <div class="tyn-aside-row">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="chat-options-manage" tabindex="0">
                                    <ul class="tyn-media-list gap gap-3">
                                        <li>
                                            <a href="#!" class="tyn-file">
                                                <div class="tyn-media-group">
                                                    <div class="tyn-media text-bg-light">
                                                        <!-- person-x-fill -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-person-x-fill"
                                                            viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z" />
                                                        </svg>
                                                    </div>
                                                    <div class="tyn-media-col">
                                                        <h6 class="name">Add label</h6>
                                                        <div class="meta">Mark this conversation with a label.</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#endChat" data-bs-toggle="modal">
                                                <div class="tyn-media-group">
                                                    <div class="tyn-media text-bg-light">
                                                        <!-- exclamation-triangle-fill -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-exclamation-triangle-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                        </svg>
                                                    </div>
                                                    <div class="tyn-media-col">
                                                        <h6 class="name">End conversation</h6>
                                                        <div class="meta">End the conversation with the customer</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div><!-- .tab-pane -->
                            </div>
                        </div>
                    </div><!-- .tab-pane -->
                </div>
            </div><!-- .tyn-chat-content-aside -->
        </div><!-- .tyn-chat-content -->

        <div class="modal fade show block" tabindex="-1" v-if="uploading" id="uploading">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content border-0">
                    <div class="modal-body">
                        <div class="py-4 px-4 text-center">
                            <h3>Uploading ...</h3>
                        </div>
                    </div><!-- .modal-body -->
                </div><!-- .modal-content -->
            </div><!-- .modal-dialog -->
        </div><!-- .modal -->

            
        <div class="modal fade" tabindex="-1" id="endChat" style="background-color:rgba(0,0,0,.5)">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content border-0">
                    <div class="modal-body">
                        <div class="py-4 px-4 text-center">
                            <h3>End conversation</h3>
                            <p class="small">Once you end this conversation, you will no longer be able to see or reply to this again.</p>
                            <ul class="tyn-list-inline gap gap-3 pt-1 justify-content-center">
                                <li>
                                    <button class="btn btn-danger" @click="endConversation(active_contact)" data-bs-dismiss="modal">End</button>
                                </li>
                                <li>
                                    <button class="btn btn-light" data-bs-dismiss="modal">No</button>
                                </li>
                            </ul>
                        </div>
                    </div><!-- .modal-body -->
                    <button class="btn btn-md btn-icon btn-pill btn-white shadow position-absolute top-0 end-0 mt-n3 me-n3" data-bs-dismiss="modal">
                        <!-- x-lg -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                        </svg>
                    </button>
                </div><!-- .modal-content -->
            </div><!-- .modal-dialog -->
        </div><!-- .modal -->

        
    </div>
</template>
<script>
const axios = require('axios').default;

import GLightbox from 'glightbox';

import chatMsgBlock from './includes/chat-msg-block.vue';

export default {
    components: { chatMsgBlock },
    computed: {},
    data() {
        return {
            url: '/load_messages',
            chat_message: '',
            uploading: false,
            showAside: false,
            showMenu: true,
            same_page: false,
            content: {},
            pages: [],
            active_contact: 0,
            active_contact_name: '',
            lastMessage: { id: 0 },
            intervalId:0,
            messages: []
        }
    },
    props: ['menus', 'samepage', 'auth'],
    created: function () {
        this.pages = this.menus;
        this.activePage = this.samepage;
    },

    mounted() {
        var t = this;
        t.load()
        this.intervalId = setInterval(function () {
            t.load()
        }, 5000);

    },

    beforeDestroy() {
        if (this.intervalId) {
            clearInterval(this.intervalId);
        }
    },
    methods: {

        contacts()
        {
            if (this.$parent.contacts)
                return this.$parent.contacts;

            return [];

        },


        /**
         * Show sidebar
         */
        switchAside() {
            if (!this.showAside) {
                jQuery('#tynChatBody').css('width', 'calc(100% - 300px)')
                jQuery('#tynChatHead').css('width', 'calc(100% - 300px)')
                jQuery('#tynChatForm').css('width', 'calc(100% - 300px)')
                setTimeout(function () {
                    var lightbox = GLightbox({ selector: ".glightbox" });
                    console.log(lightbox)
                }, 1000);
            } else {
                jQuery('#tynChatBody').css('width', '100%')
                jQuery('#tynChatHead').css('width', '100%')
                jQuery('#tynChatForm').css('width', '100%')
            }
            this.showAside = !this.showAside;

        },

        /**
         * check if the text has link
         */
        checkHasLink(message) {
            return (message && message.indexOf('http') > -1) ? true : false;
        },

        /**
         * Upload image to WP
         */
        uploadImage($event) {
            let file = $event.target.files[0];

            const formData = new FormData();
            formData.append('file', file);
            const headers = { 'Content-Type': 'multipart/form-data' };

            this.uploading = true;
            // Demo json data
            return axios.post('/wp/send_image', formData, headers).then(response => {
                this.load()
                this.uploading = false;
            });

        },

        /**
         * Upload picture to WP
         */
        uploadFile($event) {
            let file = $event.target.files[0];

            const formData = new FormData();
            formData.append('file', file);
            const headers = { 'Content-Type': 'multipart/form-data' };

            this.uploading = true;
            // Demo json data
            return axios.post('/wp/send_file', formData, headers).then(response => {
                this.load()
                this.uploading = false;
            });

        },


        validate(event = null) {

            if (event && event.shiftKey === true)
                return null;

            // let titleElement = jQuery(document.querySelector("#tynChatInput"));
            // let msg =  titleElement.html()
            // this.chat_message = msg.trim() ? msg : null

            // this.chat_message ? jQuery('.tyn-chat-form-input').html(' ') : ''
            this.chat_message ? this.sendMessage() : null

        },

        sendMessage() {
            var params = new URLSearchParams();
            params.append('type', 'WP')
            params.append('message_text', this.chat_message)
            params.append('wa_id', this.active_contact)

            this.showLoader = true;
            this.$parent.handleRequest(params, '/api/send_message').then(response => {
                let val = JSON.parse(JSON.stringify(response));
                
                this.chat_message = '';
                
                if (val.error)
                    return this.$alert(val.error.message);

                this.load();
                

            });
        },

        findText(text, div) {
            var scrollTop = $('#' + div).scrollTop();
            var pos = $("div:contains('" + text + "'):eq(5)").position();
            $('#' + div).scrollTop(scrollTop + pos.top);
        },

        endConversation(id = null)
        {
            var params = new URLSearchParams();
            params.append('type', 'WP')
            params.append('contact_id',id)
            this.$parent.handleRequest( params, '/end_chat/'+id ).then(response=> {
                this.$parent.checkPending()
                window.reload()
            });
        },
        
        
        load() {
            
            if (!this.active_contact)
                return null;

            this.showLoader = true;
            this.$parent.handleGetRequest(this.url + '?active_contact=' + this.active_contact).then(response => {
                this.setValues(response)
                this.showLoader = false;

                // this.$alert(response)
            });
        },


        setReadMsg(id = null) {
            let _id = id ? id : this.lastMessage.id;
            var params = new URLSearchParams();
            params.append('type', 'WP')
            params.append('msg_id', _id)
            this.$parent.handleRequest(params, '/read_message/' + _id).then(response => {
            });
        },

        setValues(data) {
            this.messages = JSON.parse(JSON.stringify(data));
            let lastMsg = this.messages[this.messages.length - 1];
            console.log('Check last msg')
            console.log(lastMsg)
            console.log(this.lastMessage)
            if (lastMsg && lastMsg.id > this.lastMessage.id) {
                if (this.lastMessage.income && this.lastMessage.id > 0)
                    this.$parent.notify('.', lastMsg.message_text ? lastMsg.message_text : 'New message from ' + lastMsg.sender_id)

                this.lastMessage = lastMsg;
                this.setReadMsg(this.lastMessage.id)
                setTimeout(() => {
                    document.getElementById("tynReply").scrollIntoView(false)
                }, 500);
            }


            setTimeout(function () {
                var lightbox = GLightbox({ selector: ".glightbox" });
                console.log(lightbox)
            }, 1000);

            return this

        },
        __(i) {
            return this.$root.$children[0].__(i);
        }

    }
};
</script>

<style lang="css">.sidebar-menu {
    min-height: calc(100vh - 100px);
}</style>
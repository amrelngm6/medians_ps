<template>
    <div class="tyn-main tyn-chat-content" id="tynMain">
        <div class="w-full">
            <div class="tyn-chat-head">
                <ul class="tyn-list-inline d-md-none ms-n1">
                    <li><button class="btn btn-icon btn-md btn-pill btn-transparent js-toggle-main">
                            <!-- arrow-left -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                            </svg>
                        </button></li>
                </ul>
                <div class="tyn-media-group">
                    <div class="tyn-media tyn-size-lg d-none d-sm-inline-flex">
                        <img src="/uploads/images/1.jpg" alt="">
                    </div>
                    <div class="tyn-media tyn-size-rg d-sm-none">
                        <img src="/uploads/images/1.jpg" alt="">
                    </div>
                    <div class="tyn-media-col">
                        <div class="tyn-media-row">
                            <h6 class="name">Jasmine <span class="d-none d-sm-inline-block">Thompson</span></h6>
                        </div>
                        <div class="tyn-media-row has-dot-sap">
                            <span class="meta">Active</span>
                        </div>
                    </div>
                </div>
                <ul class="tyn-list-inline gap gap-3 ms-auto">
                    
                    <li class="d-none d-sm-block"><button class="btn btn-icon btn-light js-toggle-chat-search">
                            <!-- search -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button></li>
                    <li><button class="btn btn-icon btn-light js-toggle-chat-options">
                            <!-- layout-sidebar-inset-reverse -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-sidebar-inset-reverse" viewBox="0 0 16 16">
                                <path d="M2 2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h12z" />
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </div>
                                <input type="text" class="form-control form-control-plaintext" id="searchInThisChat" placeholder="Search in this chat">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap gap-3">
                        <ul class="tyn-list-inline ">
                            <li><button class="btn btn-icon btn-sm btn-transparent">
                                    <!-- chevron-up -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z" />
                                    </svg>
                                </button></li>
                            <li><button class="btn btn-icon btn-sm btn-transparent">
                                    <!-- chevron-down -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </button></li>
                        </ul>
                        <ul class="tyn-list-inline ">
                            <li><button class="btn btn-icon btn-md btn-light js-toggle-chat-search">
                                    <!-- x-lg -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                    </svg>
                                </button></li>
                        </ul>
                    </div>
                </div>
            </div><!-- .tyn-chat-head -->
            <div class="tyn-chat-body js-scroll-to-end" id="tynChatBody">
                <div class="tyn-reply" id="tynReply">
                    
                    <div v-for="message in messages" :class="message.income ? 'incoming' : 'outgoing'" class="tyn-reply-item ">
                        <div class="tyn-reply-group">
                            <div class="tyn-reply-bubble">
                                <div v-if="message.message_type === 'image'" class="tyn-reply-media">
                                    <a :title="message.message_text"  :href="message.image_path" class="glightbox tyn-thumb" data-gallery="media-photo">
                                        <img :src="message.image_path" class="tyn-image" alt="">
                                    </a>
                                </div>
                                <div v-if="!message.message_type || message.message_type === 'text'" class="tyn-reply-text"> 
                                    <a v-if="checkHasLink(message.message_text)"  v-text="message.message_text"></a>
                                    <span v-else >{{message.message_text}}</span>
                                </div>
                            </div><!-- .tyn-reply-bubble -->
                        </div><!-- .tyn-reply-group -->
                    </div><!-- .tyn-reply-item -->
                    
                </div><!-- .tyn-reply -->
            </div><!-- .tyn-chat-body -->
            <div class="tyn-chat-form w-full bg-white px-4 pb-4">
                <div class="tyn-chat-form-insert">
                    <ul class="tyn-list-inline gap gap-3">
                        <li class="dropup">
                            <button class="btn btn-icon btn-light btn-md btn-pill" data-bs-toggle="dropdown" data-bs-offset="0,10">
                                <!-- plus-lg -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                                </svg>
                            </button>
                            <div class="dropdown-menu">
                                <ul class="tyn-list-links">
                                    <li><a href="#">
                                            <!-- person-video2 -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-video2" viewBox="0 0 16 16">
                                                <path d="M10 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                                <path d="M2 1a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2ZM1 3a1 1 0 0 1 1-1h2v2H1V3Zm4 10V2h9a1 1 0 0 1 1 1v9c0 .285-.12.543-.31.725C14.15 11.494 12.822 10 10 10c-3.037 0-4.345 1.73-4.798 3H5Zm-4-2h3v2H2a1 1 0 0 1-1-1v-1Zm3-1H1V8h3v2Zm0-3H1V5h3v2Z" />
                                            </svg>
                                            <span>New Group</span>
                                        </a></li>
                                    <li><a href="#">
                                            <!-- mic -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mic" viewBox="0 0 16 16">
                                                <path d="M3.5 6.5A.5.5 0 0 1 4 7v1a4 4 0 0 0 8 0V7a.5.5 0 0 1 1 0v1a5 5 0 0 1-4.5 4.975V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 .5-.5z" />
                                                <path d="M10 8a2 2 0 1 1-4 0V3a2 2 0 1 1 4 0v5zM8 0a3 3 0 0 0-3 3v5a3 3 0 0 0 6 0V3a3 3 0 0 0-3-3z" />
                                            </svg>
                                            <span>Voice Clip</span>
                                        </a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="d-none d-sm-block"><label class="btn btn-icon btn-light btn-md btn-pill">
                                <!-- card-image -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                    <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" />
                                </svg>
                                <input type="file" class="hidden hide" accept="image/*" @change="uploadImage($event)" />
                            </label></li>
                            
                        <li class="d-none d-sm-block"><label class="btn btn-icon btn-light btn-md btn-pill">
                                <!-- card-image -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                    <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" />
                                </svg>
                                <input type="file" class="hidden hide" accept="document/*" @change="uploadFile($event)" />
                            </label></li>
                            
                    </ul>
                </div>
                <div class="tyn-chat-form-enter">
                    <div class="tyn-chat-form-input" id="tynChatInput" @keydown.enter="validate" contenteditable></div>
                    <ul class="tyn-list-inline me-n2 my-1">
                        <li><button class="btn btn-icon btn-white btn-md btn-pill">
                                <!-- mic-fill -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mic-fill" viewBox="0 0 16 16">
                                    <path d="M5 3a3 3 0 0 1 6 0v5a3 3 0 0 1-6 0V3z" />
                                    <path d="M3.5 6.5A.5.5 0 0 1 4 7v1a4 4 0 0 0 8 0V7a.5.5 0 0 1 1 0v1a5 5 0 0 1-4.5 4.975V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 .5-.5z" />
                                </svg>
                            </button></li>
                        <li><button class="btn btn-icon btn-white btn-md btn-pill" @click="validate">
                                <!-- send-fill -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                    <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                                </svg>
                            </button></li>
                    </ul>
                </div>
            </div><!-- .tyn-chat-form -->
            <div class="tyn-chat-content-aside" id="tynChatAside" data-simplebar>
                <div class="tyn-chat-cover">
                    <img src="/uploads/images/1.jpg" alt="">
                </div>
                <div class="tyn-media-group tyn-media-vr tyn-media-center mt-n4">
                    <div class="tyn-media tyn-size-xl border border-2 border-white">
                        <img src="/uploads/images/1.jpg" alt="">
                    </div>
                    <div class="tyn-media-col">
                        <div class="tyn-media-row">
                            <h6 class="name">Konstantin Frank</h6>
                        </div>
                        <div class="tyn-media-row has-dot-sap">
                            <span class="meta">Active Now</span>
                        </div>
                    </div>
                </div>
                <div class="tyn-aside-row">
                    <ul class="nav nav-btns nav-btns-stretch nav-btns-light">
                        <li class="nav-item">
                            <button class="nav-link js-chat-mute-toggle tyn-chat-mute" type="button">
                                <span class="icon unmuted-icon">
                                    <!-- bell-fill -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z" />
                                    </svg>
                                </span>
                                <span class="unmuted-icon">Mute</span>
                                <span class="icon muted-icon">
                                    <!-- bell-slash-fill -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-slash-fill" viewBox="0 0 16 16">
                                        <path d="M5.164 14H15c-1.5-1-2-5.902-2-7 0-.264-.02-.523-.06-.776L5.164 14zm6.288-10.617A4.988 4.988 0 0 0 8.995 2.1a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 7c0 .898-.335 4.342-1.278 6.113l9.73-9.73zM10 15a2 2 0 1 1-4 0h4zm-9.375.625a.53.53 0 0 0 .75.75l14.75-14.75a.53.53 0 0 0-.75-.75L.625 15.625z" />
                                    </svg>
                                </span>
                                <span class="muted-icon">Muted</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#chat-media" type="button">
                                <!-- images -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                                    <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z" />
                                </svg>
                                <span>Media</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#chat-options" type="button">
                                <!-- sliders -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z" />
                                </svg>
                                <span>Options</span>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane" id="chat-media" tabindex="0">
                        <div class="tyn-aside-row py-0">
                            <ul class="nav nav-tabs nav-tabs-line">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#chat-media-images" type="button"> Images </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#chat-media-videos" type="button"> Videos </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#chat-media-files" type="button"> Files </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#chat-media-links" type="button"> Links </button>
                                </li>
                            </ul>
                        </div>
                        <div class="tyn-aside-row">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="chat-media-images" tabindex="0">
                                    <div class="row g-3">
                                        
                                        <div class="col-4">
                                            <a href="/uploads/images/6.jpg" class="glightbox tyn-thumb" data-gallery="media-photo">
                                                <img src="/uploads/images/thumb-6.jpg" class="tyn-image" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div><!-- .tab-pane -->
                                <div class="tab-pane" id="chat-media-videos" tabindex="0">
                                    <div class="row g-3">
                                        
                                        <div class="col-6">
                                            <a href="https://www.youtube.com/watch?v=ag0qTaAKqT8" class="glightbox tyn-video" data-gallery="media-video">
                                                <img src="/uploads/images/hr-6.jpg" class="tyn-image" alt="">
                                                <div class="tyn-video-icon">
                                                    <!-- play-fill -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z" />
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div><!-- .tab-pane -->
                                <div class="tab-pane" id="chat-media-files" tabindex="0">
                                    <ul class="tyn-media-list gap gap-3">
                                        
                                        <li>
                                            <a href="#" class="tyn-file">
                                                <div class="tyn-media-group">
                                                    <div class="tyn-media tyn-size-lg text-bg-light">
                                                        <!-- filetype-mdx -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-mdx" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM.706 15.849v-2.66h.038l.952 2.159h.516l.946-2.16h.038v2.661h.715V11.85h-.8l-1.14 2.596h-.026L.805 11.85H0v3.999h.706Zm3.559-3.999v3.999h1.459c.402 0 .735-.08.999-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.066-.778-.196-1.075a1.426 1.426 0 0 0-.59-.68c-.263-.156-.598-.234-1.004-.234h-1.46Zm.79.645h.563c.248 0 .451.05.61.152a.89.89 0 0 1 .354.454c.078.201.117.452.117.753 0 .227-.022.424-.067.592a1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.484.082h-.562v-2.707Zm4.787-.645h.894L9.46 13.857l1.254 1.992h-.908l-.85-1.415h-.035l-.852 1.415h-.862l1.24-2.016L7.22 11.85h.932l.832 1.439h.035l.823-1.439Z" />
                                                        </svg>
                                                    </div>
                                                    <div class="tyn-media-col">
                                                        <h6 class="name">blog_posts.mdx</h6>
                                                        <div class="meta">6.19 MB</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div><!-- .tab-pane -->
                                <div class="tab-pane" id="chat-media-links" tabindex="0">
                                    <ul class="tyn-media-list gap gap-3">
                                        <li>
                                            <a href="#" class="tyn-links">
                                                <div class="tyn-media-group">
                                                    <div class="tyn-media tyn-size-xl">
                                                        <img src="/uploads/images/thumb-7.jpg" alt="">
                                                    </div>
                                                    <div class="tyn-media-col">
                                                        <h6 class="name">Digital Marketing Guide</h6>
                                                        <div class="anchor">https://www.envato.com/blog/digital-marketing-guide/</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="tyn-links">
                                                <div class="tyn-media-group">
                                                    <div class="tyn-media tyn-size-xl">
                                                        <img src="/uploads/images/thumb-8.jpg" alt="">
                                                    </div>
                                                    <div class="tyn-media-col">
                                                        <h6 class="name">Atomic power plant engine</h6>
                                                        <div class="anchor">https://www.envato.com/atomic-power-plant-engine/</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div><!-- .tab-pane -->
                            </div>
                        </div>
                    </div><!-- .tab-pane -->
                    <div class="tab-pane show active" id="chat-options" tabindex="0">
                        <div class="tyn-aside-row">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="chat-options-manage" tabindex="0">
                                    <ul class="tyn-media-list gap gap-3">
                                        <li>
                                            <a href="#" class="tyn-file">
                                                <div class="tyn-media-group">
                                                    <div class="tyn-media text-bg-light">
                                                        <!-- person-x-fill -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x-fill" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z" />
                                                        </svg>
                                                    </div>
                                                    <div class="tyn-media-col">
                                                        <h6 class="name">Block</h6>
                                                        <div class="meta">Frank will no longer be in your contact.</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="tyn-file">
                                                <div class="tyn-media-group">
                                                    <div class="tyn-media text-bg-light">
                                                        <!-- exclamation-triangle-fill -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                        </svg>
                                                    </div>
                                                    <div class="tyn-media-col">
                                                        <h6 class="name">Report</h6>
                                                        <div class="meta">Give feedback on the conversation</div>
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

    </div>
</template>
<script>
const axios = require('axios').default;


export default {
    computed: {},
    data() {
        return {
            url: '/load_messages',
            chat_message: '',
            showMenu: true,
            same_page: false,
            content:{},
            pages: [],
            messages: []
        }
    },
    props: ['menus', 'samepage', 'auth'],
    created: function() {
        this.pages = this.menus;
        this.activePage = this.samepage;
    },

    mounted() {
        this.load()
    },

    methods: {

        /**
         * check if the text has link
         */
        checkHasLink(message)
        {
            return (message && message.message_text && message.message_text.indexOf('http')) ? true : false;
        },

        /**
         * Upload image to WP
         */
         uploadImage($event) {
            let file = $event.target.files[0];

            const formData = new FormData();
            formData.append('file', file);
            const headers = { 'Content-Type': 'multipart/form-data' };
            
            // Demo json data
            return axios.post('/wp/send_image', formData, headers).then(response => {
                this.load()
            });

        },
        
        /**
         * Upload picture to WP
         */
         uploadFile($event) 
         {
            let file = $event.target.files[0];

            const formData = new FormData();
            formData.append('file', file);
            const headers = { 'Content-Type': 'multipart/form-data' };
            
            // Demo json data
            return axios.post('/wp/send_image', formData, headers).then(response => {
                this.load()
            });

        },
        

        validate() {
            let titleElement = jQuery(document.querySelector("#tynChatInput"));
            this.chat_message = titleElement.text()
            titleElement.empty();
            
            while (titleElement.firstChild) titleElement.removeChild(titleElement.firstChild);

            this.sendMessage()
        },

        sendMessage()
        {
            var params = new URLSearchParams();
            params.append('type', 'WP')
            params.append('message_text', this.chat_message)

            this.showLoader = true;
            this.$parent.handleRequest( params, '/api/send_message' ).then(response=> {
                this.load()
                console.log(response)
            });
        },

        load()
        {
            console.log('Load');
            this.showLoader = true;
            this.$parent.handleGetRequest( this.url ).then(response=> {
                this.setValues(response)
                this.showLoader = false;
                // this.$alert(response)
            });
        },
        
        setValues(data) {
            this.messages = JSON.parse(JSON.stringify(data)); return this
        },
        __(i)
        {
            return this.$root.$children[0].__(i);
        }
        
    }
};
</script>

<style lang="css">
    .sidebar-menu
    {
        min-height: calc(100vh - 100px);
    }
</style>
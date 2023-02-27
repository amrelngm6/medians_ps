<template>
    <div class="media-library">
        <div class="media-library__inner">
            <header class="media-library__header">
                Media Library

                <span class="media-library__close" @click="close">
                    <app-svg-error />
                </span>
            </header>

            <div v-if="loading.wrapper" class="media-library__loader">
                <app-medialibrary-loader />
            </div>
            <div v-else-if="error" class="media-library__error">
                <span class="media-library__error__ttl">Oh Dear!</span>
                <p class="media-library__error__msg">There was a serious problem... This is likely because something isn't setup properly. Please consult the documentation.</p>
                <app-svg-error />
            </div>
            <div v-else class="media-library__manager">
                <div class="media-library__manager__nav">
                    <div>
                        <span 
                            v-if="types.images"
                            class="media-library__manager__nav__option" 
                            :class="{ 'active': type == 'images', 'inactive': type != 'images' }"
                            @click="openFile = null; type = 'images'"
                        >Images <strong>({{ store.images.total }})</strong></span>
                        <span 
                            v-else
                            class="media-library__manager__nav__option deactive"
                        >Images <strong>({{ store.images.total }})</strong></span>

                        <span 
                            v-if="types.files"
                            class="media-library__manager__nav__option" 
                            :class="{ 'active': type == 'files', 'inactive': type != 'files' }"
                            @click="openFile = null; type = 'files'"
                        >Files <strong>({{ store.files.total }})</strong></span>
                        <span 
                            v-else
                            class="media-library__manager__nav__option deactive"
                        >Files <strong>({{ store.files.total }})</strong></span>
                    </div>
                    <div class="media-library__manager__nav__push">
                        <span 
                            class="media-library__manager__nav__button" 
                            :class="{ 'active': toggles.upload }"
                            @click="toggles.upload = !toggles.upload"
                        >Upload</span>
                        <input class="media-library__manager__nav__search" id="medialibrary-search" type="text" placeholder="Type to search..." v-model="search">
                    </div>
                </div>

                <div class="media-library__manager__content" style="height: 0%;">
                    <div class="media-library__manager__content__images" :class="{'open': toggles.file }">
                        <div class="media-library__manager__content__images__inner">
                            <div class="media-library__manager__upload" v-if="toggles.upload">
                                <div class="media-library__manager__upload__zone">
                                    <a href="javascript:;"  class="media-library__manager__upload__zone__button" @click="$refs.file.click()">Add new</a>
                                    <input name="files[]" type="file" multiple="true" ref="file" @change="uploadFilesByButton"/>
                                    <span class="media-library__manager__upload__zone__text">or drop new files here</span>
                                </div>
                            </div>
                            <div v-if="store[type].data.length == 0" class="media-library__error media-library__error--sml">
                                <span class="media-library__error__ttl">Not a great start!</span>
                                <p class="media-library__error__msg">You don't have any media yet... Upload some media above to get started!</p>
                                <app-svg-media />
                            </div>
                            <div v-else>
                                <div class="media-library__manager__content__images__grid">
                                    <div class="media-library__manager__content__images__grid__images" v-if="type == 'images'">
                                        <div
                                            v-for="(m, i) in store.images.data"
                                            :key="i"
                                            class="grid-item"
                                            :class="{'grid-item--active': store.images.selected.indexOf(m.id) > -1}"
                                            @click="selectManual('images', m.id)"
                                        >
                                            <div class="grid-item__inner" :style="`background: url('${m.data_url}'); background-repeat: no-repeat; background-size: cover;`"></div>
                                        </div>
                                    </div>
                                    <div class="media-library__manager__content__images__grid__files" v-else-if="type == 'files'">
                                        <table class="media-library-table">
                                            <tbody>
                                                <tr
                                                    v-for="(f, i) in store.files.data"
                                                    :key="i"
                                                    @click="selectManual('files', f.id)"
                                                    :class="{'active': store.files.selected.indexOf(f.id) > -1}"
                                                >
                                                    <td>
                                                        <input type="checkbox" v-model="store.files.selectedModel[f.id]">
                                                    </td>
                                                    <td v-html="f.file_name"></td>
                                                    <td v-html="f.humanSize"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <infinite-loading @infinite="scroll" style="margin-bottom: 1.5rem;"> <div slot="no-more"></div> <div slot="no-results"></div> </infinite-loading>
                            </div>
                        </div>
                    </div>
                    <div class="media-library__manager__content__info" v-if="toggles.file && openFile">
                        <div v-if="loading.info" class="media-library__manager__content__info__loading">
                            <app-medialibrary-loader />
                        </div>
                        <div v-else>
                            <div class="media-library__manager__content__info__section">
                                <div class="media-library__manager__content__info__image">
                                    <img v-if="type == 'images'" :src="openFile.data_url" style="width: auto; height: auto; max-width: 150px; max-height: 150px;">
                                </div>
                                <span class="media-library__manager__content__info__text" v-html="openFile.file_name" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;" />
                                <span class="media-library__manager__content__info__text media-library__manager__content__info__text--secondary" v-if="type == 'images'">Dimensions: {{ openFile.image.width }} × {{ openFile.image.height }}</span>
                                <!-- <span class="media-library__manager__content__info__text media-library__manager__content__info__text--secondary" v-if="type == 'images'">Responsive conversions: x{{ typeof openFile.responsive_images != 'undefined' && typeof openFile.responsive_images.medialibrary_original != 'undefined' && typeof openFile.responsive_images.medialibrary_original.urls != 'undefined' ? openFile.responsive_images.medialibrary_original.urls.length : 0 }}</span> -->
                                <div style="display: flex;  margin: 0.75rem -0.25rem 0 -0.25rem;">
                                    <div style="flex-grow: 1; padding: 0 0.2rem;">
                                        <a :href="openFile.download_url" target="_blank" class="media-library__manager__content__info__button">Download</a>
                                    </div>
                                    <div style="flex-grow: 1; padding: 0 0.2rem;">
                                        <button @click="deleteSelected" class="media-library__manager__content__info__button media-library__manager__content__info__button--delete">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="media-library__manager__content__info__section" v-if="type == 'images'">
                                <div>
                                    <label class="media-library__manager__content__info__label" for="alt-text">
                                        Alt text
                                    </label>
                                    <input v-model="openFile.alt_text" class="media-library__manager__content__info__input" id="alt-text" type="text">
                                </div>
                                <div>
                                    <label class="media-library__manager__content__info__label" for="caption">
                                        Caption
                                    </label>
                                    <textarea v-model="openFile.caption" class="media-library__manager__content__info__input" id="caption" rows="3" />
                                </div>
                            </div>
                            <div class="media-library__manager__content__info__section" style="display: flex; margin: 0 -0.5rem;">
                                <div style="padding: 0 0.5rem;" :style="`width: ${type != 'images' ? 100 : 50}%;`">
                                    <button @click="toggles.file = false; clearSelected('images');" class="media-library__manager__content__info__button media-library__manager__content__info__button--close">Close</button>
                                </div>
                                <div v-if="type == 'images'" style="width: 50%; padding: 0 0.5rem;">
                                    <button @click="save" class="media-library__manager__content__info__button media-library__manager__content__info__button--save">Save</button>
                                </div>
                            </div> -->
                            <div class="media-library__manager__content__info__section" style="display: flex; margin: 0 -0.5rem;" v-if="selectable">
                                <a href="javascript:;" @click="select(openFile)" class="media-library__manager__content__info__button media-library__manager__content__info__button--success">Insert</a>
                            </div>
                        </div>
                    </div>
                    <div class="media-library__manager__content__files" v-if="toggles.file && !openFile">
                        <div v-if="loading.info" class="media-library__manager__content__files__loading">
                            <app-medialibrary-loader />
                        </div>
                        <div v-else>
                            <div class="media-library__manager__content__info__section">
                                <span style="display: block; margin-bottom: 1rem;"><strong>{{ store[type].selected.length }}</strong> {{ type }} selected.</span>
                                <button @click="deleteSelected" class="media-library__manager__content__info__button media-library__manager__content__info__button--delete">Delete</button>
                            </div>

                            <div class="flex media-library__manager__content__info__section" style="margin: 0 -0.5rem;">
                                <div style="padding: 0 0.5rem; width: 100%;">
                                    <button @click="toggles.file = false; clearSelected('images');" class="media-library__manager__content__info__button media-library__manager__content__info__button--close">Close / Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue';
    import Loader from './Loader';
    import SvgError from './svgs/Error';
    import SvgMedia from './svgs/Media';
    import InfiniteLoading from 'vue-infinite-loading';
    import debounce from 'lodash/debounce';
    import axios from 'axios';
        
    export default {
        name: 'app-medialibrary-manager',

        components: {
            'app-medialibrary-loader': Loader,
            'app-svg-error': SvgError,
            'app-svg-media': SvgMedia,
            'infinite-loading': InfiniteLoading
        },

        props: {
            api_url: {
                type: String,
                required: false,
                default : '/'
            },
            current_key: {
                type: Number,
                required: false,
                default : 0
            },
            types: {
                type: Object,
                required: false,
                default: () => ({
                    images: true,
                    files: true
                })
            },
            selectable: {
                type: Boolean,
                required: false,
                default: false
            },
            selected: {
                required: false
            },
            filetypes: {
                type: Array,
                required: false,
                default: () => ([])
            }
        },

        data: () => ({
            toggles: {
                file: false,
                upload: false
            },

            loading: {
                wrapper: true,
                files: false,
                info: false
            },

            error: false,

            store: {
                images: {
                    data: [],
                    page: 1,
                    total: 0,
                    noMore: false,
                    paginationCount: 32,
                    selectedModel: {},
                    selected: []
                },
                files: {
                    data: [],
                    page: 1,
                    total: 0,
                    noMore: false,
                    paginationCount: 50,
                    selectedModel: {},
                    selected: []
                },
            },

            openFile: null,
            type: 'images',
            search: '',
        }),

        mounted() {
            this.type = typeof this.types.images !== 'undefined' && this.types.images ? 'images' : (typeof this.types.files !== 'undefined' && this.types.files ? 'files' : null);

            if (this.type) {
                this.setPaginationCount();

                this.getAllMedia()
                    .then(response => {
                        if (this.selectable) {
                            this.getFile()
                                .then(response => {
                                    this.loading.wrapper = false;
                                })
                        } else {
                            this.loading.wrapper = false;
                        }
                    });
            } else {
                this.error = true;
                this.loading.wrapper = false;
            }
        },

        methods: {
            url(path) {
                return `${this.api_url.replace(/\/$/, "")}${path.replace(/\/$/, "")}`;
            },

            select(file) {

                this.$parent.$parent.showSide = false;
                this.$parent.$parent.activeItem.file = file.file_name;
                this.$parent.$parent.showSide = true;
            
                this.$emit('select', file);
            },
            
            save() {
                if (this.openFile) {
                    this.loading.info = true;
                
                    return axios.post(this.url("/media-library-api/save"), { id: this.openFile.id, alt_text: this.openFile.alt_text, caption: this.openFile.caption })
                        .then(response => {
                            this.loading.info = false;

                            this.getAllMedia()
                                .then(response => {
                                    this.loading.wrapper = false;
                                });
                        });
                }
            },

            setPaginationCount() {
                if (window.innerWidth >= 300 && window.innerWidth <= 799) {
                    this.store.images.paginationCount = 12;
                    this.store.files.paginationCount = 20;
                } else if (window.innerWidth >= 800 && window.innerWidth <= 999) {
                    this.store.images.paginationCount = 18;
                    this.store.files.paginationCount = 30;
                } else if (window.innerWidth >= 1000 && window.innerWidth <= 1199) {
                    this.store.images.paginationCount = 28;
                    this.store.files.paginationCount = 40;
                } else if (window.innerWidth >= 1200 && window.innerWidth <= 1399) {
                    this.store.images.paginationCount = 30;
                    this.store.files.paginationCount = 50;
                } else if (window.innerWidth >= 1400 && window.innerWidth <= 1599) {
                    this.store.images.paginationCount = 35;
                    this.store.files.paginationCount = 50;
                } else if (window.innerWidth >= 1600 && window.innerWidth <= 1799) {
                    this.store.images.paginationCount = 42;
                    this.store.files.paginationCount = 50;
                } else if (window.innerWidth >= 1800) {
                    this.store.images.paginationCount = 48;
                    this.store.files.paginationCount = 50;
                }
            },

            getFile() {
                return axios.get(this.url(`/media-library-api/file?name=${this.selected}`))
                    .catch(error => {
                        this.loading.wrapper = false;
                        this.$emit('fail-to-find', true);
                    })
                    .then(({ data }) => {
                        if (data.file) {
                            this.openFile = data.file;
                            
                            this.select(data.file);
                        }
                    });
            },

            getAllMedia() {
                this.clearMedia();

                this.loading.wrapper = true;

                return this.getMedia('images')
                    .catch(error => {
                        this.loading.wrapper = false;
                        this.error = true;
                    })
                    .then(response => {
                        this.getMedia('files')
                            .then(response => {
                                if (this.store.images.data.length == 0 && this.store.files.data.length == 0) {
                                    this.toggles.upload = true;
                                }
                            });
                    });
            },

            getMedia(type) {
                return axios.get(this.url(`/media-library-api/media?type=${type}&page=${this.store[type].page}&pcount=${this.store[type].paginationCount}&search=${this.search}&filetypes=${this.filetypes.join(',')}`))
                    .then(({ data }) => {
                        if (data.media.length > 0) {
                            data.media.forEach(item => {
                                this.store[type].data.push(item);
                                Vue.set(this.store[type].selectedModel, item.id, false);
                            });

                            this.store[type].total = data.total;
                        } else {
                            this.store[type].noMore = true;
                        }
                    });

            },

            scroll($state) {
                if (!this.store[this.type].noMore) {
                    this.store[this.type].page += 1;

                    this.getMedia(this.type)
                        .then(response => {
                            $state.loaded();
                        });
                } else {
                    $state.complete();
                }
            },

            clearMedia() {
                this.store.images.data = [];
                this.store.images.selected = [];
                this.store.images.selectedModel = {};
                this.store.images.page = 1;
                this.store.images.total = 0;
                this.store.images.noMore = false;

                this.store.files.data = [];
                this.store.files.selected = [];
                this.store.files.selectedModel = {};
                this.store.files.page = 1;
                this.store.files.total = 0;
                this.store.files.noMore = false;
            },

            uploadFilesByButton(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;

                // Toggle loading
                this.loading.wrapper = true;

                // Upload files
                for (var i = 0; i < files.length; i++) {
                    if (i == (files.length - 1)) {
                        this.uploadFile(files[i], i)
                            .then(response => {
                                this.getAllMedia()
                                    .then(response => {
                                        this.loading.wrapper = false;
                                    });
                            });
                    } else {
                        this.uploadFile(files[i], i);
                    }
                }
            },

            uploadFile(file, id) {
                let uploaderForm = new FormData(); // Create new FormData
                uploaderForm.append("file", file);

                return axios.post(this.url("/media-library-api/upload"), uploaderForm)
                        .then(response => {
                            if(typeof response.data.message != 'undefined') {
                                this.$toasted.show(response.data.message, {
                                    type: "success",
                                    position: "bottom-right",
                                    duration : 5000
                                });
                            }
                        })
                        .catch(error => {
                            if(typeof error.response.data.message != 'undefined') {
                                this.$toasted.show(error.response.data.message, {
                                    type: "error",
                                    position: "bottom-right",
                                    duration : 5000
                                });
                            }
                        });
            },

            close() {
                this.$emit('close');
            },

            selectManual(type, id) {
                // Clear before we select as they can only select one
                if (this.selectable) {
                    this.clearSelected(type);
                }

                this.store[type].selectedModel[id] = !this.store[type].selectedModel[id];

                this.setSelected(type);
            },  

            clearSelected(type) {
                this.store[type].selected = [];

                for(let id in this.store[type].selectedModel) {
                    this.store[type].selectedModel[id] = false;
                }

                this.openFile = null;
            },

            setSelected(type) {
                this.store[type].selected = [];

                for(let id in this.store[type].selectedModel) {
                    if (this.store[type].selectedModel[id]) {
                        this.store[type].selected.push(parseInt(id));
                    }
                }

                if (this.type == type && this.store[type].selected.length > 0) {
                    this.toggles.file = true;

                    if (this.store[type].selected.length > 1) {
                        this.openFile = null;
                    }  else {
                        this.store[type].data.forEach(item => {
                            if (item.id == this.store[type].selected[0]) {
                                this.openFile = item;
                            }
                        });
                    }
                } else {
                    this.toggles.file = false;
                }
            },

            deleteSelected() {

                this.loading.info = true;

                const params = new URLSearchParams([]);
                
                params.append('file_name', JSON.stringify(this.openFile));

                return axios.post(this.url("/media-library-api/delete"), params.toString())
                    .then(response => {
                        this.loading.info = false;
                        this.getAllMedia()
                            .then(response => {
                                this.loading.wrapper = false;
                            });

                        if(typeof response.data.message != 'undefined') {
                            this.$toasted.show(response.data.message, {
                                type: "success",
                                position: "bottom-right",
                                duration : 5000
                            });
                        }
                    });
            },

            debouncer: debounce(callback => callback(), 500),
        },

        watch: {
            search() {
                this.debouncer(() => {
                    this.toggles.file = false; 
                    this.openFile = null;

                    this.getAllMedia()
                        .then(response => {
                            this.loading.wrapper = false;

                            setTimeout(() => {
                                document.getElementById("medialibrary-search").focus();
                            }, 250);
                        });
                });
            },

            'store.files.selectedModel': {
                handler(val) {
                    this.setSelected('files');
                },
                deep: true
            },

            'store.images.selectedModel': {
                handler(val) {
                    this.setSelected('images');
                },
                deep: true
            }
        }
    }
</script>


<style lang="css">
.media-library {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  display: flex;
  flex-wrap: wrap;
  align-items: flex-start;
  padding: 2rem;
  background: rgba(45, 55, 72, 0.2);
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 16px;
  font-weight: 400;
  text-align: left;
  overflow-x: hidden;
  overflow-y: auto;
  z-index: 50;
}
.media-library * {
  box-sizing: border-box;
}
.media-library__error {
  padding: 6rem 2rem;
  width: 100%;
  text-align: center;
}
.media-library__error--sml {
  padding: 2rem;
}
.media-library__error__ttl {
  display: block;
  margin-bottom: 1.5rem;
  font-size: 1.5rem;
  font-weight: bold;
}
.media-library__error__msg {
  margin: 0 0 2rem 0;
  font-size: 1rem;
  font-weight: normal;
}
.media-library__inner {
  position: relative;
  display: flex;
  flex-direction: column;
  flex-wrap: nowrap;
  width: 100%;
  height: 100%;
  background: white;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}
.media-library__header {
  position: relative;
  height: 4rem;
  width: 100%;
  padding: 1rem 1.5rem;
  background: #EDF2F7;
  font-size: 1.5rem;
  font-weight: normal;
}
.media-library__close {
  position: absolute;
  top: 0;
  right: 0;
  padding: 1rem 1.5rem;
  font-size: 1.5rem;
  color: #a0aec0;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
}
.media-library__close:hover {
  background: #e2e8f0;
}
.media-library__loader {
  width: 100%;
  margin: 0 auto;
  padding: 6rem;
  text-align: center;
}
.media-library__manager {
  display: flex;
  flex-grow: 1;
  flex-direction: column;
  flex-wrap: nowrap;
}
.media-library__manager__upload {
  width: 100%;
  padding: 0 0.75rem;
  margin-bottom: 1rem;
}
.media-library__manager__upload__zone {
  border: 1px dashed #CBD5E0;
  padding: 2rem;
  text-align: center;
}
.media-library__manager__upload__zone input[type="file"] {
  display: none;
}
.media-library__manager__upload__zone__text {
  display: inline-block;
  margin-left: 0.5rem;
  color: #718096;
  vertical-align: middle;
}
.media-library__manager__upload__zone__button {
  display: inline-block;
  padding: 0.5rem 1rem;
  border: 1px solid #a0aec0;
  border-radius: 99999px;
  font-size: 0.875rem;
  vertical-align: middle;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
}
.media-library__manager__upload__zone__button:hover {
  border-color: #4299E1;
  background: #4299E1;
  color: white;
}
.media-library__manager__content {
  display: flex;
  flex-grow: 1;
  align-items: flex-start;
}
.media-library__manager__content__info, .media-library__manager__content__files {
  width: 20%;
  height: 100%;
  background: #F7FAFC;
  border-left: 1px solid #e2e8f0;
  overflow-y: auto;
  overflow-x: hidden;
}
.media-library__manager__content__info__loading, .media-library__manager__content__files__loading {
  width: 100%;
  margin: 0 auto;
  padding: 3rem 0;
  text-align: center;
}
.media-library__manager__content__info__input {
  display: block;
  width: 100%;
  padding: 0.75rem 1rem;
  margin-bottom: 1rem;
  background: white;
  border: 1px solid #CBD5E0;
  border-radius: 0.25rem;
  color: #4A5568;
  line-height: 1.25;
  appearance: none;
}
.media-library__manager__content__info__input:focus {
  outline: 0;
  background: white;
  border-color: #a0aec0;
  box-shadow: none;
}
.media-library__manager__content__info__label {
  display: block;
  margin-bottom: 0.5rem;
  font-size: 0.75rem;
  font-weight: 700;
  color: #4A5568;
  letter-spacing: 0.025em;
  text-transform: uppercase;
}
.media-library__manager__content__info__button {
  display: block;
  width: 100%;
  padding: 0.5rem 0.75rem;
  background: transparent;
  border: 1px solid #a0aec0;
  border-radius: 9999px;
  font-size: 0.75rem;
  color: #718096;
  text-align: center;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
}
.media-library__manager__content__info__button:hover {
  border-color: #4299E1;
  background: #4299E1;
  color: white;
}
.media-library__manager__content__info__button--delete {
  border-color: #e53e3e;
  color: #e53e3e;
}
.media-library__manager__content__info__button--delete:hover {
  border-color: #e53e3e;
  background: #e53e3e;
  color: white;
}
.media-library__manager__content__info__button--save {
  border-color: #4299E1;
  background: #4299E1;
  color: white;
}
.media-library__manager__content__info__button--save:hover {
  border-color: #4299E1;
  background: transparent;
  color: #4299E1;
}
.media-library__manager__content__info__button--close {
  border-color: #CBD5E0;
  color: #CBD5E0;
}
.media-library__manager__content__info__button--close:hover {
  border-color: #a0aec0;
  background: #a0aec0;
  color: white;
}
.media-library__manager__content__info__button--success {
  border-color: #48BB78;
  color: #48BB78;
}
.media-library__manager__content__info__button--success:hover {
  border-color: #48BB78;
  background: #48BB78;
  color: white;
}
.media-library__manager__content__info__text {
  display: block;
  margin-bottom: 0.5rem;
  font-size: 1.125rem;
  font-weight: normal;
  color: #2D3748;
}
.media-library__manager__content__info__text--secondary {
  font-size: 0.875rem;
  font-weight: 300;
  color: #718096;
}
.media-library__manager__content__info__image {
  margin-bottom: 0.5rem;
  text-align: left;
}
.media-library__manager__content__info__section {
  padding: 1.25rem;
  border-bottom: 1px solid #CBD5E0;
}
.media-library__manager__content__images {
  height: 100%;
  padding: 1.25rem;
  width: 100%;
  overflow-y: auto;
}
.media-library__manager__content__images.open {
  width: 80%;
}
.media-library__manager__content__images__grid {
  display: flex;
  flex-wrap: wrap;
  flex-direction: row;
}
.media-library__manager__content__images__grid__images {
  display: flex;
  flex-wrap: wrap;
  flex-direction: row;
  width: 100%;
}
.media-library__manager__content__images__grid__files {
  width: 100%;
}
.media-library__manager__content__images__inner {
  position: relative;
  display: block;
  width: 100%;
  min-height: 100%;
}
.media-library__manager__nav {
  display: flex;
  width: 100%;
  height: 4rem;
  padding: 0 1.5rem;
  background: #F7FAFC;
  border-bottom: 1px solid #e2e8f0;
}
.media-library__manager__nav__search {
  display: inline-block;
  width: auto;
  min-width: 240px;
  max-width: 100%;
  padding: 0.75rem 1rem;
  background: white;
  border: 1px solid #e2e8f0;
  border-radius: 0.25rem;
  color: #4A5568;
  line-height: 1.25;
  appearance: none;
}
.media-library__manager__nav__search:focus {
  outline: 0;
  background: white;
  border-color: #a0aec0;
  box-shadow: none;
}
.media-library__manager__nav__button {
  display: inline-block;
  margin-right: 0.75rem;
  padding: 0.5rem 1rem;
  border: 1px solid #e2e8f0;
  background: #EDF2F7;
  border-radius: 9999px;
  font-size: 0.875rem;
  color: #a0aec0;
  vertical-align: middle;
  cursor: pointer;
}
.media-library__manager__nav__button.active {
  background: #4299E1;
  color: white;
}
.media-library__manager__nav__push {
  margin-left: auto;
  padding: 0.75rem 0;
}
.media-library__manager__nav__option {
  display: inline-block;
  padding: 1.34375rem 1rem;
  border: 0;
  background: transparent;
  border-bottom: 2px solid transparent;
  font-size: 0.875rem;
  color: #718096;
  vertical-align: middle;
  cursor: pointer;
}
.media-library__manager__nav__option.active {
  border-color: #4299E1;
}
.media-library__manager__nav__option.inactive:hover {
  border-color: #90CDF4;
}
.media-library__manager__nav__option.deactive {
  opacity: 0.5;
  cursor: not-allowed;
}
.grid-item {
  position: relative;
  width: 16.66666665%;
  padding: 0.5rem;
  padding-bottom: 16.66666665%;
}
@media screen and (min-width: 300px) {
  .grid-item {
    width: 50%;
    padding-bottom: 50%;
  }
}
@media screen and (min-width: 800px) {
  .grid-item {
    width: 33.3333333333%;
    padding-bottom: 33.3333333333%;
  }
}
@media screen and (min-width: 1000px) {
  .grid-item {
    width: 25%;
    padding-bottom: 25%;
  }
}
@media screen and (min-width: 1200px) {
  .grid-item {
    width: 20%;
    padding-bottom: 20%;
  }
}
@media screen and (min-width: 1400px) {
  .grid-item {
    width: 16.6666666667%;
    padding-bottom: 16.6666666667%;
  }
}
@media screen and (min-width: 1600px) {
  .grid-item {
    width: 14.2857142857%;
    padding-bottom: 14.2857142857%;
  }
}
@media screen and (min-width: 1800px) {
  .grid-item {
    width: 12.5%;
    padding-bottom: 12.5%;
  }
}
.grid-item__inner {
  position: absolute;
  top: 10px;
  right: 10px;
  bottom: 10px;
  left: 10px;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #F7FAFC;
  border: 2px solid #EDF2F7;
}
.grid-item img {
  display: block;
  max-width: 100%;
  height: auto;
  max-height: 100%;
}
.grid-item--active .grid-item__inner {
  border-color: #4299E1;
  border-width: 4px;
}
.media-library-table {
  width: 100%;
  border: 1px solid #e2e8f0;
  border-collapse: collapse;
  border-spacing: 0;
  white-space: nowrap;
}
.media-library-table tr:nth-child(even) {
  background: #EDF2F7;
}
.media-library-table tr:nth-child(even).active {
  background: #EBF8FF;
}
.media-library-table tr {
  cursor: pointer;
}
.media-library-table tr.active {
  background: #EBF8FF;
}
.media-library-table td {
  padding: 1rem;
}

</style>

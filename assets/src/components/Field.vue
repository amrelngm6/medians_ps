<template>
    <div>
        <div class="media-library-field">
            <div v-if="loading" class="media-library-field__loader">
                <app-medialibrary-loader />
            </div>
            <div class="media-library-field__selector" v-else-if="content == null">
                <span 
                    @click="showManager = true"
                    class="media-library-field__selector__button"
                >Attach {{ types.images && types.files ? 'file' : (types.images && !types.files) ? 'image' : 'file' }}</span>

                <p v-if="helper" v-html="helper" class="media-library-field__selector__helper" />
            </div>
            <div v-else-if="file" class="media-library-field__selected">
                <div class="media-library-field__selected__inner">
                    <div class="w-full">
                        <div>
                            <img :src="file" style="width: auto; height: auto; max-width: 180px;">
                        </div>
                        <div class="block w-full">
                            <div class="w-full flex" style="  margin: 2rem -0.5rem 0 -0.5rem;">
                                <div style="flex-grow: 1; padding: 0 0.5rem;">
                                    <span class="media-library-field__selected__inner__details__button font-semibold" @click="showManager = true">Edit</span>
                                </div>
                                <div style="flex-grow: 1; padding: 0 0.5rem;">
                                    <a :href="file.download_url" class="media-library-field__selected__inner__details__button">Download</a>
                                </div>
                                <div style="flex-grow: 1; padding: 0 0.5rem;">
                                    <button @click="clear" class="media-library-field__selected__inner__details__button media-library-field__selected__inner__details__button--delete">Remove</button>
                                </div>
                            </div>
                        </div>


                        <!-- <p v-if="helper" v-html="helper" class="media-library-field__selected__inner__details__helper" /> -->
                    </div>
                </div>
            </div>
        </div>

        <vue-medialibrary-manager 
            :api_url="api_url"
            v-show="showManager"
            :filetypes="filetypes"
            :types="types"
            :selected="value"
            :selectable="true"
            @close="showManager = false"
            @select="insert"
            @fail-to-find="clear"
        />
    </div>
</template>

<script>
    import Loader from './Loader';
    import axios from 'axios';

    export default {
        name: 'vue-medialibrary-field',

        components: {
            'app-medialibrary-loader': Loader
        },

        props: {
            api_url: {
                type: String,
                required: false
            },
            value: {
                type: Object|String,
                required: false,
                default: () => ({
                })
            },
            types: {
                type: Object,
                required: false,
                default: () => ({
                    images: true,
                    files: true
                })
            },
            filetypes: {
                type: Array,
                required: false,
                default: () => ([])
            },
            helper: {
                type: String,
                required: false
            }
        },

        data: () => ({
            loading: true,
            showManager: false,
            file: {},
            content: null,
        }),

        mounted() {
            this.content = this.value ? this.value : this.content;
            if (this.content ) {
                // this.file = this.content;
            } else {
                this.content = null;
            }
            this.loading = false;
        },

        methods: {

            insert(value) {

                this.loading = false;
                this.showManager = false;
                
                this.file = value.file_name;
                this.content = value.file_name;

                this.change();
            },
            clear() {
                this.loading = false;
                this.content = this.file = null;

                this.$emit('input', null);
            },
            change() {
                this.$emit('input', this.file);
            }
        },

        watch: {
            value() {
                if (typeof this.file == 'undefined') {
                    this.loading = true;
                }
            }
        },
    }
</script>


<style lang="css">
    .media-library-field {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}
.media-library-field * {
  box-sizing: border-box;
}
.media-library-field__selected, .media-library-field__selector, .media-library-field__loader {
  display: block;
  position: relative;
  padding: 0.75rem;
  width: 100%;
  min-height: 1rem;
  background: transparent;
  border: 1px solid #a0aec0;
  text-align: left;
}
.media-library-field__selected__button, .media-library-field__selector__button, .media-library-field__loader__button {
  padding: 0.25rem 1rem;
  border: 1px solid #718096;
  border-radius: 0.875rem;
  font-size: 0.875rem;
  line-height: 1;
  color: #718096;
  appearance: none;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
}
.media-library-field__selected__button:hover, .media-library-field__selector__button:hover, .media-library-field__loader__button:hover {
  border-color: #2D3748;
  color: #2D3748;
}
.media-library-field__selected__helper, .media-library-field__selector__helper, .media-library-field__loader__helper {
  position: absolute;
  float: right;
  top: 50%;
  right: 1rem;
  transform: translateY(-50%);
  font-size: 0.875rem;
  color: #718096;
}
.media-library-field__loader {
  text-align: center;
}
.media-library-field__selected {
  padding: 1rem;
}
.media-library-field__selected__inner {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  align-items: center;
  align-content: flex-start;
}
.media-library-field__selected__inner__details {
  flex-grow: 1;
  padding: 0 1rem;
}
.media-library-field__selected__inner__details__helper {
  display: block;
  margin: 2rem 0 0 0;
  font-size: 0.875rem;
  color: #718096;
}
.media-library-field__selected__inner__details__button {
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
.media-library-field__selected__inner__details__button:hover {
  border-color: #4299E1;
  background: #4299E1;
  color: white;
}
.media-library-field__selected__inner__details__button--delete {
  border-color: #e53e3e;
  color: #e53e3e;
}
.media-library-field__selected__inner__details__button--delete:hover {
  border-color: #e53e3e;
  background: #e53e3e;
  color: white;
}
.media-library-field__selected__inner__details__name, .media-library-field__selected__inner__details__dimensions, .media-library-field__selected__inner__details__edit {
  display: block;
}
.media-library-field__selected__inner__details__name {
  margin-bottom: 0.5rem;
  font-size: 1rem;
  font-weight: 400;
  color: #2D3748;
}
.media-library-field__selected__inner__details__dimensions, .media-library-field__selected__inner__details__edit {
  font-size: 0.875rem;
  font-weight: 300;
  color: #718096;
}
.media-library-field__selected__inner__details__edit {
  margin-top: 0.5rem;
  color: #4299E1;
  cursor: pointer;
}
.media-library-field__selected__inner__details__edit:hover {
  text-decoration: underline;
}
.media-library-field__selected__inner__img {
  position: relative;
  width: 33.33%;
  max-width: 15rem;
  min-width: 6.25rem;
}
.media-library-field__selected__inner__img__edit {
  display: none;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background: rgba(255, 255, 255, 0.4);
  cursor: pointer;
}
.media-library-field__selected__inner__img__edit > * {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 1.25rem;
  font-weight: bold;
  color: #2D3748;
  text-transform: uppercase;
}
.media-library-field__selected__inner__img:hover .media-library-field__selected__inner__img__edit {
  display: block;
}
.media-library-field__selected__inner__img__frame {
  position: relative;
  width: 100%;
  padding-bottom: 100%;
  overflow: hidden;
}
.media-library-field__selected__inner__img__frame__image {
  display: flex;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-color: #F7FAFC;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
}

</style>

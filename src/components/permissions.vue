<template>
    <div class=" w-full">
        <div class="grid xl:grid-cols-12 lg:grid-cols-12 grid-cols-1 gap-6" v-if="!showLoader">
            <div class="xl:col-span-3 lg:col-span-5">
                <div class="card px-4 py-6 mb-6">
                    <div class="text-center pb-4">
                        <h4 class="mb-6 mt-3 text-lg dark:text-gray-300" v-text="activeItem.name"></h4>
                        <button type="button" @click="close" class=" hover:bg-primary mb-3 px-6 py-2  text-danger"
                            ><i class="fa fa-close px-2"></i> <span v-text="__('Back')"></span></button>
                    </div>
                    <hr class="mt-5 dark:border-gray-600">
                </div> <!-- end card -->
            </div>

            <div class="xl:col-span-9 lg:col-span-7">
                <div class="card">
                    <div class="p-6">
                        <div class="flex w-full ">
                            <div class="w-full ">
                                <h1 class="font-bold text-lg w-full" v-text="__('Permissions list')"></h1>
                                <p v-text="__('Click on the permission to update')"></p>
                            </div>
                            <div>
                                <button type="button" @click="update" class="bg-gray-50 border  border-1 hover:bg-primary mb-3 px-6 py-2 rounded-lg text-primary" v-text="__('Save')"></button>
                            </div>
                        </div>
                        <div class="py-6 w-full" v-if="activeItem">
                            <nav class="max-w-xl space-y-3 bg-gray-100 p-4 dark:bg-gray-900/30"
                                aria-label="Tabs" role="tablist">
                                <label @click="setActiveStatus(permission)" :class="permission.access ? 'menu-dark text-white font-semibold' : 'text-gray-500'" v-for="permission in activeItem.permissions" 
                                class="cursor-pointer px-4 flex gap gap-4 mb-2 hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full  py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white active">
                                    <span :class="!permission.access ? 'bg-inverse-dark' : ''" class="bg-red-400 block h-4 relative rounded-full w-8"><a class="absolute bg-white block h-4 relative right-0 rounded-full w-4" :style="{left: permission.access ? '16px' : 0}"></a></span>
                                    <span type="button" v-text="__(permission.model)"></span>
                                </label>
                                 <!-- button-end -->
                            </nav> <!-- nav-end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import dashboard_card_white from './includes/dashboard_card_white';
import help_icon from './svgs/help';

export default
    {
        components:{
            dashboard_card_white,
            help_icon,
        },
        data() {
            return {
                content: {
                    items: []
                },
                activeItem: {},
                showAddSide: false,
                showEditSide: false,
                showLoader: false,
                showLoadMore: true,
                limitCount: 3,
                activeStatus: 'info',
            }
        },

        props: [
            'path',
            'lang',
            'setting',
            'conf',
            'auth',
            'item',
        ],
        mounted() {
            this.activeItem = this.item;
            console.log(this.activeItem)
        },

        methods:
        {
            update()
            {
                this.$emit('save', 'save', this.activeItem);
            },

            close()
            {
                this.$emit('close', 'close', this.activeItem);
            },

            loadmore() {
                this.showLoader = true;
                this.limitCount += 5;
                if (this.limitCount > this.activeItem.last_trips.length) {
                    this.showLoadMore = false;
                }
                this.showLoader = false;
            },

            setActiveStatus(permission) {
                this.showLoader = true;
                permission.access = !permission.access;
                this.showLoader = false;
            },


            /**
             * Handle actions from datatable buttons
             * Called From 'dataTableActions' component
             * 
             * @param String actionName 
             * @param Object data
             */
            handleAction(actionName, data) {
                switch (actionName) {
                    case 'view':
                        // window.open(this.conf.url+data.content.prefix)
                        break;

                    case 'edit':
                        this.showEditSide = true;
                        this.showAddSide = false;
                        this.activeItem = data
                        break;

                    case 'delete':
                        this.$root.$children[0].deleteByKey('driver_id', data, 'Driver.delete');
                        break;
                }
            },

            load() {
                this.showLoader = true;
                this.$root.$children[0].handleGetRequest(this.url).then(response => {
                    this.setValues(response)
                    this.showLoader = false;
                });
            },

            setValues(data) {
                this.content = JSON.parse(JSON.stringify(data)); return this
            },
            __(i) {
                return this.$root.$children[0].__(i);
            }
        }
    };
</script>
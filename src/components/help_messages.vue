<template>
    <div class=" w-full">
        <test :item="activeItem" v-if="showEditSide" :ref="activeItem" @callback="closeMessage" />
        <div class="container-fluid" v-if="!showEditSide">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mt-n4 mx-n4 card-border-effect-none">
                        <div class="bg-primary-subtle" v-if="!showLoader">

                            <div class="card-body pb-0 px-4">
                                <span v-text="content.title" class="text-lg font-semibold "></span>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content text-muted">


                        <!-- end tab pane -->
                        <div class="w-full">
                            <div class="lg:flex g-4 mb-3">
                                <div class="w-full">
                                    <ul class=" pt-2 gap-6 flex nav nav-tabs-custom border-bottom-0" role="tablist">
                                        <li v-for="option in statusList" @click="switchStatus(option)" class="nav-item"
                                            role="presentation">
                                            <span :class="option.status == activeStatus ? 'font-bold' : ''"
                                                v-text="option.text" class="nav-link fw-semibold cursor-pointer"></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="w-auto">
                                    <div class="d-flex">
                                        <div class="search-box me-2">
                                            <input type="text" class="form-control" placeholder="Search member...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="team-list list-view-filter" v-for="item in content.items">
                                <div class="card team-box"
                                    v-if="!showLoader && (activeStatus == 'all' || item.status == activeStatus)">
                                    <div class="card-body px-4">
                                        <div class="row align-items-center team-row">
                                            <div class="col-lg-4 col">
                                                <div class="team-profile-img gap-4 flex">
                                                    <div class="avatar-lg img-thumbnail rounded-circle">
                                                        <img v-if="item.user" :src="item.user.picture" alt=""
                                                            class="img-fluid d-block rounded-circle">
                                                    </div>
                                                    <div class="team-content">
                                                        <a href="#" class="d-block">
                                                            <h5 v-if="item.user" class="fs-16 mb-1 font-semibold"
                                                                v-text="item.user.name"></h5>
                                                        </a>
                                                        <p v-text="item.message" class="text-muted mb-0"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col">
                                                <div class="row text-muted text-center">
                                                    <div class="col-4 border-end border-end-dashed">
                                                        <h5 class="mb-1 font-semibold" v-text="__('Created at')"></h5>
                                                        <p class="text-muted mb-0" v-text="item.date"></p>
                                                    </div>
                                                    <div class="col-4">
                                                        <h5 class="mb-1 font-semibold" v-text="__('Updated at')"></h5>
                                                        <p class="text-muted mb-0" v-text="item.last_update"></p>
                                                    </div>
                                                    <div class="col-4">
                                                        <h5 class="mb-1 font-semibold" v-text="__('Status')"></h5>
                                                        <p class="text-muted mb-0" v-text="item.status"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col">
                                                <div class="text-end">
                                                    <a href="javascript:;" @click="showDetails(item)"
                                                        class="menu-dark text-white px-4 py-2 rounded-lg"
                                                        v-text="__('Details')"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end team list -->
                        </div>
                        <!-- end tab pane -->
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
</template>
<script>

export default
    {

        data() {
            return {
                url: this.conf.url + this.path + '?load=json',
                content: {
                    title: '',
                    items: [],
                    columns: [],
                },

                activeItem: {},
                showAddSide: false,
                showEditSide: false,
                showLoader: true,
                activeStatus: 'new',
                statusList: [{ text: this.__('New'), status: 'new' }, { text: this.__('Active'), status: 'active' }, { text: this.__('Completed'), status: 'completed' }, { text: this.__('Closed'), status: 'closed' }],
            }
        },
        props: [
            'path',
            'lang',
            'setting',
            'conf',
            'auth',
        ],
        mounted() {
            this.load()
        },

        methods:
        {
            closeMessage()
            {
                this.showLoader = true;
                this.showEditSide = false;
                this.activeItem = null;
                this.showLoader = false;
            },

            switchStatus(option) {
                this.showLoader = true;
                this.activeStatus = option.status
                this.showLoader = false;
            },

            showDetails(item) {
                this.showLoader = true
                this.showEditSide = true;
                this.activeItem = item;
                this.showLoader = false
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
                        this.$root.$children[0].deleteByKey(this.object_key, data, this.object_name + '.delete');
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
<template>
    <div class=" w-full">
        <div class="container-fluid">

<div class="row">
    <div class="col-lg-12">
        <div class="card mt-n4 mx-n4 card-border-effect-none">
            <div class="bg-primary-subtle">
                <div class="card-body pb-0 px-4">
                    
                    
                    <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a v-text="__('Active')" class="nav-link fw-semibold" data-bs-toggle="tab" href="#project-overview" role="tab" aria-selected="false" tabindex="-1"></a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a v-text="__('Completed')" class="nav-link fw-semibold" data-bs-toggle="tab" href="#project-documents" role="tab" aria-selected="false" tabindex="-1"></a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a v-text="__('Closed')" class="nav-link fw-semibold" data-bs-toggle="tab" href="#project-activities" role="tab" aria-selected="false" tabindex="-1"></a>
                        </li>
                    </ul>
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
                <div class="row g-4 mb-3">
                    <div class="col-sm">
                        <div class="d-flex">
                            <div class="search-box me-2">
                                <input type="text" class="form-control" placeholder="Search member...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#inviteMembersModal"><i class="ri-share-line me-1 align-bottom"></i> Invite Member</button>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="team-list list-view-filter" v-for="item in content.items">
                    <div class="card team-box">
                        <div class="card-body px-4">
                            <div class="row align-items-center team-row">
                                <div class="col team-settings">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="flex-shrink-0 me-2">
                                                <button type="button" class="btn fs-16 p-0 favourite-btn">
                                                    <i class="ri-star-fill"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col text-end dropdown">
                                            <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill fs-17"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col">
                                    <div class="team-profile-img">
                                        <div class="avatar-lg img-thumbnail rounded-circle">
                                            <img src="assets/images/users/avatar-2.jpg" alt="" class="img-fluid d-block rounded-circle">
                                        </div>
                                        <div class="team-content">
                                            <a href="#" class="d-block">
                                                <h5 class="fs-16 mb-1">Nancy Martino</h5>
                                            </a>
                                            <p class="text-muted mb-0">Team Leader &amp; HR</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col">
                                    <div class="row text-muted text-center">
                                        <div class="col-6 border-end border-end-dashed">
                                            <h5 class="mb-1">225</h5>
                                            <p class="text-muted mb-0">Projects</p>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-1">197</h5>
                                            <p class="text-muted mb-0">Tasks</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col">
                                    <div class="text-end">
                                        <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
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
            url: this.conf.url+this.path+'?load=json',
            content: {
                title: '',
                items: [],
                columns: [],
            },
            
            activeItem:{},
            showAddSide:false,
            showEditSide:false,
            showLoader: true,
        }
    },
    props: [
        'path',
        'lang',
        'setting',
        'conf',
        'auth',
    ],
    mounted() 
    {
        this.load()
    },

    methods: 
    {

        /**
         * Handle actions from datatable buttons
         * Called From 'dataTableActions' component
         * 
         * @param String actionName 
         * @param Object data
         */  
        handleAction(actionName, data) {
            switch(actionName) 
            {
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

        load()
        {
            this.showLoader = true;
            this.$root.$children[0].handleGetRequest( this.url ).then(response=> {
                this.setValues(response)
                this.showLoader = false;
            });
        },
        
        setValues(data) {
            this.content = JSON.parse(JSON.stringify(data)); return this
        },
        __(i)
        {
            return this.$root.$children[0].__(i);
        }
    }
};
</script>
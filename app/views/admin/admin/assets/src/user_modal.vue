<template>
    <div class="block w-full overflow-x-auto">
        
        <div v-if="showLoader">
            
        </div>
        <div v-if="User && !showLoader">
            
                <div class="modal-header" v-if="User">
                    <div class="row w-full">
                        <div class="col-md-7 account d-flex">
                            <div class="company_img">
                                <img :src="User.photo" :alt="User.name" class="user-image img-fluid" />
                            </div>
                            <div>
                                <p class="mb-0" v-if="User.role" v-text="User.role.name"></p>
                                <span class="modal-title" v-text="User.name"></span>
                                <span class="rating-star"><i class="fa fa-star" aria-hidden="true"></i></span>
                                <span class="lock"><i class="fa fa-lock" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="col-md-5 text-end">
                            <ul class="list-unstyled list-style-none">
                                <li class="dropdown list-inline-item"><br />
                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Actions </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Edit This Project</a>
                                        <a class="dropdown-item" href="#">Change Project Image</a>
                                        <a class="dropdown-item" href="#">Clone This Project</a>
                                        <a class="dropdown-item" href="#">Delete This Project</a>
                                        <a class="dropdown-item" href="#">Change Record Owner</a>
                                        <a class="dropdown-item" href="#">Generate Merge Document</a>
                                        <a class="dropdown-item" href="#">Print This Project</a>
                                        <a class="dropdown-item" href="#">Add New Task For Project</a>
                                        <a class="dropdown-item" href="#">Add New Event For Project</a>
                                        <a class="dropdown-item" href="#">Add Activity Set To Project</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="card due-dates">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span>Name</span>
                                <p v-text="User.name"></p>
                            </div>
                            <div class="col">
                                <span>Properties</span>
                                <p v-if="User.properties" v-text="User.properties.length"></p>
                            </div>
                            <div class="col">
                                <span>Phone</span>
                                <p v-text="User.phone"></p>
                            </div>
                            <div class="col">
                                <span>Email</span>
                                <p v-text="User.email"></p>
                            </div>
                            <div class="col">
                                <span>Role</span>
                                <p  v-if="User.role" v-text="User.role.name"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body project-pipeline">
                    <div class="row pb-2">
                        <div class="col">
                            <span>Pipeline: Deal Pipeline</span>
                        </div>
                        <div class="col text-end">
                            <span>Deal State: closed won</span>
                        </div>
                    </div>
                    <div class="row w-full m-0">
                        <div class="pipeline-small flat pipeline-project flex w-full Prjt-pipilines">
                            <a class="won noselect tipped-top text-white w-25" data-bs-toggle="tooltip" data-bsplacement="top" title="" data-bsoriginal-title="Plan">&nbsp;<span>Plan</span>
                                <span class="stretched-link" data-bs-toggle="modal" data-bs-target="#pipeline-stage" data-bs-dismiss="modal"></span>
                            </a>
                            <a class="won noselect tipped-top bg-gray text-white w-12" data-bs-toggle="tooltip" data-bsplacement="top" title="" data-bsoriginal-title="Design">&nbsp;<span>Design</span>
                                <span class="stretched-link" data-bs-toggle="modal" data-bs-target="#pipeline-stage" data-bs-dismiss="modal"></span>
                            </a>
                            <a class="won noselect tipped-top text-white w-25" data-bs-toggle="tooltip" data-bsplacement="top" title="" data-bsoriginal-title="Develop">&nbsp;<span>Develop</span>
                                <span class="stretched-link" data-bs-toggle="modal" data-bs-target="#pipeline-stage" data-bs-dismiss="modal"></span>
                            </a>
                            <a class="won noselect tipped-top text-white padding w-25" data-bs-toggle="tooltip" data-bsplacement="top" title="" data-bsoriginal-title="COmplete">&nbsp;Complete
                            </a>
                        </div>
                    </div>
                    
                </div>
        </div>
    </div>
</template>
<script>
const axios = require('axios').default;

export default 
{
    data() {
        return {
            id:0,
            User: {},
            showLoader: true
        }
    },
    mounted: function() 
    {
        console.log(this.$parent);
    },

    methods: 
    {
        checkById(id)
        {   
            this.showLoader = true;
            const params = new URLSearchParams([]);
            params.append('model', 'User');
            params.append('id', id);
            this.handleRequest(params).then(response=> {
                this.User = response;
                this.showLoader = false;
            });

        },
        async handleRequest(params) {

            // Demo json data
            return await axios.post('/api', params.toString()).then(response => 
            {
                if (response.data.status == true)
                    return response.data.result;
                else 
                    return response.data;
            });
        },
    
        async handleGetRequest(url) {

            // Demo json data
            return await axios.get(url).then(response => 
            {
                if (response.data.status == true)
                    return response.data.result;
                else 
                    return response.data;
            });
        },
        __(i)
        {
            return this.$parent.__(i);
        }
    }
};
</script>
<template>
    <div class="block w-full overflow-x-auto">
        

        <div class="w-full  lg:flex gap gap-6"  v-if="activeItem">
            <div class="w-full">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">First name</label>
                            <div class="w-full">
                                <input type="text" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="activeItem.first_name">
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Last name</label>
                            <div class="w-full">
                                <input type="text" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="activeItem.last_name">
                            </div>
                        </div>
                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Phone</label>
                            <div class="w-full">
                                <input type="tel" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="activeItem.phone">
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Picture</label>
                            <div v-if="activeItem.profile_image" class="w-full flex gap gap-6">
                                <img :src="activeItem.profile_image" class="w-20" >
                                <span @click="activeItem.profile_image = null">change</span>
                            </div>
                            <div class="w-full" v-else-if="!activeItem.profile_image">
                                <vue-medialibrary-field api_url="/" v-model="activeItem.file" ></vue-medialibrary-field>
                            </div>
                        </div>



                    </div>
                </div>

                

            </div>
            <div class="w-full">

                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Assigned info</h4>
                    </div>
                    <div class="card-body">

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Email</label>
                            <div class="w-full">
                                <input type="email" class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="activeItem.email">
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Password</label>
                            <div class="w-full">
                                <input type="password" class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="activeItem.password">
                            </div>
                        </div>
                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Status</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="activeItem.active">
                                    <option value="1">Active</option>
                                    <option value="0">In-Active</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>

        <div class="w-full">
            <div class="card flex-fill">
                <div class="card-body">
                    <button class="bg-purple-600 px-4 py-2 text-sm text-white" @click="submit" value="Save" >Save</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
const axios = require('axios').default;

export default 
{
    computed: {},
    data() {
        return {

            pending: false,
            tabs: [
                {title: 'Info', code: 'info'},
                {title: 'Pictures', code: 'pictures'},
                {title: 'Activities', code: 'activities'}
            ],
            
            currentTab:'info',

            file: null,
            activeItem: {id:0, first_name:'', last_name:'',email:'',phone:'',password:'',files:[]},
            showList: true,
        }
    },
    props: ['site_url', 'user', 'lang', 'role_id'],
    mounted: function() 
    {

        if (this.user)
        {
            this.activeItem = this.user;
        }

    },

    methods: 
    {
        addTask()
        {

        },
        addFile()
        {
            this.showList = false;
            this.activeItem.files.push({});
            this.showList = true;
            return this;
        },
        filterFiles()
        {
            this.activeItem.files = this.activeItem.files.filter(file => file);        
            return this;
        },
        pushToFiles(i, item)
        {
            this.activeItem.files.push(item);        

            return this;
        },

        setTab(code)
        {
            this.currentTab = code;
            return this
        },

        __(i)
        {
            let val = (i.charAt(0).toUpperCase()+i.slice(1)).replace('_', ' ');

            return val;
        },
        submit() {

            if (this.pending)
                return null;


            this.pending = true;
            const params = new URLSearchParams([]);
            let type = this.activeItem.id ?  'update' : 'create';
            params.append('type', 'User.' + type);
            if (this.activeItem.id)
            {
                params.append('params[user][id]', this.activeItem.id);
            }

            params.append('params[user][first_name]', this.activeItem.first_name ? this.activeItem.first_name : '');
            params.append('params[user][last_name]', this.activeItem.last_name ? this.activeItem.last_name : '');
            params.append('params[user][password]', this.activeItem.password ? this.activeItem.password : '');
            params.append('params[user][phone]', this.activeItem.phone ? this.activeItem.phone : '');
            params.append('params[user][email]', this.activeItem.email ? this.activeItem.email : '');
            params.append('params[user][role_id]', this.activeItem.role_id ? this.activeItem.role_id : this.role_id);
            params.append('params[user][active]', this.activeItem.active ? this.activeItem.active : 0);
            params.append('params[user][profile_image]', this.activeItem.file ? this.activeItem.file : this.activeItem.profile_image);
            this.handleRequest(params, '/api/'+type).then(data => { 
                this.$alert(data.result ? data.result : data.error);
                if (data.reload)
                {
                    window.location.reload();
                }
                this.pending = false;
            });
        },
        async handleRequest(params, url = '/') {

            // Demo json data
            return await axios.post(url, params.toString()).then(response => 
            {
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
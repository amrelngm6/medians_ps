<template>
    <div class="block w-full overflow-x-auto">
        

        <div class="w-full lg:flex  gap gap-6"  v-if="Customer">
            <div class="w-full">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">First name</label>
                            <div class="w-full">
                                <input type="text" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Customer.first_name">
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Last name</label>
                            <div class="w-full">
                                <input type="text" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Customer.last_name">
                            </div>
                        </div>
                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Phone</label>
                            <div class="w-full">
                                <input type="tel" required class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Customer.phone">
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Email</label>
                            <div class="w-full">
                                <input type="email" class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Customer.email">
                            </div>
                        </div>

                    </div>

                    <div class="card-header">
                        <h4 class="card-title mb-0">Assigned info</h4>
                    </div>
                    <div class="card-body">

                        <div class="gap gap-6 w-full flex py-2" >
                            <label class="w-full col-form-label">Business type</label>
                            <div class="w-full">
                                <select placeholder="Choose business type" class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Customer.business_type">
                                    <option value="buyer" >Buyer</option>
                                    <option value="tenant" >Tenant</option>
                                </select>
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2" v-if="sources">
                            <label class="w-full col-form-label">Source</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Customer.source_id">
                                    <option v-for="(value,i) in sources" :value="value.id" v-text="value.name"></option>
                                </select>
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2" v-if="Agents">
                            <label class="w-full col-form-label">Agent</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Customer.agent_id">
                                    <option v-for="(value,i) in Agents" :value="value.id" v-text="value.name"></option>
                                </select>
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2" v-if="stages">
                            <label class="w-full col-form-label">Stage</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Customer.stage_id">
                                    <option v-for="(value,i) in stages" :value="value.id" v-text="value.name"></option>
                                </select>
                            </div>
                        </div>

                        <div class="gap gap-6 w-full flex py-2">
                            <label class="w-full col-form-label">Status</label>
                            <div class="w-full">
                                <select class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Customer.status">
                                    <option value="1">Active</option>
                                    <option value="0">In-Active</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="w-full">


                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Address Form</h4>
                    </div>
                    <div class="card-body">
                        <div class="gap gap-6 w-full flex py-2" v-for="loc in Customer.location_fields">
                            <label class="w-full col-form-label" v-text="__(loc)"></label>
                            <div class="w-full">
                                <input type="text" class="h-auto py-1 w-full form-control border rounded-lg border-gray-200 px-2" v-model="Customer.location[loc]">
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
            tabs: [
                {title: 'Info', code: 'info'},
                {title: 'Pictures', code: 'pictures'},
                {title: 'Activities', code: 'activities'}
            ],
            
            currentTab:'info',

            file: null,
            Customer: {id:0, type:'',files:[], location:{}, properties:{}, tasks:{}},
            ItemsList: [],
            Agents:[],
            showList: true,
        }
    },
    props: ['site_url', 'old_customer', 'lang', 'agents', 'sources', 'stages'],
    mounted: function() 
    {

        if (this.old_customer)
        {
            this.Agents = this.agents;
            this.Customer = this.old_customer ? this.old_customer : this.Customer;        
            this.Customer.location = this.old_customer.location ? this.old_customer.location : {};        
            this.Customer.files = this.old_customer.files ? this.old_customer.files : [];        
            this.Customer.tasks = this.old_customer.tasks ? this.old_customer.tasks : [];        
            this.Customer.properties = this.old_customer.properties ? this.old_customer.properties : [];        
        }

        console.log(this.Customer);
    },

    methods: 
    {
        addTask()
        {

        },
        addFile()
        {
            this.showList = false;
            this.Customer.files.push({});
            this.showList = true;
            return this;
        },
        filterFiles()
        {
            this.Customer.files = this.Customer.files.filter(file => file);        
            return this;
        },
        pushToFiles(i, item)
        {
            this.Customer.files.push(item);        

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

            let type = this.Customer.id ?  'update' : 'create';
            const params = new URLSearchParams([]);
            params.append('type', 'Customer.'+type);
            params.append('params[customer]', JSON.stringify(this.Customer));
            this.handleRequest(params, '/api/'+type).then(data => { 
                this.$alert(data.result);
            });
        },
        async handleRequest(params, url = '/') {

            // Demo json data
            return await axios.post(url, params.toString()).then(response => 
            {
                if (response.data.status == true)
                    return response.data;
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
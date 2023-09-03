<template>
    <div class="block w-full overflow-x-auto">
    </div>
</template>
<script>
const axios = require('axios').default;

export default 
{
    computed: {},
    data() {
        return {
            Property: {},
            ItemsList: []
        }
    },
    props: ['page', 'message', 'itemId'],
    created: function() 
    {
        this.fetchData(this.page);
    },
    methods: 
    {

        fetchData(page) {

            const params = new URLSearchParams([]);
            params.append('property', this.Property);
            this.handleRequest(params).then(data => { this.ItemsList = data; });
        },
        async handleRequest(params) {

            // Demo json data
            return await axios.post('/', params.toString()).then(response => 
            {
                if (response.data.status == true)
                    return response.data.result;
                else 
                    return response.data;
            });
        }
    }
};
</script>
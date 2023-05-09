<template>
    <div class="w-full flex overflow-auto" style="height: 85vh; z-index: 9999;">
        <div class=" w-full">
            <div v-if="content && !showLoader"  class=" w-full px-4 overflow-y-auto h-full">
                <div class="crms-title flex bg-white mb-6 gap gap-6">
                    <div class="w-full">
                        <h3 class="gap gap-6 flex page-title m-0">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="feather-user"></i>
                            </span> 
                            <span>{{content.title}}</span> 
                        </h3>
                    </div>
                    <div class="">
                        <ul class="breadcrumb text-right bg-white float-end m-0 ps-0 pe-0 flex gap gap-6">
                            <li class="breadcrumb-item w-20"><a href="javascript:;">{{__('Dashboard')}}</a></li>
                            <li class="breadcrumb-item w-28 active">{{content.title}}</li>
                        </ul>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-md-12">
                        <pie :reports="content.reports" :key="content.reports"></pie>
                        <div v-if="content.reports" class="card mb-0">

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <script type="application/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    </div>
</template>
<script>
import pie from './reports-pie.vue'

export default {

    components: {
        pie
    },
    name:'devices_orders',
    data() {
        return {
            url: this.conf.url+this.path+'?load=json',
            content: {

                title: '',
                reports: [],
            },

            activeItem:null,
            showAddSide:false,
            showEditSide:false,
            showLoader: false,
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
        load()
        {
            this.showLoader = true;
            this.$parent.handleGetRequest( this.url ).then(response=> {
                this.setValues(response)
                this.showLoader = false;
                // this.$alert(response)
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
<style lang="css">
    .rtl #side-cart-container
    {
        right: auto;
        left:0;
    }
</style>
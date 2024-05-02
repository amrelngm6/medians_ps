<template>
    
    <div :class="classes" class="card hoverable card-xl-stretch mb-xl-8">
        <CChartLine
            v-if="content"
            :wrapper="false"
            :data="handleData"
            />
        <!--begin::Body-->
        <div class="card-body">
            <img width="25" height="25" :src="icon" />

            <div :class="value_class" class="fw-bold fs-2 mb-2 mt-5"  v-text="value"> </div>

            <div :class="text_class" class="fw-semibold "  v-text="title"></div>
        </div>
        <!--end::Body-->
    </div>

</template>
<script>
import {ref} from 'vue';
// import { CChart } from '@coreui/vue-chartjs'
import { CChart, CChartBar, CChartLine, CChartDoughnut, CChartRadar, CChartPie, CChartPolarArea } from '@coreui/vue-chartjs'
export default 
{
    components: {
        CChart, CChartBar, CChartLine, CChartDoughnut, CChartRadar, CChartPie, CChartPolarArea
    },
    setup(props) {

        
        const handleData = () => 
        {
            console.log(props.options);
            return props.options;
            
        }

        return {
            handleData
        };
    },
    props: [
        'classes',
        'options',
    ],

};
</script>

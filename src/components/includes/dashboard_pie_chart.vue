<template>
    
    <div >
        <CChart
            :type="type"
            :data="handleData"
            />
    </div>

</template>
<script>
import {ref} from 'vue'
import { CChart, CChartBar, CChartLine, CChartDoughnut, CChartRadar, CChartPie, CChartPolarArea } from '@coreui/vue-chartjs'
export default 
{
    components: {
        CChart, CChartBar, CChartLine, CChartDoughnut, CChartRadar, CChartPie, CChartPolarArea
    },
    setup(props) {

        const colors = ref(['#7239ea','#17c653','#f8285a','#f1ed5c','#1e2129']);        
        const colorsList = ref([]);        
        const optionsList = ref();        
        optionsList.value = props.options;

        const handleData = () => 
        {
            for (let i = 0; i < optionsList.value.labels.length; i++) {
                const element = optionsList.value.labels[i];
                
            }    
            return props.options;
            
        }

        return {
            handleData
        };
    },
    props: [
        'type',
        'options',
    ],

};
</script>

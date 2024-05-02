<template>
    
    <div >
        <CChart
            type="pie"
            :data="handleData"
            />
    </div>

</template>
<script>
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

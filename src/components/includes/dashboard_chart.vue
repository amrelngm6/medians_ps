<template>
    
    <div :class="classes" class="card hoverable card-xl-stretch mb-xl-8">
        <CChartLine
            :wrapper="false"
            :data="{
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [
                {
                    label: 'My First dataset',
                    backgroundColor: 'rgba(220, 220, 220, 0.2)',
                    borderColor: 'rgba(220, 220, 220, 1)',
                    pointBackgroundColor: 'rgba(220, 220, 220, 1)',
                    pointBorderColor: '#fff',
                    data: [40, 20, 12, 39, 10, 40, 39]
                },
                {
                    label: 'My Second dataset',
                    backgroundColor: 'rgba(151, 187, 205, 0.2)',
                    borderColor: 'rgba(151, 187, 205, 1)',
                    pointBackgroundColor: 'rgba(151, 187, 205, 1)',
                    pointBorderColor: '#fff',
                    data: [50, 12, 28, 29, 7, 25, 12]
                }
                ]
            }"
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
// import { CChart } from '@coreui/vue-chartjs'
import { CChart, CChartBar, CChartLine, CChartDoughnut, CChartRadar, CChartPie, CChartPolarArea } from '@coreui/vue-chartjs'
export default 
{
    components: {
        CChart, CChartBar, CChartLine, CChartDoughnut, CChartRadar, CChartPie, CChartPolarArea
    },
    props: [
        'title',
        'value',
        'classes',
        'text_class',
        'value_class',
        'icon',
    ],

};
</script>

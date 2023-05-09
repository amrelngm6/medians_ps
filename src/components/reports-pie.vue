<template>
    <div>
        <canvas id="myChart" ref="myChart" width="400" height="400"></canvas>
        
    </div>
</template>
<script>
import { Pie } from 'vue-chartjs';

export default {

    data() {
        return {
            items: {},
            config: {},
            myChart: {},
        };
    },
    props:['reports'],
    extends: Pie,
    mounted() {
            console.log(this.reports)
                    // Sample data
            this.items = this.reports;

            // Chart configuration
            this.config = {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: {
                  position: 'top',
                },
                title: {
                  display: true,
                  text: 'My Chart'
                }
              }
            };

            // Render the chart
            this.renderChart(this.items, this.config);


    },
    methods: {


    },
};
</script>

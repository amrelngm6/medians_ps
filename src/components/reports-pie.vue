<template>
    <div>
        <script type="application/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <canvas id="myChart" width="400" height="400"></canvas>
        
    </div>
</template>
<script>
export default {

    data() {
        return {
            items: {},
            config: {},
            myChart: {},
        };
    },
    mounted() {

                // Sample data
        this.items = {
          labels: ['Red', 'Blue', 'Yellow'],
          datasets: [{
            label: 'My First Dataset',
            data: [300, 50, 100],
            backgroundColor: [
              'rgb(255, 99, 132)',
              'rgb(54, 162, 235)',
              'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
          }]
        };


        // Chart configuration
        this.config = {
          type: 'pie',
          data: this.items,
        };

        // Create the chart
        this.myChart = new Chart(
          document.getElementById('myChart'),
          this.config
        );

    },
    methods: {


    },
};
</script>
<style lang="scss" src="./main.scss"></style>

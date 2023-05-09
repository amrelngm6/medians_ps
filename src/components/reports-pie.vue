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
    props:['reports'],
    mounted() {

                // Sample data
        this.items = this.reports;


        // Chart configuration
        this.config = {
          type: 'pie',
          data: this.items,
        };

        if (Chart)
        {
            // Create the chart
            this.myChart = new Chart(
              document.getElementById('myChart'),
              this.config
            );
        }

    },
    methods: {


    },
};
</script>

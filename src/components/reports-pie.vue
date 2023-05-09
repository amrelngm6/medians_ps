<template>
    <div>

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


    // Chart configuration
    // const config = {
    //   responsive: true,
    //   maintainAspectRatio: false,
    //   plugins: {
    //     legend: {
    //       position: 'top',
    //     },
    //     title: {
    //       display: true,
    //       text: 'My Chart'
    //     }
    //   }
    // };
    },
    methods: {


    },
};
</script>

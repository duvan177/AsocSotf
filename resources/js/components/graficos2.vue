<template>
  <div id="small2">
    <pie-chart :data="chartData" :options="chartOptions"></pie-chart>
  </div>
</template>

<script>
import PieChart from "./PieChart.js";
export default {
  name: "App",
  components: {
    PieChart
  },
  data() {
    return {
      chartOptions: {
        hoverBorderWidth: 20
      },
      chartData: {
        hoverBackgroundColor: "red",

        labels: ["Green", "Red", "Blue"],
        datasets: [
          {
            label: "Data One",
            backgroundColor: ["#41B883", "#E46651", "#00D8FF"],
            data: [1, 10, 5]
          }
        ]
      }
    };
  }
};
</script>

<style lang="css">
#small2 {
  max-width: 200px;
  /* max-height: 500px; */
}
</style>

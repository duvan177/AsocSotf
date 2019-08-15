<template>
  <div class="small">
    <h4>Reportes del Venta anual</h4>
    <div id="grafico" class="chart-container">
      <line-chart :chart-data="datacollection" :height="285"></line-chart>
    </div>
  </div>
</template>


<script>
import LineChart from "./LineChart.js";

export default {
  components: {
    LineChart
  },
  data() {
    return {
      datacollection: null
    };
  },
  mounted() {
    this.fillData();
  },
  methods: {
    fillData() {
      this.datacollection = {
        labels: [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July"
        ],
        datasets: [
          {
            label: "Ventas",
            data: [65, 59, 80, 81, 56, 55, 40],
            backgroundColor: ["rgba(105, 0, 132, .2)"],
            borderColor: ["rgba(200, 99, 132, .7)"],
            borderWidth: 2
          },
          {
            label: "Compras",
            data: [28, 48, 40, 19, 86, 27, 90],
            backgroundColor: ["rgba(0, 137, 132, .2)"],
            borderColor: ["rgba(0, 10, 130, .7)"],
            borderWidth: 2
          }
        ]
      };
    }
  }
};
</script>

<style lang="css">
.small {
  max-width: 800px;
  /* max-height: 500px; */
}
</style>
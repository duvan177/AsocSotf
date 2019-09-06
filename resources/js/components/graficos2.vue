  <template>
  <div>
    <apexchart width="200" type="donut" :options="options" :series="series"></apexchart>
  </div>
</template>

<script>
import VueApexCharts from "vue-apexcharts";

//import LineChartMeses from "./LineChart.js";
Vue.component("apexchart", VueApexCharts);
export default {
  components: {
    //LineChartMeses
  },
  data() {
    return {
      options: {},
      series: [44, 55, 41]
    };
  }
};
</script>

<style lang="css">
.small {
  max-width: 800px;
  /* max-height: 500px; */
}
</style>

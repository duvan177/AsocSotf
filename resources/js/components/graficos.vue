<template>
  <div class="small">
    <h5>Reportes del Venta vs Compras</h5>

    <select v-model="seleccion" class="browser-default custom-select">
      <option value="1">Semanal</option>
      <option value="2">Mensual</option>
    </select>
    <div v-if="seleccion==1">
      <div id="grafico" class="chart-container">
        <line-chart :chart-data="datacollection" :height="285"></line-chart>
      </div>
    </div>
    <div v-if="seleccion==2">
      <div id="grafico" class="chart-container">
        <meses :chart-data="meses1" :height="285"></meses>
      </div>
    </div>
  </div>
</template>


<script>
import LineChart from "./LineChart.js";
import meses from "./LineChart.js";
//import LineChartMeses from "./LineChart.js";
export default {
  components: {
    LineChart,
    meses
    //LineChartMeses
  },
  data() {
    return {
      datacollection: null,
      meses1: null,
      seleccion: 1,
      detalleing: [],
      detalleven: [],
      fechaCompra: [],
      fechaVenta: [],
      lunesCompra: 0,
      martesCompra: 0,
      miercolesCompra: 0,
      juevesCompra: 0,
      viernesCompra: 0,
      sabadoCompra: 0,
      domingoCompra: 0,
      lunesVenta: 0,
      martesVenta: 0,
      miercolesVenta: 0,
      juevesVenta: 0,
      viernesVenta: 0,
      sabadoVenta: 0,
      domingoVenta: 0,

      eneroven: 0,
      febven: 0,
      marven: 0,
      abrven: 0,
      mayven: 0,
      junven: 0,
      julven: 0,
      agoven: 0,
      septven: 0,
      octven: 0,
      novven: 0,
      dicven: 0,
      enecomp: 0,
      febcomp: 0,
      marcomp: 0,
      abrcomp: 0,
      maycomp: 0,
      juncomp: 0,
      julcomp: 0,
      agocomp: 0,
      septcomp: 0,
      octcomp: 0,
      novcomp: 0,
      diccomp: 0
    };
  },
  mounted() {
    this.iniciar();
  },
  methods: {
    iniciar() {
      this.traerCompra().then(() => {
        for (let index = 0; index < this.detalleing.length; index++) {
          this.fechaCompra[index] = this.detalleing[index].created_at;
        }
        this.asignarCompra();
      });
      this.traerVenta().then(() => {
        for (let index = 0; index < this.detalleven.length; index++) {
          this.fechaVenta[index] = this.detalleven[index].created_at;
        }
        this.asignarVenta();
        this.fillData();
        this.meses();
      });
    },
    traerCompra() {
      return new Promise((resolve, reject) => {
        let meconsulta = this;

        axios.post("api/detalleing").then(function(response) {
          meconsulta.detalleing = response.data;
          resolve();
        });
      });

      this.asignar();
    },
    traerVenta() {
      return new Promise((resolve, reject) => {
        let meconsulta2 = this;
        axios.post("api/detalleven").then(function(response) {
          meconsulta2.detalleven = response.data;
          resolve();
        });
      });
    },
    asignarCompra() {
      var nota = new Date();
if(nota.getDay()==1){
var diaLu = nota.getDate();
var proximoLunes = diaLu + 7;
console.log("entro");
}

      this.fechaCompra.forEach(element => {
        let fechcompra = new Date(element);
        console.log(fechcompra.getDay());
        var dia = fechcompra.getDay();
        var comparar = fechcompra.getDate(element);
        if (dia == 1) {
          this.lunesCompra++;
        } else if (dia == 2) {
          this.martesCompra++;
        } else if (dia == 3) {
          this.miercolesCompra++;
        } else if (dia == 4) {
          this.juevesCompra++;
        } else if (dia == 5) {
          this.viernesCompra++;
        } else if (dia == 6) {
          this.sabadoCompra++;
        } else if (dia == 0) {
          this.domingoCompra++;
        }
        var mes = fechcompra.getMonth();
        console.log(mes);
        if (mes == 0) {
          this.enecomp++;
        } else if (mes == 1) {
          this.febcomp++;
        } else if (mes == 2) {
          this.marcomp++;
        } else if (mes == 3) {
          this.abrcomp++;
        } else if (mes == 4) {
          this.maycomp++;
        } else if (mes == 5) {
          this.juncomp++;
        } else if (mes == 6) {
          this.julcomp++;
        } else if (mes == 7) {
          this.agocomp++;
        } else if (mes == 8) {
          this.septcomp++;
        } else if (mes == 9) {
          this.octcomp++;
        } else if (mes == 10) {
          this.novcomp++;
        } else if (mes == 11) {
          this.diccomp++;
        }
      });
    },
    asignarVenta() {
      this.fechaVenta.forEach(element => {
        let fechventa = new Date(element);
        console.log(fechventa.getDay());
        var dia = fechventa.getDay();
        if (dia == 1) {
          this.lunesVenta++;
        } else if (dia == 2) {
          this.martesVenta++;
        } else if (dia == 3) {
          this.miercolesVenta++;
        } else if (dia == 4) {
          this.juevesVenta++;
        } else if (dia == 5) {
          this.viernesVenta++;
        } else if (dia == 6) {
          this.sabadoVenta++;
        } else if (dia == 0) {
          this.domingoVenta++;
        }

        var mes = fechventa.getMonth();
        console.log(mes);
        if (mes == 0) {
          this.eneroven++;
        } else if (mes == 1) {
          this.febven++;
        } else if (mes == 2) {
          this.marven++;
        } else if (mes == 3) {
          this.abrven++;
        } else if (mes == 4) {
          this.mayven++;
        } else if (mes == 5) {
          this.junven++;
        } else if (mes == 6) {
          this.julven++;
        } else if (mes == 7) {
          this.agoven++;
        } else if (mes == 8) {
          this.septven++;
        } else if (mes == 9) {
          this.octven++;
        } else if (mes == 10) {
          this.novven++;
        } else if (mes == 11) {
          this.dicven++;
        }
      });
    },
    fillData() {
      this.datacollection = {
        labels: [
          "Lunes",
          "Martes",
          "Miercoles",
          "Jueves",
          "Viernes",
          "Sabado",
          "Domingo"
        ],
        datasets: [
          {
            label: "Ventas",
            data: [
              this.lunesVenta,
              this.martesVenta,
              this.miercolesVenta,
              this.juevesVenta,
              this.viernesVenta,
              this.sabadoVenta,
              this.domingoVenta
            ],
            backgroundColor: ["rgba(105, 0, 132, .2)"],
            borderColor: ["rgba(200, 99, 132, .7)"],

            borderWidth: 2
          },
          {
            label: "Compras",
            data: [
              this.lunesCompra,
              this.martesCompra,
              this.miercolesCompra,
              this.juevesCompra,
              this.viernesCompra,
              this.sabadoCompra,
              this.domingoCompra
            ],
            backgroundColor: ["rgba(0, 137, 132, .2)"],
            borderColor: ["rgba(0, 10, 130, .7)"],
            borderWidth: 2
          }
        ]
      };
    },
    meses() {
      this.meses1 = {
        labels: [
          "Enero",
          "Febrero",
          "Marzo",
          "Abril",
          "Mayo",
          "Junio",
          "Julio",
          "Agosto",
          "Septiembre",
          "Octubre",
          "Noviembre",
          "Diciembre"
        ],
        datasets: [
          {
            label: "Ventas",
            data: [
              this.eneroven,
              this.febven,
              this.marven,
              this.abrven,
              this.mayven,
              this.junven,
              this.julven,
              this.agoven,
              this.septven,
              this.octven,
              this.novven,
              this.dicven
            ],
            backgroundColor: ["rgba(105, 0, 132, .2)"],
            borderColor: ["rgba(200, 99, 132, .7)"],
            borderWidth: 2
          },
          {
            label: "Compras",
            data: [
              this.enecomp,
              this.febcomp,
              this.marcomp,
              this.abrcomp,
              this.maycomp,
              this.juncomp,
              this.julcomp,
              this.agocomp,
              this.septcomp,
              this.octcomp,
              this.novcomp,
              this.diccomp
            ],
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

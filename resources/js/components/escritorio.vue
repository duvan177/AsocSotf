<template>
  <div class="row animated fadeIn">
    <div class="col-sm-6">
      <div id="card_escritorio1" class="card">
        <div class="card-body">
          <img id="fondo_naranja" src="img/fondo_naranja.png" class="card-img-top" alt />
          <img id="fondo_compras" src="img/compras_escritorio.jpg" class="card-img" alt />
          <div class="card-body">
            <h6 id="titulo_escritorio" class="card-title">Compras</h6>
            <div id="datos_escritorio" class="d-flex justify-content-between mb-6">
              <h6 class="text-danger" v-text="'total generado : $'+datos_today.compras"></h6>
              <h6 v-text="'Total Venta: $'"></h6>
            </div>
            <div id="datos_escritorio" class="d-flex justify-content-between mb-6">
              <h6 class="card-title" v-text="'total generado : $'+datos_today.compras"></h6>
              <h6 v-text="'Total Venta: $'"></h6>
            </div>
          </div>
        </div>
      </div>

      <div id="card_escritorio1" class="card">
        <div id="cardx" class="card-body">
          <img id="fondo_naranja" src="img/fondo_verde.png" class="card-img-top" alt />
          <img id="fondo_compras" src="img/ventas_escritorio.png" class="card-img" alt />
          <div class="card-body">
            <h6 id="titulo_escritorio2" class="card-title">Ventas</h6>
            <div id="datos_escritorio" class="d-flex justify-content-between mb-6">
              <h6 v-text="'total generado : $'+datos_today.ventas"></h6>
            </div>
          </div>
        </div>
      </div>

      <!-- datos para el carousel -->

      <carousel :touchDrag="true" :autoplay="true" :centerMode="true" :scrollPerPage="true">
        <slide>
          <h5 class="card-title" v-text="'total stock : $'+datos_today.ventas"></h5>
          <h5 class="card-title" v-text="' stock : 4'"></h5>
          <span class="badge badge-warning">
            <h5 class="card-title" v-text="' estado : bajo'"></h5>
          </span>
        </slide>
        <slide>
          <h5 class="card-title" v-text="'total stock : $'+datos_today.ventas"></h5>
          <h5 class="card-title" v-text="' stock : 4'"></h5>
          <span class="badge badge-warning">
            <h5 class="card-title" v-text="' estado : bajo'"></h5>
          </span>
        </slide>
        <slide>
          <h5 class="card-title" v-text="'total stock : $'+datos_today.ventas"></h5>
          <h5 class="card-title" v-text="' stock : 13'"></h5>
          <span class="badge badge-warning">
            <h5 class="card-title" v-text="' estado : bajo'"></h5>
          </span>
        </slide>
        <slide>
          <h5 class="card-title" v-text="'total stock : $'+datos_today.ventas"></h5>
          <h5 class="card-title" v-text="' stock : 0'"></h5>
          <span class="badge badge-danger">
            <h5 class="card-title" v-text="' estado : agotado'"></h5>
          </span>
        </slide>
      </carousel>

      <!-- fin -->
    </div>
    <div class="col-sm-6 mb-3 mb-md-0">
      <h5 class="card-title">Graficos estadisticos</h5>
      <graficos></graficos>
    </div>
  </div>
</template>

<script>
import Echo from "laravel-echo";
import { EventEmitter } from "events";
import { Carousel, Slide } from "vue-carousel";
window.Pusher = require("pusher-js");
export default {
  components: { Carousel, Slide },
  data() {
    return {
      lists: [
        {
          id: 12,
          id_ingreso: 12,

          ingreso: [
            {
              id: 12,
              id_proveedor: 30,
              id_estado: 2
            }
          ],
          persona: [
            {
              id: 30,
              id_tipo_persona: 3
            }
          ],
          articulo: [
            {
              id: 44,
              id_categoria: 4
            }
          ]
        },
        {
          id: 21,
          id_ingreso: 12,

          ingreso: [
            {
              id: 12,
              id_proveedor: 30,
              id_estado: 1
            }
          ],
          persona: [
            {
              id: 40,
              id_tipo_persona: 37
            }
          ],
          articulo: [
            {
              id: 99,
              id_categoria: 78
            }
          ]
        },
        {
          id: 21,
          id_ingreso: 31,

          ingreso: [
            {
              id: 31,
              id_proveedor: 30,
              id_estado: 2
            }
          ],
          persona: [
            {
              id: 40,
              id_tipo_persona: 37
            }
          ],
          articulo: [
            {
              id: 99,
              id_categoria: 78
            }
          ]
        },
        {
          id: 11,
          id_ingreso: 11,

          ingreso: [
            {
              id: 30,
              id_proveedor: 30,
              id_estado: 2
            }
          ],
          persona: [
            {
              id: 30,
              id_tipo_persona: 37
            }
          ],
          articulo: [
            {
              id: 99,
              id_categoria: 78
            }
          ]
        }
      ],
      allbusqueda: [],
      busqueda: [],
      encontrado: false,
      cargando_3: true,
      total_compra: "",
      total_venta: "",
      datos_today: [],
      tabla: false
    };
  },

  methods: {
    buscar: function() {
      this.lists.forEach(element => {
        let data = element;
        let dato = element.ingreso[0];

        if (dato.id_estado == 12) {
          this.busqueda.push(dato);
          this.allbusqueda = data;
        }
      });
    },
    cambiar: function() {},
    totales_today() {
      let med = this;
      axios
        .post("/api/datos_ventas_compras")
        .then(function(response) {
          console.log(response.data);
          med.datos_today = response.data;
        })
        .catch(function(error) {
          // handle error
          // console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.tabla = true));
    }
  },
  computed: {},

  mounted() {
    this.totales_today();
    this.buscar();
    window.Echo = new Echo({
      broadcaster: "pusher",
      key: "ASDASD2121",
      wsHost: window.location.hostname,
      wsPort: 6001,
      disableStats: true
    });
    window.Echo.channel("channel-notif").listen("NotificacionEvent", e => {
      console.log(e.mensaje);
      this.totales_today();
    });
    console.log("Component mounted.");
  },

  watch: {}
};
</script>

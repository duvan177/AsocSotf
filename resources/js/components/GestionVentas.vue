<template>
  <main class="main">
    <!-- Breadcrumb -->

    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i>
          Gestion de faturas
        </div>

        <div class="card-body">
          <nav>
            <div class="row mx-md-n5">
              <div class="col px-md-7">
                <div class="p-3 border">
                  <div class="form-group row"></div>

                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                      <a
                        class="nav-link active"
                        id="pills-home-tab"
                        data-toggle="pill"
                        href="#pills-home"
                        role="tab"
                        aria-controls="pills-home"
                        aria-selected="true"
                        v-on:click=" getVentas_x"
                      >Buscar N.Comprobante</a>
                    </li>
                    <li class="nav-item">
                      <a
                        class="nav-link"
                        id="pills-profile-tab"
                        data-toggle="pill"
                        href="#pills-profile"
                        role="tab"
                        aria-controls="pills-profile"
                        aria-selected="false"
                      >Buscar por Fecha</a>
                    </li>
                    <li class="nav-item">
                      <a
                        class="nav-link"
                        id="pills-contact-tab"
                        data-toggle="pill"
                        href="#pills-contact"
                        role="tab"
                        aria-controls="pills-contact"
                        aria-selected="false"
                      >ver ventas por mes</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div
                      class="tab-pane fade show active"
                      id="pills-home"
                      role="tabpanel"
                      aria-labelledby="pills-home-tab"
                    >
                      <div class="col-md-6">
                        <input
                          type="text"
                          id="texto2"
                          class="form-control"
                          placeholder="Comprobante a buscar"
                          v-model="venta_detalle"
                          v-on:keyup.enter="filtrar"
                        />
                        <div class="input-group">
                          <input
                            type="text"
                            id="texto"
                            class="form-control"
                            placeholder="Comprobante a buscar"
                            v-model="venta_detalle"
                            v-on:keyup.enter="filtrar"
                          />
                          <button class="btn btn-primary" v-on:click="filtrar">
                            <i class="fa fa-search"></i> Buscar
                          </button>
                          <div id="check" class="col-md-2">
                            <toggle-button
                              v-model="ver"
                              :value="false"
                              color="#31B404"
                              :sync="true"
                              :labels="{checked: 'Ver todo', unchecked: 'Ver hoy'}"
                              :width="80"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="tab-pane fade"
                      id="pills-profile"
                      role="tabpanel"
                      aria-labelledby="pills-profile-tab"
                    >
                      <div class="col-md-6">
                        <div class="input-group">
                          <input
                            class="form-control"
                            type="date"
                            v-model="form.date2"
                            format="yyyy-MM-dd"
                          />
                          <button class="btn btn-primary" v-on:click="filtrar_fecha">
                            <i class="fa fa-search"></i> Fecha
                          </button>
                        </div>
                      </div>
                    </div>
                    <div
                      class="tab-pane fade"
                      id="pills-contact"
                      role="tabpanel"
                      aria-labelledby="pills-contact-tab"
                    >
                      <div class="col-md-6">
                        <div class="input-group">
                          <input class="form-control" type="month" v-model="fecha_consul" />
                          <button class="btn btn-primary" v-on:click="filtrar_mes">
                            <i class="fa fa-search"></i> Mes
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-hover table-striped mb-0">
                      <section v-if="cargando_2">
                        <div class="container">
                          <div id="preloader_1">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                          </div>
                        </div>
                      </section>
                      <section v-else>
                        <thead>
                          <tr>
                            <th>N° Comprobante</th>
                            <th>cliente</th>
                            <th>Tipo Comprobane</th>
                            <th>Descuento</th>
                            <th>Total</th>
                            <th>Rentabilidad</th>
                            <th>Fecha y hora</th>
                            <th>Opciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr
                            v-bind:id="item.id"
                            class="animated fadeIn"
                            v-for="item in ventas"
                            :key="item.id"
                          >
                            <td v-text="item.num_comprobante"></td>
                            <td v-text="item.nombre"></td>
                            <td v-text="item.Comprobante"></td>
                            <td v-text="item.descuento.toLocaleString('de-DE')"></td>
                            <td v-text="item.total_venta.toLocaleString('de-DE')"></td>
                            <td
                              class="teal-text"
                              v-text="'+ '+item.rentabilidad.toLocaleString('de-DE')"
                            ></td>
                            <td v-text="item.created_at"></td>
                            <td id="btn_t1">
                              <button
                                v-on:click="informacion(item)"
                                type="button"
                                :id="item.num_comprobante"
                                class="btn btn-primary btn-sm"
                              >
                                <i class="icon-info"></i> ver +
                              </button>
                            </td>
                            <td id="btn_t2">
                              <button
                                type="button"
                                class="btn btn-primary btn-sm"
                                :id="item.num_comprobante"
                                v-on:click="informacion(item)"
                                data-toggle="modal"
                                data-target="#modalNuevo"
                              >
                                <i class="icon-plus"></i>&nbsp;ver +
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </section>
                    </table>
                  </div>
                  <div class="d-flex justify-content-between mb-2">
                    <h6 v-text="'cantd. Ventas: '+cantidad_v"></h6>

                    <h6 v-text="'Total Ventas: $'+ total_venta"></h6>
                  </div>
                  <div class="d-flex justify-content-between mb-2">
                    <h5></h5>
                    <h6 class="teal-text" v-text="'Rentabilidad total: + $'+ renta_bld"></h6>
                    <h5></h5>
                  </div>
                </div>
              </div>
              <div id="vents_f" class="col px-md-5">
                <div class="p-3 border">
                  <!-- Card -->
                  <div class="card weather-card">
                    <!-- cargando  -->

                    <!-- end cargando  -->

                    <!-- Card content -->
                    <div id="contenido" class="card-body pb-3" style="	height:640px">
                      <section v-if="cargando">
                        <div class="container">
                          <div id="preloader_1">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                          </div>
                        </div>
                      </section>
                      <section v-else>
                        <!-- Title -->
                        <div class="d-flex justify-content-between animated fadeIn">
                          <h4 class="card-title font-weight-bold">Factura</h4>
                          <!-- Text -->
                          <p class="card-text" v-text=" 'Fecha :'+fechaVenta"></p>
                        </div>

                        <div class="d-flex justify-content-between animated fadeIn">
                          <p class="display-4" v-text="'N° '+numeroComprobante"></p>

                          <div class="chip chip-md"></div>
                          <div class="chip chip-md">
                            <img src="img/user_venta.png" alt="Contact Person" />
                            <h6 v-text="nombreUserVenta"></h6>
                          </div>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                          <label>
                            Rentabilidad total :
                            <h6 class="teal-text" v-text="'+' +rent_2.toLocaleString('de-DE')"></h6>
                          </label>

                          <p></p>
                          <p></p>
                          <p></p>
                          <p></p>
                          <p></p>
                          <p></p>
                          <p></p>
                        </div>
                        <!--Card image-->
                        <!-- Table with panel -->
                        <div class="card card-cascade narrower">
                          <!--Card image-->
                          <div
                            class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center"
                          >
                            <div>
                              <a href class="white-text mx-3"></a>
                            </div>

                            <a href class="white-text mx-4">Contenido Venta</a>
                          </div>
                          <!--/Card image-->

                          <div class="px-4">
                            <div class="table-wrapper">
                              <!--Table-->
                              <div class="table-wrapper-scroll-y my-custom-scrollbar3">
                                <section v-if="detalles.length === 0">
                                  <img
                                    src="img\comprasx.png"
                                    class="rounded mx-auto d-block animated fadeIn"
                                    alt
                                  />
                                </section>
                                <section v-else>
                                  <table class="table table-hover mb-0">
                                    <!--Table head-->
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Articulo</th>
                                        <th>cantidad</th>
                                        <th>Valor unitario</th>
                                        <th>Valor Total</th>
                                        <th>Rentabilidad</th>
                                      </tr>
                                    </thead>
                                    <!--Table head-->

                                    <!--Table body-->
                                    <tbody>
                                      <tr
                                        class="animated fadeIn"
                                        v-for="(item,index) in detalles"
                                        :key="item.id"
                                      >
                                        <td v-text="index +1"></td>
                                        <td v-text="item.nombre"></td>
                                        <td v-text="item.cantidad"></td>
                                        <td v-text="item.precio_venta.toLocaleString('de-DE')"></td>
                                        <td
                                          v-text="(item.precio_venta * item.cantidad).toLocaleString('de-DE')"
                                        ></td>
                                        <td
                                          class="teal-text"
                                          v-text="'+ '+item.rentabilidad.toLocaleString('de-DE')"
                                        ></td>
                                      </tr>
                                    </tbody>
                                    <!--Table body-->
                                  </table>
                                </section>
                              </div>
                              <!--Table-->
                              <div class="d-flex justify-content-between mb-4">
                                <h6 v-text="'cantidad articulos vendidos: '+cant_v"></h6>
                                <p>
                                  <img src="img/venta_detalle.png" alt />
                                </p>

                                <h6 v-text="'Total Venta: $'+Total_pagar_detalle"></h6>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Table with panel -->
                      </section>
                    </div>
                  </div>
                  <!-- Card -->
                </div>
              </div>
            </div>
          </nav>
        </div>
      </div>
      <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div
      class="modal fade"
      id="modalNuevo"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="p-3 border">
            <!-- Card -->
            <div class="card weather-card">
              <!-- cargando  -->

              <!-- end cargando  -->

              <!-- Card content -->
              <div id="contenido" class="card-body pb-3" style="	height:640px">
                <section v-if="cargando">
                  <div class="container">
                    <div id="preloader_1">
                      <span></span>
                      <span></span>
                      <span></span>
                      <span></span>
                      <span></span>
                    </div>
                  </div>
                </section>
                <section v-else>
                  <!-- Title -->
                  <div class="d-flex justify-content-between animated fadeIn">
                    <h4 class="card-title font-weight-bold">Factura</h4>
                    <!-- Text -->
                    <p class="card-text" v-text=" 'Fecha :'+fechaVenta"></p>
                  </div>

                  <div class="d-flex justify-content-between animated fadeIn">
                    <p class="display-4" v-text="'N° '+numeroComprobante"></p>

                    <div class="chip chip-md"></div>
                    <div class="chip chip-md">
                      <img src="img/user_venta.png" alt="Contact Person" />
                      <h6 v-text="nombreUserVenta"></h6>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between mb-2">
                    <label>
                      Rentabilidad total :
                      <h6 class="teal-text" v-text="'+' +rent_2.toLocaleString('de-DE')"></h6>
                    </label>

                    <p></p>
                    <p></p>
                    <p></p>
                    <p></p>
                    <p></p>
                    <p></p>
                    <p></p>
                  </div>
                  <!--Card image-->
                  <!-- Table with panel -->
                  <div class="card card-cascade narrower">
                    <!--Card image-->
                    <div
                      class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center"
                    >
                      <div>
                        <a href class="white-text mx-3"></a>
                      </div>

                      <a href class="white-text mx-4">Contenido Venta</a>
                    </div>
                    <!--/Card image-->

                    <div class="px-4">
                      <div class="table-wrapper">
                        <!--Table-->
                        <div class="table-wrapper-scroll-y my-custom-scrollbar3">
                          <section v-if="detalles.length === 0">
                            <img
                              src="img\comprasx.png"
                              class="rounded mx-auto d-block animated fadeIn"
                              alt
                            />
                          </section>
                          <section v-else>
                            <table class="table table-hover mb-0">
                              <!--Table head-->
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Articulo</th>
                                  <th>cantidad</th>
                                  <th>Valor unitario</th>
                                  <th>Valor Total</th>
                                  <th>Rentabilidad</th>
                                </tr>
                              </thead>
                              <!--Table head-->

                              <!--Table body-->
                              <tbody>
                                <tr
                                  class="animated fadeIn"
                                  v-for="(item,index) in detalles"
                                  :key="item.id"
                                >
                                  <td v-text="index +1"></td>
                                  <td v-text="item.nombre"></td>
                                  <td v-text="item.cantidad"></td>
                                  <td v-text="item.precio_venta.toLocaleString('de-DE')"></td>
                                  <td
                                    v-text="(item.precio_venta * item.cantidad).toLocaleString('de-DE')"
                                  ></td>
                                  <td
                                    class="teal-text"
                                    v-text="'+ '+item.rentabilidad.toLocaleString('de-DE')"
                                  ></td>
                                </tr>
                              </tbody>
                              <!--Table body-->
                            </table>
                          </section>
                        </div>
                        <!--Table-->
                        <div class="d-flex justify-content-between mb-4">
                          <h6 v-text="'cantidad articulos vendidos: '+cant_v"></h6>
                          <p>
                            <img src="img/venta_detalle.png" alt />
                          </p>

                          <h6 v-text="'Total Venta: $'+Total_pagar_detalle"></h6>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Table with panel -->
                </section>
              </div>
            </div>
            <!-- Card -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->

    <!-- /.modal-content -->

    <!-- /.modal-dialog -->

    <!-- Fin del modal Eliminar -->
  </main>
</template>

<script>
import { ToggleButton } from "vue-js-toggle-button";
import Multiselect from "vue-multiselect";
import Echo from "laravel-echo";
import { EventEmitter } from "events";
import { es } from "vuejs-datepicker/dist/locale";
import { Carousel, Slide } from "vue-carousel";
import Datepicker from "vuejs-datepicker";
window.Pusher = require("pusher-js");

// register globally
Vue.component("multiselect", Multiselect);
Vue.component("ToggleButton", ToggleButton);

export default {
  // OR register locally
  components: { Multiselect, Datepicker, ToggleButton, Carousel, Slide },
  data() {
    return {
      cambio2: "",
      es: es,
      value: null,
      options: [
        {
          id: 2,
          nombre: "COCA-COLA"
        },
        {
          id: 11,
          nombre: "alqueria"
        },
        {
          id: 28,
          nombre: "duvan felipe narvaez"
        },
        {
          id: 30,
          nombre: "PEPE"
        },
        {
          id: 31,
          nombre: "Chamorro"
        },
        {
          id: 32,
          nombre: "La Gordita Estiven"
        }
      ],
      ventas: [],
      cargando: false,
      cargando_2: true,
      numeroComprobante: 0,
      fechaVenta: "",
      Total_pagar_detalle: "",
      nombreUserVenta: "",
      // datos de consulta detallada
      detalles: [],
      venta_detalle: "",
      total_venta: "",
      ver: true,
      form: {
        date2: ""
      },
      fecha_consul: "",
      cantidad_v: 0,
      tr_table: "",
      cant_v: 0,
      renta_bld: 0,
      rent_2: 0
    };
  },
  methods: {
    modal_() {
      var x = document.getElementById("modalNuevo");
      x.modal("show");
    },
    filtrar_mes() {
      this.cargando_2 = true;
      let meventa = this;
      if (this.fecha_consul == "") {
        alert("complete los datos");
        this.cargando_2 = false;
      } else {
        axios
          .post("/api/get_Venta_mes", {
            fecha: this.fecha_consul
          })
          .then(function(response) {
            if (response.data == 404) {
              alert("no existe esta factura en esta fecha");
            } else {
              meventa.ventas = response.data;
              console.log(response.data);
            }
          })
          .catch(function(error) {
            // handle error
            console.log(error);
          })

          .then(function() {})
          //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
          //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
          .finally(() => (this.cargando_2 = false));

        /*  this.ventas =  this.ventas.filter(function(venta){
         return venta.num_comprobante == 1004;
      });*/
      }
    },
    filtrar_fecha() {
      this.cargando_2 = true;
      let meventa = this;
      if (this.form.date2 == "") {
        alert("complete los datos");
        this.cargando_2 = false;
      } else {
        axios
          .post("/api/get_Venta_fecha", {
            fecha: this.form.date2
          })
          .then(function(response) {
            if (response.data == 404) {
              alert("no existe esta factura en esta fecha");
            } else {
              meventa.ventas = response.data;
              console.log(response.data);
            }
          })
          .catch(function(error) {
            // handle error
            console.log(error);
          })

          .then(function() {})
          //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
          //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
          .finally(() => (this.cargando_2 = false));

        /*  this.ventas =  this.ventas.filter(function(venta){
         return venta.num_comprobante == 1004;
      });*/
      }
    },

    filtrar() {
      this.cargando_2 = true;
      let meventa = this;
      axios
        .post("/api/get_Venta_", {
          num_comp: this.venta_detalle
        })
        .then(function(response) {
          if (response.data == 404) {
            alert("no existe esta factura");
          } else {
            meventa.ventas = response.data;
            // console.log(response.data);
          }
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.cargando_2 = false));

      /*  this.ventas =  this.ventas.filter(function(venta){
         return venta.num_comprobante == 1004;
      });*/
    },

    informacion(item) {
      this.numeroComprobante = item.num_comprobante;
      this.fechaVenta = item.created_at;
      this.Total_pagar_detalle = item.total_venta.toLocaleString("de-DE");
      this.nombreUserVenta = item.name;
      this.tr_table = item.id;
      this.rent_2 = item.rentabilidad.toLocaleString("de-DE");

      var tr = document.getElementById("" + item.id + "");
      tr.classList.add("table-warning");
      var x = document.getElementById("" + item.num_comprobante + "");
      x.classList.add("active");
    },

    getVentas_x() {
      let meventas = this;
      this.cargando_2 = true;

      axios
        .post("/api/get_Ventas", {
          ver: this.ver
        })
        .then(function(response) {
          meventas.ventas = response.data;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.cargando_2 = false));
    },
    getDetalle_ventas(numComp) {
      let me_detalles = this;
      axios
        .post("/api/get_Ventas_detalle", {
          num_comprobante: numComp
        })
        .then(function(response) {
          me_detalles.detalles = response.data;
          console.log(response.data);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.cargando_2 = false));
    }
  },

  mounted() {
    this.getVentas_x();
    window.Echo = new Echo({
      broadcaster: "pusher",
      key: "ASDASD2121",
      wsHost: window.location.hostname,
      wsPort: 6001,
      disableStats: true,
      enabledTransports: ["ws", "wss"]
    });
    window.Echo.channel("channel-notif").listen("NotificacionEvent", e => {
      console.log(e.mensaje);
      this.getVentas_x();
    });
  },
  watch: {
    numeroComprobante: function(newVal, oldVal) {
      this.getDetalle_ventas(newVal);
      if (oldVal > 0) {
        var x = document.getElementById("" + oldVal + "");
        if (x == null) {
        } else {
          x.classList.remove("active");
        }
      }
    },

    venta_detalle: function(val) {
      if (val == "") {
        this.getVentas_x();
      }
    },
    fecha_consul: function(Val) {
      if (Val == "") {
        this.getVentas_x();
      }
    },

    ventas: function(val) {
      let total_venta = 0;
      let rent = 0;

      val.forEach(element => {
        total_venta += element.total_venta;
        rent += element.rentabilidad;
      });
      let contar = val.length;
      this.total_venta = Number(total_venta).toLocaleString("de-DE");
      this.cantidad_v = contar;
      this.renta_bld = rent.toLocaleString("de-DE");
      console.log(rent);
    },
    ver: function(val) {
      this.getVentas_x();
    },
    tr_table: function(newVal, oldVal) {
      if (oldVal > 0) {
        try {
          var x = document.getElementById("" + oldVal + "");
          console.log();
          if (x == null) {
          } else {
            x.classList.remove("table-warning");
          }
        } catch (error) {}
      }
    },
    detalles: function(Val) {
      let cant = 0;
      Val.forEach(element => {
        cant += element.cantidad;
      });
      console.log(cant);
      this.cant_v = cant;
    }
  }
};
</script>

<!-- New step!
     Add Multiselect CSS. Can be added as a static asset or inside a component. -->
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
</style>



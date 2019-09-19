<template>
  <div class="container-fluid">
    <div id="card_esc" class="row animated fadeIn">
      <div class="col-sm-6">
        <v-card class="mx-auto" :height="300">
            <v-card-title></v-card-title>
          <v-card-text :height="200">

              <div class="d-flex justify-content-between mb-4">
                <h6></h6>

                <label for>
                  <h4>Ventas de hoy</h4>
                  <v-progress-circular
                    :rotate="-90"
                    :size="120"
                    :width="15"
                    :value="dat_p"
                    color="#1A237E"
                  >
                    <h4>{{ dat_p }}%</h4>
                  </v-progress-circular>
                  <h6>Avance  %</h6>
                </label>

                <h6></h6>
              </div>
               <div  class="d-flex justify-content-around mb-4">
                <Label style="bottom:30px;" id="">
                  <h6 id="text_e" class="text-muted">Base inicial</h6>
                  <h5 id="text_e2" v-text="'$'+base_ini.toLocaleString()"></h5>
                </Label>
                <label id="">
                  <h6 id="text_e" class="text-muted">Base actual</h6>
                  <h5 id="text_e2" class="teal-text" v-text=" '+$'+base_end.toLocaleString()"></h5>
                </label>
              </div>
          </v-card-text>
          <v-card-actions></v-card-actions>
        </v-card>

        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <v-card class="mx-auto" :height="240">
                <div
                  class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center"
                >
                  <div>
                    <a href class="white-text mx-3"></a>
                  </div>

                  <h5 href class="white-text mx-4">Ventas</h5>
                </div>

                <v-card-text>
                  <div class="d-flex justify-content-between mb-4">
                    <h6>
                      <a v-text="'total generado :'"></a>
                      <a class="teal-text" v-text="'+$'+datos_today.ventas"></a>
                    </h6>
                    <h6>
                      <a v-text="'Cand. articulos :'"></a>
                      <a v-text="datos_today.cantidad_v"></a>
                    </h6>

                    <h6></h6>
                  </div>
                  <div class="d-flex justify-content-between mb-4">
                    <h6>
                      <a v-text="'Rentabilidad:'"></a>
                      <a class="teal-text" v-text=" '+$'+datos_today.renta_d"></a>
                    </h6>
                    <v-progress-circular
                      :rotate="-90"
                      :size="80"
                      :width="10"
                      :value="porc_t"
                      color="#1A237E"
                    >
                      <h6>{{ porc_t }}%</h6>
                    </v-progress-circular>
                    <h5></h5>
                  </div>
                </v-card-text>
              </v-card>
            </div>
            <div class="col-sm-6 mb-3 mb-md-0">
              <v-card class="mx-auto" :height="240">
                <div
                  class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center"
                >
                  <div>
                    <a href class="white-text mx-3"></a>
                  </div>

                  <h5 href class="white-text mx-4">Compras</h5>
                </div>

                <v-card-text>
                  <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                      <h6>
                        <a v-text="'total generado: '"></a>
                        <a class="text-danger" v-text="'$'+datos_today.compras"></a>
                      </h6>
                      <h6></h6>
                      <h6>
                        <a v-text="'Cand. articulos'"></a>
                        <a style="color:#232323;" v-text="datos_today.cantidad_c"></a>
                      </h6>
                      <h6></h6>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                      <h6 class="card-title" v-text="'total generado : $'+datos_today.compras"></h6>
                      <h6></h6>
                    </div>
                  </div>
                </v-card-text>
              </v-card>
            </div>
          </div>
        </div>

        <!-- datos para el carousel -->

        <div class>
          <v-card class="mx-auto">
            <v-card-text>
              <v-card-title id="text_pr" class="blue darken-4">
                <h5 style="color:#FFFFFF">Articulos con prioridad</h5>
              </v-card-title>
              <div class="d-flex justify-content-between mb-4">
                <h4></h4>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                  <v-text-field v-model="dato_sh" label="buscar articulo etc"></v-text-field>
                </div>
                <h4></h4>
                <h4></h4>
              </div>

              <carousel
                :perPageCustom="[[768, 3]]"
                :perPage="1"
                :minSwipeDistance="2"
                :touchDrag="true"
                :autoplay="true"
                :centerMode="true"
                :scrollPerPage="true"
              >
                <slide class="card-body" v-for="art in articulosPre" :key="art.id">
                  <v-card class="mx-auto" :min-width="210" :height="180">
                    <v-card-text>
                      <h6 class="card-title">Articulo</h6>
                      <h5 class="text-muted" v-text="art.nombre"></h5>
                      <h5 class="card-title" v-text="' stock :'+art.stock"></h5>
                      <section v-if="art.estado_articulo == 'Estable'">
                        <span class="d-flex justify-content-between mb-4">
                          <h5 class="card-title">Estable</h5>
                          <img id="img_e" src="img\activo.png" />
                          <h1>
                            <h1></h1>
                          </h1>
                        </span>
                      </section>
                      <section v-if="art.estado_articulo == 'Bajo'">
                        <span class="d-flex justify-content-between mb-4">
                          <h5 class="card-title">Bajo</h5>
                          <img id="img_e" src="img\alerta_.png" />
                          <h1></h1>
                        </span>
                      </section>
                    </v-card-text>
                  </v-card>
                </slide>
              </carousel>
            </v-card-text>
          </v-card>
        </div>
      </div>

      <div class="col-sm-6 mb-3 mb-md-0">
        <h1></h1>

        <v-card class="mx-auto scroll">
            <v-card-title>Rotación de articulos</v-card-title>
            <graficos2></graficos2>

        </v-card>

        <h1></h1>

        <h5 class="card-title">Graficos estadisticos</h5>
        <graficos></graficos>
      </div>
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
      data-backdrop="static"
      data-keyboard="false"
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Ingresar Base del dia</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Valor total de la base</label>
                <div class="col-md-9">
                  <input
                    type="number"
                    id="nombre"
                    class="form-control"
                    v-model="base_d"
                    placeholder="0"
                  />
                  <span class="help-block">(*) ingrese valor</span>
                </div>
              </div>
            </form>
            <h3 id="base_text" color="#2F4AAF" class="card-title">{{'$'+result}}</h3>
          </div>
          <div class="modal-footer align-items-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button
              type="button"
              class="btn btn-primary"
              data-dismiss="modal"
              v-on:click="save_base"
            >Guardar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" id="save" tabindex="-1" role="dialog" style="display: none;">
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <h4>Se ha guardado correctamente</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
</template>

<script>
import Echo from "laravel-echo";
import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import colors from "vuetify/lib/util/colors";


Vue.use(Vuetify);
import { EventEmitter } from "events";
import { Carousel, Slide } from "vue-carousel";
import { filter } from "minimatch";
import { parse } from "path";
window.Pusher = require("pusher-js");
export default {
  components: { Carousel, Slide, Vuetify },
  data() {
    return {
      allbusqueda: [],
      busqueda: [],
      encontrado: false,
      cargando_3: true,
      total_compra: "",
      total_venta: "",
      datos_today: [],
      array_art: [],

      articulos: [],
      articulosPre: [],
      articulosSin: [],
      btn_f_: false,
      base_d: "",
      base_ini: 0,
      base_end: 0,
      aument_: 0,
      teal: "c100",
      dat: "",
      dat_p: 0,
      value: 23,
      dato_sh: "",
      porc_t: 0
    };
  },

  methods: {
    removeItemFromArr(arr, item) {
      return arr.filter(function(e) {
        return e !== item;
      });
    },
    addArticulo() {
      let meconsulta = this;
      let newarray = this;
      axios
        .post("api/articulo")
        .then(function(response) {
          meconsulta.consulta = response.data;
          for (let index = 0; index < meconsulta.consulta.length; index++) {
            if (meconsulta.consulta[index].items_null_c == null) {
              console.log("entro");
              meconsulta.articulosPre[index] = meconsulta.consulta[index];
            } else {
              meconsulta.articulosSin = meconsulta.consulta[index].items_null_c;
            }
          }
          console.log(meconsulta.articulosPre);
          var marvelHeroes = meconsulta.articulosPre.filter(function(hero) {
            return hero.estado_articulo == "Agotado";
          });

          meconsulta.articulos = marvelHeroes;

          //console.log(meconsulta.consulta[6].items_null_c);
        })
        .catch(error => {
          this.error = error.response;
          $("#error").modal("show", { backdrop: "static", keyboard: false });
        });
    },
    cambiar: function() {},
    totales_today() {
      let med = this;
      axios
        .post("api/datos_ventas_compras")
        .then(function(response) {
          let dat = 0;
          let rent = 0;
          let vent = 0;
          let total_ = 0;

          // console.log(response.data);
          med.datos_today = response.data;

          rent = parseInt(response.data.renta_d);
          vent = parseInt(response.data.ventas);

          total_ = (rent * 100) / vent;
          med.porc_t = Math.round(total_);
        })
        .catch(function(error) {
          // handle error
          // console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.tabla = true));
    },
    base_() {
      let med = this;
      axios
        .post("api/base_dia")
        .then(function(response) {
          console.log(response.data);
          if (response.data == 501) {
            $("#modalNuevo").modal("show");
          } else {
            med.base_ini = response.data.base_.base;
            med.base_end = response.data.base_.base_final;
          }
        })
        .catch(function(error) {
          // handle error
          // console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.tabla = true));
    },
    save_base() {
      let me = this;

      axios
        .post("api/save_base_dia", {
          base: this.base_d
        })
        .then(function(response) {
          console.log(response.data);
          if (response.data.exit == 201) {
            me.base_ini = response.data.base_.base;
            me.base_end = response.data.base_.base_final;
            $("#save").modal("show");
          }
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
  computed: {
    result: function() {
      let n = 0;
      n = this.base_d;
      return n === "" ? n : Number(n).toLocaleString();
    }
  },

  mounted() {
    this.base_();
    this.addArticulo();
    this.totales_today();

    window.Echo = new Echo({
      broadcaster: "pusher",
      key: "ASDASD2121",
      wsHost: window.location.hostname,
      wsPort: 6001,
      disableStats: true
    });
    window.Echo.channel("channel-notif").listen("NotificacionEvent", e => {
      console.log(e.mensaje);
      this.addArticulo();
      this.totales_today();
      this.base_();
    });

    console.log("Component mounted.");
  },

  watch: {
    validar2: function(Val) {},
    base_end: function(Val) {
      let result = 0;
      let rest = 0;
      let prtj = 0;
      let total_p = 0;

      let base_i = this.base_ini;
      rest = Val - base_i;
      prtj = rest / base_i;
      total_p = prtj * 100;
      let total_r = Math.round(total_p);
      this.dat = "p" + total_r;
      this.dat_p = total_r;

      console.log(total_r);
    }
  }
};
</script>

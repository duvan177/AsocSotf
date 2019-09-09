<template>

 <div class="container-fluid">
  <div id="card_esc" class="row animated fadeIn">

    <div class="col-sm-6">
        <div  class="card">
               <div class="card-body">


    <div class="d-flex justify-content-between mb-4">
          <Label> <h6 >Base del Dia</h6> <h4 class="teal-text" v-text="'$'+base_d_.toLocaleString()"></h4></Label>
            <label for=""> base</label>
            <label > Estado</label>
    </div>


    </div>


</div>
      <div id="card_escritorio1" class="card">
        <div class="card-body">
          <img id="fondo_naranja" src="img/fondo_verde.png" class="card-img-top" alt />
          <img id="fondo_compras" src="img/compras_escritorio.png" class="card-img" alt />
          <div class="card-body">
            <h6 id="titulo_escritorio" class="card-title">Compras</h6>

            <div id="datos_escritorio" class="d-flex justify-content-between mb-4">
              <h6>
                <a v-text="'total generado: '"></a>
                <a class="text-danger" v-text="datos_today.compras"></a>
              </h6>
              <h6>
                <a v-text="'Cand. articulos'"></a>
                <a v-text="datos_today.cantidad_c"></a>
              </h6>
              <h6></h6>
            </div>
            <div id="datos_escritorio" class="d-flex justify-content-between mb-4">
              <h6 class="card-title" v-text="'total generado : $'+datos_today.compras"></h6>
              <h6></h6>
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
            <div id="datos_escritorio" class="d-flex justify-content-between mb-4">
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
            <div id="datos_escritorio" class="d-flex justify-content-between mb-4">
              <h6>
                <a v-text="'Rentabilidad:'"></a>
                <a class="teal-text" v-text=" '+$'+datos_today.renta_d"></a>
              </h6>
            </div>
          </div>
        </div>
      </div>

      <!-- datos para el carousel -->
        <div class="d-flex justify-content-between mb-4">
            <h4></h4>
             <div class="col-md-4">

      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>Estable</option>
        <option>Bajo</option>
        <option>Agotado</option>
        <option>inactivo</option>

      </select>
      </div>
          <div class="col-md-4">

      <input type="text" class="form-control" id="inputPassword" placeholder="buscar">

          </div>
          <h4></h4><h4></h4>
    </div>

      <carousel  :touchDrag="true" :autoplay="true" :centerMode="true" :scrollPerPage="true">

        <slide  v-for="art in articulosPre" :key="art.id">
          <h6 class="card-title"> Articulo</h6>
          <h5  class="text-muted" v-text="art.nombre"></h5>
          <h5 class="card-title" v-text="' stock :'+art.stock"></h5>
          <section v-if="art.estado_articulo == 'Activo'">
            <span class="d-flex justify-content-between mb-4">
              <h5 class="card-title">Estable</h5>
              <img id="img_e" src="img\activo.png" />
              <h1>
                <h1></h1>
              </h1>
            </span>
          </section>
          <section v-if="art.estado_articulo == 'Agotado'">
           <span class="d-flex justify-content-between mb-4">
              <h5 class="card-title">Bajo</h5>
              <img id="img_e" src="img\alerta_.png" />
              <h1>
              </h1>
            </span>
          </section>
        </slide>
      </carousel>

      <!-- fin -->
    </div>

    <div class="col-sm-6 mb-3 mb-md-0">
      <div class="d-flex justify-content-between mb-4">
        <h1></h1>
        <graficos2></graficos2>
        <graficos2></graficos2>
        <h1></h1>
      </div>
      <h5 class="card-title">Graficos estadisticos</h5>
      <graficos></graficos>

    </div>


  </div>
    <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Ingresar Base del dia</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Valor total de la base</label>
                                    <div class="col-md-9">
                                        <input type="number" id="nombre"  class="form-control" v-model="base_d" placeholder="">
                                        <span class="help-block">(*) ingrese valor</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer align-items-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button"  class="btn btn-primary" data-dismiss="modal" v-on:click="save_base">Guardar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
              <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" id="save" tabindex="-1" role="dialog"  style="display: none;" >
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
import { EventEmitter } from "events";
import { Carousel, Slide } from "vue-carousel";
import { filter } from "minimatch";
window.Pusher = require("pusher-js");
export default {
  components: { Carousel, Slide },
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
      base_d:0,
      base_d_:0
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
          $("#error").modal("show",{backdrop: 'static', keyboard: false});
        });
    },
    cambiar: function() {},
    totales_today() {
      let med = this;
      axios
        .post("api/datos_ventas_compras")
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
    },
       base_() {
      let med = this;
      axios
        .post("api/base_dia")
        .then(function(response) {
          console.log(response.data);
          if (response.data == 501) {
                $("#modalNuevo").modal("show");
          }
          else{
              med.base_d_ = response.data.base_.base
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
        .post("api/save_base_dia",{
            base:this.base_d
        })
        .then(function(response) {
          console.log(response.data);
          if (response.data.exit == 201) {
                me.base_d_ = response.data.base_.base
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
  computed: {},

  mounted() {
     this.base_()
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
    validar2: function(Val) {}
  }
};
</script>

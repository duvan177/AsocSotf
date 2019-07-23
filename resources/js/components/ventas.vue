<template>
  <main class="main">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header"> </div>
        <div class="card-body">
          <div class="container-fluid">
            <!--Formularios de venta -->
            <form>
              <!-- setcion del loading-->

              <section v-if="loading">
                <div class="container-fluid">
                  <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">
                      <div class="container-fluid">
                        <div class="lds-ring">
                          <div></div>
                          <div></div>
                          <div></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <!-- fin del loading-->
              <section v-else>
                <!-- alerta 

              <section v-if="alerta">
                <div id="alerta" class="alert alert-danger" role="alert">
                  <i class="icon-info"></i>
                  Articulo no encontado o no disponible en el inventario.
                  <button
                    type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close"
                    v-on:click="alerta = false"
                  >
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              </section>

                fin la section alerta-->

                <!-- fin del toast-->

                <div class="form-row">
                  <label>
                    <h5>Fecha</h5>
                  </label>
                  <div class="form-group col-md-2">
                    <input
                      class="form-control"
                      style="height:50"
                      id="fecha"
                      type="tex"
                      v-model="fecha"
                      readonly
                    />
                  </div>
                  <!-- numero de factura--->
                  <label>
                    <h5>Numero Factura</h5>
                  </label>
                  <div class="form-group col-md-2">
                    <input
                      class="form-control"
                      style="height:50"
                      id="fecha"
                      type="tex"
                      v-model="num"
                      readonly
                    />
                  </div>
                </div>
                <!--fin de numero de factua-->
                <div class="form-row">
                  <div class="form-group col-md-2">
                    <input
                      type="number"
                      class="form-control"
                      placeholder="Codigo del producto"
                      id="codProducto"
                      v-model="producto"
                      required
                    />
                  </div>
                  <div class="form-group col-md-2">
                    <input
                      type="number"
                      class="form-control"
                      placeholder="cantidad"
                      id="cantidad"
                      v-on:keyup.enter="addArticulo"
                      v-model="cantidad"
                      required
                    />
                  </div>
                  <div class="form-group col-md-2" style="left:95x; width:100px; top:11px;">
                    <button type="button" class="btn btn-warning" v-on:click="addArticulo">
                      <i class="icon-basket-loaded"></i> Añadir
                    </button>
                  </div>
                </div>

                <!--inicio de tabla de los productos selecionados -->
                <div class="table-responsive">
                  <table class="table table table-striped">
                    <caption>Lista de productos</caption>
                    <thead>
                      <tr>
<<<<<<< HEAD
                        <th scope="col">#</th>
=======
                         <th scope="col">#</th>
>>>>>>> 387bb04d94e189693236657733b778e14d741e40
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio unitario</th>
                        <th scope="col">valor total</th>
                        <th scope="col">Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(datos, index) in consulta" :key="datos.id">
                        <th v-text="index + 1"></th>
                        <td v-text="datos.datos.nombre"></td>
                        <td v-text="datos.cantidad"></td>
                        <td v-text="datos.datos.precio_venta"></td>
                        <td v-text="datos.totalPagar"></td>
                        <td>
                          <button
                            type="button"
                            class="button button-success"
                            v-on:click="remove(index)"
                          >
                            <i class="icon-close"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <!-- fin de los productos selecionados -->

                <div class="form-row">
                  <div>
                    <label>% Descuento</label>
                  </div>

                  <div class="form-group col-md-2" style="left:100x; top:10px; width:100px;">
                    <input
                      type="number"
                      class="form-control"
                      placeholder="%00.0"
                      v-model="descuento"
                    />
                  </div>
<<<<<<< HEAD
                  <div class="form-group col-md-2" style="left:95x; width:120px; top:18px;">
                    <button type="button" class="btn btn-info" v-on:click="evento">Aplicar</button>
                  </div>
=======
                   <div class="form-group col-md-2" style="left:90x; width:120px; top:18px;">
                      <button type="button" class="btn btn-info" v-on:click="evento">Aplicar</button>
                    </div>
>>>>>>> 387bb04d94e189693236657733b778e14d741e40

                  <div class="form-group col-md-3">
                    <div id="tot" class="card border-info mb-4" style="max-width: 25rem;">
                      <div class="card-header">descuento</div>
                      <div class="card-body text-info">
                        <h5>{{descuentoTotal}}</h5>
                      </div>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <div id="tot" class="card border-info mb-4 mov" style="max-width: 25rem;">
                      <div id="tit" class="card-header">Total Pagar con descuento</div>
                      <div class="card-body text-info">
                        <h5>{{TPD}}</h5>
                      </div>
                    </div>
                    <div id="efec" class="card border-info mb-4 -el" style="max-width: 25rem;">
                      <div id="tit" class="card-header">Total Pagar</div>
                      <div class="card-body text-info">
                        <h5>{{result}}</h5>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="tras" class="form-row">
                  <div class="card border-info mb-4" style="max-width: 25rem;">
                    <div id="tit" class="card-header">relleno XD</div>
                    <div class="card-body text-info"></div>
                  </div>
                </div>

                <button type="button" class="btn btn-success" v-on:click="launch_toast">Finalizar</button>

                <div id="toast">
                  <div id="img">
                    <i class="icon-check"></i>
                  </div>
                  <div id="desc">Finalizado con exito...</div>
                </div>
                <div id="toast2">
                  <div id="img">
                    <i class="icon-info"></i>
                  </div>
                  <div id="desc">Producto no disponible...</div>
                </div>
              </section>
            </form>

            <!-- fin del formulario de venta-->
          </div>
        </div>
      </div>
    </div>
  </main>
</template>




<script >
import { parse } from "path";
export default {
  data() {
    return {
      totalPD: "",
      totalPagarDes: "",
      totalpagarDesT: "",
      totalpagar: [],
      producto: "",
      cantidad: "",
      consulta: [],
      consultaFact: false,
      loading: true,
      alerta: false,
      num: [],
      fecha: "",
      descuento: ""
    };
  },

  //FUNCION DONDE CARGAR LOS METOS UTLIZADOS PARA ESTE COMPONENTE
  methods: {
    evento() {
      /*
      let elemento = document.getElementsByClassName(
        "card border-info mb-4 mov"
      );
      anime({
        targets: elemento,
        translateY: 130,
        direction: "normal",
        duration: 1000
      });*/
    },

    remove(index) {
      // this.todos.splice(index, 1)
      this.$delete(this.consulta, index);
    },
    addArticulo() {
      //var insert = { producto: this.producto, cantidad: this.cantidad };
      // this.insertDatos.push(insert);
      //console.log(this.insertDatos);

      // TRAIGO LOS DATOS DE MI DATA PARA ASOCIARLOS LOCALMENTE Y DAR USO DE ELLOS PARA MANDAR PARAMETROS ETC

      let meconsulta = this;
      let cantidad = this.cantidad;
      let producto = this.producto;
      let that = this;
      let that2 = this;

      if (cantidad == "" || producto == "") {
        alert("completar los datos");
      } else {
        axios
          .post("/api/ver", {
            id: this.producto,
            cantidad: this.cantidad
          })
          .then(function(response) {
            if (response.data == 404 || response.data == 1005) {
              //alert(response.data + " El producto no se encuentra disponible");
              that.alerta = true;
              function toastAlert() {
                var x = document.getElementById("toast2");
                x.className = "show";
                setTimeout(function() {
                  x.className = x.className.replace("show", "");
                }, 3000);
              }
              toastAlert();
            } else {
              var array_articulo = response.data;
              meconsulta.consulta.push(array_articulo);
              that.alerta = false;
            }
          })
          .catch(function(error) {
            // handle error
            console.log(error);
          })
          .then(function() {
            // always executed
          });
        //AL FINAL DE LA PETICION Y CARGAR LA TABLA ME DEJARA EN LIMPIO LOS CAMPOS PARA NUEVOS DATOS

        this.producto = "";
        this.cantidad = "";
      }
    },

    launch_toast() {
      var x = document.getElementById("toast");
      x.className = "show";
      setTimeout(function() {
        x.className = x.className.replace("show", "");
      }, 3000);
    },

    getFecha() {
      let fecha = this;
      axios
        .post("/api/fecha")
        .then(function(response) {
          fecha.fecha = response.data;
          console.log(datos);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .then(function() {
          // always executed
        });
    },

    numero_factura() {
      let num = this;

      axios
        .post("/api/NumeroFactura")
        .then(function(response) {
          num.num = response.data;
          // console.log(numfactura);
        })
        .catch(function(error) {
          // handle error
          // console.log(error);
          num.num = " no hay facturas";
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.loading = false));
    },

    totalfinal() {}
  },

  computed: {
    validarCamp: function() {
      if (producto != "") {
        $("#codProducto").addClass("form-control is-valid");
      }
    },

    result: function() {
      let totp = this;
      let rest = 0;
      let n = 0;
      let totalP = 0;
      let nd = 0;
      let tot = 0;
      this.consulta.forEach(element => {
        n = n + element.totalPagar;
      });

      //n = String(n).replace(/\D/g, "");

      totp.totalPagarDes = n;

      return n === "" ? n : Number(n).toLocaleString();
    },
    TPD: function() {
      let metpd = this;
      let tp = 0;
      let desc = 0;
      let tpd = 0;
      let movi = false;
      let cont = 0;

      tp = this.totalPagarDes;
      desc = this.totalpagarDesT;

      tpd = tp - desc;
      metpd.totalPD = tpd;
      //n = String(n).replace(/\D/g, "");

      let elemento = document.getElementsByClassName(
        "card border-info mb-4 mov"
      );

      if (this.descuento != 0) {
        anime({
          targets: elemento,
          translateY: 130,
          direction: "normal",
          duration: 1000,
          delay: 1000
        });
        cont = 1;
      } else {
        anime({
          targets: elemento,
          translateY: [0, 0],
          direction: "normal",
          duration: 1000,
          delay: 1000
        });
      }
      return Number(tpd).toLocaleString();
    },
    descuentoTotal: function() {
      let medescuento = this;

      let d = 0;
      let descuento = 0;
      let porcentaje = 0;
      let totalpag = 0;

      totalpag = this.totalPagarDes;
      descuento = this.descuento;

      porcentaje = (descuento * totalpag) / 100;

      d = porcentaje.toFixed(2);
      d = parseFloat(d);
      medescuento.totalpagarDesT = d;

      return d === "" ? d : Number(d).toLocaleString();
    }
  },

  created() {},
  //METODOS QUE SE CARGARAN CUANDO EL COMPONENTE SEA INVOCADO. IMPORTANTE PARA ALGUNOS DATOS QUE SE NECESITEN EN LA VISTA.
  mounted() {
    this.getFecha();
    this.numero_factura();
  }
};
</script>
<style>
</style>
<template>
  <main class="main">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header"></div>
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
                      style="width:100px;"
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
                      style="width:100px"
                      id="fecha"
                      type="tex"
                      v-model="num"
                      readonly
                    />
                  </div>
                  <div class="form-group" style>
                    <label>
                      <h6>
                        Cliente
                        <img src="img\consumer.png" alt />
                      </h6>
                    </label>
                  </div>
                  <div class="input-group col-md-4" style>
                    <div class="form-group">
                      <multiselect
                        style="width:200px"
                        v-model="cliente"
                        :options="clientes"
                        :custom-label="nombresSelect"
                        :searchable="true"
                        selectLabel="add"
                        deselectLabel="quitar"
                        selectedLabel="seleccionado"
                        placeholder="Seleccione cliente"
                        noOptions="ingrese Cliente"
                      ></multiselect>
                    </div>
                    <div class="form-group" style>
                      <button type="button" class="btn btn-light">
                        <img src="img\addpersona.png" alt /> Añadir
                      </button>
                    </div>
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
                      autofocus
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
                    />
                  </div>
                  <div class="form-group" style>
                    <button type="button" class="btn btn-warning" v-on:click="addArticulo">
                      <i class="icon-basket-loaded"></i> Añadir
                    </button>
                  </div>
                  <div class="form-group col-md-4" style>
                    <button type="button" class="btn btn-info" v-on:click="prueba">
                      <img src="img/buscar.png" alt />
                    </button>
                  </div>
                </div>

                <!--inicio de tabla de los productos selecionados -->
                <div class="table-wrapper-scroll-y my-custom-scrollbar2">
                  <section v-if="consulta.length === 0">
                    <img src="img\store.png" class="rounded mx-auto d-block animated fadeIn" alt />
                  </section>
                  <section v-else>
                    <table class="table table table-striped">
                      <caption>Lista de productos</caption>
                      <thead>
                        <tr class="animated fadeIn">
                          <th scope="col">#</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Cantidad</th>
                          <th scope="col">Precio unitario</th>
                          <th scope="col">valor total</th>
                          <th scope="col">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          class="animated fadeIn"
                          v-for="(datos, index) in consulta"
                          :key="datos.id"
                        >
                          <td v-text="index + 1"></td>
                          <td v-text="datos.datos.nombre"></td>
                          <td v-text="datos.cantidad"></td>
                          <td v-text="eventoNum(datos.datos.precio_venta)"></td>
                          <td v-text="eventoNum(datos.totalPagar)"></td>
                          <td>
                            <button
                              type="button"
                              class="button button-info"
                              v-on:click="remove(index)"
                            >
                              <i class="icon-close"></i>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </section>
                </div>

                <!-- fin de los productos selecionados -->

                <div class="form-row">
                  <div>
                    <label>% Descuento</label>
                  </div>

                  <div class="form-group col-md-2" style="left:100x; top:10px; width:100px;">
                    <input
                      id="descuentox"
                      type="number"
                      class="form-control"
                      placeholder="%00.0"
                      v-bind:disabled="totalPagarDes==0"
                      v-model="descuento"
                    />

                    <section v-if="validar == true">
                      <div style="left:95x; width:120px; ">
                        <button
                          id="css2"
                          type="button"
                          class="btn btn-danger animated pulse"
                        >Validar descuento</button>
                      </div>
                    </section>
                  </div>

                  <div class="form-group col-md-3">
                    <div id="tot" class="card border-info mb-4" style="max-width: 25rem;">
                      <div class="card-header">Total Pagar</div>
                      <div class="card-body text-info">
                        <h5>{{result}}</h5>
                      </div>
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                          <div class="input-group mb-3">
                            <button type="button" class="btn btn-light form-control-lg">Recibido</button>

                            <input
                              type="number"
                              class="form-control form-control-lg"
                              v-model="recibido"
                              v-on:onkeyup="{{validarCamp}}"
                            />
                          </div>
                        </li>
                        <li class="list-group-item">
                          <div class="input-group mb-3 animated fadeInDown">
                            <button type="button" class="btn btn-light form-control-lg">Devuelto</button>

                            <input
                              type="number"
                              class="form-control form-control-lg"
                              readonly
                              v-bind:value="devuelta"
                            />
                          </div>
                        </li>
                      </ul>
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
                      <div id="tit" class="card-header">Descuento</div>
                      <div class="card-body text-info">
                        <h5>{{descuentoTotal}}</h5>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-2 col-lg-2">
                    <button
                      class="btn btn-success btn-block"
                      style="  width:240px;"
                      v-on:click="launch_toast"
                      type="button"
                    >
                      <h5>Finalizar</h5>
                    </button>
                  </div>
                  <!-- /col -->
                </div>
                <!-- /row -->

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
      recibido: 0,
      validar: false,
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
      descuento: "",
      clientes: [],
      cliente: [
        {
          id: 33,
          nombre: "Persona Natural"
        }
      ],
      idusers: this.username
    };
  },
  props: ["username"],

  //FUNCION DONDE CARGAR LOS METOS UTLIZADOS PARA ESTE COMPONENTE
  methods: {
    pruebaId() {},
    nombresSelect({ nombre }) {
      return `${nombre}`;
    },
    getProveedores2() {
      let prove = this;
      axios
        .post("/api/get_clientes")
        .then(function(response) {
          prove.clientes = response.data;
          //  console.log(datos);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .then(function() {
          // always executed
        });
    },
    eventoNum(i) {
      i = String(i).replace(/\D/g, "");

      return i === "" ? i : Number(i).toLocaleString();
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
                  x.classList.add("animated", "fadeOutDown");
                }, 3000);
                setTimeout(function() {
                  x.className = x.className.replace("show", "");
                }, 5000);

                document.getElementById("codProducto").focus();
              }
              toastAlert();
            } else {
              var array_articulo = response.data;
              meconsulta.consulta.push(array_articulo);
              that.alerta = false;
              document.getElementById("codProducto").focus();
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
          //  console.log(datos);
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
          if (response.data == 404) {
            num.num = 1000;
          } else {
            num.num = response.data + 1;
          }
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

    buscar() {
      for (let index = 0; index < 10; index++) {
        setTimeout(function() {}, 2000);

        console.log(index);
      }
    },
    validarCamp: function(num) {
      return Number(num).toLocaleString();
    },

    prueba() {
      axios
        .post("/api/insert_venta", {
          num_comp: this.num,
          total_venta: this.totalPD,
          descuento: this.totalpagarDesT,
          articulos: this.consulta,
          id_user: this.username,
          cliente: this.cliente
        })
        .then(function(response) {
          console.log(response.data);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.loading = false));
      this.numero_factura();

      this.totalPD = "";
      this.totalpagarDesT = "";
      this.consulta = [];
    }
  },

  computed: {
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

    devuelta: function() {
      let total = 0;
      let totalsub = 0;
      let recibido = 0;
      let devuelta = 0;
      let toal2 = 0;

      total = this.totalPagarDes;
      totalsub = this.totalpagarDesT;
      recibido = this.recibido;
      toal2 = total - totalsub;

      if (recibido != 0) {
        devuelta = recibido - toal2;
        return devuelta === "" ? devuelta : Number(devuelta).toLocaleString();
      } else {
        return 0;
      }
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
      if (this.descuento <= 10 && this.descuento >= 1) {
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
      let elemento = document.getElementsByClassName(
        "card border-info mb-4 mov"
      );
      let medescuento = this;

      let d = 0;
      let descuento = 0;
      let porcentaje = 0;
      let totalpag = 0;

      totalpag = this.totalPagarDes;
      descuento = this.descuento;
      if (descuento > 10) {
        this.validar = true;
        return "descuento pasa el limite autorizado";
      } else {
        porcentaje = (descuento * totalpag) / 100;

        d = porcentaje.toFixed(2);
        d = parseFloat(d);
        medescuento.totalpagarDesT = d;
        this.validar = false;
        return d === "" ? d : Number(d).toLocaleString();
      }
    }
  },

  created() {},
  //METODOS QUE SE CARGARAN CUANDO EL COMPONENTE SEA INVOCADO. IMPORTANTE PARA ALGUNOS DATOS QUE SE NECESITEN EN LA VISTA.
  mounted() {
    this.pruebaId();
    this.getFecha();
    this.numero_factura();
    this.getProveedores2();
  }
};
</script>
<style>
</style>
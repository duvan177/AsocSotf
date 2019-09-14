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
                      style="width:150px;"
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
                        placeholder="otro cliente"
                        noOptions="ingrese Cliente"
                      ></multiselect>
                    </div>

                    <div class="form-group" style>
                      <button
                        data-toggle="modal"
                        data-target="#registarCliente"
                        type="button"
                        class="btn btn-light"
                      >
                        <img src="img\addpersona.png" alt />
                      </button>
                    </div>
                  </div>
                </div>
                <!--fin de numero de factua-->
                <div class="form-row">
                  <div class="form-group" style>
                    <button id="btn_s" v-on:click="busc_a" type="button" class="btn btn-info">
                      <img src="img/buscar.png" alt />
                    </button>
                  </div>
                  <section v-if="cod_tex">
                    <div class="form-group col-md-2">
                      <input
                        type="number"
                        class="form-control animated fadeIn"
                        placeholder="Codigo del producto"
                        id="codProducto"
                        v-model="producto"
                        autofocus
                        v-on:keyup.enter="mover"
                        v-on:keyup.space="setVenta"
                      />
                    </div>
                  </section>
                  <section v-else>
                    <multiselect
                      class="animated fadeIn"
                      style="width:200px"
                      v-model="articulo_bsc"
                      :options="articulos_bsc"
                      :custom-label="nombresSelect"
                      :searchable="true"
                      selectLabel="add"
                      deselectLabel="quitar"
                      placeholder="buscar articulo"
                      noOptions="ingrese articulo"
                    ></multiselect>
                  </section>

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
                  <div class="form-group col-md-2" style>
                    <button
                      type="button"
                      class="btn btn-warning waves-effect"
                      v-on:click="addArticulo"
                    >
                      <i class="icon-basket-loaded"></i> Añadir
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
                  <section v-if="consulta !='' && validar ==false">
                    <div class="col-md-2 col-lg-2">
                      <button
                        id="end_v"
                        class="btn btn-success btn-block waves-effect animated fadeIn"
                        style="  width:150px;"
                        v-on:click="setVenta"
                        v-on:keyup.space="setVenta"
                        type="button"
                      >
                        <h6>Finalizar</h6>
                      </button>
                    </div>
                    <!-- /col -->
                  </section>
                  <section v-else>
                    <div class="col-md-2 col-lg-2">
                      <button
                        class="btn btn-success btn-block animated fadeOut"
                        style="  width:150px;"
                        type="button"
                      >
                        <h6>Finalizar</h6>
                      </button>
                    </div>
                  </section>
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
          <div
            class="modal fade"
            id="registarCliente"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myModalLabel"
            style="display: none;"
            aria-hidden="true"
          >
            <div class="modal-dialog modal-success modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Agregar cliente</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Nombre Proveedor</label>
                      <div class="col-md-9">
                        <input type="text" id="nombre" class="form-control" v-model="nombrePro" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="email-input">Tipo documento</label>
                      <div class="col-md-9">
                        <select class="form-control" v-model="selectedProvedor">
                          <option disabled value>Selecciona tipo documento</option>
                          <option
                            v-for="optione in options"
                            v-bind:key="optione.value"
                            v-bind:value="optione.value"
                            v-text="optione.text"
                          ></option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        class="col-md-3 form-control-label"
                        for="text-input"
                      >Numero del documento</label>
                      <div class="col-md-9">
                        <input
                          type="number"
                          id="numIdocument"
                          class="form-control"
                          v-model="documento"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Dirección</label>
                      <div class="col-md-9">
                        <input type="text" id="direccion" class="form-control" v-model="direccion" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Teléfono</label>
                      <div class="col-md-9">
                        <input
                          type="text"
                          id="nombre"
                          name="telf"
                          class="form-control"
                          v-model="telefono"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Email</label>
                      <div class="col-md-9">
                        <input type="email" id="email" class="form-control" v-model="email" />
                      </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-primary" v-on:click="setarticulos">Guardar</button>

                  <div id="toast">
                    <div id="img">
                      <i class="icon-check"></i>
                    </div>
                    <div id="desc">Guadado con exito...</div>
                  </div>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
            <div id="toast2">
              <div id="img">
                <i class="icon-check"></i>
              </div>
              <div id="desc">Finalizado con exito...</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>




<script >
import { parse } from "path";
import Echo from "laravel-echo";
import { EventEmitter } from "events";
import { timeout } from "q";
window.Pusher = require("pusher-js");

export default {
  data() {
    return {
      // datos para registrar cliente
      options: [{ text: "C.C", value: 3 }, { text: "N.I.T", value: 4 }],
      nombrePro: "",
      selectedProvedor: "",
      documento: "",
      direccion: "",
      telefono: "",
      email: "",
      cod_tex: true,
      //
      articulos_b: "",
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
      cliente: {
        id: 33,
        nombre: "persona natural"
      },
      idusers: this.username,
      loading: true,
      traer: false,
      articulos_bsc: [],
      articulo_bsc: []
    };
  },
  props: ["username"],

  //FUNCION DONDE CARGAR LOS METOS UTLIZADOS PARA ESTE COMPONENTE
  methods: {
    articulos_b_() {
      let art = this;

      axios
        .post("api/articulos")
        .then(function(response) {
          console.log(response.datos);
          art.articulos_bsc = response.data;
        })
        .catch(function(error) {
          // handle error
          // console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.traer = false));
    },

    busc_a() {
      let x = document.getElementById("btn_s");

      //  alert(this.cod_tex);
      if (this.cod_tex == true) {
        this.cod_tex = false;

        x.classList.remove("btn-info");
        x.classList.add("btn-danger");
      } else {
        this.cod_tex = true;
        x.classList.remove("btn-danger");
        x.classList.add("btn-info");

        //document.getElementById("codProducto").focus();
      }
    },
    mover() {
      document.getElementById("cantidad").focus();
    },

    setarticulos() {
      let art = this;

      axios
        .post("api/create_personas", {
          nombre: this.nombrePro,
          TipoPersona: 4,
          NumDocument: this.documento,
          selectedProvedor: this.selectedProvedor,
          direccion: this.direccion,
          telefono: this.telefono,
          email: this.email
        })
        .then(function(response) {
          function toastAlert() {
            var x = document.getElementById("toast");
            x.className = "show";
            setTimeout(function() {
              x.className = x.className.replace("show", "");
            }, 3000);
          }
          toastAlert();
          //console.log(response.data);
        })
        .catch(function(error) {
          // handle error
          // console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.loading = false));
      this.getProveedores2();
      this.nombrePro = "";
      this.selectedProvedor = "";
      this.documento = "";
      this.telefono = "";
      this.email = "";
      this.direccion = "";
    },
    pruebaId() {},
    nombresSelect({ nombre }) {
      return `${nombre}`;
    },
    getProveedores2() {
      let prove = this;
      axios
        .post("api/get_clientes")
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
      }
      if (cantidad <= 0 || producto <= 0) {
        alert("Dato invalido, porfavor ingrese nuevamente");
      } else {
        axios
          .post("api/ver", {
            id: this.producto,
            cantidad: this.cantidad
          })
          .then(function(response) {
            if (
              response.data == 404 ||
              response.data == 1004 ||
              response.data == 1005
            ) {
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
        this.articulo_bsc = "";
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
        .post("api/fecha")
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
        .post("api/NumeroFactura")
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

        // console.log(index);
      }
    },
    validarCamp: function(num) {
      return Number(num).toLocaleString();
    },

    setVenta() {
      let tp_v = 0;
      let tp_c = 0;
      let rent_d = 0;
      this.consulta.forEach(element => {
        tp_v += element.datos.precio_venta * element.cantidad;
        tp_c += element.datos.precio_comrpa * element.cantidad;
      });
      rent_d = tp_v - tp_c;

      if (this.consulta.length > 0) {

      axios
        .post("api/insert_venta", {
          num_comp: this.num,
          total_venta: this.totalPD,
          descuento: this.totalpagarDesT,
          articulos: this.consulta,
          id_user: this.username,
          cliente: this.cliente.id,
          rentabilidad_: rent_d
        })
        .then(function(response) {
          //console.log(response.data);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.loading = false));

          console.log('es mayor');
          this.launch_toast();
      }
      else{
          alert('Porfavor registre un articulo');
          console.log(this.consulta.length);

      }

      this.numero_factura();

      this.totalPD = "";
      this.totalpagarDesT = "";
      this.consulta = [];
      this.articulo_bsc = [];
    }
  },
  destroyed: function() {
    //return confirm('desea salir');
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
  watch: {
    cod_tex: function(Val) {
      if (Val == true) {
        setTimeout(() => {
          document.getElementById("codProducto").focus();
        }, 500);
      }
    },

    articulo_bsc: function(Val) {
      this.producto = Val.codigo;
      document.getElementById("cantidad").focus();
    }
  },
  //METODOS QUE SE CARGARAN CUANDO EL COMPONENTE SEA INVOCADO. IMPORTANTE PARA ALGUNOS DATOS QUE SE NECESITEN EN LA VISTA.
  mounted() {
    this.articulos_b_();
    this.pruebaId();
    this.getFecha();
    this.numero_factura();
    this.getProveedores2();

    window.Echo = new Echo({
      broadcaster: "pusher",
      key: "ASDASD2121",
      wsHost: window.location.hostname,
      wsPort: 6001,
      disableStats: true
    });
    window.Echo.channel("channel-notif").listen("NotificacionEvent", e => {
      this.numero_factura();
    });
    console.log("Component mounted.");
  }
};
</script>
<style>
</style>

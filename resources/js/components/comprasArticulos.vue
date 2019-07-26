<template>
  <main class="main">
    <!-- Breadcrumb -->

    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <form class="form-row">
            <label class="form-group">
              <i class="fa fa-align-justify"></i> Compras
            </label>

            <div id="provedorN" class="form-group col-md-2" style>
              <button
                type="button"
                class="btn btn-secondary"
                data-toggle="modal"
                data-target="#modalNuevo"
              >
                <i class="icon-plus"></i>&nbsp;Nuevo Provedor
              </button>
            </div>
          </form>
        </div>
        <!-- primer formulario crear ingreso -->

        <div class="card-deck">
          <div class="card">
            <div id="cardPrueba" class="card-body">
              <h5 class="card-title">Registro de Ingreso</h5>
              <div class="form-group">
                <button
                  type="button"
                  class="btn btn-danger"
                  data-toggle="modal"
                  style=" height:35px;border-radius:12px;"
                  data-target="#modalCompra"
                >
                  <i class="icon-plus"></i>
                  &nbsp;Nuevo Ingreso
                </button>
              </div>
              <form class="form-row">
                <label class="form-group col-md-2">
                  <img src="img\compra2.png" alt /> Ingrese Provedor
                </label>

                <div class="form-group col-md-6">
                  <select class="form-control" v-model="ingreso">
                    <option disabled value>Selecciona...</option>
                    <option
                      v-for="optione in ingresos"
                      v-bind:key="optione.id"
                      v-bind:value="optione.id"
                      v-text="optione.nombre"
                    ></option>
                  </select>
                  <p class="card-text">
                    <small class="text-muted">(*) Selecciona Ingreso Provedor</small>
                  </p>
                </div>
              </form>

              <form class="form-row">
                <label class="form-group col-md-2">
                  <img src="img\comprobante.png" />Numero comprobante
                </label>

                <div class="form-group col-md-6">
                  <input
                    type="number"
                    class="form-control"
                    placeholder="Numero Comprobante"
                    v-model.number="NumComprobante"
                  />
                </div>
              </form>

              <p class="card-text">
                <small class="text-muted">compra de producto</small>
              </p>
            </div>

            <!--nueva compra  v-if="ingreso !=''"-->
            <section>
              <div id="cardPrueba2" class="card-body fantasma">
                <h5 class="card-title">
                  Nueva compra
                  <br />Proveedor
                </h5>

                <form class="form-row">
                  <label class="form-group col-md-2">
                    <img src="img\producto.png" alt /> Artículo
                  </label>

                  <div class="form-group col-md-6" style>
                    <select class="form-control" v-model="articulo">
                      <option disabled value>Selecciona tipo documento</option>
                      <option
                        v-for="optione in articulos"
                        v-bind:key="optione.id"
                        v-bind:value="optione.codigo"
                        v-text="optione.nombre"
                      ></option>
                    </select>
                  </div>
                </form>

                <form class="form-row">
                  <label class="form-group col-md-2">
                    <img src="img\cart.png" alt /> Cantidad
                  </label>

                  <div class="form-group col-md-3">
                    <input
                      type="number"
                      class="form-control"
                      placeholder="Unidades"
                      v-model="cantidad"
                      id
                      required
                    />
                  </div>
                </form>

                <form class="form-row">
                  <label class="form-group col-md-2">
                    <img src="img\compra.png" alt />precio compra
                  </label>

                  <div class="form-group col-md-3">
                    <input
                      type="number"
                      class="form-control"
                      placeholder="$00.00"
                      v-model="preciocompra"
                    />
                  </div>

                  <label class="form-group col-md-2">
                    <img src="img\venta.png" alt />precio venta
                  </label>

                  <div class="form-group col-md-3" style>
                    <input
                      type="number"
                      class="form-control"
                      placeholder="$00.00"
                      v-model="precioventa"
                      id
                      required
                    />
                  </div>
                </form>

                <div class="input-group mb-3" style=" height:40px;">
                  <div class="input-group-prepend"></div>
                </div>

                <form class="form-row">
                  <div class="form-group col-md-3">
                    <button type="button" class="btn btn-info" v-on:click="limpiar">
                      <span class="cui-contrast"></span> Limpiar
                    </button>
                  </div>

                  <div class="form-group col-md-3" style>
                    <section
                      v-if="articulo!='' && cantidad > 0 && preciocompra >0 && precioventa >0"
                    >
                      <button
                        type="button"
                        v-on:click="prueba"
                        class="btn btn-success animated fadeIn"
                      >
                        <span class="cui-contrast"></span> guardar
                      </button>
                    </section>
                    <section v-else>
                      <Boton></Boton>
                    </section>
                  </div>
                </form>

                <p class="card-text">
                  <small class="text-muted">compra de producto</small>
                </p>
              </div>
            </section>
          </div>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">lista de compras registradas</h5>
              <div class="form-group row">
                <div class="col-md-6">
                  <div class="input-group">
                    <select class="form-control col-md-3" id="opcion" name="opcion">
                      <option value="nombre">Nombre</option>
                      <option value="descripcion">Descripción del articulo</option>
                    </select>
                    <input
                      type="text"
                      id="texto"
                      name="texto"
                      class="form-control"
                      placeholder="Texto a buscar"
                    />
                    <button type="submit" class="btn btn-primary">
                      <i class="fa fa-search"></i> Buscar
                    </button>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th>Opciones</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <button
                          type="button"
                          class="btn btn-warning btn-sm"
                          data-toggle="modal"
                          data-target="#modalNuevo"
                        >
                          <i class="icon-pencil"></i>
                        </button>
                        &nbsp;
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="badge badge-success">Activo</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <p class="card-text">
                <small class="text-muted">Lista de compras</small>
              </p>
            </div>
          </div>
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
          <div class="modal-header">
            <h4 class="modal-title">Agregar categoría</h4>
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
                <label class="col-md-3 form-control-label" for="text-input">Numero del documento</label>
                <div class="col-md-9">
                  <input type="number" id="numIdocument" class="form-control" v-model="documento" />
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
    <!--Fin del modal-->

    <!-- /.modal-content -->
    <div
      class="modal fade"
      id="modalCompra"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Agregar Ingreso</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
              <form class="form-row">
                <label class="form-group col-md-3">
                  <img src="img\consumer.png" alt /> Provedor
                </label>
                <div class="form-group col-md-6">
                  <select class="form-control" v-model="selectProv">
                    <option disabled value>Selecciona Provedor</option>
                    <option
                      v-for="optione in provedores"
                      v-bind:key="optione.id"
                      v-bind:value="optione.id"
                      v-text="optione.nombre"
                    ></option>
                  </select>
                </div>
              </form>
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="email-input">Tipo comprobante</label>
                <div class="form-group col-md-6">
                  <select class="form-control" v-model="comprobante">
                    <option disabled value>Selecciona...</option>
                    <option
                      v-for="optione in comprobantes"
                      v-bind:key="optione.id"
                      v-bind:value="optione.id"
                      v-text="optione.Comprobante"
                    ></option>
                  </select>
                  <p class="card-text">
                    <small class="text-muted">(*) Selecciona Ingreso Provedor</small>
                  </p>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Tipo serie comprobante</label>
                <div class="form-group col-md-6">
                  <select class="form-control" v-model="serie">
                    <option disabled value>Selecciona...</option>
                    <option
                      v-for="optione in series"
                      v-bind:key="optione.id"
                      v-bind:value="optione.id"
                    >{{optione.descripcion}}: {{optione.serie}}</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Numero comprovante</label>
                <div class="col-md-9">
                  <input type="text" id="nombre" name="telf" class="form-control" v-model="numComp" />
                </div>
              </div>
            </form>
          </div>

          <div class="modal-footer">
            <div
              id="efectox"
              class="alert alert-success hideEfecto"
              style="
border-radius: 34px 40px 40px 40px;"
              role="alert"
            >
              <img src="img\validated.png" /> Guardado con exito
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" v-on:click="guardaringreso">Guardar</button>
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

    <!-- /.modal-dialog -->

    <!-- Fin del modal Eliminar -->
  </main>
</template>

<script>
import { setTimeout } from "timers";
export default {
  data() {
    return {
      mensage: "hola",
      NumComprobante: "",
      valido: false,
      //
      cantidad: "",
      preciocompra: "",
      precioventa: "",
      nombrePro: "",
      selectedProvedor: "",
      documento: "",
      direccion: "",
      telefono: "",
      email: "",
      articulos: [],
      articulo: "",
      options: [{ text: "C.C", value: 3 }, { text: "N.I.T", value: 4 }],
      provedores: [],
      selectProv: "",

      //datos modal compra
      comprobante: "",
      comprobantes: [],
      //
      serie: "",
      series: [],
      //
      numComp: "",
      //
      ingreso: "",
      ingresos: []
    };
  },

  methods: {
    prueba() {
      alert();
    },
    GuardarCompra() {
      axios
        .post("/api/get_provedores")
        .then(function(response) {
          prov.provedores = response.data;
        })
        .catch(function(error) {
          // handle error
          // console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.loading = false));
    },

    setarticulos() {
      let art = this;

      axios
        .post("/api/create_personas", {
          nombre: this.nombrePro,
          TipoPersona: 3,
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
          console.log(response.data);
        })
        .catch(function(error) {
          // handle error
          // console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.loading = false));

      this.nombrePro = "";
      this.selectedProvedor = "";
      this.documento = "";
      this.telefono = "";
      this.email = "";
      this.direccion = "";
      this.getProvedores();
    },
    getProvedores() {
      let prov = this;

      axios
        .post("/api/get_provedores")
        .then(function(response) {
          prov.provedores = response.data;
        })
        .catch(function(error) {
          // handle error
          // console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.loading = false));
    },
    getArticulos() {
      let Atr = this;

      axios
        .post("/api/articulos")
        .then(function(response) {
          Atr.articulos = response.data;
        })
        .catch(function(error) {
          // handle error
          // console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.loading = false));
    },
    getComprobantes() {
      let comp = this;

      axios
        .post("/api/get_comprobantes")
        .then(function(response) {
          comp.comprobantes = response.data;
          // console.log(response.data);
        })
        .catch(function(error) {
          // handle error
          // console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.loading = false));
    },
    getSeries() {
      let ser = this;

      axios
        .post("/api/get_series")
        .then(function(response) {
          ser.series = response.data;
          // console.log(response.data);
        })
        .catch(function(error) {
          // handle error
          // console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.loading = false));
    },
    guardaringreso() {
      axios
        .post("/api/guardar_ingreso", {
          id_proveedor: this.selectProv,
          id_tipo_comprobante: this.comprobante,
          id_serie_comprobante: this.serie,
          num_comprobante: this.numComp,
          id_estado: 2
        })
        .then(function(response) {
          if (response.data.error == 404) {
            alert("error");
          } else {
            function toastAl() {
              var x = document.getElementById("efectox");
              x.classList.remove("hideEfecto");
              x.classList.remove("animated", "fadeOutDown");
              x.classList.add("animated", "fadeInUp");
              setTimeout(function() {
                x.classList.remove("animated", "fadeInUp");
                x.classList.add("animated", "fadeOutDown");
                setTimeout(function() {
                  x.classList.add("hideEfecto");
                }, 2000);
              }, 3000);
            }
            toastAl();

            //ser.series = response.data;
          }
          console.log(response.data);
        })
        .catch(function(error) {
          console.log(response.data);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.loading = false));

      this.getImgresosE();
      this.selectProv = "";
      this.comprobante = "";
      this.serie = "";
      this.numComp = "";
    },
    getImgresosE() {
      let ing = this;

      axios
        .post("/api/get_ingresosE")
        .then(function(response) {
          ing.ingresos = response.data;
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
    },
    limpiar() {
      this.articulo = "";
      this.cantidad = "";
      this.preciocompra = "";
      this.precioventa = "";
    },
    RegistrarIngreso() {}
  },

  mounted() {
    this.getProvedores();
    this.getArticulos();
    this.getComprobantes();
    this.getSeries();
    this.getImgresosE();
  },
  watch: {
    ingreso: function(val) {
      if (val != "") {
        var x = document.getElementById("cardPrueba2");
        x.classList.remove("fantasma");
        x.classList.add("animated", "fadeInUp");
      }
    }
  }
};
</script>

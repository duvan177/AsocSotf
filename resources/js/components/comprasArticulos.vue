<template>
  <main class="main">
    <!-- Breadcrumb -->

    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i>Categorías de productos
          <button
            type="button"
            class="btn btn-secondary"
            data-toggle="modal"
            data-target="#modalNuevo"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo Provedor
          </button>
        </div>
        <div class="card-body">
          <div class="card-deck">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Nueva compra</h5>

                <form class="form-row">
                  <label class="form-group col-md-2">
                    <img src="img\consumer.png" alt /> Provedor
                  </label>
                  <div class="form-group col-md-6">
                    <select class="form-control" v-model="selectProv">
                      <option disabled value>Selecciona tipo documento</option>
                      <option
                        v-for="optione in provedores"
                        v-bind:key="optione.id"
                        v-bind:value="optione.id"
                      >{{optione.nombre}}</option>
                    </select>
                  </div>
                </form>
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
                      >{{optione.nombre}}</option>
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
                      id
                      required
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

                <div class="input-group mb-3" style=" height: 200px;">
                  <div class="input-group-prepend"></div>
                </div>

                <div>
                  <button type="button" class="btn btn-success">
                    <span class="cui-contrast"></span> guardar
                  </button>
                </div>

                <p class="card-text">
                  <small class="text-muted">compra de producto</small>
                </p>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">lista Compras registradas</h5>
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
                    >{{optione.text}}</option>
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

    <!-- /.modal-dialog -->

    <!-- Fin del modal Eliminar -->
  </main>
</template>

<script>
export default {
  data() {
    return {
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
      selectProv: ""
    };
  },

  methods: {
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
    }
  },

  mounted() {
    this.getProvedores();
    this.getArticulos();
  },
  computed: {}
};
</script>

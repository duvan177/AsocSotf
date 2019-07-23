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
            <i class="icon-plus"></i>&nbsp;Nuevo producto
          </button>
        </div>
        <div class="card-body">
          <div class="card-deck">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Nueva compra</h5>

                <form class="form-row">
                  <label>
                    <img src="img\consumer.png" alt /> Provedor
                  </label>

                  <div class="form-group col-md-4">
                    <select id="inputState" class="form-control">
                      <option selected>selecciona...</option>
                      <option>...</option>
                    </select>
                  </div>

                  <label>
                    <img src="img\producto.png" alt /> Producto
                  </label>

                  <div class="form-group col-md-4" style>
                    <select id="inputState" class="form-control">
                      <option selected>selecciona...</option>
                      <option>...</option>
                    </select>
                  </div>
                </form>

                <form class="form-row">
                  <label>
                    <img src="img\cart.png" alt /> Cantidad
                  </label>

                  <div class="form-group col-md-3">
                    <input type="number" class="form-control" placeholder="Unidades" id required />
                  </div>
                </form>

                <form class="form-row">
                  <label>
                    <img src="img\compra.png" alt />precio compra
                  </label>

                  <div class="form-group col-md-4">
                    <input type="number" class="form-control" placeholder="$00.00" id required />
                  </div>

                  <label>
                    <img src="img\venta.png" alt />precio venta
                  </label>

                  <div class="form-group col-md-3" style>
                    <input type="number" class="form-control" placeholder="$00.00" id required />
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
                        </button> &nbsp;
                        <button
                          type="button"
                          class="btn btn-danger btn-sm"
                          data-toggle="modal"
                          data-target="#modalEliminar"
                        >
                          <i class="icon-trash"></i>
                        </button>
                      </td>
                      <td>Equipos</td>
                      <td>electrónicos</td>
                      <td>
                        <span class="badge badge-success">Activo</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <button
                          type="button"
                          class="btn btn-warning btn-sm"
                          data-toggle="modal"
                          data-target="#modalNuevo"
                        >
                          <i class="icon-pencil"></i>
                        </button> &nbsp;
                        <button
                          type="button"
                          class="btn btn-danger btn-sm"
                          data-toggle="modal"
                          data-target="#modalEliminar"
                        >
                          <i class="icon-trash"></i>
                        </button>
                      </td>
                      <td>Equipos</td>
                      <td>Dispositivos electrónicos</td>
                      <td>
                        <span class="badge badge-success">Activo</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <button
                          type="button"
                          class="btn btn-warning btn-sm"
                          data-toggle="modal"
                          data-target="#modalNuevo"
                        >
                          <i class="icon-pencil"></i>
                        </button> &nbsp;
                        <button
                          type="button"
                          class="btn btn-danger btn-sm"
                          data-toggle="modal"
                          data-target="#modalEliminar"
                        >
                          <i class="icon-trash"></i>
                        </button>
                      </td>
                      <td>Equipos</td>
                      <td>Dispositivos electrónicos</td>
                      <td>
                        <span class="badge badge-secondary">Inactivo</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <button
                          type="button"
                          class="btn btn-warning btn-sm"
                          data-toggle="modal"
                          data-target="#modalNuevo"
                        >
                          <i class="icon-pencil"></i>
                        </button> &nbsp;
                        <button
                          type="button"
                          class="btn btn-danger btn-sm"
                          data-toggle="modal"
                          data-target="#modalEliminar"
                        >
                          <i class="icon-trash"></i>
                        </button>
                      </td>
                      <td>Equipos</td>
                      <td>Dispositivos electrónicos</td>
                      <td>
                        <span class="badge badge-secondary">Inactivo</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <button
                          type="button"
                          class="btn btn-warning btn-sm"
                          data-toggle="modal"
                          data-target="#modalNuevo"
                        >
                          <i class="icon-pencil"></i>
                        </button>&nbsp;
                        <button
                          type="button"
                          class="btn btn-danger btn-sm"
                          data-toggle="modal"
                          data-target="#modalEliminar"
                        >
                          <i class="icon-trash"></i>
                        </button>
                      </td>
                      <td>Equipos</td>
                      <td>Dispositivos electrónicos</td>
                      <td>
                        <span class="badge badge-success">Activo</span>
                      </td>
                    </tr>
                  </tbody>
                </table>

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
                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                <div class="col-md-9">
                  <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    class="form-control"
                    placeholder="Nombre de categoría"
                  />
                  <span class="help-block">(*) Ingrese el nombre de la categoría</span>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                <div class="col-md-9">
                  <input
                    type="email"
                    id="descripcion"
                    name="descripcion"
                    class="form-control"
                    placeholder="Enter Email"
                  />
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary">Guardar</button>
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
export default {
  data() {
    return {
      articulos: [],
      Articulo: ""
    };
  },

  methods: {
    getarticulos() {
      let art = this;

      axios
        .post("/api/articulo")
        .then(function(response) {
          art.articulos = response.data;
          // console.log(numfactura);
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
    console.log("Component mounted.");
  }
};
</script>

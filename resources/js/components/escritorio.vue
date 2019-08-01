<template>
  <main class="main">
    <!-- Breadcrumb -->

    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Categorías
          <button
            type="button"
            class="btn btn-secondary"
            data-toggle="modal"
            data-target="#modalNuevo"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
        </div>
        <div class="card-body">
          <graficos></graficos>

          <nav></nav>
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
      encontrado: false
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
    }
  },
  computed: {},

  mounted() {
    this.buscar();
  }
};
</script>
 
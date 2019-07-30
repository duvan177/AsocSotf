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
          id: 61,
          id_ingreso: 95,
          id_articulo: 44,
          cantidad: 30,
          precio_comrpa: 700,
          precio_venta: 3000,
          created_at: "2019-07-28 19:39:21",
          updated_at: "2019-07-28 19:39:21",
          ingreso: [
            {
              id: 95,
              id_proveedor: 30,
              id_tipo_comprobante: 3,
              id_serie_comprobante: 2,
              num_comprobante: "3104666575",
              id_estado: 2,
              created_at: "2019-07-28 19:37:40",
              updated_at: "2019-07-28 19:37:40"
            }
          ],
          persona: [
            {
              id: 30,
              id_tipo_persona: 3,
              nombre: "PEPE",
              id_tipo_documento: 3,
              num_documento: "12345",
              direccion: "CALLE 10# 19-049",
              telefono: "3104666575",
              email: "duvannarvaez17@gmail.com",
              created_at: "2019-07-25 13:18:55",
              updated_at: "2019-07-25 13:18:55",
              laravel_through_key: 95
            }
          ],
          articulo: [
            {
              id: 44,
              id_categoria: 4,
              codigo: 71,
              nombre: "postobon",
              stock: 0,
              descripcion: "bebida colombina",
              imagen: null,
              estado: 1,
              created_at: "2019-07-18 20:30:46",
              updated_at: "2019-07-18 20:30:46"
            }
          ]
        },
        {
          id: 60,
          id_ingreso: 92,
          id_articulo: 41,
          cantidad: 12,
          precio_comrpa: 1200,
          precio_venta: 4000,
          created_at: "2019-07-28 18:58:31",
          updated_at: "2019-07-28 18:58:31",
          ingreso: [
            {
              id: 92,
              id_proveedor: 2,
              id_tipo_comprobante: 3,
              id_serie_comprobante: 2,
              num_comprobante: "00090909009",
              id_estado: 2,
              created_at: "2019-07-27 00:15:13",
              updated_at: "2019-07-27 00:15:13"
            }
          ],
          persona: [
            {
              id: 2,
              id_tipo_persona: 3,
              nombre: "COCA-COLA",
              id_tipo_documento: 4,
              num_documento: "12345",
              direccion: "CALLE 10# 19-049",
              telefono: "3104666575",
              email: "duvannarvaez17@gmail.com",
              created_at: "2019-06-25 00:00:00",
              updated_at: null,
              laravel_through_key: 92
            }
          ],
          articulo: [
            {
              id: 41,
              id_categoria: 5,
              codigo: 21,
              nombre: "bandeja de pollo",
              stock: 0,
              descripcion: "pollo bucanero",
              imagen: null,
              estado: 1,
              created_at: "2019-07-18 20:22:36",
              updated_at: "2019-07-18 20:22:36"
            }
          ]
        },
        {
          id: 59,
          id_ingreso: 94,
          id_articulo: 44,
          cantidad: 12,
          precio_comrpa: 12,
          precio_venta: 12,
          created_at: "2019-07-28 18:13:55",
          updated_at: "2019-07-28 18:13:55",
          ingreso: [
            {
              id: 94,
              id_proveedor: 11,
              id_tipo_comprobante: 3,
              id_serie_comprobante: 2,
              num_comprobante: "1212121212",
              id_estado: 2,
              created_at: "2019-07-28 18:13:41",
              updated_at: "2019-07-28 18:13:41"
            }
          ],
          persona: [
            {
              id: 11,
              id_tipo_persona: 3,
              nombre: "alqueria",
              id_tipo_documento: 4,
              num_documento: "345453",
              direccion: "CALLE 10# 19-049",
              telefono: "3104666575",
              email: "duvannarvaez17@gmail.com",
              created_at: "2019-07-23 19:54:57",
              updated_at: "2019-07-23 19:54:57",
              laravel_through_key: 94
            }
          ],
          articulo: [
            {
              id: 44,
              id_categoria: 4,
              codigo: 71,
              nombre: "postobon",
              stock: 0,
              descripcion: "bebida colombina",
              imagen: null,
              estado: 1,
              created_at: "2019-07-18 20:30:46",
              updated_at: "2019-07-18 20:30:46"
            }
          ]
        },
        {
          id: 44,
          id_ingreso: 92,
          id_articulo: 43,
          cantidad: 15,
          precio_comrpa: 1500,
          precio_venta: 2300,
          created_at: "2019-07-27 00:15:47",
          updated_at: "2019-07-27 00:15:47",
          ingreso: [
            {
              id: 92,
              id_proveedor: 2,
              id_tipo_comprobante: 3,
              id_serie_comprobante: 2,
              num_comprobante: "00090909009",
              id_estado: 2,
              created_at: "2019-07-27 00:15:13",
              updated_at: "2019-07-27 00:15:13"
            }
          ],
          persona: [
            {
              id: 2,
              id_tipo_persona: 3,
              nombre: "COCA-COLA",
              id_tipo_documento: 4,
              num_documento: "12345",
              direccion: "CALLE 10# 19-049",
              telefono: "3104666575",
              email: "duvannarvaez17@gmail.com",
              created_at: "2019-06-25 00:00:00",
              updated_at: null,
              laravel_through_key: 92
            }
          ],
          articulo: [
            {
              id: 43,
              id_categoria: 2,
              codigo: 51,
              nombre: "jabon protex",
              stock: 0,
              descripcion: "jabón para ingenie personal",
              imagen: null,
              estado: 1,
              created_at: "2019-07-18 20:24:04",
              updated_at: "2019-07-18 20:24:04"
            }
          ]
        },
        {
          id: 32,
          id_ingreso: 86,
          id_articulo: 43,
          cantidad: 12,
          precio_comrpa: 1200,
          precio_venta: 2000,
          created_at: "2019-07-26 14:41:53",
          updated_at: "2019-07-26 14:41:53",
          ingreso: [
            {
              id: 86,
              id_proveedor: 2,
              id_tipo_comprobante: 3,
              id_serie_comprobante: 2,
              num_comprobante: "3104666575",
              id_estado: 1,
              created_at: "2019-07-26 14:41:06",
              updated_at: "2019-07-26 14:41:06"
            }
          ],
          persona: [
            {
              id: 2,
              id_tipo_persona: 3,
              nombre: "COCA-COLA",
              id_tipo_documento: 4,
              num_documento: "12345",
              direccion: "CALLE 10# 19-049",
              telefono: "3104666575",
              email: "duvannarvaez17@gmail.com",
              created_at: "2019-06-25 00:00:00",
              updated_at: null,
              laravel_through_key: 86
            }
          ],
          articulo: [
            {
              id: 43,
              id_categoria: 2,
              codigo: 51,
              nombre: "jabon protex",
              stock: 0,
              descripcion: "jabón para ingenie personal",
              imagen: null,
              estado: 1,
              created_at: "2019-07-18 20:24:04",
              updated_at: "2019-07-18 20:24:04"
            }
          ]
        }
      ],
      noticia_titulo_cas: "",
      encontrado: false
    };
  },
  methods: {
    buscarEnObjecto: function(objecto, palabra) {
      for (let key in objecto) {
        if (
          objecto.hasOwnProperty(key) &&
          objecto[key]
            .toString()
            .toLowerCase()
            .includes(palabra)
        ) {
          this.encontrado = true;
          return true;
        } else {
        }
      }
    }
  },
  computed: {
    searchNoticia: function() {
      return this.lists.filter(item => {
        return this.buscarEnObjecto(
          item,
          this.noticia_titulo_cas.toLowerCase()
        );
      });
    }
  },

  mounted() {}
};
</script>
 
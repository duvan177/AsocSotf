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
          <nav>
            <div class="row mx-md-n5">
              <div class="col px-md-7">
                <div class="p-3 border">
                  <div class="form-group row">
                    <div class="col-md-6">
                      <div class="input-group">
                        <multiselect
                          v-model="value"
                          :custom-label="nombresSelect"
                          :options="options"
                          :searchable="true"
                          selectLabel="seleciona"
                          deselectLabel="quitar seleccion"
                          selectedLabel="seleccionado"
                          noResult="elemento no encontrado"
                          noOptions="ingrese provedor"
                        ></multiselect>
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
                        <th>N° Comprobante</th>
                        <th>cliente</th>
                        <th>Tipo Comprobane</th>
                        <th>Descuento</th>
                        <th>Total</th>
                        <th>Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="animated fadeIn" v-for="item in ventas" :key="item.id">
                        <td v-text="item.num_comprobante"></td>
                        <td v-text="item.nombre"></td>
                        <td v-text="item.Comprobante"></td>
                        <td v-text="item.descuento"></td>
                        <td v-text="item.total_venta"></td>
                        <td>
                          <button type="button" class="btn btn-info btn-sm">
                            <i class="icon-pencil"></i>
                          </button>
                          &nbsp;
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col px-md-5">
                <div class="p-3 border bg-light">Custom column padding</div>
              </div>
            </div>
          </nav>
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
import Multiselect from "vue-multiselect";

// register globally
Vue.component("multiselect", Multiselect);

export default {
  // OR register locally
  components: { Multiselect },
  data() {
    return {
      value: null,
      options: [
        {
          id: 2,
          nombre: "COCA-COLA"
        },
        {
          id: 11,
          nombre: "alqueria"
        },
        {
          id: 28,
          nombre: "duvan felipe narvaez"
        },
        {
          id: 30,
          nombre: "PEPE"
        },
        {
          id: 31,
          nombre: "Chamorro"
        },
        {
          id: 32,
          nombre: "La Gordita Estiven"
        }
      ],
      ventas: []
    };
  },
  methods: {
    nombresSelect({ nombre }) {
      return `${nombre}`;
    },

    getVentas_x() {
      let meventas = this;
      axios
        .post("/api/get_Ventas")
        .then(function(response) {
          meventas.ventas = response.data;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.loading = false));
    }
  },

  mounted() {
    this.getVentas_x();
  }
};
</script>

<!-- New step!
     Add Multiselect CSS. Can be added as a static asset or inside a component. -->
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>



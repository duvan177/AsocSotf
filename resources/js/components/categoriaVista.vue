<template>
  <main class="main">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="form-group col-md-2">
            <button
              type="button"
              class="btn btn-success"
              data-toggle="modal"
              data-target="#articuloModal"
              style="position:relative; rigth:100px;"
            >Crear Categoria</button>
          </div>
          <form class="form-inline my-2 my-lg-0">
            <input
              class="form-control mr-sm-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="table-responsive">
              <table class="table table table-striped">
                <caption>Lista de Categoria</caption>
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="consul in consulta" :key="consul.id">
                    <th scope="row">{{consul.id}}</th>
                    <td v-text="consul.nombre_categoria"></td>
                    <td v-text="consul.descripcion_categoria"></td>
                    <td>
                      <button
                        type="button"
                        class="btn btn-primary"
                        data-toggle="modal"
                        data-target="#articuloeditarModal"
                        style="width:75 px"
                        v-on:click="traerCategoriaEditar(consul)"
                      >Editar</button>

                      <button
                        type="button"
                        class="btn btn-danger"
                        v-on:click.prevent="eliminarCategoria(consul)"
                      >Eliminar</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal de categoria -->
    <div
      class="modal fade"
      id="articuloModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Crear Categoria</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              v-on:click="limpiar()"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form>
            <div class="modal-body">
              <div class="form-group">
                <label for="formGroupExampleInput">Nombre Categoria</label>
                <input
                  type="text"
                  class="form-control"
                  id="formGroupExampleInput"
                  placeholder="Nombre Articulo"
                  v-model="nombre_categoria"
                />
              </div>

              <div class="form-group">
                <label for="formGroupExampleInput">Descripcion</label>
                <input
                  type="text"
                  class="form-control"
                  id="formGroupExampleInput"
                  v-model="descripcion_categoria"
                  placeholder="Descripcion"
                />
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                  v-on:click="limpiar()"
                >Cerrar</button>
                <div v-if="nombre_categoria=='' || descripcion_categoria==''">
                  <button
                    type="submit"
                    disabled
                    class="btn btn-primary"
                    data-dismiss="modal"
                  >Guardar</button>
                </div>
                <div v-else-if="nombre_categoria!='' && descripcion_categoria!='' ">
                  <button
                    type="button"
                    v-on:click.prevent="guardarCategoria()"
                    data-dismiss="modal"
                    class="btn btn-primary"
                  >Guardar</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- fin del modal-->

    <!-- Modal de editar articulos -->
    <div
      class="modal fade"
      id="articuloeditarModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Categoria</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form>
            <div class="modal-body">
              <div class="form-group">
                <label for="formGroupExampleInput">Nombre Categoria</label>
                <input
                  type="text"
                  class="form-control"
                  id="formGroupExampleInput"
                  placeholder="Nombre Articulo"
                  v-model="nombre_categoria_Editar"
                />
              </div>
              {{this.id}}
              <div class="form-group">
                <label for="formGroupExampleInput">Descripcion Categoria</label>
                <input
                  type="text"
                  class="form-control"
                  id="formGroupExampleInput"
                  v-model="descripcion_categoria_Editar"
                  placeholder="Descripcion"
                />
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <div v-if="nombre_categoria_Editar=='' || descripcion_categoria_Editar==''">
                  <button
                    type="submit"
                    disabled
                    class="btn btn-primary"
                    data-dismiss="modal"
                  >Guardar</button>
                </div>
                <div v-else-if="nombre_categoria_Editar!='' && descripcion_categoria_Editar!='' ">
                  <button
                    type="button"
                    v-on:click.prevent="EditarCategoria()"
                    data-dismiss="modal"
                    class="btn btn-primary"
                  >Guardar</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- fin del modal-->
  </main>
</template>

<script>
export default {
  data() {
    return {
      seleccionar: "selec...",
      consulta: [],
      consultaFact: false,
      loading: true,
      num: [],
      consulcat: [],
      consulest: [],
      nombre_categoria: "",
      descripcion_categoria: "",
      descripcion_categoria_Editar: "",
      nombre_categoria_Editar: "",
      id: ""
    };
  },

  methods: {
    EditarCategoria() {
      let consulta2 = this;
      let nombre_categoria_Editar = this.nombre_categoria_Editar;
      let descripcion_categoria_Editar = this.descripcion_categoria_Editar;
      let id = this.id;
      console.log(this.id);
      console.log(this.descripcion_categoria_Editar);
      axios
        .post("api/editarcategoria", {
          id: this.id,
          nombre_categoria_Editar: this.nombre_categoria_Editar,
          descripcion_categoria_Editar: this.descripcion_categoria_Editar
        })
        .then(response => {
          this.addCategoria();
        });
    },
    guardarCategoria() {
      let consulta2 = this;
      let nombre_categoria = this.nombre_categoria;
      let descripcion_categoria = this.descripcion_categoria;

      axios
        .post("api/guardarcategoria", {
          nombre_categoria: this.nombre_categoria,
          descripcion_categoria: this.descripcion_categoria
        })
        .then(response => {
          this.nombre_categoria = "";
          this.descripcion_categoria = "";
          this.addCategoria();
        });
    },
    limpiar() {
      this.descripcion_categoria = "";
      this.nombre_categoria = "";
    },
    /* seleccion(){
   let categoria = this.categoria;
    let sub = categoria.substring(0,1);
    this.selec= sub;
   },*/
    addCategoria() {
      let meconsulta = this;
      axios.post("api/categoria").then(function(response) {
        meconsulta.consulta = response.data;
      });
    },
    traerCategoriaEditar(consul) {
      this.nombre_categoria_Editar = consul.nombre_categoria;
      this.descripcion_categoria_Editar = consul.descripcion_categoria;
      this.id = consul.id;
      console.log(this.id);
    },
    eliminarCategoria(consul) {
      //let id = this.id;
      console.log(consul.id);
      axios
        .post("api/eliminarCategoria", {
          id: consul.id
        })
        .then(response => {
          this.addCategoria();
        });
    }
  },
  created() {},
  mounted() {
    this.addCategoria();
  }
  //FUNCION DONDE CARGAR LOS METOS UTLIZADOS PARA ESTE COMPONENTE
};
</script>
<style>
</style>


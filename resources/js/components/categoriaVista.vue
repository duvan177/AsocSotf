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
              placeholder="Nombre Categoria"
              id="busqueda"
              v-on:keyup="myFunction()"
              aria-label="Search"
            />
            <input
              class="form-control mr-sm-2"
              type="search"
              placeholder="Descripcion Categoria"
              id="busqueda2"
              v-on:keyup="myFunction2()"
              aria-label="Search"
            />
          </form>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="table-responsive">
              <table class="table table table-striped" id="myTable">
                <caption>Lista de Categoria</caption>
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="animated fadeIn" v-for="consul in consulta" :key="consul.id">
                    <th scope="row">{{consul.id}}</th>
                    <td v-text="consul.nombre_categoria"></td>
                    <td v-text="consul.descripcion_categoria"></td>
                    <div v-if="rol==1">
                      <td>
                        <button
                          type="button"
                          class="btn btn-primary"
                          data-toggle="modal"
                          data-target="#dialogoPreguntar"
                          style="width:75 px"
                          v-on:click="traerCategoriaEditar(consul)"
                        >Editar</button>

                        <button
                          type="button"
                          class="btn btn-danger"
                          data-toggle="modal"
                          data-target="#dialogoEliminar"
                          v-on:click.prevent="traerCategoriaid(consul)"
                        >Eliminar</button>
                      </td>
                    </div>
                    <div v-else-if="rol==2">
                      <td>
                        <button
                          type="button"
                          class="btn btn-primary"
                          data-toggle="modal"
                          data-target="#dialogoVer"
                          v-on:click.prevent="traerCategoriaEditar(consul)"
                        >Ver</button>
                      </td>
                    </div>
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

    <!-- Modal de editar articulos -->
    <div
      class="modal fade"
      id="dialogoVer"
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
                  disabled
                  type="text"
                  class="form-control"
                  id="formGroupExampleInput"
                  placeholder="Nombre Articulo"
                  v-model="nombre_categoria_Editar"
                />
              </div>

              <div class="form-group">
                <label for="formGroupExampleInput">Descripcion Categoria</label>
                <input
                  disabled
                  type="text"
                  class="form-control"
                  id="formGroupExampleInput"
                  v-model="descripcion_categoria_Editar"
                  placeholder="Descripcion"
                />
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- fin del modal-->

    <!--Alerta -->
    <div class="modal" tabindex="-1" id="error" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">¡Alerta!</h5>
            <!--<button type="button" class="close" v-on:click.prevent="limpiar()" data-dismiss="modal" aria-label="Close">-->
            <!--<span aria-hidden="true">&times;</span>-->
          </div>
          <div class="modal-body">
            <p>Se presento el siguiente error: {{error}} por favor comunicarse con el desarrollador</p>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-danger"
              data-dismiss="modal"
              v-on:click.prevent="limpiar()"
            >Ok</button>
          </div>
        </div>
      </div>
    </div>
    <!--fin modal Alerta -->
    <!--respuesta -->
    <div class="modal" tabindex="-1" id="respuesta" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">¡{{respuesta}}!</h5>
            <!--<button type="button" class="close" v-on:click.prevent="limpiar()" data-dismiss="modal" aria-label="Close">-->
            <!--<span aria-hidden="true">&times;</span>-->
          </div>
          <div class="modal-body">
            <p>Se {{respuesta}} correctamnte{{respuesta2}}</p>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-primary"
              data-dismiss="modal"
              v-on:click.prevent="limpiar()"
            >Ok</button>
          </div>
        </div>
      </div>
    </div>
    <!--fin modal respuesta -->
    <!-- model preguntar -->
    <div class="modal" tabindex="-1" id="dialogoPreguntar" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Pregunta</h5>
            <button
              type="button"
              class="close"
              v-on:click.prevent="limpiar()"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Seguro que desea editar la categoria {{this.nombre}}</p>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              v-on:click.prevent="limpiar()"
            >No</button>
            <button
              type="button"
              class="btn btn-primary"
              data-toggle="modal"
              data-dismiss="modal"
              data-target="#articuloeditarModal"
            >Si</button>
          </div>
        </div>
      </div>
    </div>
    <!--fin modal preguntar -->
    <!-- model preguntar Eliminar -->
    <div class="modal" tabindex="-1" id="dialogoEliminar" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Pregunta</h5>
            <button
              type="button"
              class="close"
              v-on:click.prevent="limpiar()"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Seguro que desea eliminar la empresa {{this.nombre_categoria_Editar}}</p>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              v-on:click.prevent="limpiar()"
            >No</button>
            <button
              type="button"
              class="btn btn-primary"
              data-dismiss="modal"
              v-on:click.prevent="eliminarCategoria()"
            >Si</button>
          </div>
        </div>
      </div>
    </div>
    <!--fin modal preguntar -->
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
      id: 0,
      nombre: "",
      respuesta: "",
      error: "",
      userid: this.username,
      rol: 0,
      rol2: []
    };
  },
  props: ["username"],
  methods: {
    asignarId() {
      var consultaCate = this;
      console.log(this.username);
      axios.post("api/getDataPermise", { id: this.userid }).then(response => {
        consultaCate.rol2 = response.data;
        console.log(consultaCate.rol2[0].id_rol);
        var rol = consultaCate.rol2[0].id_rol;
        //console.log(this.rol);
        this.prueba(rol);
      });
      console.log("si");
    },
    prueba(rol) {
      this.rol = rol;
      console.log(this.rol);
    },
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
          this.respuesta = "Edito";
          this.respuesta2 =
            ", recuerde que al editar o eliminar una categoria" +
            " puede afectar un articulo o varios";
          $("#respuesta").modal("show");
        })
        .catch(error => {
          this.error = error.response;
          $("#error").modal("show");
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
          this.respuesta = "guardo";
          $("#respuesta").modal("show");
        })
        .catch(error => {
          this.error = error.response;
          $("#error").modal("show");
        });
    },
    limpiar() {
      this.descripcion_categoria = "";
      this.nombre_categoria = "";
    },
    traerCategoriaid(consul) {
      this.id = consul.id;
    },
    /* seleccion(){
   let categoria = this.categoria;
    let sub = categoria.substring(0,1);
    this.selec= sub;
   },*/
    addCategoria() {
      let meconsulta = this;
      axios
        .post("api/categoria")
        .then(function(response) {
          meconsulta.consulta = response.data;
        })
        .catch(error => {
          this.error = error.response;
          $("#error").modal("show");
        });
    },
    traerCategoriaEditar(consul) {
      this.nombre_categoria_Editar = consul.nombre_categoria;
      this.descripcion_categoria_Editar = consul.descripcion_categoria;
      this.id = consul.id;
      console.log(this.id);
    },
    eliminarCategoria() {
      //let id = this.id;
      //console.log(consul.id);
      axios
        .post("api/eliminarCategoria", {
          id: this.id
        })
        .then(response => {
          this.addCategoria();
          this.respuesta = "Elimino";
          this.respuesta2 =
            ", recuerde que al editar o eliminar una categoria" +
            " puede afectar un articulo o varios";
          $("#respuesta").modal("show");
        })
        .catch(error => {
          this.error = error.response;
          $("#error").modal("show");
        });
    },
    myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("busqueda");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    },
    myFunction2() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("busqueda2");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
  },
  created() {},
  mounted() {
    this.asignarId();
    this.addCategoria();
  }
  //FUNCION DONDE CARGAR LOS METOS UTLIZADOS PARA ESTE COMPONENTE
};
</script>
<style>
</style>


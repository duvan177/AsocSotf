<template>
  <main class="main">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header"></div>

        <div class="card-body">
          <div class="form-group col-md-2">
            <button
              type="button"
              class="btn btn-success"
              data-toggle="modal"
              data-target="#articuloModal"
              style="position:relative; rigth:100px;"
            >Crear Articulo</button>
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

          <table class="table">
            <caption>Lista Articulos</caption>
            <thead>
              <tr>
                <th scope="col">#</th>

                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Stock</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Estado</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="consul in consulta" :key="consul.id">
                <th scope="row"></th>
                <td v-text="consul.codigo"></td>
                <td v-text="consul.nombre"></td>
                <td v-text="consul.stock"></td>
                <td v-text="consul.descripcion"></td>
                <td v-text="consul.estado_articulo"></td>
                <td>
                  <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#articuloeditarModal"
                    v-on:click.prevent="traerArticuloEditar(consul)"
                  >Editar</button>
                </td>
                <td>
                  <button
                    type="button"
                    class="btn btn-danger"
                    v-on:click.prevent="eliminarArticulo(consul)"
                  >Eliminar</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Modal de articulos -->
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
            <h5 class="modal-title" id="exampleModalLabel">Crear Articulo</h5>
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
                <label for="formGroupExampleInput">codigo</label>
                <input
                  type="number"
                  class="form-control"
                  v-model="codigo"
                  id="formGroupExampleInput"
                  placeholder="codigo"
                />
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Categoria</label>
                <select class="form-control" id="categoria" v-model="categoria" required>
                  <option disabled value>selecionar</option>
                  <option
                    v-for="consul1 in consulcat"
                    :key="consul1.id"
                    v-text="consul1.nombre_categoria"
                    :value="consul1.id"
                  ></option>
                  {{categoria}}
                </select>
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Estado</label>
                <select
                  class="form-control"
                  id="exampleFormControlSelect1"
                  v-model="estado"
                  required
                >
                  <option disabled value="0">seleccionar</option>
                  <option value="1">Activado</option>
                  <option value="2">Inactivo</option>
                  <option value="3">Agotado</option>
                </select>
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">Nombre Articulo</label>
                <input
                  type="text"
                  class="form-control"
                  id="formGroupExampleInput"
                  placeholder="Nombre Articulo"
                  v-model="nombre"
                />
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">stock</label>

                <div v-if="this.estado == 2 || this.estado == 3">
                  <input
                    type="number"
                    class="form-control"
                    id="formGroupExampleInput"
                    placeholder="stock"
                    value="0"
                    disabled
                    v-model="stock"
                  />
                </div>
                <div v-else-if="this.estado == 1">
                  <input
                    type="number"
                    class="form-control"
                    id="formGroupExampleInput"
                    placeholder="stock"
                    required
                    v-model="stock"
                  />
                </div>
                <div v-else>
                  <input
                    type="number"
                    class="form-control"
                    id="formGroupExampleInput"
                    placeholder="stock"
                    value="0"
                    disabled
                    v-model="stock"
                  />
                </div>
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">Descripcion</label>
                <input
                  type="text"
                  class="form-control"
                  id="formGroupExampleInput"
                  v-model="descripcion"
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
                <div
                  v-if="estado ==0 || categoria ==''||codigo==''|| nombre=='' || descripcion==''"
                >
                  <button
                    type="submit"
                    disabled
                    class="btn btn-primary"
                    data-dismiss="modal"
                  >Guardar</button>
                </div>
                <div v-else-if="codigo!=''&& nombre!='' && descripcion!='' ">
                  <button
                    type="button"
                    v-on:click="guardarArticulo()"
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
            <h5 class="modal-title" id="exampleModalLabel">Editar Articulo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form>
            <div class="modal-body">
              <div class="form-group">
                <label for="formGroupExampleInput">codigo</label>
                <input
                  type="number"
                  class="form-control"
                  v-model="codigoEditar"
                  id="formGroupExampleInput"
                  placeholder="codigo"
                />
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Categoria</label>
                <select class="form-control" id="categoria" v-model="categoriaEditar" required>
                  <option disabled value="0">selecionar</option>
                  <option
                    v-for="consul1 in consulcat"
                    :key="consul1.id"
                    :value="consul1.id"
                    v-text="consul1.nombre_categoria"
                  ></option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Estado</label>
                <select
                  class="form-control"
                  id="exampleFormControlSelect1"
                  v-model="estadoEditar"
                  required
                >
                  <option disabled value="0">seleccionar</option>
                  <option value="1">Activado</option>
                  <option value="2">Inactivo</option>
                  <option value="3">Agotado</option>
                </select>
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">Nombre Articulo</label>
                <input
                  type="text"
                  class="form-control"
                  id="formGroupExampleInput"
                  placeholder="Nombre Articulo"
                  v-model="nombreEditar"
                />
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">stock</label>

                <div v-if="this.estadoEditar == 2 || this.estadoEditar == 3">
                  <input
                    type="number"
                    class="form-control"
                    id="formGroupExampleInput"
                    placeholder="stock"
                    value="0"
                    disabled
                    v-model="stockEditar"
                  />
                </div>
                <div v-else-if="this.estadoEditar == 1">
                  <input
                    type="number"
                    class="form-control"
                    id="formGroupExampleInput"
                    placeholder="stock"
                    required
                    v-model="stockEditar"
                  />
                </div>
                <div v-else>
                  <input
                    type="number"
                    class="form-control"
                    id="formGroupExampleInput"
                    placeholder="stock"
                    value="0"
                    disabled
                    v-model="stockEditar"
                  />
                </div>
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">Descripcion</label>
                <input
                  type="text"
                  class="form-control"
                  id="formGroupExampleInput"
                  v-model="descripcionEditar"
                  placeholder="Descripcion"
                />
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <div
                  v-if="estadoEditar ==0 || categoriaEditar ==''||codigoEditar==''|| nombreEditar=='' || descripcionEditar==''"
                >
                  <button
                    type="submit"
                    disabled
                    class="btn btn-primary"
                    data-dismiss="modal"
                  >Guardar</button>
                </div>
                <div v-else-if="codigoEditar!=''&& nombreEditar!='' && descripcionEditar!='' ">
                  <button
                    type="button"
                    v-on:click="EditarArticulo()"
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
      codigo: "",
      nombre: "",
      stock: 0,
      descripcion: "",
      selec: 0,
      estado: 0,
      categoria: "",
      codigoEditar: "",
      nombreEditar: "",
      stockEditar: "",
      descripcionEditar: "",
      selecEditar: 0,
      estadoEditar: 0,
      categoriaEditar: "",
      id: 0
    };
  },

  methods: {
    EditarArticulo() {
      let consulta2 = this;
      let codigoEditar = this.codigoEditar;
      let nombreEditar = this.nombreEditar;
      let stockEditar = this.stockEditar;
      let descripcionEditar = this.descripcionEditar;
      let estadoEditar = this.estadoEditar;
      let categoriaEditar = this.categoriaEditar;
      let sub = categoriaEditar;
      this.selecEditar = sub;
      axios
        .post("api/editararticulo", {
          id: this.id,
          categoriaEditar: this.selecEditar,
          codigoEditar: this.codigoEditar,
          nombreEditar: this.nombreEditar,
          stockEditar: this.stockEditar,
          descripcionEditar: this.descripcionEditar,
          estadoEditar: this.estadoEditar
        })
        .then(response => {
          this.addArticulo();
        });
    },
    guardarArticulo() {
      let consulta2 = this;
      let codigo = this.codigo;
      let nombre = this.nombre;
      let stock = this.stock;
      let descripcion = this.descripcion;
      let estado = this.estado;
      let categoria = this.categoria;
      let sub = categoria;
      this.selec = sub;

      console.log(sub);
      axios
        .post("api/guardararticulo", {
          categoria: this.selec,
          codigo: this.codigo,
          nombre: this.nombre,
          stock: this.stock,
          descripcion: this.descripcion,
          estado: this.estado
        })
        .then(response => {
          this.addArticulo();
          this.categoria = "";
          this.codigo = "";
          this.nombre = "";
          this.stock = 0;
          this.descripcion = "";
          this.estado = 0;
        });
    },
    limpiar() {
      this.categoria = "";
      this.codigo = "";
      this.nombre = "";
      this.stock = 0;
      this.descripcion = "";
      this.estado = 0;
    },
    /* seleccion(){
   let categoria = this.categoria;
    let sub = categoria.substring(0,1);
    this.selec= sub;
   },*/
    addArticulo() {
      let meconsulta = this;
      axios.post("api/articulo").then(function(response) {
        meconsulta.consulta = response.data;
      });
    },

    addcategoria() {
      let consultaCate = this;
      axios.post("api/categoria").then(function(response) {
        consultaCate.consulcat = response.data;
      });
    },
    addestado() {
      let consultaEstad = this;
      axios.post("api/estado").then(function(response) {
        consultaEstad.consulest = response.data;
      });
    },
    traerArticuloEditar(consul) {
      this.codigoEditar = consul.codigo;
      this.nombreEditar = consul.nombre;
      this.stockEditar = consul.stock;
      this.descripcionEditar = consul.descripcion;
      this.estadoEditar = consul.estado;
      this.categoriaEditar = consul.id_categoria;
      this.id = consul.id;
    },
    eliminarArticulo(consul) {
      axios
        .post("api/eliminarArticulo", {
          id: consul.id
        })
        .then(response => {
          this.addArticulo();
        });
    }
  },
  created() {},
  mounted() {
    this.addArticulo();
    this.addcategoria();
    this.addestado();
  }
  //FUNCION DONDE CARGAR LOS METOS UTLIZADOS PARA ESTE COMPONENTE
};
</script>
<style>
</style>


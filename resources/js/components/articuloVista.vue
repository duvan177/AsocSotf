<template>
  <main class="main">
   <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="form-group col-md-4">
            <button
              type="button"
              class="btn btn-success"
              data-toggle="modal"
              data-target="#articuloModal"
              style="position:relative; rigth:100px;"
            >Crear Articulo</button>
            <div class="alert alert-secondary" role="alert">
  Total rentabilidad: {{totalRentabilidad}}
</div>
          </div>
          <form >
            <div class="form-inline my-2 my-lg-0 md-4">
            <div class="card">
  <div class="card-header">
            <input
              class="form-control mr-sm-2"
              type="text"
              placeholder="Codigo"
              id="busqueda" 
               v-on:keyup="myFunction()"
              aria-label="Search"
            />
             <input
              class="form-control mr-sm-2"
              type="text"
              placeholder="Nombre"
              id="busqueda2" 
               v-on:keyup="myFunction2()"
              aria-label="Search"
            />
             <input
              class="form-control mr-sm-2"
              type="text"
              placeholder="Stock"
              id="busqueda3" 
               v-on:keyup="myFunction3()"
              aria-label="Search"
            />
             <input
              class="form-control mr-sm-2"
              type="text"
              placeholder="Estado"
              id="busqueda4" 
               v-on:keyup="myFunction4()"
              aria-label="Search"
            />
          
<!--v-on:keyup="myFunction()"-->

<div class="card-body">
          <div class="container-fluid">
            <div class="table-responsive">
          <table class="table table table-striped" id="myTable" >
            <caption>Lista Articulos Precio</caption>
            <thead>
              <tr>
                <th scope="col">#</th>

                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Stock</th>
                <th scope="col">Descripcion</th>  
                <th scope="col">Precio compra</th>
                <th scope="col">Precio Venta</th>
                <th scope="col">Rentabilidad</th>
                <th scope="col">Estado</th>
                <th scope="col">Acción  </th>
                
              </tr>
            </thead>
            <tbody >
              <tr class="animated fadeIn" v-for="consul in articulosPre" :key="consul.id">
                <td scope="row"></td>
                <td v-text="consul.codigo"></td>
                <td v-text="consul.nombre"></td>
                <td>{{consul.stock}}</td>
                <td v-text="consul.descripcion"></td>
                <td v-text="consul.precio_comrpa"></td>
                  <td v-text="consul.precio_venta"></td>
                  <td v-text="consul.precio_venta-consul.precio_comrpa"> </td>
                <td>  <div v-if="consul.stock <=5&&consul.stock >0">
                    <img src="img/advertencia.png" height="20" style="position:relative; ">
                  </div>
                  <div v-else-if="consul.stock>5">
 <img src="img/signo_acepto.png" height="20" style="position:relative; ">

                  </div>
                  <div v-else-if="consul.stock ==0">
                  <img src="img/advertencia1.png" height="20" style="position:relative; ">
                  </div>
                  </td>
<div v-if="rol==1">
                <td >
                   <div class="form-group col-md-4">
                  <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#dialogoPreguntar"
                    v-on:click.prevent="traerArticuloEditar(consul)"
                  >Editar</button>&nbsp;
                   <button
                    type="button"
                    style="position:relative; rigth:200px;"
                    class="btn btn-danger"
                     data-toggle="modal"
                    data-target="#dialogoEliminar"
                    v-on:click.prevent="traerArticuloid(consul)"
                  >Eliminar</button>
                   </div>
                </td>
</div>
<div v-else-if="rol==2">
 <td>
                   
                  <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#dialogoVer"
                    v-on:click.prevent="traerArticuloEditar(consul)"
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
    <!--inicia el otro -->
     <div class="card">
  <div class="card-header">
    <div class="card-body">
      <input
              class="form-control mr-sm-2"
              type="text"
              placeholder="Codigo"
              id="busqueda5" 
               v-on:keyup="myFunction5()"
              aria-label="Search"
            />
             <input
              class="form-control mr-sm-2"
              type="text"
              placeholder="Nombre"
              id="busqueda6" 
               v-on:keyup="myFunction6()"
              aria-label="Search"
            />
             <input
              class="form-control mr-sm-2"
              type="text"
              placeholder="Stock"
              id="busqueda7" 
               v-on:keyup="myFunction7()"
              aria-label="Search"
            />
             <input
              class="form-control mr-sm-2"
              type="text"
              placeholder="Estado"
              id="busqueda8" 
               v-on:keyup="myFunction8()"
              aria-label="Search"
            />
          <div class="container-fluid">
            <div class="table-responsive">
          <table class="table table table-striped" id="myTable2" >
            <caption>Lista Articulos</caption>
            <thead>
              <tr>
                <th scope="col">#</th>

                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Stock</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Estado</th>
                <th scope="col">Acción</th>
              </tr>
            </thead>
            <tbody >
              <tr class="animated fadeIn" v-for="consul in articulosSin" :key="consul.id">
                <td scope="row"></td>
                <td v-text="consul.codigo"></td>
                <td v-text="consul.nombre"></td>
                <td>{{consul.stock}}</td>
                <td v-text="consul.descripcion"></td>
                <td>  <div v-if="consul.stock <=5 && consul.stock>0">
                    <img src="img/advertencia.png" height="20" style="position:relative; ">
                  </div>
                  <div v-else-if="consul.stock>5">
 <img src="img/signo_acepto.png" height="20" style="position:relative; ">

                  </div>
                  <div v-else-if="consul.stock ==0">
                  <img src="img/advertencia1.png" height="20" style="position:relative; ">
                  </div>
                  </td>
                <div v-if="rol==1">
                <td>
                   
                  <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#dialogoPreguntar"
                    v-on:click.prevent="traerArticuloEditar(consul)"
                  >Editar</button>
                  <button
                    type="button"
                    class="btn btn-danger"
                     data-toggle="modal"
                    data-target="#dialogoEliminar"
                    v-on:click.prevent="traerArticuloid(consul)"
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
                    v-on:click.prevent="traerArticuloEditar(consul)"
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
     </div>
    </form>
        
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
                  <option value="2">des-habilitado</option>
                  <!--<option value="3">Agotado</option>-->
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
                  <option value="2">des-habilitado</option>
                  <!--<option value="3">Agotado</option>-->
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
            <h5 class="modal-title" id="exampleModalLabel">Editar Articulo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form>
            <div class="modal-body">
              <div class="form-group">
                <label for="formGroupExampleInput">codigo</label>
                <input disabled
                  type="number"
                  class="form-control"
                  v-model="codigoEditar"
                  id="formGroupExampleInput"
                  placeholder="codigo"
                />
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Categoria</label>
                <select disabled class="form-control" id="categoria" v-model="categoriaEditar" required>
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
                <select disabled
                  class="form-control"
                  id="exampleFormControlSelect1"
                  v-model="estadoEditar"
                  required
                >
                  <option disabled value="0">seleccionar</option>
                  <option value="1">Activado</option>
                  <option value="2">des-habilitado</option>
                  <!--<option value="3">Agotado</option>-->
                </select>
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">Nombre Articulo</label>
                <input disabled
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
                  <input disabled
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
                <input disabled
                  type="text"
                  class="form-control"
                  id="formGroupExampleInput"
                  v-model="descripcionEditar"
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
        <button type="button" class="btn btn-danger" data-dismiss="modal" v-on:click.prevent="limpiar()">Ok</button>
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
        <p>Se {{respuesta}} correctamnte</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click.prevent="limpiar()">Ok</button>
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
        <h5 class="modal-title">¡Pregunta!</h5>
        <button type="button" class="close" v-on:click.prevent="limpiar()" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Seguro que desea editar el articulo {{this.nombreEditar}}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click.prevent="limpiar()">No</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-dismiss="modal" data-target="#articuloeditarModal">Si</button>
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
        <h5 class="modal-title">¡Pregunta!</h5>
        <button type="button" class="close" v-on:click.prevent="limpiar()" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Seguro que desea eliminar el articulo {{this.nombre}}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click.prevent="limpiar()">No</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click.prevent="eliminarArticulo()">Si</button>
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
      articulosPre:[],
      articulosSin:[],
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
      id: 0,
      respuesta:"",
      error:"",
      userid: this.username,
      rol:0,
      rol2:[],
      totalRentabilidad:0
    };
  },
props:["username"],
  methods: {
    asignarId(){
      var consultaCate=this;
      console.log(this.username);
     axios.post("api/getDataPermise", {id: this.userid}).then(response=>{
       consultaCate.rol2 = response.data;
console.log(consultaCate.rol2[0].id_rol);
var rol=consultaCate.rol2[0].id_rol;
//console.log(this.rol);
this.prueba(rol);
     });
     console.log("si");
},prueba(rol){

this.rol = rol;
console.log(this.rol);
},
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
          this.respuesta="Edito";
          $("#respuesta").modal("show");
        }).catch(error=>{
   this.error=error.response;
    $("#error").modal("show");
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
         this.respuesta="Guardo";
          $("#respuesta").modal("show");
        }).catch(error=>{
   this.error=error.response;
    $("#error").modal("show");
        });
    },
    traerArticuloid(consul){
this.id = consul.id,
this.nombre = consul.nombre
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
        for (let index = 0; index < meconsulta.consulta.length; index++) {
          
          if(meconsulta.consulta[index].items_null_c==null){
console.log(meconsulta.consulta[index].precio_venta);
meconsulta.articulosPre[index] = meconsulta.consulta[index];
meconsulta.totalRentabilidad=meconsulta.consulta[index].precio_venta+meconsulta.consulta[index].precio_comrpa;
          }else{

meconsulta.articulosSin = meconsulta.consulta[index].items_null_c;
          }
          
        }
        console.log(meconsulta.articulosSin);
        console.log(meconsulta.articulosPre);
        //console.log(meconsulta.consulta[6].items_null_c);
        }).catch(error=>{
   this.error=error.response;
    $("#error").modal("show");
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
        // console.log(consultaEstad.consulest);
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
    eliminarArticulo() {
      axios
        .post("api/eliminarArticulo", {
          id: this.id
        })
        .then(response => {
          this.addArticulo();
          this.limpiar();
        this.respuesta="Elimino";
          $("#respuesta").modal("show");
        }).catch(error=>{
   this.error=error.response;
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
 },
 myFunction2() {
     var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("busqueda2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
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
 myFunction3() {
     var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("busqueda3");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
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
 myFunction4() {
     var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("busqueda4");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[7];
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

 myFunction5() {
     var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("busqueda5");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
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
 },
 myFunction6() {
     var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("busqueda6");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
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
 myFunction7() {
     var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("busqueda7");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
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
 myFunction8() {
     var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("busqueda8");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[5];
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
    this.addArticulo();
    this.addcategoria();
    this.addestado();
    
  }
  //FUNCION DONDE CARGAR LOS METOS UTLIZADOS PARA ESTE COMPONENTE
};
</script>
<style>
</style>


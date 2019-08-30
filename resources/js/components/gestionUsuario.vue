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
            >Crear Usuario</button>
          </div>
          <form class="form-inline my-2 my-lg-0 md-2">
            <input
              class="form-control mr-sm-2"
              type="text"
              placeholder="Nombre de usuario"
              id="busqueda" 
               v-on:keyup="myFunction()"
              aria-label="Search"
            />
          </form>
          <!--<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>-->
 <div class="card-body">
          <div class="container-fluid">
            <div class="table-responsive">
          <table class="table table table-striped" id="myTable">
            <caption>Lista de usuarios</caption>
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">rol</th>
                <th scope="col">Editar</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Eliminar</th>
              </tr>
            </thead>
            <tbody>
              <tr class="animated fadeIn" v-for="consul in consulta" :key="consul.id" >
                
                <th scope="row"></th>
                <td v-text="consul.name"></td>
                <td v-text="consul.email"></td>
                <td v-text="consul.rol"></td>
                <td>
                  <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#dialogoPreguntar"
                    v-on:click.prevent="traerUsuarioEditar(consul)"
                  >Editar</button>
                </td>

                    <td>
                  <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#dialogoPreguntarContraseña"
                    v-on:click.prevent="traerUsuarioEditar(consul)"
                  >Editar Contraseña</button>
                </td>
                <td>
                  <section v-if="consul.id == id_user">
                    <button type="button" class="btn btn-danger" disabled>Eliminar</button>
                  </section>
                  <section v-else>
                    <button
                      type="button"
                      class="btn btn-danger"
                        data-toggle="modal"
                    data-target="#dialogoEliminar"
                      v-on:click.prevent="traerUsuarioEditar(consul)"
                    >Eliminar</button>
                  </section>
                </td>
           
              </tr>
            </tbody>
          </table>
            </div>
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
            <h5 class="modal-title" id="exampleModalLabel">Crear Usuario</h5>
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
                <label for="formGroupExampleInput">Contraseña</label>
                <input
                  type="password"
                  class="form-control"
                  id="formGroupExampleInput"
                  v-model="contraseña"
                  placeholder="Contraseña"
                />
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">Correo</label>
                <input
                  type="email"
                  class="form-control"
                  id="formGroupExampleInput"
                  v-model="correo"
                  placeholder="Email"
                />
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">Nombre</label>
                <input
                  type="text"
                  class="form-control"
                  id="formGroupExampleInput"
                  v-model="nombre"
                  placeholder="Nombre"
                />
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">Apellido</label>
                <input
                  type="text"
                  class="form-control"
                  id="formGroupExampleInput"
                  v-model="apellido"
                  placeholder="apellido"
                />
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Rol</label>
                <select class="form-control" id="exampleFormControlSelect1" v-model="rol">
                  <option disabled value="0">seleccionar</option>
                  <option value="1">Admin</option>
                  <option value="2">Vendedor</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <div
                v-if=" nombre==''||contraseña==''|| correo==''|| nombre==''|| apellido=='' || rol==0"
              >
                FALTAN CAMPOS POR LLENAR
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                  v-on:click="limpiar()"
                >Cerrar</button>
                <button type="submit" disabled class="btn btn-primary" data-dismiss="modal">Guardar</button>
              </div>
              <div
                v-else-if=" nombre!='' && contraseña!='' && correo!='' && nombre!='' && apellido!='' &&  rol!=0 "
              >
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                  v-on:click="limpiar()"
                >Cerrar</button>
                <button
                  type="button"
                  v-on:click.prevent="guardarUsuario()"
                  data-dismiss="modal"
                  class="btn btn-primary"
                >Guardar</button>
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
                <label for="formGroupExampleInput">Correo</label>
                <input
                  type="email"
                  class="form-control"
                  id="formGroupExampleInput"
                  v-model="correo_editar"
                  placeholder="Email"
                />
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">Nombre Y Apellido</label>
                <input
                  type="text"
                  class="form-control"
                  id="formGroupExampleInput"
                  v-model="nombre_usuario_editar"
                  placeholder="Nombre y Apellido"
                />
              </div>

              <div class="form-group">
                <label for="exampleFormControlSelect1">Rol</label>
                <select class="form-control" id="exampleFormControlSelect1" v-model="rol_editar">
                  <option disabled value="0">seleccionar</option>
                  <option value="1">Admin</option>
                  <option value="2">Vendedor</option>
                </select>
              </div>
            </div>

            <div class="modal-footer">
              <div
                v-if="nombre_usuario_editar=='' || nombre_editar==''|| correo_editar==''|| nombre_editar==''|| apellido_editar==''|| rol_editar==0"
              >
                FALTAN CAMPOS POR LLENAR
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                  v-on:click="limpiar()"
                >Cerrar</button>
                <button type="submit" disabled class="btn btn-primary" data-dismiss="modal">Guardar</button>
              </div>
              <div
                v-else-if="nombre_usuario_editar!='' && nombre_editar!=''&&  correo_editar!=''&& nombre_editar!=''&& apellido_editar!=''&&  rol_editar!=0 "
              >
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                  v-on:click="limpiar()"
                >Cerrar</button>
                <button
                  type="button"
                  v-on:click.prevent="Editarusuario()"
                  data-dismiss="modal"
                  class="btn btn-primary"
                >Guardar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- fin del modal-->
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
        <p>Seguro que desea eliminar el usuario {{this.nombre_usuario_editar}}?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click.prevent="limpiar()">No</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click.prevent="eliminarUsuario()">Si</button>
      </div>
    </div>
  </div>
</div>
<!--fin modal preguntar -->
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
        <p>Seguro que desea editar el usuario {{this.nombre_usuario_editar}}.

        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click.prevent="limpiar()">No</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-dismiss="modal" data-target="#articuloeditarModal">Si</button>
      </div>
    </div>
  </div>
</div>
<!--fin modal preguntar -->
<!-- model preguntar -->
<div class="modal" tabindex="-1" id="dialogoPreguntarContraseña" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">¡Pregunta!</h5>
        <button type="button" class="close" v-on:click.prevent="limpiar()" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Seguro que desea editar la contraseña del usuario {{this.nombre_usuario_editar}}.

        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click.prevent="limpiar()">No</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-dismiss="modal" data-target="#editarContraseña">Si</button>
      </div>
    </div>
  </div>
</div>
<!--fin modal preguntar -->
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
<div class="modal" tabindex="-1" id="error" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">¡Alerta!</h5>
        <!--<button type="button" class="close" v-on:click.prevent="limpiar()" data-dismiss="modal" aria-label="Close">-->
          <!--<span aria-hidden="true">&times;</span>-->
        
      </div>
      <div class="modal-body">
        <p>Se presento un error revisa lo que escribiste o comunicate con el desarrollador
          <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    Informacion del error
  </a>
        </p>

        <div class="collapse" id="collapseExample">
  <div class="card card-body">
    {{error}}
  </div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" v-on:click.prevent="limpiar()">Ok</button>
      </div>
    </div>
  </div>
</div>

<!--respuesta -->
<div class="modal" tabindex="-1" id="editarContraseña" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">¡Editar contraseña a {{nombre_usuario_editar}}!</h5>
        <!--<button type="button" class="close" v-on:click.prevent="limpiar()" data-dismiss="modal" aria-label="Close">-->
          <!--<span aria-hidden="true">&times;</span>-->
        
      </div>
      <div class="modal-body">
        <div class="form-group">
                <label for="formGroupExampleInput">Contraseña</label>
                <input
                  type="password"
                  class="form-control"
                  id="formGroupExampleInput"
                  v-model="contraseña_editar"
                  placeholder="Contraseña"
                />
              </div>
           
      </div>
      <div class="modal-footer">
           <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                  v-on:click="limpiar()"
                >Cerrar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click.prevent="editarcontraseña()">Ok</button>
      </div>
    </div>
  </div>
</div>
<!--fin modal respuesta -->
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
      nombre_usuario: "",
      contraseña: "",
      correo: "",
      nombre: "",
      apellido: "",
      rol: 0,
      id: 0,
      nombre_usuario_editar: "",
      contraseña_editar: "",
      correo_editar: "",
      nombre_editar: "",
      apellido_editar: "",
      rol_editar: 0,
      id_user: this.username,
      seleccion:0,
      respuesta:"",
      error:""
    };
  },
  props: ["username"],

  methods: {
    editarcontraseña(){
 axios
        .post("api/editarcontraseña", {
          id: this.id,
        //  nombre_usuario: this.nombre_usuario_editar,
          contraseña: this.contraseña_editar
          
        })
        .then(response => {
          this.respuesta="Edito la contraseña";
          $("#respuesta").modal("show");
          this.addUsuario();
          this.contraseña_editar="";
        }).catch(error=>{
   this.error=error.response;
    $("#error").modal("show");
        });
    },
    Editarusuario() {
      console.log(this.id);
    axios
        .post("api/editarusuario", {
          id: this.id,
        //  nombre_usuario: this.nombre_usuario_editar,
          correo: this.correo_editar,
          nombre: this.nombre_usuario_editar,
          rol: this.rol_editar
          
        })
        .then(response => {
          this.respuesta="Edito";
          $("#respuesta").modal("show");
          this.addUsuario();
          this.contraseña_editar="";
        }).catch(error=>{
   this.error=error.response;
    $("#error").modal("show");
        });

    },
    guardarUsuario() {
      let iden = this.identificacion;

      axios
        .post("api/guardarusuario", {
          contraseña: this.contraseña,
          correo: this.correo,
          nombre: this.nombre,
          apellido: this.apellido,
          rol: this.rol,
          contraseña: this.contraseña
        })
        .then(response => {
          this.contraseña = "";
          this.correo = "";
          this.nombre = "";
          this.apellido = "";
          this.rol = 0;
          this.addUsuario();
          this.respuesta="Guardo";
          $("#respuesta").modal("show");
        }).catch(error=>{
   this.error=error.response;
    $("#error").modal("show");
        });
    },
    limpiar() {
      this.nombre_usuario = "";
      this.contraseña = "";
      this.correo = "";
      this.nombre = "";
      this.apellido = "";
      this.rol = 0;
    },
    /* seleccion(){
         let categoria = this.categoria;
          let sub = categoria.substring(0,1);
          this.selec= sub;
         },*/
    addUsuario() {
      let meconsulta = this;
      axios.post("api/usuario").then(function(response) {
        meconsulta.consulta = response.data;
       this.usuario();
      });
    },
    traerUsuarioEditar(consul) {
      this.nombre_usuario_editar = consul.name;
     // this.contraseña_editar = consul.password;
      this.correo_editar = consul.email;
      this.nombre_editar = consul.nombre_user;
      this.apellido_editar = consul.apellido_user;
      this.rol_editar = consul.id_rol;
      this.id = consul.id;
      //console.log(this.id);
    },
    eliminarUsuario() {
      //let id = this.id;
      //console.log(consul.id);
      axios
        .post("api/eliminarUsuario", {
          id: this.id
        })
        .then(response => {
          this.addUsuario();
          this.respuesta="ELimino";
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
  }
  },
  created() {},

  mounted() {
    this.addUsuario();
  }
  //FUNCION DONDE CARGAR LOS METOS UTLIZADOS PARA ESTE COMPONENTE
};
</script>
<style>
</style>


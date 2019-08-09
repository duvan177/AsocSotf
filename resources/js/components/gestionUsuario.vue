<template>
  <main class="main">

    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
      
             <div class="form-group col-md-2">
                
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#articuloModal"  style="position:relative; rigth:100px;">Crear Usuario</button>

                </div>
 <!--<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>-->
                
           
                <table class="table">
                <caption>Lista de usuarios</caption>
                <thead>
                  <tr>
                    <th scope="col">#</th>            
                     <th scope="col">Nombre</th>
               <th scope="col">Correo</th>
                 <th scope="col">rol</th>
               <th scope="col">Editar</th>
               <th scope="col">Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="consul in consulta" :key="consul.id">
                    <th scope="row"></th>
                    <td v-text="consul.name"></td>
                      <td v-text="consul.email"></td>
                    <td v-text="consul.rol"></td>
                    <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#articuloeditarModal" v-on:click.prevent="traerUsuarioEditar(consul)">Editar</button></td>
                     <td><button type="button" class="btn btn-danger" v-on:click.prevent="eliminarUsuario(consul)" >Eliminar</button></td>
                  </tr>
                </tbody>
              </table>
        </div>
      </div>
    </div>
    <!-- Modal de categoria -->
<div class="modal fade" id="articuloModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" v-on:click="limpiar()" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  <form>
      <div class="modal-body">

      <div class="form-group">
    <label for="formGroupExampleInput">Contraseña</label>
    <input type="password" class="form-control" id="formGroupExampleInput" v-model="contraseña" placeholder="Contraseña" >
  </div>
    <div class="form-group">
    <label for="formGroupExampleInput">Correo</label>
    <input type="email" class="form-control" id="formGroupExampleInput" v-model="correo" placeholder="Email" >
  </div>
   <div class="form-group">
    <label for="formGroupExampleInput">Nombre</label>
    <input type="text" class="form-control" id="formGroupExampleInput" v-model="nombre" placeholder="Nombre" >
  </div>
   <div class="form-group">
    <label for="formGroupExampleInput">Apellido</label>
    <input type="text" class="form-control" id="formGroupExampleInput" v-model="apellido" placeholder="apellido" >

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
        <div v-if=" nombre==''||contraseña==''|| correo==''|| nombre==''|| apellido=='' || rol==0">
         FALTAN CAMPOS POR LLENAR
        <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="limpiar()">Cerrar</button>
        <button type="submit" disabled class="btn btn-primary" data-dismiss="modal">Guardar</button>
        
        </div>
        <div v-else-if=" nombre!=''&& contraseña!=''&& correo!=''&& nombre!=''&& apellido!='' && rol!=0 ">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="limpiar()">Cerrar</button>
          <button type="button" v-on:click.prevent="guardarUsuario()" data-dismiss="modal"  class="btn btn-primary" >Guardar</button>
        </div>
      </div>
  </form>
      </div>
    
    </div>
  </div>


<!-- fin del modal-->

  <!-- Modal de editar articulos -->
<div class="modal fade" id="articuloeditarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" v-on:click="limpiar()" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  <form>
      <div class="modal-body">
 
    
      <div class="form-group">
    <label for="formGroupExampleInput">Contraseña</label>
    <input type="password" class="form-control" id="formGroupExampleInput" v-model="contraseña_editar" placeholder="Contraseña" >
  </div>
    <div class="form-group">
    <label for="formGroupExampleInput">Correo</label>
    <input type="email" class="form-control" id="formGroupExampleInput" v-model="correo_editar" placeholder="Email" >
  </div>
   <div class="form-group">
    <label for="formGroupExampleInput">Nombre</label>
    <input type="text" class="form-control" id="formGroupExampleInput" v-model="nombre_editar" placeholder="Nombre" >
  </div>
   <div class="form-group">
    <label for="formGroupExampleInput">Apellido</label>
    <input type="text" class="form-control" id="formGroupExampleInput" v-model="apellido_editar" placeholder="apellido" >
  </div>

    <div class="form-group">
    <label for="exampleFormControlSelect1">Rol</label>
    <select class="form-control" id="exampleFormControlSelect1" v-model="rol_editar">
        <option disabled value="0">seleccionar</option>
      <option value="1">Operaciones</option>
      <option value="2">Inspector</option>
      <option value="3">Administrador</option>
    </select>
  </div>
  </div>
  
  <div class="modal-footer">
        
        <div v-if="nombre_usuario_editar=='' || nombre_editar==''||contraseña_editar==''|| correo_editar==''|| nombre_editar==''|| apellido_editar==''|| identificacion_editar=='' || rol_editar==0">
         FALTAN CAMPOS POR LLENAR
        <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="limpiar()">Cerrar</button>
        <button type="submit" disabled class="btn btn-primary" data-dismiss="modal">Guardar</button>
        
        </div>
        <div v-else-if="nombre_usuario_editar!='' && nombre_editar!=''&& contraseña_editar!=''&& correo_editar!=''&& nombre_editar!=''&& apellido_editar!=''&&  rol_editar!=0 ">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="limpiar()">Cerrar</button>
          <button type="button" v-on:click.prevent="Editarusuario()" data-dismiss="modal"  class="btn btn-primary" >Guardar</button>
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

        };
    },

    methods: {
        Editarusuario() {

            console.log(this.id);

            axios
                .post("api/editarusuario", {
                    id: this.id,
                    nombre_usuario: this.nombre_usuario_editar,
                    contraseña: this.contraseña_editar,
                    correo: this.correo_editar,
                    nombre: this.nombre_editar,
                    apellido: this.apellido_editar,
                    rol: this.rol_editar
                }).then(response => {
                    this.addUsuario();
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
                }).then(response => {

                    this.contraseña = "";
                    this.correo = "";
                    this.nombre = "";
                    this.apellido = "";
                    this.rol = 0;
                    this.addUsuario();
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
            axios
                .post("api/usuario")
                .then(function (response) {
                    meconsulta.consulta = response.data;

                });
        },
        traerUsuarioEditar(consul) {
            this.nombre_usuario_editar = consul.name;
            this.contraseña_editar = consul.password;
            this.correo_editar = consul.email;
            this.nombre_editar = consul.nombre_user;
            this.apellido_editar = consul.apellido_user;
            this.rol_editar = consul.rol_user;
            this.id = consul.id;
            //console.log(this.id);
        },
        eliminarUsuario(consul) {
            //let id = this.id;
            console.log(consul.id);
            axios.post("api/eliminarUsuario", {
                id: consul.id
            }).then(response => {
                this.addUsuario();
            });

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


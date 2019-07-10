<template>
  <main class="main">

    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <!--Formularios de venta -->
          <form>
            <!-- setcion del loading-->
            <section v-if="loading">
              <div class="lds-ring">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
              </div>
            </section>
              

            <!-- fin del loading-->


            <section v-else>

                 <!-- toast -->
                 
                 


                 
                      <!-- fin del toast-->



              <div class="form-row">
                <label>
                  <h5>Fecha</h5>
                </label>
                <div class="form-group col-md-2">
                  <input
                    class="form-control"
                    style="height:50"
                    id="fecha"
                    type="tex"
                    v-model="fecha"
                    readonly
                  />
                </div>
                <!-- numero de factura--->
                <label>
                  <h5>Numero Factura</h5>
                </label>
                <div class="form-group col-md-2">
                  <input
                    class="form-control"
                    style="height:50"
                    id="fecha"
                    type="tex"
                    v-model="num"
                    readonly
                  />
                </div>
              </div>
              <!--fin de numero de factua-->
              <div class="form-row">
          

                    <div class="form-group col-md-4">
                  <input
                    type="number"
                    class="form-control"
                    placeholder="Codigo del producto"
                    id="codProducto"
                    v-model="producto"
                  />
                </div>
                <div class="form-group col-md-2">
                  <input
                   
                    type="number"
                    class="form-control"
                    placeholder="cantidad"
                    v-on:keyup.enter="addArticulo"
                    v-model="cantidad"
                  />

                </div>
                 <div class="form-group col-md-2">
                
                <button type="button" class="btn btn-warning" >Warning</button>

                </div>
              
               
              </div>

              <!--inicio de tabla de los productos selecionados -->

              <table class="table">
                <caption>Lista de productos</caption>
                <thead>
                  <tr>
                    <th scope="col">#</th>
                   
                    <th scope="col">nombre</th>
                     <th scope="col">cantidad</th>
                    <th scope="col">precio unitario</th>
               
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="datos in consulta" :key="datos.id">
                    <th scope="row"></th>
            
                    <td v-text="datos.datos.nombre" ></td>
                     <td v-text="datos.cantidad" ></td>
                    <td v-text="datos.datos.precio_venta"></td>
                  </tr>
                </tbody>
              </table>

              <!-- fin de los productos selecionados -->

              <div class="form-row">
                <label>% Descuento</label>
                <div class="form-group col-md-2">
                  <input type="number" class="form-control" placeholder="%00" />
                </div>
                <label class="form-group col-md-6" style="left:380px; top:10px">
                  <h5>Total</h5>
                </label>
                <div class="form-group col-md-2">
                  <input type="number" class="form-control" style="left:300px" v-model="totalpagar"/>
                </div>
              </div>
              <button type="button" class="btn btn-success">Finalizar</button>
            </section>
          </form>

          <!-- fin del formulario de venta-->
        </div>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
      totalpagar:"",
      producto: "",
      cantidad: "",
      consulta: [],
      consultaFact:false,
       loading: true,
      num: [],
      fecha: ""
    };
  },
  
  //FUNCION DONDE CARGAR LOS METOS UTLIZADOS PARA ESTE COMPONENTE
  methods: {

     addArticulo() {
     //var insert = { producto: this.producto, cantidad: this.cantidad };
      // this.insertDatos.push(insert);
      //console.log(this.insertDatos);
      
      // TRAIGO LOS DATOS DE MI DATA PARA ASOCIARLOS LOCALMENTE Y DAR USO DE ELLOS PARA MANDAR PARAMETROS ETC

      let meconsulta = this;
      let cantidad = this.cantidad;
      let producto = this.producto;
       axios
        .post('/api/ver', {
          id:this.producto,
          cantidad:this.cantidad
        })
        .then(function(response) {
       if (response.data == 404){
             alert(response.data + ' El producto no se encuentra disponible');
            }else{
        var array_articulo = response.data;
        meconsulta.consulta.push(array_articulo);
        }
        })
        .catch(function(error) {
          // handle error
          console.log(error);
           })
        .then(function() {
          // always executed
        });
        //AL FINAL DE LA PETICION Y CARGAR LA TABLA ME DEJARA EN LIMPIO LOS CAMPOS PARA NUEVOS DATOS

      this.producto = "";
      this.cantidad = "";
       this.totalPagar();
     

    },

     totalPagar(){

      let arraytotal = this.consulta;
      
  },

    idUse() {},

    getFecha() {
       let fecha = this;
      axios
        .post("/api/fecha")
        .then(function(response) {
          fecha.fecha = response.data;
          console.log(datos);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
         
        })
        .then(function() {
          // always executed
        });
    },

    numero_factura() {
      let num = this;

      axios
        .post("/api/NumeroFactura")
        .then(function(response) {
          num.num = response.data;
          console.log(numfactura);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
          num.num = ' no hay facturas'
 
        })
        
        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.loading = false));
    }
  },
  //METODOS QUE SE CARGARAN CUANDO EL COMPONENTE SEA INVOCADO. IMPORTANTE PARA ALGUNOS DATOS QUE SE NECESITEN EN LA VISTA.
  mounted() {
    this.getFecha();
    this.numero_factura();
    
    
  }
};
</script>
<style>
</style>


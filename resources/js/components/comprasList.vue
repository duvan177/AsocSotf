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
          <form>
            <div class="form-row align-items-center">
              <div class="col-auto my-1">
                <label class="mr-sm-2" for="inlineFormCustomSelect">Preference</label>
                <select class="form-control" v-model="filtro">
                  <option disabled value>Selecciona tipo documento</option>
                  <option
                    v-for="optione in filtros"
                    v-bind:key="optione.value"
                    v-bind:value="optione.value"
                    v-text="optione.text"
                  ></option>
                </select>
              </div>
              <div class="col-auto my-1">
                <input
                  type="text"
                  class="form-control"
                  id="myInput"
                  v-on:keyup="myFunction"
                  placeholder="Buscar..."
                />
              </div>
            </div>
          </form>
          <div class="table-wrapper-scroll-y my-custom-scrollbar">
            <table id="myTable" class="table table-hover table-responsive mt-2">
              <!--Table head-->
              <thead>
                <tr class="animated fadeIn">
                  <th>#</th>
                  <th>Proveedor</th>

                  <th>Numero Comprobane</th>
                  <th>Articulo</th>
                  <th>Cantidad</th>
                  <th>Precio Compra</th>
                  <th>Precio venta</th>
                  <th>Total Compra</th>
                  <th>Estado Compra</th>
                  <th>Fecha</th>
                </tr>
              </thead>
              <!--Table head-->
              <!--Table body-->
              <tbody>
                <tr class="animated fadeIn" v-for="compras in lista_compras" :key="compras.id">
                  <th scope="row">1</th>
                  <td v-text="compras.persona[0]['nombre']"></td>
                  <td v-text="compras.ingreso[0]['num_comprobante']"></td>
                  <td v-text="compras.articulo[0]['nombre']"></td>
                  <td v-text="compras.cantidad"></td>
                  <td v-text="compras.precio_comrpa"></td>
                  <td v-text="compras.precio_venta"></td>
                  <td v-text="compras.precio_comrpa * compras.cantidad"></td>
                  <td v-text="compras.ingreso[0]['id_estado']"></td>
                  <td v-text=" compras.created_at"></td>
                </tr>
              </tbody>

              <!--Table body-->
            </table>
          </div>
          <div class="card" style="width: 18rem;">
            <div class="card-header">Total Compras</div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">{{result}}</li>
            </ul>
          </div>
          <!--Table-->

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
      filtros: [
        { text: "Poveedor", value: 0 },
        { text: "numero comprobante", value: 1 },
        { text: "Articulo", value: 2 },
        { text: "Cantidad", value: 3 },
        { text: "Precio Compra", value: 4 },
        { text: "Precio Venta", value: 5 },
        { text: "Total Compra", value: 6 },
        { text: "Estado ", value: 7 },
        { text: "Fecha", value: 8 }
      ],
      filtro: "",
      mensage: "hola",
      lista_compras: [],
      totalCompra: "",
      totalCompras: "",
      valido: false
      //
    };
  },

  methods: {
    myFunction() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[this.filtro];
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
    listCompras() {
      let lis = this;
      axios
        .post("/api/setIngresosTodo")
        .then(function(response) {
          lis.lista_compras = response.data;
          // console.log(response.data);
        })
        .catch(function(error) {
          // handle error
          // console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.loading = false));
    },

    ValorCompraTotal() {
      let mecompra = this;
      axios
        .post("/api/getTotal_Compras")
        .then(function(response) {
          mecompra.totalCompra = response.data;
          // console.log(response.data);
        })
        .catch(function(error) {
          // handle error
          // console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.loading = false));
    }
  },
  mounted() {
    this.listCompras();
    this.ValorCompraTotal();
  },
  computed: {
    result: function() {
      let totp = this;
      let rest = 0;
      let n = 0;
      let totalP = 0;
      let nd = 0;
      let tot = 0;
      this.lista_compras.forEach(element => {
        n = n + element.precio_comrpa * element.cantidad;
      });

      //n = String(n).replace(/\D/g, "");

      totp.totalCompras = n;

      return n === "" ? n : Number(n).toLocaleString();
    }
  }
};
</script>

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
                  />
                </div>
                <div class="form-group col-md-2">
                  <input type="number" class="form-control" placeholder="cantidad" />
                </div>
              </div>

              <!--inicio de tabla de los productos selecionados -->
              <table class="table">
                <caption>Lista de productos</caption>
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Producto</th>
                    <th scope="col">cantidad</th>
                    <th scope="col">precio unitario</th>
                    <th scope="col">total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>carne</td>
                    <td>2 libras</td>
                    <td>1</td>
                    <td>5000</td>
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
                  <input type="number" class="form-control" style="left:300px" />
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
      loading: true,
      num: [],
      fecha: ""
    };
  },

  methods: {
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
        })
        .then(function() {})
        .finally(() => (this.loading = false));
    }
  },
  mounted() {
    this.getFecha();
    this.numero_factura();
  }
};
</script>
<style>
</style>


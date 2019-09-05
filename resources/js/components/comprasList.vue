<template>
  <main class="main">
    <!-- Breadcrumb -->

    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i>
          Gestion de Compras
        </div>
        <div class="card-body">
          <nav>
            <div class="row mx-md-n5">
              <div class="col px-md-7">
                <div class="p-3 border">
                  <div class="form-group row"></div>

                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                      <a
                        class="nav-link active"
                        id="pills-home-tab"
                        data-toggle="pill"
                        href="#pills-home"
                        role="tab"
                        aria-controls="pills-home"
                        aria-selected="true"
                      >Buscar N.Comprobante</a>
                    </li>
                    <li class="nav-item">
                      <a
                        class="nav-link"
                        id="pills-profile-tab"
                        data-toggle="pill"
                        href="#pills-profile"
                        role="tab"
                        aria-controls="pills-profile"
                        aria-selected="false"
                      >Buscar por Fecha</a>
                    </li>
                    <li class="nav-item">
                      <a
                        class="nav-link"
                        id="pills-contact-tab"
                        data-toggle="pill"
                        href="#pills-contact"
                        role="tab"
                        aria-controls="pills-contact"
                        aria-selected="false"
                      >ver ventas por mes</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div
                      class="tab-pane fade show active"
                      id="pills-home"
                      role="tabpanel"
                      aria-labelledby="pills-home-tab"
                    >
                      <div class="col-md-6">
                        <input
                          v-model="num_comprob"
                          type="text"
                          id="texto2"
                          class="form-control"
                          placeholder="Comprobante a buscar"
                        />
                        <div class="input-group">
                          <input
                            v-model="num_comprob"
                            type="text"
                            id="texto"
                            class="form-control"
                            placeholder="Comprobante a buscar"
                          />
                          <button class="btn btn-primary" v-on:click=" buscar_comprobant">
                            <i class="fa fa-search"></i> Buscar
                          </button>
                          <div id="check" class="col-md-2">
                            <toggle-button
                              v-model="look_all"
                              :value="false"
                              color="#31B404"
                              :sync="true"
                              :labels="{checked: 'Ver todo', unchecked: 'Ver hoy'}"
                              :width="80"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="tab-pane fade"
                      id="pills-profile"
                      role="tabpanel"
                      aria-labelledby="pills-profile-tab"
                    >
                      <div class="col-md-6">
                        <input
                          id="texto2"
                          class="form-control"
                          type="date"
                          format="yyyy-MM-dd"
                          v-model="fecha_sh"
                        />
                        <div class="input-group">
                          <input
                            id="texto"
                            class="form-control"
                            type="date"
                            format="yyyy-MM-dd"
                            v-model="fecha_sh"
                          />
                          <button class="btn btn-primary" v-on:click="filtrar_fecha_c">
                            <i class="fa fa-search"></i> Fecha
                          </button>
                        </div>
                      </div>
                    </div>
                    <div
                      class="tab-pane fade"
                      id="pills-contact"
                      role="tabpanel"
                      aria-labelledby="pills-contact-tab"
                    >
                      <div class="col-md-6">
                        <input id="texto2" class="form-control" type="month" v-model="fecha_sh_m" />
                        <div class="input-group">
                          <input id="texto" class="form-control" type="month" v-model="fecha_sh_m" />
                          <button class="btn btn-primary" v-on:click="filtrar_mes_c">
                            <i class="fa fa-search"></i> Mes
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-hover table-striped mb-0">
                      <section v-if="cargando_2">
                        <div class="container">
                          <div id="preloader_1">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                          </div>
                        </div>
                      </section>
                      <section v-else>
                        <thead>
                          <tr>
                            <th>N° Comprobante</th>
                            <th>Proveedor</th>
                            <th>Tipo Comprobane</th>

                            <th>Total</th>
                            <th>Fecha y hora</th>
                            <th>Opciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr
                            :id="item.num_comprobante"
                            class="animated fadeIn"
                            v-for="item in lista_compras"
                            :key="item.id"
                          >
                            <td v-text="item.num_comprobante"></td>
                            <td v-text="item.nombre"></td>
                            <td v-text="item.Comprobante"></td>

                            <td v-text="item.total_compra.toLocaleString()"></td>
                            <td v-text="item.created_at"></td>
                            <td id="btn_t1">
                              <button
                                v-on:click="listCompras_detalles(item)"
                                type="button"
                                :id="item.id"
                                class="btn btn-primary btn-sm"
                              >
                                <i class="icon-info"></i> ver +
                              </button>
                            </td>
                            <td id="btn_t2">
                              <button
                                v-on:click="listCompras_detalles(item)"
                                type="button"
                                :id="item.id"
                                class="btn btn-primary btn-sm"
                                data-toggle="modal"
                                data-target="#modalNuevo"
                              >
                                <i class="icon-info"></i> ver +
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </section>
                    </table>
                  </div>
                  <div class="d-flex justify-content-between mb-4">
                    <p>Resumen de las compras generadas</p>
                    <p></p>

                    <h5 v-text="'Total Compras : $'+total_compra_ing"></h5>
                  </div>
                </div>
              </div>
              <div id="vents_f" class="col px-md-5">
                <div class="p-3 border">
                  <!-- Card -->
                  <div class="card weather-card">
                    <!-- cargando  -->

                    <!-- end cargando  -->

                    <!-- Card content -->
                    <div id="contenido" class="card-body pb-3" style="	height:640px">
                      <!-- Title -->
                      <div class="d-flex justify-content-between animated fadeIn">
                        <h4 class="card-title font-weight-bold">Compra</h4>
                        <!-- Text -->
                        <p class="card-text" v-text="'Fecha: '+ lista_info.created_at"></p>
                      </div>

                      <div class="d-flex justify-content-between animated fadeIn">
                        <h2 v-text="'N° '+ lista_info.num_comprobante"></h2>

                        <div class="chip chip-md"></div>
                        <div class="chip chip-md">
                          <img src="img/user_venta.png" alt="Contact Person" />
                          <h5 v-text="'Proveedor : '+ lista_info.nombre"></h5>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between mb-4">
                        <p>3% Precipitation</p>
                        <p></p>
                      </div>
                      <!--Card image-->
                      <!-- Table with panel -->
                      <section v-if="cargando">
                        <div class="container">
                          <div id="preloader_1">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                          </div>
                        </div>
                      </section>
                      <section v-else>
                        <div class="card card-cascade narrower">
                          <!--Card image-->
                          <div
                            class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center"
                          >
                            <div>
                              <a href class="white-text mx-3"></a>
                            </div>

                            <a href class="white-text mx-4">Contenido Compra</a>
                          </div>
                          <!--/Card image-->

                          <div class="px-4 animated fadeIn">
                            <div class="table-wrapper animated fadeIn">
                              <!--Table-->
                              <div class="table-wrapper-scroll-y my-custom-scrollbar3">
                                <section v-if="lista_info.length === 0">
                                  <img
                                    src="img\comprasx.png"
                                    class="rounded mx-auto d-block animated fadeIn"
                                    alt
                                  />
                                </section>
                                <section v-else>
                                  <table class="table table-hover mb-0 animated fadeIn">
                                    <!--Table head-->

                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Articulo</th>
                                        <th>cantidad</th>
                                        <th>Precio compra</th>
                                        <th>Precio venta</th>
                                        <th>Total</th>
                                      </tr>
                                    </thead>
                                    <!--Table head-->

                                    <!--Table body-->
                                    <tbody>
                                      <tr
                                        class="animated fadeIn"
                                        v-for="(item,index) in lista_detalles_"
                                        :key="item.id"
                                      >
                                        <td v-text="index + 1"></td>
                                        <td v-text="item.nombre"></td>
                                        <td v-text="item.cantidad"></td>
                                        <td v-text="item.precio_comrpa.toLocaleString()"></td>
                                        <td v-text="item.precio_venta.toLocaleString()"></td>
                                        <td
                                          v-text="(item.cantidad * item.precio_comrpa).toLocaleString()"
                                        ></td>
                                      </tr>
                                    </tbody>
                                    <!--Table body-->
                                  </table>
                                </section>
                              </div>
                              <!--Table-->
                              <div class="d-flex justify-content-between mb-4">
                                <h5 v-text="'Cantidad articulos: '+total_cant_c"></h5>
                                <p>
                                  <img src="img/venta_detalle.png" alt />
                                </p>

                                <h5 v-text="'Total compra : $'+total_compra.toLocaleString()"></h5>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                      <!-- Table with panel -->
                    </div>
                  </div>
                  <!-- Card -->
                </div>
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
            <h5></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Card -->
            <div class="card weather-card">
              <!-- cargando  -->

              <!-- end cargando  -->

              <!-- Card content -->
              <div id="contenido" class="card-body pb-3" style="	height:640px">
                <!-- Title -->
                <div class="d-flex justify-content-between animated fadeIn">
                  <h4 class="card-title font-weight-bold">Compra</h4>
                  <!-- Text -->
                  <p class="card-text" v-text="'Fecha: '+ lista_info.created_at"></p>
                </div>

                <div class="d-flex justify-content-between animated fadeIn">
                  <h2 v-text="'N° '+ lista_info.num_comprobante"></h2>

                  <div class="chip chip-md"></div>
                  <div class="chip chip-md">
                    <img src="img/user_venta.png" alt="Contact Person" />
                    <h5 v-text="'Proveedor : '+ lista_info.nombre"></h5>
                  </div>
                </div>
                <div class="d-flex justify-content-between mb-4">
                  <p>3% Precipitation</p>
                  <p></p>
                </div>
                <!--Card image-->
                <!-- Table with panel -->
                <section v-if="cargando">
                  <div class="container">
                    <div id="preloader_1">
                      <span></span>
                      <span></span>
                      <span></span>
                      <span></span>
                      <span></span>
                    </div>
                  </div>
                </section>
                <section v-else>
                  <div class="card card-cascade narrower">
                    <!--Card image-->
                    <div
                      class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center"
                    >
                      <div>
                        <a href class="white-text mx-3"></a>
                      </div>

                      <a href class="white-text mx-4">Contenido Compra</a>
                    </div>
                    <!--/Card image-->

                    <div class="px-4 animated fadeIn">
                      <div class="table-wrapper animated fadeIn">
                        <!--Table-->
                        <div class="table-wrapper-scroll-y my-custom-scrollbar3">
                          <section v-if="lista_info.length === 0">
                            <img
                              src="img\comprasx.png"
                              class="rounded mx-auto d-block animated fadeIn"
                              alt
                            />
                          </section>
                          <section v-else>
                            <table class="table table-hover mb-0 animated fadeIn">
                              <!--Table head-->

                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Articulo</th>
                                  <th>cantidad</th>
                                  <th>Precio compra</th>
                                  <th>Precio venta</th>
                                  <th>Total</th>
                                </tr>
                              </thead>
                              <!--Table head-->

                              <!--Table body-->
                              <tbody>
                                <tr
                                  class="animated fadeIn"
                                  v-for="(item,index) in lista_detalles_"
                                  :key="item.id"
                                >
                                  <td v-text="index + 1"></td>
                                  <td v-text="item.nombre"></td>
                                  <td v-text="item.cantidad"></td>
                                  <td v-text="item.precio_comrpa.toLocaleString()"></td>
                                  <td v-text="item.precio_venta.toLocaleString()"></td>
                                  <td
                                    v-text="(item.cantidad * item.precio_comrpa).toLocaleString()"
                                  ></td>
                                </tr>
                              </tbody>
                              <!--Table body-->
                            </table>
                          </section>
                        </div>
                        <!--Table-->
                        <div class="d-flex justify-content-between mb-4">
                          <h5 v-text="'Cantidad articulos: '+total_cant_c"></h5>
                          <p>
                            <img src="img/venta_detalle.png" alt />
                          </p>

                          <h5 v-text="'Total compra : $'+total_compra.toLocaleString()"></h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <!-- Table with panel -->
              </div>
            </div>
            <!-- Card -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
      fecha: "",
      look_all: true,
      filtro: "",
      mensage: "hola",
      lista_compras: [],
      lista_detalles_: [],
      lista_info: [],
      totalCompra: "",
      totalCompras: "",
      valido: false,
      //

      cargando_2: false,
      cargando: false,
      cambio: "",
      total_compra: "",
      num_comprob: "",
      total_compra_ing: "",
      fecha_sh: "",
      fecha_sh_m: "",
      fecha_hoy: "",
      total_cant_c: 0
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
    filtrar_mes_c() {
      this.cargando_2 = true;
      let meventa = this;
      if (this.fecha_sh_m == "") {
        alert("complete los datos");
        this.cargando_2 = false;
      } else {
        axios
          .post("/api/compra_x_mes", {
            fecha: this.fecha_sh_m
          })
          .then(function(response) {
            if (response.data == 404) {
              alert("no existe esta factura en esta fecha");
            } else {
              meventa.lista_compras = response.data;
              console.log(response.data);
            }
          })
          .catch(function(error) {
            // handle error
            console.log(error);
          })

          .then(function() {})
          //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
          //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
          .finally(() => (this.cargando_2 = false));

        /*  this.ventas =  this.ventas.filter(function(venta){
         return venta.num_comprobante == 1004;
      });*/
      }
    },
    filtrar_fecha_c() {
      this.cargando_2 = true;
      let meventa = this;
      if (this.fecha_sh == "") {
        alert("complete los datos");
        this.cargando_2 = false;
      } else {
        axios
          .post("/api/compra_x_fecha", {
            fecha: this.fecha_sh
          })
          .then(function(response) {
            if (response.data == 404) {
              alert("no existe esta factura en esta fecha");
            } else {
              meventa.lista_compras = response.data;
              // console.log(response.data);
            }
          })
          .catch(function(error) {
            // handle error
            console.log(error);
          })

          .then(function() {})
          //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
          //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
          .finally(() => (this.cargando_2 = false));

        /*  this.ventas =  this.ventas.filter(function(venta){
         return venta.num_comprobante == 1004;
      });*/
      }
    },
    listCompras() {
      let lis = this;
      let me_total = this;
      this.cargando_2 = true;
      axios
        .post("/api/todo_compras")
        .then(function(response) {
          lis.lista_compras = response.data;
        })
        .catch(function(error) {
          // handle error
          // console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.cargando_2 = false));
    },
    listCompras_detalles(item) {
      let lis = this;
      let metotal = this;
      let mecantd = this;

      this.cambio = item;
      this.lista_info = item;
      var tr = document.getElementById("" + item.num_comprobante + "");
      tr.classList.add("table-warning");

      var x = document.getElementById("" + item.id + "");
      x.disabled = true;
      x.classList.add("active");
      this.cargando = true;
      axios
        .post("/api/todo_compras_x", {
          id_ingreso: item.id
        })
        .then(function(response) {
          let totalc = 0;
          let total_ctd = 0;
          lis.lista_detalles_ = response.data;
          response.data.forEach(element => {
            totalc += element.precio_comrpa * element.cantidad;
            total_ctd += element.cantidad;
          });
          metotal.total_compra = totalc;
          mecantd.total_cant_c = total_ctd;
        })
        .catch(function(error) {
          console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => ((x.disabled = false), (this.cargando = false)));
    },

    compra_fecha(date) {
      let mecompra = this;
      this.cargando_2 = true;
      axios
        .post("/api/compra_x_fecha", {
          fecha: date
        })
        .then(function(response) {
          mecompra.lista_compras = response.data;
        })
        .catch(function(error) {
          // handle error
          // console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.cargando_2 = false));
    },
    buscar_comprobant() {
      let mecompra = this;

      axios
        .post("/api/compra_x", {
          num_comp: this.num_comprob
        })
        .then(function(response) {
          mecompra.lista_compras = response.data;
          console.log(response.data);
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

    addZero(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    }
  },
  mounted() {
    this.listCompras();
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
  },
  watch: {
    num_comprob: function(Val) {
      if (Val == "" && this.look_all == true) {
        this.listCompras();
      }
      if (Val == "" && this.look_all == false) {
        this.compra_fecha(this.fecha_hoy);
      }
    },
    cambio: function(newVal, oldVal) {
      if (oldVal.id > 0) {
        var x = document.getElementById("" + oldVal.id + "");

        var tr = document.getElementById("" + oldVal.num_comprobante + "");
        if (x == null) {
        } else {
          x.classList.remove("active");
          tr.classList.remove("table-warning");
        }
      }
    },
    lista_compras: function(val) {
      let total = 0;
      val.forEach(element => {
        total += element.total_compra;
      });
      console.log(val.length);
      this.total_compra_ing = total.toLocaleString();
    },
    look_all: function(Val) {
      let fechaA = new Date();
      var dd = fechaA.getDate();
      var mm = fechaA.getMonth() + 1;
      var yyyy = fechaA.getFullYear();
      dd = this.addZero(dd);
      mm = this.addZero(mm);
      let hoy = yyyy + "-" + mm + "-" + dd;
      this.fecha_hoy = hoy;
      if (Val == false) {
        this.compra_fecha(hoy);
      } else {
        this.listCompras();
      }
    },
    fecha_sh: function(Val) {
      if (Val == "") {
        this.listCompras();
      }
    }
  }
};
</script>

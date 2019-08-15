<template>
  <div class="row">
    <div class="col-sm-6">
      <div id="card_escritorio1" class="card">
        <div class="card-body">
          <img id="fondo_naranja" src="img/fondo_naranja.png" class="card-img-top" alt />
          <img id="fondo_compras" src="img/compras_escritorio.jpg" class="card-img" alt />
          <div class="card-body">
            <h5 id="titulo_escritorio" class="card-title">Compras</h5>
            <h5 id="datos_escritorio" class="card-title">Total generado :</h5>
          </div>
        </div>
      </div>

      <div id="card_escritorio1" class="card">
        <div id="cardx" class="card-body">
          <img id="fondo_naranja" src="img/fondo_verde.png" class="card-img-top" alt />
          <img id="fondo_compras" src="img/ventas_escritorio.png" class="card-img" alt />
          <div class="card-body">
            <h5 id="titulo_escritorio" class="card-title">Ventas</h5>
            <h5 id="datos_escritorio" class="card-title">Total generado :</h5>
          </div>
        </div>
      </div>

    </div>
    <div class="col-sm-6 mb-3 mb-md-0">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Graficos estadisticos</h5>
          <graficos></graficos>
        </div>
      </div>
    </div>
    
      <div id="card_progress" class="card">
        <div class="container">
          <div class="card-body">
            <div class="row">
              <div class="col-2">
                <span class="btn-success">Producto</span>
              </div>
              <div class="col-8">
                <div class="progress mb-3" style="height: 8px;">
                  <div
                    class="progress-bar"
                    role="progressbar"
                    style="width: 25%;"
                    aria-valuenow="25"
                    aria-valuemin="0"
                    aria-valuemax="100"
                  ></div>
                </div>
              </div>
              <div class="col-2">Estado</div>
            </div>
            <div class="row">
              <div class="col-2">Producto</div>
              <div class="col-8">
                <div class="progress mb-3" style="height: 8px;">
                  <div
                    class="progress-bar"
                    role="progressbar"
                    style="width: 25%;"
                    aria-valuenow="25"
                    aria-valuemin="0"
                    aria-valuemax="100"
                  ></div>
                </div>
              </div>
              <div class="col-2">Estado</div>
            </div>
            <div class="row">
              <div class="col-2">Producto</div>
              <div class="col-8">
                <div class="progress mb-3" style="height: 8px;">
                  <div
                    class="progress-bar"
                    role="progressbar"
                    style="width: 25%;"
                    aria-valuenow="25"
                    aria-valuemin="0"
                    aria-valuemax="100"
                  ></div>
                </div>
              </div>
              <div class="col-2">Estado</div>
            </div>
            <div class="row">
              <div class="col-2">Producto</div>
              <div class="col-8">
                <div class="progress mb-3" style="height: 8px;">
                  <div
                    class="progress-bar"
                    role="progressbar"
                    style="width: 25%;"
                    aria-valuenow="25"
                    aria-valuemin="0"
                    aria-valuemax="100"
                  ></div>
                </div>
              </div>
              <div class="col-2">Estado</div>
            </div>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      lists: [
        {
          id: 12,
          id_ingreso: 12,

          ingreso: [
            {
              id: 12,
              id_proveedor: 30,
              id_estado: 2
            }
          ],
          persona: [
            {
              id: 30,
              id_tipo_persona: 3
            }
          ],
          articulo: [
            {
              id: 44,
              id_categoria: 4
            }
          ]
        },
        {
          id: 21,
          id_ingreso: 12,

          ingreso: [
            {
              id: 12,
              id_proveedor: 30,
              id_estado: 1
            }
          ],
          persona: [
            {
              id: 40,
              id_tipo_persona: 37
            }
          ],
          articulo: [
            {
              id: 99,
              id_categoria: 78
            }
          ]
        },
        {
          id: 21,
          id_ingreso: 31,

          ingreso: [
            {
              id: 31,
              id_proveedor: 30,
              id_estado: 2
            }
          ],
          persona: [
            {
              id: 40,
              id_tipo_persona: 37
            }
          ],
          articulo: [
            {
              id: 99,
              id_categoria: 78
            }
          ]
        },
        {
          id: 11,
          id_ingreso: 11,

          ingreso: [
            {
              id: 30,
              id_proveedor: 30,
              id_estado: 2
            }
          ],
          persona: [
            {
              id: 30,
              id_tipo_persona: 37
            }
          ],
          articulo: [
            {
              id: 99,
              id_categoria: 78
            }
          ]
        }
      ],
      allbusqueda: [],
      busqueda: [],
      encontrado: false
    };
  },

  methods: {
    buscar: function() {
      this.lists.forEach(element => {
        let data = element;
        let dato = element.ingreso[0];

        if (dato.id_estado == 12) {
          this.busqueda.push(dato);
          this.allbusqueda = data;
        }
      });
    },
    cambiar() {}
  },
  computed: {},

  mounted() {
    this.buscar();
  }
};
</script>
 
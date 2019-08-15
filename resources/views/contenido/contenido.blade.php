

@extends ('principal')

@section('contenido')

        <template v-if="menu == 0"> 
                 <main class="main">
    <!-- Breadcrumb -->

    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      
      <div class="card-deck">
      <div id="card2" class="card mb-3" style="top:10px; max-width: 300px; max-height: 70px; ">
  <div  class="row no-gutters">
    <div class="col-md-4">
      <img id="imagen_venta" src="img/venta_carrito.png" class="card-img">
               <button  id="btn_compra2"  type="button"  @click="menu=6"  class="btn btn-success" >
  Nueva Venta
</button>  
    </div>
    <div class="col-md-4">
      <div class="card-body">
        
         <button id="btn1" type="button"  @click="menu=6"  class="btn btn-success" >
  Nueva Venta
</button>      
      </div>
    </div>
  </div>
</div>
<div id="card1" class="card mb-3"  style="top:10px; max-width: 300px; max-height: 70px;">
  <div  class="row no-gutters">
    <div class="col-md-4">
      <img id="imagen_venta" src="img/inventario.png" class="card-img">
             <button id="btn_compra2" type="button" class="btn btn-warning" style="bottom:-300px;"  @click="menu=7" data-toggle="button" aria-pressed="false" autocomplete="off">
  Nueva Compra
</button> 
    </div>
    <div class="col-md-8">
      <div class="card-body">
             <button id="btn1" type="button" class="btn " style="bottom:-300px;"  @click="menu=7" data-toggle="button" aria-pressed="false" autocomplete="off">
  Nueva Compra
</button> 
        
      </div>
    </div>
  </div>
</div>

      </div>
      <div id="card_escritorio" class="card ">
              
        <div class="card-body"> 
                
       
  
                      
                <escritorio ></escritorio>    
                <!-- Card -->
       
        
               
</div>



<!-- Card -->    
        </div>
</div>
</div>
</main>
        </template>

        <template v-if="menu == 1">
       
                <categoria></categoria>                

        <!--GESTION -->
        </template>

        <template v-if="menu == 2">

        <art></art>
              
        </template>
        <template v-if="menu == 3">
        <!-- menu no colocar nada-->
                
        </template>
        <template v-if="menu == 4">
            
        </template>
        <template v-if="menu == 5">
                <gestion-ventas></gestion-ventas>

        </template>
        <template v-if="menu == 6">
            
                <!--componentes de ventas -->
                <venta :username={{Auth::user()->id}}></venta>
               
        </template>
        <template v-if="menu == 7">
                <compa></compa>
        </template>
        <template v-if="menu == 8">
               <gestion-compras></gestion-compras>
        </template>

        <template v-if="menu == 9">
        <usuarios :username={{Auth::user()->id}}> </usuarios>
        </template>
        <template v-if="menu ==10">
                <h2>menu del contenido 10 </h2>
        </template>
    

        @endsection

        <script>

        </script>
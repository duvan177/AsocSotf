

@extends ('principal')

@section('contenido')

        <template v-if="menu == 0">
                
        
        </template>

        <template v-if="menu == 1">
        <div>

        <h1>formulario</h1>
        </div>


        <!--GESTION -->
        </template>

        <template v-if="menu == 2">

        <example-component></example-component>
              
        </template>
        <template v-if="menu == 3">
        
                
        </template>
        <template v-if="menu == 4">
            
        </template>
        <template v-if="menu == 5">

        </template>
        <template v-if="menu == 6">
            
                <!--componentes de ventas -->
                <venta></venta>
               
        </template>
        <template v-if="menu == 7">
                
        </template>
        <template v-if="menu == 8">
                <h2>menu del contenido 8 </h2>
        </template>

        <template v-if="menu == 9">
                <h2>menu del contenido 9 </h2>
        </template>
        <template v-if="menu ==10">
                <h2>menu del contenido 10 </h2>
        </template>
    

        @endsection
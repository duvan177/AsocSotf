<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content=" Sistema de ventas e inventario">
    <meta name="author" content="AsocSoft">
    <meta name="keyword" content="SISVENTI">
    <link rel="shortcut icon" href="img\logobien.png">
    <title> Vents-app</title>
     <!-- token de seguridad -->
       <!-- Icons -->
       <style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<link href="css/mdb.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-line-icons.min.css" rel="stylesheet">
    <!-- Main styles for this application -->

     <link href="css/cargando.css" rel="stylesheet">
     <link rel="css/toastr.css" href="">


      <link href="css/style.css" rel="stylesheet">
      <link href="css/animate.css" rel="stylesheet">
      <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="user-id" content="{{ Auth::user()->name}}">
    <!-- Icons -->
    <link href="css/plantilla.css" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden" onload="asignarId(username={{Auth::user()->id}})">
<div id="app">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a  class="navbar-nav">  <img src="img\top_.png" ></a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3">
                <a class="nav-link"  @click="menu=0" >Escritorio</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" @click="menu=2">Productos</a>
                </li>
            </ul>



        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item d-md-down-none"  style="">
                <a class="nav-link" data-toggle="dropdown">
                    <i class="icon-bell"></i>
                    <span class="badge badge-pill badge-danger">5</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Notificaciones</strong>
                    </div>
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-envelope-o"></i> Ingresos
                        <span class="badge badge-success">3</span>
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-tasks"></i> Ventas
                        <span class="badge badge-danger">2</span>
                    </a>
                </div>
                 <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
            </li>

        </ul>
    </header>

    <div class="app-body">


    @include('plantilla.sidebar')
        <!-- Contenido Principal -->


        @yield('contenido')
        <a id="btn_hm" class="flotante5" @click="menu=0">
      <img src="img\home_.png" border="0" />
    </a>

<a id="btn_cps" class="flotante4" @click="menu=8">
      <img src="img\compas_.png" border="0" />
    </a>
                 <a id="btn_vt" class="flotante3" @click="menu=2" >
      <img src="img\stock.png" border="0" />
    </a>
  <a id="btn_cp" class="flotante2" @click="menu=5" >
      <img src="img\recibo.png" border="0" />
    </a>

    <a  id="btn_f" class="flotante" @click="rote(validar2)" >
      <img src="img\menu_esc.png" border="0" />
    </a>

        <!-- /Fin del contenido principal -->
    </div>
    </div>

    <!-- Bootstrap and necessary plugins -->
    <script src="{{asset("js/jquery.min.js")}}"></script>


     <script src="{{asset("js/mdb.js")}}"></script>
      <!-- Bootstrap and necessary plugins -->
    <script src="{{asset("js/popper.min.js")}}"></script>
    <script src="{{asset("js/bootstrap.min.js")}}"></script>
    <script src="{{asset("js/pace.min.js")}}"></script>
     <!-- Plugins and scripts required by all views -->
    <script src="{{asset("js/Chart.min.js")}}"></script>
    <script src="{{asset("js/anime.js")}}"></script>
      <script src="{{asset("js/operacionsAdd.js")}}"></script>




    <!-- GenesisUI main scripts -->


       <script src="{{asset("js/app.js")}}"></script>
    <script src="{{asset("js/plantilla.js")}}"></script>
    <script>
        let contenedor=[];
            function asignarId(user){
                var id_user = user;
                var contenedor = [];
                         axios.post("api/getDataPermise", {id: id_user}).then(response =>{
                             console.log(response.data);
                             contenedor=response.data;
                         var numero=contenedor[0].id_rol;
                         if(numero==2){
                            document.getElementById("Usuarios").style.display = "none";
                            var maestro= document.getElementById("Usuarios");
                         padre = maestro.parentNode;
        padre.removeChild(maestro);


                         }
                         });
                         /*var nombre= document.getElementById("Maestro");
                         padre = nombre.parentNode;
		padre.removeChild(nombre);  */
                         console.log(contenedor);
                    }

                    </script>

</body>

</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="img/logobien.png">
        <title>Vents-App</title>

        <link href="css/plantilla.css" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .color{

                background-image: url("https://image.jimcdn.com/app/cms/image/transf/none/path/sc77e1e58a42c514a/image/i9977c7b3a6db203a/version/1516578954/image.jpg");
                          }

            @media (max-width: 500px) {
    #img_e {
       width: 350px;
       height: 300px;
    }
}
             @media (min-width: 500px) {
    #img_e {
       width: 450px;
       height: 400px;
    }
}


        </style>
    </head>
    <body class="color">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/contenido ') }}">Escritorio</a>
                    @else
                        <a href="{{ route('login') }}">Iniciar Sesion</a>
                    @endauth
                </div>
            @endif

            <div class="content">

                <div class="title m-b-md" >
                </div>

                <img id="img_e" class="animated fadeIn" src="img\vents_app3.png" />

            </div>
        </div>
    </body>
</html>

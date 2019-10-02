<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administracion VyV</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">

</head>

<body>

<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading"> <img src="{{ asset('images/vyv.jpg')}}" width="150" height="100" alt="Unidad educativa Vida y Verdad"> </div>
        <div class="list-group list-group-flush">
            @hasrole('super')
            <a href="{{ route('super.usuarios.index') }}" class="list-group-item list-group-item-action bg-light">Administrar Usuarios</a>
            <a href="{{ route('super.usuarios.index') }}" class="list-group-item list-group-item-action bg-light">Registrar Usuarios</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Administrar Horarios</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Registrar Horarios</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Asignar Horarios</a>
            @endhasrole
            @hasrole('administrador')
            <a href="#" class="list-group-item list-group-item-action bg-light">Solicitudes</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Reportes</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Link Administrador</a>
            @endhasrole
            @hasrole('direccion')
            <a href="#" class="list-group-item list-group-item-action bg-light">Administrar Solicitudes</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Reportes Supervisores</a>
            @endhasrole
            @hasrole('secretaria_dir')
            <a href="#" class="list-group-item list-group-item-action bg-light">Reportes administrativos</a>
            @endhasrole
            @hasrole('sistemas')
            <a href="#" class="list-group-item list-group-item-action bg-light">Reporte de Notas Digital</a>
            @endhasrole
            @hasrole('recepcion')
            <a href="#" class="list-group-item list-group-item-action bg-light">Formulario de Atrasos/Salidas Anticipadas</a>
            @endhasrole
            @hasrole('supervisor')
            <a href="#" class="list-group-item list-group-item-action bg-light">Uniformes</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Atrasos</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Recreos</a>
            @endhasrole
            <a href="#" class="list-group-item list-group-item-action bg-light">Mis Solicitudes</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Vacaciones</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Permisos</a>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->

    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sistema profesores</a>
                    </li>
                    @guest
                        <li><a href="{{ route('login') }}">Entrar</a></li>
                    <!--li><a href="{{ route('register') }}">Register</a></li-->
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->nombre }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Ver Perfil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                Cerrar Sesi&oacute;n
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                        @endguest
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            <main class="py-4 container">
                @include('partials.alerts')
                @yield('content')
            </main>

        </div>

    </div>
    <!-- /#page-content-wrapper -->


</div>
<!-- /#wrapper -->

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
@show
</body>

</html>

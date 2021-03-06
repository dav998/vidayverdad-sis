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

<style type="text/css">
    @media print {
        #printbtn {
            display :  none;
        }
    }
</style>

<body>

<div class="d-flex" id="wrapper" media="print">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper" >
        <div class="sidebar-heading"> <img src="{{ asset('images/vyv.jpg')}}" width="150" height="100" alt="Unidad educativa Vida y Verdad"> </div>
        <div class="list-group list-group-flush">
            @hasrole('super')
            <ul class="list-group"></ul>
            <a href="#superuser" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-light">Administrar Usuarios</a>
                    <ul class="collapse" id="superuser">
                        <li>
                            <a href="{{ route('super.usuarios.index') }}" class="list-group-item list-group-item-action bg-light">Ver/Editar Usuario</a>
                        </li>
                        <li>
                            <a href="{{ route('super.usuarios.create') }}" class="list-group-item list-group-item-action bg-light">Registrar Usuario</a>
                        </li>
                    </ul>
            <a href="#superhora" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-light">Administrar Horarios</a>
            <ul class="collapse" id="superhora">
                <li>
                    <a href="{{ route('super.horarios.index') }}" class="list-group-item list-group-item-action bg-light">Ver/Editar Horarios</a>
                </li>
                <li>
                    <a href="{{ route('super.horarios.create') }}" class="list-group-item list-group-item-action bg-light">Registrar Horario</a>
                </li>
                <li>
                    <a href="{{ route('super.userhora.index') }}" class="list-group-item list-group-item-action bg-light">Asignar Horarios</a>
                </li>
            </ul>
            <a href="#supervacas" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-light">Administrar Vacaciones</a>
            <ul class="collapse" id="supervacas">
                <li>
                    <a href="{{action('Super\VacasSuperController@invierno')}}" class="list-group-item list-group-item-action bg-light">Actualizar Vacaciones de Invierno</a>
                </li>
                <li>
                    <a href="{{action('Super\VacasSuperController@verano')}}" class="list-group-item list-group-item-action bg-light">Actualizar Vacaciones de Fin de A&ntilde;o</a>
                </li>
                <li>
                    <a href="{{ route('super.vacas.index') }}" class="list-group-item list-group-item-action bg-light">Actualizar Info. Vacaciones</a>
                </li>
            </ul>
            @endhasrole
            @hasrole('administrador')
            <ul class="list-group"></ul>
            <a href="#homeSubmenusol" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-light">Administrar Solicitudes</a>
            <ul class="collapse" id="homeSubmenusol">
                <li>
                <a href="#dirvacas"  data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-light">Vacaciones</a>
                <ul class="collapse" id="dirvacas">
                    <li>
                        <a href="{{ url('Dir/vacaciones/espera') }}" class="list-group-item list-group-item-action bg-light">Pendientes</a>
                    </li>
                    <li>
                        <a href="{{ url('Dir/vacaciones/aproved') }}" class="list-group-item list-group-item-action bg-light">Aprobadas</a>
                    </li>
                    <li>
                        <a href="{{ url('Dir/vacaciones/rejected') }}" class="list-group-item list-group-item-action bg-light">Rechazadas</a>
                    </li>
                </ul>
                </li>
                <li>
                    <a href="#dirpermiso"  data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-light">Permisos/Tolerancia</a>
                    <ul class="collapse" id="dirpermiso">
                        <li>
                            <a href="{{ route('dir.permisos.index') }}" class="list-group-item list-group-item-action bg-light">Pendientes</a>
                        </li>
                        <li>
                            <a href="{{ url('Dir/permisos/aproved') }}" class="list-group-item list-group-item-action bg-light">Aprobadas</a>
                        </li>
                        <li>
                            <a href="{{ url('Dir/permisos/rejected') }}" class="list-group-item list-group-item-action bg-light">Rechazadas</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <a href="{{url('admin/reponer_vacas')}}" class="list-group-item list-group-item-action bg-light">Modificar Vacaci&oacute;n</a>


            <ul class="list-group">

                <li>
                    <a href="#homeSubmenurep"  data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-light">Reportes</a>
                    <ul class="collapse" id="homeSubmenurep">
                <li>
                    <a href="{{ route('dir.vacaciones.index') }}" class="list-group-item list-group-item-action bg-light">Vacaciones</a>
                </li>
                        <li>
                            <a href="{{ url('Dir/vacaciones/personal') }}" class="list-group-item list-group-item-action bg-light">Vacaciones Personal</a>
                        </li>
                        <li>
                            <a href="{{url('admin/reporte')}}" class="list-group-item list-group-item-action bg-light">Modificaci&oacute;n de Vacaci&oacute;n</a>
                        </li>
                <li>
                <a href="{{ url('Dir/permisos/pre_permisos') }}" class="list-group-item list-group-item-action bg-light">Permisos/Tolerancia</a>
                    <!--a href="{{action('Dir\PermisosAdmController@reporte')}}" class="list-group-item list-group-item-action bg-light">Permisos/Tolerancia</a-->
                </li>

            </ul>
                </li>
            </ul>
            @endhasrole
            @hasrole('direccion')
            <ul class="list-group">
                <li>
                    <a href="#dirhomeSubmenurep"  data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-light">Reportes</a>
                    <ul class="collapse" id="dirhomeSubmenurep">
                        <li>
                            <a href="{{ route('dir.vacaciones.index') }}" class="list-group-item list-group-item-action bg-light">Vacaciones</a>
                        </li>
                        <li>
                            <a href="{{ url('Dir/vacaciones/personal') }}" class="list-group-item list-group-item-action bg-light">Vacaciones Personal</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="list-group">
                <li>
                    <a href="#dirhomeSubmenusol"  data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-light">Administrar Solicitudes</a>
                    <ul class="collapse" id="dirhomeSubmenusol">
                        <li>
                            <a href="#dirvacas"  data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-light">Vacaciones</a>
                            <ul class="collapse" id="dirvacas">
                                <li>
                                    <a href="{{ url('Dir/vacaciones/espera') }}" class="list-group-item list-group-item-action bg-light">Pendientes</a>
                                </li>
                                <li>
                                    <a href="{{ url('Dir/vacaciones/aproved') }}" class="list-group-item list-group-item-action bg-light">Aprobadas</a>
                                </li>
                                <li>
                                    <a href="{{ url('Dir/vacaciones/rejected') }}" class="list-group-item list-group-item-action bg-light">Rechazadas</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#dirpermiso"  data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-light">Permisos/Tolerancia</a>
                            <ul class="collapse" id="dirpermiso">
                                <li>
                                    <a href="{{ route('dir.permisos.index') }}" class="list-group-item list-group-item-action bg-light">Pendientes</a>
                                </li>
                                <li>
                                    <a href="{{ url('Dir/permisos/aproved') }}" class="list-group-item list-group-item-action bg-light">Aprobadas</a>
                                </li>
                                <li>
                                    <a href="{{ url('Dir/permisos/rejected') }}" class="list-group-item list-group-item-action bg-light">Rechazadas</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            @endhasrole
            @hasrole('secretaria_dir')
            <a href="#" class="list-group-item list-group-item-action bg-light">Reportes administrativos</a>
            @endhasrole
            @hasrole('sistemas')
            <a href="#" class="list-group-item list-group-item-action bg-light">Reporte de Notas Digital</a>
            @endhasrole
            @hasrole('recepcion')
            <a href="{{url('/tolerancias')}}" class="list-group-item list-group-item-action bg-light">Formulario de Atrasos/Salidas Anticipadas</a>
            @endhasrole
            @hasrole('supervisor')
            <a href="#" class="list-group-item list-group-item-action bg-light">Uniformes</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Atrasos</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Recreos</a>
            @endhasrole
            <ul class="list-group">
                <li>
                <a href="#homeSubmenudef" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-light">Mis Solicitudes</a>
                <ul class="collapse" id="homeSubmenudef">
                    <li>
                        <a href="#vacas" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-light">Vacaciones</a>
                        <ul class="collapse" id="vacas">
                            <li>
                                <a href="{{ url('/solvacas') }}" class="list-group-item list-group-item-action bg-light">Ver</a>
                            </li>
                            <li>
                                <a href="{{action('VacasSolController@invierno')}}" class="list-group-item list-group-item-action bg-light">Invierno</a>
                            </li>
                            <li>
                                <a href="{{action('VacasSolController@verano')}}" class="list-group-item list-group-item-action bg-light">Fin de A&ntilde;o</a>
                            </li>
                            <li>
                                <a href="{{action('VacasSolController@create')}}" class="list-group-item list-group-item-action bg-light">A Cuenta</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('/permisos') }}" class="list-group-item list-group-item-action bg-light">Permisos</a>
                    </li>
                </ul>
                </li>
            </ul>
            <a href="{{ route('vacas.index') }}" class="list-group-item list-group-item-action bg-light">Reporte Mis Vacaciones</a>

        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->

    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-primary" id="menu-toggle">Tabular Menu</button>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('home')}}">Inicio <span class="sr-only">(current)</span></a>
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
                            <a class="dropdown-item" href="{{action('HomeController@perfil')}}">Ver Perfil</a>
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

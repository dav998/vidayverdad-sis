@extends('layouts.sidebar')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>


    <div class="container" >
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Administrar Usuarios</div>

                    <div class="panel-body">
                        <div class="row">

                            <div>
                                <form class="form-inline active-cyan-4">
                                    <i class="fas fa-search" aria-hidden="true">Busca Aqu&iacute;</i>
                                    <input id="myInput" class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Buscar"
                                           aria-label="Search">

                                </form><br> </div>
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" >Nombre</th>
                                <th scope="col" >E-mail</th>
                                <th scope="col" >Roles</th>
                                <th scope="col" colspan="3" class="text-center">Acciones</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach($users as $user)
                                <tr>
                                    <th>{{$user->nombre}}</th>
                                    <th>{{$user->email}}</th>
                                    <th>{{ implode(', ', $user->roles()->get()->pluck('nombre')->toArray())}}</th>
                                    <th>
                                        <a href="{{route('super.usuarios.edit', $user->id)}}">
                                            <button type="button" class="btn btn-primary btn-sm"> Editar Roles </button>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ action('Super\UserController@user_edit', ['id' => $user->id])}} " class="btn btn-warning btn-sm">Editar Usuario</a>
                                    </th>
                                    <th>
                                        <form action="{{ route('super.usuarios.destroy', $user->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{method_field('DELETE')}}
                                            <BUTTON type="submit" class="btn btn-danger btn-sm">Eliminar</BUTTON>
                                        </form>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                            {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
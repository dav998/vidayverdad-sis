@extends('layouts.sidebar')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Administrar Horarios y Usuarios</div>

                    <div class="panel-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" >Nombre</th>
                                <th scope="col" >E-mail</th>
                                <th scope="col" >Horarios</th>
                                <th scope="col" colspan="2" class="text-center">Acciones</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th>{{$user->nombre}}</th>
                                    <th>{{$user->email}}</th>
                                    <th>{{ implode(', ', $user->horarios()->get()->pluck('nombre')->toArray())}}</th>
                                    <th>
                                        <a href="{{route('super.userhora.edit', $user->id)}}">
                                            <button type="button" class="btn btn-primary btn-sm"> Editar Horarios </button>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ action('Super\UserController@user_edit', ['id' => $user->id])}} " class="btn btn-warning btn-sm">Editar Usuario</a>
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
@endsection
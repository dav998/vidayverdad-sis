@extends('layouts.sidebar')

@section('content')
    <div class="text-center m-t-lg">
        <h1>
            Editar Usuario
        </h1>
    </div>
    <form action="{{action('Super\UserController@editar_usuario')}}" method="POST" role="form" enctype="multipart/form-data" id="prop-form">
        {{ csrf_field() }}
        {{method_field('POST')}}
        <legend>Registrar Usuario</legend>
        <div class="form-group">
            <label for="">Nombres y Apellidos</label>
            <input required value="{{$user->nombre}}" type="text" class="form-control" name="nombre" id="nombre" >
            <input hidden value="{{$user->id}}" type="text" name="id" id="id" >
        </div>

        <div class="form-group">
            <label for="">Carnet de Identidad</label>
            <input required type="number" class="form-control" name="ci" id="ci" value="{{$user->ci}}" >
        </div>
        <div class="form-group">
            <label for="">Cargo</label>
            <input required value="{{$user->cargo}}"  type="text" class="form-control" name="cargo" id="cargo" >
        </div>

        <div class="form-group">
            <label for="">Correo Electr&oacute;nico</label>
            <input required value="{{$user->email}}"  type="email" class="form-control" name="email" id="email">
        </div>

        <button type="submit"  class="btn btn-primary">Enviar</button>
    </form>
    </div>

    </div>
@endsection
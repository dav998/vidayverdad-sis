@extends('layouts.sidebar')

@section('content')
    <div class="text-center m-t-lg">
        <h1>
            Permisos
        </h1>
    </div>
    <form action="{{ route('super.usuarios.store') }}" method="POST" role="form" enctype="multipart/form-data" id="prop-form">
        {{ csrf_field() }}
        <legend>Registrar Usuario</legend>
        <div class="form-group">
            <label for="">Nombres y Apellidos</label>
            <input required value="{{old('nombre')}}" type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombres y Apellidos">
        </div>

        <div class="form-group">
            <label for="">Carnet de Identidad</label>
            <input required type="number" class="form-control" name="ci" id="ci" value="{{old('ci')}}" placeholder="Carnet de Identidad sin Extensi&oacute;n">
        </div>
        <div class="form-group">
            <label for="">Cargo</label>
            <input required value="{{old('cargo')}}"  type="text" class="form-control" name="cargo" id="cargo" placeholder="Cargo del empleado">
        </div>
        <div class="form-group">
            <label for="">A&ntilde;o de Ingreso</label>
            <input required value="{{old('ano_ingreso')}}"  type="date" class="form-control" name="ano_ingreso" id="ano_ingreso">
        </div>
        <div class="form-group">
            <label for="">D&iacute;as de Vacaci&oacute;n a Cuenta</label>
            <input required value="{{old('dias_disp')}}"  type="number" class="form-control" name="dias_disp" id="dias_disp">
        </div>
        <div class="form-group">
            <label for="">Correo Electr&oacute;nico</label>
            <input required value="{{old('email')}}"  type="email" placeholder="usuario@ejemplo.com" class="form-control" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="">Contrase&ntilde;a</label>
            <input required type="password" class="form-control" name="password" id="password">
        </div>
        <div class="form-group">
            <label for="">Ingrese nuevamente su Contrase&ntilde;a</label>
            <input required type="password"  class="form-control" name="passwords" id="passwords">
        </div>

        <button type="submit"  class="btn btn-primary">Enviar</button>
    </form>
    </div>

    </div>
@endsection
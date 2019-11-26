@extends('layouts.sidebar')

@section('content')
<div class="text-center m-t-lg">
    <h1>
        Solicitud de Vacaciones
    </h1>
</div>
<form action="{{ route('solvacas.store') }}" method="POST" role="form" enctype="multipart/form-data" id="prop-form">
    {{ csrf_field() }}
    <legend>Solicitar Vacaciones Para: <br> <h2>{{$user->nombre}}</h2></legend>

    <div class="form-group">
        <label for="">Nombre</label>
        <input readonly value="{{$user->nombre}}"  type="text" class="form-control" name="nombre" id="nombre" >
    </div>

    <div class="form-group">
        <label for="">Carnet de identidad</label>
        <input readonly value="{{$user->ci}}"  type="number" class="form-control" name="ci" id="ci" placeholder="C.I.">
    </div>
    <div class="form-group">
        <label for="">Cargo</label>
        <input readonly value="{{$user->cargo}}"  type="text" class="form-control" name="cargo" id="cargo" placeholder="Cargo del solicitante">
    </div>
    <div class="form-group">
        <label for="">Tipo de Solicitud</label>
        @if($id == 1)
        <input readonly value="Vacaciones de Invierno"  type="text" class="form-control" >
            @else
        @if($id == 2)
                <input readonly value="Vacaciones de Fin de A&ntilde;o"  type="text" class="form-control">
            @else
                <input readonly value="Vacaciones A Cuenta"  type="text" class="form-control" >
            @endif
            @endif
        <input hidden value="{{$id}}" name="idvaca" id="idvaca">
    </div>
    <div class="form-group">
        <label for="">Fecha Inicio de Vacacion </label>
        <input readonly required value="{{$fdate}}" type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
    </div>

    <div class="form-group">
        <label for="">Fecha Fin de Vacacion </label>
        <input readonly required value="{{$tdate}}" type="date" class="form-control" name="fecha_fin" id="fecha_fin">
    </div>
    <div class="form-group">
        <label for="">Total Vacaciones</label>
        <input readonly value="{{$vacas->dias_disp}}"  type="text" class="form-control">
        <input hidden value="{{$user->id}}"  type="number" class="hidden" name="id" id="id">

    </div>
    <div class="form-group">
        <label for="">Dias a Utilizar</label>
        <input readonly value="{{$dias}}"  type="text" class="form-control" name="dias" id="dias" placeholder="Cargo del solicitante">
    </div>
    <div class="form-group">
        <label for="">Dias Pendientes</label>
        <input readonly value="{{$vacas->dias_disp - $dias}}"  type="text" class="form-control" name="pendientes" id="pendientes">
    </div>
    *Nota: Si los dias pendientes son negativos no podr&aacute; enviar la solicitud. <br>
    <button type="submit"  class="btn btn-primary">Enviar</button>
</form>
</div>

</div>
@endsection
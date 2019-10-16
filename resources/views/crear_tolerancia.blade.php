@extends('layouts.sidebar')

@section('content')
<div class="text-center m-t-lg">
    <h1>
        Tolerancias/Salidas Anticipadas
    </h1>
</div>
<form action="{{ route('tolerancias.store') }}" method="POST" role="form" enctype="multipart/form-data" id="prop-form">
    {{ csrf_field() }}
    <legend>Solicitar Tolerancia/Salida Anticipada</legend>
    <div class="form-group">
        <label for="">Carnet de identidad</label>
        <input required value="{{old('ci')}}"  type="number" class="form-control" name="ci" id="ci" placeholder="C.I.">
    </div>
    <div class="form-group">
        <label for="">Tolerancia/Salida Anticipada en Fecha: </label>
        <input readonly required value="{{date('Y-m-d')}}" type="text" class="form-control" name="fecha_ausente" id="fecha_ausente">
    </div>

    <div class="form-group">
        <label for="">Motivo de Tolerancia/Salida Anticipada</label>
        <textarea value="{{old('motivo')}}" type="text" class="form-control" name="motivo" id="motivo" placeholder="Raz&oacute;n de Ausencia"></textarea>

    </div>
    <div class="form-group">
        <label for="">Cargo</label>
        <input required value="{{old('cargo')}}"  type="text" class="form-control" name="cargo" id="cargo" placeholder="Cargo del solicitante">
    </div>
    <div class="form-group">
        <label for="">Suplente:</label>
        <input required value="{{old('suplente')}}"  type="text" class="form-control" name="suplente" id="suplente" placeholder="Nombre del Suplente (En caso de no existir suplente mencionarlo)">
    </div>
    <div class="form-group">
        <label for="">Agrega Imagenes de Respaldo</label>
        <input accept="image/*" type="file" class="-file-photo-o" name="imagen" id="imagen">
    </div>
    <button type="submit"  class="btn btn-primary">Enviar</button>
</form>
</div>

</div>
@endsection
@extends('layouts.sidebar')

@section('content')

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<div class="text-center m-t-lg">
    <h1>
        Permisos
    </h1>
</div>
<form action="{{ route('permisos.store') }}" method="POST" role="form" enctype="multipart/form-data" id="prop-form">
    {{ csrf_field() }}
    <legend>Solicitar Permiso</legend>
    <div class="form-group">
        <label for="">Fecha de Ausencia</label>
        <input required value="{{old('fecha_ausencia')}}" type="date" min="{{date('Y-m-d')}}" class="form-control" name="fecha_ausente" id="fecha_ausente">
    </div>

    <div class="form-group">
        <label for="">Motivo de Ausencia</label>
        <textarea  required value="{{old('motivo')}}" type="text" class="form-control" name="motivo" id="motivo" placeholder="Raz&oacute;n de Ausencia"></textarea>

        <input type="hidden" class="hidden" name="id" id="id" value="{{$user->id}}">
    </div>
    <div class="form-group">
        <label for="">Cargo</label>
        <input readonly value="{{$user->cargo}}"  type="text" class="form-control" name="cargo" id="cargo" placeholder="Cargo del solicitante">
    </div>
    <div class="form-group">
        <label for="">Suplente</label>
        <input required value="{{old('suplente')}}"  type="text" class="form-control" name="suplente" id="suplente" placeholder="Nombre del Suplente">
    </div>
    <div class="form-group">
        <label>Agrega Imagenes de Respaldo</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="imagen" name="imagen">
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
        <!--input accept="image/*" type="file"  class="file" data-show-preview="false" name="imagen" id="imagen"-->
    </div>
    <button type="submit"  class="btn btn-primary">Enviar</button>
</form>
</div>

</div>

<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

@endsection
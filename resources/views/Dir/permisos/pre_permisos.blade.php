@extends('layouts.sidebar')

@section('content')
    <div class="text-center m-t-lg">
        <h1>
            Reporte de Permisos y Tolerancias
        </h1>
    </div>

    <div>
        <form action="{{url('Dir/permisos/permisos_reporte')}}" method="POST" role="form" enctype="multipart/form-data" id="prop-form">
            {{ csrf_field() }}
            <legend>Ingrese la gesti&oacute;n o vea el reporte general</legend>
            <div class="form-group">
                <label for="">Gesti&oacute;n</label>
                <input required value="{{old('ci')}}"  type="number" class="form-control" name="year" id="year" placeholder="Gestion">
            </div>

            <button type="submit"  class="btn btn-primary">Siguiente</button>
        </form><br><br>
        <form action="{{url('Dir/permisos/permisos_reporte')}}" method="POST" role="form" enctype="multipart/form-data" id="prop-form2">
            {{ csrf_field() }}
            <legend>Reporte General</legend>
            <input hidden value="0"  type="number" class="form-control" name="year2" id="year2">
            <button type="submit"  class="btn btn-primary">Ver Reporte General</button>
        </form>
    </div>
@endsection
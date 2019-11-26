@extends('layouts.sidebar')

@section('content')
    <div class="text-center m-t-lg">
        <h1>
            Vacaciones
        </h1>
    </div>
    <div class="col-md-12">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Error!</strong> Revise los campos obligatorios.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div>
    <form action="{{url('/crear_vacas', $vacas=0)}}" method="POST" role="form" enctype="multipart/form-data" id="prop-form">
        {{ csrf_field() }}
        <legend>Solicitar Vacaciones</legend>
        <div class="form-group">
            <label for="">Fecha Inicio</label>
            <input required value="{{old('fecha_inicio')}}"  min="{{date('Y-m-d')}}" type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
            <br><label for="">Fecha Fin</label>
            <input required value="{{old('fecha_fin')}}"  min="fecha_inicio" type="date" class="form-control" name="fecha_fin" id="fecha_fin">
        </div>

        <button type="submit"  class="btn btn-primary">Siguiente</button>
    </form>
    </div>
@endsection
@extends('layouts.sidebar')

@section('content')
    <div class="text-center m-t-lg">
        @if($vacas->id == 1)
            <h1>
                Actualizar Vacaciones Invierno
            </h1>
        @else
            <h1>
                Actualizar Vacaciones Fin de A&ntilde;o
            </h1>
        @endif
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
    <form action="{{url('/crear_vacas', $vacas->id)}}" method="POST" role="form" enctype="multipart/form-data" id="prop-form">
        {{ csrf_field() }}
        <legend>Solicitar Vacaciones</legend>
        <div class="form-group">
            <label for="">Dias de Vacacion:</label>
            <input readonly value="{{$vacas->dias}}" type="text" class="form-control">
            <label for="">Dias de Vacacion Disponibles:</label>
            <input readonly value="{{$vacasuser->dias_disp}}" type="text" class="form-control">
            @if($vacas->dias > $vacasuser->dias_disp)
                <div class="danger" style="background-color: red">
                    <font color="white"> *Los dias de vacacion establecidos son mayores a sus dias de vacacion disponibles, por favor
                        seleccione las fechas de vacacion a tomar.</font>
                </div>
                <label for="">Fecha Inicio</label>
                <input required value="{{$vacas->fecha_inicio}}"  min="{{date('Y-m-d')}}" type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                <br><label for="">Fecha Fin</label>
                <input required value="{{$vacas->fecha_fin}}"  min="fecha_inicio" type="date" class="form-control" name="fecha_fin" id="fecha_fin">
            @else
            <label for="">Fecha Inicio</label>
            <input readonly value="{{$vacas->fecha_inicio}}"  min="{{date('Y-m-d')}}" type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
            <br><label for="">Fecha Fin</label>
            <input readonly value="{{$vacas->fecha_fin}}"  min="fecha_inicio" type="date" class="form-control" name="fecha_fin" id="fecha_fin">
            @endif
        </div>

        <button type="submit"  class="btn btn-primary">Siguiente</button>
    </form>
    </div>
@endsection
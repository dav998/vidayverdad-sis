@extends('layouts.sidebar')

@section('content')
    <div class="text-center m-t-lg">
        <h1>
            Actualizar Horario
        </h1>
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
    </div>
    <form action="{{route('super.horarios.update', $horario->id)}}" method="POST" role="form" enctype="multipart/form-data" id="prop-form">
        {{ csrf_field() }}
        {{method_field('PUT')}}
        <legend>Actualizar Horario</legend>
        <div class="form-group">
            <label for="">Nombre</label>
            <input required type="text" value="{{$horario->nombre}}" class="form-control" name="nombre" id="nombre">
        </div>

        <div class="form-group">
            <label for="">D&iacute;a(s)</label><br>
            <div class="alert alert-warning"> *Seleccione los nuevos d&iacute;as o los anteriores, los cuales son: <br>
            {{$horario->dias}}</div>
            <div class="row">
                <div class="col">
                    <input type="checkbox" class="checkbox" name="dias[]"  value="Lunes" > Lunes <br>
                    <input type="checkbox" class="checkbox" name="dias[]"  value="Martes"> Martes<br>
                    <input type="checkbox" class="checkbox-inline" name="dias[]"  value="Miércoles"> Mi&eacute;rcoles

                </div>
                <div class="col">

                    <input type="checkbox" class="checkbox" name="dias[]"  value="Jueves" > Jueves<br>
                    <input type="checkbox" class="checkbox" name="dias[]"  value="Viernes"> Viernes<br>
                    <input type="checkbox" class="checkbox-inline" name="dias[]" value="Sábado"> S&aacute;bado
                </div>

            </div>
        </div>
        <div class="form-group">
            <label for="">Hora de entrada</label>
            <input required type="time" value="{{$horario->hora_ingreso}}" class="form-control" name="hora_ini" id="hora_ini" >
        </div>
        <div class="form-group">
            <label for="">Hora de salida</label>
            <input required type="time" value="{{$horario->hora_salida}}" class="form-control" name="hora_fin" id="hora_fin" >
        </div>
        <button type="submit"  class="btn btn-primary">Actualizar</button>
    </form>
    </div>

    </div>
@endsection
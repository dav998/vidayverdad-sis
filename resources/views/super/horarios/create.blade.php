@extends('layouts.sidebar')

@section('content')
    <div class="text-center m-t-lg">
        <h1>
            Registrar Horario
        </h1>
    </div>
    <form action="{{ route('super.horarios.store') }}" method="POST" role="form" enctype="multipart/form-data" id="prop-form">
        {{ csrf_field() }}
        <legend>Registrar Horario</legend>
        <div class="form-group">
            <label for="">Nombre</label>
            <input required type="text" value="{{old('nombre')}}" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
        </div>

        <div class="form-group">
            <label for="">D&iacute;a(s)</label><br>
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
            <input required type="time" value="{{old('hora_ini')}}" class="form-control" name="hora_ini" id="hora_ini" >
        </div>
        <div class="form-group">
            <label for="">Hora de salida</label>
            <input required type="time" value="{{old('hora_fin')}}" class="form-control" name="hora_fin" id="hora_fin" >
        </div>
        <button type="submit"  class="btn btn-primary">Enviar</button>
    </form>
    </div>

    </div>
@endsection
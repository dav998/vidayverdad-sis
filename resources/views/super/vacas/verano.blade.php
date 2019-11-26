@extends('layouts.sidebar')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <h1>
                        Actualizar Vacaciones Fin de A&ntilde;o
                    </h1>
                    <div class="center-block">
                        <a href="{{action('Super\VacasSuperController@edit', $invierno->id)}}" class="btn btn-success btn-block">Actualizar Vacaciones</a>
                    </div>
                    <div class="panel-body">
                        @if(empty($invierno->fecha_inicio))
                            <label>Fecha de Inicio:</label>
                        <input readonly type="text" class="form-control" value="No hay vacacion registrada">
                            <label>Fecha de Fin:</label>
                            <input readonly type="text" class="form-control" value="No hay vacacion registrada">
                            <label>D&iacute;as:</label>
                            <input readonly type="text" class="form-control" value="No hay vacacion registrada">
                            @else
                            <label>Fecha de Inicio:</label>
                            <input readonly type="date"  class="form-control" value="{{$invierno->fecha_inicio}}">
                            <label>Fecha de Fin:</label>
                            <input readonly type="date" class="form-control" value="{{$invierno->fecha_fin}}">
                            <label>D&iacute;as:</label>
                            <input readonly type="text" class="form-control" value="{{$invierno->dias}}">
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
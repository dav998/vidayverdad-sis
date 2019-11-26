@extends('layouts.sidebar')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    @if($invierno->id == 1)
                    <h1>
                        Actualizar Vacaciones Invierno
                    </h1>
                    @else
                        <h1>
                            Actualizar Vacaciones Fin de A&ntilde;o
                        </h1>
                        @endif
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
                    <div class="panel-body">
                        <form action="{{route('super.vacas.update', $invierno->id)}}" method="POST" role="form" enctype="multipart/form-data" id="prop-form">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}
                            @if(empty($invierno->fecha_inicio))
                                <label>Fecha de Inicio:</label>
                                <input required value="{{old('fecha_inicio')}}" min="{{date('Y-m-d')}}" type="date"  class="form-control"  name="fecha_inicio" id="fecha_inicio">
                                <label>Fecha de Fin:</label>
                                <input required value="{{old('fecha_inicio')}}"  min="fecha_inicio" type="date" class="form-control"  name="fecha_fin" id="fecha_fin">
                            @else
                            <label>Fecha de Inicio:</label>
                            <input required  min="{{date('Y-m-d')}}" type="date"  class="form-control" value="{{$invierno->fecha_inicio}}" name="fecha_inicio" id="fecha_inicio">
                            <label>Fecha de Fin:</label>
                            <input required  min="fecha_inicio" type="date" class="form-control" value="{{$invierno->fecha_fin}}" name="fecha_fin" id="fecha_fin">
                            @endif
                            <br><button type="submit" class="center-block btn btn-success">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
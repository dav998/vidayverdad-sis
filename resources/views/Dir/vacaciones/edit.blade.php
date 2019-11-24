@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Administrar Solicitud Vacaciones</div>
                    <div class="panel-body">
                    <form action="{{route('dir.vacaciones.update', $data ->id)}}" method="POST">
                        {{ csrf_field() }}
                        {{method_field('PUT')}}
                        <legend>Administrar Permiso de {{$user->nombre}}</legend>
                        <div class="form-group">
                            <label for="">Nombre del Solicitante</label>
                            <input readonly  value="{{$user->nombre}}" type="text" class="form-control" name="fecha_ausente" id="fecha_ausente">
                        </div>
                        <div class="form-group">
                            <label for="">Cargo</label>
                            <input readonly  value="{{$user->cargo}}" type="text" class="form-control" name="fecha_ausente" id="fecha_ausente">
                            <input hidden  value="{{$user->id}}" type="text" class="hidden" name="user_id" id="user_id">
                        </div>

                        <div class="form-group">
                            <label for="">Solicitud Enviada en Fecha:</label>
                            <input readonly  value="{{$data->created_at}}" type="text" class="form-control" name="fecha_ausente" id="fecha_ausente">
                        </div>
                        <div class="form-group">
                            <label for="">Tipo de Vacaci&oacute;n</label>
                            @if($data->tipo == 1)
                                <input readonly  value="INVIERNO" type="text" class="form-control" name="tipo" id="tipo">
                            @else
                                @if($data->tipo == 2)
                                    <input readonly  value="FIN DE A&Ntilde;O" type="text" class="form-control" name="fecha_ausente" id="fecha_ausente">
                                    @else
                                    <input readonly  value="A CUENTA" type="text" class="form-control" name="fecha_ausente" id="fecha_ausente">
                                    @endif
                        @endif

                        </div>
                        <div class="form-group">
                            <label for="">Fecha de Inicio</label>
                            <input readonly  value="{{$data->fecha_inicio}}" type="date" class="form-control" name="fecha_ausente" id="fecha_ausente">
                        </div>

                        <div class="form-group">
                            <label for="">Fecha de Fin</label>
                            <input  readonly value="{{$data->fecha_fin}}" type="date" class="form-control" name="motivo" id="motivo" >{{$data->motivo}}</input>

                            <input type="hidden" class="hidden" name="id" id="id" value="{{$data->id}}">
                        </div>

                        <div class="form-group">
                            <label for="">Dias de Vacaci&oacute;n</label>
                            <input readonly required value="{{$data->dias}}"  type="text" class="form-control" name="dias" id="dias" placeholder="Cargo del solicitante">
                        </div>
                        <div class="form-group">
                            <label for="">Aceptar o Rechazar Solicitud</label><br>
                            <input type="radio" name="aproved" id="aproved" value="1" checked> Aceptar
                            <input type="radio" name="aproved" id="aproved" value="2"> Rechazar
                        </div>
                        <div class="form-group">
                            <label for="">Observaciones</label>
                            <textarea  type="text" class="form-control" name="observacion" id="observacion" placeholder="Observaciones" ></textarea>
                        </div>
                        <!--div class="form-group">
                            <label for="">Agrega Imagenes de Respaldo</label>
                            <input accept="image/*" type="file" class="-file-photo-o" name="imagen" id="imagen">
                        </div-->
                        <button type="submit" class="center-block btn btn-success">Actualizar</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
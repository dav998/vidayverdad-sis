@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Administrar Solicitudes/Vacaciones/Ver</div>
                    <div class="panel-body">
                        <legend>Ver Solicitud de Vacaci&oacute;n</legend>
                        <div class="form-group">
                            <label for="">Nombre del Solicitante</label>
                            <input readonly  value="{{$user->nombre}}" type="text" class="form-control" name="fecha_ausente" id="fecha_ausente">
                        </div>
                        <div class="form-group">
                            <label for="">Cargo</label>
                            <input readonly  value="{{$user->cargo}}" type="text" class="form-control" name="fecha_ausente" id="fecha_ausente">
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
                            <input readonly required value="{{$data->dias}}"  type="text" class="form-control" name="cargo" id="cargo" placeholder="Cargo del solicitante">
                        </div>
                        <div class="form-group">
                            <label for="">Estado</label><br>
                            @if($data->aprobado == 0)
                                <button type="button" class="btn-primary btn-sm"> En Espera </button>
                            @else
                                @if($data->aprobado == 1)
                                    <button type="button" class="btn-success btn-sm"> Aceptada </button>
                                @else
                                    <button type="button" class="btn-danger btn-sm"> Rechazada </button>
                                @endif
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Observaciones</label>
                            <textarea readonly type="text" class="form-control" name="observacion" id="observacion" placeholder="Observaciones" >{{$data->observaciones}}</textarea>
                        </div>
                        <!--div class="form-group">
                            <label for="">Agrega Imagenes de Respaldo</label>
                            <input accept="image/*" type="file" class="-file-photo-o" name="imagen" id="imagen">
                        </div-->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
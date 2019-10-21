@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Administrar Solicitudes de Permisos/Tolerancias</div>
                    <div class="panel-body">
                            <legend>Ver Solicitud de Permiso/Tolerancia</legend>
                        <div class="form-group">
                            <label for="">Tipo de Solicitud</label>
                            @if($data->tipo == 1)
                                <input readonly  value="TOLERANCIA" type="text" class="form-control" name="fecha_ausente" id="fecha_ausente">
                            @else
                                @if($data->tipo == 2)
                                    <input readonly  value="SALIDA ANTICIPADA" type="text" class="form-control" name="fecha_ausente" id="fecha_ausente">
                                @else
                                    <input readonly  value="PERMISO" type="text" class="form-control" name="fecha_ausente" id="fecha_ausente">
                                @endif
                            @endif
                        </div>
                            <div class="form-group">
                                <label for="">Solicitud Enviada en Fecha:</label>
                                <input readonly  value="{{$data->created_at}}" type="text" class="form-control" name="fecha_ausente" id="fecha_ausente">
                            </div>
                            <div class="form-group">
                                <label for="">Fecha de Ausencia</label>
                                <input readonly  value="{{$data->fecha_ausencia}}" type="date" class="form-control" name="fecha_ausente" id="fecha_ausente">
                            </div>

                            <div class="form-group">
                                <label for="">Motivo de Ausencia</label>
                                <textarea  readonly value="{{$data->motivo}}" type="text" class="form-control" name="motivo" id="motivo" >{{$data->motivo}}</textarea>

                                <input type="hidden" class="hidden" name="id" id="id" value="{{$data->id}}">
                            </div>
                            <div class="form-group">
                                <label for="">Cargo</label>
                                <input readonly required value="{{$data->cargo}}"  type="text" class="form-control" name="cargo" id="cargo" placeholder="Cargo del solicitante">
                            </div>
                            <div class="form-group">
                                <label for="">Suplente</label>
                                <input readonly required value="{{$data->suplente}}"  type="text" class="form-control" name="suplente" id="suplente" placeholder="Nombre del Suplente">
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
@extends('layouts.sidebar')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Administrar Permisos</div>

                    <div class="panel-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-center" scope="col" >Nombre</th>
                                <th class="text-center" scope="col" >D&iacute;a de Ausencia</th>
                                <th class="text-center" scope="col" >Tipo de Solicitud</th>
                                <th class="text-center" scope="col" >Cargo</th>
                                <th class="text-center" scope="col" >Estado</th>
                                <th class="text-center" scope="col" class="text-center">Acciones</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            @if($datas->isEmpty())
                                <tr><th colspan="5" class="text-center">No hay solicitudes aprobadas</th></tr>
                            @else
                            @foreach($datas as $data)
                                <tr>
                                    <th  class="text-center">{{$data->nombre}}</th>
                                    <th class="text-center">{{$data->fecha_ausencia}}</th>
                                    @if($data->tipo == 1)
                                        <th style="border-radius: 5px; " >TOLERANCIA</th>
                                    @else
                                        @if($data->tipo == 2)
                                            <th style="border-radius: 5px;" >SALIDA ANTICIPADA</th>
                                        @else
                                            <th style="border-radius: 5px;" >PERMISO</th>
                                        @endif
                                    @endif
                                    <th class="text-center">{{$data->cargo }}</th>
                                    @if($data->aprobado == 0)
                                        <th style="border-radius: 5px; " class="text-center" bgcolor="#575644"><font color="white">En espera</font></th>
                                    @else
                                        @if($data->aprobado == 1)
                                            <th style="border-radius: 5px;" class="text-center" bgcolor="#B4BD46" ><font color="white">Aprobado</font></th>
                                        @else
                                            <th style="border-radius: 5px;" class="text-center" bgcolor="#B90D09"><font color="white">Rechazada</font></th>
                                        @endif
                                    @endif
                                    <th class="text-center">
                                        <a href="{{route('dir.permisos.show', $data->pid)}}">
                                            <button type="button" class="btn-primary btn-sm"> Ver </button>
                                        </a>
                                    </th>
                                </tr>
                            @endforeach
                                @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
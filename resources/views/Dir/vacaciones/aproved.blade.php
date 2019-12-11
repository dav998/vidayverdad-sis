@extends('layouts.sidebar')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Administrar Solicitudes/Vacaciones/Aprobadas</div>

                    <div class="panel-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-center" scope="col" >Enviada en Fecha</th>
                                <th class="text-center" scope="col" >Nombre</th>
                                <th class="text-center" scope="col">Tipo de Vacaci&oacute;n</th>
                                <th class="text-center" scope="col" >D&iacute;as de Vacaci&oacute;n</th>
                                <th class="text-center" scope="col" >Fecha Inicio</th>
                                <th class="text-center" scope="col" >Fecha Fin</th>
                                <th class="text-center" scope="col" >Estado</th>
                                <th class="text-center" scope="col" class="text-center">Acciones</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            @if($datas->isEmpty())
                                <tr><th colspan="8" class="text-center">No hay solicitudes aprobadas</th></tr>
                            @else
                                @foreach($datas as $data)

                                    <tr>
                                        <td class="text-center">{{date('d/m/Y', strtotime($data->created_at))}}</td>
                                        <th  class="text-center">{{$data->nombre}}</th>
                                        @if($data->tipo == 1)
                                            <th style="border-radius: 5px; " >INVIERNO</th>
                                        @else
                                            @if($data->tipo == 2)
                                                <th style="border-radius: 5px;" >FIN DE A&Ntilde;O</th>
                                            @else
                                                <th style="border-radius: 5px;" >A CUENTA</th>
                                            @endif
                                        @endif
                                        <th class="text-center">{{$data->dias}}</th>
                                        <th class="text-center">{{$data->fecha_inicio }}</th>
                                        <th class="text-center">{{$data->fecha_fin }}</th>
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
                                            <a href="{{route('dir.vacaciones.show', $data->pid)}}">
                                                <button type="button" class="btn-primary btn-sm"> Ver </button>
                                            </a>
                                        </th>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>

                    </div>
                    {{ $datas->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
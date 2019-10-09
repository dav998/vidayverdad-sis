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
                                <th scope="col" >Nombre</th>
                                <th scope="col" >D&iacute;a de Ausencia</th>
                                <th scope="col" >Cargo</th>
                                <th scope="col" >Estado</th>
                                <th scope="col" class="text-center">Acciones</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr>
                                    <th>{{$data->nombre}}</th>
                                    <th>{{$data->fecha_ausencia}}</th>
                                    <th>{{$data->cargo }}</th>
                                    @if($data->aprobado == 0)
                                        <th bgcolor="#99ccff" >En espera</th>
                                    @else
                                        @if($data->aprobado == 1)
                                            <th bgcolor="#00FF00" >Aprobado</th>
                                        @else
                                            <th bgcolor="#FF0000">Rechazada</th>
                                        @endif
                                    @endif
                                    <th class="text-center">
                                        <a href="#">
                                            <button type="button" class="btn-primary btn-sm"> Administrar </button>
                                        </a>
                                    </th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
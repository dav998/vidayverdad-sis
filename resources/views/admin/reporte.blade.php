@extends('layouts.sidebar')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Reportes/Reporte Modificaci&oacute;n Vacaci&oacute;n</div>

                    <div class="panel-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-center" scope="col" >Fecha de Modificaci&oacute;n</th>
                                <th class="text-center" scope="col" >Nombre</th>
                                <th class="text-center" scope="col" >Cargo</th>
                                <th class="text-center" scope="col" >D&iacute;s Repuestos/Restados</th>
                                <th class="text-center" scope="col" >Motivo</th>
                                <th class="text-center" scope="col" class="text-center">Acciones</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            @if($datas->isEmpty())
                                <tr><th colspan="6" class="text-center">No se registraron modificaciones</th></tr>
                            @else
                                @foreach($datas as $data)
                                    <tr>
                                        <th class="text-center">{{$data->created_at}}</th>
                                        <th  class="text-center">{{$data->nombre}}</th>
                                        <th class="text-center">{{$data->cargo}}</th>
                                        <th class="text-center">{{$data->dias_repuestos}}</th>
                                        <th class="text-center">{{$data->motivo}}</th>
                                        <th class="text-center">
                                            <a href="{{action('Admin\ReponerVacasController@show', $data->pid)}}"> <!--// route('admin.show', $data->pid)}}-->
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
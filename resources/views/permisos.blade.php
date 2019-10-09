@extends('layouts.sidebar')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Permisos</div>

                    <div class="panel-body">

                        <div class="center-block">
                            <div class="center-block">
                                <a href="{{action('PermisoController@create')}}" class="btn btn-success btn-block">Solicitar Permiso</a>
                            </div>
                            <br>

                        </div>


                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" >Cargo</th>
                                <th scope="col" >Suplente</th>
                                <th scope="col" >Fecha de Env&iacute;o de Solicitud</th>
                                <th scope="col" >Estado</th>
                                <th scope="col"  >Acciones</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permisos as $permiso)
                                <tr>
                                    <th>{{$permiso->cargo}}</th>
                                    <th>{{$permiso->suplente}}</th>
                                    <th>{{$permiso->created_at->format('d-m-Y')}}</th>
                                    @if($permiso->aprobado == 0)
                                        <th bgcolor="#99ccff" >En espera</th>
                                        @else
                                        @if($permiso->aprobado == 1)
                                            <th bgcolor="#00FF00" >Aprobado</th>
                                        @else
                                            <th bgcolor="#FF0000">Rechazada</th>
                                            @endif
                                    @endif

                                    <th>
                                        <a href="#">
                                            <button type="button" class="btn-primary btn-sm"> Ver </button>
                                        </a>
                                    </th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $permisos->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
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
                                <th scope="col"  class="text-center">Tipo de Solicitud</th>
                                <th scope="col"  class="text-center">Suplente</th>
                                <th scope="col"  class="text-center">Fecha de Env&iacute;o de Solicitud</th>
                                <th scope="col"  class="text-center">Estado</th>
                                <th scope="col" colspan="2" class="text-center">Acciones</th>


                            </tr>
                            </thead>
                            <tbody>
                            @if($permisos->isEmpty())
                                <tr><th colspan="5" class="text-center">No hay registro de solicitudes</th></tr>
                            @else
                            @foreach($permisos as $permiso)
                                <tr>
                                    @if($permiso->tipo == 1)
                                        <th style="border-radius: 5px; " >TOLERANCIA</th>
                                    @else
                                        @if($permiso->tipo == 2)
                                            <th style="border-radius: 5px;" >SALIDA ANTICIPADA</th>
                                        @else
                                            <th style="border-radius: 5px;" >PERMISO</th>
                                        @endif
                                    @endif
                                    <th>{{$permiso->suplente}}</th>
                                    <th>{{$permiso->created_at->format('d-m-Y')}}</th>
                                    @if($permiso->aprobado == 0)
                                        <th style="border-radius: 5px; " class="text-center" bgcolor="#575644"><font color="white">En espera</font></th>
                                        <th>
                                            <form action="{{ route('permisos.destroy', $permiso->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{method_field('DELETE')}}
                                                <BUTTON type="submit" class="btn btn-danger btn-sm">Eliminar</BUTTON>
                                            </form>
                                        </th>
                                        @else
                                        @if($permiso->aprobado == 1)
                                            <th style="border-radius: 5px;" class="text-center" bgcolor="#B4BD46" ><font color="white">Aprobado</font></th>
                                        @else
                                             <th style="border-radius: 5px;" class="text-center" bgcolor="#B90D09"><font color="white">Rechazada</font></th>
                                            @endif
                                    @endif

                                    <th>
                                        <a href="{{action('PermisoController@show', $permiso->id)}}">
                                            <button type="button" class="btn-primary btn-sm"> Ver </button>
                                        </a>
                                    </th>
                                </tr>
                            @endforeach
                                @endif
                            </tbody>
                        </table>
                        {!! $permisos->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
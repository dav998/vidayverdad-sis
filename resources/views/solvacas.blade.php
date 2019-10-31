@extends('layouts.sidebar')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Solicitud de Vacaciones</div>

                    <div class="panel-body">

                        <div class="center-block">
                            <div class="center-block">
                                <a href="{{action('VacasSolController@create')}}" class="btn btn-success btn-block">Solicitar Vacaciones</a>
                            </div>
                            <br>

                        </div>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col"  >Tipo de Solicitud</th>
                                <th scope="col"  >Fecha Inicio</th>
                                <th scope="col"  >Fecha Fin</th>
                                <th scope="col"  >Dias</th>
                                <th scope="col"  class="text-center">Estado</th>
                                <th scope="col" colspan="2" class="text-center">Acciones</th>


                            </tr>
                            </thead>
                            <tbody>
                            @if($solvacas->isEmpty())
                                <tr><th colspan="6" class="text-center">No hay registro de solicitudes</th></tr>
                            @else
                            @foreach($solvacas as $vacas)
                                <tr>
                                    @if($vacas->tipo == 1)
                                        <th style="border-radius: 5px; " >INVIERNO</th>
                                    @else
                                        @if($vacas->tipo == 2)
                                            <th style="border-radius: 5px;" >FIN DE A&Ntilde;O</th>
                                        @else
                                            <th style="border-radius: 5px;" >A CUENTA</th>
                                        @endif
                                    @endif
                                    <th>{{date('d-m-Y', strtotime($vacas->fecha_inicio))}}</th>
                                    <th>{{date('d-m-Y', strtotime($vacas->fecha_fin))}}</th>
                                        <th>{{$vacas->dias}}</th>
                                    @if($vacas->aprobado == 0)
                                        <th style="border-radius: 5px; " class="text-center" bgcolor="#575644"><font color="white">En espera</font></th>
                                        <th>
                                            <form action="{{ route('solvacas.destroy', $vacas->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{method_field('DELETE')}}
                                                <BUTTON type="submit" class="btn btn-danger btn-sm">Eliminar</BUTTON>
                                            </form>
                                        </th>
                                        @else
                                        @if($vacas->aprobado == 1)
                                            <th style="border-radius: 5px;" class="text-center" bgcolor="#B4BD46" ><font color="white">Aprobado</font></th>
                                        @else
                                             <th style="border-radius: 5px;" class="text-center" bgcolor="#B90D09"><font color="white">Rechazada</font></th>
                                            @endif
                                    @endif

                                    <th>
                                        <a href="{{action('VacasSolController@show', $vacas->id)}}">
                                            <button type="button" class="btn-primary btn-sm"> Ver </button>
                                        </a>
                                    </th>
                                </tr>
                            @endforeach
                                @endif
                            </tbody>
                        </table>
                        {!! $solvacas->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
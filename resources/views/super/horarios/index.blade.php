@extends('layouts.sidebar')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Administrar Horarios</div>

                    <div class="panel-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" >Nombre</th>
                                <th scope="col" >D&iacute;a(s)</th>
                                <th scope="col" >Hora Ingreso</th>
                                <th scope="col" >Hora Salida</th>
                                <th scope="col" colspan="2" class="text-center">Acciones</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($horarios as $horario)
                                <tr>
                                    <th>{{$horario->nombre}}</th>
                                    <th>{{$horario->dias}}</th>
                                    <th>{{$horario->hora_ingreso}}</th>
                                    <th>{{$horario->hora_salida}}</th>
                                    <th>
                                        <a href="{{route('super.horarios.edit', $horario->id)}}">
                                            <button type="button" class="btn-primary btn-sm"> Editar </button>
                                        </a>
                                    </th>
                                    <th>
                                        <form action="{{ route('super.horarios.destroy', $horario->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{method_field('DELETE')}}
                                            <BUTTON type="submit" class="btn btn-danger btn-sm">Eliminar</BUTTON>
                                        </form>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                            {{$horarios->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
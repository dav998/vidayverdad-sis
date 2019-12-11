@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Administrar Horarios de {{$user->nombre}}</div>
                    <div class="panel-body">
                    <form action="{{route('super.userhora.update', ['user' => $user ->id])}}" method="POST">
                        {{ csrf_field() }}
                        {{method_field('PUT')}}
                        @foreach($horarios as $horario)
                            <div class="form-group">
                                <input type="checkbox" name="horarios[]" value="{{$horario->id}}"
                                {{$user->hasAnyHorario($horario->nombre)?'checked':''}}>
                                <label>{{$horario->nombre}}</label>
                            </div>
                            @endforeach
                        <button type="submit" class="center-block btn btn-success">Actualizar</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
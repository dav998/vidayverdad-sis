@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Administrar {{$user->nombre}}</div>
                    <div class="panel-body">
                    <form action="{{route('super.usuarios.update', ['user' => $user ->id])}}" method="POST">
                        {{ csrf_field() }}
                        {{method_field('PUT')}}
                        @foreach($roles as $role)
                            <div class="form-group">
                                <input type="checkbox" name="roles[]" value="{{$role->id}}"
                                {{$user->hasAnyRole($role->nombre)?'checked':''}}>
                                <label>{{$role->nombre}}</label>
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
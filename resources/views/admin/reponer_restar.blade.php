@extends('layouts.sidebar')

@section('content')
<div class="text-center m-t-lg">
    <h1>
        Reponer/Restar Vacaciones
    </h1>
</div>
<form action="{{action('Admin\ReponerVacasController@reponer', $user->id)}}" method="POST" role="form" enctype="multipart/form-data" id="prop-form">
    {{ csrf_field() }}
    <legend>Reponer/Restar Vacaciones Para: <br> <h2>{{$user->nombre}}</h2></legend>

    <div class="form-group">
        <label for="">Nombre</label>
        <input readonly value="{{$user->nombre}}"  type="text" class="form-control" name="nombre" id="nombre" >
    </div>

    <div class="form-group">
        <label for="">Carnet de identidad</label>
        <input readonly value="{{$user->ci}}"  type="number" class="form-control" name="ci" id="ci" placeholder="C.I.">
    </div>

    <div class="form-group">
        <label for="">Cargo</label>
        <input readonly value="{{$user->cargo}}"  type="text" class="form-control" name="cargo" id="cargo" placeholder="Cargo del solicitante">
    </div>
    <div class="form-group">
        <label for="">D&iacute;as a Reponer/Restar</label><br>
        *Nota: Numeros positivos repone dias, numeros negativos resta dias
        <input required value="{{old('dias')}}"  type="number" class="form-control" name="dias" id="dias">
    </div>

    <button type="submit"  class="btn btn-primary">Enviar</button>
</form>
</div>

</div>
@endsection
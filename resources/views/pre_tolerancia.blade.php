@extends('layouts.sidebar')

@section('content')
    <div class="text-center m-t-lg">
        <h1>
            Tolerancias/Salidas Anticipadas
        </h1>
    </div>

    <div>
    <form action="{{url('/crear_tolerancia')}}" method="POST" role="form" enctype="multipart/form-data" id="prop-form">
        {{ csrf_field() }}
        <legend>Solicitar Tolerancia/Salida Anticipada</legend>
        <div class="form-group">
            <label for="">Carnet de identidad</label>
            <input required value="{{old('ci')}}"  type="number" class="form-control" name="ci" id="ci" placeholder="Ingrese su C.I.">
        </div>

        <button type="submit"  class="btn btn-primary">Siguiente</button>
    </form>
    </div>
@endsection
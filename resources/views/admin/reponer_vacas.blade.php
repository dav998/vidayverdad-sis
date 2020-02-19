@extends('layouts.sidebar')

@section('content')
    <div class="text-center m-t-lg">
        <h1>
            Reponer/Restar Vacaciones
        </h1>
    </div>

    <div>
    <form action="{{url('admin/reponer_restar')}}" method="POST" role="form" enctype="multipart/form-data" id="prop-form">
        {{ csrf_field() }}
        <legend>Reponer/Restar Vacaciones</legend>
        <div class="form-group">
            <label for="">Carnet de identidad</label>
            <input required value="{{old('ci')}}"  type="number" class="form-control" name="ci" id="ci" placeholder="Ingrese el C.I. del empleado">
        </div>

        <button type="submit"  class="btn btn-primary">Siguiente</button>
    </form>
    </div>
@endsection
@extends('layouts.sidebar')

@section('content')

    <legend>Mi informaci&oacute;n</legend>

    <div class="row">
    <div class="col">
        <div class="form-group">
            <label for=""><b>Nombres y Apellidos: </b></label>
            {{$user->nombre}}
        </div>

        <div class="form-group">
            <label for=""><b>Carnet de Identidad:</b></label>
            {{$user->ci}}
        </div>
        <div class="form-group">
            <label for=""><b>Cargo:</b></label>
            {{$user->cargo}}
        </div>

        <div class="form-group">
            <label for=""><b>Correo Electr&oacute;nico:</b></label>
            {{$user->email}}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for=""><b>A&ntilde;o de Ingreso: </b></label>
            {{$user->ano_ingreso}}
        </div>
        <div class="form-group">
            <label for=""><b>A&ntilde;os Trabajados al {{now()->year}}: </b></label>
            @php
                {{$ano =(int)now()->year;}}
            @endphp
            {{$ano - (int)$user->ano_ingreso }}
        </div>

    </div>
    </div>

@endsection
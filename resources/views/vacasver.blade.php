@extends('layouts.sidebar')

@section('content')

    <style>
        * {
            box-sizing: border-box;
        }

        /* Create three equal columns that floats next to each other */
        .column {
            float: left;
            width: 33.33%;
            padding: 10px;
            height: 300px; /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
            .column {
                width: 100%;
            }
        }
    </style>
    <div class="row">
        <legend><h2>Ver Solicitud de Vacacion</h2> </legend>
    </div>

    <div class="row">
        <div class="column" >
            <label for=""><h5>Nombre:</h5></label> {{$user->nombre}}<br>
            <label for=""><h5>Cargo:</h5></label> {{$user->cargo}}<br>
            <label for=""><h5>Fecha de Ingreso:</h5></label> {{date('d/m/Y', strtotime($user->ano_ingreso))}}
        </div>
        <div class="column">

        </div>
        <div class="column">
            <label for=""><h5>Gesti&oacute;n:</h5></label> {{now()->year}}<br>
            <label for=""><h5>A&ntilde;os de Servicio al {{Date('d/m/Y')}}:</h5></label> {{$vacas->anos_trabajados}}
        </div>
    </div>
    <div class="row">
        <div class="row">
            @if($solvacas->tipo == 1)
            <h5><label>Tipo de Solicitud: </label> Invierno</h5>
                @else
            @if($solvacas->tipo == 2)
                    <h5><label>Tipo de Solicitud: </label> Fin de A&ntilde;o</h5>
                @else
                    <h5><label>Tipo de Solicitud: </label> A Cuenta</h5>
                @endif
                @endif

        </div>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col"  colspan="5" class="text-center">Datos Solicitud De Vacacion</th>
            </tr>
            <tr>
                <th scope="col" class="text-center" >Fecha Inicio</th>
                <th scope="col" class="text-center">Fecha Fin</th>
                <th scope="col" class="text-center">Total Vacacion (Dias)</th>
                <th scope="col" class="text-center">Dias a Utilizar</th>
                <th scope="col" class="text-center">Dias Pendientes</th>
            </tr>

            </thead>
            <tbody>
            <tr>
                <td class="text-center">{{date('d/m/Y', strtotime($solvacas->fecha_inicio))}}</td>
                <td class="text-center">{{date('d/m/Y', strtotime($solvacas->fecha_fin))}}</td>
                <td class="text-center">{{$vacas->dias_disp}}</td>
                <td class="text-center">{{$solvacas->dias}}</td>
                <td class="text-center">{{$vacas->dias_disp-$solvacas->dias}}</td>

            </tr>
            <tr>
                <th scope="row" colspan="5" class="text-center">Estado</th>
            </tr>
            <tr>
                @if($solvacas->aprobado == 1)
                <th scope="col" colspan="5" class="text-center"><button type="button" class="btn-success btn-lg"> APROBADO </button></th>
                    @else
                @if($solvacas->aprobado == 2)
                        <th scope="col" colspan="5" class="text-center"><button type="button" class="btn-danger btn-lg"> RECHAZADO </button></th>
                    @else
                        <th scope="col" colspan="5" class="text-center"><button type="button" class="btn-dark btn-lg"> EN ESPERA </button></th>
                    @endif
                    @endif
            </tr>
            </tbody>
        </table>

    </div>


@endsection
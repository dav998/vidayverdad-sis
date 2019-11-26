@extends('layouts.sidebar')

@section('content')


    <script   src="https://code.jquery.com/jquery-3.3.1.min.js"   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   crossorigin="anonymous"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
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
    </style>

    <style type="text/css">
        @media print {
            #printbtn {
                display :  none;
            }
        }
    </style>
    <body>
    <button id="printbtn" onclick="myFunction()" class="btn-primary">Pasar a PDF</button>
    @foreach($datas as $data)
        <div id="print">
        <br><br><div class="container">
        <div class="row" >
            <div class="col-md-12">
                <div class="panel panel-default">
                    <br>
                    <div class="panel-body" style="width: 100%; display: table;">
                        <div class="form-group" style="display: table-row">
                            <div class="form-group" style="width: 600px; display: table-cell;">
                                <label for=""><h5>Nombre:</h5></label> {{$data->nombre}}<br>
                                <label for=""><h5>Cargo:</h5></label> {{$data->cargo}}<br>
                                <label for=""><h5>Fecha de Ingreso:</h5></label> {{date('d/m/Y', strtotime($data->ano_ingreso))}}
                            </div>
                            <div style="display: table-cell;">
                                <label for=""><h5>Gesti&oacute;n:</h5></label> {{now()->year}}<br>
                                <label for=""><h5>A&ntilde;os de Servicio al {{Date('d/m/Y')}}:</h5></label> {{$data->anos_trabajados}}
                            </div>
                        </div><br>
                        <div class="center-block" align="right">
                            <label for=""><h5>Dias de Vacaci&oacute;n Pendientes: </h5></label>

                             {{$data->dias_disp}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br><br>
    <div class="center-block" >
    <TABLE >
        <thead>
        <tr>
            <th style="width: 400px" scope="col" class="text-center">------------------------------------</th>
            <th style="width: 500px" scope="col" class="text-center">------------------------------------</th>
            <th style="width: 400px" scope="col" class="text-center">------------------------------------</th>
        </tr>
        </thead>
        <tbody>
        <td class="text-center">Firma del Empleado</td>
        <td class="text-center">Firma de Direci&oacute;n General</td>
        <td class="text-center">Vo. Bo. Administraci&oacute;n</td>
        </tbody>
    </TABLE>
    </div>
    @endforeach
        </div>
        <div class="form-group" id="printbtn">
            <br>
        {{ $datas->links() }}
        </div>
    </body>


    <script>
        function myFunction() {
            window.print();
        }
    </script>
@endsection
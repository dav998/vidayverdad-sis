@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">/Reporte Vacaciones</div>
                    <br>
                    <div class="panel-body" style="width: 100%; display: table;">
                        <legend><h3>Reporte de Vacaciones</h3></legend><br>
                        <div class="form-group" style="display: table-row">
                            <div class="form-group" style="width: 600px; display: table-cell;">
                            <label for=""><h5>Nombre:</h5></label> {{$user->nombre}}<br>
                            <label for=""><h5>Cargo:</h5></label> {{$user->cargo}}<br>
                            <label for=""><h5>Fecha de Ingreso:</h5></label> {{date('d/m/Y', strtotime($user->ano_ingreso))}}
                            </div>
                            <div style="display: table-cell;">
                                <label for=""><h5>Gesti&oacute;n:</h5></label> {{now()->year}}<br>
                                <label for=""><h5>A&ntilde;os de Servicio al {{Date('d/m/Y')}}:</h5></label> {{$vacas->anos_trabajados}}
                            </div>
                        </div><br>
                        <div class="center-block" align="right">
                            <label for=""><h5>Dias de Vacaci&oacute;n Pendientes: </h5></label>

                           <button type="button" class="btn-dark btn-lg"> {{$vacas->dias_disp}} </button>

                        </div>

                            <div class="form-group">
                            </div>
                    </div>


                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
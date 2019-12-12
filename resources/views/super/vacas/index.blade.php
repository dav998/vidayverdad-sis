@extends('layouts.sidebar')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Actualizar Vacaciones</div>
                    <div class="center-block">
                        <div class="center-block">
                            <a href="{{action('Super\VacasSuperController@actualizar')}}" class="btn btn-success btn-block">Actualizar</a>
                        </div><br>
                        <div class="alert-warning">
                            <b>NOTA:</b> Esta funci&oacute;n actualizar&aacute; la informaci&oacute;n de vacaciones de los empleados. <br>
                            <b>DEBE SER PRESIONADO SOLO AL INICIO DE GESTI&Oacute;N.</b> Solo se puede ejecutar la funci&oacute;n una vez al a&ntilde;o.

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
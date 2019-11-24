@extends('layouts.sidebar')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Actualizar Vacaciones</div>

                    <div class="panel-body">
                       <a href="{{action('Super\VacasSuperController@actualizar')}}"><button class="btn-primary">Actualizar </button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
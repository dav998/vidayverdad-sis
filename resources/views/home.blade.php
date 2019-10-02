@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Sesi&oacute;n Iniciada</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        @hasrole('super')
                        Bienvenido Super Usuario!
                        @endhasrole

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

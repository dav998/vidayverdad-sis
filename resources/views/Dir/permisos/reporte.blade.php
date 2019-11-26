@extends('layouts.sidebar')

@section('content')
<script>
    function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';

    // Create download link element
    downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if(navigator.msSaveOrOpenBlob){
    var blob = new Blob(['\ufeff', tableHTML], {
    type: dataType
    });
    navigator.msSaveOrOpenBlob( blob, filename);
    }else{
    // Create a link to the file
    downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

    // Setting the file name
    downloadLink.download = filename;

    //triggering the function
    downloadLink.click();
    }
    }
</script>

<style>


</style>
<body>
<div class="row">
                    <div class="panel-heading">Administrar Solicitudes/Permiso/Tolerancia/Pendientes</div>
                        <table class="table" id="solicitudes">
                            <thead class="thead-dark">
                            <tr style="overflow-x: auto">
                                <th class="text-center" scope="col" >Nombre y Apellido</th>
                                <th class="text-center" scope="col" >Cargo</th>
                                <th class="text-center" scope="col" >Solicitudes Aprovadas</th>
                                <th class="text-center" scope="col" >Solicitudes Rechazadas</th>
                                <th class="text-center" scope="col" >Solicitudes En Espera</th>
                                <th class="text-center" scope="col" >Total Solicitudes</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($datas->isEmpty())
                                <tr><th colspan="5" class="text-center">No hay registro de solicitudes</th></tr>
                            @else
                            @foreach($datas as $data)

                                <tr>
                                    <th  >{{$data->nombre}}</th>
                                    <th >{{$data->cargo}}</th>
                                    <th class="text-center" >{{$data->aprobado}}</th>
                                    <th class="text-center">{{$data->rechazado}}</th>
                                    <th class="text-center">{{$data->espera}}</th>
                                    <th class="text-center">{{$data->solicitudes_enviadas}}</th>
                                </tr>
                            @endforeach
                                @endif
                            </tbody>
                        </table>
</div>
<button class="btn-primary" onclick="exportTableToExcel('solicitudes', 'Reporte_solicitudes')">Descargar en Excel</button>
@endsection
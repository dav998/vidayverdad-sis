@extends('layouts.sidebar')

@section('content')
<script>
    function exportTableToExcels(tableID, filename = ''){
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
<div class="panel-heading">Reportes/Vacaciones</div>
<div class="row">

    <div>
        <form class="form-inline active-cyan-4">
            <i class="fas fa-search" aria-hidden="true">Busca Aqu&iacute;</i>
            <input id="myInput" class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Buscar"
                   aria-label="Search">

        </form><br> </div>
                        <table class="table" id="reportevacas">
                            <thead class="thead-dark">
                            <tr style="overflow-x: auto">
                                <th class="text-center" scope="col" >Nombre y Apellido</th>
                                <th class="text-center" scope="col" >Cargo</th>
                                <th class="text-center" scope="col" >Fecha de Ingreso</th>
                                <th class="text-center" scope="col" >A&ntilde;os trabajados al {{Date('d/m/Y')}}</th>
                                <th class="text-center" scope="col" >Dias de Vacacion por Antig&utilde;edad</th>
                                <th class="text-center" scope="col" >Dias Disponibles Gestion {{now()->year - 1}}</th>
                                <th class="text-center" scope="col" >Dias de Vacacion Gestion {{now()->year}}</th>
                                <th class="text-center" scope="col" >Dias Tomados Gestion {{now()->year}}</th>
                                <th class="text-center" scope="col" >Total Dias de Vacacion</th>

                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @if($datas->isEmpty())
                                <tr><th colspan="9" class="text-center">No hay registro de vacaciones</th></tr>
                            @else
                            @foreach($datas as $data)

                                <tr>
                                    <th  >{{$data->nombre}}</th>
                                    <th >{{$data->cargo}}</th>
                                    <th >{{date('d/m/Y', strtotime($data->ano_ingreso))}}</th>
                                    <th class="text-center">{{$data->anos_trabajados}}</th>
                                    <th class="text-center">{{$data->dias_totales}}</th>
                                    <th class="text-center">{{$data->dias_cuenta}}</th>
                                    <th class="text-center">{{$data->dias_cuenta + $data->dias_totales}}</th>
                                    <th class="text-center">{{$data->dias_tomados}}</th>
                                    <th class="text-center">{{$data->dias_disp}}</th>
                                </tr>
                            @endforeach
                                @endif
                            </tbody>
                        </table>
    {{ $datas->links() }}
</div>
<button class="btn-primary" onclick="exportTableToExcels('reportevacas', 'Reporte_vacaciones')">Descargar en Excel</button>
@endsection
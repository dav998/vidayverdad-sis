@foreach($infos as $info)
Estimada <strong>Administraci&oacute;n/Direcci&oacute;n</strong>,<br>

    Se Envio una solicitud de vacaci&oacute;n @if($info->tipo == 1)
    INVIERNO
@else
    @if($info->tipo == 2)
        FIN DE A&Ntilde;O
    @else
       A CUENTA
    @endif
@endif:

<p>Nombre: {{ $info->nombre }}</p>
<p>Cargo: {{ $info->cargo }}</p>
<p>Fecha de inicio: {{ $info->fecha_inicio }}</p>
<p>Fecha fin: {{ $info->fecha_fin}}</p>
<p>Dias de vacaci&oacute;n: {{ $info->dias}}</p>

Favor revise en el sistema y apruebe o rechaze la misma.
@endforeach

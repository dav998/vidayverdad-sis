@foreach($infos as $info)
Estimada <strong>Administraci&oacute;n/Direcci&oacute;n</strong>,<br>

    Se Envio una solicitud de @if($info->tipo == 1)
    TOLERANCIA
@else
    @if($info->tipo == 2)
        SALIDA ANTICIPADA
    @else
       PERMISO
    @endif
@endif:

<p>Nombre: {{ $info->nombre }}</p>
<p>Cargo: {{ $info->cargo }}</p>
<p>Fecha de Ausencia: {{ $info->fecha_ausencia }}</p>
<p>Motivo: {{ $info->motivo}}</p>

Favor revise en el sistema y apruebe o rechaze la misma.
@endforeach

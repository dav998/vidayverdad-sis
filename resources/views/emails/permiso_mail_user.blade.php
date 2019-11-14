@foreach($infos as $info)
Estimado(a) <strong>{{$info->nombre}}</strong>,<br>

    Su solicitud de @if($info->tipo == 1)
    TOLERANCIA
@else
    @if($info->tipo == 2)
        SALIDA ANTICIPADA
    @else
       PERMISO
    @endif
@endif,
ha sido: @if($info->aprobado == 1)
<strong>APROBADA</strong>
@else
    @if($info->aprobado == 2)
        <strong>RECHAZADA</strong>
    @endif
@endif
<br>
Observaciones:
<strong>{{ $info->observaciones}}</strong><br>
Datos de la Solicitud:
<p>Nombre: {{ $info->nombre }}</p>
<p>Cargo: {{ $info->cargo }}</p>
<p>Fecha de Ausencia: {{ $info->fecha_ausencia }}</p>
<p>Motivo: {{ $info->motivo}}</p>

Gracias por su atenci&oacute;n.
@endforeach

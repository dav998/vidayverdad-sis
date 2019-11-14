@foreach($infos as $info)
Estimado(a) <strong>{{$info->nombre}}</strong>,<br>

    Su solicitud de vacaci&oacute;n @if($info->tipo == 1)
    <strong> INVIERNO</strong>
@else
    @if($info->tipo == 2)
                <strong>FIN DE A&Ntilde;O</strong>
    @else
                        <strong> A CUENTA</strong>
    @endif
@endif, ha sido: @if($info->aprobado == 1)
    <strong>APROBADA</strong>
@else
    @if($info->aprobado == 2)
        <strong>RECHAZADA</strong>
    @endif
@endif
<br>
Observaciones:
<strong>{ $info->observaciones}}</strong><br>

Datos de Solicitud:

<p>Nombre: {{ $info->nombre }}</p>
<p>Cargo: {{ $info->cargo }}</p>
<p>Fecha de inicio: {{ $info->fecha_inicio }}</p>
<p>Fecha fin: {{ $info->fecha_fin}}</p>
<p>Dias de vacaci&oacute;n: {{ $info->dias}}</p>

Gracias por su atenci&oacute;n.
@endforeach

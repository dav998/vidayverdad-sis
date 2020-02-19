@foreach($infos as $info)
Estimado(a) <strong>{{$info->nombre}}</strong>,<br>

@if($info->dias_repuestos > 0)
    <strong> Le fueron repuestos {{$info->dias_repuestos}} d&iacute;s de vacaci&oacute;n.</strong>
   @else
    <strong> Le fueron restados {{$info->dias_repuestos * -1}} d&iacute;s de vacaci&oacute;n.</strong>
    @endif

<br>
Motivo:
<strong>{{$info->motivo}}</strong><br>

Datos de Solicitud:

Gracias por su atenci&oacute;n.
@endforeach

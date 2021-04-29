@component('mail::message')
# Hola {{ $report->reportable->$relation->first_name }} <br>

Una de tus Propiedades ha sido reportada: <br>

<ul>
<li>
Causa del Reporte: <strong>{{ $report->reporting_cause }}</strong>
</li>
<li>
Comentarios Adicionales:
<strong class="text-sm-text-gray-700 font-light">
{{ $report->comments }}
</strong>
</li>

</ul>

<br>

<div>
Será revisada cuidadosamente para asegurar que no haya violaciones de acuerdo a las <a href="#">reglas de publicaciones</a>
y que el reporte sea legítimo.
</div>
<br>
<div>
Haz clic en el siguiente enlace para verificar la identidad de la propiedad.
</div>
<br>
<div>
El enlace expirara en un periodo de 5 días hábiles y la propiedad pasara a estatus "No Público", para publicar de nuevo
inicia sesión y haz clic en Publicar propiedad.
</div>

{{--@component('mail::button', ['url' => ''])
Enlace de verificacion
@endcomponent--}}

Gracias por formar parte de Houseify.io,<br>
{{ config('app.name') }}
@endcomponent

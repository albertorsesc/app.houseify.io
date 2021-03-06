@component('mail::message')
# Hola {{ $report->reportable->seller->first_name }}

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
Sera revisada cuidadosamente para asegurar que no haya violaciones de acuerdo a las <a href="#">reglas de publicaciones</a>
y que el reporte sea legitimo.
</div>
<br>
<div>
Haz click en el siguiente enlace para verificar la identidad de la propiedad.
</div>
<br>
<div>
El enlace expirara en un periodo de 5 dias habiles y la propiedad pasara a estatus "No Publico", para publicar de nuevo
inicia sesion y haz click en Publicar propiedad.
</div>

@component('mail::button', ['url' => ''])
Enlace de verificacion
@endcomponent

Gracias por formar parte de Houseify.io,<br>
{{ config('app.name') }}
@endcomponent

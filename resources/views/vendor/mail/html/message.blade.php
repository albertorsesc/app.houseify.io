@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<span class="italic text-emerald-500 font-medium text-xl">
<span class="flex justify-center text-center items-center">
<img src="{{ asset('/logos/houseify-13.png') }}" height="50" width="130" class="object-cover" alt="Houseify.io logo">
</span>
</span>
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('Derechos reservados.')
@endcomponent
@endslot
@endcomponent

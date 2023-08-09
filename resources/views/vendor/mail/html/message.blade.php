@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header')
{{ config('app.name') }}
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
<h4 style="color: white">© {{ date('Y') }} COCOCO @lang('Todos los derechos reservados.')</h4>
@endcomponent
@endslot
@endcomponent

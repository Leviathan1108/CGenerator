@component('mail::message')
# Hello {{ $name }},

Here is your certificate. 🎓

Thanks,<br>
{{ config('app.name') }}
@endcomponent

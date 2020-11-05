@component('mail::message')
# Bienvenue

Merci de votre inscription !

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

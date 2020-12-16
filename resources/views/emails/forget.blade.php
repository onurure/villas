@component('mail::message')

@component('mail::button', ['url' => url('user/passwordreset/'.$pass->token) ])
{{ Ceviri('Şifre Sıfırla')}}
@endcomponent

{{ Ceviri('Teşekkürler')}},<br>
{{ config('app.name') }}
@endcomponent

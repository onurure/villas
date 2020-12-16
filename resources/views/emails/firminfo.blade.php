@component('mail::message')

villastock giriş bilgileriniz;
<br>
email: {{ $req->email}}<br>
şifre: {{ $req->pass}}<br>

{{ Ceviri('Teşekkürler')}},<br>
{{ config('app.name') }}
@endcomponent

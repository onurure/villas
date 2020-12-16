@component('mail::message')

{{ Ceviri('VillaStock.com hizmetler sayfanızdan mesajınız var.') }}
<br>
{{ $service->title}}
<br>
{{ $req->s_mail}}<br>
{{ $req->s_telefon}}<br>
{{ $req->s_message}}

{{ Ceviri('Teşekkürler')}},<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')

VillaStock.com iletişim formundan mesajınız var.
<br>
{{ $req->name}}<br>
{{ $req->email}}<br>
{{ $req->comments}}

{{ Ceviri('Teşekkürler')}},<br>
{{ config('app.name') }}
@endcomponent

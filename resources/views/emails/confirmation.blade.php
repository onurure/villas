@component('mail::message')

{{ Ceviri('VillaStock.com a üye olduğunuz için teşekkürler') }}. {{ Ceviri('Sistemi kullanmak için altta yer alan düğmeye basarak mail adresinizi onaylamanız gereklidir') }}

@component('mail::button', ['url' => url('user/confirmation/'.$user->id.'/'.$user->mailtoken) ])
{{ Ceviri('Onayla')}}
@endcomponent

{{ Ceviri('Teşekkürler')}},<br>
{{ config('app.name') }}
@endcomponent

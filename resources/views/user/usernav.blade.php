<div class="my-account-nav-container">
	@if(Auth::guard('firm')->check())
		<ul class="my-account-nav">
			<li class="sub-nav-title">{{ Ceviri('Servis Yönetimi') }}</li>
			<li><a href="{{ url('user/my-services') }}"><i class="sl sl-icon-docs"></i> {{ Ceviri('Servisim') }}</a></li>
			@if(Auth::guard('firm')->user()->service)
			@else
				<li><a href="{{ url('user/service') }}"><i class="sl sl-icon-action-redo"></i> {{ Ceviri('Yeni Servis') }}</a></li>
			@endif
		</ul>
		<ul class="my-account-nav">
			<li><a href="{{ url('logoutf') }}"><i class="sl sl-icon-power"></i> {{ Ceviri('Çıkış') }}</a></li>
		</ul>
	@else
		<ul class="my-account-nav">
			<li class="sub-nav-title">{{ Ceviri('Hesap Yönetimi') }}</li>
			<li><a href="{{ url('user/account') }}"><i class="sl sl-icon-user"></i> {{ Ceviri('Hesabım') }}</a></li>
			<li><a href="{{ url('user/bookmark') }}"><i class="sl sl-icon-star"></i> {{ Ceviri('Favorilerim') }}</a></li>
		</ul>

		<ul class="my-account-nav">
			<li class="sub-nav-title">{{ Ceviri('İlan Yönetimi') }}</li>
			<li><a href="{{ url('user/my-properties') }}"><i class="sl sl-icon-docs"></i> {{ Ceviri('İlanlarım') }}</a></li>
			<li><a href="{{ url('user/property') }}"><i class="sl sl-icon-action-redo"></i> {{ Ceviri('Yeni İlan Ver') }}</a></li>
		</ul>

		<ul class="my-account-nav">
			<li><a href="{{ url('user/change_password') }}"><i class="sl sl-icon-lock"></i> {{ Ceviri('Şifre Değiştir') }}</a></li>
			<li><a href="{{ url('logout') }}"><i class="sl sl-icon-power"></i> {{ Ceviri('Çıkış') }}</a></li>
		</ul>
	@endif

</div>

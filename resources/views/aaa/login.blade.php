@extends('layout')
@section('ustarama')
	<form action="{{ url('villas/sale') }}" method="get" id="homepagesearchtop">
		<!-- Status -->
		<div class="col-md-2 col-xs-hidden ustten">
			<select id="selecttypeTop" data-placeholder="Select Type" class="chosen-select-no-single" onchange="FormActionChangeTop()">
				<option value="1" selected="selected">{{ Ceviri('Satılık') }}</option>
				<option value="2">{{ Ceviri('Kiralık') }}</option>
			</select>
		</div>
		<div class="col-md-5 col-xs-hidden ustten">
			<div class="main-search-input">
				<input type="text" placeholder="{{ Ceviri('Anahtar kelime ya da ilan numarası girin') }}" value="" name="kw"/>
				<button class="button"><i class="fa fa-search"></i></button>
			</div>
		</div>
   </form>
@endsection
@section('breadcrumb')
<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>{{ Ceviri('Üye Girişi') }} & {{ Ceviri('Üye Ol') }}</h2>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="{{url('/')}}">{{ Ceviri('Anasayfa') }}</a></li>
						<li>{{ Ceviri('Üye Girişi') }} & {{ Ceviri('Üye Ol') }}</li>
					</ul>
				</nav>

			</div>
		</div>
	</div>
</div>

@endsection
@section('content')
<!-- Container -->
<div class="container">

	<div class="row">
	<div class="col-md-4 col-md-offset-4">

	<!--Tab -->
	<div class="my-account style-1 margin-top-5 margin-bottom-40">

		<ul class="tabs-nav">
			<li class=""><a href="#tab1">{{ Ceviri('Üye Girişi') }}</a></li>
			<li><a href="#tab2">{{ Ceviri('Üye Ol') }}</a></li>
			<li><a href="#tab3">{{ Ceviri('Firma Girişi') }}</a></li>
		</ul>

		<div class="tabs-container alt">

			<!-- Login -->
			<div class="tab-content" id="tab1" style="display: none;">
				<form method="post" class="login" action="">
        			{{ csrf_field() }}

					<p class="form-row form-row-wide">
						<label for="email">{{ Ceviri('Email Adresi') }}:
							<i class="im im-icon-Mail"></i>
							<input type="text" class="input-text" name="email" id="email" value="{{ Request::old('email') }}" />
						</label>
					</p>

					<p class="form-row form-row-wide">
						<label for="password">{{ Ceviri('Şifre') }}:
							<i class="im im-icon-Lock-2"></i>
							<input class="input-text" type="password" name="password" id="password"/>
						</label>
					</p>

					<p class="form-row">
						<input type="hidden" name="login" value="Login">
						<input type="submit" class="button border margin-top-10" value="{{ Ceviri('Üye Girişi')}}" />
						<!--
							<label for="rememberme" class="rememberme">
							<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember Me</label>
						-->
					</p>

					<p class="lost_password">
						<a href="{{ url('lost') }}" >{{ Ceviri('Şifremi Unuttum') }}</a>
					</p>

				</form>
			</div>

			<!-- Register -->
			<div class="tab-content" id="tab2" style="display: none;">

				<form method="post" class="register" action="">
        {{ csrf_field() }}
				<p class="form-row form-row-wide">
					<label for="username2">{{ Ceviri('Kullanıcı Adı') }}:
						<i class="im im-icon-Male"></i>
						<input type="text" class="input-text" name="username2" id="username2" value="{{ Request::old('username2') }}" />
					</label>
				</p>

				<p class="form-row form-row-wide">
					<label for="email2">{{ Ceviri('Email Adresi') }}:
						<i class="im im-icon-Mail"></i>
						<input type="text" class="input-text" name="email2" id="email2" value="{{ Request::old('email2') }}" />
					</label>
				</p>

				<p class="form-row form-row-wide">
					<label for="password1">{{ Ceviri('Şifre') }}:
						<i class="im im-icon-Lock-2"></i>
						<input class="input-text" type="password" name="password1" id="password1"/>
					</label>
				</p>

				<p class="form-row form-row-wide">
					<label for="password2">{{ Ceviri('Şifre Tekrar') }}:
						<i class="im im-icon-Lock-2"></i>
						<input class="input-text" type="password" name="password2" id="password2"/>
					</label>
				</p>

				<p class="form-row">
					<input type="hidden" name="register" value="Register">
					<input type="submit" class="button border fw margin-top-10" value="{{ Ceviri('Üye Ol') }}" />
				</p>

				</form>
			</div>
			<div class="tab-content" id="tab3" style="display: none;">
				<form method="post" class="login" action="">
					{{ csrf_field() }}

					<p class="form-row form-row-wide">
						<label for="firmcode">{{ Ceviri('Firma Kodu') }}:
							<i class="im im-icon-Information"></i>
							<input type="text" class="input-text" name="firmcode" id="firmcode" value="{{ Request::old('firmcode') }}" />
						</label>
					</p>

					<p class="form-row form-row-wide">
						<label for="password">{{ Ceviri('Şifre') }}:
							<i class="im im-icon-Lock-2"></i>
							<input class="input-text" type="password" name="password" id="password"/>
						</label>
					</p>

					<p class="form-row">
						<input type="hidden" name="firmlogin" value="Firm Login">
						<input type="submit" class="button border margin-top-10" value="{{ Ceviri('Firma Girişi') }}" />
						<!--
							<label for="rememberme" class="rememberme">
							<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember Me</label>
						-->
					</p>

				</form>
			</div>
		</div>
	</div>



	</div>
	</div>

</div>
<!-- Container / End -->

@endsection

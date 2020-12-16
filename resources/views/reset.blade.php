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

				<h2>{{ Ceviri('Şifre Sıfırlama') }}</h2>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="{{url('/')}}">{{ Ceviri('Anasayfa') }}</a></li>
						<li>{{ Ceviri('Şifre Sıfırlama') }}</li>
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
			<li class=""><a href="#tab1">{{ Ceviri('Şifre Sıfırlama') }}</a></li>
		</ul>

		<div class="tabs-container alt">

			<!-- Login -->
			<div class="tab-content" id="tab1" style="display: none;">
				<form method="post" class="login" action="">
        			{{ csrf_field() }}
					<input type="hidden" name="token" value="{{ $token }}">
					<p class="form-row form-row-wide">
						<label for="email">{{ Ceviri('Email Adresi') }}:
							<i class="im im-icon-Mail"></i>
							<input type="text" class="input-text" name="email" id="email" value="{{ Request::old('email') }}" />
						</label>
					</p>
					<p class="form-row form-row-wide">
						<label for="passw1">{{ Ceviri('Yeni Şifre') }} :
							<i class="im im-icon-Mail"></i>
							<input type="password" class="input-text" name="passw1" id="passw1" value="{{ Request::old('passw1') }}" />
						</label>
					</p>
					<p class="form-row form-row-wide">
						<label for="passw1">{{ Ceviri('Yeni Şifre Tekrar') }}:
							<i class="im im-icon-Mail"></i>
							<input type="password" class="input-text" name="passw2" id="passw2" value="{{ Request::old('passw2') }}" />
						</label>
					</p>



					<p class="form-row">
						<input type="submit" class="button border margin-top-10" name="login" value="{{ Ceviri('Kaydet') }}" />
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

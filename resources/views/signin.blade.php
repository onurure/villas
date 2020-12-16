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
				@if(app('request')->input('f')==1)
				<h2>{{ Ceviri('Firma Girişi') }}</h2>
				@else
				<h2>{{ Ceviri('Üye Ol') }}</h2>
				@endif

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="{{url('/')}}">{{ Ceviri('Anasayfa') }}</a></li>
						@if(app('request')->input('f')==1)
							<li>{{ Ceviri('Firma Girişi') }}</li>
						@else
							<li>{{ Ceviri('Üye Ol') }}</li>
						@endif
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
	<div class="col-md-5">

	<!--Tab -->
	<div class="my-account style-1 margin-top-5 margin-bottom-40" id="normaluye">

		<ul class="tabs-nav">
			@if(app('request')->input('f')==1)
				<li><a href="#tab3">{{ Ceviri('Firma Girişi') }}</a></li>
			@else
				<li><a href="#tab1">{{ Ceviri('Üye Ol') }}</a></li>
			@endif
		</ul>

		<div class="tabs-container alt">

			<!-- Login -->
			<div class="tab-content" id="tab1" style="display: none;">
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

	<div class="my-account style-1 margin-top-5 margin-bottom-40 hidden" id="kurumsaluye">

		<ul class="tabs-nav">
			@if(app('request')->input('f')==1)
				<li><a href="#tab3">{{ Ceviri('Firma Girişi') }}</a></li>
			@else
				<li><a href="#tab1">{{ Ceviri('Kurumsal Üye Ol') }}</a></li>
			@endif
		</ul>

		<div class="tabs-container alt">

			<!-- Login -->
			<div class="tab-content" id="tab1" style="display: none;">
				<form method="post" class="register" action="">
					<input type="hidden" name="frm" value="1">
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

					<p class="form-row form-row-wide">

						<label for="password2">{{ Ceviri('Şirket Türü') }}:</label>
						<div class="checkboxes in-row margin-bottom-20">
							<input id="sirket1" type="checkbox" name="sirket" value="1">
							<label for="sirket1">{{ Ceviri('Şahıs Şirketi') }}</label>

							<input id="sirket2" type="checkbox" name="sirket" value="2">
							<label for="sirket2">{{ Ceviri('Limited & Anonim Şirket') }}</label>

						</div>
					</p>

					<p class="form-row form-row-wide">
						<label for="password2">{{ Ceviri('Ticari Ünvan') }}:
							<input class="input-text" type="text" name="ticari" id="ticari"/>
						</label>
					</p>

					<p class="form-row form-row-wide">
						<label for="vergid">{{ Ceviri('Vergi Dairesi') }}:
							<input class="input-text" type="text" name="vergid" id="vergid"/>
						</label>
					</p>

					<p class="form-row form-row-wide">
						<label for="vergino">{{ Ceviri('Vergi Numarası') }}:
							<input class="input-text" type="text" name="vergino" id="vergino"/>
						</label>
					</p>
					<p class="form-row form-row-wide">
						<label for="yetkili">{{ Ceviri('Yetkili') }}:
							<input class="input-text" type="text" name="yetkili" id="yetkili"/>
						</label>
					</p>
					<p class="form-row form-row-wide">
						<label for="firmaadres">{{ Ceviri('Firma Adres') }}:
							<textarea class="input-text" name="firmaadres" id="firmaadres"></textarea>
						</label>
					</p>

					<p class="form-row">
						<input type="hidden" name="register" value="Register2">
						<input type="submit" class="button border fw margin-top-10" value="{{ Ceviri('Kurumsal Üye Ol') }}" />
					</p>

				</form>
			</div>

		</div>
	</div>


	</div>
	<div class="col-md-5 col-md-offset-1">
		<div class="alert alert-warning" id="kurumsaluyari">
		  <h4 class="text-center">{{ Ceviri('Kurumsal Üye Ol') }}</h4>
		  <br>
		  <p>{{ Ceviri('Kurumsal üyelik') }}</p>
		  <br>
		  <p>{{ Ceviri('Kurumsal üyelik alt') }}</p>
		  <br>
		  <p class="text-center"><button class="btn btn-primary" onclick="KurumsalAc()">{{ Ceviri('Kurumsal Üye Ol') }}</button></p>
		</div>
	<!--Tab -->



	</div>
	<div class="col-md-1"></div>
	</div>

</div>
<!-- Container / End -->

@endsection

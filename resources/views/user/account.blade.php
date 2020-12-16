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

				<h2>{{ Ceviri('Hesabım') }}</h2>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="{{url('/')}}">{{ Ceviri('Anasayfa') }}</a></li>
						<li>{{ Ceviri('Hesabım') }}</li>
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


		<!-- Widget -->
		<div class="col-md-4">
			<div class="sidebar left">

				@include('user/usernav')

			</div>
		</div>

		<div class="col-md-8">
			<div class="row">


				<div class="col-md-12 my-profile">
					<form action="" method="post">
						{{ csrf_field() }}
						<h4 class="margin-top-0 margin-bottom-30">{{ Ceviri('Hesabım') }}</h4>

						<label>{{ Ceviri('Kullanıcı Adı') }}</label>
						<input value="{{ $user->name }}" type="text" name="name">

						<label>{{ Ceviri('Telefon') }}</label>
						<input value="{{ $user->telno }}" type="text" name="telno">

						<label>{{ Ceviri('GSM') }}</label>
						<input value="{{ $user->gsm }}" type="text" name="gsm">

						<label>{{ Ceviri('Email Adresi') }}</label>
						<input value="{{ $user->email }}" type="text" readonly="">


						<h4 class="margin-top-50 margin-bottom-25">{{ Ceviri('Hakkımızda') }}</h4>
						<textarea name="brief" id="about" cols="30" rows="10">{{ $user->brief }}</textarea>

	<!--
						<h4 class="margin-top-50 margin-bottom-0">Social</h4>

						<label><i class="fa fa-twitter"></i> Twitter</label>
						<input value="https://www.twitter.com/" type="text">

						<label><i class="fa fa-facebook-square"></i> Facebook</label>
						<input value="https://www.facebook.com/" type="text">

						<label><i class="fa fa-google-plus"></i> Google+</label>
						<input value="https://www.google.com/" type="text">

						<label><i class="fa fa-linkedin"></i> Linkedin</label>
						<input value="https://www.linkedin.com/" type="text">

	-->
						<button class="button margin-top-20 margin-bottom-20">{{ Ceviri('Kaydet') }}</button>
					</form>
				</div>


			</div>
		</div>

	</div>
</div>
<!-- Container / End -->

@endsection

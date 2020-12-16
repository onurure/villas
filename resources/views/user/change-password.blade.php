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
					<h4 class="margin-top-0 margin-bottom-30">{{ Ceviri('Şifre Değiştir') }}</h4>
					<form class="" action="" method="post">
						{{ csrf_field() }}
					<label>{{ Ceviri('Şifre') }}</label>
					<input type="password" name="password">

					<label>{{ Ceviri('Yeni Şifre') }}</label>
					<input type="password" name="password1">

					<label>{{ Ceviri('Yeni Şifre Tekrar') }}</label>
					<input type="password" name="password2">

					<button type="submit" class="margin-top-20 button">{{ Ceviri('Kaydet') }}</button>

					</form>
				</div>


			</div>
		</div>

	</div>
</div>
<!-- Container / End -->

@endsection

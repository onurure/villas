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

				<h2>{{ Ceviri('Servisim') }}</h2>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="{{url('/')}}">{{ Ceviri('Anasayfa') }}</a></li>
						<li>{{ Ceviri('Servisim') }}</li>
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
			<table class="manage-table responsive-table">

				<tr>
					<th><i class="fa fa-file-text"></i> {{ Ceviri('Servis') }}</th>
					<th class="expire-date"><i class="fa fa-calendar"></i> {{ Ceviri('Onay Kodu') }}</th>
					<th></th>
				</tr>
				@foreach($services as $service)
					<tr>
						<td class="title-container">
							<img src="{{ isset($service->simage->vitrine) ?  asset('storage/services/images/'.$service->simage->vitrine) : asset('images/yok.png') }}" onerror="this.src='{{asset('images/yok.png')}}'" alt="" class="img-responsive">
							<div class="title">
								<h4><a href="#">{{ $service->title }}</a></h4>
								<span> @if($service->approve==1) {{ Ceviri('Yayında') }} @else {{ Ceviri('Yayında Değil') }} @endif </span>
							</div>
						</td>
						<td class="expire-date">{{ $service->code }}</td>
						<td class="action">
							<a href="{{ url('user/service/'.$service->id) }}"><i class="fa fa-pencil"></i> {{ Ceviri('Düzenle') }}</a>
							<a href="#" class="delete"><i class="fa fa-remove"></i> {{ Ceviri('Sil') }}</a>
						</td>
					</tr>
				@endforeach

			</table>
		</div>

	</div>
</div>
<!-- Container / End -->

@endsection

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

				<h2>{{ Ceviri('Favorilerim') }}</h2>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="{{url('/')}}">{{ Ceviri('Anasayfa') }}</a></li>
						<li>{{ Ceviri('Favorilerim') }}</li>
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
					<th><i class="fa fa-file-text"></i> {{ Ceviri('İlan') }}</th>
					<th class="expire-date"> {{ Ceviri('Satılık') }} / {{ Ceviri('Kiralık') }}</th>
					<th></th>
				</tr>
				@if(isset($properties))
					@foreach($properties as $property)
						<tr>
							<td class="title-container">
								<img src="{{ isset($property->image->vitrine) ?  asset('images/villas/'.$property->image->vitrine) : asset('images/yok.png') }}" onerror="this.src='{{asset('images/yok.png')}}'" alt="" class="img-responsive">
								<div class="title">
									<h4><a href="{{ url('villa/'.$property->id.'/'.url_slug( $property->title)) }}">{{ $property->title }}</a></h4>
									<span> @if($property->approve==1) {{ Ceviri('Yayında') }} @else {{ Ceviri('Yayında Değil') }} @endif </span>
									<span class="table-property-price">{{ $property->price }} @if($property->type==2) / {{ Ceviri('aylık') }} @endif</span>
								</div>
							</td>
							<td class="expire-date">@if($property->type==1) {{ Ceviri('Satılık') }} @else {{ Ceviri('Kiralık') }} @endif</td>
							<td class="action">
								<a href="javascript:;" class="delete" onclick="FavRemove('{{$property->id}}')"><i class="fa fa-remove"></i> {{ Ceviri('Sil') }}</a>
							</td>
						</tr>
					@endforeach
				@endif
			</table>
		</div>

	</div>
</div>
<!-- Container / End -->

@endsection
@section('customjs')
	<script>
		function FavRemove(pid){
			$.ajax({
			type: "POST",
			url: "{{ url('user/favremove') }}",
			data: { _token: "{{ csrf_token() }}", pr_id: pid},
		        success: function(data){
					location.reload();
		        }
		    });
		}
	</script>
@endsection

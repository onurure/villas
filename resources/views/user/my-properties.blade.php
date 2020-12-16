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

				<h2>{{ Ceviri('İlanlarım') }}</h2>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="{{url('/')}}">{{ Ceviri('Anasayfa') }}</a></li>
						<li>{{ Ceviri('İlanlarım') }}</li>
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
					<th class="expire-date"><i class="fa fa-calendar"></i> {{ Ceviri('Yayınlanma Bitiş Tarihi') }}</th>
					<th></th>
				</tr>
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
						<td class="expire-date">{{ date('d.m.Y', strtotime($property->expiration_at)) }}</td>
						<td class="action">
							<a href="{{ url('user/property/'.$property->id) }}"><i class="fa fa-pencil"></i> {{ Ceviri('Düzenle') }}</a>
							<a href="javascript:;" class="delete" onclick="Delete('{{$property->id}}')"><i class="fa fa-remove"></i> {{ Ceviri('Sil') }}</a>
							<i class="fa fa-eye"></i> {{ $property->views }} <br/>
							<i class="fa fa-star"></i> {{ $property->favorites }}
						</td>
					</tr>
				@endforeach

			</table>

			<div class="pagination-container margin-top-20">
				{{ $properties->appends(request()->input())->links() }}
			</div>
		</div>

	</div>
</div>
<!-- Container / End -->

@endsection
@section('customjs')
	<script>
		function Delete(pid){
			$.ajax({
			type: "POST",
			url: "{{ url('user/propertydelete') }}",
			data: { _token: "{{ csrf_token() }}", pr_id: pid},
		        success: function(data){
					if(data.sonuc==true){
						location.reload();
					}else{
						alert('Silme işlemi başarısız');
					}
		        }
		    });
		}
	</script>
@endsection

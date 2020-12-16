@extends('layout')
@section('customcss')
	<link rel="stylesheet" href="{{ asset('css/jssocials.css') }}">
	<link rel="stylesheet" href="{{ asset('css/jssocials-theme-flat.css') }}">
@endsection
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
<div id="titlebar" class="property-titlebar margin-bottom-0">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="property-title">
					<h2>{{ $property->title }}</h2>
					<span>
						<i class="fa fa-map-marker"></i>
						{{ $property->address }} {{ $property->state }} {{ $property->city }} {{ $property->country }}
					</span>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('content')
<div class="container">
	<div class="row margin-bottom-50">
		<div class="col-md-12">
			<div class="property-slider-container">
				<div class="agent-widget">
					@if(isset($basari)&&$basari==1)
						{{ Ceviri('Teşekkürler') }}
					@else
						<form action="" method="post">
							<div class="agent-title">
								<div class="agent-details">
									<h4>{{$property->firm->name}}</h4>
									<span><i class="sl sl-icon-call-in"></i>{{$property->firm->telno}}</span>
								</div>
								<div class="clearfix"></div>
							</div>

							<input type="text" name="s_mail" placeholder="{{ Ceviri('Email Adresi') }}" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$">
							<input type="text" name="s_phone" placeholder="{{ Ceviri('Telefon') }}">
							<textarea name="s_message"></textarea>
							{{ csrf_field() }}
							<button type="submit" class="button fullwidth margin-top-5">{{ Ceviri('Gönder') }}</button>
						</form>
					@endif
				</div>
				<div class="property-slider">
					@if($property->simage!="")
						@foreach (json_decode($property->simage->image_links) as $image)
							<a href="{{ asset('storage/services/images/'.$image) }}" data-background-image="{{ asset('storage/services/images/'.$image) }}" class="item mfp-gallery"></a>
						@endforeach
					@else
						<a href="#" data-background-image="{{ asset('images/yok.png') }}" class="item mfp-gallery"></a>
					@endif
				</div>
			</div>
			<div class="property-slider-nav">
				@if($property->simage!="")
					@foreach (json_decode($property->simage->image_links) as $image)
						<div class="item"><img src="{{ asset('storage/services/images/'.$image) }}" alt=""></div>
					@endforeach
				@endif
			</div>

		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-lg-9 col-md-8">
			<div class="property-description">
				<h3 class="desc-headline">{{ Ceviri('Detaylar') }}</h3>
				<div class="">
					<p>
						{{ $property->about }}
					</p>
				</div>
				<h3 class="desc-headline">Google {{ Ceviri('Harita') }}</h3>
				<div class="googlemapiframe">
					{!! $property->googlemap !!}
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-4">
			<div class="sidebar sticky right">
				<div class="widget">
					<p>
						<span><i class="fa fa-map-marker"></i> {{ $property->address }} {{ $property->state }} {{ $property->city }} {{ $property->country }}</span>
					</p>
					<p>
						<span><i class="sl sl-icon-call-in"></i> {{ $property->telno }}</span>
					</p>
					<p>
						<span><i class="sl sl-icon-call-in"></i> {{ $property->cepno }}</span>
					</p>
					<p>
						<span><i class="fa fa-facebook"></i> {{ $property->fburl }}</span>
					</p>
					<p>
						<span><i class="fa fa-twitter"></i> {{ $property->twurl }}</span>
					</p>
					<p>
						<span><i class="fa fa-google-plus"></i> {{ $property->gourl }}</span>
					</p>
					<hr>
					<h4>{{ Ceviri('Paylaş') }}</h4>
					<div id="shareIcons"></div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('customjs')
	<script type="text/javascript" src="{{ asset('js/jssocials.min.js') }}"></script>
	<script>
		$(document).ready(function(){
			$("#shareIcons").jsSocials({
			    showLabel: false,
			    showCount: false,
			    shares: ["email", "twitter", "facebook", "googleplus", "pinterest", "whatsapp"]
			});
		});
		function Registered(){
			alert('This is only for registered user. Please sign up or sign in');
			$("#uyesiz").toggleClass('liked');
			$("#uyesiz").children('.like-icon').toggleClass('liked');
		}
		function Favorite(){
			$.ajax({
			type: "POST",
			url: "{{ url('user/favorite') }}",
			data: { _token: "{{ csrf_token() }}", pr_id: {{ $property->id }}},
		        success: function(data){
		        }
		    });
		}
	</script>
@endsection

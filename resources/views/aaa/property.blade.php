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
					<h2>{{ $property->title }}
						<span class="property-badge">{{ $property->type==1 ? Ceviri('Satılık') : Ceviri('Kiralık') }}</span></h2>
					<span>
						<i class="fa fa-map-marker"></i>
						{{ $property->address }} {{ $property->state }} {{ $property->city }} {{ $property->country }}
					</span>
				</div>
				<div class="property-pricing">
					<div>{{ FiyatD($property->price,$property->doviz) }} {{ $property->type == 2 ? '/ '.Ceviri('aylık') : '' }}
					@if(session()->get('doviz')==1)
						₺
					@elseif(session()->get('doviz')==2)
						$
					@elseif(session()->get('doviz')==3)
						€
					@endif</div>
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
				<div class="property-slider">
					@if($property->image!="")
						@foreach (json_decode($property->image->image_links) as $image)
							<a href="{{ asset('storage/images/'.$image) }}" data-background-image="{{ asset('storage/images/'.$image) }}" class="item mfp-gallery"></a>
						@endforeach
					@else
						<a href="#" data-background-image="{{ asset('images/yok.png') }}" class="item mfp-gallery"></a>
					@endif
				</div>
			</div>
			<div class="property-slider-nav">
				@if($property->image!="")
					@foreach (json_decode($property->image->image_links) as $image)
						<div class="item"><img src="{{ asset('storage/images/'.$image) }}" alt=""></div>
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
				<ul class="property-main-features">
					<li>{{ Ceviri('Alan') }} <span>{{ $property->area }} m&#178;</span></li>
					<li>{{ Ceviri('Bahçe Alanı') }} <span>{{ $property->gardenarea }} m&#178;</span></li>
					<li>{{ Ceviri('Odalar') }} <span>{{ $property->room }}</span></li>
					<li>{{ Ceviri('Banyolar') }} <span>{{ $property->bathroom }}</span></li>
					@if($property->buildingage!="")
						<li>{{ Ceviri('Bina Yaşı') }} <span>{{ $property->buildingage }}</span></li>
					@endif
					@if($property->floor!="")
						<li>{{ Ceviri('Kat Sayısı') }} <span>{{ $property->floor }}</span></li>
					@endif
					@if($property->buildingage!="")
						<li>{{ Ceviri('Isıtma') }}
							<span>
								@if($property->floor==1)
									{{ Ceviri('Soba') }}
								@elseif ($property->floor==2)
									{{ Ceviri('Merkezi Isıtma') }}
								@elseif ($property->floor==3)
									{{ Ceviri('Yerden Isıtma') }}
								@elseif ($property->floor==4)
									{{ Ceviri('Klima') }}
								@elseif ($property->floor==5)
									{{ Ceviri('Jeotermal') }}
								@elseif ($property->floor==6)
									{{ Ceviri('Şömine') }}
								@elseif ($property->floor==7)
									{{ Ceviri('Isı Pompası') }}
								@endif
							</span>
						</li>
					@endif
				</ul>
				<h3 class="desc-headline">{{ Ceviri('Detaylar') }}</h3>
				<div class="">
					<p>
						{{ $property->detail }}
					</p>
				</div>
				<h3 class="desc-headline">Google {{ Ceviri('Harita') }}</h3>
				<div class="googlemapiframe">
					{!! $property->googlemap !!}
				</div>
				<h3 class="desc-headline">{{ Ceviri('Ek Özellikler') }}</h3>
				<ul class="property-features checkboxes margin-top-0 margin-bottom-20">
					@if ($property->furniture==1)
						<li>{{ Ceviri('Eşyalı') }}</li>
					@endif
					@if ($property->detached==1)
						<li>{{ Ceviri('Tam Müstakil') }}</li>
					@endif
					@if ($property->insite==1)
						<li>{{ Ceviri('Site İçerisinde') }}</li>
					@endif
					@if ($property->garden==1)
						<li>{{ Ceviri('Bahçe') }}</li>
					@endif
					@if ($property->pool==1)
						<li>{{ Ceviri('Yüzme Havuzu') }}</li>
					@endif
					@if ($property->kidspool==1)
						<li>{{ Ceviri('Çocuk Yüzme Havuzu') }}</li>
					@endif
					@if ($property->garage==1)
						<li>{{ Ceviri('Garaj') }}</li>
					@endif
				</ul>
				<ul class="property-features checkboxes margin-top-0 margin-bottom-20">
					@if (strpos($property->manzara, '1'))
						<li>{{ Ceviri('Deniz') }}</li>
					@endif
					@if (strpos($property->manzara, '2'))
						<li>{{ Ceviri('Doğa') }}</li>
					@endif
					@if (strpos($property->manzara, '3'))
						<li>{{ Ceviri('Göl') }}</li>
					@endif
					@if (strpos($property->manzara, '4'))
						<li>{{ Ceviri('Havuz') }}</li>
					@endif
					@if (strpos($property->manzara, '5'))
						<li>{{ Ceviri('Şehir') }}</li>
					@endif
				</ul>

			</div>
		</div>
		<div class="col-lg-3 col-md-4">
			<div class="sidebar sticky right">
				<div class="widget margin-bottom-35">
					@if (Auth::check())
						@if (Auth::user()->id != $property->user->id)
							<button class="widget-button save" data-save-title="{{ Ceviri('Favorilerime Ekle') }}" data-saved-title="{{ Ceviri('Favorilerimde') }}" onclick="Favorite()"><span class="like-icon"></span></button>
						@endif
					@else
						<button id="uyesiz" class="widget-button save" data-save-title="{{ Ceviri('Favorilerimde') }}" data-saved-title="{{ Ceviri('Favorilerime Ekle') }}" onclick="Registered()"><span class="like-icon"></span></button>
					@endif
				</div>
				<div class="widget">
					<h3>{{ Ceviri('İlan Sahibi') }}</h3>
					<h4>{{ $property->user->name }}</h4>
					<br>
					<span><i class="sl sl-icon-call-in"></i> {{ $property->user->telno }}</span>
					<br>
					<span><i class="fa fa-envelope-o"></i> {{ $property->user->email }}</span>
					<br>
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

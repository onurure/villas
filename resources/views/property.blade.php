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
						<!--@if(session()->get('doviz')==1)
							₺
						@elseif(session()->get('doviz')==2)
							$
						@elseif(session()->get('doviz')==3)
							€
						@endif-->
						@if($property->doviz==1)
							₺
						@elseif($property->doviz==2)
							$
						@elseif($property->doviz==3)
							€
						@elseif($property->doviz==4)
							£
						@endif
					</div>
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
							<a href="{{ asset('images/villas/'.$image) }}" data-background-image="{{ asset('images/villas/'.$image) }}" class="item mfp-gallery"></a>
						@endforeach
					@else
						<a href="#" data-background-image="{{ asset('images/yok.png') }}" class="item mfp-gallery"></a>
					@endif
				</div>
			</div>
			<div class="property-slider-nav">
				@if($property->image!="")
					@foreach (json_decode($property->image->image_links) as $image)
						<div class="item"><img src="{{ asset('images/villas/'.$image) }}" alt=""></div>
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
				<h3 class="desc-headline">{{ Ceviri('Özellikler') }}</h3>
				<ul class="property-main-features">
					<li>{{ Ceviri('Alan') }} <span>{{ number_format($property->area,0,'','.') }} m&#178;</span></li>
					<li>{{ Ceviri('Bahçe Alanı') }} <span>{{ number_format($property->gardenarea,0,'','.') }} m&#178;</span></li>
					<li>{{ Ceviri('Odalar') }} <span>{{ $property->room }}</span></li>
					<li>{{ Ceviri('Salon') }} <span>{{ $property->salon }}</span></li>
					<li>{{ Ceviri('Banyolar') }} <span>{{ $property->bathroom }}</span></li>
					@if($property->buildingage!="")
						<li>{{ Ceviri('Bina Yaşı') }} <span>{{ $property->buildingage }}</span></li>
					@endif
					@if($property->floor!="")
						<li>{{ Ceviri('Kat Sayısı') }} <span>{{ $property->floor }}</span></li>
					@endif
					@if($property->heating!="")
						<li>{{ Ceviri('Isıtma') }}
							<span>
								@if($property->heating==1)
									{{ Ceviri('Soba') }}
								@elseif ($property->heating==2)
									{{ Ceviri('Merkezi Isıtma') }}
								@elseif ($property->heating==3)
									{{ Ceviri('Yerden Isıtma') }}
								@elseif ($property->heating==4)
									{{ Ceviri('Klima') }}
								@elseif ($property->heating==5)
									{{ Ceviri('Jeotermal') }}
								@elseif ($property->heating==6)
									{{ Ceviri('Şömine') }}
								@elseif ($property->heating==7)
									{{ Ceviri('Isı Pompası') }}
								@endif
							</span>
						</li>
					@endif
				</ul>
				<h3 class="desc-headline">{{ Ceviri('Ek Özellikler') }}</h3>
				<ul class="property-main-features checkboxes margin-top-0 margin-bottom-20">
					@if ($property->furniture==1)
						<input id="check-2" type="checkbox" name="" value="1" {{ $property->furniture == 1 ? 'checked' : ''}} onclick="return false;">
						<label for="check-2">{{ Ceviri('Eşyalı') }}</label>
					@endif
					@if ($property->detached==1)
						<input id="check-3" type="checkbox" name="" value="1" {{ $property->detached == 1 ? 'checked' : ''}} onclick="return false;">
						<label for="check-3">{{ Ceviri('Tam Müstakil') }}</label>
					@endif
					@if ($property->semidetached==1)
					<input id="check-10" type="checkbox" name="" value="1" {{ $property->semidetached == 1 ? 'checked' : ''}} onclick="return false;">
					<label for="check-10">{{ Ceviri('Yarı Müstakil') }}</label>
					@endif
					@if ($property->insite==1)
					<input id="check-4" type="checkbox" name="" value="1" {{ $property->insite == 1 ? 'checked' : ''}} onclick="return false;">
					<label for="check-4">{{ Ceviri('Site İçerisinde') }}</label>
					@endif
					@if ($property->garden==1)
					<input id="check-5" type="checkbox" name="" value="1" {{ $property->garden == 1 ? 'checked' : ''}} onclick="return false;">
					<label for="check-5">{{ Ceviri('Bahçe (Ortak)') }}</label>
					@endif
					@if ($property->garden1==1)
					<input id="check-11" type="checkbox" name="" value="1" {{ $property->garden1 == 1 ? 'checked' : ''}} onclick="return false;">
					<label for="check-11">{{ Ceviri('Bahçe (Müstakil)') }}</label>
					@endif
					@if ($property->pool==1)
					<input id="check-6" type="checkbox" name="" value="1" {{ $property->pool == 1 ? 'checked' : ''}} onclick="return false;">
					<label for="check-6">{{ Ceviri('Yüzme Havuzu (Ortak)') }}</label>
					@endif
					@if ($property->pool1==1)
					<input id="check-12" type="checkbox" name="" value="1" {{ $property->pool1 == 1 ? 'checked' : ''}} onclick="return false;">
					<label for="check-12">{{ Ceviri('Yüzme Havuzu (Müstakil)') }}</label>
					@endif
					@if ($property->kidspool==1)
					<input id="check-7" type="checkbox" name="" value="1" {{ $property->kidspool == 1 ? 'checked' : ''}} onclick="return false;">
					<label for="check-7">{{ Ceviri('Çocuk Yüzme Havuzu') }}</label>
					@endif
					@if ($property->garage==1)
					<input id="check-9" type="checkbox" name="" value="1" {{ $property->garage == 1 ? 'checked' : ''}} onclick="return false;">
					<label for="check-9">{{ Ceviri('Garaj') }}</label>
					@endif
				</ul>
				<h3 class="desc-headline">{{ Ceviri('Uzaklık Mesafesi') }}</h3>
				<ul class="property-main-features">
					<li>{{ Ceviri('Deniz') }} <span>{{ $property->seadistance>0 ? $property->seadistance.' m' : '-' }}</span></li>
					<li>{{ Ceviri('Market') }} <span>{{ $property->marketdistance>0 ? $property->marketdistance.' m' : '-' }}</span></li>
					<li>{{ Ceviri('Toplu Taşıma') }} <span>{{ $property->ttdistance>0 ? $property->ttdistance.' m' : '-' }}</span></li>
					<li>{{ Ceviri('Restorant') }} <span>{{ $property->resdistance>0 ? $property->resdistance.' m' : '-' }}</span></li>
					<li>{{ Ceviri('Merkez') }} <span>{{ $property->mdistance>0 ? $property->mdistance." km" : '-' }}</span></li>
					<li>{{ Ceviri('Havaalanı') }} <span>{{ $property->hadistance>0 ? $property->hadistance." km" : '-' }}</span></li>
				</ul>
				@if($property->manzara)
					<h3 class="desc-headline">{{ Ceviri('Manzara') }}</h3>
					<ul class="property-main-features checkboxes margin-top-0 margin-bottom-20">
						@if (strpos($property->manzara, '1') !== false)
							<input id="check-21" type="checkbox" name="" value="1" @if(strpos($property->manzara, '1') !== false) checked @endif  onclick="return false;">
							<label for="check-21">{{ Ceviri('Deniz') }}</label>
						@endif
						@if (strpos($property->manzara, '2') !== false)
						<input id="check-31" type="checkbox" name="" value="2" @if(strpos($property->manzara, '2') !== false) checked @endif onclick="return false;">
						<label for="check-31">{{ Ceviri('Doğa') }}</label>
						@endif
						@if (strpos($property->manzara, '3') !== false)
						<input id="check-41" type="checkbox" name="" value="3" @if(strpos($property->manzara, '3') !== false) checked @endif onclick="return false;">
						<label for="check-41">{{ Ceviri('Göl') }}</label>
						@endif
						@if (strpos($property->manzara, '4') !== false)
						<input id="check-51" type="checkbox" name="" value="4" @if(strpos($property->manzara, '4') !== false) checked @endif onclick="return false;">
						<label for="check-51">{{ Ceviri('Havuz') }}</label>
						@endif
						@if (strpos($property->manzara, '5') !== false)
						<input id="check-61" type="checkbox" name="" value="5" @if(strpos($property->manzara, '5') !== false) checked @endif onclick="return false;">
						<label for="check-61">{{ Ceviri('Şehir') }}</label>
						@endif
					</ul>
				@endif
				<h3 class="desc-headline">{{ Ceviri('Detaylar') }}</h3>
				<div class="">
					<p>
						{{ $property->detail }}
					</p>
				</div>
				@if($property->googlemap)
				<h3 class="desc-headline">Google {{ Ceviri('Harita') }}</h3>
				<div id="selectmap" class=" margin-bottom-20"></div>
				@endif


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

					<!-- Agent Widget -->
					<div class="agent-widget">

						@if($property->user->ticari)
							<h3>{{ Ceviri('İlan Sahibi') }}</h3>
							<h4>{{ $property->user->ticari }}</h4>
							@if($property->user->yetkili)
								<h4>{{Ceviri('Yetkili')}} {{ $property->user->yetkili }}</h4>
							@endif
							@if($property->user->adres)
								<h4>{{Ceviri('Firma Adres')}} {{ $property->user->adres }}</h4>
							@endif
						@else
							<h3>{{ Ceviri('İlan Sahibi') }}</h3>
							<h4>{{ $property->user->name }}</h4>
						@endif
						@if($property->user->telno)
							<span><i class="sl sl-icon-call-in"></i> <a href="tel:{{ $property->user->telno }}">{{ $property->user->telno }}</a></span>
							<br>
						@endif
						@if($property->user->gsm)
							<span><i class="sl sl-icon-call-in"></i> <a href="tel:{{ $property->user->gsm }}">{{ $property->user->gsm }}</a></span>
							<br>
						@endif
						<span><i class="fa fa-envelope-o"></i> {{ $property->user->email }}</span>
						<br>
						<hr>
						<div id="shareIcons"></div>
						<hr>
						<h3>Mesaj Gönder</h3>
						@if(isset($basari)&&$basari==1)
							{{ Ceviri('Teşekkürler') }}
						@else
							<form action="" method="post">
								<input type="text" name="s_mail" placeholder="{{ Ceviri('Email Adresi') }}" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$">
								<input type="text" name="s_phone" placeholder="{{ Ceviri('Telefon') }}">
								<textarea name="s_message"></textarea>
								{{ csrf_field() }}
								<button type="submit" class="button fullwidth margin-top-5">{{ Ceviri('Gönder') }}</button>
							</form>
						@endif
					</div>

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
	<script>
	@if($property->googlemap)
	function initMap() {
		var marker = null;
		<?php $latlng = explode('--',$property->googlemap); ?>
		var uluru = {lat: {{$latlng[0]}}, lng: {{$latlng[1]}} };
		var map = new google.maps.Map(document.getElementById('selectmap'), {
		  zoom: 10,
		  center: uluru
		});
		var marker = new google.maps.Marker({
		          position: uluru,
		          map: map
		        });
	}
	@endif
	</script>
	<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUvHj4WE7eK9DgnzJHfXr8cwT6WXWsXkY&callback=initMap">
	</script>
@endsection

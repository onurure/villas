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
@section('content')
<!-- Banner
================================================== -->
<div style="height:700px" id="ilkbolum">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="search-container">
					<!-- Form -->
					<h2>{{ Ceviri('Villa Arama')}}</h2>
					<!-- Row With Forms -->
					<div class="row with-forms">
						<form action="{{ url('villas/sale') }}" method="get" id="homepagesearch">
							<!-- Status -->
							<div class="col-md-3">
								<select id="selecttype" data-placeholder="Select Type" class="chosen-select-no-single" onchange="FormActionChange()">
									<option value="1" selected="selected">{{ Ceviri('Satılık') }}</option>
									<option value="2">{{ Ceviri('Kiralık') }}</option>
								</select>
							</div>
							<div class="col-md-6">
								<div class="main-search-input">
									<input type="text" placeholder="{{ Ceviri('Lokasyonu') }}" value="" name="lokasyon" id="lokasyon"/>
									<input type="hidden" id="aaa1" name="a1" value="">
									<input type="hidden" id="aaa2" name="a2" value="">
									<input type="hidden" id="aaa3" name="a3" value="">
									<input type="hidden" id="aaa4" name="a4" value="">
									<input type="hidden" id="aaa5" name="a5" value="">
									<input type="hidden" id="aaa6" name="a6" value="">
									<input type="hidden" id="aaa7" name="a7" value="">
									<button class="button"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3 class="headline margin-bottom-25 margin-top-65">{{ Ceviri('Vitrin') }}</h3>
		</div>
		<div class="col-md-12">
			<div class="row">
				@if($vitrines)
					@foreach ($vitrines as $vitrine)
						<div class="col-md-3">
							<div class="listing-item compact">
								<a href="{{ url('villa/'.$vitrine->id.'/'.url_slug( $vitrine->title)) }}" class="listing-img-container">
									<div class="listing-badges">
										<!--<span class="featured">Featured</span>-->
										<span>{{ $vitrine->type == 1 ? Ceviri('Satılık') : Ceviri('Kiralık') }}</span>
									</div>
									<div class="listing-img-content">
										<span class="listing-compact-title">{{ $vitrine->title }} <i>{{ $vitrine->price }}

											@if($vitrine->doviz==1)
												₺
											@elseif($vitrine->doviz==2)
												$
											@elseif($vitrine->doviz==3)
												€
											@elseif($property->doviz==4)
												£
											@endif
											{{ $vitrine->type == 2 ? '/ '.Ceviri('aylık') : '' }}</i></span>
										<ul class="listing-hidden-content">
											<li>{{ $vitrine->area }} m&#178;</li>
											<li>{{ $vitrine->room>1 ? $vitrine->room.' '.Ceviri('Odalar') : $vitrine->room.' '.Ceviri('Oda') }}</li>
											<li>{{ $vitrine->bathroom>1 ? $vitrine->bathroom.' '.Ceviri('Banyolar') : $vitrine->bathroom.' '.Ceviri('Banyo') }}</li>
										</ul>
									</div>
									<img class="vitrindekiler img-responsive" src="{{ isset($vitrine->image->vitrine) ?  asset('images/villas/'.$vitrine->image->vitrine) : asset('images/yok.png') }}" onerror="this.src='{{asset('images/yok.png')}}'" alt="{{ $vitrine->title }}">
								</a>
							</div>
						</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>
</div>
<!-- Featured / End -->
<!-- Hizmetler
<div class="parallax margin-bottom-70"
	data-background="images/listings-parallax.jpg"
	data-color="#36383e"
	data-color-opacity="0.7"
	data-img-width="800"
	data-img-height="505">

	<div class="text-content white-font">
		<div class="container">

			<div class="row">
				<div class="col-lg-6 col-sm-8">
					<h2>{{ Ceviri('Anasayfa hizmetler bölümü başlık') }}</h2>
					<p>{{ Ceviri('Anasayfa hizmetler bölümü açıklama') }}</p>
					<a href="{{ url('services') }}" class="button margin-top-25">{{ Ceviri('Hizmet Arama') }}</a>
				</div>
			</div>

		</div>
	</div>


</div>
hizmetler -->


<!-- Müşteri
<section class="fullwidth margin-top-105 margin-bottom-0 padding-bottom-80 padding-top-95" data-background-color="#f7f7f7">

	<h3 class="headline-box">{{ Ceviri('Müşterilerimiz Neler Söyledi') }}</h3>

	<div class="container">
		<div class="row">
			@foreach ($reviews as $review)
				<div class="col-md-4">
					<div class="testimonial-box">
						<div class="testimonial">{{ $review->review }}</div>
						<div class="testimonial-author">
							<img src="images/happy-client-01.jpg" alt="">
							<h4>{{ $review->name }} <span>{{ $review->job }}</span></h4>
						</div>
					</div>
				</div>
			@endforeach

		</div>
	</div>

</section>
Müşteri -->
<!-- Şehirler
<div class="container">
	<div class="row">

		<div class="col-md-12">
			<h3 class="headline centered margin-bottom-35 margin-top-10">{{ Ceviri('Popüler Şehirler') }} </h3>
		</div>
		<?php $i=0; ?>
		@foreach ($places as $place)
			<?php $i++;?>
			@if($i==1 || $i==4)
				<div class="col-md-4">

						<a href="{{ url('villas/sale?kw='.$place->name) }}" class="img-box" data-background-image="{{asset('images/'.$place->image)}}">


							<div class="img-box-content visible">
								<h4>{{$place->name}} </h4>
							</div>
						</a>

				</div>
			@else
				<div class="col-md-8">
					<a href="{{ url('villas/sale?kw='.$place->name) }}" class="img-box" data-background-image="{{asset('images/'.$place->image)}}">
						<div class="img-box-content visible">
							<h4>{{$place->name}} </h4>
						</div>
					</a>

				</div>
			@endif
		@endforeach

	</div>
</div>
Şehirler -->
<div id="selectmap1"></div>
@endsection
@section('customjs')
<script src="{{ asset('scripts/jquery.matchHeight.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/background.cycle.min.js') }}" type="text/javascript"></script>
<script>
	function FormActionChange(){
		var type = $('#selecttype').val();
		if(type == 1){
			$('#homepagesearch').attr('action', '{{ url("villas/sale") }}');
		}else{
			$('#homepagesearch').attr('action', '{{ url("villas/rent") }}');
		}
	}
	$(function() {
		$('.vitrindekiler').matchHeight();
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#ilkbolum").backgroundCycle({
			imageUrls: [
				'{{ asset('images/1.jpg') }}',
				'{{ asset('images/2.jpg') }}',
				'{{ asset('images/3.jpg') }}'
			],
			fadeSpeed: 2000,
			duration: 5000,
			backgroundSize: SCALING_MODE_COVER
		});
	});
</script>
<script>
var map;
var markers = [];
function initMap() {
var marker = null;
	var uluru = {lat: 38.8225909761771, lng: 34.7003173828125};
	var map = new google.maps.Map(document.getElementById('selectmap1'), {
	  zoom: 4,
	  center: uluru
	});

        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;

	google.maps.event.addListener(map, 'click', function(event) {
		setMapOnAll(null);
        markers = [];
		marker = new google.maps.Marker({
		  position : event.latLng,
		  map: map
		});
        markers.push(marker);
	 $("#latlong").val(event.latLng.lat()+"--"+event.latLng.lng());

	 console.log( event.latLng.lat());
	 console.log( event.latLng.lng());
	});
	var options = {
	  types: ['geocode']
	 };
    var input = document.getElementById('lokasyon');
    //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.bindTo('bounds', map);


    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
		geocodeLatLng(geocoder, map, infowindow, place.geometry.location);
		//console.log(place.geometry.location);
    });
}
function geocodeLatLng(geocoder, map, infowindow, location) {
	setMapOnAll(null);
	$("#aaa1").val("");
	$("#aaa2").val("");
	$("#aaa3").val("");
	$("#aaa4").val("");
	$("#aaa5").val("");
	$("#aaa6").val("");
	var lokasyonu  = $("#lokasyon").val();
	var latlngStr = lokasyonu.split(',');
	console.log(latlngStr);
	markers = [];
	var latlng = location;
	geocoder.geocode({'location': latlng}, function(results, status) {
	  if (status === 'OK') {
	    if (results[0]) {
	      map.setZoom(15);
	      var marker = new google.maps.Marker({
	        position: latlng,
	        map: map
	      });
          markers.push(marker);
	      infowindow.setContent(results[0].formatted_address);
		  $("#aaa7").val(results[0].formatted_address);
		  //console.log(results[0].formatted_address);
		  var address = {};
		  results[0].address_components.forEach(function(c) {
            switch(c.types[0]){
                case 'administrative_area_level_1':     //  Note some countries don't have states
                    $("#aaa1").val(c.long_name);
					break;
                case 'administrative_area_level_2':     //  Note some countries don't have states
					if(latlngStr.length>2){
                    $("#aaa2").val(c.long_name);
                    }
					break;
                case 'administrative_area_level_3':     //  Note some countries don't have states
                    $("#aaa3").val(c.long_name);
                    break;
                case 'administrative_area_level_4':     //  Note some countries don't have states
					if(latlngStr.length>3){
                    $("#aaa4").val(c.long_name);
					}
                    break;
                case 'administrative_area_level_5':     //  Note some countries don't have states
                    $("#aaa5").val(c.long_name);
                    break;
                case 'country':
                    $("#aaa6").val(c.short_name);
                    break;
            }
        });
		//console.log(address);
	      infowindow.open(map, marker);
	    } else {
	      window.alert('No results found');
	    }
	  } else {
	    window.alert('Geocoder failed due to: ' + status);
	  }
	});
}
function setMapOnAll(map) {
for (var i = 0; i < markers.length; i++) {
  markers[i].setMap(map);
}
}
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAUvHj4WE7eK9DgnzJHfXr8cwT6WXWsXkY&callback=initMap&language={{ (session()->get('lang')) ? session()->get('lang') : config('app.locale') }}">
</script>
@endsection

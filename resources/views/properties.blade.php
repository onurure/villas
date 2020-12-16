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
<div class="parallax titlebar">
	<div id="titlebar">
		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<h2>{{ Ceviri('Villa') }}</h2>

					<!-- Breadcrumbs -->
					<nav id="breadcrumbs">
						<ul>
							<li><a href="/">{{ Ceviri('Anasayfa') }}</a></li>
							<li>{{ Ceviri('Villa') }}</li>
						</ul>
					</nav>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('content')
<div class="container">
	<div class="row sticky-wrapper">
		<div class="col-md-4">
			<form action="" method="get" enctype="multipart/form-data">
				<div class="sidebar sticky right">
					<div class="main-search-input margin-bottom-35">
						<input type="text" name="kw" class="ico-01" placeholder="{{ Ceviri('Anahtar kelime ya da ilan numarası girin') }}" value="{{ app('request')->input('kw') }}"/>
					</div>
					<div class="main-search-input margin-bottom-35">
						<input type="text" placeholder="{{ Ceviri('Lokasyonu') }}" value="{{ app('request')->input('lokasyon') }}" name="lokasyon" id="lokasyon"/>
						<input type="hidden" id="aaa1" name="a1" value="{{ app('request')->input('a1') }}">
						<input type="hidden" id="aaa2" name="a2" value="{{ app('request')->input('a2') }}">
						<input type="hidden" id="aaa3" name="a3" value="{{ app('request')->input('a3') }}">
						<input type="hidden" id="aaa4" name="a4" value="{{ app('request')->input('a4') }}">
						<input type="hidden" id="aaa5" name="a5" value="{{ app('request')->input('a5') }}">
						<input type="hidden" id="aaa6" name="a6" value="{{ app('request')->input('a6') }}">
					</div>
					<div class="widget margin-bottom-40">
						@if( Request::is('villas/rent') )
							<div class="row with-forms">
								<div class="col-md-12">
									<select data-placeholder="{{Ceviri('Dönem Seçin')}}" class="chosen-select-no-single" name="p" >
										<option label="blank"></option>
										<option value="1" {{ app('request')->input('p')==1 ? 'selected' : '' }}>{{ Ceviri('Kısa Süreli') }}</option>
										<option value="2" {{ app('request')->input('p')==2 ? 'selected' : '' }}>{{ Ceviri('Uzun Süreli') }}</option>
									</select>
								</div>
							</div>
						@endif
						<div class="row with-forms">
							<div class="col-md-12">
								<h4>{{ Ceviri('Fiyat') }}</h4>
							</div>
							<div class="col-md-6">
								<input type="text" name="minp" placeholder="Min {{ Ceviri('Fiyat') }}" value="{{ app('request')->input('minp') }}">
							</div>
							<div class="col-md-6">
								<input type="text" name="maxp" placeholder="Max {{ Ceviri('Fiyat') }}" value="{{ app('request')->input('maxp') }}">
							</div>
						</div>
						<div class="row with-forms">
							<div class="col-md-12">
								<a id="more-area" href="#" class="more-search-options-trigger margin-bottom-10" data-open-title="{{ Ceviri('Alan') }} (m&#178;)" data-close-title="{{ Ceviri('Alan') }} (m&#178;)"></a>
							</div>
							<div class="more-search-options relative">
								<div class="col-md-6">
									<input type="text" name="mina" placeholder="Min m&#178;" value="{{ app('request')->input('mina') }}">
								</div>
								<div class="col-md-6">
									<input type="text" name="maxa" placeholder="Max m&#178;" value="{{ app('request')->input('maxa') }}">
								</div>
							</div>
						</div>
						<div class="row with-forms">
							<div class="col-md-12">
								<a id="more-gardenarea" href="#" class="more-search-options-trigger margin-bottom-10" data-open-title="{{ Ceviri('Bahçe Alanı') }} (m&#178;)" data-close-title="{{ Ceviri('Bahçe Alanı') }} (m&#178;)"></a>
							</div>
							<div class="more-search-options relative">
								<div class="col-md-6">
									<input type="text" name="ming" placeholder="Min m&#178;" value="{{ app('request')->input('ming') }}">
								</div>
								<div class="col-md-6">
									<input type="text" name="maxg" placeholder="Max m&#178;" value="{{ app('request')->input('maxg') }}">
								</div>
							</div>
						</div>
						<div class="row with-forms">
							<div class="col-md-12">
								<a id="more-rooms" href="#" class="more-search-options-trigger margin-bottom-10" data-open-title="{{ Ceviri('Odalar') }}" data-close-title="{{ Ceviri('Odalar') }}"></a>
							</div>
							<div class="more-search-options relative">
								<div class="col-md-6">
									<input type="text" name="minr" placeholder="Min" value="{{ app('request')->input('minr') }}">
								</div>
								<div class="col-md-6">
									<input type="text" name="maxr" placeholder="Max" value="{{ app('request')->input('maxr') }}">
								</div>
							</div>
						</div>
						<div class="row with-forms">
							<div class="col-md-12">
								<a id="more-salons" href="#" class="more-search-options-trigger margin-bottom-10" data-open-title="{{ Ceviri('Salon') }}" data-close-title="{{ Ceviri('Salon') }}"></a>
							</div>
							<div class="more-search-options relative">
								<div class="col-md-6">
									<input type="text" name="mins" placeholder="Min" value="{{ app('request')->input('mins') }}">
								</div>
								<div class="col-md-6">
									<input type="text" name="maxs" placeholder="Max" value="{{ app('request')->input('maxs') }}">
								</div>
							</div>
						</div>
						<div class="row with-forms">
							<div class="col-md-12">
								<a id="more-bathrooms" href="#" class="more-search-options-trigger margin-bottom-10" data-open-title="{{ Ceviri('Banyolar') }}" data-close-title="{{ Ceviri('Banyolar') }}"></a>
							</div>
							<div class="more-search-options relative">
								<div class="col-md-6">
									<input type="text" name="minb" placeholder="Min" value="{{ app('request')->input('minb') }}">
								</div>
								<div class="col-md-6">
									<input type="text" name="maxb" placeholder="Max" value="{{ app('request')->input('maxb') }}">
								</div>
							</div>
						</div>
						<div class="row with-forms">
							<div class="col-md-12">
								<a id="buildingage" href="#" class="more-search-options-trigger margin-bottom-10" data-open-title="{{ Ceviri('Bina Yaşı') }}" data-close-title="{{ Ceviri('Bina Yaşı') }}"></a>
							</div>
							<div class="more-search-options relative">
								<div class="col-md-6">
									<input type="text" name="minage" placeholder="Min" value="{{ app('request')->input('minage') }}">
								</div>
								<div class="col-md-6">
									<input type="text" name="maxage" placeholder="Max" value="{{ app('request')->input('maxage') }}">
								</div>
							</div>
						</div>
						<div class="row with-forms">
							<div class="col-md-12">
								<a id="more-furniture" href="#" class="more-search-options-trigger margin-bottom-10" data-open-title="{{ Ceviri('Eşyalı') }}" data-close-title="{{ Ceviri('Eşyalı') }}"></a>
							</div>
							<div class="more-search-options relative">
								<div class="col-md-12">
									<select class="chosen-select-no-single" data-placeholder="{{ Ceviri('Seçin')}}" name="f">
										<option label="blank" value=""></option>
										<option value="0" {{ app('request')->input('f') != "" && app('request')->input('f')==0 ? 'selected' : '' }}>{{ Ceviri('Hayır') }}</option>
										<option value="1" {{ app('request')->input('f')==1 ? 'selected' : '' }}>{{ Ceviri('Evet') }}</option>
									</select>
								</div>
							</div>
						</div>
						<!-- Area Range -->
						<div class="range-slider">
							<label>{{ Ceviri('Deniz') }} (m)</label>
							<div id="area-range1" data-min="0" data-max="5000" data-unit="m"></div>
							<input type="hidden" name="mind" id="mindistance">
							<input type="hidden" name="maxd" id="maxdistance">
							<div class="clearfix"></div>
						</div>
						<div class="row with-forms">
							<div class="col-md-12">
								<a id="more-additional" href="#" class="more-search-options-trigger margin-bottom-10 margin-top-30" data-open-title="{{ Ceviri('Manzara') }}" data-close-title="{{ Ceviri('Manzara') }}"></a>

								<div class="more-search-options relative">
									<div class="checkboxes one-in-row margin-bottom-10">
										<input id="check-21" type="checkbox" name="manzara[]" value="1" @if(app('request')->input('manzara')&&in_array(1, app('request')->input('manzara'))) checked @endif>
		    							<label for="check-21">{{ Ceviri('Deniz') }}</label>
		    							<input id="check-31" type="checkbox" name="manzara[]" value="2" @if(app('request')->input('manzara')&&in_array(2, app('request')->input('manzara'))) checked @endif>
		    							<label for="check-31">{{ Ceviri('Doğa') }}</label>
		    							<input id="check-41" type="checkbox" name="manzara[]" value="3" @if(app('request')->input('manzara')&&in_array(3, app('request')->input('manzara'))) checked @endif>
		    							<label for="check-41">{{ Ceviri('Göl') }}</label>
		    							<input id="check-51" type="checkbox" name="manzara[]" value="4" @if(app('request')->input('manzara')&&in_array(4, app('request')->input('manzara'))) checked @endif>
		    							<label for="check-51">{{ Ceviri('Havuz') }}</label>
		    							<input id="check-61" type="checkbox" name="manzara[]" value="5" @if(app('request')->input('manzara')&&in_array(5, app('request')->input('manzara'))) checked @endif>
		    							<label for="check-61">{{ Ceviri('Şehir') }}</label>
									</div>
								</div>
							</div>
						</div>
						<div class="row with-forms">
							<div class="col-md-12">
								<a id="more-additional" href="#" class="more-search-options-trigger margin-bottom-10 margin-top-30" data-open-title="{{ Ceviri('Ek Özellikler') }}" data-close-title="{{ Ceviri('Ek Özellikler') }}"></a>

								<div class="more-search-options relative">
									<div class="checkboxes one-in-row margin-bottom-10">
									<input id="check-3" type="checkbox" name="detached" value="1" {{ app('request')->input('detached')==1 ? 'checked' : '' }}>
									<label for="check-3">{{ Ceviri('Tam Müstakil') }}</label>
									<input id="check-10" type="checkbox" name="semidetached" value="1" {{ app('request')->input('semidetached')==1 ? 'checked' : '' }}>
									<label for="check-10">{{ Ceviri('Yarı Müstakil') }}</label>
									<input id="check-4" type="checkbox" name="insite" value="1" {{ app('request')->input('insite')==1 ? 'checked' : '' }}>
									<label for="check-4">{{ Ceviri('Site İçerisinde') }}</label>
									<input id="check-5" type="checkbox" name="garden" value="1" {{ app('request')->input('garden')==1 ? 'checked' : '' }}>
									<label for="check-5">{{ Ceviri('Bahçe (Ortak)') }}</label>
									<input id="check-11" type="checkbox" name="garden1" value="1" {{ app('request')->input('garden1')==1 ? 'checked' : '' }}>
									<label for="check-11">{{ Ceviri('Bahçe (Müstakil)') }}</label>
									<input id="check-6" type="checkbox" name="pool" value="1" {{ app('request')->input('pool')==1 ? 'checked' : '' }}>
									<label for="check-6">{{ Ceviri('Yüzme Havuzu (Ortak)') }}</label>
									<input id="check-6" type="checkbox" name="pool1" value="1" {{ app('request')->input('pool1')==1 ? 'checked' : '' }}>
									<label for="check-6">{{ Ceviri('Yüzme Havuzu (Müstakil)') }}</label>
									<input id="check-7" type="checkbox" name="kidspool" value="1" {{ app('request')->input('kidspool')==1 ? 'checked' : '' }}>
									<label for="check-7">{{ Ceviri('Çocuk Yüzme Havuzu') }}</label>
									<input id="check-8" type="checkbox" name="seenpool" value="1" {{ app('request')->input('seenpool')==1 ? 'checked' : '' }}>
									<label for="check-8">{{ Ceviri('Dışarıdan Görünmeyen Havuz') }}</label>
									<input id="check-9" type="checkbox" name="garage" value="1" {{ app('request')->input('garage')==1 ? 'checked' : '' }}>
									<label for="check-9">{{ Ceviri('Garaj') }}</label>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" name="o" value="{{ app('request')->input('o') }}" id="orderinput">
						<button class="button fullwidth margin-top-30">{{ Ceviri('Ara') }}</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-8">
			<div class="row margin-bottom-15">
				<div class="col-md-6">
					<div class="sort-by">
						<label>{{ Ceviri('Sıralama') }}:</label>
						<div class="sort-by-select">
							<select data-placeholder="Default order" class="chosen-select-no-single" onchange="OrderProperties()" id="orderproperties" >
								<option value="1" {{ app('request')->input('o')==1 ? 'selected' : '' }}>{{ Ceviri('Yeniden Eskiye') }}</option>
								<option value="2" {{ app('request')->input('o')==2 ? 'selected' : '' }}>{{ Ceviri('Eskiden Yeniye') }}</option>
								<option value="3" {{ app('request')->input('o')==3 ? 'selected' : '' }}>{{ Ceviri('Ucuzdan Pahalıya') }}</option>
								<option value="4" {{ app('request')->input('o')==4 ? 'selected' : '' }}>{{ Ceviri('Pahalıdan Ucuza') }}</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<!-- Layout Switcher -->
					<div class="layout-switcher">
						<a href="#" class="list"><i class="fa fa-th-list"></i></a>
						<a href="#" class="grid"><i class="fa fa-th-large"></i></a>
					</div>
				</div>
			</div>
			<!-- {{ $properties->total() }} -->
			<!-- Listings -->
			<div class="listings-container list-layout">
				@foreach($properties as $property)
					<div class="listing-item">
						<a href="{{ url('villa/'.$property->id.'/'.url_slug( $property->title)) }}" class="listing-img-container">
							<div class="listing-badges">
								<!--<span class="featured">Featured</span>-->
								<span>{{ $property->type == 1 ? Ceviri('Satılık') : Ceviri('Kiralık') }}</span>
							</div>
							<div class="listing-img-content">
								<span class="listing-price">
									{{ FiyatD($property->price,$property->doviz) }} {{ $property->type == 2 ? '/ '.Ceviri('aylık') : '' }}
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
								</span>
								<span class="like-icon tooltip"></span>
							</div>
							<img src="{{ isset($property->image->vitrine) ?  asset('images/villas/'.$property->image->vitrine) : asset('images/yok.png') }}" onerror="this.src='{{asset('images/yok.png')}}'" alt="{{ $property->title }}">
						</a>

						<div class="listing-content">

							<div class="listing-title">
								<h4><a href="{{ url('villa/'.$property->id.'/'.url_slug( $property->title)) }}">{{ $property->title }}</a></h4>
								{{ $property->address }} {{ $property->district }}, {{ $property->city }}, {{ $property->country }}
								<a href="{{ url('villa/'.$property->id.'/'.url_slug( $property->title)) }}" class="details button border">{{ Ceviri('Detaylar') }}</a>
							</div>

							<ul class="listing-details">
								<li>{{ $property->area }} m&#178;</li>
								<li>{{ $property->room>1 ? $property->room.' '.Ceviri('Oda') : $property->room.' '.Ceviri('Odalar') }}</li>
								<li>{{ $property->salon>1 ? $property->salon.' '.Ceviri('Salon') : $property->salon.' '.Ceviri('Salon') }}</li>
								<li>{{ $property->bathroom>1 ? $property->bathroom.' '.Ceviri('Banyo') : $property->bathroom.' '.Ceviri('Banyolar') }}</li>
							</ul>

							<div class="listing-footer">
								<a href="#"><i class="fa fa-user"></i> {{ $property->user->ticari ? $property->user->ticari : $property->user->name }}</a>
								<span><i class="fa fa-calendar-o"></i> {{ date('d.m.Y', strtotime($property->updated_at)) }}</span>
							</div>

						</div>

					</div>
				@endforeach
			</div>
			<div class="clearfix"></div>
			<!-- Listings Container / End -->


			<!-- Pagination -->
			<div class="pagination-container margin-top-20">
				{{ $properties->appends(request()->input())->links() }}
			</div>
			<!-- Pagination / End -->

		</div>


	</div>
</div>
<div id="selectmap1"></div>
@endsection
@section('customjs')
<script>
	$(document).ready(function(){
		@if(app('request')->input('mina')!="" || app('request')->input('maxa')!="")
			$("#more-area").click();
		@endif
		@if(app('request')->input('ming')!="" || app('request')->input('maxg')!="")
			$("#more-gardenarea").click();
		@endif
		@if(app('request')->input('minr')!="" || app('request')->input('maxr')!="")
			$("#more-rooms").click();
		@endif
		@if(app('request')->input('minb')!="" || app('request')->input('maxb')!="")
			$("#more-bathrooms").click();
		@endif
		@if(app('request')->input('f')==1)
			$("#more-furniture").click();
		@endif
		@if(app('request')->input('detached')!="" || app('request')->input('insite')!="" || app('request')->input('garden')!="" || app('request')->input('pool')!="" || app('request')->input('kidspool')!="" || app('request')->input('seenpool')!="" || app('request')->input('garage')!="")
			$("#more-additional").click();
		@endif
	});
	$("form" ).on( "submit", function( event ) {
		var emptyinputs = $(this).find('input').filter(function(){
	        return !$.trim(this.value).length;  // get all empty fields
	    }).prop('disabled',true);
	});
	$("#area-range1").each(function() {

		var dataMin = $(this).attr('data-min');
		var dataMax = $(this).attr('data-max');
		var dataUnit = $(this).attr('data-unit');
		$("#mindistance").val(dataMin);
		$("#maxdistance").val(dataMax);
		$(this).append( "<input type='text' class='first-slider-value'disabled/><input type='text' class='second-slider-value' disabled/>" );

				@if(app('request')->input('mind'))
					var dataDefaultMin = {{app('request')->input('mind')}};
				@else
					var dataDefaultMin = $(this).attr('data-min');
				@endif
				@if(app('request')->input('maxd'))
					var dataDefaultMax = {{app('request')->input('maxd')}}
				@else
					var dataDefaultMax = $(this).attr('data-max');
				@endif
		$(this).slider({

		  range: true,
		  min: dataMin,
		  max: dataMax,
		  step: 10,
		  values: [ dataDefaultMin, dataDefaultMax ],

		  slide: function( event, ui ) {
			 event = event;
			 $(this).children( ".first-slider-value" ).val( ui.values[ 0 ]  + " " + dataUnit );
			 $(this).children( ".second-slider-value" ).val( ui.values[ 1 ] + " " +  dataUnit );
	 		$("#mindistance").val(ui.values[0]);
	 		$("#maxdistance").val(ui.values[1]);
		  }
		});
		 $(this).children( ".first-slider-value" ).val( $( this ).slider( "values", 0 ) + " " + dataUnit );
		 $(this).children( ".second-slider-value" ).val( $( this ).slider( "values", 1 ) + " " + dataUnit );

	});
	function OrderProperties(){
		var ordertype = $("#orderproperties").val();
		$("#orderinput").val(ordertype);
		$("form" ).submit();
	}
</script><script>
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
					if(latlngStr.length>2 || lokasyonu.indexOf('/') != -1){
                    $("#aaa2").val(c.long_name);
                    }
                    break;
                case 'administrative_area_level_3':     //  Note some countries don't have states
                    $("#aaa3").val(c.long_name);
                    break;
                case 'administrative_area_level_4':     //  Note some countries don't have states
					if(latlngStr.length>2){
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

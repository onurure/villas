@extends('layout')
@section('breadcrumb')
<div id="titlebar" class="">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2><i class="fa fa-plus-circle"></i> {{ Ceviri('Yeni İlan Ver') }}</h2>
			</div>
		</div>
	</div>
</div>

@endsection
@section('content')
<!-- Container -->
<div class="container">
	<div class="row">

		<!-- Submit Page -->
		<div class="col-md-12">
			<form action="" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="submit-page">
					<h3>{{ Ceviri('Bilgiler') }}</h3>
					<div class="submit-section">
						<div class="form">
							<h5>{{ Ceviri('Başlık') }} <!--<i class="tip" data-tip-content="Type title that will also contains an unique feature of your property (e.g. renovated, air contidioned)"></i>--></h5>
							<input class="search-field" type="text" name="title" value="{{ $property->title }}" maxlength="100"/>
						</div>
						<div class="row with-forms">
							<div class="col-md-6">
								<h5>{{ Ceviri('Tip') }}</h5>
								<select class="chosen-select-no-single" name="type" data-placeholder="{{ Ceviri('Seçin') }}" onchange="PropType()" id="proptype">
									<option label="blank"></option>
									<option value="1" {{ $property->type == 1 ? 'selected' : ''}}>{{ Ceviri('Satılık') }}</option>
									<option value="2" {{ $property->type == 2 ? 'selected' : ''}}>{{ Ceviri('Kiralık') }}</option>
								</select>
							</div>
							<div class="col-md-6" id="period">
								<h5>Period <span>(Only for rent)</span></h5>
								<select class="chosen-select-no-single" name="period" data-placeholder="{{ Ceviri('Seçin') }}" >
									<option label="blank"></option>
									<option value="1" {{ $property->period == 1 ? 'selected' : ''}}>{{ Ceviri('Kısa Süreli') }}</option>
									<option value="2" {{ $property->period == 2 ? 'selected' : ''}}>{{ Ceviri('Uzun Süreli') }}</option>
								</select>
							</div>
						</div>
						<div class="row with-forms">
							<div class="col-md-6">
								<h5>{{ Ceviri('Alan') }}</h5>
								<div class="select-input disabled-first-option">
									<input type="text" data-unit="m&#178;" name="area" value="{{ $property->area }}">
								</div>
							</div>
							<div class="col-md-6">
								<h5>{{ Ceviri('Bahçe Alanı') }}</h5>
								<div class="select-input disabled-first-option">
									<input type="text" data-unit="m&#178;" name="gardenarea" value="{{ $property->gardenarea }}">
								</div>
							</div>
						</div>
						<div class="row with-forms">
							<div class="col-md-4">
								<h5>{{ Ceviri('Odalar') }}</h5>
								<input type="text" name="room" value="{{ $property->room }}">
							</div>
							<div class="col-md-4">
								<h5>{{ Ceviri('Salon') }}</h5>
								<input type="text" name="salon" value="{{ $property->salon }}">
							</div>
							<div class="col-md-4">
								<h5>{{ Ceviri('Banyolar') }}</h5>
								<input type="text" name="bathroom" value="{{ $property->bathroom }}">
							</div>
						</div>
						<div class="row with-forms">
							<div class="col-xs-10">
								<h5>{{ Ceviri('Fiyat') }} <!--<i class="tip" data-tip-content="Type overall or monthly price if property is for rent"></i>--></h5>
								<div class="select-input disabled-first-option">
									<input class="text-right" type="text" data-unit="" name="price" value="{{ $property->price }}">
								</div>
							</div>
							<div class="col-xs-2">
								<h5>{{ Ceviri('Birimi') }}</h5>
								<select class="chosen-select-no-single" data-placeholder="{{ Ceviri('Seçin') }}" name="doviz">
									<option label="blank"></option>
									<option value="1" {{ $property->doviz == 1 ? 'selected' : ''}}>TL(₺)</option>
									<option value="2" {{ $property->doviz == 2 ? 'selected' : ''}}>USD($)</option>
									<option value="3" {{ $property->doviz == 3 ? 'selected' : ''}}>EUR(€)</option>
									<option value="3" {{ $property->doviz == 4 ? 'selected' : ''}}>GBP(£)</option>
								</select>
							</div>
						</div>
					</div>
					<!--
						<h3>Gallery</h3>
						<div class="submit-section">
							<form action="/file-upload" class="dropzone" ></form>
						</div>
					-->
					<h3>{{ Ceviri('Adres') }}</h3>
					<div class="submit-section">
						<div class="row with-forms">
						<div class="form">
							<h5>Google {{ Ceviri('Harita') }}</h5>
							<input type="text" name="address" id="addressgmap" value="{{ $property->address }}">
							<input type="hidden" id="latlong" name="googlemap" value="{{ $property->googlemap }}">
							<input type="hidden" id="aaa1" name="aaa1" value="">
							<input type="hidden" id="aaa2" name="aaa2" value="">
							<input type="hidden" id="aaa3" name="aaa3" value="">
							<input type="hidden" id="aaa4" name="aaa4" value="">
							<input type="hidden" id="aaa5" name="aaa5" value="">
							<input type="hidden" id="aaa6" name="aaa6" value="">
							<div id="selectmap"></div>
						</div>
							<!--
							<div class="col-md-6">
								<h5>{{ Ceviri('Adres') }}</h5>
								<input type="text" name="address_eski" id="addressgmap" value="{{ $property->address }}">
							</div>
							<div class="col-md-6">
								<h5>{{ Ceviri('İlçe') }}</h5>
								<input type="text" name="city_eski" value="{{ $property->city }}">
							</div>
							<div class="col-md-6">
								<h5>{{ Ceviri('İl') }}</h5>
								<input type="text" name="district_eski" value="{{ $property->district }}">
							</div>
							<div class="col-md-6">
								<h5>{{ Ceviri('Ülke') }}</h5>
								<input type="text" name="country_eski" value="{{ $property->country }}">
							</div>
							-->
						</div>
					</div>
					<h3>{{ Ceviri('Detaylar') }}</h3>
					<div class="submit-section">
						<div class="form">
							<h5>{{ Ceviri('Detaylar') }}</h5>
							<textarea class="WYSIWYG" name="detail" cols="40" rows="3" id="summary" spellcheck="true">{{ $property->detail }}</textarea>
						</div>
						<div class="ekozellik">
    						<h3>{{ Ceviri('Ek Özellikler') }} <span>({{ Ceviri('Opsiyonel') }})</span></h3>
    						<div class="checkboxes in-row margin-bottom-20">
    							<input id="check-2" type="checkbox" name="furniture" value="1" {{ $property->furniture == 1 ? 'checked' : ''}}>
    							<label for="check-2">{{ Ceviri('Eşyalı') }}</label>
    							<input id="check-3" type="checkbox" name="detached" value="1" {{ $property->detached == 1 ? 'checked' : ''}}>
    							<label for="check-3">{{ Ceviri('Tam Müstakil') }}</label>
    							<input id="check-10" type="checkbox" name="semidetached" value="1" {{ $property->semidetached == 1 ? 'checked' : ''}}>
    							<label for="check-10">{{ Ceviri('Yarı Müstakil') }}</label>
    							<input id="check-4" type="checkbox" name="insite" value="1" {{ $property->insite == 1 ? 'checked' : ''}}>
    							<label for="check-4">{{ Ceviri('Site İçerisinde') }}</label>
    							<input id="check-5" type="checkbox" name="garden" value="1" {{ $property->garden == 1 ? 'checked' : ''}}>
    							<label for="check-5">{{ Ceviri('Bahçe (Ortak)') }}</label>
    							<input id="check-11" type="checkbox" name="garden" value="1" {{ $property->garden1 == 1 ? 'checked' : ''}}>
    							<label for="check-11">{{ Ceviri('Bahçe (Müstakil)') }}</label>
    							<input id="check-6" type="checkbox" name="pool" value="1" {{ $property->pool == 1 ? 'checked' : ''}}>
    							<label for="check-6">{{ Ceviri('Yüzme Havuzu (Ortak)') }}</label>
    							<input id="check-12" type="checkbox" name="pool" value="1" {{ $property->pool1 == 1 ? 'checked' : ''}}>
    							<label for="check-12">{{ Ceviri('Yüzme Havuzu (Müstakil)') }}</label>
    							<input id="check-7" type="checkbox" name="kidspool" value="1" {{ $property->kidspool == 1 ? 'checked' : ''}}>
    							<label for="check-7">{{ Ceviri('Çocuk Yüzme Havuzu') }}</label>
    							<input id="check-9" type="checkbox" name="garage" value="1" {{ $property->garage == 1 ? 'checked' : ''}}>
    							<label for="check-9">{{ Ceviri('Garaj') }}</label>
    						</div>
						    <hr/>
    						<div class="row with-forms margin-bottom-20">
    							<div class="col-md-4">
    								<h5>{{ Ceviri('Bina Yaşı') }}</h5>
    								<input type="text" name="buildingage" value="{{ $property->buildingage }}">
    							</div>
    							<div class="col-md-4">
    								<h5>{{ Ceviri('Kat Sayısı') }}</h5>
    								<input type="text" name="floor" value="{{ $property->floor }}">
    							</div>
    							<div class="col-md-4">
    								<h5>{{ Ceviri('Isıtma') }}</h5>
    								<select class="chosen-select-no-single" data-placeholder="{{ Ceviri('Seçin') }}" name="heating">
    									<option label="blank"></option>
    									<option value="1" {{ $property->heating == 1 ? 'selected' : ''}}>{{ Ceviri('Soba') }}</option>
    									<option value="2" {{ $property->heating == 2 ? 'selected' : ''}}>{{ Ceviri('Merkezi Isıtma') }}</option>
    									<option value="3" {{ $property->heating == 3 ? 'selected' : ''}}>{{ Ceviri('Yerden Isıtma') }}</option>
    									<option value="4" {{ $property->heating == 4 ? 'selected' : ''}}>{{ Ceviri('Klima') }}</option>
    									<option value="5" {{ $property->heating == 5 ? 'selected' : ''}}>{{ Ceviri('Jeotermal') }}</option>
    									<option value="6" {{ $property->heating == 6 ? 'selected' : ''}}>{{ Ceviri('Şömine') }}</option>
    									<option value="7" {{ $property->heating == 7 ? 'selected' : ''}}>{{ Ceviri('Isı Pompası') }}</option>
    								</select>
    							</div>
    						</div>
							<h5>{{ Ceviri('Manzara') }}</h5>
    						<div class="checkboxes in-row margin-bottom-20">
    							<input id="check-21" type="checkbox" name="manzara[]" value="1" @if(strpos($property->manzara, '1')) checked @endif>
    							<label for="check-21">{{ Ceviri('Deniz') }}</label>
    							<input id="check-31" type="checkbox" name="manzara[]" value="2" @if(strpos($property->manzara, '2')) checked @endif>
    							<label for="check-31">{{ Ceviri('Doğa') }}</label>
    							<input id="check-41" type="checkbox" name="manzara[]" value="3" @if(strpos($property->manzara, '3')) checked @endif>
    							<label for="check-41">{{ Ceviri('Göl') }}</label>
    							<input id="check-51" type="checkbox" name="manzara[]" value="4" @if(strpos($property->manzara, '4')) checked @endif>
    							<label for="check-51">{{ Ceviri('Havuz') }}</label>
    							<input id="check-61" type="checkbox" name="manzara[]" value="5" @if(strpos($property->manzara, '5')) checked @endif>
    							<label for="check-61">{{ Ceviri('Şehir') }}</label>
    						</div>
							<hr>
							<div class="row with-forms margin-bottom-20">
								<div class="col-xs-12"><h4>{{Ceviri('Uzaklık Mesafesi')}} </h4></div>
								<div class="col-md-2">
									<h5>{{ Ceviri('Deniz') }}</h5>
									<div class="select-input disabled-first-option">
										<input type="text" data-unit="m" name="seadistance" value="{{ $property->seadistance }}">
									</div>
								</div>
								<div class="col-md-2">
									<h5>{{ Ceviri('Market') }}</h5>
									<div class="select-input disabled-first-option">
										<input type="text" data-unit="m" name="marketdistance" value="{{ $property->marketdistance }}">
									</div>
								</div>
								<div class="col-md-2">
									<h5>{{ Ceviri('Toplu Taşıma') }}</h5>
									<div class="select-input disabled-first-option">
										<input type="text" data-unit="m" name="ttdistance" value="{{ $property->ttdistance }}">
									</div>
								</div>
								<div class="col-md-2">
									<h5>{{ Ceviri('Restorant') }}</h5>
									<div class="select-input disabled-first-option">
										<input type="text" data-unit="m" name="resdistance" value="{{ $property->resdistance }}">
									</div>
								</div>
								<div class="col-md-2">
									<h5>{{ Ceviri('Merkez') }}</h5>
									<div class="select-input disabled-first-option">
										<input type="text" data-unit="km" name="mdistance" value="{{ $property->mdistance }}">
									</div>
								</div>
								<div class="col-md-2">
									<h5>{{ Ceviri('Havaalanı') }}</h5>
									<div class="select-input disabled-first-option">
										<input type="text" data-unit="km" name="hadistance" value="{{ $property->hadistance }}">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="divider"></div>
					<h3>{{ Ceviri('Resimler') }}</h3>
					<div class="dropzone" id="myId">
					   <div class="fallback">
					       <input id="files" multiple="true" name="file" type="file">
					    </div>
					</div>
					<div id="dropzonePreview"></div>
					<div class="clearfix"></div>
					<div class="divider"></div>
					<button class="button preview margin-top-5" id="kaydetbtn">{{ Ceviri('Kaydet') }}</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="preview-template" style="display: none;">
	<div class="col-sm-2">
        <img data-dz-thumbnail />
		<input type="hidden" name="images[]" class="dzid" value="">
		<div class="in-row">
			<input class="radiobtn-v" id="" type="radio" name="featured" value="1">
			<label for="check-v">{{ Ceviri('Öntanımlı Resim') }}</label>
		</div>
		<div>
			<a class="dz-remove" href="javascript:undefined;" data-dz-remove="">{{ Ceviri('Sil') }}</a>
		</div>
    </div>
</div>
@endsection
@section('customjs')
<script>
	$(document).ready(function(){
		$("#period").hide();
	});
	function PropType(){
		var type = $("#proptype").val();
		if(type == 2){
			$("#period").show();
		}else{
			$("#period").hide();
		}
	}
</script>
<script src="{{ asset('js/jquery.oLoader.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('scripts/dropzone.js') }}"></script>
<script>
Dropzone.autoDiscover = false;
	$(".dropzone").dropzone({
		url: "/user/ajax/images",
		dictDefaultMessage: "<i class='sl sl-icon-plus'></i> {{ Ceviri('Resim yüklemek için tıklayın') }}",
		maxFilesize: 2,
		acceptedFiles: 'image/*',
		previewsContainer: '#dropzonePreview',
		previewTemplate: document.getElementById('preview-template').innerHTML,
		sending: function(file, xhr, formData) {
			$("#kaydetbtn").oLoader({
		      backgroundColor:'#fff',
		      image: '{{asset('images/ownageLoader/loader2.gif')}}',
		      style: 0,
		      fadeInTime: 500,
		      fadeOutTime: 1000,
		      fadeLevel: 0.5
		    });
        // Pass token. You can use the same method to pass any other values as well such as a id to associate the image with for example.
	        formData.append("_token", $('[name=_token').val()); // Laravel expect the token post value to be named _token by default
	    },
		success: function(file,response){
			//console.log(response);
			//$(file.previewTemplate).find('.dzid').attr('id', "document-" + response);
			$(file.previewTemplate).find('.dzid').val(response.fullname);
			$(file.previewTemplate).find('.radiobtn-v').val(response.fullname);
		},
		removedfile: function(file) {
    		var name = file.name;
			var _ref;
			return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
		},
		init: function(file,previewTemplate){
			@if($property->image && $property->image->image_links)
				@foreach (json_decode($property->image->image_links) as $image)
					var mockFile = { name: "{{ $property->title }}", size: 123 };
                	this.emit("addedfile", mockFile);
					this.emit("thumbnail", mockFile, "{{ asset('images/villas/'.$image) }}");
					$('#dropzonePreview .col-sm-2:last-child').find('.dzid').val('{{$image}}');
					$('#dropzonePreview .col-sm-2:last-child').find('.radiobtn-v').val('{{$image}}');
					@if($image==$property->image->vitrine)
						$('#dropzonePreview .col-sm-2:last-child').find('.radiobtn-v').prop( "checked", true );
					@endif
				@endforeach
			@endif
			this.on("queuecomplete", function (file) {
				$("#kaydetbtn").oLoader('hide');
		      });
		}
	});

</script>
<script>
var map;
var markers = [];
function initMap() {
var marker = null;
	@if($property->googlemap)
		<?php $latlng = explode('--',$property->googlemap); ?>
		var uluru = {lat: {{$latlng[0]}}, lng: {{$latlng[1]}} };
		var map = new google.maps.Map(document.getElementById('selectmap'), {
		  zoom: 15,
		  center: uluru
		});
		var marker = new google.maps.Marker({
				  position: uluru,
				  map: map
				});
		        markers.push(marker);
	@else
	var uluru = {lat: 38.8225909761771, lng: 34.7003173828125};
	var map = new google.maps.Map(document.getElementById('selectmap'), {
	  zoom: 4,
	  center: uluru
	});
	@endif

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
	 geocodeLatLng(geocoder, map, infowindow,event.latLng.lat()+","+event.latLng.lng());
	 console.log( event.latLng.lat());
	 console.log( event.latLng.lng());
	});

    var input = document.getElementById('addressgmap');
    //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var autocomplete = new google.maps.places.Autocomplete(input);
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

    });
}
function geocodeLatLng(geocoder, map, infowindow, latlong) {
	setMapOnAll(null);
	$("#aaa1").val("");
	$("#aaa2").val("");
	$("#aaa3").val("");
	$("#aaa4").val("");
	$("#aaa5").val("");
	$("#aaa6").val("");
	markers = [];
	var input = latlong;
	var latlngStr = input.split(',', 2);
	var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
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
		  $("#addressgmap").val(results[0].formatted_address);
		  var address = {};
		  results[0].address_components.forEach(function(c) {
            switch(c.types[0]){
                case 'administrative_area_level_1':     //  Note some countries don't have states
                    $("#aaa1").val(c.long_name);
                    break;
                case 'administrative_area_level_2':     //  Note some countries don't have states
                    $("#aaa2").val(c.long_name);
                    break;
                case 'administrative_area_level_3':     //  Note some countries don't have states
                    $("#aaa3").val(c.long_name);
                    break;
                case 'administrative_area_level_4':     //  Note some countries don't have states
                    $("#aaa4").val(c.long_name);
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

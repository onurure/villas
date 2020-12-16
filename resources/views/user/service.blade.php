@extends('layout')
@section('breadcrumb')
<div id="titlebar" class="submit-page">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2><i class="fa fa-plus-circle"></i> {{ Ceviri('Servis') }}</h2>
			</div>
		</div>
	</div>
</div>

@endsection
@section('content')
<!-- Container -->
<?php if($service->code){$code = $service->code;}else{$code = str_random(15);} ?>
<div class="alert alert-danger">
	<strong>{{ Ceviri('Dikkat') }}!</strong> {{ Ceviri('İlanın aktif olması için ödeme yaparken size özel kodu lütfen not alanına ekleyin') }}. {{ Ceviri('Aktivasyon Kod') }}: {{ $code }}
</div>
<div class="container">
	<div class="row">
		<!-- Submit Page -->
		<div class="col-md-12">
			<form action="" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<input type="hidden" name="code" value="{{ $code }}">
				<div class="submit-page">
					<h3>{{ Ceviri('Bilgiler') }}</h3>
					<div class="submit-section">
						<div class="form">
							<h5>{{ Ceviri('Başlık') }} <!--<i class="tip" data-tip-content="Type title that will also contains an unique feature of your property (e.g. renovated, air contidioned)"></i>--></h5>
							<input class="search-field" type="text" name="title" value="{{ $service->title }}"/>
						</div>
						<div class="row with-forms">
							<div class="col-md-6">
								<h5>{{ Ceviri('Kategori') }} <!--<i class="tip" data-tip-content="Type title that will also contains an unique feature of your property (e.g. renovated, air contidioned)"></i>--></h5>
								<select class="search-field" name="category" onchange="SubCategory()" id="maincategory">
									<option value="">{{ Ceviri('Seçin') }}</option>
									@foreach($categories as $category)
										<option value="{{ $category->id }}" {{ $service->category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-6" id="subcategory">
							</div>
						</div>
						<div class="row with-forms">
							<div class="col-md-6">
								<h5>{{ Ceviri('Telefon') }}</h5>
								<input type="text" name="telno" class="search-field" value="{{ $service->telno }}">
							</div>
							<div class="col-md-6">
								<h5>{{ Ceviri('GSM') }}</h5>
								<input type="text" name="cepno" class="search-field" value="{{ $service->cepno }}">
							</div>
						</div>
						<div class="row with-forms">
							<div class="col-md-6">
								<h5>{{ Ceviri('İnternet Sitesi') }}</h5>
								<input type="text" name="web" class="search-field" value="{{ $service->web }}">
							</div>
							<div class="col-md-6">
								<h5>Facebook URL</h5>
								<input type="text" name="fburl" class="search-field" value="{{ $service->fburl }}">
							</div>
						</div>
						<div class="row with-forms">
							<div class="col-md-6">
								<h5>Twitter URL</h5>
								<input type="text" name="twurl" class="search-field" value="{{ $service->twurl }}">
							</div>
							<div class="col-md-6">
								<h5>GooglePlus URL</h5>
								<input type="text" name="gourl" class="search-field" value="{{ $service->gourl }}">
							</div>
						</div>
					</div>
					<h3>{{ Ceviri('Yeri') }}</h3>
					<div class="submit-section">
						<div class="row with-forms">
							<div class="col-md-6">
								<h5>{{ Ceviri('Adres') }}</h5>
								<input type="text" name="address" value="{{ $service->address }}">
							</div>
							<div class="col-md-6">
								<h5>{{ Ceviri('İlçe') }}</h5>
								<input type="text" name="district" value="{{ $service->district }}">
							</div>
							<div class="col-md-6">
								<h5>{{ Ceviri('İl') }}</h5>
								<input type="text" name="city" value="{{ $service->city }}">
							</div>
							<div class="col-md-6">
								<h5>{{ Ceviri('Ülke') }}</h5>
								<input type="text" name="country" value="{{ $service->country }}">
							</div>
						</div>
					</div>
					<div class="divider"></div>
					<h3>{{ Ceviri('Detaylar') }}</h3>
					<div class="submit-section">
						<div class="form">
							<h5>{{ Ceviri('Hakkımızda') }}</h5>
							<textarea class="WYSIWYG" name="about" cols="40" rows="3" id="summary" spellcheck="true"> {{ $service->about }}</textarea>
						</div>
						<div class="form">
							<h5>Google {{ Ceviri('Harita') }} (iframe)</h5>
							<input type="text" name="googlemap" value="{{ $service->googlemap }}">
						</div>
					</div>
					<div class="divider"></div>
					<h3>{{ Ceviri('Resimler') }}</h3>
					<div class="dropzone" id="myId">
					   <div class="fallback">
					       <input id="files" multiple="true" name="files" type="file">
					    </div>
					</div>
					<div id="dropzonePreview"></div>
					<div class="clearfix"></div>
					<div class="divider"></div>
					<button class="button preview margin-top-5">{{ Ceviri('Kaydet') }}</button>
				</div>
			</form>
		</div>
	</div>
</div>
<br/>
<div class="alert alert-danger">
	<strong>{{ Ceviri('Dikkat') }}!</strong> {{ Ceviri('İlanın aktif olması için ödeme yaparken size özel kodu lütfen not alanına ekleyin') }}. {{ Ceviri('Aktivasyon Kod') }}: {{ $code }}
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
<script type="text/javascript" src="{{ asset('scripts/dropzone.js') }}"></script>
<script>
Dropzone.autoDiscover = false;
	$(".dropzone").dropzone({
		url: "/user/ajax/simages",
		dictDefaultMessage: "<i class='sl sl-icon-plus'></i> {{ Ceviri('Resim yüklemek için tıklayın') }}",
		maxFilesize: 2,
		acceptedFiles: 'image/*',
		previewsContainer: '#dropzonePreview',
		previewTemplate: document.getElementById('preview-template').innerHTML,
		sending: function(file, xhr, formData) {
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
		}
	});
	@if(!is_null($service->sub_category_id))
		SubCategory('{{$service->category_id}}');
	@endif
	function SubCategory(catid=""){
		if(catid==""){
			var mcategory = $("#maincategory").val();
			var mscategory = 0;
		}else{
			var mcategory = catid;
			var mscategory = {{ is_null($service->category_id) ? 0 : $service->category_id}};
		}
	    $.ajax({
		type: "POST",
		url: "{{ url('subcategory') }}",
		data: { _token: "{{ csrf_token() }}", mc: mcategory, selectone: mscategory},
	        success: function(data){
			  $("#subcategory").html("<h5>{{ Ceviri('Alt Kategori') }}</h5>" + data.html);
	        }
	    });
	}
</script>
@endsection

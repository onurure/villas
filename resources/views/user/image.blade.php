@extends('layout')
@section('breadcrumb')
<div id="titlebar" class="submit-page">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2><i class="fa fa-plus-circle"></i> </h2>
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
			<div class="submit-page">
				<h3>{{ Ceviri('Resimler') }}</h3>
				<div class="submit-section">
					<form action="{{ url('user/property/'.$image->property->id.'/uploadimage')}}" class="dropzone dz-clickable">
						{{ csrf_field() }}
					</form>
				</div>
				<div id="dropzonePreview"></div>
				<div class="clearfix"></div>
				<div class="divider"></div>
				<button class="button preview margin-top-5">{{ Ceviri('Kaydet') }}</button>
			</div>
		</div>
	</div>
</div>
<div id="preview-template" style="display: none;">
	<div class="col-sm-2">
        <img data-dz-thumbnail />
		<div class="dzid"></div>
		<div class="checkboxes in-row margin-bottom-20">
			<input id="check-v" type="checkbox" name="featured[]" value="1">
			<label for="check-v">{{ Ceviri('Öne Çıkan') }}</label>
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
		dictDefaultMessage: "<i class='sl sl-icon-plus'></i> Click here or drop files to upload",
		maxFilesize: 2,
		acceptedFiles: 'image/*',
		previewsContainer: '#dropzonePreview',
		previewTemplate: document.getElementById('preview-template').innerHTML,
		success: function(file,response){
			$(file.previewTemplate).find('.dzid').attr('id', "document-" + response);
		},
		removedfile: function(file) {
    		var name = file.name;
			var _ref;
			return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
		}
	});

</script>
@endsection

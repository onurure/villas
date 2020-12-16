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

					<h2>{{ Ceviri('Hizmetler') }}</h2>

					<!-- Breadcrumbs -->
					<nav id="breadcrumbs">
						<ul>
							<li><a href="/">{{ Ceviri('Anasayfa') }}</a></li>
							<li>{{ Ceviri('Hizmetler') }}</li>
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
					<div class="widget margin-bottom-40">
						<div class="row with-forms">
							<div class="col-md-12">
								<select data-placeholder="{{ Ceviri('Seçin')}}" class="chosen-select-no-single" name="cat" onchange="SubCategory()" id="maincategory">
									<option label="blank"></option>
									@foreach ($categories as $category)
										@if(count($category->parent)<1)
											<option value="{{ $category->id }}" {{ app('request')->input('cat')==$category->id ? 'selected' : '' }}>{{ $category->title }}</option>
										@endif
									@endforeach
								</select>
							</div>
							<div class="col-md-12" id="subcategory">
							</div>
						</div>
						<button class="button fullwidth margin-top-30">{{ Ceviri('Ara') }}</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-8">
			<div class="row margin-bottom-15">
				<div class="col-md-6">
				</div>
				<div class="col-md-6">
					<!-- Layout Switcher -->
					<div class="layout-switcher">
						<a href="#" class="list"><i class="fa fa-th-list"></i></a>
						<a href="#" class="grid"><i class="fa fa-th-large"></i></a>
					</div>
				</div>
			</div>
			<!-- Listings -->
			<div class="listings-container list-layout">
				@foreach($services as $property)
					<div class="listing-item">
						<a href="{{ url('service/'.$property->id.'/'.url_slug( $property->title)) }}" class="listing-img-container">
							<img src="{{ isset($property->simage->vitrine) ?  asset('storage/services/images/'.$property->simage->vitrine) : asset('images/yok.png') }}" onerror="this.src='{{asset('images/yok.png')}}'" alt="{{ $property->title }}">
						</a>
						<div class="listing-content">
							<div class="listing-title">
								<h4><a href="{{ url('service/'.$property->id.'/'.url_slug( $property->title)) }}">{{ $property->title }}</a></h4>
								<h6>
								@if($property->category)
									{{ $property->category->title }}
									@if($property->sub_category_id)
										, {{ $property->sub_category->title }}
									@endif
								@endif
								</h6>
								{{ $property->address }} {{ $property->district }}, {{ $property->city }}, {{ $property->country }}
								<a href="{{ url('service/'.$property->id.'/'.url_slug( $property->title)) }}" class="details button border">{{ Ceviri('Detaylar') }}</a>
							</div>

							<ul class="listing-details">
								<li>Tel: {{ $property->telno }} </li>
							</ul>

						</div>

					</div>
				@endforeach
			</div>
			<div class="clearfix"></div>
			<!-- Listings Container / End -->


			<!-- Pagination -->
			<div class="pagination-container margin-top-20">
				{{ $services->appends(request()->input())->links() }}
			</div>
			<!-- Pagination / End -->

		</div>


	</div>
</div>
@endsection
@section('customjs')
<script>
	$(document).ready(function(){
		@if(app('request')->input('subcategory')!="")
			SubCategory();
		@endif
	});
	function SubCategory(){
		var mcategory = $("#maincategory").val();
		//console.log(mcategory);
	    $.ajax({
		type: "POST",
		url: "{{ url('subcategory') }}",
		data: { _token: "{{ csrf_token() }}", mc: mcategory},
	        success: function(data){
				$("#subcategory").html(data.html);
				@if(app('request')->input('subcategory')!="")
					$("#subcat").val('{{ app('request')->input('subcategory') }}');
				@endif
				var config = {
					'.chosen-select'           : {disable_search_threshold: 10, width:"100%"},
					'.chosen-select-deselect'  : {allow_single_deselect:true, width:"100%"},
					'.chosen-select-no-single' : {disable_search_threshold:100, width:"100%"},
					'.chosen-select-no-single.no-search' : {disable_search_threshold:10, width:"100%"},
					'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
					'.chosen-select-width'     : {width:"95%"}
				};

				for (var selector in config) {
					if (config.hasOwnProperty(selector)) {
						$(selector).chosen(config[selector]);
					}
				};

	        }
	    });
	}
</script>
@endsection

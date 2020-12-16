@extends('layout')
@section('content')
<!-- Banner
================================================== -->
<div style="height:481px" id="ilkbolum">
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
									<input type="text" placeholder="{{ Ceviri('Anahtar kelime ya da ilan numarası girin') }}" value="" name="kw"/>
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
										<span class="listing-compact-title">{{ $vitrine->title }} <i>{{ $vitrine->price }} {{ $vitrine->type == 2 ? '/ '.Ceviri('aylık') : '' }}</i></span>
										<ul class="listing-hidden-content">
											<li>{{ $vitrine->area }} m&#178;</li>
											<li>{{ $vitrine->room>1 ? $vitrine->room.' '.Ceviri('Odalar') : $vitrine->room.' '.Ceviri('Oda') }}</li>
											<li>{{ $vitrine->bathroom>1 ? $vitrine->bathroom.' '.Ceviri('Banyolar') : $vitrine->bathroom.' '.Ceviri('Banyo') }}</li>
										</ul>
									</div>
									<img class="vitrindekiler img-responsive" src="{{ isset($vitrine->image->vitrine) ?  asset('storage/images/'.$vitrine->image->vitrine) : asset('images/yok.png') }}" onerror="this.src='{{asset('images/yok.png')}}'" alt="{{ $vitrine->title }}">
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
<!-- Parallax -->
<div class="parallax margin-bottom-70"
	data-background="images/listings-parallax.jpg"
	data-color="#36383e"
	data-color-opacity="0.7"
	data-img-width="800"
	data-img-height="505">

	<!-- Infobox -->
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

	<!-- Infobox / End -->

</div>
<!-- Parallax / End -->


<!-- Fullwidth Section -->
<section class="fullwidth margin-top-105 margin-bottom-0 padding-bottom-80 padding-top-95" data-background-color="#f7f7f7">

	<!-- Box Headline -->
	<h3 class="headline-box">{{ Ceviri('Müşterilerimiz Neler Söyledi') }}</h3>

	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<div class="testimonials-subtitle">We collect reviews from our customers so you can get an honest opinion of what an apartment is really like!</div>
			</div>

			<div class="col-md-4">
				<div class="testimonial-box">
					<div class="testimonial">Aliquam dictum elit vitae mauris facilisis, at dictum urna dignissim. Donec vel lectus vel felis lacinia luctus vitae iaculis arcu. Mauris mattis, massa eu porta ultricies.</div>
					<div class="testimonial-author">
						<img src="images/happy-client-01.jpg" alt="">
						<h4>Jennie Wilson <span>Rented Apartment</span></h4>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="testimonial-box">
					<div class="testimonial">Aliquam dictum elit vitae mauris facilisis, at dictum urna dignissim. Donec vel lectus vel felis lacinia luctus vitae iaculis arcu. Mauris mattis, massa eu porta ultricies.</div>
					<div class="testimonial-author">
						<img src="images/happy-client-02.jpg" alt="">
						<h4>Thomas Smith <span>Bought House</span></h4>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="testimonial-box">
					<div class="testimonial">Aliquam dictum elit vitae mauris facilisis, at dictum urna dignissim. Donec vel lectus vel felis lacinia luctus vitae iaculis arcu. Mauris mattis, massa eu porta ultricies.</div>
					<div class="testimonial-author">
						<img src="images/happy-client-03.jpg" alt="">
						<h4>Robert Lindstrom <span>Sold Apartment</span></h4>
					</div>
				</div>
			</div>

		</div>
	</div>

</section>
<!-- Fullwidth Section / End -->

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
				'{{ asset('images/fotolia_100124650.jpg') }}',
				'{{ asset('images/fotolia_132350443.jpg') }}'
			],
			fadeSpeed: 2000,
			duration: 5000,
			backgroundSize: SCALING_MODE_COVER
		});
	});
</script>
@endsection

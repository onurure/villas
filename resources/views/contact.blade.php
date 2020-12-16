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

					<h2>{{ Ceviri('İletişim') }}</h2>

					<!-- Breadcrumbs -->
					<nav id="breadcrumbs">
						<ul>
							<li><a href="/">{{ Ceviri('Anasayfa') }}</a></li>
							<li>{{ Ceviri('İletişim') }}</li>
						</ul>
					</nav>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('content')
<!-- Container / Start -->
<div class="container">

	<div class="row">

		<!-- Contact Details -->
		<div class="col-md-4">

			<h4 class="headline margin-bottom-30">VillaStock.com</h4>

			<!-- Contact Details -->
			<div class="sidebar-textbox">
				<p>Villa Stock Emlak,Reklam,İnşaat,Turizm Ticaret Limited Şirketi<br>Ölüdeniz Mahallesi Hisar Caddesi No:9/2 Hisarönü, Fethiye, Muğla, Türkiye</p>

				<ul class="contact-details">
					<li><i class="im im-icon-Phone-2"></i> <strong>{{ Ceviri('Telefon') }}:</strong> <span>+90 252 612 4732 <br>+90 505 119 5198 <br>+90 507 626 8703 </span></li>
				</ul>
			</div>

		</div>

		<!-- Contact Form -->
		<div class="col-md-8">

			<section id="contact">
				<h4 class="headline margin-bottom-35">{{ Ceviri('İletişim') }}</h4>

				<div id="contact-message"></div>
				@if(isset($basari)&&$basari==1)
					{{ Ceviri('Teşekkürler') }}
				@else
					<form method="post" action="" autocomplete="on">

					<div class="row">
						<div class="col-md-6">
							<div>
								<input name="name" type="text" id="name" placeholder="{{ Ceviri('İsim') }}" required="required" />
							</div>
						</div>

						<div class="col-md-6">
							<div>
								<input name="email" type="email" id="email" placeholder="{{ Ceviri('Email Adresi') }}" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" required="required" />
							</div>
						</div>
					</div>

					<div>
						<textarea name="comments" cols="40" rows="3" id="comments" placeholder="{{ Ceviri('Mesaj') }}" spellcheck="true" required="required"></textarea>
					</div>
					{{ csrf_field() }}
					<input type="submit" class="submit button" value="{{ Ceviri('Gönder') }}" />

					</form>
				@endif
			</section>
		</div>
		<!-- Contact Form / End -->

	</div>

</div>

@endsection

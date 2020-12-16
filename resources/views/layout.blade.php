<!DOCTYPE html>
<head>

<!-- Basic Page Needs
================================================== -->
<title>@yield('title')</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/colors/main.css') }}" id="colors">
@yield('customcss')
</head>

<body>
<!-- Wrapper -->
<div id="wrapper">

    <header id="header-container" class="header-style-2">

    	<!-- Header -->
    	<div id="header">
    		<div class="container">

    			<!-- Left Side Content -->
    			<div class="left-side">

    				<!-- Logo -->
    				<div id="logo" class="margin-top-10">
    					<a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" alt=""></a>

    					<!-- Logo for Sticky Header -->
    					<a href="{{ url('/') }}" class="sticky-logo"><img src="{{ asset('images/logo.png') }}" alt=""></a>
    				</div>

    			</div>
    			<!-- Left Side Content / End -->

    			<!-- Right Side Content / End -->
    			<div class="right-side">

					@yield('ustarama')
    				<ul class="header-widget">
                        <li class="dilsecimyeri">
                            <select id="langswitcher" onchange="DilDegis()">
                                @if(Cache::get('diller'))
                                    @foreach (Cache::get('diller') as $dil)
                                        <option value="{{$dil->lan}}"
                                            @if(session()->get('lang') && session()->get('lang')==$dil->lan)
                                                selected
                                            @elseif(config('app.locale')==$dil->lan)
                                                selected
                                            @endif >{{ $dil->language }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </li>

                        @if(Auth::check())
                            <li class="with-btn"><a href="{{ url('user/account') }}" class="sign-in button border"><i class="fa fa-user"></i> {{ Ceviri('Merhaba')}}, {{ Auth::user()->name }}</a></li>
                        @elseif(Auth::guard('firm')->check())
                            <li class="with-btn"><a href="{{ url('user/my-services') }}" class="sign-in button border"><i class="fa fa-user"></i> {{ Ceviri('Merhaba')}}, {{ Auth::guard('firm')->user()->name }}</a></li>
                        @else
                            <li class="with-btn"><a href="{{ url('signin') }}" class="sign-in button border"> {{ Ceviri('Üye Ol')}} </a></li>
                            <li class="with-btn"><a href="{{ url('login') }}" class="sign-in button border"> {{ Ceviri('Üye Girişi')}} </a></li>
                        @endif
                        <!--
        					<li>
        						<i class="sl sl-icon-call-in"></i>
        						<div class="widget-content">
        							<span class="title">{{ trans('hepsi.questions') }}?</span>
        							<span class="data">(123) 123-456 </span>
        						</div>
        					</li>

        					<li>
        						<i class="sl sl-icon-location"></i>
        						<div class="widget-content">
        							<span class="title">Our Office</span>
        							<span class="data">45 Park Avenue, NY</span>
        						</div>
        					</li>
                        -->
    				</ul>
    			</div>
    			<!-- Right Side Content / End -->

    		</div>


    		<!-- Mobile Navigation -->
    		<div class="menu-responsive">
    			<i class="fa fa-reorder menu-trigger"></i>
    		</div>


    		<!-- Main Navigation -->
    		<nav id="navigation" class="style-2">
    			<div class="container">
					<ul id="responsive">

						<li><a class="{{ Request::is('/') ? 'current' : '' }}" href="{{ url('/') }}">{{ Ceviri('Anasayfa') }}</a></li>

						<li><a class="{{ Request::is('ads') ? 'current' : '' }}" href="{{ url('villas/sale') }}">{{ Ceviri('Satılık İlanlar') }}</a></li>

						<li><a class="{{ Request::is('ads') ? 'current' : '' }}" href="{{ url('villas/rent') }}">{{ Ceviri('Kiralık İlanlar') }}</a></li>

						<!--<li><a class="{{ Request::is('services') ? 'current' : '' }}" href="{{ url('services') }}">{{ Ceviri('Hizmetler') }}</a></li>-->

						<!--<li><a class="{{ Request::is('contact') ? 'current' : '' }}" href="{{ url('contact') }}">{{ Ceviri('İletişim') }}</a></li>-->
						<li><a class="" href="{{ url('user/property') }}" id="ilanver">{{ Ceviri('Yeni İlan Ver') }}</a></li>
                        @if(Request::is('services')||Request::is('service/*/*'))
                            @if(Auth::guard('firm')->check())
                                <li><a class="" href="{{ url('user/my-services') }}" id="firmagiris">{{ Ceviri('Yeni Hizmet İlanı Ver') }}</a></li>
                            @else
                                <li><a class="" href="{{ url('login?f=1#tab3') }}" id="firmagiris">{{ Ceviri('Firma Giriş') }}</a></li>
                            @endif

                        @endif
					</ul>
    			</div>
    		</nav>
    		<div class="clearfix"></div>
    		<!-- Main Navigation / End -->
    	</div>
    	<!-- Header / End -->

    </header>
    <div class="clearfix"></div>
  @yield('breadcrumb')
  @if(session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
  @endif
  @if(count($errors)>0)
      <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
      </div>
  @endif
  @yield('content')
    <a href="listings-half-map-grid-standard.html" class="flip-banner parallax" data-background="images/flip-banner-bg.jpg" data-color="#274abb" data-color-opacity="0.9" data-img-width="2500" data-img-height="1600">
    	<div class="flip-banner-content">
    		<h2 class="flip-visible">{{ Ceviri('Aradığınız villa burada') }}</h2>
    		<h2 class="flip-hidden"><i class="sl sl-icon-arrow-left"></i> {{ Ceviri('Satılık İlanlar') }} | {{ Ceviri('Kiralık İlanlar') }} <i class="sl sl-icon-arrow-right"></i></h2>
    	</div>
    </a>
<!-- Footer
================================================== -->
<div id="footer" class="sticky-footer">
	<!-- Main -->
	<div class="container">
		<div class="row">
			<div class="col-md-5 col-sm-6">
				<img class="footer-logo" src="{{ asset('images/logo.png') }}" alt="">
				<br><br>
				<p>Villa Stock Emlak,Reklam,İnşaat,Turizm Ticaret Limited Şirketi<br>Ölüdeniz Mahallesi Hisar Caddesi No:9/2 Hisarönü, Fethiye, Muğla, Türkiye</p>
			</div>

			<div class="col-md-4 col-sm-6 ">
				<h4>{{ Ceviri('Linkler') }}</h4>
				<ul class="footer-links">
					<li><a href="{{ url('/') }}">{{ Ceviri('Anasayfa') }}</a></li>
					<li><a href="{{ url('villas/sale') }}">{{ Ceviri('Satılık İlanlar') }}</a></li>
					<li><a href="{{ url('villas/rent') }}">{{ Ceviri('Kiralık İlanlar') }}</a></li>
					<li><a href="{{ url('services') }}">{{ Ceviri('Hizmetler') }}</a></li>
					<!--<li><a href="{{ url('contact') }}">{{ Ceviri('İletişim') }}</a></li>-->
				</ul>
				<div class="clearfix"></div>
			</div>

			<div class="col-md-3  col-sm-12">
				<h4>{{ Ceviri('İletişim') }}</h4>
				<div class="text-widget">
					<span>Ölüdeniz Mahallesi Hisar Caddesi No:9/2 Hisarönü, Fethiye, Muğla, Türkiye</span> <br>
					{{ Ceviri('Telefon') }}: <span>+90 252 612 4732 </span><br>
					{{ Ceviri('Telefon') }}: <span>+90 505 119 5198 </span><br>
					{{ Ceviri('Telefon') }}: <span>+90 507 626 8703 </span><br>
				</div>

				<ul class="social-icons margin-top-20">
					<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
					<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
					<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
					<li><a class="vimeo" href="#"><i class="icon-vimeo"></i></a></li>
				</ul>

			</div>

		</div>

		<!-- Copyright -->
		<div class="row">
			<div class="col-md-12">
				<div class="copyrights">© {{ date('Y') }} | villastock.com</div>
			</div>
		</div>

	</div>

</div>
<!-- Footer / End -->


<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>


<!-- Scripts
================================================== -->
<script type="text/javascript" src="{{ asset('scripts/jquery-2.2.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('scripts/chosen.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('scripts/magnific-popup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('scripts/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('scripts/rangeSlider.js') }}"></script>
<script type="text/javascript" src="{{ asset('scripts/sticky-kit.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('scripts/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('scripts/jquery.jpanelmenu.js') }}"></script>
<script type="text/javascript" src="{{ asset('scripts/tooltips.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('scripts/masonry.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('scripts/custom.js') }}"></script>
@yield('customjs')
<script>
    function DilDegis() {
        var dil = $("#langswitcher").val();
        $.post( "{{url('dildegis')}}", { _token: "{{ csrf_token() }}", dil: dil })
        .done(function( data ) {
            if(data.success){
                location.reload();
            }else{
            }
        });
    }
    function KurumsalAc(){
        $("#kurumsaluyari").removeClass('alert-warning').addClass('alert-success');
        $("#normaluye").addClass('hidden');
        $("#kurumsaluye").removeClass('hidden');
    }
    $('#sirket1').click(function() {
        $("#sirket2").prop('checked', false);
        $("#sirket1").prop('checked', true);
    });
    $('#sirket2').click(function() {
        $("#sirket1").prop('checked', false);
        $("#sirket2").prop('checked', true);
    });
</script>
</div>
<!-- Wrapper / End -->


</body>
</html>

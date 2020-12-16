<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="onurure">
    <title>VillaStock Admin</title>
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/icons.css') }}">
	<link rel="stylesheet" href="{{ asset('css/metisMenu.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/sb-admin-2.min.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('customcss')
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('yonetim/ilanlar') }}">VillaStock Admin</a>
            </div>
            <!-- /.navbar-header -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="{{ url('yonetim/ilanlar') }}"> Villa İlanları</a>
                        </li>
                        <li>
                            <a href="{{ url('yonetim/firmalar') }}"> Firmalar</a>
                        </li>
                        <li>
                            <a href="{{ url('yonetim/servisler') }}"> Hizmet İlanları</a>
                        </li>
                        <li>
                            <a href="{{ url('yonetim/kategoriler') }}"> Hizmet Kategorileri</a>
                        </li>
                        <li>
                            <a href="{{ url('yonetim/ayarlar') }}"> Ayarlar</a>
                        </li>
                        <li>
                            <a href="{{ url('yonetim/diller') }}"> Çeviriler</a>
                        </li>
                        <li>
                            <a href="{{ url('yonetim/yorumlar') }}"> Müşteri Görüşleri</a>
                        </li>
                        <li>
                            <a href="{{ url('yonetim/yerler') }}"> Popüler Yerler</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('scripts/jquery-2.2.0.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    @yield('customjs')
</body>
</html>

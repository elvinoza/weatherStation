<html>
<head>
    {!! HTML::style('css/developer-style.css') !!}
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
@section('hello')
<section class="hero" id="intro">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-right navicon">
                <a id="nav-toggle" class="nav_slide_button" href="#"><span></span></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center inner">
                <div class="animatedParent">
                    <h1 class="animated fadeInDown">MeteO</h1>
                    <p class="animated fadeInUp">Create your own weather station and see station information on all your devices, wherever you are!</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
                <a href="#about" class="learn-more-btn btn-scroll">Learn more</a>
            </div>
        </div>
    </div>
</section>
@show
<!-- Navigation -->
<div id="navigation">
    <nav class="navbar navbar-custom" role="navigation">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <div class="site-logo">
                        <a href="index.html" class="brand">Meteo Customers</a>
                    </div>
                </div>
                <div class="col-md-10">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="menu">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="active"><a href="{{ route('developer.index') }}">Home</a></li>
                            @if(Auth::check())
                            <li><a href="{!! route('developer.station') !!}">{{ Auth::user()->station_name }}</a></li>
                            <li><a href="{{ route('developer.logout') }}">Logout</a></li>
                            @else
                                <li><a href="#contact">Sign up</a></li>
                                <li><a href="{!! route('developer.sign-in') !!}">Sign in</a></li>
                            @endif
                        </ul>
                    </div>
                    <!-- /.Navbar-collapse -->
                </div>
            </div>
        </div>
        <!-- /.container -->
    </nav>
</div>
<!-- /Navigation -->

<div class="container">
    @yield('content')
</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ul class="footer-menu">
                    <li><a href="{{ route('home-page') }}">MeteO</a></li>
                </ul>
            </div>
            <div class="col-md-6 text-right">
                <p>&copy;Copyright 2015 - MeteO.</p>
            </div>
        </div>
    </div>
</footer>

</body>
<script src="../../../js/developer-all.js"></script>
</html>
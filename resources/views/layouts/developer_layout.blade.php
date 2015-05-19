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
                    <p class="animated fadeInUp">Susikurk nuosavą nutolusią orų stotelę ir matyk informaciją kur bebūtum su visais savo įreniais!</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
                <a href="#about" class="learn-more-btn btn-scroll">Daugiau</a>
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
                        <a href="{{ route('developer.index') }}" class="brand">Meteo</a>
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
                            <li class="active"><a href="{{ route('developer.index') }}">Pradinis</a></li>
                            @if(Auth::check())
                            <li><a href="{!! route('developer.station') !!}">{{ Auth::user()->station_name }}</a></li>
                            <li><a href="{!! route('developer.documentation') !!}">Dokumentacija</a></li>
                            <li><a href="{{ route('developer.logout') }}">Atsijungti</a></li>
                            @else
                                <li><a href="{{ route('developer.sign-up') }}">Registruotis</a></li>
                                <li><a href="{!! route('developer.sign-in') !!}">Prisijungti</a></li>
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
                    @if(Auth::check())
                        <li><a href="{{ route('developer.auto_logout') }}">MeteO</a></li>
                    @else
                        <li><a href="{{ route('home-page') }}">MeteO</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-md-6 text-right">
                <p>&copy;Copyright 2015 - MeteO.</p>
            </div>
        </div>
    </div>
</footer>
<div class="modal fade" id="myModal" style="padding-top: 100px">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Stotelės paskiros trynimas</h4>
            </div>
            <div class="modal-body">
                <p>Ar tikrai norite ištrinti stotelę? Kartu su ja bus ištrinti visi duomenys.&hellip;</p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('developer.delete') }}" type="button" class="btn btn-danger">Taip</a>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ne</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</body>
<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
<script src="../../../js/developer-all.js"></script>
</html>
<html>
<head>
    {!! HTML::style('css/style.css') !!}
</head>
<body>
    @section('nav-bar')
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('developer.index') }}">Weather Station API</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse right">
                    <ul class="nav navbar-nav ">
                        <li><a href="#">Documentation</a></li>
                    </ul>
                    @if( Auth::check())
                        <ul class="nav navbar-nav ">
                            <li><a href="{{ route('developer.station') }}">{{ Auth::user()->station_name }}</a></li>
                        </ul>
                        <ul class="nav navbar-nav pull-right">
                            <li><a href="{{ route('developer.logout') }}">Logout</a></li>
                        </ul>
                    @else
                        <ul class="nav navbar-nav">
                            <li><a href="{{ route('developer.sign-up') }}">Sign up</a></li>
                            <li><a href="{{ route('developer.sign-in') }}">Sign in</a></li>
                        </ul>
                    @endif


                </div><!--/.nav-collapse -->
            </div>
        </nav>
    @show
    <div class="jumbotron">
    </div>
    <div class="container">
        @yield('content')
    </div> <!-- /container -->
</body>
<script src="../../../js/all.js"></script>
</html>
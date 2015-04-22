<html ng-app="stations">
<head>
    {!! HTML::style('css/style.css') !!}
    {!! HTML::style('css/developer-style.css') !!}
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
    @section('nav-bar')

    <!-- Navigation -->
    <div id="navigation">
        <nav class="navbar navbar-custom" role="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <div class="site-logo">
                            <a class="brand"><% selectedStationName %></a>
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
                                <li ng-class="{ active: isActive('/') }"><a href="#/">Home</a></li>
                                <li ng-class="{ active: isActive('/charts/') }"><a href="#/charts/<% selectedStationId %>">Charts</a></li>
                                <li ng-class="{ active: isActive('/tables/') }"><a href="#/tables/<% selectedStationId %>">Tables</a></li>

                                <li><a href="{{ route('developer.index') }}">API</a></li>
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

    @show

    @yield('content')

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="footer-menu">
                        <li><a href="{{ route('developer.index') }}">API</a></li>
                    </ul>
                </div>
                <div class="col-md-6 text-right">
                    <p>&copy;Copyright 2015 - Elvinas Jakubcevičius, IFF-1.</p>
                </div>
            </div>
        </div>
    </footer>

    @section('scripts')
        <script src="../../../js/all.js"></script>
        <script src="../../../js/developer-all.js"></script>
    @show
</body>
</html>
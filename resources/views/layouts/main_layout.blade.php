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
                            <a id="dropdownMenu1" data-toggle="dropdown" style="cursor: pointer" class="brand"><% selectedStationName %></a>
<!--                            <select  class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1" class="form-control" ng-model="station" ng-init="station"  ng-change="setStationId(station)" ng-options="station1.station_name for station1 in stations">-->
<!--                                <option style="display:none" value="">Select station</option>-->
<!--                            </select>-->
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
                                <li ng-class="{ active: isActive('/') }"><a href="#/" data-target="#">Pagrindinis</a></li>
                                <li ng-class="{ active: isActive('/charts/') }"><a href="#/charts/<% selectedStationId %>" data-target="#charts">Grafikai</a></li>
                                <li ng-class="{ active: isActive('/tables/') }"><a href="#/tables/<% selectedStationId %>" data-target="#tables">Lentelės</a></li>

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
        <script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.6.0/ui-bootstrap-tpls.min.js"></script>
    @show
</body>
</html>
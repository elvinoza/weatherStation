<html ng-app="stations">
<head>
    {!! HTML::style('css/style.css') !!}
</head>
<body class="body">
    @section('nav-bar')

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><% selectedStationName %></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li><a href="{{ route('developer.index') }}">API</a></li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse" ng-controller="NavBarController">
                <ul class="nav navbar-nav side-nav">
                    <li ng-class="{ active: isActive('/') }">
                        <a href="#/"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li ng-class="{ active: isActive('/charts/') }">
                        <a href="#/charts/<% selectedStationId %>"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
                    </li>
                    <li ng-class="{ active: isActive('/tables/') }">
                        <a href="#/tables/<% selectedStationId %>"><i class="fa fa-fw fa-table"></i> Tables</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
    @show

    @yield('content')

    @section('scripts')
        <script src="../../../js/all.js"></script>
    @show
</body>

</html>
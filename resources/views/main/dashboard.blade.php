@extends('layouts.main_layout')

@section('content')
<div class="container" ng-controller="StationsList">
    <ul>
        <li ng-repeat="station in stations">
            <span><% station.id %></span>
            <p><% station.station_name %></p>
        </li>
    </ul>

    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Tutorials
        <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
        <li role="presentation"><a role="menuitem" tabindex="-1">HTML</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">CSS</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">JavaScript</a></li>
        <li role="presentation" class="divider"></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">About Us</a></li>
    </ul>
</div>

@stop
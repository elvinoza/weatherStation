/**
 * Created by elvinas on 3/26/15.
 */

var stationsApp = angular.module('stations', ['ngRoute', 'chart.js', 'ui.bootstrap'], function($interpolateProvider){
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
})
    .config(['$routeProvider', function ($routeProvider) {

    $routeProvider
        .when('/',{
            controller: "StationsList",
            templateUrl: "partials/home.html"
        })
        .when('/temperature/:stationId', {
            controller: "TemperatureController",
            templateUrl: "partials/temperature.html"
        })
        .when('/charts', {
            controller: "ChartsController",
            templateUrl: "partials/charts.html"
        })

        .otherwise({ redirectTo: "/" });
    }])
    .run(function($rootScope, apiService){
        $rootScope.gstationId = '';

        apiService.getFirstStation().success(function(data){
            $rootScope.gstationId = data.id;
        });

        $rootScope.setStationId = function(id){
            $rootScope.gstationId = id;
        };
    });
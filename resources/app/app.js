/**
 * Created by elvinas on 3/26/15.
 */

var stationsApp = angular.module('stations', ['ngRoute', 'chart.js', 'ui.bootstrap', 'ngProgress','ngTable', 'datePicker'], function($interpolateProvider){
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
})
    .config(['$routeProvider', function ($routeProvider) {

    $routeProvider
        .when('/',{
            controller: "HomeController",
            templateUrl: "partials/home.html"
        })
        .when('/temperature/:stationId', {
            controller: "TemperatureController",
            templateUrl: "partials/temperature.html"
        })
        .when('/charts/:selectedStationId', {
            controller: "ChartsController",
            templateUrl: "partials/charts.html"
        })
        .when('/tables/:selectedStationId', {
            controller: "TablesController",
            templateUrl: "partials/tables.html"
        })

        .otherwise({ redirectTo: "/" });
    }])
    .run(function($rootScope, apiService){
        $rootScope.selected = false;
        $rootScope.selectedStationId = "3RkTSJ";
        $rootScope.selectedStationName = "Kaunas";
        $rootScope.stations = [];
        $rootScope.station = {
            id : "3RkTSJ",
            station_name : "Kaunas"
        };

        apiService.getStationList().success(function(data){
            $rootScope.stations = data;
        });
        //wait async task
        //while(!flag){};
    });
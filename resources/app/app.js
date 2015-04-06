/**
 * Created by elvinas on 3/26/15.
 */

var stationsApp = angular.module('stations', ['ngRoute', 'chart.js', 'ui.bootstrap', 'ngProgress'], function($interpolateProvider){
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

        .otherwise({ redirectTo: "/" });
    }])
    .run(function($rootScope, apiService){
        $rootScope.selected = false;
        $rootScope.selectedStationId = "3RkTSJ";
        $rootScope.selectedStationName = "Kaunas";
        $rootScope.station = {
            id : "3RkTSJ",
            station_name : "Kaunas"
        };

//        apiService.getFirstStation().success(function(data){
//            gstationId = data.id;
//        });
//
////        $rootScope.setStationId = function(id){
////            $rootScope.gstationId = id;
////        };
//
//        $rootScope.getStationId = function(){
//            return $rootScope.gstationId;
//        }
    });
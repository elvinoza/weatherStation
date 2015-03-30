stationsApp.controller('HomeController', function ($scope, $rootScope, apiService, $interval, ngProgress) {
    ngProgress.height('3px');
    $scope.stations = [];
    //$scope.stationId = $rootScope.gstationId;
    $scope.getStationId = function(){

        apiService.getStationList().success(function(data){
            $scope.stations = data;
            $scope.stId = data[0];
        });
    };

    $scope.setStationId = function(id){
        $rootScope.gstationId = id;
        $scope.getStationInformation();
    };

    var count = 0;
    var int = $interval(function(){
        ngProgress.set(count);
        count = count + 1;
        if(count == 100){
            ngProgress.start();
            count = 0;
        }
    }, 700);

    $scope.$on('$destroy', function () {
        $interval.cancel(int);
        ngProgress.set(0);
    });

    $interval($scope.getStationInformation = function(){
        apiService.getLastStationInformation($rootScope.gstationId).success(function(data){
            $scope.temperature = data.temperature;
            $scope.humidity = data.humidity;
            $scope.light_lvl = data.light_lvl;
            $scope.pressure = data.pressure;
            $scope.wind_direction = data.wind_direction;
            $scope.wind_speed = data.wind_speed;
            $scope.rain = data.rain;

        });
    }, 70000);

    $scope.getStationId();
    $scope.getStationInformation();
});

stationsApp.controller("PanelController", function(){
    this.tab = 1;

    this.selectedTab = function(setTab){
        this.tab = setTab;
    };

    this.isSelected = function(checkTab){
        return this.tab === checkTab;
    }
});

stationsApp.controller("TemperatureController", function($scope, $rootScope, apiService){

});

stationsApp.controller("NavBarController", function($scope, $location){

    $scope.isActive = function(viewLocation){
        return viewLocation === $location.path();
    }
});

stationsApp.controller("ChartsController", function($scope, $routeParams, apiService){

    $scope.stationId = $routeParams.gstationId;
    $scope.tempType = "h";
    $scope.humType = "h";
    $scope.windSpeedType = "h";

    $scope.getTemperatureChart = function(tempType){
        $scope.tempType = tempType;
        apiService.getStationTemperature($scope.stationId, tempType).success(function(data){
            $scope.tempLabels = [];
            $scope.tempData = [];
            $scope.tempLabels = data.map(function(item){ return item.date;})
            $scope.tempSeries = ['Temperature'];
            $scope.tempData.push(data.map(function(item){ return item.temperature;}));
        });
    };

    $scope.getHumidityChart = function(humType){
        $scope.humType = humType;
        apiService.getStationHumidity($scope.stationId, humType).success(function(data){
            $scope.humLabels = [];
            $scope.humData = [];
            $scope.humLabels = data.map(function(item){ return item.date;})
            $scope.humSeries = ['Humidity'];
            $scope.humData.push(data.map(function(item){ return item.humidity;}));
        });
    };

    $scope.getWindSpeedChart = function(windSpeedType){
        $scope.windSpeedType = windSpeedType;
        apiService.getStationWindSpeed($scope.stationId, windSpeedType).success(function(data){
            $scope.windSpeedLabels = [];
            $scope.windSpeedData = [];
            $scope.windSpeedLabels = data.map(function(item){ return item.date;})
            $scope.windSpeedSeries = ['Wind speed'];
            $scope.windSpeedData.push(data.map(function(item){ return item.wind_speed;}));
        });
    };

    //initial charts
    $scope.getTemperatureChart($scope.tempType);
    $scope.getHumidityChart($scope.humType);
    $scope.getWindSpeedChart($scope.windSpeedType);
});

stationsApp.controller("LiveController", function($scope, apiService){

    $scope.getLiveData = function(){

    };
});
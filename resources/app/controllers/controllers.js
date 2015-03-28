stationsApp.controller('StationsList', function ($scope, apiService) {

    $scope.stations = [];

    $scope.init = function(){

        apiService.getStationList().success(function(data){
            $scope.stations = data;
            $scope.stId = data[0];
        });
    };

    $scope.init();
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

stationsApp.controller("TemperatureController", function($scope, $routeParams, apiService){
    //alert();
    $scope.stationId = $routeParams.stationId;
    $scope.temperatures = [];
    console.log($scope.stationId);
    $scope.getTemperatures = function(){
        apiService.getStationTemperature($scope.stationId, $scope.tempType).
            success(function(data){
                $scope.temperatures = data;
            });
        console.log($scope.temperatures);
        return $scope.temperatures;
    }
    console.log($scope.tempType);
    $scope.getTemperatures($scope.stationId);
});

stationsApp.controller("NavBarController", function($scope, $location){

    $scope.isActive = function(viewLocation){
        return viewLocation === $location.path();
    }
});

stationsApp.controller("ChartsController", function($scope, $routeParams, apiService){

});
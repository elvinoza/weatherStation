stationsApp.controller('HomeController', function ($scope, $rootScope, apiService, $interval, ngProgress) {
    ngProgress.height('4.5px');
    $scope.stations = $rootScope.stations;
    //$scope.stationId = $rootScope.gstationId;
    $scope.getStationId = function(){
        if(!$rootScope.selected){
            $scope.station = $rootScope.stations[0];
        }
        else {
            $scope.station = $rootScope.station;
        }
    };

    $scope.setStationId = function(station){
        $rootScope.selected = true;
        $rootScope.selectedStationId = station.id;
        $rootScope.selectedStationName = station.station_name;
        $rootScope.station = station;
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
        apiService.getLastStationInformation($rootScope.selectedStationId).success(function(data){
            if(data.success){
                $scope.has = true;
                $scope.temperature = data.information.temperature;
                $scope.humidity = data.information.humidity;
                $scope.light_level = data.information.light_level;
                $scope.pressure = data.information.pressure;
                $scope.wind_direction = data.information.wind_direction;
                $scope.wind_speed = data.information.wind_speed;
                $scope.rain = data.information.rain;
                $scope.time = data.information.created_at;
            } else{
                $scope.has = false;
            }
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

stationsApp.controller("NavBarController", function($scope, $location){

    $scope.isActive = function(viewLocation){
        return viewLocation === $location.path();
    }
});

stationsApp.controller("ChartsController", function($scope, $routeParams, $rootScope, apiService, $filter){
    var initialChartType = "m";
    $scope.loading = true;
    var k = 0;
    $scope.stationId = $routeParams.selectedStationId;
    $scope.exist = false;
    $scope.tempType = initialChartType;
    $scope.humType = initialChartType;
    $scope.windSpeedType = initialChartType;
    $scope.pressureType = initialChartType;
    $scope.lightType = initialChartType;
    $scope.directionType = initialChartType;
    $scope.rainType = initialChartType;

//    $scope.hasData = function(){
//        apiService.getLastStationInformation($scope.stationId).success(function(data){
//           if(data.success)
//               $scope.exist = true;
//           else
//               $scope.exist = false;
//        });
//    };

    $scope.getTemperatureChart = function(tempType){

        $scope.tempType = tempType;
        apiService.getStationTemperature($scope.stationId, tempType).success(function(data){
            $scope.tempLabels = [];
            $scope.tempData = [];
            $scope.tempSeries = [$rootScope.selectedStationName + ' temperature'];
            $scope.tempLabels = data.data.map(function(item){ return item.date;});
            $scope.tempData.push(data.data.map(function(item){ return item.temperature;}));
            k++;
            $scope.checkLoading();
        });
    };

    $scope.getTemperatureChartByCustomDate = function(a, b){
        var start = $filter('date')(a, "yyyy-MM-dd");
        var end = $filter('date')(b,"yyyy-MM-dd");
        apiService.getStationDataByDate($scope.stationId, 'temperature', start, end).success(function(data){
            $scope.tempLabels = [];
            $scope.tempData = [];
            $scope.tempSeries = [$rootScope.selectedStationName + ' temperature'];
            $scope.tempLabels = data.data.map(function(item){ return item.date;});
            $scope.tempData.push(data.data.map(function(item){ return item.temperature;}));
        });
    };

    $scope.getHumidityChart = function(humType){
        $scope.humType = humType;
        apiService.getStationHumidity($scope.stationId, humType).success(function(data){
            $scope.humLabels = [];
            $scope.humData = [];
            $scope.humLabels = data.data.map(function(item){ return item.date;});
            $scope.humSeries = [$rootScope.selectedStationName + ' humidity'];
            $scope.humData.push(data.data.map(function(item){ return item.humidity;}));
            k++;
            $scope.checkLoading();
        });
    };

    $scope.getHumidityChartByCustomDate = function(a,b){
        var start = $filter('date')(a, "yyyy-MM-dd");
        var end = $filter('date')(b,"yyyy-MM-dd");
        apiService.getStationDataByDate($scope.stationId, 'humidity', start, end).success(function(data){
            $scope.humLabels = [];
            $scope.humData = [];
            $scope.humLabels = data.data.map(function(item){ return item.date;});
            $scope.humSeries = [$rootScope.selectedStationName + ' humidity'];
            $scope.humData.push(data.data.map(function(item){ return item.humidity;}));
        });
    };

    $scope.getWindSpeedChart = function(windSpeedType){
        $scope.windSpeedType = windSpeedType;
        apiService.getStationWindSpeed($scope.stationId, windSpeedType).success(function(data){
            $scope.windSpeedLabels = [];
            $scope.windSpeedData = [];
            $scope.windSpeedLabels = data.data.map(function(item){ return item.date;});
            $scope.windSpeedSeries = [$rootScope.selectedStationName + ' wind speed'];
            $scope.windSpeedData.push(data.data.map(function(item){ return item.wind_speed;}));
            k++;
            $scope.checkLoading();
        });
    };

    $scope.getWindSpeedChartByCustomDate = function(a,b){
        var start = $filter('date')(a, "yyyy-MM-dd");
        var end = $filter('date')(b,"yyyy-MM-dd");
        apiService.getStationDataByDate($scope.stationId, 'wind_speed', start, end).success(function(data){
            $scope.windSpeedLabels = [];
            $scope.windSpeedData = [];
            $scope.windSpeedLabels = data.data.map(function(item){ return item.date;});
            $scope.windSpeedSeries = [$rootScope.selectedStationName + ' wind speed'];
            $scope.windSpeedData.push(data.data.map(function(item){ return item.wind_speed;}));
        });
    };

    $scope.getPressureChart = function(pressureType){
        $scope.pressureType = pressureType;
        apiService.getStationPressure($scope.stationId, pressureType).success(function(data){
            $scope.pressureLabels = [];
            $scope.pressureData = [];
            $scope.pressureLabels = data.data.map(function(item){ return item.date;});
            $scope.pressureSeries = [$rootScope.selectedStationName + ' pressure'];
            $scope.pressureData.push(data.data.map(function(item){ return item.pressure;}));
            k++;
            $scope.checkLoading();
        });
    };

    $scope.getPressureChartByCustomDate = function(a,b){
        var start = $filter('date')(a, "yyyy-MM-dd");
        var end = $filter('date')(b,"yyyy-MM-dd");
        apiService.getStationDataByDate($scope.stationId, 'pressure', start, end).success(function(data){
            $scope.pressureLabels = [];
            $scope.pressureData = [];
            $scope.pressureLabels = data.data.map(function(item){ return item.date;});
            $scope.pressureSeries = [$rootScope.selectedStationName + ' pressure'];
            $scope.pressureData.push(data.data.map(function(item){ return item.pressure;}));
        });
    };

    $scope.getLightChart = function(lightType){
        $scope.lightType = lightType;
        apiService.getStationlightLevels($scope.stationId, lightType).success(function(data){
            $scope.lightLabels = [];
            $scope.lightData = [];
            $scope.lightLabels = data.data.map(function(item){ return item.date;});
            $scope.lightSeries = [$rootScope.selectedStationName + ' light level'];
            $scope.lightData.push(data.data.map(function(item){ return item.light_level;}));
            k++;
            $scope.checkLoading();
        });
    };

    $scope.getLightChartByCustomDate = function(a,b){
        var start = $filter('date')(a, "yyyy-MM-dd");
        var end = $filter('date')(b,"yyyy-MM-dd");
        apiService.getStationDataByDate($scope.stationId, 'light_level', start, end).success(function(data){
            $scope.lightLabels = [];
            $scope.lightData = [];
            $scope.lightLabels = data.data.map(function(item){ return item.date;});
            $scope.lightSeries = [$rootScope.selectedStationName + ' light level'];
            $scope.lightData.push(data.data.map(function(item){ return item.light_level;}));
        });
    };

    $scope.getWindDirectionChart = function(directionType){
        $scope.directionType = directionType;
        apiService.getStationWindDirections($scope.stationId, directionType).success(function(data){
            $scope.directionLabels = [];
            $scope.directionData = [];
            $scope.directionLabels = Object.keys(data.data);
            $scope.directionSeries = [$rootScope.selectedStationName + ' wind direction'];
            $scope.directionData.push(Object.keys(data.data).map(function (key) { return data.data[key]; }));
            k++;
            $scope.checkLoading();
        })
    };

    $scope.getWindDirectionChartByCustomDate = function(a,b){
        var start = $filter('date')(a, "yyyy-MM-dd");
        var end = $filter('date')(b,"yyyy-MM-dd");
        apiService.getStationDataByDate($scope.stationId, 'wind_direction', start, end).success(function(data){
            $scope.directionLabels = [];
            $scope.directionData = [];
            $scope.directionLabels = Object.keys(data.data);
            $scope.directionSeries = [$rootScope.selectedStationName + ' wind direction'];
            $scope.directionData.push(Object.keys(data.data).map(function (key) { return data.data[key]; }));
        });
    };

    $scope.getRainChart = function(rainType){
        $scope.rainType = rainType;
        apiService.getStationRain($scope.stationId, rainType).success(function(data){
            $scope.rainLabels = [];
            $scope.rainData = [];
            $scope.rainLabels = data.data.map(function(item){ return item.date;});
            $scope.rainSeries = [$rootScope.selectedStationName + ' rain'];
            $scope.rainData.push(data.data.map(function(item){ return item.rain;}));
            k++;
            $scope.checkLoading();
        });
    };

    $scope.getRainChartByCustomDate = function(a,b){
        var start = $filter('date')(a, "yyyy-MM-dd");
        var end = $filter('date')(b,"yyyy-MM-dd");
        apiService.getStationDataByDate($scope.stationId, 'rain', start, end).success(function(data){
            $scope.rainLabels = [];
            $scope.rainData = [];
            $scope.rainLabels = data.data.map(function(item){ return item.date;});
            $scope.rainSeries = [$rootScope.selectedStationName + ' rain'];
            $scope.rainData.push(data.data.map(function(item){ return item.rain;}));
        });
    };

    $scope.checkLoading = function(){
        if(k == 7){
            $scope.loading = false;
            if($scope.tempData[0].length > 0){
                $scope.exist = true;
            }
            console.log($scope.exist);
        }
    };

    $scope.loadCharts = function(){
        $scope.loading = true;
        k = 0;
        $scope.getTemperatureChart($scope.tempType);
        $scope.getHumidityChart($scope.humType);
        $scope.getWindSpeedChart($scope.windSpeedType);
        $scope.getPressureChart($scope.pressureType);
        $scope.getLightChart($scope.lightType);
        $scope.getWindDirectionChart($scope.directionType);
        $scope.getRainChart($scope.rainType);
    };
    $scope.loadCharts();
});

stationsApp.controller("TablesController", function($scope, $routeParams, apiService, $filter, ngTableParams){
    $scope.stationId = $routeParams.selectedStationId;
    $scope.loadAllDataForMainTable = function(){

        apiService.getAllStationData($scope.stationId).success(function(data){
            var information = data;
            $scope.tableParams = new ngTableParams({
                page: 1,
                count: 10,
                filter: {
                    name: ''
                }
            },{
                total: information.length,
                getData: function($defer, params) {
                    // use build-in angular filter
                    var orderedData = params.filter() ?
                        $filter('filter')(information, params.filter()) :
                        information;

                    orderedData = params.sorting() ? $filter('orderBy')(information, params.orderBy()):information;


                    $scope.weathers = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());

                    params.total(orderedData.length); // set total for recalc pagination
                    $defer.resolve($scope.weathers);
                }
                }
            )
        });
    };
    $scope.loadAllDataForMainTable();
});

stationsApp.controller("LiveController", function($scope, apiService){

    $scope.getLiveData = function(){

    };
});
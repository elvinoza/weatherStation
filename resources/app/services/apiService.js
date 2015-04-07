stationsApp.service('apiService', function($http){
    var baseURL = '/api/v1/';

    this.getStationTemperature = function(id, format){
        return $http.get(baseURL + 'get/temperatures/' + id + '/' + format);
    };

    this.getStationHumidity = function(id, format){
        return $http.get(baseURL + 'get/humidities/' + id + '/' + format);
    };

    this.getStationWindSpeed = function(id, format){
        return $http.get(baseURL + 'get/wind_speeds/' + id + '/' + format);
    };

    this.getStationPressure = function(id, format){
        return $http.get(baseURL + 'get/pressures/' + id + '/' + format);
    };

    this.getStationlightLevels = function(id, format){
        return $http.get(baseURL + 'get/light_levels/' + id + '/' + format);
    };

    this.getStationWindDirections = function(id, format){
        return $http.get(baseURL + 'get/wind_direction/' + id + '/' + format);
    }

    this.getFirstStation = function(){
        return $http.get(baseURL + 'get/firstStation');
    };

    this.getStationList = function(){
        return $http.get(baseURL + 'get/stations-list');
    };

    this.getLastStationInformation = function(id){
        return $http.get(baseURL + 'get/lastStationInformation/' + id);
    };
});
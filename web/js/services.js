var baseUrl = "http://api.lista-compras.com";

angular.module('services',[])

.factory('Login', ['$http', '$localStorage', function($http, $localStorage){
        return {
            signin: function(data, success, error) {
                $http.post(baseUrl + '/login', data).success(success).error(error);
            },
            logout: function(success) {
                $localStorage.$reset();
            }
        };
}])

.factory('User', ['$http', function($http){
        return {
            getOne: function(id,success, error) {
                $http.get(baseUrl + '/user/'+id).success(success).error(error);
            },
            getAllUser: function(success, error) {
                $http.get(baseUrl + '/user').success(success).error(error);
            },
            getAllUserOfOrganization: function(id,success, error) {
                $http.get(baseUrl + '/user/organization/'+id).success(success).error(error);
            },
            save: function(object,success, error) {
                $http.post(baseUrl + '/user',object).success(success).error(error);
            },
            update: function(id,object,success, error) {
                $http.put(baseUrl + '/user/'+id,object).success(success).error(error);
            },
            delete: function(id,success, error) {
                $http.delete(baseUrl + '/user/'+id).success(success).error(error);
            }
        };
}])

.factory('AcessLevels', ['$http', function($http){
        return {
            getOne: function(id,success, error) {
                $http.get(baseUrl + '/accesslevels/'+id).success(success).error(error);
            },
            getAccessLevelsNotRoot: function(success, error) {
                $http.get(baseUrl + '/accesslevelsnotroot').success(success).error(error);
            },
            getAll: function(success, error) {
                $http.get(baseUrl + '/accesslevels').success(success).error(error);
            }
        };
}])
    

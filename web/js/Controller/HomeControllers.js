
angular.module('homeControllers', [])

        .controller('DashboardController', function ($scope, $location, $localStorage){
            $scope.user = $localStorage.data;
            $scope.active = false;
        })

        .controller("HomeController", function ($scope, $localStorage) {
            $scope.user = $localStorage.data;
        })
        
       
     
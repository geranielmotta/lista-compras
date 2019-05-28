
angular.module('homeControllers', [])

        .controller('DashboardController', function ($scope, $localStorage){
            $scope.user = $localStorage.data;
            $scope.active = false;
        })

        .controller("HomeController", function ($scope, $localStorage,ShoppingList) {
            $scope.user = $localStorage.data;

            ShoppingList.getAllShoppingListUser($localStorage.user, function (res) {
                if(res.lenght < 1){
                    $state.go('web.shoppinglist-create', null, {'reload': true});
                }

                $scope.shoppinglists = res.shoppinglist;
                console.log($scope.shoppinglists);
            }, function () {
                
            });
        })
        
       
     
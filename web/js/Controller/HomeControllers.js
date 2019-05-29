
angular.module('homeControllers', [])

    .controller('DashboardController', function ($scope, $localStorage) {
        $scope.user = $localStorage.data;
        $scope.active = false;
    })

    .controller("HomeController", function ($scope,$state, $localStorage, ShoppingList) {
        $scope.user = $localStorage.data;

        ShoppingList.getAllShoppingListUser($localStorage.user, function (res) {
            $scope.shoppinglists = res.shoppinglist;
            console.log(res.shoppinglist);
        }, function () {
            ngDialog.open({
                template: 'partials/notification/error/erro-update.html',
                className: 'ngdialog-theme-default'
            });
        });


        $scope.addProductFromCart = function (list) {
            $state.go('web.shoppinglist-add', { 'id': list.id });
        }

    })



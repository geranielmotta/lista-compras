angular.module('shoppingListControllers', [])

.controller('ShoppingListAddController',function($scope, $state, $stateParams,Cart){
    $scope.cart = {};
    var amount = 0;
    $scope.amount = 0;


    Cart.getAllCartOfShoppingList($stateParams.id,function(res){
        $scope.cart = res.cart;
        for (var i = 0; i < res.cart.length; i++) {
            amount = parseFloat(amount) + parseFloat(res.cart[i].price);
            $scope.cart[i].price = $scope.cart[i].price.replace(".",",");
        }
        $scope.amount = amount;
    }, function () {
        ngDialog.open({
            template: 'partials/notification/error/erro-update.html',
            className: 'ngdialog-theme-default'
        });
    });

})
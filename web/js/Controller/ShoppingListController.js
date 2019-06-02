angular.module('shoppingListControllers', [])

.controller('ShoppingListAddController',function($scope, $state, $stateParams,Cart,ngDialog,ShoppingList){
    $scope.cart = {};
    $scope.amount = 0;
    $scope.amountCart = 0;

    Cart.getAllCartOfShoppingList($stateParams.id,function(res){
        $scope.cart = res.cart;
        if(res.cart.length > 0){
            $scope.amountCart = res.cart[0].spending;
            $scope.amount = parseFloat($scope.amountCart);
                for (var i = 0; i < res.cart.length; i++) {
                    $scope.cart[i].price = parseFloat($scope.cart[i].price);
                }
        }else{
            $scope.amountCart = 0;
            $scope.amount = 0;
        }
    }, function () {
        ngDialog.open({
            template: 'partials/notification/error/erro-update.html',
            className: 'ngdialog-theme-default'
        });
    });

    $scope.incrementAmount= function(list) {
        list.list.amount++;
        $scope.amountCart = parseFloat($scope.amountCart) +  parseFloat(list.list.price);
        var data = { spending:$scope.amountCart };
        ShoppingList.updateShoppingList($stateParams.id, data, function (res){
            if(res.type){
                data = { amount : list.list.amount, shoppinglist: $stateParams.id};
                Cart.updateCart(list.list.products, data, function (res){
                    if(res.type){
                        $state.go($state.current, {}, { reload: true });
                    }
                });
            }
        });

    };

    $scope.decrementAmount = function (list){
            list.list.amount--;
            $scope.amountCart = parseFloat($scope.amountCart) - parseFloat(list.list.price);
            var data = { spending:$scope.amountCart ,};
            ShoppingList.updateShoppingList($stateParams.id, data, function (res){
                if(res.type){
                    data = { amount : list.list.amount, shoppinglist: $stateParams.id};
                    Cart.updateCart(list.list.products, data, function (){
                        $state.go($state.current, {}, { reload: true });
                    });
                }
            });
    };

    $scope.addProductFromCart = function () {
        $state.go('web.shoppinglist-add-form', { 'id': $stateParams.id });
    }

    $scope.removeProducts = function (list){
        var amount = list.list.amount;
        ngDialog.openConfirm({
            template: 'partials/notification/delete/delete-confirmed.html',
            className: 'ngdialog-theme-default'
        })
            .then(function () {
                
                for (var i = 0; i < amount; i++) {
                        $scope.decrementAmount(list);
                        console.log(i);
                }
                
                Cart.remove(list.list.products,$stateParams.id,function(){
                    $state.go($state.current, {}, { reload: true });
               });
            });        
    }
})

.controller('ShoppingListSelectProductsController',function($scope, $state, $stateParams,Cart,Products,ShoppingList,ngDialog){
    $scope.cart = {};
    Products.getAllProductsNotHaveCart(function(res){
        $scope.products = res.products;
    },function(res){
        ngDialog.open({
            template: '<p class="alert alert-danger"> <i class="fa fa-2x fa-danger"></i> Perdemos a conexão com servidor, tente novamente em breve</p>',
            className: 'ngdialog-theme-default',
            plain: true
        });
    });

    $scope.addProductFromCart = function(item){
        var data = { spending :  item.products.price , shoppinglist: $stateParams.id};
        var cart = {products: item.products.id,shoppinglist: $stateParams.id};
        Cart.getAllCartOfShoppingList($stateParams.id,function(res){
            if(res.type && res.cart.length > 0){
                data.spending = parseFloat(res.cart[0].spending) + parseFloat(item.products.price);
            }
            Cart.addProducts(cart,function(res){
                if(res.type){
                    ShoppingList.updateShoppingList($stateParams.id, data, function (res){
                        if(res.type){
                            $state.go('web.shoppinglist-add', { 'id': $stateParams.id });
                        }
                    })
                }
            });
        })
    }
})
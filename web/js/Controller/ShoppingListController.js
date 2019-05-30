angular.module('shoppingListControllers', [])

.controller('ShoppingListAddController',function($scope, $state, $stateParams,Cart,ngDialog,ShoppingList){
    $scope.cart = {};
    $scope.amount = 0;
    $scope.amountCart = 0;
    


    Cart.getAllCartOfShoppingList($stateParams.id,function(res){
        $scope.cart = res.cart;
        $scope.amountCart = res.cart[0].spending;
        $scope.amount = parseFloat($scope.amountCart);
        for (var i = 0; i < res.cart.length; i++) {
            $scope.cart[i].price = parseFloat($scope.cart[i].price);
        }
        console.log($scope.cart)
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
                console.log(list.list.products);
                Cart.updateCart(list.list.products, data, function (res){
                    if(res.type){
                        $state.go($state.current, {}, { reload: true });
                    }
                });
            }
        });

    };

    $scope.decrementAmount = function (list){
        console.log(parseInt(list.list.amount));
        if(parseInt(list.list.amount) > parseInt(0)){
            list.list.amount--;
            $scope.amountCart = parseFloat($scope.amountCart) - parseFloat(list.list.price);
            console.log(parseFloat(list.list.price));
            var data = { spending:$scope.amountCart ,};
            ShoppingList.updateShoppingList($stateParams.id, data, function (res){
                if(res.type){
                    data = { amount : list.list.amount, shoppinglist: $stateParams.id};
                    Cart.updateCart(list.list.products, data, function (){
                        $state.go($state.current, {}, { reload: true });
                    });
                }
            });
        }else{
            $scope.removeProducts();
        }
    };

    $scope.addProductFromCart = function () {
        $state.go('web.shoppinglist-add-form', { 'id': $stateParams.id });
    }

    $scope.removeProducts = function (list){
        ngDialog.openConfirm({
            template: 'partials/notification/delete/delete-confirmed.html',
            className: 'ngdialog-theme-default'
        })
            .then(function () {
                Cart.remove(list.list.products,$stateParams.id,function(){
                    $state.go($state.current, {}, { reload: true });
                }, function () {
                    ngDialog.open({
                        template: 'partials/notification/delete/delete-fail.html',
                        className: 'ngdialog-theme-default'
                    });    
                });
            });        
    }
})

.controller('ShoppingListSelectProductsController',function($scope, $state, $stateParams,Cart,Products,ngDialog){
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

    $scope.addProductFromCart = function(products){
        var cart = {
            products: products.id,
            shoppinglist: $stateParams.id
        };

        Cart.addProducts(cart,function(){
            $state.go('web.shoppinglist-add', { 'id': $stateParams.id });
        });
    }

})
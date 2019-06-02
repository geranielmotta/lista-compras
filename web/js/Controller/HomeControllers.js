
angular.module('homeControllers', [])

    .controller('DashboardController', function ($scope, $localStorage) {
        $scope.user = $localStorage.data;
        $scope.active = false;
    })

    .controller("HomeController", function ($scope,$state, $localStorage, ShoppingList,ngDialog) {
        $scope.user = $localStorage.data;
        $scope.hide = false;

        ShoppingList.getAllShoppingListUser($localStorage.user, function (res) {
            $scope.shoppinglists = res.shoppinglist;
            if(res.shoppinglist.length == 0){
                $scope.createShoppingList();
            }
            $scope.hide = true;
        }, function () {
            ngDialog.open({
                template: 'partials/notification/error/erro-update.html',
                className: 'ngdialog-theme-default'
            });
        });

        $scope.addProductFromCart = function (list) {
            $state.go('web.shoppinglist-add', { 'id': list.id });
        }

        $scope.createShoppingList = function (){
            var data = {user: $localStorage.user };
            ShoppingList.createShoppingList( data, function (res){
                if(res.type){
                   $state.go('web.shoppinglist-add', { 'id': res.shoppinglist.id });
                }
            });   
        }

        $scope.deleteShoppingList = function (list){
            ngDialog.openConfirm({
                template: 'partials/notification/delete/delete-confirmed.html',
                className: 'ngdialog-theme-default'
            })
                .then(function () {
                    ShoppingList.delete(list.id,function(){
                        $state.go($state.current, {}, { reload: true });
                   });
                });        
        }

    })



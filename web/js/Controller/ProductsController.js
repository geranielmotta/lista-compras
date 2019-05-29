angular.module('productsControllers', [])

.controller('ProductsListController', function($scope,$state,Products,ngDialog){
    $scope.products = {};

    Products.getAllProducts(function(res){
        $scope.products = res.products;
        console.log('products '+res.type);
    },function(res){
        ngDialog.open({
            template: '<p class="alert alert-danger"> <i class="fa fa-2x fa-danger"></i> Perdemos a conexão com servidor, tente novamente em breve</p>',
            className: 'ngdialog-theme-default',
            plain: true
        });
    })

    $scope.deleteProducts = function (products) {
        ngDialog.openConfirm({
            template: 'partials/notification/delete/delete-confirmed.html',
            className: 'ngdialog-theme-default'
        })
            .then(function () {
                Products.delete(products.products.id, function (res) {
                    if (!res.type && res.type != null) {
                        ngDialog.open({
                            template: 'partials/notification/error/erro-delete.html',
                            className: 'ngdialog-theme-default'
                        });
                    }
                    $state.go($state.current, {}, { reload: true });
                }, function () {
                    ngDialog.open({
                        template: 'partials/notification/delete/delete-fail.html',
                        className: 'ngdialog-theme-default'
                    });
                });

            });
    };

    $scope.createProducts = function () {
        $state.go('web.products-create');
    };

    $scope.updateProducts = function (products) {
        $state.go('web.products-update', { 'id': products.id });
    };

})
.controller('ProductsCreateController',function($scope,$state,Products,Category,ngDialog){
    $scope.hideBotton = true;
    $scope.products = {};
    $scope.category = {};

    Category.getAllCategory(function(res){
        $scope.category = res.category;
    });

    $scope.createProducts = function () {
        Products.save($scope.products, function (res) {
                if(!res.type){
                    ngDialog.open({
                        template: '<p class="alert alert-info"> <i class="fa fa-2x fa-warning"></i>Erro ao inserir os campos</br>'+ res +'</p>',
                        className: 'ngdialog-theme-default',
                        plain: true
                    });
                }
                ngDialog.open({
                    template: 'partials/notification/create/create-confirmed.html',
                    className: 'ngdialog-theme-default'
                });
                $state.go('web.products');
            }, function () {
                ngDialog.open({
                    template: 'partials/notification/error/error-creat.html',
                    className: 'ngdialog-theme-default'
                });
        });
    };
})
.controller('ProductsUpdateController',function($scope, $state, $stateParams, ngDialog, Products,Category){
    $scope.products = {};

    Products.getOne($stateParams.id, function (res) {
        $scope.products = res.products;
        Category.getAllCategory(function(res){
            $scope.category = res.category;
            for (var i = 0; i < res.category.length; i++) {
                if ($scope.category[i].id == $scope.products.category) {
                    $scope.products.category = $scope.category[i].id;
                    i = res.category.length;
                }
            }
        });
    });    

    $scope.updateProducts = function () {
        Products.update($stateParams.id, $scope.products, function (res) {
            if(!res.type){
                ngDialog.open({
                    template: '<p class="alert alert-info"> <i class="fa fa-2x fa-warning"></i>Erro ao atualizar os campos</p>',
                    className: 'ngdialog-theme-default',
                    plain: true
                });
                $state.go('web.products-update', {'id': $stateParams.id});
            }else{
                ngDialog.open({
                    template: 'partials/notification/update/update-confirmed.html',
                    className: 'ngdialog-theme-default'
                });
                $state.go('web.products');
            }
        }, function () {
            ngDialog.open({
                template: 'partials/notification/error/erro-update.html',
                className: 'ngdialog-theme-default'
            });
        });
    };
})
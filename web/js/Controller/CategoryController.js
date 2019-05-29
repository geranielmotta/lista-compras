angular.module('categoryController', [])

.controller('CategoryListController', function($scope,$state,Category,ngDialog){
    $scope.category = {};

    Category.getAllCategory(function(res){
        $scope.category = res.category;
    },function(res){
        ngDialog.open({
            template: '<p class="alert alert-danger"> <i class="fa fa-2x fa-danger"></i> Perdemos a conexão com servidor, tente novamente em breve</p>',
            className: 'ngdialog-theme-default',
            plain: true
        });
    })

    $scope.deleteCategory = function (category) {
        ngDialog.openConfirm({
            template: 'partials/notification/delete/delete-confirmed.html',
            className: 'ngdialog-theme-default'
        })
            .then(function () {
                Category.delete(category.category.id, function (res) {
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

    $scope.createCategory = function () {
        $state.go('web.category-create');
    };

    $scope.updateCategory = function (category) {
        $state.go('web.category-update', { 'id': category.id });
    };

})
.controller('CategoryCreateController',function($scope,$state,Category,ngDialog){
    $scope.hideBotton = true;
    $scope.category = {};

    $scope.createCategory = function () {
        Category.save($scope.category, function (res) {
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
                $state.go('web.category-list');
            }, function () {
                ngDialog.open({
                    template: 'partials/notification/error/error-creat.html',
                    className: 'ngdialog-theme-default'
                });
        });
    };
})
.controller('CategoryUpdateController',function($scope, $state, $stateParams, ngDialog, Category){
    $scope.category = {};

    Category.getOne($stateParams.id, function (res) {
        $scope.category = res.category;
    });    

    $scope.updateCategory = function () {
        console.log($scope.category);
        Category.update($stateParams.id, $scope.category, function (res) {
            if(!res.type){
                ngDialog.open({
                    template: '<p class="alert alert-info"> <i class="fa fa-2x fa-warning"></i>Erro ao atualizar os campos</p>',
                    className: 'ngdialog-theme-default',
                    plain: true
                });
                $state.go('web.category-update', {'id': $stateParams.id});
            }else{
                ngDialog.open({
                    template: 'partials/notification/update/update-confirmed.html',
                    className: 'ngdialog-theme-default'
                });
                $state.go('web.category-list');
            }
        }, function () {
            ngDialog.open({
                template: 'partials/notification/error/erro-update.html',
                className: 'ngdialog-theme-default'
            });
        });
    };
})
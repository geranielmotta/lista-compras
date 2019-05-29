angular.module('userControllers', [])
    /*
             * Inicio do crud usuários
             */

    .controller('UserListController', function ($scope, $state, $localStorage, ngDialog, User) {
        //variáveis para controler do ng-show
        $scope.table = false;
        $scope.buttonAdd = false;

        User.getAllUser(function (res) {
            $scope.users = res.user;
            if (res.user.length != 0) {
                // se encontrou mostra tabela
                $scope.table = true;
                $scope.buttonAdd = true;
            } else {
                $scope.table = false;
                $scope.buttonAdd = true;
                ngDialog.open({
                    template: '<p class="alert alert-info"> <i class="fa fa-2x fa-warning"></i> Ainda não foram cadastrados usuários</p>',
                    className: 'ngdialog-theme-default',
                    plain: true
                });
            }
        });

        $scope.deleteUser = function (user) {
            ngDialog.openConfirm({
                template: 'partials/notification/delete/delete-confirmed.html',
                className: 'ngdialog-theme-default'
            })
                .then(function () {
                    User.delete(user.user.id, function (res) {
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

        $scope.createUser = function () {
            $state.go('web.user-create');
        };

        $scope.updateUser = function (user) {
            $state.go('web.user-update', { 'id': user.id });
        };
    })

    .controller('UserCreateController', function ($scope, $state, ngDialog, $localStorage, User, AcessLevels) {
        $scope.hideBotton = true;
        $scope.user = {};
        if ($localStorage.access_levels == 100) {
            $scope.hideBotton = false;

            AcessLevels.getAccessLevelsNotRoot(function (res) {
                $scope.access = res.access_levels;

            });

        } else {
            AcessLevels.getAll(function (res) {
                $scope.access = res.access_levels;

            });
        }


        $scope.createUser = function () {

            if ($localStorage.access_levels == 1000) {
                if ($scope.user.access_levels == null) {
                    ngDialog.open({
                        template: '<p class="alert alert-info">Selecione um nivel de acessoa para o usuário <i class="fa fa-2x fa-warning"></i></p>',
                        className: 'ngdialog-theme-default',
                        plain: true
                    });

                } else {
                    User.save($scope.user, function () {
                        ngDialog.open({
                            template: 'partials/notification/creat/creat-confirmed.html',
                            className: 'ngdialog-theme-default'
                        });
                        $state.go('web.user');
                    }, function () {
                        ngDialog.open({
                            template: 'partials/notification/error/error-creat.html',
                            className: 'ngdialog-theme-default'
                        });
                    });

                }
            } else {
                User.save($scope.user, function () {
                    ngDialog.open({
                        template: 'partials/notification/creat/creat-confirmed.html',
                        className: 'ngdialog-theme-default'
                    });
                    $state.go('web.user');
                }, function () {
                    ngDialog.open({
                        template: 'partials/notification/error/error-creat.html',
                        className: 'ngdialog-theme-default'
                    });
                });

            }
        };
    })

    .controller('UserUpdateController', function ($scope, $state, $localStorage, $stateParams, ngDialog, User, AcessLevels) {

        $scope.hideBotton = true;
        $scope.user = {};
        var valueAccess;

        User.getOne($stateParams.id, function (res) {
            $scope.user = res.user;
            valueAccess = $scope.user.access_levels;

            if ($localStorage.access_levels == 100) {
                $scope.hideBotton = false;
                AcessLevels.getAccessLevelsNotRoot(function (res) {
                    $scope.access = res.access_levels;
                    for (var i = 0; i < res.access_levels.length; i++) {
                        if ($scope.access[i].description == valueAccess) {
                            //console.log($scope.access[i].code);
                            valueAccess = $scope.access[i].id;
                            i = res.access_levels.length;
                        }
                    }
                    $scope.user.access_levels = valueAccess;
                });
            } else {
                AcessLevels.getAll(function (res) {
                    $scope.access = res.access_levels;
                    for (var i = 0; i < res.access_levels.length; i++) {
                        if ($scope.access[i].description == valueAccess) {
                            //console.log($scope.access[i].code);
                            valueAccess = $scope.access[i].id;
                            i = res.access_levels.length;
                        }
                    }
                    $scope.user.access_levels = valueAccess;
                });
            }

        });

        $scope.updateUser = function () {
            if ($localStorage.access_levels == 1000) {
                if ($scope.user.access_levels == null) {
                    ngDialog.open({
                        template: '<p class="alert alert-info"> <i class="fa fa-2x fa-warning"></i>Selecione uma nivel de acesso</p>',
                        className: 'ngdialog-theme-default',
                        plain: true
                    });
                } else {
                    User.update($stateParams.id, $scope.user, function () {
                        ngDialog.open({
                            template: 'partials/notification/update/update-confirmed.html',
                            className: 'ngdialog-theme-default'
                        });
                        $state.go('web.user');
                    }, function () {
                        ngDialog.open({
                            template: 'partials/notification/error/erro-update.html',
                            className: 'ngdialog-theme-default'
                        });
                    });
                }
            } else {
                User.update($stateParams.id, $scope.user, function () {
                    ngDialog.open({
                        template: 'partials/notification/update/update-confirmed.html',
                        className: 'ngdialog-theme-default'
                    });
                    $state.go('web.user');
                }, function () {
                    ngDialog.open({
                        template: 'partials/notification/error/erro-update.html',
                        className: 'ngdialog-theme-default'
                    });
                });

            }
        };
    })
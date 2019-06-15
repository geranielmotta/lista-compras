angular.module('profileControllers', [])
/*
         * inicio crud profile
         */
        .controller('ProfileController', function ($scope, $state, $localStorage, User) {
            $scope.active = false;
            User.getOne($localStorage.user, function (res) {
                $scope.user = res.user;
            });

            $scope.updateProfile = function (user) {
                $state.go('web.profile-update', {'id': user.id});
            };
        })
        .controller('ProfileUpdateController', function ($scope, $state,$localStorage, $stateParams, ngDialog, User, AcessLevels) {
            $scope.select=false;
            $scope.user = {};
            //guarda o id de Organization e Acess_levels    
            var valueAccess;

            User.getOne($stateParams.id, function (res) {
                $scope.user = res.user;
                valueAccess = $scope.user.access_levels;
                
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
                    console.log($scope.user.access_levels);
               
            }, function () {
                ngDialog.openConfirm({
                    template: 'partials/notification/error/erro-connection.html',
                    className: 'ngdialog-theme-default'
                });
            });
            if($localStorage.access_levels == 100 || $localStorage.access_levels == 10 || $localStorage.access_levels == 100 || $localStorage.access_levels == 1 ){
        
               $scope.user.access_levels = valueAccess;
               $scope.select=false;
               
            }else{
                $scope.select=true;
            }
            
    });
            $scope.updateProfile = function () {
                if ($scope.user.access_levels == null) {
                    if ($scope.user.access_levels == null) {
                        ngDialog.open({
                            template: '<p class="alert alert-info"> <i class="fa fa-2x fa-warning"></i>Selecione um nivel de acesso</p>',
                            className: 'ngdialog-theme-default',
                            plain: true
                        });
                    }
                } else {
                    User.update($stateParams.id, $scope.user, function () {
                        ngDialog.open({
                            template: 'partials/notification/update/update-confirmed.html',
                            className: 'ngdialog-theme-default'
                        });
                        $state.go('web.profile');
                    });
                }
            };
            
            
        })

angular.module('loginControllers', [])
.controller('LoginController', function ($scope, $state, $localStorage,ngDialog,Login,ShoppingList,User) {

    if ((typeof ($localStorage.token) !== 'undefined') || (typeof ($localStorage.user) !== 'undefined')) {
        ShoppingList.getAllShoppingListUser($localStorage.user, function (res) {
            $state.go('web.home', null, {'reload': true});
        }, function () {
            $scope.data.email = null;
            $scope.data.password = null;
        });
    }

    $scope.data = {};
    $scope.user = {};

    $scope.doLogin = function () {

       if (angular.isObject($scope.data)) {
            var formData = {
                email: $scope.data.email,
                password: $scope.data.password
            };

            Login.signin(formData, function (res) {
                if (res.type == true) {
                    $localStorage.token = res.token;
                    $localStorage.user = res.id;
                    $localStorage.access_levels = res.access_levels;
                    $localStorage.data = res.data;
                    $state.go('web.home');
                } else {
                    $scope.data.password = null;
                }
            }, function (res) {
                console.log(res);
                console.log("ERRO para email : "+$scope.data.email + " - senha : "+$scope.data.password );
            });
        }
    };

    $scope.newUser = function(){
        User.save($scope.user, function (res) {
            if (res.type == true) {
                $scope.data.email = $scope.user.email;
                $scope.data.password = $scope.user.password;
                $scope.doLogin();
            } 
        }, function (res) {
            ngDialog.open({
                template: 'partials/notification/error/error-create.html',
                className: 'ngdialog-theme-default'
            });
        });
    }

})

.controller('LogoutController', function ($state, Login) {
    Login.logout();
    $state.go('login', {'reload': true});
})
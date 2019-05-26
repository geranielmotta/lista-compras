angular.module('loginControllers', [])
.controller('LoginController', function ($scope, $state, $localStorage, Login) {

    if ((typeof ($localStorage.token) !== 'undefined') || (typeof ($localStorage.user) !== 'undefined')) {
        UserField.getUserOfField($localStorage.user, function (res) {
            $state.go('web.home', null, {'reload': true});
        }, function () {
            $scope.data.email = null;
            $scope.data.password = null;
        });
    }

    $scope.data = {};

    $scope.doLogin = function () {

        if ($scope.data.email != null && $scope.data.password != null) {

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
                    console.log(res);
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

})

.controller('LogoutController', function ($state, Login) {
    Login.logout();
    $state.go('login', {'reload': true});
})
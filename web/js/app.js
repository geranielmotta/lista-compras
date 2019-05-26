
angular.module('app',['ui.router',
                      'ngResource',
                      'loginControllers',
                      'userControllers',
                      'profileControllers',
                      'categoryController',
                      'productsControllers',
                      'shoppingListControllers',
                      'cartControllers',
                      'accessLevelsControllers',
                      'homeControllers',
                      'services',
                      'directives',
                      'ngStorage',
                      'ngAnimate',
                      'ngDialog',
                      'ng.confirmField',
                      'checklist-model',
                      'ui.bootstrap',
                      'angular-loading-bar'
                    ]
                );

angular.module('app').config(function($stateProvider, $urlRouterProvider, $httpProvider){
    $stateProvider

    .state('login',{
        url:'/login',
        templateUrl:'partials/login/login.html',
        controller:'LoginController'
    })
    
    .state('logout', {
        url: '/logout',
        templateUrl:'partials/login/login.html',
        controller: 'LogoutController'
    })

    .state('web',{
        url:'/web',
        abstract: true,
        templateUrl:'partials/dashboard.html',
        controller:'DashboardController'
    })

    .state('web.home',{
        url:'/home',
        views: {
          'dashboard': {
            templateUrl:'partials/home/home.html',
            controller:'HomeController'
          }
        }
    })
    
    .state('web.profile',{
        url:'/profile',
        views: {
          'dashboard': {
            templateUrl:'partials/profile/profile.html',
            controller:'ProfileController'
          }
        }
    })
    

    .state('web.profile-update', {
        url: '/profile/:id/update',
        views: {
        'dashboard': {
            templateUrl: 'partials/profile/profile-update.html',
            controller: 'ProfileUpdateController'
                      }
               }
    })
    
    .state('web.user',{
        url:'/user',
        views: {
          'dashboard': {
            templateUrl:'partials/user/user-list.html',
            controller:'UserListController'
          }
        }
    })
    
    .state('web.user-create',{
        url:'/user/create',
        views: {
          'dashboard': {
            templateUrl:'partials/user/user-create.html',
            controller:'UserCreateController'
          }
        }
    })
    
    .state('web.user-update',{
        url:'/user/:id/update',
        views: {
          'dashboard': {
            templateUrl:'partials/user/user-update.html',
            controller:'UserUpdateController'
          }
        }
    })
    
    

    $urlRouterProvider.otherwise('/login');
                
    $httpProvider.interceptors.push(['$q', '$location', '$localStorage', function ($q, $location, $localStorage) {
        return {
            'request': function (config) {
                config.headers = config.headers || {};
                if ($localStorage.token) {
                    config.headers.Authorization = 'Bearer ' + $localStorage.token;
                }
                return config;
            },
            'responseError': function (response) {
                if (response.status === 401 || response.status === 403) {
                    $location.path('/login');
                }
                return $q.reject(response);
            }
        };
    }]);

}).run(function($state){
   $state.go('login');
});


 var jSonUser = [];
 var jSonProducts =[];

angular.module('reportControllers', [])

.controller('ReportController', function ($scope, $filter, Report) {
    $scope.products = {};
    $scope.users = {};

    Report.getMostPurchasedProducts(function(res){
        $scope.products = res.productsreport;
        for(var i=0;i< $scope.users.length;i++){    
            $scope.products[i].price = $filter('moeda')($scope.products[i].price);
            jSonProducts.push($scope.products[i]);
        }
    });

    Report.getUsersWhoSpentMore(function(response){
        $scope.users = response.usersreport;

        for(var i=0;i< $scope.users.length;i++){    
            $scope.users[i].date =  $filter('date')(new Date($scope.users[i].date),'dd/MM/yyyy HH:mm');
            $scope.users[i].spending = $filter('moeda')($scope.users[i].spending);
            jSonUser.push($scope.users[i]);
        }
    });


    $scope.generatePDF = function(){

    };
      
})

 var jSonUser = [];
 var jSonProducts =[];

angular.module('reportControllers', [])

.controller('ReportController', function ($scope, $filter, Report) {
    $scope.products = {};
    $scope.users = {};

    Report.getMostPurchasedProducts(function(res){
        $scope.products = res.productsreport;
        for(var i=0;i< res.productsreport.length;i++){    
            res.productsreport[i].price = $filter('coin')(res.productsreport[i].price);
            jSonProducts.push(res.productsreport[i]);
        }
        console.log('rtes');
        console.log($scope.products);
    });

    Report.getUsersWhoSpentMore(function(response){
        $scope.users = response.usersreport;
        for(var i=0;i< response.usersreport.length ;i++){    
            response.usersreport[i].date =  $filter('date')(new Date(response.usersreport[i].date),'dd/MM/yyyy HH:mm');
            response.usersreport[i].spending = $filter('coin')(response.usersreport[i].spending);
            jSonUser.push(response.usersreport[i]);
        }
        console.log($scope.users);
    });
})
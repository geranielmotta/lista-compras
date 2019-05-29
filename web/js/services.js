var baseUrl = "http://api.lista-compras.com";

angular.module('services',[])

.factory('Login', ['$http', '$localStorage', function($http, $localStorage){
        return {
            signin: function(data, success, error) {
                $http.post(baseUrl + '/login', data).success(success).error(error);
            },
            logout: function(success) {
                $localStorage.$reset();
            }
        };
}])

.factory('User', ['$http', function($http){
        return {
            getOne: function(id,success, error) {
                $http.get(baseUrl + '/user/'+id).success(success).error(error);
            },
            getAllUser: function(success, error) {
                $http.get(baseUrl + '/user').success(success).error(error);
            },
            save: function(object,success, error) {
                $http.post(baseUrl + '/user',object).success(success).error(error);
            },
            update: function(id,object,success, error) {
                $http.put(baseUrl + '/user/'+id,object).success(success).error(error);
            },
            delete: function(id,success, error) {
                $http.delete(baseUrl + '/user/'+id).success(success).error(error);
            }
        };
}])

.factory('AcessLevels', ['$http', function($http){
        return {
            getOne: function(id,success, error) {
                $http.get(baseUrl + '/accesslevels/'+id).success(success).error(error);
            },
            getAccessLevelsNotRoot: function(success, error) {
                $http.get(baseUrl + '/accesslevelsnotroot').success(success).error(error);
            },
            getAll: function(success, error) {
                $http.get(baseUrl + '/accesslevels').success(success).error(error);
            }
        };
}])

.factory('ShoppingList', ['$http', function($http){
    return {
        getOne: function(id,success, error) {
            $http.get(baseUrl + '/shoppinglist/'+id).success(success).error(error);
        },
        getAllUser: function(success, error) {
            $http.get(baseUrl + '/shoppinglist').success(success).error(error);
        },
        getAllShoppingListUser: function(user,success, error) {
            $http.get(baseUrl + '/shoppinglist/user/'+user).success(success).error(error);
        },
        save: function(object,success, error) {
            $http.post(baseUrl + '/shoppinglist',object).success(success).error(error);
        },
        delete: function(id,success, error) {
            $http.delete(baseUrl + '/shoppinglist/'+id).success(success).error(error);
        }
    };
}])

.factory('Cart',['$http', function($http){
    return {
        addProducts: function(list,object, success, error){
            $http.post(baseUrl + '/cart/addproducts/shoppinglist/'+list,object).success(success).error(error);
        },
        remove: function(products, success, error){
            $http.delete(baseUrl + '/cart/removeproducts/products/'+products).success(success).error(error);
        },
        getAllCartOfShoppingList:function(shoppinglist, success, error){
            $http.get(baseUrl + '/cart/shoppinglist/'+shoppinglist).success(success).error(error);
        }
    }
}])

.factory('Category', ['$http', function($http){
    return {
        getOne: function(id,success, error) {
            $http.get(baseUrl + '/category/'+id).success(success).error(error);
        },
        getAllCategory: function(success, error) {
            $http.get(baseUrl + '/category').success(success).error(error);
        },
        save: function(object,success, error) {
            $http.post(baseUrl + '/category',object).success(success).error(error);
        },
        update: function(id,object,success, error) {
            $http.put(baseUrl + '/category/'+id,object).success(success).error(error);
        },
        delete: function(id,success, error) {
            $http.delete(baseUrl + '/category/'+id).success(success).error(error);
        }
    };
}])
.factory('Products', ['$http', function($http){
    return {
        getOne: function(id,success, error) {
            $http.get(baseUrl + '/products/'+id).success(success).error(error);
        },
        getAllProducts: function(success, error) {
            $http.get(baseUrl + '/products').success(success).error(error);
        },
        save: function(object,success, error) {
            $http.post(baseUrl + '/products',object).success(success).error(error);
        },
        update: function(id,object,success, error) {
            $http.put(baseUrl + '/products/'+id,object).success(success).error(error);
        },
        delete: function(id,success, error) {
            $http.delete(baseUrl + '/products/'+id).success(success).error(error);
        }
    };
}])    

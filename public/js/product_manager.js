var app = angular.module('product_manager', []);
var controllers = {};

app.service('productService',function($http){

  return {
    getProducts: function() {
      return $http.get('productrest/data');

    }

  };
});

app.service('searchService',function($http){

  return {
    getProducts: function(search,page) {
      return $http.get('productrest/data?search='+search+'&page='+page);

    }

  };
});

app.service('brandService',function($http){

  return {
    getBrands: function() {
      return $http.get('productrest/brand');

    }

  };
});

app.service('categoryService',function($http){

  return {
    getCategories: function() {
      return $http.get('productrest/category');

    }

  };
});






Array.prototype.remove = function(from, to) {
  var rest = this.slice((to || from) + 1 || this.length);
  this.length = from < 0 ? this.length + from : from;
  return this.push.apply(this, rest);
};


controllers.ProductCtrl = function($scope, $http, productService , brandService, categoryService, searchService){
	
console.log('test');
$scope.search = '';

  function getById(arr, id) {
    for (var d = 0, len = arr.length; d < len; d += 1) {
      if (arr[d].id === id) {
        return d;
      }
    }
  }

  $scope.delete_product = function(prodID, name){
    var confirm_deletion = confirm("Deleting "+name+". Are you sure?");

    if(confirm_deletion){

      $http({method: 'DELETE', url: 'product/'+prodID }).
      success(function(data) {

      }).
      error(function(data) {
      });



      var index = getById($scope.products, prodID);
      console.log(index);
      $scope.products.remove(index);

      $scope.message = name + ' is deleted.';

    }



  }

  $scope.next = function(){
    if($scope.currentPage !== $scope.total && $scope.total !== 0) $scope.currentPage += 1;
    searchService.getProducts($scope.search,$scope.currentPage).success(function(data){
      $scope.products = data.data;
      $scope.total = data.last_page;
      brandService.getBrands().success(function(data){
        var brand_list = {};

        for (var i = 0; i<data.length; i++) {
          var obj =data[i];
          brand_list[obj.id] = obj.name;
        }

        for (var i = $scope.products.length - 1; i >= 0; i--) {
          $scope.products[i].brand = brand_list[$scope.products[i].brand_id];
        };

      });

      categoryService.getCategories().success(function(data){
        var category_list = {};

        for (var i = 0; i<data.length; i++) {
          var obj =data[i];
          category_list[obj.id] = obj.name;
        }

        for (var i = $scope.products.length - 1; i >= 0; i--) {
          $scope.products[i].category = category_list[$scope.products[i].category_id];
        };

      });
    });

    $scope.message = '';


  }

  $scope.prev = function(){
    if($scope.currentPage !== 1 && $scope.total !== 0) $scope.currentPage -= 1;
    searchService.getProducts($scope.search,$scope.currentPage).success(function(data){
      $scope.products = data.data;
      $scope.total = data.last_page;
      brandService.getBrands().success(function(data){
        var brand_list = {};

        for (var i = 0; i<data.length; i++) {
          var obj =data[i];
          brand_list[obj.id] = obj.name;
        }

        for (var i = $scope.products.length - 1; i >= 0; i--) {
          $scope.products[i].brand = brand_list[$scope.products[i].brand_id];
        };

      });

      categoryService.getCategories().success(function(data){
        var category_list = {};

        for (var i = 0; i<data.length; i++) {
          var obj =data[i];
          category_list[obj.id] = obj.name;
        }

        for (var i = $scope.products.length - 1; i >= 0; i--) {
          $scope.products[i].category = category_list[$scope.products[i].category_id];
        };

      });
    });
    $scope.message = '';
  }



  $scope.$watch('search',function(){

    console.log($scope.search);
    $scope.message = '';

    searchService.getProducts($scope.search,1).success(function(data){
      $scope.products = data.data;
      $scope.currentPage = 1;
      $scope.total = data.last_page;
      brandService.getBrands().success(function(data){
        var brand_list = {};

        for (var i = 0; i<data.length; i++) {
          var obj =data[i];
          brand_list[obj.id] = obj.name;
        }

        for (var i = $scope.products.length - 1; i >= 0; i--) {
          $scope.products[i].brand = brand_list[$scope.products[i].brand_id];
        };

      });

      categoryService.getCategories().success(function(data){
        var category_list = {};

        for (var i = 0; i<data.length; i++) {
          var obj =data[i];
          category_list[obj.id] = obj.name;
        }

        for (var i = $scope.products.length - 1; i >= 0; i--) {
          $scope.products[i].category = category_list[$scope.products[i].category_id];
        };

      });
    });

  });

  $scope.toggle = function(product, index){

     $scope.products[index].availability = !$scope.products[index].availability;

    $http.get('product/toggle/'+product).success(function(data){
     $scope.products[index].availability = data.availability;
      console.log( $scope.products[index].availability);
    }).error(function(){
    	console.log('fail');
    });

    $scope.message = '';


  }



}


app.controller(controllers);
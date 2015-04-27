var app = angular.module('book_manager', []);
var controllers = {};

app.service('bookService',function($http){

  return {
    getBooks: function() {
      return $http.get('bookrest/data');

    }

  };
});

app.service('searchService',function($http){

  return {
    getBooks: function(search,page) {
      return $http.get('bookrest/data?search='+search+'&page='+page);

    }

  };
});

app.service('brandService',function($http){

  return {
    getBrands: function() {
      return $http.get('bookrest/brand');

    }

  };
});

app.service('categoryService',function($http){

  return {
    getCategories: function() {
      return $http.get('bookrest/category');

    }

  };
});






Array.prototype.remove = function(from, to) {
  var rest = this.slice((to || from) + 1 || this.length);
  this.length = from < 0 ? this.length + from : from;
  return this.push.apply(this, rest);
};


controllers.BookCtrl = function($scope, $http, bookService , brandService, categoryService, searchService){
  
console.log('test');
$scope.search = '';

  function getById(arr, id) {
    for (var d = 0, len = arr.length; d < len; d += 1) {
      if (arr[d].id === id) {
        return d;
      }
    }
  }

  $scope.delete_book = function(prodID, name){
    var confirm_deletion = confirm("Deleting "+name+". Are you sure?");

    if(confirm_deletion){

      $http({method: 'DELETE', url: 'book/'+prodID }).
      success(function(data) {

      }).
      error(function(data) {
      });



      var index = getById($scope.books, prodID);
      console.log(index);
      $scope.books.remove(index);

      $scope.message = name + ' is deleted.';

    }



  }

  $scope.next = function(){
    if($scope.currentPage !== $scope.total && $scope.total !== 0) $scope.currentPage += 1;
    searchService.getBooks($scope.search,$scope.currentPage).success(function(data){
      $scope.books = data.data;
      $scope.total = data.last_page;
      brandService.getBrands().success(function(data){
        var brand_list = {};

        for (var i = 0; i<data.length; i++) {
          var obj =data[i];
          brand_list[obj.id] = obj.name;
        }

        for (var i = $scope.books.length - 1; i >= 0; i--) {
          $scope.books[i].brand = brand_list[$scope.books[i].brand_id];
        };

      });

      categoryService.getCategories().success(function(data){
        var category_list = {};

        for (var i = 0; i<data.length; i++) {
          var obj =data[i];
          category_list[obj.id] = obj.name;
        }

        for (var i = $scope.books.length - 1; i >= 0; i--) {
          $scope.books[i].category = category_list[$scope.books[i].category_id];
        };

      });
    });

    $scope.message = '';


  }

  $scope.prev = function(){
    if($scope.currentPage !== 1 && $scope.total !== 0) $scope.currentPage -= 1;
    searchService.getBooks($scope.search,$scope.currentPage).success(function(data){
      $scope.books = data.data;
      $scope.total = data.last_page;
      brandService.getBrands().success(function(data){
        var brand_list = {};

        for (var i = 0; i<data.length; i++) {
          var obj =data[i];
          brand_list[obj.id] = obj.name;
        }

        for (var i = $scope.books.length - 1; i >= 0; i--) {
          $scope.books[i].brand = brand_list[$scope.books[i].brand_id];
        };

      });

      categoryService.getCategories().success(function(data){
        var category_list = {};

        for (var i = 0; i<data.length; i++) {
          var obj =data[i];
          category_list[obj.id] = obj.name;
        }

        for (var i = $scope.books.length - 1; i >= 0; i--) {
          $scope.books[i].category = category_list[$scope.books[i].category_id];
        };

      });
    });
    $scope.message = '';
  }



  $scope.$watch('search',function(){

    console.log($scope.search);
    $scope.message = '';

    searchService.getBooks($scope.search,1).success(function(data){
      $scope.books = data.data;
      $scope.currentPage = 1;
      $scope.total = data.last_page;
      brandService.getBrands().success(function(data){
        var brand_list = {};

        for (var i = 0; i<data.length; i++) {
          var obj =data[i];
          brand_list[obj.id] = obj.name;
        }

        for (var i = $scope.books.length - 1; i >= 0; i--) {
          $scope.books[i].brand = brand_list[$scope.books[i].brand_id];
        };

      });

      categoryService.getCategories().success(function(data){
        var category_list = {};

        for (var i = 0; i<data.length; i++) {
          var obj =data[i];
          category_list[obj.id] = obj.name;
        }

        for (var i = $scope.books.length - 1; i >= 0; i--) {
          $scope.books[i].category = category_list[$scope.books[i].category_id];
        };

      });
    });

  });

  $scope.toggle = function(book, index){

     $scope.books[index].availability = !$scope.books[index].availability;

    $http.get('book/toggle/'+book).success(function(data){
     $scope.books[index].availability = data.availability;
      console.log( $scope.books[index].availability);
    }).error(function(){
      console.log('fail');
    });

    $scope.message = '';


  }



}


app.controller(controllers);
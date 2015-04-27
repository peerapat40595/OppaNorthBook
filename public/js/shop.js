var app = angular.module('shop', []);
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
    getBooks: function(search,page,cat) {
      return $http.get('bookrest/data?search='+search+'&page='+page+'&category_id='+cat);

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
app.service('subcategoryService',function($http){

  return {
    getCategories: function() {
      return $http.get('bookrest/subcategory');

    }

  };
});


app.service('attService',function($http){

  return {
    getAtt: function(book_id) {
      return $http.get('shop/attributejson?book_id='+book_id);

    }

  };
});




Array.prototype.remove = function(from, to) {
  var rest = this.slice((to || from) + 1 || this.length);
  this.length = from < 0 ? this.length + from : from;
  return this.push.apply(this, rest);
};


controllers.BookCtrl = function($scope, $http, bookService, attService, categoryService, searchService){

  // $scope.search = '';

  categoryService.getCategories().success(function(data){
    $scope.categories = data;
    $scope.isAll = true
    for (var i =  $scope.categories.length - 1; i >= 0; i--) {
     if($scope.categories[i].id == $scope.cat_id) {
      $scope.categories[i].isCat = true;
      $scope.isAll = false;
    }
  };
});

  function getById(arr, id) {
    for (var d = 0, len = arr.length; d < len; d += 1) {
      if (arr[d].id === id) {
        return d;
      }
    }
  }





  $scope.next = function(){
    if($scope.currentPage !== $scope.total && $scope.total !== 0) $scope.currentPage += 1;
    searchService.getBooks($scope.search,$scope.currentPage,$scope.cat_id).success(function(data){
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
    searchService.getBooks($scope.search,$scope.currentPage,$scope.cat_id).success(function(data){
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


    $scope.message = '';

    searchService.getBooks($scope.search,1,$scope.cat_id).success(function(data){
      $scope.books = data.data;
      console.log($scope.search+$scope.currentPage+$scope.cat_id);
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


$scope.retrieve_attribute = function(book_id){
  attService.getAtt(book_id).success(function(data){
    $scope.atts = data;
    $scope.attribute = {};
  });

  $scope.order_list = {};
  $scope.order_list.attribute = {};
  $scope.order_list['amount'] = 1;

}

$scope.submit = function(book_id,book_title,user_id){
  
  $scope.order_list['book_id'] =book_id;
  $scope.order_list['user_id'] = user_id;
  console.log( $scope.order_list['amount'] % 1 != 0);
  var validated = true;
  if(typeof $scope.order_list['amount'] !== 'number' ||  $scope.order_list['amount'] % 1 != 0 || $scope.order_list['amount']<=0) validated =false;
  for(var key in $scope.order_list.attribute){
    validated = validated && $scope.order_list.attribute[key];
    if(typeof $scope.order_list.attribute[key] == null) {
      validated =false;
      break;
    }
  }

  if(validated){
    $http.post('shop', {'order_list':  JSON.stringify($scope.order_list)})
    .success(function(data) {
     console.log(data);

     var att = '';
     for(var key in $scope.order_list.attribute){
      att = att+' '+ key+' '+$scope.order_list.attribute[key];

    }

    alert('เพิ่ม '+book_title+att+' จำนวน '+$scope.order_list['amount']+' ชิ้นลงใน \'Cart\'');
  });
  }else{
    alert('ข้อมูลผิดพลาด ตรวจสอบด้วยค่ะ');
  }

}


}




app.controller(controllers);
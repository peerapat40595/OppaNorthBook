var app = angular.module('order_manager', []);
var controllers = {};

app.service('orderService',function($http){

  return {
    getorders: function() {
      return $http.get('orderrest/data');

    }

  };
});

app.service('searchService',function($http){

  return {
    getorders: function(search,page) {
      return $http.get('orderrest/data?search='+search+'&page='+page);

    }

  };
});

app.service('Order_listService',function($http){

  return {
    getBrands: function() {
      return $http.get('orderrest/order_list');

    }

  };
});





Array.prototype.remove = function(from, to) {
  var rest = this.slice((to || from) + 1 || this.length);
  this.length = from < 0 ? this.length + from : from;
  return this.push.apply(this, rest);
};


controllers.orderCtrl = function($scope, $http, orderService , order_listService, searchService){
	
$scope.search = '';

  function getById(arr, id) {
    for (var d = 0, len = arr.length; d < len; d += 1) {
      if (arr[d].id === id) {
        return d;
      }
    }
  }

  $scope.delete_order = function(orderID, name){
    var confirm_deletion = confirm("Deleting "+name+". Are you sure?");

    if(confirm_deletion){

      $http({method: 'DELETE', url: 'order/'+orderID }).
      success(function(data) {

      }).
      error(function(data) {
      });



      var index = getById($scope.orders, orderID);
      console.log(index);
      $scope.orders.remove(index);

      $scope.message = name + ' is deleted.';

    }



  }

  $scope.next = function(){
    if($scope.currentPage !== $scope.total && $scope.total !== 0) $scope.currentPage += 1;
    searchService.getorders($scope.search,$scope.currentPage).success(function(data){
      $scope.orders = data.data;
      $scope.total = data.last_page;
      });
    $scope.message = '';
  }

  $scope.prev = function(){
    if($scope.currentPage !== 1 && $scope.total !== 0) $scope.currentPage -= 1;
    searchService.getorders($scope.search,$scope.currentPage).success(function(data){
      $scope.orders = data.data;
      $scope.total = data.last_page;
      });
    $scope.message = '';
  }



  $scope.$watch('search',function(){

    console.log($scope.search);
    $scope.message = '';

    searchService.getorders($scope.search,1).success(function(data){
      $scope.orders = data.data;
      $scope.currentPage = 1;
      $scope.total = data.last_page;
    });

});
}


app.controller(controllers);
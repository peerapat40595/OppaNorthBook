var app = angular.module('user_manager', []);
var controllers = {};

app.service('userService',function($http){

  return {
    getusers: function() {
      return $http.get('userrest/data');

    }

  };
});

app.service('searchService',function($http){

  return {
    getusers: function(search,page) {
      return $http.get('userrest/data?search='+search+'&page='+page);

    }

  };
});







Array.prototype.remove = function(from, to) {
  var rest = this.slice((to || from) + 1 || this.length);
  this.length = from < 0 ? this.length + from : from;
  return this.push.apply(this, rest);
};


controllers.UserCtrl = function($scope, $http, userService , searchService){
	
console.log('test');
$scope.search = '';

  function getById(arr, id) {
    for (var d = 0, len = arr.length; d < len; d += 1) {
      if (arr[d].id === id) {
        return d;
      }
    }
  }

  $scope.delete_user = function(userID, name){
    var confirm_deletion = confirm("Deleting "+name+". Are you sure?");

    if(confirm_deletion){

      $http({method: 'DELETE', url: 'manage_user/'+userID }).
      success(function(data) {

      }).
      error(function(data) {
      });



      var index = getById($scope.users, userID);
      console.log(index);
      $scope.users.remove(index);

      $scope.message = name + ' is deleted.';

    }



  }

  $scope.next = function(){
    if($scope.currentPage !== $scope.total && $scope.total !== 0) $scope.currentPage += 1;
    searchService.getusers($scope.search,$scope.currentPage).success(function(data){
      $scope.users = data.data;
      $scope.total = data.last_page;
      });
    $scope.message = '';
  }

  $scope.prev = function(){
    if($scope.currentPage !== 1 && $scope.total !== 0) $scope.currentPage -= 1;
    searchService.getusers($scope.search,$scope.currentPage).success(function(data){
      $scope.users = data.data;
      $scope.total = data.last_page;
      });
    $scope.message = '';
  }



  $scope.$watch('search',function(){

    console.log($scope.search);
    $scope.message = '';

    searchService.getusers($scope.search,1).success(function(data){
      $scope.users = data.data;
      $scope.currentPage = 1;
      $scope.total = data.last_page;
      });

    });

  $scope.toggleissp = function(user, index){
  console.log('sp');
     $http.get('user/toggleissp/'+user).success(function(data){
       $scope.users[index].issp = !($scope.users[index].issp);
       console.log( $scope.users[index].issp);
    });

    $scope.message = '';


  }
  $scope.toggleisadmin = function(user, index){
  console.log('admin');
    $http.get('user/toggleisadmin/'+user).success(function(data){
      $scope.users[index].isadmin = !($scope.users[index].isadmin);
      console.log( $scope.users[index].isadmin);
    });

    $scope.message = '';


  }
   $scope.toggleconfirmed = function(user, index){
   console.log('con');
     $http.get('user/toggleconfirmed/'+user).success(function(data){
       $scope.users[index].confirmed = !($scope.users[index].confirmed);
       console.log( $scope.users[index].confirmed);
     });

    $scope.message = '';


  }
   $scope.togglebanned = function(user, index){
   
   console.log('ban');
     $http.get('user/togglebanned/'+user).success(function(data){
       $scope.users[index].banned = !($scope.users[index].banned);
       console.log( $scope.users[index].banned);
     });

    $scope.message = '';


  }
}

app.controller(controllers);
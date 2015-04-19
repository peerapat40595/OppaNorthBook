var app = angular.module('category_manager', []);
var controllers = {};

Array.prototype.remove = function(from, to) {
	var rest = this.slice((to || from) + 1 || this.length);
	this.length = from < 0 ? this.length + from : from;
	return this.push.apply(this, rest);
};

app.service('categoryService',function($http){

	return {
		getCategories: function() {
			return $http.get('productrest/category');
		}
	};
});


controllers.CategoryCtrl = function($scope, $http, categoryService){

	function getById(arr, id) {
		for (var d = 0, len = arr.length; d < len; d += 1) {
			if (arr[d].id === id) {
				return d;
			}
		}
	}

	categoryService.getCategories().success(function(data){
		$scope.categories = data;
	});

	$scope.editname = {};

	$scope.open_editor = function(id,name){
		var index = getById($scope.categories, id);
		$scope.temp = name;
		console.log($scope.categories[index].name);
		$scope.editname[id] = $scope.categories[index].name;
	}


	$scope.add = function(){
		if($scope.new_category.trim() !=='') {
			$scope.categories.push({name:$scope.new_category});

			$http.post('category', {'name':$scope.new_category})
			.success(function(data) {
				console.log(data)
			});

			$scope.new_category='';
		}
	}

	$scope.edit = function(id){

		var index = getById($scope.categories, id);

		if($scope.editname[id].trim()!=='') {

			console.log($scope.categories[index].name);

			$scope.categories[index].name = $scope.editname[id];
			var new_name = $scope.editname[id];

			$http.put('category/'+id,{'name':new_name}).success(function(data){
				console.log(data);
			}).error(function(){
				console.log('shit, my bad.')
			});

			
		}else{
			$scope.categories[index].name = $scope.temp;
		}

	}

	$scope.delete = function(id, name){
		if(confirm('Deleting '+name+'.\n\n****Caution****\n\nThis will delete all the product in '+name+'. Proceed?'))
		{
			var index = getById($scope.categories, id);
			$scope.categories.remove(index);
			//ajax destroy

			$http.delete('category/'+id).success(function(data){
				console.log(data);
			});

			alert(name+ ' is deleted.');
		}
	}
}

app.controller(controllers);
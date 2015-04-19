var app = angular.module('brand_manager', []);
var controllers = {};

Array.prototype.remove = function(from, to) {
	var rest = this.slice((to || from) + 1 || this.length);
	this.length = from < 0 ? this.length + from : from;
	return this.push.apply(this, rest);
};

app.service('brandService',function($http){

	return {
		getBrands: function() {
			return $http.get('productrest/brand');
		}
	};
});


controllers.BrandCtrl = function($scope, $http, brandService){

	function getById(arr, id) {
		for (var d = 0, len = arr.length; d < len; d += 1) {
			if (arr[d].id === id) {
				return d;
			}
		}
	}

	brandService.getBrands().success(function(data){
		$scope.brands = data;
	});

	$scope.editname = {};

	$scope.open_editor = function(id,name){
		var index = getById($scope.brands, id);
		$scope.temp = name;
		console.log($scope.brands[index].name);
		$scope.editname[id] = $scope.brands[index].name;
	}


	$scope.add = function(){
		if($scope.new_brand.trim() !=='') {
			$scope.brands.push({name:$scope.new_brand});

			$http.post('brand', {'name':$scope.new_brand})
			.success(function(data) {
				console.log(data)
			});

			$scope.new_brand='';
		}
	}

	$scope.edit = function(id){

		var index = getById($scope.brands, id);

		if($scope.editname[id].trim()!=='') {

			console.log($scope.brands[index].name);

			$scope.brands[index].name = $scope.editname[id];
			var new_name = $scope.editname[id];

			$http.put('brand/'+id,{'name':new_name}).success(function(data){
				console.log(data);
			}).error(function(){
				console.log('shit, my bad.')
			});


		}else{
			$scope.brands[index].name = $scope.temp;
		}

	}

	$scope.delete = function(id, name){
		if(confirm('Deleting '+name+'.\n\n****Caution****\n\nThis will delete all the product in '+name+'. Proceed?'))
		{
			var index = getById($scope.brands, id);
			$scope.brands.remove(index);
			//ajax destroy

			$http.delete('brand/'+id).success(function(data){
				console.log(data);
			});

			alert(name+ ' is deleted.');
		}
	}
}

app.controller(controllers);
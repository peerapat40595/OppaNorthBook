var app = angular.module('tag_manager', []);
var controllers = {};

Array.prototype.remove = function(from, to) {
	var rest = this.slice((to || from) + 1 || this.length);
	this.length = from < 0 ? this.length + from : from;
	return this.push.apply(this, rest);
};

app.service('tagService',function($http){

	return {
		getCategories: function() {
			return $http.get('bookrest/tag');
		}
	};
});


controllers.CategoryCtrl = function($scope, $http, tagService){

	function getById(arr, id) {
		for (var d = 0, len = arr.length; d < len; d += 1) {
			if (arr[d].id === id) {
				return d;
			}
		}
	}

	tagService.getCategories().success(function(data){
		$scope.tags = data;
	});

	$scope.editname = {};

	$scope.open_editor = function(id,name){
		var index = getById($scope.tags, id);
		$scope.temp = name;
		console.log($scope.tags[index].name);
		$scope.editname[id] = $scope.tags[index].name;
	}


	$scope.add = function(){
		if($scope.new_tag.trim() !=='') {
			$scope.tags.push({name:$scope.new_tag});

			$http.post('tag', {'name':$scope.new_tag})
			.success(function(data) {
				console.log(data)
			});

			$scope.new_tag='';
		}
	}

	$scope.edit = function(id){

		var index = getById($scope.tags, id);

		if($scope.editname[id].trim()!=='') {

			console.log($scope.tags[index].name);

			$scope.tags[index].name = $scope.editname[id];
			var new_name = $scope.editname[id];

			$http.put('tag/'+id,{'name':new_name}).success(function(data){
				console.log(data);
			}).error(function(){
				console.log('shit, my bad.')
			});

			
		}else{
			$scope.tags[index].name = $scope.temp;
		}

	}

	$scope.delete = function(id, name){
		if(confirm('Deleting '+name+'.\n\n****Caution****\n\nThis will delete all the book in '+name+'. Proceed?'))
		{
			var index = getById($scope.tags, id);
			$scope.tags.remove(index);
			//ajax destroy

			$http.delete('tag/'+id).success(function(data){
				console.log(data);
			});

			alert(name+ ' is deleted.');
		}
	}
}

app.controller(controllers);
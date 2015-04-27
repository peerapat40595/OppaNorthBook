var app = angular.module('author_manager', []);
var controllers = {};

Array.prototype.remove = function(from, to) {
	var rest = this.slice((to || from) + 1 || this.length);
	this.length = from < 0 ? this.length + from : from;
	return this.push.apply(this, rest);
};

app.service('authorService',function($http){

	return {
		getauthors: function() {
			return $http.get('bookrest/author');
		}
	};
});


controllers.authorCtrl = function($scope, $http, authorService){

	function getById(arr, id) {
		for (var d = 0, len = arr.length; d < len; d += 1) {
			if (arr[d].id === id) {
				return d;
			}
		}
	}

	authorService.getauthors().success(function(data){
		$scope.authors = data;
	});

	$scope.editname = {};

	$scope.open_editor = function(id,name){
		var index = getById($scope.authors, id);
		$scope.temp = name;
		console.log($scope.authors[index].name);
		$scope.editname[id] = $scope.authors[index].name;
	}


	$scope.add = function(){
		if($scope.new_author.trim() !=='') {
			$scope.authors.push({name:$scope.new_author});

			$http.post('author', {'name':$scope.new_author})
			.success(function(data) {
				console.log(data)
			});

			$scope.new_author='';
		}
	}

	$scope.edit = function(id){

		var index = getById($scope.authors, id);

		if($scope.editname[id].trim()!=='') {

			console.log($scope.authors[index].name);

			$scope.authors[index].name = $scope.editname[id];
			var new_name = $scope.editname[id];

			$http.put('author/'+id,{'name':new_name}).success(function(data){
				console.log(data);
			}).error(function(){
				console.log('shit, my bad.')
			});


		}else{
			$scope.authors[index].name = $scope.temp;
		}

	}

	$scope.delete = function(id, name){
		if(confirm('Deleting '+name+'.\n\n****Caution****\n\nThis will delete all the product in '+name+'. Proceed?'))
		{
			var index = getById($scope.authors, id);
			$scope.authors.remove(index);
			//ajax destroy

			$http.delete('author/'+id).success(function(data){
				console.log(data);
			});

			alert(name+ ' is deleted.');
		}
	}
}

app.controller(controllers);
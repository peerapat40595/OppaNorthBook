var app = angular.module('attribute', []);
var controllers = {};

Array.prototype.remove = function(from, to) {
	var rest = this.slice((to || from) + 1 || this.length);
	this.length = from < 0 ? this.length + from : from;
	return this.push.apply(this, rest);
};

app.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                scope.$apply(function (){
                    scope.$eval(attrs.ngEnter);
                });

                event.preventDefault();
            }
        });
    };
});

controllers.AttCtrl = function($scope){

	function getById(arr, id) {
		for (var d = 0, len = arr.length; d < len; d += 1) {
			if (arr[d].id === id) {
				return d;
			}
		}
	}

	function getByName(arr, name) {
		for (var d = 0, len = arr.length; d < len; d += 1) {
			if (arr[d].name === name) {
				return d;
			}
		}
	}

	function getByVal(arr, val) {
		for (var d = 0, len = arr.length; d < len; d += 1) {
			if (arr[d] === val) {
				return d;
			}
		}
	}


	$scope.types = [];

	// $scope.types = [{'name':'test','data':['asdff','asdasd','asasd']},{'name':'test2','data':['assaeff','abbbasd','asdfasd']}];
	// $scope.atts = {};



	$scope.add_type = function(){

		var type = prompt('Enter new type.');
		var has;
		for (var d = 0, len = $scope.types.length; d < len; d += 1) {
			if ($scope.types[d].name === type) {
				has = d;
			}
		}

		if(type.trim()!=='' &&  has===undefined)
		$scope.types.push({'name':type,'data':[]});
	}

	$scope.add_att = function(type_name,name){
		console.log(type_name+'  '+name)
		var index = getByName($scope.types,type_name);
		var att = getByVal($scope.types[index].data, name);
		if(att===undefined && name.trim()!=='') {
			$scope.types[index].data.push(name);
		}
			

	}

	$scope.delete = function(type_name,att_name){
		var t_index = getByName($scope.types,type_name);
		var att_index = getByVal($scope.types[t_index].data, att_name);
		// console.log(att_index);
		// console.log($scope.types[t_index].data);
		// console.log(att_name);
		$scope.types[t_index].data.remove(att_index);
	}
	
	$scope.delete_type = function(index){
		$scope.types.remove(index);
	}
}

app.controller(controllers);
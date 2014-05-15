// public/js/services/goalService.js
angular.module('goalService', [])

	.factory('Goal', function($http) {

		return {
			// get all the goals
			get : function() {
				return $http.get('api/goals');
			},

			save: function(goalData) {
				return $http.post('api/goals', goalData);
			},
			
			//update a goal
			update : function(id, goalData) {
				return $http.put('api/goals/' + id, goalData);
			},

			// destroy a goal
			destroy : function(id) {
				return $http.delete('api/goals/' + id);
			}
		}

	});
	
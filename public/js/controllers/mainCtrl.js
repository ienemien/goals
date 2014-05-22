// public/js/controllers/mainCtrl.js
angular.module('mainCtrl', [])

	// inject the Goal service into our controller
	.controller('mainController', function($scope, $http, Goal) {
		// object to hold all the data for the new Goal form
		$scope.goalData = {};
		$scope.newData = {};
		
		// loading variable to show the spinning loading icon
		$scope.loading = true;

		// get all the goals first and bind it to the $scope.goals object
		// use the function we created in our service
		// GET ALL GOALS ====================================================
		Goal.get()
			.success(function(data) {
				$scope.goals = data;
				$scope.loading = false;
			})
			
			.error(function(data) {
				console.log(data);
			});



		// function to handle submitting the form
		// SAVE A GOAL ======================================================
		$scope.submitGoal = function() {
			$scope.loading = true;

			// save the goal. pass in goal data from the form
			// use the function we created in our service
			Goal.save($scope.goalData)
				.success(function(data) {

					// if successful, we'll need to refresh the Goal list
					Goal.get()
						.success(function(getData) {
							$scope.goals = getData;
							$scope.loading = false;
						});

				})
				.error(function(data) {
					console.log(data);
				});
		};
		
		//UPDATE TITLE
		$scope.setTitle = function(id, newTitle) {
				$scope.loading = true;
				$scope.newData.title = newTitle;

			// save the goal. pass in goal data from the form
			// use the function we created in our service
			Goal.update(id, $scope.newData)
				.success(function(data) {

					// if successful, we'll need to refresh the Goal list
					Goal.get()
						.success(function(getData) {
							$scope.goals = getData;
							$scope.loading = false;
						});

				})
				.error(function(data) {
					console.log(data);
				});
		};
		
		// function to set a goal as 'done'
		// SET DONE ======================================================
		$scope.setDone = function(id, done) {
				$scope.loading = true;
				
				//function to change 'done' status
				function toggleDone(done) {
					if(done == 0) {
						nowdone = true;
					} else {
						nowdone = false;
					}
					return nowdone;
					};
				
				toggleDone(done);
				$scope.newData.done = nowdone;

			// save the goal. pass in goal data from the form
			// use the function we created in our service
			Goal.update(id, $scope.newData)
				.success(function(data) {

					// if successful, we'll need to refresh the Goal list
					Goal.get()
						.success(function(getData) {
							$scope.goals = getData;
							$scope.loading = false;
						});

				})
				.error(function(data) {
					console.log(data);
				});
		};

		// function to handle deleting a Goal
		// DELETE A Goal ====================================================
		$scope.deleteGoal = function(id) {
			$scope.loading = true; 

			// use the function we created in our service
			Goal.destroy(id)
				.success(function(data) {

					// if successful, we'll need to refresh the Goal list
					Goal.get()
						.success(function(getData) {
							$scope.goals = getData;
							$scope.loading = false;
						});

				});
		};

	}) //end of controller
	
	.directive("editInline", function() {
		return {
			restrict: "E",
			scope: true,
			template: '<span ng-click="edit()">{{ goal.title }}</span>' + 
			'<input name="newTitle" ng-model="goal.newTitle" value="{{goal.title}}" ng-blur="setTitle(goal.id, goal.newTitle)"></input>',
			link: function ( scope, element, attrs ) {
				
		      // Let's get a reference to the input element, as we'll want to reference it.
		      var inputElement = angular.element( element.children()[1] );
		      
		      // This directive should have a set class so we can style it.
		      element.addClass( 'edit-inline' );
		      
		      // Not editing
		      scope.editing = false;
		      
		      // ng-click handler to activate edit-inline
		      scope.edit = function () {
		        scope.editing = true;
		        
		        // Control display through a class on the directive itself
		        element.addClass( 'active' );
		        
		        // And we must focus the element. 
		        inputElement[0].focus();
		      };
    		}
		};
	});
	

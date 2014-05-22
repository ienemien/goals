<!-- app/views/index.php -->
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel and Angular Goal App</title>

	<!-- CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css"> <!-- load bootstrap via cdn -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"> <!-- load fontawesome -->
	<link rel="stylesheet" href="css/style.css"> 

	<!-- JS -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script> <!-- load angular -->

	<!-- ANGULAR -->
	<!-- all angular resources will be loaded from the /public folder -->
		<script src="js/controllers/mainCtrl.js"></script> <!-- load our controller -->
		<script src="js/services/goalService.js"></script> <!-- load our service -->
		<!-- <script src="js/directives/goalDirectives.js"></script> -->
		<script src="js/app.js"></script> <!-- load our application -->

</head>
<!-- declare our angular app and controller -->
<body class="container" ng-app="goalApp" ng-controller="mainController">
<div class="col-md-8 col-md-offset-2">

	<!-- PAGE TITLE =============================================== -->
	<div class="page-header">
		<h2>Laravel and Angular Single Page Application</h2>
		<h4>Goal App</h4>
	</div>

	<!-- NEW GOAL FORM =============================================== -->
	<form ng-submit="submitGoal()"> <!-- ng-submit will disable the default form action and use our function -->

		<!-- Goal Title -->
		<div class="form-group">
			<input type="text" class="form-control input-sm" name="title" ng-model="goalData.title" placeholder="Title">
		</div>

		<!-- Goal done? -->
		<div class="checkbox">
			<label>
				<input type="checkbox" name="done" ng-model="goalData.done" value="false"> Done
			</label>
		</div>
		
		<!-- SUBMIT BUTTON -->
		<div class="form-group text-right">
			<button type="submit" class="btn btn-primary btn-lg">Create</button>
		</div>
	</form>

	<!-- LOADING ICON =============================================== -->
	<!-- show loading icon if the loading variable is set to true -->
	<p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>

	<!-- THE GOALS =============================================== -->
	<!-- hide these goals if the loading variable is true -->
	<label>Search for: <input type="text" class="form-control input-sm" ng-model="criteria"></label>
	<table class="table table-striped">
		<thead>
			<th>#</th>
			<th>Goal</th>
			<th>Done?</th>
			<th>Delete</th>
		</thead>
		<tbody class="goal" ng-hide="loading" ng-repeat="goal in goals | filter:criteria">
			<td>{{ goal.id }}</td>
				<td> <edit-inline title="{{ goal.title }}" id="{{ goal.id }}"></edit-inline></td>
				<td><input type="checkbox" name="done" ng-checked="{{ goal.done }}" ng-click="setDone(goal.id, goal.done)"></td>
			<td><button class="btn btn-primary" href="#" ng-click="deleteGoal(goal.id)" class="text-muted">Delete</a></td>
		</tbody>
	</table>

</div>
</body>
</html>
	
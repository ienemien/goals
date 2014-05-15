<?php

// app/database/seeds/GoalTableSeeder.php

class GoalTableSeeder extends Seeder {
	
	public function run() {
		DB::table('goals')->delete();
		
		Goal::create(array(
			'title' => 'Learn Laravel basics',
			'done' => TRUE
		));
		
		Goal::create(array(
			'title' => 'Learn Angular basics',
			'done' => TRUE
		));
		
		Goal::create(array(
			'title' => 'Create a goal-app with Laravel and Angular',
			'done' => FALSE
		));
	}
}

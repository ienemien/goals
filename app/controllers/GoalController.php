	
<?php
// app/controllers/GoalController.php

class GoalController extends \BaseController {

	/**
	 * Send back all comments as JSON
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(Goal::get());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//If done is net set, set to false
		if(Input::has('done')) {
			$done = Input::get('done');
		} else {
			$done = false;
		}
		
		//only create new goal if validator passes

    	Goal::create(array(
		'title' => Input::get('title'),
		'done' => $done
		));
		
		//return success message to angular
		return Response::json(array('success' => true));

	} //end of store function
	
	/**
	 * Update goal in storage
	 *
	 * @param int $id
	 * @return Response
	 */
	 public function update($id)
	{
		$goal = Goal::findOrFail($id);
		
		//only set title if title is present
		if(Input::has('title')){
			$goal->title = Input::get('title');
		}
		
		//only set done if input is present
		if(Input::has('done')) {
		$goal->done = Input::get('done');
		}
		
		$goal->save();

		return Response::json(array('success' => true));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$goal = Goal::findOrFail($id);
		$goal->delete();

		return Response::json(array('success' => true));
	}

}
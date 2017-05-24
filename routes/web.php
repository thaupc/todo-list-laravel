<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\Task;
use Illuminate\Http\Request;

// Show task dashboard
Route::get('/', function(){
	$tasks = Task::orderBy('created_at','desc')->get();

	return view('tasks', [
			'tasks' => $tasks
		]

		);
});

// Add new task
Route::post('/task', function(Request $request){
	//Validate information
	$validator = Validator::make($request->all(),[
		'name' => 'required|max:255',
		]);

	if($validator->fails()){
		return redirect('/')
			->withInput()
			->withErrors($validator);
	}

	//Process to add new task
	$task = new Task;
	$task->name = $request->name;
	$task->save();

	return redirect('/');


});

// Delete task
Route::delete('/task/{task}', function($id){
	Task::findOrFail($id)->delete();
	return redirect('/');

});
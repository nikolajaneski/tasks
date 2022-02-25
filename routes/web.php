<?php

use App\Http\Controllers\TaskController;
use App\Models\Task;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// class Test {
//     public $name = "test";
// }

// $test = new Test;
// echo $test->name;


Route::get('/', function () {
    // $tasks = Task::all();

    foreach(Task::all() as $task) {
        echo $task->user_id . "<br />";
    }

    dd("asda");

    return view('welcome');
});



// Show all tasks
Route::get('/task', [TaskController::class, 'index']);

// Show single
Route::get('/task/{task}', [TaskController::class, 'show'])->where('task', '[0-9]+');

// Show form for creating tasks
Route::get('/task/create', [TaskController::class, 'create']);

// Store task into DB
Route::post('/task', [TaskController::class, 'store']);

// Show form for editing taks
Route::get('/task/{task}/edit', [TaskController::class, 'edit']);

// Update tasks into DB
Route::put('/task/{task}', [TaskController::class, 'update']);

// Delete task
Route::delete('/task/{task}', [TaskController::class, 'destroy']);


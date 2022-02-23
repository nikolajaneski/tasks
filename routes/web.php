<?php

use App\Http\Controllers\TaskController;
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

Route::get('/', function () {
    $tasks = DB::table('tasks') // SELECT * FROM tasks
                ->where('id', '>', '2') //  where id > 2 
                ->orWhere(function($query) { //  OR 
                    $query->where('name', 'like', 'Test @%') // name like 'Test @%'
                            ->where('completed', '=', 1); // AND completed = 1
                })->dd(); 

                // $sql = "select * from tasks where id > 2 OR ( name like 'Test @%' AND completed = 1)";
    


    // $tasks = DB::table('users')
    //             ->where('name', 'Willard Mitchell')
    //             ->orWhereBetween('id', [3, 8])
    //             ->orderBy('name', 'desc')
    //             ->get();

    // $task = DB::table('tasks')->latest()->get();
        
    // dd($task);

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


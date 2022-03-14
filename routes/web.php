<?php
use App\Http\Controllers\TaskController;
use App\Models\Item;
use App\Models\Tag;
use App\Models\Task;
use App\Models\TaskDetail;
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


    // $task = Task::find(2);

    // $tasks = Task::with('items')->get();

    // foreach($tasks as $task) {
    //    $items = $task->items;
    // }


    // $taskDetail = TaskDetail::find(1);

    // dd($taskDetail->task);

    // $task = Task::find(2);

    // dd($task->items);

    // foreach(Task::find(2)->items()->where('id', 2)->get() as $item) {
    //     echo $item->description . '<Br />';
    // }

    // $item = Item::find(2);

    // dd($item->task);
    
    // $tag = Tag::find(2);

    // foreach($tag->tasks as $task) {
    //     dd($task->pivot->task_id);
    // }

    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/task', [TaskController::class, 'index']);
    Route::get('/task/{task}', [TaskController::class, 'show'])->where('task', '[0-9]+');
    Route::get('/task/create', [TaskController::class, 'create']);
    Route::get('/task/{task}/edit', [TaskController::class, 'edit']);
});


Route::middleware(['token'])->group(function() {

    Route::put('/task/{task}', [TaskController::class, 'update']);
    Route::post('/task', [TaskController::class, 'store']);
    Route::delete('/task/{task}', [TaskController::class, 'destroy']);

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

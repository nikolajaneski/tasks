<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tasks = DB::select('select id, name, description, completed from tasks');

        // Query Builder
        // $tasks = DB::table('tasks')->get();

        // Eloquent
        $tasks = Task::where('user_id', Auth::id())->get();

        // $tasks = $tasks->reject(function($taks) {
        //     return $task->completed;
        // });
// 
        return view('task.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $task = DB::insert('insert into tasks (user_id, name, description) values (:user_id, :name, :description)', 
                    // [':user_id' => 3, ':name' => $request->name, 'description' => $request->description]);

        // DB::table('tasks')->insert([
        //     'user_id' => 3,
        //     'name' => $request->name, 
        //     'description' => $request->description
        // ]);

        // Eloquent 

        // $task = new Task;
        // $task->user_id = 2;
        // $task->name = $request->name;
        // $task->description = $request->description;

        // $task->save();

        // $params = [];
        // foreach($request->all() as $key => $attr) {
        //     if($key != 'submit') 
        //         $params[$key] = $attr;
        // }
        // $task = Task::create($params);

        // dd($params);

        $task = Task::create([
            'user_id' => Auth::id(),
            'name' => $request->name, 
            'description' => $request->description,
   
        ]);

        return redirect('/task');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $task = DB::select('select name, description, completed from tasks where id = :id', ['id' => $id]);

        // Query Builder
        // $task = DB::table('tasks')
        //             ->where('id', $id)
        //             ->first();

        // Eloquent
        $task = Task::find($id);
        // $task = Task::firstWhere('id', $id);

        // $task = Task::where('id', $id)->firstOr(function() {
        //     $task = new stdClass();
        //     $task->name = 'none';
        //     $task->description = 'placeholder';
        //     $task->completed = 0;

        //     return $task;
        // });
            
        // $task = Task::findOrFail($id);

        // $task = Task::firstOrCreate(
        //     ['id' => $id],
        //     ['user_id' => 2, 'name' => 'Test tetetee', 'description' => 'descsca', 'completed' => 0]
        // );

        // dd($task);
        if(Auth::id() !== $task->user_id) 
            return redirect('/task');

        return view('task.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $task = DB::select('select id, name, description, completed from tasks where id = :id', ['id' => $id]);

        $task = Task::find($id);

        return view('task.edit', ['task' => $task[0]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // DB::update('update tasks set name = :name, description = :description where id = :id', 
        //             [':name' => $request->name, 'description' => $request->description, 'id' => $id]);

        // Query Builder
        // DB::table('tasks')->where('id', $id)
        //         ->update([
        //             'name' => $request->name,
        //             'description' => $request->description
        //         ]);

        
        // Eloquent
        // $task = Task::find($id);
        // $task->name = $request->name;
        // $task->description = $request->description;
        // $task->save();


        Task::find($id)->update([
            'name' => $request->name,
            'description' => $request->description
        ]);


        return redirect('/task');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // DB::delete('delete from tasks where id = :id', [':id' => $id]);
        
        // Query Builder
        // DB::table('tasks')->where('id', $id)->delete();

        // Eloquent
        // $task = Task::find($id);
        // $task->delete();

        Task::destroy($id);


        return redirect('/task');
    }
}

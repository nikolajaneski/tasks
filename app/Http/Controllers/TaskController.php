<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $tasks = DB::table('tasks')->get();
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

        DB::table('tasks')->insert([
            'user_id' => 3,
            'name' => $request->name, 
            'description' => $request->description
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
        $task = DB::select('select name, description, completed from tasks where id = :id', ['id' => $id]);

        return view('task.show', ['task' => $task[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = DB::select('select id, name, description, completed from tasks where id = :id', ['id' => $id]);

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
        
        DB::table('tasks')->where('id', $id)
                ->update([
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
        
        DB::table('tasks')->where('id', $id)->delete();

        return redirect('/task');
    }
}

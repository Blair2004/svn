<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SubmitTaskRequest;
use App\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'auth' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks   =   Task::orderBy( 'updated_at', 'desc' )->paginate(10);
        return view( 'tasks.index', compact( 'tasks' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'tasks.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubmitTaskRequest $request)
    {
        $task                   =   new Task;
        $task->name             =   $request->input( 'name' );
        $task->description      =   $request->input( 'description' );
        $task->user_id          =   Auth::id();
        $task->scheduled        =   ! empty( $request->input( 'ends_at' ) );
        $task->ends_at          =   $request->input( 'ends_at' );
        // by default completed is set to false
        $task->save();
        
        return redirect()->route( 'tasks.show', [
            'id'    =>  $task->id
        ])->with([
            'message'   =>  __( 'The task has been success fully created' ),
            'status'    =>  'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view( 'tasks.show' );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view( 'tasks.edit' );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}

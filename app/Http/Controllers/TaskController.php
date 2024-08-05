<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            DB::beginTransaction();
            $tasks=(new Task())->get_task($request);
            DB::commit();
            return view("tasks.index",compact("tasks"));
        }
        catch(Throwable $throwable){
            DB::rollBack();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        try{
            DB::beginTransaction();
            (new Task())->store_task($request);
            DB::commit();
        }
        catch(Throwable $throwable){
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        try{
            DB::beginTransaction();
            (new Task())->update_task($request, $task);
            DB::commit();
        }
        catch(Throwable $throwable){
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try{
            DB::beginTransaction();
            (new Task())->delete_task($task);
            DB::commit();
        }
        catch(Throwable $throwable){
            DB::rollBack();
        }
    }
}

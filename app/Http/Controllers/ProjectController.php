<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            DB::beginTransaction();
            $projects = (new Project())->get_project($request);
            return view("project.index", compact("projects"));
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
    public function store(StoreProjectRequest $request)
    {
        try{
            DB::beginTransaction();
            (new Project())->store_project($request);
            DB::commit();
        }
        catch(Throwable $throwable){
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        try{
            DB::beginTransaction();
            (new Project())->update_project($request, $project);
            DB::commit();
        }
        catch(Throwable $throwable){
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try{
            DB::beginTransaction();
            (new Project())->destroy_project($project);
            DB::commit();
        }
        catch(Throwable $throwable){
            DB::rollBack();
        }
    }
}

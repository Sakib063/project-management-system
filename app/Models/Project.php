<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    private function prepare_data(Request $request){
        return[
            'name'=>$request->input('name'),
        ];
    }

    final public function get_project(Request $request)
    {
        $query = self::query();
        if ($request->input('name')) {
            $query->where('name', $request->input('name'));
        }
        return $query->get();
    }


    final public function store_project(Request $request)
    {
        return self::query()->create($this->prepare_data($request));
    }

    final public function update_project(Request $request, Project $project)
    {
        $project->update($this->prepare_data($request));
    }

    final public function delete_project(Project $project)
    {
        $project->delete();
    }
}

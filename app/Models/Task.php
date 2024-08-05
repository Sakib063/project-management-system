<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class Task extends Model
{
    use HasFactory;

    public const UNASSIGNED = 1;
    public const ASSIGNED = 2;
    public const DONE=3;


    public const STATUS_LIST = [
        self::UNASSIGNED   => 'Unassigned',
        self::ASSIGNED => 'Assigned',
        self::DONE => 'Done',
    ];

    protected $guarded = [];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    private function prepare_data(Request $request){
        return[
            'name'=>$request->input('name'),
            'status'=>$request->input('status'),
            'due_date'=>$request->input('due_date'),
            'project_id'=>$request->input('project_id'),
            'user_id'=>$request->input('user_id'),
        ];
    }

    final public function get_task(Request $request)
    {
        $query = self::query();
        if ($request->input('name')) {
            $query->where('name', $request->input('name'));
        }
        if ($request->input('status')) {
            $query->where('status', $request->input('status'));
        }
        return $query->get();
    }


    final public function store_task(Request $request)
    {
        return self::query()->create($this->prepare_data($request));
    }

    final public function update_task(Request $request, Task $task)
    {
        $task->update($this->prepare_data($request));
    }

    final public function delete_task(Task $task)
    {
        $task->delete();
    }
}

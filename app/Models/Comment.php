<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    private function prepare_data(Request $request){
        return[
            'comment'=>$request->input('comment'),
            'user_id'=>$request->input('user_id'),
            'task_id'=>$request->input('task_id'),
        ];
    }

    final public function get_comment(Request $request)
    {
        $query = self::query();
        if ($request->input('comment')) {
            $query->where('comment', $request->input('comment'));
        }
        return $query->get();
    }


    final public function store_comment(Request $request)
    {
        return self::query()->create($this->prepare_data($request));
    }

    final public function update_comment(Request $request, Comment $comment)
    {
        $comment->update($this->prepare_data($request));
    }

    final public function delete_comment(Comment $comment)
    {
        $comment->delete();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            DB::beginTransaction();
            $comments=(new Comment())->get_comment($request);
            return view("comment.index",compact('comments'));
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
    public function store(StoreCommentRequest $request)
    {
        try{
            DB::beginTransaction();
            (new Comment())->store_comment($request);
            DB::commit();
        }
        catch(Throwable $throwable){
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        try{
            DB::beginTransaction();
            (new Comment())->update_comment($request, $comment);
            DB::commit();
        }
        catch(Throwable $throwable){
            DB::rollBack();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        try{
            DB::beginTransaction();
            (new Comment())->delete_comment($comment);
            DB::commit();
        }
        catch(Throwable $throwable){
            DB::rollBack();
        }
    }
}

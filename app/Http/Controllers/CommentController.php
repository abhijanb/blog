<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $comments = Comment::with(['user', 'blog'])->paginate(10);
        return response()->json($comments);
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
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'blog_id' => 'required|exists:blogs,id',
            'comment_text' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $comment = Comment::create([
            'user_id' => auth()->id(),
            'blog_id' => $request->blog_id,
            'parent_id' => $request->parent_id,
            'comment_text' => $request->comment_text,
        ]);
        return response()->json($comment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
        return response()->json($comment->load(['user', 'blog', 'parent']));
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
    public function update(Request $request, Comment $comment)
    {
        //
        $validator = Validator::make($request->all(), [
            'comment_text' => 'required|string|max:1000',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $comment->update([
            'comment_text' => $request->comment_text,
        ]);
        return response()->json($comment, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
        $data = Comment::find($comment->id);
        if (!$data) {
            return response()->json(['message' => 'Comment not found'], 404);
        }
        $data->delete();
        return response()->json(['message' => 'Comment deleted successfully'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Blog;


class LikeController extends Controller
{

    public function likesCount($blogId)
    {
        // Count the number of likes for a specific blog post
        $blog = Blog::withCount('likes')->find($blogId);

    if (!$blog) {
        return response()->json(['message' => 'Blog not found'], 404);
    }

    return response()->json(['likes_count' => $blog->likes_count]);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);}
        $like = Like::create([
            'user_id' => auth()->id(),
            'blog_id' => $request->blog_id,
        ]);
        return response()->json($like, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Like $like)
    {
        //
        // $validator = Validator::make($request->all(), [
        //     'blog_id' => 'required|exists:blogs,id',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);}
        // $like->update([
        //     'blog_id' => $request->blog_id,
        // ]);
        // return response()->json($like, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        //
        if(Auth::user()->id !== $like->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $data = Like::find($like->id);
        if (!$data) {
            return response()->json(['message' => 'Like not found'], 404);}
        $data->delete();
        return response()->json(['message' => 'Like deleted successfully'], 200);
    }
}

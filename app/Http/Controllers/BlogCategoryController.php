<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $blogCategories = BlogCategory::all();
        if($blogCategories->isEmpty()) {
            return response()->json(['message' => 'No blog categories found'], 404);
        }
        return response()->json($blogCategories);
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_parent' => 'boolean',
            'parent_id' => 'nullable|exists:blog_categories,id',
            'position' => 'integer|min:0',
            'is_active' => 'boolean'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422); 
        }
        $blogCategory = BlogCategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_parent' => $request->is_parent ?? true,
            'parent_id' => $request->parent_id,
            'position' => $request->position ?? 0,
            'is_active' => $request->is_active ?? true,
        ]);
        return response()->json($blogCategory, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogCategory $blogCategory)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',

            'description' => 'nullable|string',
            'is_parent' => 'boolean',
            'parent_id' => 'nullable|exists:blog_categories,id',
            'position' => 'integer|min:0',
            'is_active' => 'boolean'

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $blogCategory->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_parent' => $request->is_parent ?? true,
            'parent_id' => $request->parent_id,
            'position' => $request->position ?? 0,
            'is_active' => $request->is_active ?? true,
        ]);
        return response()->json($blogCategory, 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategory $blogCategory)
    {
        //
        if ($blogCategory) {
            $blogCategory->delete();
            return response()->json(['message' => 'Blog category deleted successfully'], 200);
        }
        return response()->json(['message' => 'Blog category not found'], 404);
    }
}

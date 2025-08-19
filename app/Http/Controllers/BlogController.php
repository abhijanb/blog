<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('category')->paginate(10);
        if($blogs->count() <=0){
            return response()->json(['message' => 'No blogs found'], 404);
        }
        return response()->json($blogs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:blogs,name',
            'slug' => 'required|string|max:255|unique:blogs,slug',
            'description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'publish_date' => 'nullable|date',
            'seo_title' => 'nullable|string|max:255',
            'seo_keyword' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'social_share_image' => 'nullable|string',
            'social_share_description' => 'nullable|string',
            'category_id' => 'required|exists:blog_categories,id',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // if request has image social_share_image then store it 
        if($request->hasFile('social_share_image')) {
            $imagePath = $request->file('social_share_image')->store('images', 'public');
            $request->merge(['social_share_image' => $imagePath]);
        }
    
        $blog = Blog::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'keywords' => $request->keywords,
            'publish_date' => Carbon::now(),
            'seo_title' => $request->seo_title,
            'seo_keyword' => $request->seo_keyword,
            'seo_description' => $request->seo_description,
            'social_share_image' => $request->social_share_image,
            'social_share_description' => $request->social_share_description,
            'category_id' => $request->category_id,
            'is_active' => $request->is_active ?? true,
        ]);

        return response()->json($blog, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return response()->json($blog->load('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255|unique:blogs,name,' . $blog->id,
            'slug' => 'sometimes|required|string|max:255|unique:blogs,slug,' . $blog->id,
            'description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'publish_date' => 'nullable|date',
            'seo_title' => 'nullable|string|max:255',
            'seo_keyword' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'social_share_image' => 'nullable|string',
            'social_share_description' => 'nullable|string',
            'category_id' => 'sometimes|required|exists:blog_categories,id',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $blog->update($request->only([
            'name',
            'slug',
            'description',
            'keywords',
            'publish_date',
            'seo_title',
            'seo_keyword',
            'seo_description',
            'social_share_image',
            'social_share_description',
            'category_id',
            'is_active',
        ]));

        return response()->json($blog, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if ($blog) {
            $blog->delete();
            return response()->json(['message' => 'Blog deleted successfully'], 200);
        }
        return response()->json(['message' => 'Blog not found'], 404);
    }
}

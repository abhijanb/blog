<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $faqCategories = FaqCategory::paginate(10);
        return response()->json($faqCategories);
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
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $faqCategory = FaqCategory::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return response()->json($faqCategory, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(FaqCategory $faqCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FaqCategory $faqCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FaqCategory $faqCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FaqCategory $faqCategory)
    {
        //
        if($faqCategory->faqs()->count() > 0) {
            return response()->json(['error' => 'Cannot delete category with FAQs'], 422);
        }
        $faqCategory->delete();
        return response()->json(null, 204);
    }
}

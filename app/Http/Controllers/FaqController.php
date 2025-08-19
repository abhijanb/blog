<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public function index()
    {
        //use like to display frequently asked questions
        // $faqs = Faq::with('category')->get();
        // return response()->json($faqs);

    }


    public function showFAQ(){
        $faq = Faq::where('count', '>', 0)
            ->with('category')
            ->orderBy('count', 'desc')
            ->paginate(5);
        return response()->json($faq);
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
        
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category_id' => 'required|exists:faq_categories,id',
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // check if the faq is simlar to existing ones
        $existingFaq = Faq::where('question', $request->question)
            ->where('category_id', $request->category_id)
            ->first();
        if ($existingFaq) {
        $faq = Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'category_id' => $request->category_id,
            'count' => $existingFaq->count + 1,
        ]);
        return response()->json($faq, 201);
    }
        $faq = Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'category_id' => $request->category_id,
        ]);
        return response()->json($faq, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        //if faq exists, delete it
        if ($faq) {
            $faq->delete();
            return response()->json(['message' => 'FAQ deleted successfully'], 200);
        }
        return response()->json(['message' => 'FAQ not found'], 404);
    }
}

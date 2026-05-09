<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductQuestionController extends Controller
{
    // Admin: List questions
    public function index()
    {
        $questions = ProductQuestion::with(['product', 'user'])->latest()->paginate(20);
        return view('backend.pages.questions.index', compact('questions'));
    }

    // Admin: Answer/Update question
    public function update(Request $request, ProductQuestion $question)
    {
        $request->validate([
            'answer' => 'required|string',
            'status' => 'required'
        ]);

        $question->answer = $request->answer;
        $question->status = (int) $request->status;
        $question->save();

        return back()->with('success', 'Question answered and status updated successfully.');
    }

    // Admin: Delete question
    public function destroy(ProductQuestion $question)
    {
        $question->delete();
        return back()->with('success', 'Question deleted successfully.');
    }

    // Frontend: Store question
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'question' => 'required|string|max:1000',
            'name' => 'nullable|string|max:255'
        ]);

        ProductQuestion::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'name' => Auth::check() ? Auth::user()->name : ($request->name ?? 'Guest User'),
            'question' => $request->question,
            'status' => 0 // Pending by default
        ]);

        return back()->with('success', 'Your question has been submitted. It will be visible after admin approval.');
    }
}

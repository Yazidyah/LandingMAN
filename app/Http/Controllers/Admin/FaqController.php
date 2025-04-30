<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq = Faq::create($request->all());

        // Log the creation activity
        Log::info('FAQ Created', [
            'user_id' => Auth::id(),
            'username' => Auth::user()->name,
            'action' => 'Create',
            'faq_question' => $faq->question,
            'faq_id' => $faq->id,
        ]);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ created successfully.');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq->update($request->all());

        // Log the update activity
        Log::info('FAQ Updated', [
            'user_id' => Auth::id(),
            'username' => Auth::user()->name,
            'action' => 'Update',
            'faq_question' => $faq->question,
            'faq_id' => $faq->id,
        ]);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        // Log the deletion activity
        Log::info('FAQ Deleted', [
            'user_id' => Auth::id(),
            'username' => Auth::user()->name,
            'action' => 'Delete',
            'faq_question' => $faq->question,
            'faq_id' => $faq->id,
        ]);

        $faq->delete();

        return redirect()->route('admin.faq.index')->with('success', 'FAQ deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Element; // Change this line
use Illuminate\Http\Request;

class KuesionerController extends Controller
{
    public function index()
    {
        $kuesioners = Question::orderBy('question_order', 'asc')->get();
        $elements = Element::all(); // Change this line
        return view('admin.kuesioner.index', compact('kuesioners', 'elements')); // Change this line
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'question_text' => 'required|string',
            'question_order' => 'nullable|integer',
            'element_id' => 'required|integer', // Change this line
        ]);

        try {
            $maxOrder = Question::max('question_order');
            $request->merge(['question_order' => $maxOrder + 1]);

            Question::create($request->all());

            return redirect()->route('admin.kuesioner.index')->with('success', 'Kuesioner created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.kuesioner.index')->with('error', 'Failed to create Kuesioner.');
        }
    }

    public function update(Request $request, Question $kuesioner)
    {
        $request->validate([
            'question_text' => 'required|string',
            'question_order' => 'nullable|integer',
            'element_id' => 'required|integer', // Change this line
        ]);

        $request->merge(['question_order' => $request->question_order ?? $kuesioner->question_order]);

        $kuesioner->update($request->all());

        return redirect()->route('admin.kuesioner.index')->with('success', 'Kuesioner updated successfully.');
    }

    public function destroy(Question $kuesioner)
    {
        $kuesioner->delete();

        return redirect()->route('admin.kuesioner.index')->with('success', 'Kuesioner deleted successfully.');
    }
}

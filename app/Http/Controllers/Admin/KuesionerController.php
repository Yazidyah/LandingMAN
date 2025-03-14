<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Survey;
use Illuminate\Http\Request;

class KuesionerController extends Controller
{
    public function index()
    {
        $kuesioners = Question::orderBy('survey_id', 'asc')->orderBy('question_order', 'asc')->get();
        $surveys = Survey::all(); 
        return view('admin.kuesioner.index', compact('kuesioners', 'surveys'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'survey_id' => 'required|integer',
            'question_text' => 'required|string',
            'question_order' => 'nullable|integer',
        ]);

        try {
            $maxOrder = Question::where('survey_id', $request->survey_id)->max('question_order');
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
            'survey_id' => 'required|integer',
            'question_text' => 'required|string',
            'question_order' => 'nullable|integer',
        ]);

        if ($request->survey_id != $kuesioner->survey_id) {
            $maxOrder = Question::where('survey_id', $request->survey_id)->max('question_order');
            $request->merge(['question_order' => $maxOrder + 1]);
        } else {
            $request->merge(['question_order' => $request->question_order ?? $kuesioner->question_order]);
        }

        $kuesioner->update($request->all());

        return redirect()->route('admin.kuesioner.index')->with('success', 'Kuesioner updated successfully.');
    }

    public function destroy(Question $kuesioner)
    {
        $kuesioner->delete();

        return redirect()->route('admin.kuesioner.index')->with('success', 'Kuesioner deleted successfully.');
    }
}

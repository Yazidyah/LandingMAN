<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Element;
use App\Models\Survey; // Add this line
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Add this line

class KuesionerController extends Controller
{
    public function index()
    {
        $kuesioners = Question::select('questions.*', 'surveys.survey_name', 'elements.element_name')
            ->leftJoin('surveys', 'surveys.survey_id', '=', 'questions.survey_id')
            ->leftJoin('elements', 'elements.element_id', '=', 'questions.element_id')
            ->orderBy('questions.survey_id', 'asc')
            ->orderBy('questions.question_order', 'asc')
            ->get();
        $elements = Element::all();
        $surveys = Survey::all();
        return view('admin.kuesioner.index', compact('kuesioners', 'elements', 'surveys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_text' => 'required|string',
            'question_order' => 'nullable|integer',
            'element_id' => 'required|integer',
            'survey_id' => 'required|integer', 
        ]);

        try {
            $maxOrder = Question::where('survey_id', $request->survey_id)->max('question_order');
            $request->merge(['question_order' => $maxOrder + 1]);

            Log::info('Creating question with data: ', $request->all());

            Question::create($request->all());

            return redirect()->route('admin.kuesioner.index')->with('success', 'Kuesioner created successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to create Kuesioner: ', ['error' => $e->getMessage()]); 
            return redirect()->route('admin.kuesioner.index')->with('error', 'Failed to create Kuesioner.');
        }
    }

    public function update(Request $request, Question $kuesioner)
    {
        $request->validate([
            'question_text' => 'required|string',
            'question_order' => 'nullable|integer',
            'element_id' => 'required|integer',
            'survey_id' => 'required|integer',
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

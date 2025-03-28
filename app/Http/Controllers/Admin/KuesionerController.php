<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Unsur;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KuesionerController extends Controller
{
    public function index()
    {
        $kuesioners = Question::select('questions.*', 'surveys.survey_name', 'unsur.unsur_name')
            ->leftJoin('surveys', 'surveys.id', '=', 'questions.survey_id')
            ->leftJoin('unsur', 'unsur.id', '=', 'questions.unsur_id')
            ->orderBy('questions.survey_id', 'asc')
            ->orderBy('questions.question_order', 'asc')
            ->get();
        $unsurs = Unsur::all();
        $surveys = Survey::all();
        return view('admin.kuesioner.index', compact('kuesioners', 'unsurs', 'surveys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_text' => 'required|string',
            'question_order' => 'nullable|integer',
            'unsur_id' => 'required|integer',
            'survey_id' => 'required|integer', 
        ]);

        try {
            $maxOrder = Question::where('survey_id', $request->survey_id)->max('question_order');
            $request->merge(['question_order' => $maxOrder + 1]);

            $question = Question::create($request->all());

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
            'unsur_id' => 'required|integer',
            'survey_id' => 'required|integer',
        ]);
        
        $request->merge(['question_order' => $request->question_order ?? $kuesioner->question_order]);

        try {
            $kuesioner->update($request->all());
            return redirect()->route('admin.kuesioner.index')->with('success', 'Kuesioner updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update Kuesioner: ', ['error' => $e->getMessage()]); 
            return redirect()->route('admin.kuesioner.index')->with('error', 'Failed to update Kuesioner.');
        }
    }

    public function destroy(Question $kuesioner)
    {
        try {
            $kuesioner->delete();
            return redirect()->route('admin.kuesioner.index')->with('success', 'Kuesioner deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete Kuesioner: ', ['error' => $e->getMessage()]); 
            return redirect()->route('admin.kuesioner.index')->with('error', 'Failed to delete Kuesioner.');
        }
    }
}

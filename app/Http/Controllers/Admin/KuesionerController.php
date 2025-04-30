<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Unsur;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class KuesionerController extends Controller
{
    public function index(Request $request)
    {
        $query = Question::select('questions.*', 'surveys.survey_name', 'unsur.unsur_name')
            ->leftJoin('surveys', 'surveys.id', '=', 'questions.survey_id')
            ->leftJoin('unsur', 'unsur.id', '=', 'questions.unsur_id')
            ->orderBy('questions.survey_id', 'asc')
            ->orderBy('questions.question_order', 'asc');

        if ($request->has('survey_id') && $request->survey_id) {
            $query->where('questions.survey_id', $request->survey_id);
        }

        $kuesioners = $query->get();
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

            // Log the creation activity
            Log::info('Kuesioner Created', [
                'user_id' => Auth::id(),
                'username' => Auth::user()->name,
                'action' => 'Create',
                'question_text' => $question->question_text,
                'question_id' => $question->id,
            ]);

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

            // Log the update activity
            Log::info('Kuesioner Updated', [
                'user_id' => Auth::id(),
                'username' => Auth::user()->name,
                'action' => 'Update',
                'question_text' => $kuesioner->question_text,
                'question_id' => $kuesioner->id,
            ]);

            return redirect()->route('admin.kuesioner.index')->with('success', 'Kuesioner updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update Kuesioner: ', ['error' => $e->getMessage()]); 
            return redirect()->route('admin.kuesioner.index')->with('error', 'Failed to update Kuesioner.');
        }
    }

    public function destroy(Question $kuesioner)
    {
        // Log the deletion activity
        Log::info('Kuesioner Deleted', [
            'user_id' => Auth::id(),
            'username' => Auth::user()->name,
            'action' => 'Delete',
            'question_text' => $kuesioner->question_text,
            'question_id' => $kuesioner->id,
        ]);

        try {
            $kuesioner->delete();
            return redirect()->route('admin.kuesioner.index')->with('success', 'Kuesioner deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete Kuesioner: ', ['error' => $e->getMessage()]); 
            return redirect()->route('admin.kuesioner.index')->with('error', 'Failed to delete Kuesioner.');
        }
    }
}

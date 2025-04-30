<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::orderBy('id', 'asc')->get();
        return view('admin.survey.index', compact('surveys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'survey_name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Survey::create($request->all());

        // Log the creation activity
        Log::info('Survey Created', [
            'user_id' => Auth::id(),
            'username' => Auth::user()->name,
            'action' => 'Create',
            'survey_name' => $request->survey_name,
        ]);

        return redirect()->route('admin.survey.index')->with('success', 'Survey created successfully.');
    }

    public function edit(Survey $survey)
    {
        return view('admin.survey.edit', compact('survey'));
    }

    public function update(Request $request, Survey $survey)
    {
        $request->validate([
            'survey_name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $survey->update($request->all());

        // Log the update activity
        Log::info('Survey Updated', [
            'user_id' => Auth::id(),
            'username' => Auth::user()->name,
            'action' => 'Update',
            'survey_name' => $survey->survey_name,
            'survey_id' => $survey->id,
        ]);

        return redirect()->route('admin.survey.index')->with('success', 'Survey updated successfully.');
    }

    public function destroy($id)
    {
        $survey = Survey::findOrFail($id);

        // Log the deletion activity
        Log::info('Survey Deleted', [
            'user_id' => Auth::id(),
            'username' => Auth::user()->name,
            'action' => 'Delete',
            'survey_name' => $survey->survey_name,
            'survey_id' => $survey->id,
        ]);

        $survey->delete();

        return redirect()->route('admin.survey.index')->with('success', 'Survey deleted successfully.');
    }
}

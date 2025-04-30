<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unsur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UnsurController extends Controller
{
    public function index()
    {
        $unsurs = Unsur::orderBy('id', 'asc')->get();
        return view('admin.unsur.index', compact('unsurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unsur_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        Unsur::create([
            'unsur_name' => $request->unsur_name,
            'description' => $request->description,
        ]);

        // Log the creation activity
        Log::info('Unsur Created', [
            'user_id' => Auth::id(),
            'username' => Auth::user()->name,
            'action' => 'Create',
            'unsur_name' => $request->unsur_name,
        ]);

        return redirect()->route('admin.unsur.index')->with('success', 'Unsur created successfully.');
    }

    public function edit(Unsur $unsur)
    {
        return view('admin.unsur.edit', compact('unsur'));
    }

    public function update(Request $request, Unsur $unsur)
    {
        $request->validate([
            'unsur_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $unsur->update([
            'unsur_name' => $request->unsur_name,
            'description' => $request->description,
        ]);

        // Log the update activity
        Log::info('Unsur Updated', [
            'user_id' => Auth::id(),
            'username' => Auth::user()->name,
            'action' => 'Update',
            'unsur_name' => $unsur->unsur_name,
            'unsur_id' => $unsur->id,
        ]);

        return redirect()->route('admin.unsur.index')->with('success', 'Unsur updated successfully.');
    }

    public function destroy(Unsur $unsur)
    {
        // Log the deletion activity
        Log::info('Unsur Deleted', [
            'user_id' => Auth::id(),
            'username' => Auth::user()->name,
            'action' => 'Delete',
            'unsur_name' => $unsur->unsur_name,
            'unsur_id' => $unsur->id,
        ]);

        $unsur->delete();

        return redirect()->route('admin.unsur.index')->with('success', 'Unsur deleted successfully.');
    }
}

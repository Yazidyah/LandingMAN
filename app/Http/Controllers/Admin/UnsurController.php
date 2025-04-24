<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unsur;
use Illuminate\Http\Request;

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

        return redirect()->route('admin.unsur.index')->with('success', 'Unsur updated successfully.');
    }

    public function destroy(Unsur $unsur)
    {
        $unsur->delete();

        return redirect()->route('admin.unsur.index')->with('success', 'Unsur deleted successfully.');
    }
}

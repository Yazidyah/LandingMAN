<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Element;
use Illuminate\Http\Request;

class UnsurController extends Controller
{
    public function index()
    {
        $unsurs = Element::all();
        return view('admin.unsur.index', compact('unsurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'element_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        Element::create($request->all());

        return redirect()->route('admin.unsur.index')->with('success', 'Element created successfully.');
    }

    public function edit(Element $unsur)
    {
        return view('admin.unsur.edit', compact('unsur'));
    }

    public function update(Request $request, Element $unsur)
    {
        $request->validate([
            'element_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $unsur->update($request->all());

        return redirect()->route('admin.unsur.index')->with('success', 'Element updated successfully.');
    }

    public function destroy(Element $unsur)
    {
        $unsur->delete();

        return redirect()->route('admin.unsur.index')->with('success', 'Element deleted successfully.');
    }
}

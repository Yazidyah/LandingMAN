<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index()
    {
        $categories = Category::where('id', '>=', 3)->orderBy('id', 'asc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function destroy(Category $category)
    {
        // Log the deletion activity
        Log::info('Category Deleted', [
            'user_id' => Auth::id(),
            'username' => Auth::user()->name,
            'action' => 'Delete',
            'category_name' => $category->category_name,
            'category_id' => $category->id,
        ]);

        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $category->update([
            'category_name' => strtolower($request->category_name),
        ]);

        // Log the update activity
        Log::info('Category Updated', [
            'user_id' => Auth::id(),
            'username' => Auth::user()->name,
            'action' => 'Update',
            'category_name' => $category->category_name,
            'category_id' => $category->id,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $category = Category::create([
            'category_name' => strtolower($request->category_name),
        ]);

        // Log the creation activity
        Log::info('Category Created', [
            'user_id' => Auth::id(),
            'username' => Auth::user()->name,
            'action' => 'Create',
            'category_name' => $category->category_name,
            'category_id' => $category->id,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    public function create()
    {
        return view('admin.categories.create');
    }
}

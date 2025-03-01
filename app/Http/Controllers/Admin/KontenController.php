<?php

namespace App\Http\Controllers\Admin;

use App\Models\Content;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class KontenController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $contents = Content::with(['category', 'images'])->get()->map(function ($content) {
            if ($content->images->isNotEmpty()) {
                $content->image_url = asset('storage/assets/content/' . $content->images->first()->image_url);
            }
            // Assign category color based on category_id
            switch ($content->category->id) {
                case 1:
                    $content->category_color = 'bg-yellow-300 text-grey-800';
                    break;
                case 2:
                    $content->category_color = 'bg-blue-300 text-white-800';
                    break;
                default:
                    $content->category_color = 'bg-gray-300 text-white-800';
                    break;
            }
            return $content;
        });
        return view('admin.contents.index', compact('contents', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.contents.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        Content::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('admin.contents.index')->with('success', 'Content created successfully.');
    }

    public function edit(Content $content)
    {
        $categories = Category::all();
        return view('admin.contents.edit', compact('content', 'categories'));
    }
    

    public function update(Request $request, Content $content)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $content->update([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.contents.index')->with('success', 'Content updated successfully.');
    }
}

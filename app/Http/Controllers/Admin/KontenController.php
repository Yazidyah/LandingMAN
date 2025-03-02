<?php

namespace App\Http\Controllers\Admin;

use App\Models\Content;
use App\Models\ContentImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class KontenController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Content::with(['category', 'images']);

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $contents = $query->get()->map(function ($content) {
            if ($content->images->isNotEmpty()) {
                $content->image_url = asset('storage/' . $content->images->first()->image_url);
            }
            // Assign category color based on category_id
            switch ($content->category->id) {
                case 1:
                    $content->category_color = 'bg-yellow-300 text-grey-800';
                    break;
                case 2:
                    $content->category_color = 'bg-blue-300 text-white-800';
                    break;
                case 3:
                    $content->category_color = 'bg-blue-300 text-white-800';
                    break;
                case 4:
                    $content->category_color = 'bg-blue-300 text-white-800';
                    break;
                case 5:
                    $content->category_color = 'bg-blue-300 text-white-800';
                    break;
                case 6:
                    $content->category_color = 'bg-blue-300 text-white-800';
                    break;
                case 7:
                    $content->category_color = 'bg-blue-300 text-white-800';
                    break;
                case 8:
                    $content->category_color = 'bg-blue-300 text-white-800';
                    break;
                case 9:
                    $content->category_color = 'bg-blue-300 text-white-800';
                    break;
                case 10:
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
            'contentFile.*' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $content = Content::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        if ($request->hasFile('contentFile')) {
            foreach ($request->file('contentFile') as $file) {
                $filePath = $file->store('assets/content', 'public');
                ContentImage::create([
                    'content_id' => $content->id,
                    'image_url' => $filePath,
                ]);
            }
        }

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
            'contentFile.*' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $content->update([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('contentFile')) {
            foreach ($request->file('contentFile') as $file) {
                $filePath = $file->store('assets/content', 'public');
                ContentImage::create([
                    'content_id' => $content->id,
                    'image_url' => $filePath,
                ]);
            }
        }

        return redirect()->route('admin.contents.index')->with('success', 'Content updated successfully.');
    }

    public function destroy($id)
    {
        $content = Content::findOrFail($id);

        // Delete associated images
        foreach ($content->images as $image) {
            Storage::disk('public')->delete($image->image_url);
            $image->delete();
        }

        // Delete the content
        $content->delete();

        return redirect()->route('admin.contents.index')->with('success', 'Content deleted successfully.');
    }
}

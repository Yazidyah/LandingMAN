<?php

namespace App\Http\Controllers\Admin;

use App\Models\Content;
use App\Models\ContentImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class KontenController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Content::with(['category', 'images'])
            ->whereNotIn('category_id', [1, 2]);

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        // Urutkan berdasarkan updated_at terbaru
        $contents = $query->orderBy('updated_at', 'desc')->get()->map(function ($content) {
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
        try {
            if (!$request->hasFile('contentFile')) {
                // No files were uploaded
            } else {
                // Files received
            }

            $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required|string',
                'category_id' => 'required|integer|exists:categories,id',
                'contentFile.*' => 'nullable|file|mimes:jpg,jpeg,png', 
            ]);

            // Validate total size of all files (10MB = 10240KB) 
            if ($request->hasFile('contentFile')) {
                $totalSize = array_sum(array_map(function ($file) {
                    return $file->getSize();
                }, $request->file('contentFile')));

                if ($totalSize > 10240 * 1024) { // 10MB in bytes
                    return back()->withErrors(['contentFile' => 'The total size of all files must not exceed 10MB.']);
                }
            }

            $content = Content::create([
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
                'title' => $request->title,
                'body' => $request->body,
                'slug' => \Str::slug($request->title),
            ]);

            if ($request->hasFile('contentFile')) {
                foreach ($request->file('contentFile') as $file) {
                    $filePath = $file->store('assets/content', 'public'); // Save file to storage

                    ContentImage::create([
                        'content_id' => $content->id, // Link image to content
                        'image_url' => $filePath,
                    ]);
                }
            }

            // Log the creation activity
            Log::info('Content Created', [
                'user_id' => auth()->id(),
                'username' => auth()->user()->name,
                'action' => 'Create',
                'content_title' => $content->title,
                'content_id' => $content->id,
            ]);

            return redirect()->route('admin.contents.index')->with('success', 'Content created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while creating the content. Please try again.']);
        }
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
            'contentFile.*' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:10240',
        ]);

        $content->update([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'slug' => \Str::slug($request->title),
        ]);

        if ($request->hasFile('contentFile')) {
            foreach ($request->file('contentFile') as $file) {
                $filePath = $file->store('assets/content', 'public'); // Stores in storage/app/public/assets/content
                ContentImage::create([
                    'content_id' => $content->id,
                    'image_url' => $filePath,
                ]);
            }
        }

        // Log the update activity
        Log::info('Content Updated', [
            'user_id' => auth()->id(),
            'username' => auth()->user()->name,
            'action' => 'Update',
            'content_title' => $content->title,
            'content_id' => $content->id,
        ]);

        return redirect()->route('admin.contents.index')->with('success', 'Content updated successfully.');
    }

    public function destroy($id)
    {
        $content = Content::findOrFail($id);

        // Log the deletion activity
        Log::info('Content Deleted', [
            'user_id' => auth()->id(),
            'username' => auth()->user()->name,
            'action' => 'Delete',
            'content_title' => $content->title,
            'content_id' => $content->id,
        ]);

        // Delete associated images
        foreach ($content->images as $image) {
            Storage::disk('public')->delete($image->image_url);
            $image->delete();
        }

        // Delete the content
        $content->delete();

        return redirect()->route('admin.contents.index')->with('success', 'Content deleted successfully.');
    }

    /**
     * Remove a specific image from a content.
     */
    public function destroyImage($id)
    {
        $image = ContentImage::findOrFail($id);

        // Hapus file dari storage
        Storage::disk('public')->delete($image->image_url);

        // Hapus record dari database
        $image->delete();

        // Log penghapusan gambar
        Log::info('Content Image Deleted', [
            'user_id' => auth()->id(),
            'username' => auth()->user()->name,
            'action' => 'Delete Image',
            'image_id' => $id,
        ]);

        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\ContentImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function __construct()
    {
        ini_set('upload_max_filesize', '5M');
        ini_set('post_max_size', '5M');
    }

    public function index()
    {
        $contents = Content::where('category_id', 1)
            ->with('images')
            ->orderBy('created_at', 'desc') // Sort by created_at in descending order
            ->get();

        // Format the created_at date for each image
        foreach ($contents as $content) {
            foreach ($content->images as $image) {
                $image->formatted_date = \Carbon\Carbon::parse($image->created_at)->format('d-m-Y');
            }
        }

        return view('admin.banner.index', compact('contents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'contentFile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'contentFile.max' => 'Tidak dapat mengunggah, Ukuran Gambar lebih besar dari 2MB',
        ]);

        $title = strtolower($request->title);
        $slug = Str::slug($title, '-');

        if (Content::where('category_id', 1)->where('slug', $slug)->exists()) {
            return redirect()->route('admin.banner.index')->with('error', 'Banner with the same title already exists.');
        }

        $content = Content::create([
            'user_id' => Auth::id(),
            'category_id' => 1,
            'title' => $title,
            'slug' => $slug,
        ]);

        if ($request->hasFile('contentFile')) {
            $originalName = $request->file('contentFile')->getClientOriginalName();
            $hashedName = md5($originalName . time()) . '.' . $request->file('contentFile')->getClientOriginalExtension();
            $filePath = $request->file('contentFile')->storeAs('assets/content', $hashedName, 'public');
            ContentImage::create([
                'content_id' => $content->id,
                'image_url' => $filePath,
            ]);
        }

        return redirect()->route('admin.banner.index')->with('success', 'Banner created successfully.');
    }

    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        foreach ($content->images as $image) {
            Storage::disk('public')->delete($image->image_url);
            $image->delete();
        }
        $content->delete();

        return redirect()->route('admin.banner.index')->with('success', 'Banner deleted successfully.');
    }
}

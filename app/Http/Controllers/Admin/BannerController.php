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
    public function index()
    {
        $contents = Content::where('category_id', 1)->with('images')->get()->map(function ($content) {
            if ($content->images->isNotEmpty()) {
                $content->image_url = asset('storage/' . $content->images->first()->image_url);
                $content->basename = basename($content->images->first()->image_url, '.' . pathinfo($content->images->first()->image_url, PATHINFO_EXTENSION));
            }
            return $content;
        })->sortBy('basename');

        return view('admin.banner.index', compact('contents'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'contentFile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $title = strtolower($request->title);
        $slug = Str::slug($title, '-');

        // Check if a banner with the same title already exists
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
            $existingBanners = ContentImage::whereHas('content', function ($query) {
                $query->where('category_id', 1);
            })->pluck('image_url')->map(function ($url) {
                return pathinfo($url, PATHINFO_FILENAME); // Extract only the base filename
            })->toArray();

            $bannerNumber = 1;
            while (in_array('banner_' . $bannerNumber, $existingBanners)) {
                $bannerNumber++;
            }

            $fileName = 'banner_' . $bannerNumber . '.' . $request->file('contentFile')->getClientOriginalExtension();
            $filePath = $request->file('contentFile')->storeAs('assets/content', $fileName, 'public');
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

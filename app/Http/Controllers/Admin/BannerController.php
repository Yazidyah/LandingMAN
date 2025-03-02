<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\ContentImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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

        $content = Content::create([
            'user_id' => Auth::id(),
            'category_id' => 1,
            'title' => $request->title,
        ]);

        if ($request->hasFile('contentFile')) {
            $existingBanners = ContentImage::whereHas('content', function ($query) {
                $query->where('category_id', 1);
            })->pluck('image_url')->toArray();

            $bannerNumber = 1;
            while (in_array('assets/content/banner_' . $bannerNumber . '.' . $request->file('contentFile')->getClientOriginalExtension(), $existingBanners)) {
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

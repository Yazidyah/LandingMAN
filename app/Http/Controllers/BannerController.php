<?php

namespace App\Http\Controllers;

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

        return view('home', compact('contents'));

    }
}

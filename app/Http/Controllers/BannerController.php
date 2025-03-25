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

        $news = Content::where('category_id', 5)->with('images')->get()->map(function ($item) {
            $item->image_url = $item->images->first() ? asset('storage/' . $item->images->first()->image_url) : asset('storage/assets/content/default-image.jpg');
            return $item;
        });

        return view('home', compact('contents','news'));

    }
}

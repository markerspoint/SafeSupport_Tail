<?php

namespace App\Http\Controllers\Counselor;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;

class CounselorResourceController extends Controller
{
    public function articles()
    {
        $articles = Resource::where('type', 'article')->latest()->get();
        return view('counselor.resources.articles', compact('articles'));
    }

    public function storeArticle(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url|max:255',
            'is_active' => 'boolean',
        ]);

        Resource::create([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'type' => 'article',
            'is_active' => $request->input('is_active', 1),
        ]);

        return redirect()->route('counselor.resources.articles')->with('success', 'Article added successfully.');
    }

    public function selfHelp()
    {
        $selfHelps = Resource::where('type', 'self_help')->latest()->get();
        return view('counselor.resources.self-help', compact('selfHelps'));
    }

    public function storeSelfHelp(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url|max:255',
            'is_active' => 'boolean',
        ]);

        Resource::create([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'type' => 'self_help',
            'is_active' => $request->input('is_active', 1),
        ]);

        return redirect()->route('counselor.resources.self-help')->with('success', 'Self-help resource added successfully.');
    }

    public function videos()
    {
        $videos = Resource::where('type', 'video')->latest()->get();
        return view('counselor.resources.videos', compact('videos'));
    }

    public function storeVideo(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url|max:255',
            'is_active' => 'boolean',
        ]);

        Resource::create([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'type' => 'video',
            'is_active' => $request->input('is_active', 1),
        ]);

        return redirect()->route('counselor.resources.videos')->with('success', 'Video added successfully.');
    }
}
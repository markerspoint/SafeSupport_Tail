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

    public function showArticle($id)
    {
        $article = Resource::where('type', 'article')->findOrFail($id);
        return response()->json([
            'id' => $article->id,
            'title' => $article->title,
            'description' => $article->description,
            'url' => $article->url,
            'is_active' => $article->is_active,
        ]);
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

    public function updateArticle(Request $request, $id)
    {
        $article = Resource::where('type', 'article')->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url|max:255',
            'is_active' => 'boolean',
        ]);

        $article->update([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'is_active' => $request->input('is_active', 1),
        ]);

        return redirect()->route('counselor.resources.articles')->with('success', 'Article updated successfully.');
    }

    public function destroyArticle($id)
    {
        $article = Resource::where('type', 'article')->findOrFail($id);
        $article->delete();
        return response()->json(['success' => 'Article deleted successfully.']);
    }

    public function selfHelp()
    {
        $selfHelps = Resource::where('type', 'self_help')->latest()->get();
        return view('counselor.resources.self-help', compact('selfHelps'));
    }

    public function showSelfHelp($id)
    {
        $tool = Resource::where('type', 'self_help')->findOrFail($id);
        return response()->json([
            'id' => $tool->id,
            'title' => $tool->title,
            'description' => $tool->description,
            'url' => $tool->url,
            'is_active' => $tool->is_active,
        ]);
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

        return redirect()->route('counselor.resources.self-help')->with('success', 'Self-help tool added successfully.');
    }

    public function updateSelfHelp(Request $request, $id)
    {
        $tool = Resource::where('type', 'self_help')->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url|max:255',
            'is_active' => 'boolean',
        ]);

        $tool->update([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'is_active' => $request->input('is_active', 1),
        ]);

        return redirect()->route('counselor.resources.self-help')->with('success', 'Self-help tool updated successfully.');
    }

    public function destroySelfHelp($id)
    {
        $tool = Resource::where('type', 'self_help')->findOrFail($id);
        $tool->delete();
        return response()->json(['success' => 'Self-help tool deleted successfully.']);
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
<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function videos()
    {
        $videos = Resource::where('type', 'video')->where('is_active', true)->get();
        return view('student.resources.videos', compact('videos'));
    }

    public function articles()
    {
        $articles = Resource::where('type', 'article')->where('is_active', true)->get();
        return view('student.resources.articles', compact('articles'));
    }

    public function selfHelp()
    {
        $tools = Resource::where('type', 'self-help')->where('is_active', true)->get();
        return view('student.resources.self-help', compact('tools'));
    }
}
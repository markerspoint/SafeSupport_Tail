<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource;

class LandingPageController extends Controller
{
    public function index()
    {
        $articles = Resource::with('counselor')
            ->where('type', 'article')
            ->where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('welcome', compact('articles'));
    }
}

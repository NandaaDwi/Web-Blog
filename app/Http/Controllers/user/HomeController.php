<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['user', 'categories'])
            ->where('is_published', true);

        $articles = $query->latest()->get();

        $categories = Category::withCount('articles')->get();
        $totalArticles = Article::where('is_published', true)->count();
        $totalUsers = User::count();
        $totalCategories = Category::count();

        return view('user.home', compact('articles', 'categories', 'totalArticles', 'totalUsers', 'totalCategories'));
    }
}

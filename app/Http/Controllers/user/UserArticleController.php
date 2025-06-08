<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;
use App\Models\User;

class UserArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['user', 'categories'])
            ->where('is_published', true)
            ->latest()
            ->get();

        $categories = Category::withCount('articles')->get();

        $totalArticles = $articles->count();
        $totalUsers = User::count();
        $totalCategories = $categories->count();

        return view('home', compact('articles', 'categories', 'totalArticles', 'totalUsers', 'totalCategories'));
    }

    public function show($slug)
    {
        $article = Article::with(['user', 'comments.user'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $categories = Category::all();

        return view('user.articles.show', compact('article', 'categories'));
    }

    public function storeComment(Request $request, $slug)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $article = Article::where('slug', $slug)->firstOrFail();

        Comment::create([
            'user_id' => auth()->id(),
            'article_id' => $article->id,
            'body' => $request->body,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}

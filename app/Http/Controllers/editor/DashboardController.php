<?php

namespace App\Http\Controllers\editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function index()
    {
        // $user = Auth::user();
        // $articleCount = Article::where('user_id', $user->id)->count();
        // $commentCount = Comment::whereHas('article', function ($q) use ($user) {
        //     $q->where('user_id', $user->id);
        // })->count();

        // return view('editor.dashboard', compact('articleCount', 'commentCount'));

        $user = Auth::user();

        $totalArticles = Article::where('user_id', $user->id)->count();
        $totalComments = Comment::whereIn('article_id', Article::where('user_id', $user->id)->pluck('id'))->count();
        $recentArticles = Article::where('user_id', $user->id)->latest()->take(5)->get();
        
        return view('editor.dashboard', compact(
            'totalArticles',
            'totalComments',
            'recentArticles',
        ));
    }
}

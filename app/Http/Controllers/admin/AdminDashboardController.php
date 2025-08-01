<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'userCount' => User::count(),
            'articleCount' => Article::count(),
            'commentCount' => Comment::count(),
            'categoryCount' => Category::count(),
        ]);
    }
}

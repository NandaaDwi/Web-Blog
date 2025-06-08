<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('categories')->latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|max:2048',
            'categories' => 'array|exists:categories,id',
            'is_published' => 'nullable|boolean',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $article = Article::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'thumbnail' => $thumbnailPath,
            'is_published' => $request->has('is_published') ? true : false,
        ]);

        $article->categories()->sync($request->categories ?? []);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dibuat.');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|max:2048',
            'categories' => 'array|exists:categories,id',
            'is_published' => 'nullable|boolean'
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $article->thumbnail = $thumbnailPath;
        }

        $article->title = $request->title;
        $article->content = $request->content;
        $article->is_published = $request->has('is_published') ? true : false;
        $article->save();

        $article->categories()->sync($request->categories ?? []);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        foreach ($article->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|max:2048',
            'article_id' => 'nullable|exists:articles,id'
        ]);

        $path = $request->file('upload')->store('article_images', 'public');

        if ($request->article_id) {
            ArticleImage::create([
                'article_id' => $request->article_id,
                'image_path' => $path,
            ]);
        }

        return response()->json([
            'url' => asset('storage/' . $path)
        ]);
    }
}

<?php

namespace App\Http\Controllers\editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\ArticleImage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('editor.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('editor.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:225',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $data = $request->only('title', 'content');
        $data['user_id'] = Auth::id();
        $data['is_published'] = $request->has('is_published');

        $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $article = Article::create($data);

        $article->categories()->sync($request->input('categories'));

        return redirect()->route('editor.articles.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        if (auth()->user()->role !== 'admin' && $article->user_id !== auth()->id()) {
            abort(403, 'This action is unauthorized.');
        }

        $categories = Category::all();
        return view('editor.articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        if (auth()->user()->role !== 'admin' && $article->user_id !== auth()->id()) {
            abort(403, 'This action is unauthorized.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $data = $request->only('title', 'content');
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $article->update($data);
        $article->categories()->sync($request->input('categories'));

        return redirect()->route('editor.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if (auth()->user()->role !== 'admin' && $article->user_id !== auth()->id()) {
            abort(403, 'This action is unauthorized.');
        }

        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        $article->delete();
        return back()->with('success', 'Artikel berhasil dihapus.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|max:2048',
            'article_id' => 'nullable|exists:articles,id',
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

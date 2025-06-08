<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\LogsActivity;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    use LogsActivity;

    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100|unique:categories,name']);

        $data = $request->only('name');
        $data['slug'] = Str::slug($data['name']);

        $category = Category::create($data);

        $this->logActivity('create', $category);

        return redirect()->route('admin.category.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string|max:100|unique:categories,name,' . $category->id]);

        $data = $request->only('name');
        $data['slug'] = Str::slug($data['name']);

        $category->update($data);

        $this->logActivity('update', $category);

        return redirect()->route('admin.category.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $categoryId = $category->id;
        $categoryClass = get_class($category);

        $category->delete();

        $dummyModel = new $categoryClass;
        $dummyModel->id = $categoryId;

        $this->logActivity('delete', $dummyModel);

        return redirect()->route('admin.category.index')->with('success', 'Kategori berhasil dihapus.');
    }
}

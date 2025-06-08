<?php

namespace App\Http\Controllers\editor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\LogsActivity;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    use LogsActivity;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with('user', 'article')->latest()->paginate(10);
        return view('editor.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->logActivity('delete', $comment);
        $comment->delete();
        return redirect()->route('editor.comments.index')->with('success', 'Komentar berhasil dihapus.');
    }
}

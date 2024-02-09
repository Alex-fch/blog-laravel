<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'article_id' => 'required',
            'content' => 'required|string|max:255',
        ]);

        $request->user()->comment()->create(['content' => $validated['content'], 'article_id' => $validated['article_id']]);

        return redirect(route('articles.show', ['article' => $validated['article_id']]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment, Article $article): View
    {
        return view('comments.edit', [
            'comment' => $comment,
            'article' => $article,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment, Article $article): RedirectResponse
    {
        $this->authorize('update', $comment);

        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $article = $comment->article;

        $comment->update($validated);

        return redirect(route('articles.show', ['article' => $article]),);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment, Article $article): RedirectResponse
    {
        $this->authorize('delete', $comment);

        $article = $comment->article;

        $comment->delete();

        return redirect(route('articles.show', ['article' => $article]));
    }
}

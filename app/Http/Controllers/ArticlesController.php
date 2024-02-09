<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Article;
use App\Models\Comments;
use Illuminate\View\View;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('articles.index', [
            'articles' => Article::with(['user', 'comment' => function ($query) {
                $query->with('user');
            }])->latest()->where('user_id', Auth::user()->id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('articles.create', [
            'tags' => Tag::get(),
            'categories' => Category::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //Validation des données
        $validatedArticle = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'draft' => 'required',
            'is_approved' => 'required',
        ]);
        $validatedCategory = $request->validate([
            'category' => 'required',
        ]);

        $validatedTag = $request->validate([
            'tag' => 'required',
        ]);

        //Créer l'article en BDD
        $article = $request->user()->article()->create($validatedArticle);

        //Créer la relation entre article et catégorie
        $article->category()->attach($validatedCategory);

        //Créer la relation entre article et tag
        $article->tag()->attach($validatedTag);

        return redirect(route('article.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article): View
    {
        return view('articles.show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article): View
    {
        return view('articles.edit', [
            'tags' => Tag::get(),
            'categories' => Category::get(),
            'article' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article): RedirectResponse
    {
        $this->authorize('update', $article);

        //Validation des données
        $validatedArticle = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'draft' => 'required',
            'is_approved' => 'required',
        ]);
        $validatedCategory = $request->validate([
            'category_id' => 'required',
        ]);
        $validatedTag = $request->validate([
            'tag_id' => 'required',
        ]);

        //Update l'article en BDD
        $article->update($validatedArticle);

        //Update la relation entre article et catégorie
        $article->category()->updateExistingPivot($article->id, $validatedCategory);

        //Update la relation entre article et tag
        $article->tag()->updateExistingPivot($article->id, $validatedTag);

        return redirect(route('article.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();

        return redirect(route('article.index'));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'draft',
        'is_approved',
    ];

    /**
     * The relationship between article with user
     * 
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The relationship betwwen article with categories
     * 
     */
    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * The relationship between article with tag
     * 
     */
    public function tag(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * The relationship between article with comment
     * 
     */
    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Articles extends Model
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
    ];

    /**
     * The relationship between article with user
     * 
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The relationship betwwen article with categories
     * 
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Categories::class);
    }

    /**
     * The relationship between article with tag
     * 
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tags::class);
    }

    /**
     * The relationship between article with comment
     * 
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comments::class);
    }
}

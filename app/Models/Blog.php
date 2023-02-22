<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'slug',
        'is_active',
        'content',
        'description',
        'release_at',
    ];

    protected $hidden = [
        'deleted_at'
    ];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'is_active' => 'boolean',
        'description' => 'string',
        'release_at' => 'integer',

    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,  Blog_Categories::class, 'blog_id', 'category_id');
    }
}

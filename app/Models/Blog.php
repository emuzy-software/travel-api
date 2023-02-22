<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql';

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

    protected $appends = [
        'blog_id'
    ];
    public function getBlogIdAttribute()
    {
        return $this->slug . '---' . $this->id;
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,  Blog_Categories::class, 'blog_id', 'category_id');
    }
}

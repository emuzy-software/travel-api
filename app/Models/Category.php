<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql';
    protected $table = 'categories';
    protected $fillable = [
        'title',
        'slug',
        'is_active',
        'total_blog',
        'image',
        'description',
    ];
    protected $casts = [
        'is_active' => 'boolean'
    ];

    protected $hidden = [
        'deleted_at', 'pivot'
    ];
}

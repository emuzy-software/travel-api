<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog_Categories extends Model
{
    protected $connection = 'mysql';

    protected $table = 'blog_categories';
    protected $fillable = [
        'blog_id',
        'category_id',
    ];
    public $timestamps = false;
}

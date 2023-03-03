<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'experiences';

    protected $fillable = [
        'title',
        'slug',
        'is_active',
        'image',
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
}

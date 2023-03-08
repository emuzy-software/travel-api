<?php

namespace App\Repositories;

use App\Helpers\Repository\BaseRepository;
use App\Models\Blog_Categories;

class CategoryBlogRepository extends BaseRepository  implements CategoryBlogRepositoryInterface
{
    protected $model;

    public function __construct(Blog_Categories $model)
    {
        $this->model = $model;
    }
    public function getByBlog_cateId(int $blog_cateId): ?Blog_Categories
    {
        return $this->model
            ->where('id', $blog_cateId)
            ->first();
    }
}

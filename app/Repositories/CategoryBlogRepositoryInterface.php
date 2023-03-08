<?php

namespace App\Repositories;

use App\Helpers\Repository\BaseRepositoryInterface;
use App\Models\Blog_Categories;

interface CategoryBlogRepositoryInterface extends BaseRepositoryInterface
{
    public function getByBlog_cateId(int $blog_cateId): ?Blog_Categories;
}

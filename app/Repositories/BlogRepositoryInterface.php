<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Helpers\Repository\BaseRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface BlogRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param array $conditions
     * @param array $orderBy
     * @return LengthAwarePaginator
     */
    public function getBlogList(array $conditions, array $orderBy): LengthAwarePaginator;

    /**
     * @param int $BlogId
     * @return Blog|null
     */
    public function getByBlogId(int $blogId): ?Blog;
}

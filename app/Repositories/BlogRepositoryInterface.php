<?php

namespace App\Repositories;

use App\Models\Blog;
use Illuminate\Pagination\LengthAwarePaginator;

interface BlogRepositoryInterface
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
    public function getById(int $mangaId): ?Blog;
}

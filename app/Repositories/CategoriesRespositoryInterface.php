<?php

namespace App\Repositories;

use App\Helpers\Repository\BaseRepositoryInterface;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoriesRespositoryInterface extends BaseRepositoryInterface
{
    public function getCategories(?string $searchText, array $orderBy): LengthAwarePaginator;

    public function getByCategoryId(int $id): ?Category;
}

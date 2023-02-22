<?php

namespace App\Repositories;


use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoriesRespositoryInterface
{
    public function getCategories(?string $searchText, array $orderBy): LengthAwarePaginator;

    public function getById(int $id): ?Category;
}

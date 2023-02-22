<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Models\Blog;
use Illuminate\Pagination\LengthAwarePaginator;

class BlogRepository implements BlogRepositoryInterface
{
    protected $model;

    public function __construct(Blog $model)
    {
        $this->model = $model;
    }

    public function getBlogList(array $conditions, array $orderBy): LengthAwarePaginator
    {
        $query = Blog::query()
            ->with(['categories:id,title,description'])
            ->where('is_active', true);
        $searchText = $conditions['search_text'] ?? null;
        if (!empty($searchText)) {
            $query = $query->where('title', 'like', '%' . $searchText . '%')
                ->orWhere('description', 'like', '%' . $searchText . '%');
        }

        if (!empty($conditions['blog_ids'])) {
            $query = $query->whereIn('id', $conditions['blog_ids']);
        }

        if (!empty($orderBy)) {
            foreach ($orderBy as $field => $direction) {
                $query = $query->orderBy($field, $direction);
            }
        }

        return $query->paginate(Helper::getPerPage(), ["*"], Helper::getPageName(), Helper::getCurrentPage());
    }

    public function getById(int $mangaId): ?Blog
    {
        return $this->model
            ->with([
                'categories:id,title,is_active,description',
            ])
            //            ->whereHas('categories', function ($q) {
            //                $q->where('is_active', true);
            //            })
            //            ->whereHas('characters', function ($q) {
            //                $q->where('is_active', true);
            //            })
            ->where('id', $mangaId)
            ->where('is_active', true)
            ->first();
    }
}
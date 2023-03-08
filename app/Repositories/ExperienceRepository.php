<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Helpers\Repository\BaseRepository;
use App\Models\Experience;
use Illuminate\Pagination\LengthAwarePaginator;

class ExperienceRepository extends BaseRepository  implements ExperienceRepositoryInterface
{
    protected $model;

    public function __construct(Experience $model)
    {
        $this->model = $model;
    }

    public function getExperienceList(array $conditions, array $orderBy): LengthAwarePaginator
    {
        $query = Experience::query()
            ->where('is_active', true);
        $searchText = $conditions['search_text'] ?? null;
        if (!empty($searchText)) {
            $query = $query->where('title', 'like', '%' . $searchText . '%')
                ->orWhere('description', 'like', '%' . $searchText . '%');
        }

        if (!empty($conditions['experience_ids'])) {
            $query = $query->whereIn('id', $conditions['experience_ids']);
        }

        if (!empty($orderBy)) {
            foreach ($orderBy as $field => $direction) {
                $query = $query->orderBy($field, $direction);
            }
        }

        return $query->paginate(Helper::getPerPage(), ["*"], Helper::getPageName(), Helper::getCurrentPage());
    }

    public function getByExperienceId(int $experienceId): ?Experience
    {
        return $this->model
            ->where('id', $experienceId)
            ->where('is_active', true)
            ->first();
    }
}

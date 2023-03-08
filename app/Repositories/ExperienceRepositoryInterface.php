<?php

namespace App\Repositories;

use App\Helpers\Repository\BaseRepositoryInterface;
use App\Models\Experience;
use Illuminate\Pagination\LengthAwarePaginator;

interface ExperienceRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param array $conditions
     * @param array $orderBy
     * @return LengthAwarePaginator
     */
    public function getExperienceList(array $conditions, array $orderBy): LengthAwarePaginator;

    /**
     * @param int $ExperienceId
     * @return Experience|null
     */
    public function  getByExperienceId(int $experienceId): ?Experience;
}

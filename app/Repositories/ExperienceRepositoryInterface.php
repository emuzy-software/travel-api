<?php

namespace App\Repositories;

use App\Models\Experience;
use Illuminate\Pagination\LengthAwarePaginator;

interface ExperienceRepositoryInterface
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
    public function getById(int $experienceId): ?Experience;
}

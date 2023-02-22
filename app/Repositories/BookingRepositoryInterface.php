<?php

namespace App\Repositories;

use App\Helpers\Repository\BaseRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface BookingRepositoryInterface extends BaseRepositoryInterface
{
    public function BookingList(array $orderBy): LengthAwarePaginator;
}

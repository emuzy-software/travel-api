<?php

namespace App\Repositories;

use App\Helpers\Repository\BaseRepositoryInterface;
use App\Models\Booking;
use Illuminate\Pagination\LengthAwarePaginator;

interface BookingRepositoryInterface extends BaseRepositoryInterface
{
    public function BookingList(array $orderBy): LengthAwarePaginator;
    public function getByBookingId(int $bookingId): ?Booking;
}

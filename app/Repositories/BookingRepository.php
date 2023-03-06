<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Helpers\Repository\BaseRepository;
use App\Models\Booking;
use Illuminate\Pagination\LengthAwarePaginator;

class BookingRepository extends BaseRepository implements BookingRepositoryInterface
{
    protected $model;

    public function __construct(Booking $model)
    {
        $this->model = $model;
    }

    public function BookingList(array $orderBy): LengthAwarePaginator
    {
        $query = Booking::query()->where('is_active', true);

        if (!empty($orderBy)) {
            foreach ($orderBy as $field => $direction) {
                $query = $query->orderBy($field, $direction);
            }
        }

        return $query->paginate(Helper::getPerPage(), ["*"], Helper::getPageName(), Helper::getCurrentPage());
    }
    public function getByBookingId(int $bookingId): ?Booking
    {
        return $this->model
            ->where('id', $bookingId)
            ->first();
    }
}

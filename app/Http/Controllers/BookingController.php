<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Repositories\BookingRepositoryInterface;
use App\Requests\Booking\BookingRequest;
use App\Requests\Booking\UpdateBookingRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    protected $bookingRepository;


    public function __construct(BookingRepositoryInterface $bookingRepository)
    {
        parent::__construct();
        $this->bookingRepository = $bookingRepository;
    }

    public function index(Request $request): JsonResponse
    {
        $data = $request->only(['sort_by', 'sort_direction']);

        $orderListFiled = ['id', 'name', 'phone_number', 'created_at', 'updated_at'];
        $orderBy = Helper::orderBy($data['sort_by'] ?? null, $data['sort_direction'] ?? null, $orderListFiled);
        $bookingList = $this->bookingRepository->BookingList($orderBy);

        return $this->successWithPaginate(__('general.success'), $bookingList);
    }
    public function show(string $bookingId): JsonResponse
    {
        $booking = $this->bookingRepository->getByBookingId($bookingId);
        if (empty($booking)) {
            return $this->error(__('general.not_found'), [], 404);
        }
        $booking = $booking->toArray();
        return $this->success(__('general.success'), $booking, 200);
    }
    public function store(BookingRequest $request): JsonResponse
    {
        $data = $request->only([
            'name',
            'phone_number',
            'pickup_location',
            'destination',
            'hire_date',
            'vehicle_type',
        ]);

        $booking = $this->bookingRepository->create($data);
        if (empty($booking)) {
            return $this->error(__('general.server_error'), null, 500);
        }
        return $this->success(__('general.success'), $booking);
    }
    public function update(UpdateBookingRequest $request, $bookingId): JsonResponse
    {
        $data = $request->only(['is_active']);

        $booking = $this->bookingRepository->getByBookingId($bookingId);
        if (empty($booking)) {
            return $this->error(__('general.booking_not_found'), null, 404);
        }

        $booking = $this->bookingRepository->updateById($bookingId, $data);
        if (empty($booking)) {
            return $this->error(__('general.server_error'), null, 500);
        }

        return $this->success(__('general.success'), $booking);
    }
    public function destroy($bookingId): JsonResponse
    {
        $booking = $this->bookingRepository->getByBookingId($bookingId);
        if (empty($booking)) {
            return $this->error(__('general.booking_not_found'), null, 404);
        }

        $booking = $this->bookingRepository->deleteById($bookingId);
        if (empty($booking)) {
            return $this->error(__('general.server_error'), null, 500);
        }

        return $this->success(__('general.success'), true);
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Repositories\BookingRepositoryInterface;
use App\Requests\Booking\BookingRequest;
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
}

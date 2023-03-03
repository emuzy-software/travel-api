<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Repositories\ExperienceRepositoryInterface;
use Illuminate\Http\JsonResponse;
use App\Helpers\Helper;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{


    protected $experienceRepository;

    public function __construct(ExperienceRepositoryInterface $experienceRepository)
    {
        parent::__construct();
        $this->experienceRepository = $experienceRepository;
    }

    public function index(Request $request): JsonResponse
    {
        $data['experience_ids'] = [];

        $orderListFiled = ['id', 'title', 'description', 'created_at', 'updated_at'];
        $orderBy = Helper::orderBy($request->get('sort_by'), $request->get('sort_direction'), $orderListFiled);

        $experienceList = $this->experienceRepository->getexperienceList($data, $orderBy);

        return $this->successWithPaginate(__('general.success'), $experienceList);
    }

    public function show(string $experienceId): JsonResponse
    {
        $experience = $this->experienceRepository->getById($experienceId);
        if (empty($experience)) {
            return $this->error(__('general.not_found'), [], 404);
        }
        $experience = $experience->toArray();
        return $this->success(__('general.success'), $experience, 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Repositories\ExperienceRepositoryInterface;
use Illuminate\Http\JsonResponse;
use App\Helpers\Helper;
use App\Requests\Experience\ExperienceRequest;
use App\Requests\Experience\UpdateExperienceRequest;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{


    protected $experienceRepository;

    public function __construct(ExperienceRepositoryInterface $experienceRepository)
    {
        parent::__construct();
        $this->experienceRepository = $experienceRepository;
    }
    public function store(ExperienceRequest $request): JsonResponse
    {
        $data = $request->only([

            'title',
            'slug',
            'is_active',
            'image',
            'description',
        ]);

        $experience = $this->experienceRepository->create($data);
        if (empty($experience)) {
            return $this->error(__('general.server_error'), null, 500);
        }
        return $this->success(__('general.success'), $experience);
    }
    public function update(UpdateExperienceRequest $request, $experienceId): JsonResponse
    {
        $data = $request->only([
            'title',
            'slug',
            'is_active',
            'image',
            'description',
        ]);

        $experience = $this->experienceRepository->getByExperienceId($experienceId);
        if (empty($experience)) {
            return $this->error(__('general.experience_not_found'), null, 404);
        }

        $experience = $this->experienceRepository->updateById($experienceId, $data);
        if (empty($experience)) {
            return $this->error(__('general.server_error'), null, 500);
        }

        return $this->success(__('general.success'), $experience);
    }
    public function destroy($experienceId): JsonResponse
    {
        $experience = $this->experienceRepository->getByexperienceId($experienceId);
        if (empty($experience)) {
            return $this->error(__('general.experience_not_found'), null, 404);
        }

        $experience = $this->experienceRepository->deleteById($experienceId);
        if (empty($experience)) {
            return $this->error(__('general.server_error'), null, 500);
        }

        return $this->success(__('general.success'), true);
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

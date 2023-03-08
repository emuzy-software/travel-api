<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\JsonResponse;
use App\Repositories\CategoriesRespositoryInterface;
use App\Requests\Categories\CategoryRequest;
use App\Requests\Categories\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoriesRespositoryInterface $categoryRepository)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request): JsonResponse
    {
        $data = $request->only(['search_text', 'sort_by', 'sort_direction']);

        $orderListFiled = ['id', 'title', 'description', 'created_at', 'updated_at'];
        $orderBy = Helper::orderBy($data['sort_by'] ?? null, $data['sort_direction'] ?? null, $orderListFiled);

        $categories = $this->categoryRepository->getCategories($data['search_text'] ?? '', $orderBy);

        return $this->successWithPaginate(__('general.success'), $categories);
    }
    public function show(string $categoryId): JsonResponse
    {
        $category = $this->categoryRepository->getByCategoryId($categoryId);
        if (empty($category)) {
            return $this->error(__('general.not_found'), [], 404);
        }
        $category = $category->toArray();
        return $this->success(__('general.success'), $category, 200);
    }
    public function store(CategoryRequest $request): JsonResponse
    {
        $data = $request->only([
            'title',
            'slug',
            'is_active',
            'description',
        ]);

        $category = $this->categoryRepository->create($data);
        if (empty($category)) {
            return $this->error(__('general.server_error'), null, 500);
        }
        return $this->success(__('general.success'), $category);
    }
    public function update(UpdateCategoryRequest $request, $categoryId): JsonResponse
    {
        $data = $request->only([
            'title',
            'slug',
            'is_active',
            'description',
        ]);

        $category = $this->categoryRepository->getByCategoryId($categoryId);
        if (empty($category)) {
            return $this->error(__('general.category_not_found'), null, 404);
        }

        $category = $this->categoryRepository->updateById($categoryId, $data);
        if (empty($category)) {
            return $this->error(__('general.server_error'), null, 500);
        }

        return $this->success(__('general.success'), $category);
    }
    public function destroy($categoryId): JsonResponse
    {
        $category = $this->categoryRepository->getByCategoryId($categoryId);
        if (empty($category)) {
            return $this->error(__('general.category_not_found'), null, 404);
        }

        $category = $this->categoryRepository->deleteById($categoryId);
        if (empty($category)) {
            return $this->error(__('general.server_error'), null, 500);
        }

        return $this->success(__('general.success'), true);
    }
}

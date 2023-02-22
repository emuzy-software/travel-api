<?php

namespace App\Http\Controllers;

use App\Repositories\CategoriesRespositoryInterface;
use App\Repositories\BlogRepositoryInterface;
use Illuminate\Http\JsonResponse;
use App\Helpers\Helper;
use App\Models\Blog_Categories;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $categoryRepository;

    protected $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository, CategoriesRespositoryInterface $categoryRepository)
    {
        parent::__construct();
        $this->blogRepository = $blogRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request): JsonResponse
    {
        $data = $request->only(['category_id', 'search_text', 'type']);
        $data['blog_ids'] = [];

        $orderListFiled = ['id', 'title', 'description', 'created_at', 'updated_at'];
        $orderBy = Helper::orderBy($request->get('sort_by'), $request->get('sort_direction'), $orderListFiled);

        if (!empty($data['category_id'])) {
            $category = $this->categoryRepository->getById($data['category_id']);
            if (empty($category)) {
                return $this->error(__('general.not_found_category'), [], 404);
            }

            $categoryBlogIds = Blog_Categories::query()
                ->where('category_id', $data['category_id'])
                ->pluck('blog_id')
                ->toArray();
            if (empty($categoryBlogIds)) {
                return $this->successWithPaginateNull(__('general.success'));
            }

            $data['blog_ids'] = $categoryBlogIds;
        }

        $blogList = $this->blogRepository->getBlogList($data, $orderBy);

        return $this->successWithPaginate(__('general.success'), $blogList);
    }

    public function show(string $blogId): JsonResponse
    {
        $blog = $this->blogRepository->getById($blogId);
        if (empty($blog)) {
            return $this->error(__('general.not_found'), [], 404);
        }
        $blog = $blog->toArray();
        return $this->success(__('general.success'), $blog, 200);
    }
}

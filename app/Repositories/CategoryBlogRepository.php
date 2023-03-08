<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Helpers\Repository\BaseRepository;
use App\Models\Blog_Categories;

class CategoryBlogRepository extends BaseRepository  implements CategoryBlogRespositoryInterface
{
    protected $model;

    public function __construct(Blog_Categories $model)
    {
        $this->model = $model;
    }
}

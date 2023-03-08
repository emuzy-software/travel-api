<?php

namespace App\Requests\Categories;

use App\Requests\ApiRequest;

class UpdateCategoryRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title' => 'required|min:3',
            'slug' => 'required|min:3',
            'is_active' => 'required|boolean',
            'description' => 'required'
        ];
    }
}

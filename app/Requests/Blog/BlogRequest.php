<?php

namespace App\Requests\Blog;

use App\Requests\ApiRequest;

class BlogRequest extends ApiRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3',
            'slug' => 'required|min:3',
            'category_id' => 'required',
            'is_active' => 'required|boolean',
            'content' => 'required|min:3',
            'description' => 'required|min:3',

        ];
    }
}

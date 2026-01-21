<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|unique:blogs,title',
            'category' => 'required',
            'short_des' => 'required',
            'tags' => 'required',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
                'title' => 'required|unique:blogs,title,'.request()->id.',id',
                'slug' => 'required|unique:blogs,slug,'.request()->id.',id',
                'category' => 'required',
                'short_des' => 'required',
                'tags' => 'required',
            ];
        }
        return $rules;
    }

    public function messages(){
        return [
            'title.required' => 'This Blog is already Exists',
            'category.required' => 'This Blog Category is required',
            'tags.required' => 'This Blog Tags is required',
            'description.required' => 'This Blog Description is Required',
        ];
    }
}

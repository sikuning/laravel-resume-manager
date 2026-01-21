<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PortfolioRequest extends FormRequest
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
            'title' => 'required|unique:portfolio,title',
            'category' => 'required',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
                'title' => 'required',Rule::unique('portfolio','title')->ignore($this->id),
                'category' => 'required',
        ];
        }
        return $rules;
    }

    public function messages(){
        return [
            'title.required' => 'This Portfolio is already Exists',
            'category.required' => 'This Category is required',
            'status.required' => 'This Status is required',
        ];
    }
}

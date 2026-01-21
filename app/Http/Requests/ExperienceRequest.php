<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExperienceRequest extends FormRequest
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
            'title' => 'required|unique:experience,designation',
            'company' => 'required',
            'from_year' => 'required',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
                'title' => 'required',Rule::unique('experience','designation')->ignore($this->id),
                'company' => 'required',
                'from_year' => 'required',
            ];
        }
        return $rules;
    }

    public function messages(){
        return [
            'title.required' => 'This Experience is already Exists',
            'comapny.required' => 'This Comapny is required',
            'from_year.required' => 'From year is required',
        ];
    }
}

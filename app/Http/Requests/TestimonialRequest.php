<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TestimonialRequest extends FormRequest
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
            'client_name' => 'required',
            'des' => 'required',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
                'client_name' => 'required',
                'des' => 'required',
            ];
        }
        return $rules;
    }

    public function messages(){
        return [
            'client_name.required' => 'Client Name is required',
            'des.required' => 'Feedback is required',
            'status.required' => 'Status is required',
        ];
    }
}

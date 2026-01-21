<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserServiceRequest extends FormRequest
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
            'title' => 'required|unique:user_service,title',
            'des' => 'required',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
                'title' => 'required',Rule::unique('user_service','title')->ignore($this->id),
                'des' => 'required',
            ];
        }
        return $rules;
    }

    public function messages(){
        return [
            'title.required' => 'This User Service is already Exists',
            'des.required' => 'This User Service Description is required',
            'status.required' => 'This Status is required',
        ];
    }
}

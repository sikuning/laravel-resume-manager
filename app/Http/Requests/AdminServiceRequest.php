<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminServiceRequest extends FormRequest
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
            'title' => 'required|unique:admin_service,title',
            'des' => 'required',
        ];
        
        return $rules;
    }

    public function messages(){
        return [
            'title.unique' => 'This Admin Service is already Exists',
            'des.required' => 'This Admin Service Description is required',
            'status.required' => 'This Status is required',
        ];
    }
}

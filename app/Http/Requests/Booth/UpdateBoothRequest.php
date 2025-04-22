<?php

namespace App\Http\Requests\Booth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBoothRequest extends FormRequest
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
        return [
            'title'       => 'nullable|string',
            'description' => 'nullable|string',
            'images'      => 'nullable|array|max:4',
            'images.*'    => 'nullable|mimes:jpg,png,jpeg'
        ];
    }
}

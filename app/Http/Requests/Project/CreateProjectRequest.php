<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
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
            'category_id'     => 'required|string|exists:categories,id',
            'title'           => 'required|string',
            'description_one' => 'required|string',
            'description_two' => 'required|string',
            'deadline'        => 'required|string',
            'location'        => 'required|string',
            'images'          => 'required|array|max:3|min:3',
            'images.*'        => 'required|mimes:jpg,png,jpeg',
        ];
    }
}

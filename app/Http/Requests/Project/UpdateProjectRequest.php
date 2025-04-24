<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'category_id'     => 'nullable',
            'title'           => 'nullable|string',
            'description_one' => 'nullable|string',
            'description_two' => 'nullable|string',
            'deadline'        => 'nullable|string',
            'location'        => 'nullable|string',
        ];
    }
}

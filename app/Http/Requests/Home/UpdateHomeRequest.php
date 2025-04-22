<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHomeRequest extends FormRequest
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
            'whatsapp_link'     => 'nullable|string',
            'printed_projects'  => 'nullable|integer',
            'printing_services' => 'nullable|integer',
            'clients'           => 'nullable|integer',
            'phone_number'      => 'nullable|string',
            'email'             => 'nullable|string',
            'location'          => 'nullable|string',
        ];
    }
}

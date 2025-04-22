<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class CreateHomeRequest extends FormRequest
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
            'whatsapp_link'     => 'required|string',
            'printed_projects'  => 'required|integer',
            'printing_services' => 'required|integer',
            'clients'           => 'required|integer',
            'phone_number'      => 'required|string',
            'email'             => 'required|string',
            'location'          => 'required|string',
        ];
    }
}

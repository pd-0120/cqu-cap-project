<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocationRequest extends FormRequest
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
            'name' => 'required|max:30',
            'street' => 'required|max:30',
            "phone" => ['required', 'regex:/^(?:\+61|0)[2-478](?:[ -]?[0-9]){8}$/'],
            'suburb' => 'required|max:30',
            'state' => 'required|max:30',
            'pincode' => 'required|max:30',
        ];
    }
}

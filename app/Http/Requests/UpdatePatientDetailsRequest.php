<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePatientDetailsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function attributes()
    {
        return [
            "first_name" => "First Name",
            "last_name" => "Last Name",
            "emergency_contact" => "Emergency Contact Name",
            "emergency_phone" => "Emergency Contact Phone",
            "medical_history" => "Medical History",
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "first_name" => ['required', 'max:25'],
            "last_name" => ['required', 'max:25'],
            "phone" => ['required', 'regex:/^(?:\+61|0)[2-478](?:[ -]?[0-9]){8}$/'],
            "email" => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($this->_patient_id)],
            "emergency_contact" => ['required', 'max:50'],
            "emergency_phone" => ['required', 'regex:/^(?:\+61|0)[2-478](?:[ -]?[0-9]){8}$/'],
            "medical_history" => ['sometimes', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'The phone number format is invalid. It must be a valid Australian number.',
            'emergency_phone.regex' => 'The phone number format is invalid. It must be a valid Australian number.',
        ];
    }
}

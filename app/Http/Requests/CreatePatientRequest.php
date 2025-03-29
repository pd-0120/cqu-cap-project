<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreatePatientRequest extends FormRequest
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
            "first_name" => ['required','max:25'],
            "last_name" => ['required','max:25'],
            "phone" => ['required'],
            "email" => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            "emergency_contact" => ['required','max:25'],
            "emergency_phone" => ['required'],
            "medical_history" => ['sometimes', 'max:200'],
        ];
    }
}

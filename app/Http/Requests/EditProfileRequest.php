<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'firstname' => 'nullable|string|max:24',
            'lastname' => 'nullable|string|max:24',
            'birthdate' => 'nullable|date|before:today',
            'profile_img' => 'nullable|image|mimes:jpg,jpeg,png|max:6000',
        ];
    }
}

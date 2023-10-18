<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InformationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => 'required|string|min:3|max:255',
            'lastName' => 'required|string|min:3|max:255',
            'surName' => 'required|string|min:3|max:255',
            'address' => 'required|string|min:3|max:255',
            'emailAddress' => 'required|email',
            'phoneNumber' => 'required|string|min:3|max:20',
            'region' => 'required|string|min:3|max:255',
            'pincode' => 'required|string|min:3|max:255',
            'country' => 'required|string|min:3|max:255',
            'state' => 'required|string|min:3|max:255',
            'city' => 'required|string|min:3|max:255',
            'qualification' => 'required|string|min:3|max:255',
            'birth_date' => 'required|before:today',
            'genderOption' => 'required|string|min:3|max:15',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'fileResume' => 'required|mimes:pdf|max:255',
            'password' => 'required|confirmed|min:8|max:255',
        ];
    }
}

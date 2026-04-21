<?php

namespace App\Http\Requests\CMS\Common;

use Illuminate\Foundation\Http\FormRequest;

class AboutPertnershipSectionRequest extends FormRequest
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
            'logo' => 'nullable|file|mimes:jpeg,jpg,png|max:5120', // 5MB
            'title' => 'required|string|max:500',
            'description' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,jpg,png|max:5120', // 5MB
        ];
    }
}

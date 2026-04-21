<?php

namespace App\Http\Requests\CMS\About;

use Illuminate\Foundation\Http\FormRequest;

class AboutPageOurValuesSectionRequest extends FormRequest
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
            'main_text' => 'nullable|string|max:2000',
            'parts' => 'required|array|min:1|max:3',
            'parts.*.title' => 'required|string|max:255',
            'parts.*.description' => 'required|string|max:3000',
        ];
    }
}

<?php

namespace App\Http\Requests\CMS\Buy;

use Illuminate\Foundation\Http\FormRequest;

class BuyPageGetClaritySectionRequest extends FormRequest
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
            'title' => 'required|string|max:500',
            'description' => 'required|string',
            'button_text' => 'required|string|max:100',
            'link_url' => 'nullable|url|max:500',
            'image' => 'nullable|file|mimes:jpeg,jpg,png|max:5120', // 5MB
        ];
    }
}

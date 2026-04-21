<?php

namespace App\Http\Requests\CMS\Buy;

use Illuminate\Foundation\Http\FormRequest;

class BuyPageCostConsiderBuyingPropertySectionRequest extends FormRequest
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
            'main_text' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'parts' => 'nullable|array',
            'parts.*.key_title' => 'required|string|max:255',
            'parts.*.points' => 'required|array|min:1',
            'parts.*.points.*.point_title' => 'required|string|max:500',
        ];
    }
}

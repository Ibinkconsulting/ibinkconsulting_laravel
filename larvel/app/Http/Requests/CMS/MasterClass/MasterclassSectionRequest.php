<?php

namespace App\Http\Requests\CMS\MasterClass;

use Illuminate\Foundation\Http\FormRequest;

class MasterclassSectionRequest extends FormRequest
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
            'video' => 'nullable|file|mimes:mp4,webm,ogv,avi,mkv|max:51200', // 50MB
            'title' => 'required|string|max:500',
            'sub_title' => 'required|string',
            'description' => 'required|string',
            'button_text' => 'required|string|max:100',
        ];
    }
}

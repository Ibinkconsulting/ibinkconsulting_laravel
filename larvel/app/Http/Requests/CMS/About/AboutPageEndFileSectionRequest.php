<?php

namespace App\Http\Requests\CMS\About;

use Illuminate\Foundation\Http\FormRequest;

class AboutPageEndFileSectionRequest extends FormRequest
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
            'type' => 'required|in:image,video',
            'video' => 'nullable|file|mimes:mp4,webm,ogv,avi,mkv|max:51200',
            'image' => 'nullable|file|mimes:png,jpg,jpeg|max:51200',
        ];
    }
}

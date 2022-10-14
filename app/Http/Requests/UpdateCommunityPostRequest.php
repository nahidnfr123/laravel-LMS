<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommunityPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'photo' => 'nullable|sometimes|image|mimes:jpg,png,jpeg,gif,svg|max:4048',
            'description' => 'required',
            'publish_at' => '',
            'is_published' => '',
            'is_public' => '',
        ];
    }
}

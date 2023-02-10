<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEstateRequest extends FormRequest
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
            'title' => ['required', 'max:255', Rule::unique('estates')->ignore($this->estate)],
            
            'description' => ['nullable'],
            'type' => ['required'],
            'room_number' => ['required'],
            'bed_number' => ['required'],
            'bathroom_number' => ['required'],
            'detail' => ['nullable'],
            'price' => ['nullable'],
            'mq' => ['nullable'],
            'cover_img' => ['nullable', 'max:550', 'image'],
            'images.*' => ['nullable', 'max:550', 'image'],
            'images' => ['max:4'],
            'is_visible' => ['nullable'],
            'user_id' => ['exists:users,id'],
            'services' => ['required', 'exists:services,id']
        ];
    }
}

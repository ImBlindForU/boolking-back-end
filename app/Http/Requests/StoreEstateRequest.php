<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstateRequest extends FormRequest
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
            'title' => ['required', 'max:255', 'unique:estates'],
            'description' => ['nullable'],
            'type' => ['required'],
            'room_number' => ['required'],
            'bed_number' => ['required'],
            'bathroom_number' => ['required'],
            'detail' => ['nullable'],
            'price' => ['nullable'],
            'mq' => ['nullable'],
            'cover_img' => ['required', 'max:550', 'image'],
            'is_visible' => ['nullable'],
            'user_id' => ['exists:users,id'],
            'services' => ['required', 'exists:services,id']
        ];
    }
}

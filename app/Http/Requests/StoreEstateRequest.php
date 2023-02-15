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
            'street' => ['required', 'max:255'],
            'city' => ['required', 'max:255'],
            'country' => ['required', 'max:255'],
            'street_code' => ['required', 'max:35'],
            'cap' => ['required', 'numeric'],
            'description' => ['nullable'],
            'type' => ['required'],
            'room_number' => ['required','integer'],
            'bed_number' => ['required','integer'],
            'bathroom_number' => ['required','integer'],
            'detail' => ['nullable'],
            'price' => ['nullable'],
            'mq' => ['required','integer'],
            'cover_img' => ['required', 'max:550', 'image'],
            'images.*' => ['nullable', 'max:550', 'image'],
            'images' => ['max:4'],
            'is_visible' => ['nullable'],
            'user_id' => ['exists:users,id'],
            'services' => ['required', 'exists:services,id']
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Il titolo è obbligatorio',
            'title.max' => 'Il titolo può avere al massimo 255 caratteri',
            'title.unique' => 'Il titolo inserito è già presente nel nostro database',
            'street.required' => "L'indirizzo è obbligatorio",
            'street.max' => "L'indirizzo può avere al massimo 255 caratteri",
            'city.required' => "La città è obbligatorio",
            'city.max' => "La città può avere al massimo 255 caratteri",
            'country.required' => "Il paese è obbligatorio",
            'country.max' => "Il paese può avere al massimo 255 caratteri",
            'street_code.required' => "Il numero civico è obbligatorio",
            'street_code.max' => "Il numero civico può avere al massimo 255 caratteri",
            'type.required' => 'La tipologia è obbligatoria',
            'room_number.required' => 'Il numero di stanze è obbligatorio',
            'bed_number.required' => 'Il numero di letti è obbligatorio',
            'bathroom_number.required' => 'Il numero di bagni è obbligatorio',
            'cover_img.required' => "L'immagine di copertina è obbligatoria",
            'cover_img.max' => "L'immagine di copertina non può superare 550kb",
            'cover_img.image' => "L'immagine di copertina deve essere un file di tipo immagine",
            'images.*.max' => "Le immagini non possono superare 550kb",
            'images.*.image' => "Le immagini devono essere un file di tipo immagine",
            'images.max' => 'Le immagini non possono essere più di 4',
            'services.required' => 'Inserisci almeno un servizio',
            'mq.required' => 'I metri quadri sono obbligatori'
        ];
    }
}

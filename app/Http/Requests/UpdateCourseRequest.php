<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'course_date' => 'required',
            'duration' => 'required',
            'learned_notions' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => 'Veuillez sélectionner une date',
            'duration.required' => 'Veuillez saisir une durée',
            'learned_notions.required' => 'Veuillez préciser les notions abordées durant le cours',
        ];
    }
}

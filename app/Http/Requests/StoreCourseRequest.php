<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'student' => 'required',
            'invoice' => 'required',
            'course_date' => 'required',
            'duration' => 'required',
            'learned_notions' => 'required',
            'hourly_rate' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'student.required' => 'Veuillez sélectionner un étudiant',
            'invoice.required' => 'Veuillez choisir une facture',
            'date.required' => 'Veuillez sélectionner une date',
            'duration.required' => 'Veuillez saisir une durée',
            'learned_notions.required' => 'Veuillez préciser les notions abordées durant le cours',
            'hourly_rate.required' => 'Veuillez saisir un taux horaire',
        ];
    }
}

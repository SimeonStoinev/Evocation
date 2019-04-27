<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class CreateGradeRequest extends FormRequest
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
        App::setLocale('bg');

        return [
            'title' => 'required|max:190',
            'school_id' => 'required|gt:0',
            'classteacher_id' => 'required|gt:0',
            'shift' => 'required|gt:0'
        ];
    }
}

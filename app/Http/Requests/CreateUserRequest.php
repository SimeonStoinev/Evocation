<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|string|max:190',
            'family' => 'required|string|max:190',
            'email' => 'required|string|email|max:190|unique:users',
            'password' => 'required|string|min:6|max:190',
            'rank' => [
                'required',
                Rule::in(['headmaster', 'subheadmaster', 'teacher', 'student', 'parent'])
            ],
            'is_classteacher' => 'lte:1',
            'school_id' => '',
            'grade' => ''
        ];
    }
}

<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;


class UpdateRequest extends FormRequest
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
            'name' => ['sometimes', 'string', 'max:255'],
            'surname' => ['sometimes', 'string', 'max:255'],
            'number' => ['sometimes', 'integer', 'nullable', 'digits:11', 'unique:abouts,number,' . auth()->user()->id],
            'email' => ['sometimes', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->user()->id],
            'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
        ];
    }
}

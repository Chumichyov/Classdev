<?php

namespace App\Http\Requests\Task\File\Review;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'type_id' => ['required', 'integer'],
            'first' => ['required', 'integer', 'min:1'],
            'last' => ['required', 'integer', 'min:1'],
            'description' => ['string', 'max:300']
        ];
    }
}

<?php

namespace App\Http\Requests\Task;

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
            'title' => ['sometimes', 'required', 'string'],
            'description' => ['sometimes', 'required', 'string'],
            'theme_id' => ['integer', 'nullable'],
            'type_id' => ['sometimes', 'required', 'integer'],
            'theme' => ['sometimes', 'required', 'string'],
            'files' => '',
            'files.*' => 'file|mimetypes:application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,text/plain,text/html,text/css,text/javascript,image/svg+xml,image/tiff,image/png,image/jpeg',

        ];
    }
}

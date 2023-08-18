<?php

namespace App\Http\Requests\Pages\Comments;

use App\Helpers\RedirectHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class GetCommentListRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'post_id' => 'nullable|string|exists:posts,id',
            'content' => 'nullable|string'
        ];
    }

    /**
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator) {RedirectHelper::failedValidation($validator); }
}

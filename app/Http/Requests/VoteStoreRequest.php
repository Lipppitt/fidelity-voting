<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoteStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'vote_id' => 'required'
        ];
    }
}

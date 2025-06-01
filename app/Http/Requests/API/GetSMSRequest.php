<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\ValidationRule;

/**
 * @property int          activation
 * @mixin APIRequest
 */
class GetSMSRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'activation' => ['required', 'integer', 'min:1'],
        ];
    }
}

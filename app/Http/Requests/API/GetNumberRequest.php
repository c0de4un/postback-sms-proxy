<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\ValidationRule;

/**
 * @property string          country
 * @property string          service
 * @property int|null        rent_time
 * @mixin APIRequest
 */
class GetNumberRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'country' => ['required', 'string', 'min:2', 'max:2'],
            'service' => ['required', 'string', 'min:2', 'max:2'],
            'rent_time'    => ['integer', 'min:0', 'max:999'],
        ];
    }
}

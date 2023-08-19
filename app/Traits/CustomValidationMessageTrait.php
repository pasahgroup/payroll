<?php
namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
trait CustomValidationMessageTrait
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(ajaxResponse(422, 'The given data was invalid.', $validator->errors(), []));
    }
}

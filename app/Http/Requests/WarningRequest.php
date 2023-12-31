<?php

namespace App\Http\Requests;

use App\Traits\CustomValidationMessageTrait;
use Illuminate\Foundation\Http\FormRequest;

class WarningRequest extends FormRequest
{

    use CustomValidationMessageTrait;
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
        return [
            'warning_to'   => 'required',
            'warning_type' => 'required',
            'subject'      => 'required',
            'warning_by'   => 'required',
            'warning_date' => 'required',
        ];
    }
}

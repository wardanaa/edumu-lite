<?php


namespace App\Http\Requests\Api;


use App\Exceptions\APIGeneralException;
use Arcanedev\Support\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ApiRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [];
    }

    protected function failedValidation(Validator $validator) {
        throw new APIGeneralException($validator->errors()->first());
    }
}
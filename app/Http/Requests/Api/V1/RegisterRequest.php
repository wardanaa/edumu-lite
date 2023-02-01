<?php


namespace App\Http\Requests\Api\V1;


use App\Http\Requests\Api\ApiRequest;

class RegisterRequest extends ApiRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'username' => 'required|string',
            'password' => 'required|string',
            'password_confirm' => 'required|string',
            'name' => 'required|string|max:191',
            'position' => 'required|string|max:191',
            'company' => 'required|string|max:191',
        ];
    }
}
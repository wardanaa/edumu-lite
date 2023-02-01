<?php


namespace App\Http\Requests\Api\V1;


use App\Http\Requests\Api\ApiRequest;

class LoginRequest extends ApiRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'username' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
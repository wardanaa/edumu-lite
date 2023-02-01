<?php


namespace App\Http\Requests\Api\V1;


use App\Http\Requests\Api\ApiRequest;

class UpdateProfileRequest extends ApiRequest {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required|string|max:191',
            'position' => 'required|string|max:191',
            'company' => 'required|string|max:191',
            'no_reg' => 'string|max:191',
        ];
    }
}
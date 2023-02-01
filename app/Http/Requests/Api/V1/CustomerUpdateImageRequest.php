<?php


namespace App\Http\Requests\Api\V1;


use App\Http\Requests\Api\ApiRequest;

class CustomerUpdateImageRequest extends ApiRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2000',
        ];
    }
}
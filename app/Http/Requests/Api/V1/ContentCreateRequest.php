<?php


namespace App\Http\Requests\Api\V1;


use App\Http\Requests\Api\ApiRequest;

class ContentCreateRequest extends ApiRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'no_reg' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'file' => 'mimes:jpeg,png,jpg,gif,svg,doc,docx,xls,xlsx,ppt,pptx,pdf,zip,txt|max:2000',
        ];
    }
}
<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;

class ApiController extends Controller {

    public $status  = false;
    public $text    = null;
    public $total   = 0;
    public $data    = null;
    public $method  = "";
    public $limit   = 15;

    public function api_response() {

        if ($this->status && $this->text == null) {
            $this->method = 'success';
            $this->text = 'Pengambilan data berhasil!';
        }

        if (!$this->status && $this->text == null) {
            $this->method = 'notfound';
            $this->text = 'Data tidak ditemukan!';
        }

        return [
            'status'  => $this->status,
            'method'  => $this->method,
            'total'   => $this->total,
            'text'    => $this->text,
            'data'    => $this->data
        ];
    }
}
<?php


namespace App\Repositories\Api\V1;


use App\Exceptions\ApiGeneralException;
use App\Models\Customer;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CustomerRepository extends BaseRepository {


    /**
     * CustomerRepository constructor.
     * @param Customer $model
     */
    public function __construct(Customer $model) {
        $this->model = $model;
    }

    public function countActive(){
        return $this->model->where('active', 1)->count();
    }

    public function updateLogin(Customer $customer, array $data, $ip_address) {
        $customer->reg_id        = $data['reg_id'];
        $customer->device_name   = $data['device_name'];
        $customer->last_login_ip = $ip_address;
        $customer->last_login_at = Carbon::now()->toDateTimeString();
        $customer->api_token     = $this->generateToken();
        if ($customer->save()) {
            return $customer;
        }
        throw new ApiGeneralException('Error update akun');
    }

    public function create(array $data, $ip_address): Customer {
        if ($this->model->where('username', $data['username'])->exists()) {
            throw new ApiGeneralException('Username sudah terpakai');
        }
        if ($data['password'] != $data['password_confirm']) {
            throw new ApiGeneralException('Konfirmasi password tidak sesuai');
        }
        $customer = $this->model::create([
            'username' => $data['username'],
            'password' => $data['password'],
            'name' => $data['name'],
            'position' => $data['position'],
            'company' => $data['company'],
            'reg_id' => isset($data['reg_id']) ? $data['reg_id']: null,
            'device_name' => isset($data['device_name']) ? $data['device_name']: null,
            'last_login_ip' => $ip_address,
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'api_token' => $this->generateToken()
        ]);

        if ($customer) {
            return $customer;
        }
        throw new ApiGeneralException('Error menambahkan akun');

    }

    private function generateToken() {
        $token = hash('sha256', Str::random(60));
        if ($this->model->where('api_token', $token)->exists()){
            return $this->generateToken();
        }
        return $token;
    }

    public function updateImage(UploadedFile $image) {
        /** @var Customer $customer */
        $customer  = auth()->user();

        $fileImage = $image->store('/image/customer', 'public');

        $customer->image = $fileImage;
        if (false === $fileImage) {
            throw new ApiGeneralException("Error upload foto");
        }
        if ($customer->save()){
            return $customer;
        }
        throw new ApiGeneralException('Error mengubah foto');
    }

    public function updatePassword(array $data) {
        /** @var Customer $customer */
        $customer = auth()->user();
        if (!Hash::check($data['current_password'], $customer->password)) {
            throw new ApiGeneralException('Password tidak sesuai');
        }
        $customer->password = $data['new_password'];
        if ($customer->save()){
            return $customer;
        }
        throw new ApiGeneralException('Error mengubah password');
    }

    public function updateData(array $data) {
        /** @var Customer $customer */
        $customer = auth()->user();
        $customer->name = $data['name'];
        $customer->company = $data['company'];
        $customer->position = $data['position'];
        $customer->no_reg = $data['no_reg'];
        if ($customer->save()){
            return $customer;
        }
        throw new ApiGeneralException('Error mengubah profil');
    }
}
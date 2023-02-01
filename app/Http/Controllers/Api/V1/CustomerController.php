<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\V1\ChangePasswordRequest;
use App\Http\Requests\Api\V1\CustomerUpdateImageRequest;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Requests\Api\V1\RegisterRequest;
use App\Http\Requests\Api\V1\UpdateProfileRequest;
use App\Models\Customer;
use App\Repositories\Api\V1\CustomerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends ApiController {

    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * CustomerController constructor.
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository) {
        $this->customerRepository = $customerRepository;
    }


    public function login(LoginRequest $request) {
        /** @var Customer $customer */
        $customer = Customer::where('username', $request->get('username'))->first();
        if (!$customer) {
            $this->text = 'Pengguna tidak ditemukan';
            return $this->api_response();
        }
        if (!Hash::check($request->get('password'), $customer->password)) {
            $this->text = 'Password tidak sesuai';
            return $this->api_response();
        }
        if (!$customer->active) {
            $this->text = 'Akun Anda sudah tidak aktif';
            return $this->api_response();
        }
        $this->customerRepository->updateLogin($customer, $request->only('reg_id', 'device_name'), $request->getClientIp());

        $customer->image = $customer->picture;
        $this->status = true;
        $this->data   = ['customer' => $customer];
        return $this->api_response();
    }

    public function register(RegisterRequest $request) {
        $customer = $this->customerRepository->create($request->only([
            'username',
            'password',
            'password_confirm',
            'name',
            'position',
            'company',
            'reg_id',
            'device_name'
        ]), $request->getClientIp());

        $this->status = true;
        $this->data   = ['customer' => $customer];
        return $this->api_response();
    }

    public function checkAuth(Request $request) {
        /** @var Customer $customer */
        $customer = auth()->user();
        if (!$customer) {
            $this->method = 'user';
            $this->text = 'Akun tidak ditemukan atau sudah terhapus';
            return $this->api_response();
        }
        if (!$customer->active) {
            $this->method = 'user';
            $this->text = 'Akun Anda sudah tidak aktif';
            return $this->api_response();
        }


        $customer->reg_id = $request->get('reg_id');
        $customer->save();

        $customer->image = $customer->picture;

        $this->status = true;
        $this->data   = ['customer' => $customer];
        return $this->api_response();
    }

    public function editPhoto(CustomerUpdateImageRequest $request){
        $customer = $this->customerRepository->updateImage($request->file('image'));

        $customer->image = $customer->picture;
        $this->status = true;
        $this->text = 'Foto berhasil diubah';
        $this->data   = ['customer' => $customer];
        return $this->api_response();
    }

    public function changePassword(ChangePasswordRequest $request){
        $customer = $this->customerRepository->updatePassword($request->only(['current_password', 'new_password']));

        $this->status = true;
        $this->text = 'Password berhasil diubah';
        $this->data   = ['customer' => $customer];
        return $this->api_response();
    }

    public function updateProfile(UpdateProfileRequest $request){

        $customer = $this->customerRepository->updateData($request->only(['name', 'company', 'position', 'no_reg']));

        $this->status = true;
        $this->text = 'Profil berhasil diubah';
        $this->data   = ['customer' => $customer];
        return $this->api_response();
    }
}
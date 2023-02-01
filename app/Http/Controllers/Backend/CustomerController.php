<?php

namespace App\Http\Controllers\Backend;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

/**
 * Class DashboardController.
 */
class CustomerController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */

//    public function index()
//    {
//        return view('backend.dashboard');
//    }

    public function json(Request $request){
        $search=$request->input('search');

        $customer = Customer::select(['*'])
            ->where('name','LIKE','%'.$search."%")->paginate(20);
        return response($customer);
    }

    public function index()
    {
            $customer = Customer::paginate(20);
          return view('backend.customer',compact('customer'));
    }

    public function show(Request $request, $role){

        $roles = Customer::find($role);
        return view('backend.includes.customer.detail',compact('roles'));
    }

    public function delete(Request $request, $role){

        $dataContent = Customer::where('id',$role)->get();
        if (count($dataContent)>0) {
            Customer::where('id', $role)->delete();
            return redirect()->route('admin.cutomer')->withFlashSuccess(__('The customer was successfully deleted. '));
        }else{
            return redirect()->route('admin.customer')->withFlashSuccess(__('The customer was not success deleted. '));
        }
    }
    public function get_by_id(Request $request, $role){
        $content = Customer::find($role);
        return view('backend.includes.customer.edit',compact('content'));
    }

    public function update(Request $request,$id){

        $name=$request->input('name');
        $position=$request->input('position');
        $email = $request->input('email');
        $password=$request->input('password');
        $username=$request->input('username');
        $company = $request->input('company');

            if ($password !== null & $password!=='') {

                $update=Customer::find($id);

                $update->name=$name;
                $update->password=$password;
                $update->position=$position;
                $update->email=$email;
                $update->username=$username;
                $update->company=$company;
                $update->created_at=date('Y-m-d H:i:s');
            }else{

                $update=Customer::find($id);

                $update->name=$name;
                $update->position=$position;
                $update->email=$email;
                $update->username=$username;
                $update->company=$company;
                $update->created_at=date('Y-m-d H:i:s');

            }
        if ($update->save()) {
            return redirect()->route('admin.customer')->withFlashSuccess(__('The customer was successfully update. '));
        }
        return redirect()->route('admin.customer')->withFlashSuccess(__('The customer was successfully update. '));
//                throw new GeneralException('The news was not success create');
    }

    public function create(Request $request){
        return view('backend.includes.customer.create');
    }

    public function create_data(Request $request){

        $name=$request->input('name');
        $position=$request->input('position');
        $email = $request->input('email');
        $password=$request->input('password');
        $username=$request->input('username');
        $company = $request->input('company');

        if ($password !== null & $password!=='') {

            $add = new Customer();

            $add->name=$name;
            $add->password=$password;
            $add->position=$position;
            $add->email=$email;
            $add->username=$username;
            $add->company=$company;
            $add->created_at=date('Y-m-d H:i:s');

        }else{

            $add = new Customer();

            $add->name=$name;
            $add->position=$position;
            $add->email=$email;
            $add->username=$username;
            $add->company=$company;
            $add->created_at=date('Y-m-d H:i:s');

        }
        if ($add->save()) {
            return redirect()->route('admin.customer')->withFlashSuccess(__('The customer was successfully created. '));
        }
        return redirect()->route('admin.customer')->withFlashSuccess(__('The customer was successfully created. '));
//                throw new GeneralException('The news was not success create');

    }
}

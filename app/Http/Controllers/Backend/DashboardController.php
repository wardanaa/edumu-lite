<?php

namespace App\Http\Controllers\Backend;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Content;
use App\Http\Controllers\Controller;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */

//    public function index()
//    {
//        return view('backend.dashboard');
//    }

    public function index()
    {
        $content = count(Content::where('type','=','content')->get());
        $ebook = count(Content::where('type','=','e-book')->get());
        $news = count(Content::where('type','=','news')->get());
        $customer = count(Customer::get());

//        $data->content=$content;
//        $data->ebook=$ebook;
//        $data->news=$news;
//        dd($data);
        return view('backend.dashboard',compact('content','ebook','news','customer'));

//        return view('backend.dashboard')
//            ->withRoles($this->roleRepository
//                ->with('users', 'permissions')
//                ->orderBy('id')
//                ->paginate());
    }

    public function show(Request $request, $role){

        $content = Content::find($role);
        return view('backend.includes.dashboard.detail',compact('content'));
    }
}

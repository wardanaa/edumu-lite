<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Content;
use App\Http\Controllers\Controller;

/**
 * Class DashboardController.
 */
class ContentController extends Controller
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

        $news = Content::select(['*','customer.name as nama','content.name as name_content'])
            ->join('customer','customer.id','=','content.customer_id')
            ->where('type','=','content')
            ->where('content.name','LIKE','%'.$search."%")->paginate(20);
        return response($news);
    }

    public function index()
    {
        $contents = Content::where('type','=','content')->paginate(20);
        return view('backend.content',compact('contents'));
    }

    public function show(Request $request,$cont){

        $content = Content::find($cont);
        return view('backend.includes.content.detail',compact('content'));
    }

    public function delete(Request $request, $cont){

        $dataContent = Content::where('id',$cont)->get();
        if (count($dataContent)>0) {
            Content::where('id', $cont)->delete();
            return redirect()->route('admin.content')->withFlashSuccess(__('The content was successfully deleted. '));
        }else{
            return redirect()->route('admin.content')->withFlashSuccess(__('The content was not success deleted. '));
        }
    }
}

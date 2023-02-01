<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Content;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

/**
 * Class DashboardController.
 */
class NewsController extends Controller
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

        $news = Content::select(['*'])

            ->where('type','=','news')
            ->where('name','LIKE','%'.$search."%")->paginate(20);
        return response($news);
    }

    public function index()
    {
            $news = Content::where('type','=','news')->paginate(20);
          return view('backend.news',compact('news'));
    }

    public function show(Request $request, $role){

        $roles = Content::find($role);
        return view('backend.includes.news.detail',compact('roles'));
    }

    public function delete(Request $request, $role){

        $dataContent = Content::where('id',$role)->get();
        if (count($dataContent)>0) {
            Content::where('id', $role)->delete();
            return redirect()->route('admin.news')->withFlashSuccess(__('The news was successfully deleted. '));
        }else{
            return redirect()->route('admin.news')->withFlashSuccess(__('The news was not success deleted. '));
        }
    }
    public function get_by_id(Request $request, $role){
        $content = Content::find($role);
        return view('backend.includes.news.edit',compact('content'));
    }

    public function update(Request $request,$id){

        $name=$request->input('name');
        $description=$request->input('description');
        $image = $request->file('image');

        if ($image != null) {

            // check validtion for image
            $validateimage = $this->validate($request, [
                // check validtion for image or file
                'image' => 'image|mimes:jpg,png,jpeg|max:2048',
            ]);

            $fileImage = $image->store('/image/content','public');

            if (false !== $fileImage) {

                $update=Content::find($id);

                $update->name=$name;
                $update->description=$description;
                $update->created_at=date('Y-m-d H:i:s');
                $update->type='news';
                $update->image=$fileImage;

                if ($update->save()) {
                    return redirect()->route('admin.news')->withFlashSuccess(__('The news was successfully update. '));
                }
                return redirect()->route('admin.news')->withFlashSuccess(__('The news was successfully update. '));
//                throw new GeneralException('The news was not success create');
            }

        }else{

            $update=Content::find($id);

            $update->name=$name;
            $update->description=$description;
            $update->created_at=date('Y-m-d H:i:s');
            $update->type='news';
            if ($update->save()) {
                return redirect()->route('admin.news')->withFlashSuccess(__('The news was successfully update. '));
            }
        }
    }

    public function create(Request $request){
        return view('backend.includes.news.create');
    }

    public function create_data(Request $request){

        $name = $request->input('name');
        $desc = $request->input('description');
        $image = $request->file('image');

        if ($image != null) {

            // check validtion for image
            $validateimage = $this->validate($request, [
                // check validtion for image or file
                'image' => 'image|mimes:jpg,png,jpeg|max:2048',
            ]);

            $fileImage = $image->store('/image/content','public');

            if (false !== $fileImage) {

                $add = new Content();
                $add->name=$name;
                $add->description=$desc;
                $add->created_at=date('Y-m-d H:i:s');
                $add->type='news';
                $add->image=$fileImage;

                if ($add->save()) {
                    return redirect()->route('admin.news')->withFlashSuccess(__('The news was successfully create. '));
                }
                throw new GeneralException('The news was not success create.');
            }
        }else{
            $add = new Content();
            $add->name=$name;
            $add->description=$desc;
            $add->created_at=date('Y-m-d H:i:s');
            $add->type='news';

            if ($add->save()) {
                return redirect()->route('admin.news')->withFlashSuccess(__('The news was successfully create. '));
            }
            throw new GeneralException('The news was not success create.');
        }

    }
}

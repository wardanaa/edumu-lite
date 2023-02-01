<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Content;
use App\Models\ContentCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

/**
 * Class DashboardController.
 */
class EbookController extends Controller
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

        $news = Content::select(['*','content.id as content_id','content_category.name as nama','content.name as name_content'])
            ->join('content_category','content_category.id','=','content.content_category_id')
            ->where('content.type','=','e-book')
            ->where('content.name','LIKE','%'.$search."%")->paginate(20);
        return response($news);
    }

    public function index(Request $request)
    {
        $roles = Content::where('type','=','e-book')->paginate(20);
        return view('backend.ebook',compact('roles'));

    }

    public function show(Request $request, $role){

        $roles = Content::select('*','content_category.name as nama','content.name as name_content')
            ->join('content_category','content_category.id','=','content.content_category_id')
            ->where('content.id','=',$role)->get();

        return view('backend.includes.ebook.detail',compact('roles'));
    }

    public function delete(Request $request, $role){

        $dataContent = Content::where('id',$role)->get();
        if (count($dataContent)>0) {
            Content::where('id', $role)->delete();
            return redirect()->route('admin.ebook')->withFlashSuccess(__('The content was successfully deleted. '));
        }else{
            return redirect()->route('admin.ebook')->withFlashSuccess(__('The content was not success deleted. '));
        }
    }

    public function get_by_id(Request $request, $role){
        $category = ContentCategory::select('name', 'id')->where('type','=','e-book')->get();

        $content = Content::find($role);
        return view('backend.includes.ebook.edit',compact('content','category'));
    }

    public function update(Request $request,$id){

        $name=$request->input('name');
        $author=$request->input('author');
        $short_description=$request->input('short_description');
        $description=$request->input('description');
        $url=$request->input('url');
        $file = $request->file('file');
        $image = $request->file('image');
        $content_category_id=$request->input('content_category_id');

        if ($file != null ) {
            // check validtion for image
            $validateimage = $this->validate($request, [
                // check validtion for image or file
                'image' => 'image|mimes:jpg,png,jpeg|max:2048',
            ]);

            // check validtion for file
            $validate = $this->validate($request, [
                // check validtion for image or file
                'file' => 'required|file|mimes:pdf,PDF,ppt,pptx|max:5000',
            ]);
            
            $filebook = $file->store('/file/content','public');

            if($image != null){
                $fileImage = $image->store('/image/content','public');
            }else{
                $fileImage='';
            }

            if (false !== $fileImage || false !== $filebook ) {

                $update=Content::find($id);

                $update->author=$author;
                $update->name=$name;
                $update->short_description=$short_description;
                $update->description=$description;
                $update->url=$url;
                $update->content_category_id=$content_category_id;
                $update->type='e-book';
                $update->file=$filebook;
                $update->image=$fileImage;
                $update->created_at=date('Y-m-d H:i:s');


                if ($update->save()) {
                    return redirect()->route('admin.ebook')->withFlashSuccess(__('The news was successfully update. '));
                }
                throw new GeneralException('The news was not success create');
            }
        }else{

            if($image != null){
                $this->validate($request, [
                    // check validtion for image or file
                    'image' => 'image|mimes:jpg,png,jpeg|max:2048'
                ]);
                $fileImage = $image->store('/image/content','public');
            }else{
                $fileImage='';
            }

            if (false !== $fileImage ) {

                $update=Content::find($id);

                $update->author=$author;
                $update->name=$name;
                $update->short_description=$short_description;
                $update->description=$description;
                $update->url=$url;
                $update->content_category_id=$content_category_id;
                $update->type='e-book';
                $update->image=$fileImage;
                $update->created_at=date('Y-m-d H:i:s');


                if ($update->save()) {
                    return redirect()->route('admin.ebook')->withFlashSuccess(__('The news was successfully update. '));
                }
                throw new GeneralException('The news was not success update');
            }

        }
    }

    public function create(Request $request){
            $content = ContentCategory::select('name', 'id')->where('type','=','e-book')->get();
        return view('backend.includes.ebook.create',compact('content'));
    }

    public function create_data(Request $request){

        $name = $request->input('name');
        $author=$request->input('author');
        $short_description = $request->input('short_description');
        $desc = $request->input('description');
        $url = $request->input('url');
        $file = $request->file('file');
        $image = $request->file('image');
        $content_category_id=$request->input('content_category_id');

        if ($file != null ) {
            // check validtion for image
            $validateimage = $this->validate($request, [
                // check validtion for image or file
                'image' => 'image|mimes:jpg,png,jpeg|max:2048',
            ]);

            // check validtion for file
            $validate = $this->validate($request, [
                // check validtion for image or file
                'file' => 'required|file|mimes:pdf,PDF,ppt,pptx|max:5000',
            ]);

            $filebook = $file->store('/file/content','public');

            if($image != null){
                $fileImage = $image->store('/image/content','public');
            }else{
                $fileImage='';
            }

            if (false !== $fileImage || false !== $filebook ) {

                $add = new Content();

                $add->name=$name;
                $add->author=$author;
                $add->short_description=$short_description;
                $add->description=$desc;
                $add->content_category_id=$content_category_id;
                $add->url=$url;
                $add->type='e-book';
                $add->file=$filebook;
                $add->image=$fileImage;
                $add->created_at=date('Y-m-d H:i:s');

                if ($add->save()) {
                    return redirect()->route('admin.ebook')->withFlashSuccess(__('The news was successfully create. '));
                }
                throw new GeneralException('The news was not success create');
            }
        }

    }
}

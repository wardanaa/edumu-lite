<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ContentCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

/**
 * Class DashboardController.
 */
class ContentCategoryController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */

//    public function index()
//    {
//        return view('backend.dashboard');
//    }

    public function json(Request $request)
    {
        $search = $request->input('search');

        $news = ContentCategory::select(['*'])
            ->where('name', 'LIKE', '%' . $search . "%")->paginate(20);
        return response($news);
    }

    public function index()
    {
        $category = ContentCategory::paginate(20);
        return view('backend.contentcategory', compact('category'));
    }

    public function show(Request $request, $role)
    {

        $roles = ContentCategory::find($role);
        return view('backend.includes.category.detail', compact('roles'));
    }

    public function delete(Request $request, $role)
    {

        $dataContent = ContentCategory::where('id', $role)->get();
        if (count($dataContent) > 0) {
            ContentCategory::where('id', $role)->delete();
            return redirect()->route('admin.category')->withFlashSuccess(__('The category was successfully deleted. '));
        } else {
            return redirect()->route('admin.category')->withFlashSuccess(__('The category was not successfully deleted. '));
        }
    }

    public function get_by_id(Request $request, $role)
    {
        $content = ContentCategory::find($role);
        return view('backend.includes.category.edit', compact('content'));
    }

    public function update(Request $request, $id)
    {

        $name = $request->input('name');
        $active = $request->input('active');

        $update = ContentCategory::find($id);

        $update->name = $name;
        $update->active = $active;
        $update->type = 'e-book';
        $update->updated_at = date('Y-m-d H:i:s');

        if ($update->save()) {
            return redirect()->route('admin.category')->withFlashSuccess(__('The category was successfully update. '));
        }
        return redirect()->route('admin.category')->withFlashSuccess(__('The category was successfully update. '));
    }


    public function create(Request $request)
    {
        return view('backend.includes.category.create');
    }

    public function create_data(Request $request)
    {

        $name = $request->input('name');
        $active = $request->input('active');

        $add = new ContentCategory();

        $add->name = $name;
        $add->active = $active;
        $add->created_at = date('Y-m-d H:i:s');
        $add->type = 'e-book';

        if ($add->save()) {
            return redirect()->route('admin.category')->withFlashSuccess(__('The category was successfully create. '));
        }
        throw new GeneralException('The category was not success create.');
    }
}

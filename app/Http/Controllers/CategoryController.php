<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use DataTables;
use DB;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{   
    public function index()
    { 
        return view('category');
    }

    public function manageCategory()
    {
        $categories = Category::where('parent_id', '=', 0)->get();
        $allCategories = Category::pluck('title','id')->all();
        return view('categoryTreeview',compact('categories','allCategories'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCategory(CategoryRequest $request)
    {
        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
        Category::create($input);
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully Created',
          ]);
    }

    public function categoryData(Request $request) {
        $category = Category::all();
        return Datatables::of($category)->addColumn('action', function ($category) {
            return '<a  href="categoryEdit/'. $category->id  .'"  title="Edit" class="btn btn-info fa fa-pencil edited margin-left-5"> Edit</a>' . ' ' . 
                    '<a title="Delete" class="btn btn-danger deleted fa fa-trash margin-left-5"  data-target="#delete" data-toggle="modal" data-id=' . $category->id . '> Delete</a>';
        })
        ->make(true);
    }

    public function categoryEdit($id){
        $categories = Category::where('parent_id', '=', 0)->get();
        $allCategories = Category::pluck('title','id')->all();
        $categoryId = Category::find($id);
        return view('categoryTreeview',compact('categories','allCategories','categoryId'));
    }

    public function updateCategory(CategoryRequest $request,$id){
        $parent_id = $request['parent_id'] == null ? 0 : $request['parent_id'];
        $data = DB::table('categories')
                ->where('id', $id)
                ->update(['parent_id' => $parent_id]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Successfully Updated',
                  ]);
    }

    public function categoryDestroy($id){
        $categoryCheck = DB::table('categories')
                        ->where('parent_id', $id)
                        ->count();
        if($categoryCheck > 0){
            return response()->json([
                'status' => 'exists',
                'message' => 'this category  already exists',
              ]);
        }else{
            Category::find($id)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Deleted',
              ]);
        }
    }


}

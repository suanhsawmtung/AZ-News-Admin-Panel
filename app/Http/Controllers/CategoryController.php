<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
      // admin -> direct category page //
      public function categoryPage(){
        $categories = Category::when(request('key'),function($query){
                        $query->where('title','like','%'.request('key').'%')
                              ->orWhere('description','like','%'.request('key').'%')
                              ->orWhere('created_at','like','%'.request('key').'%')
                              ->orWhere('updated_at','like','%'.request('key').'%');
                    })
                    ->paginate(3);
        return view('admin.category.newsCategory',compact('categories'));
    }

    // admin -> create category //
    public function createCategory(Request $request){
        $this->validationCheckForCreateCategory($request);
        $data = $this->requestCategoryData($request);

        Category::create($data);
        return back()->with(['createStatus' => 'Created new category successfully.']);
    }

    // admin -> direct category edit page //
    public function categoryEditPage($id){
        $item = Category::where('id',$id)->first();
        return view('admin.category.categoryEditPage',compact('item'));
    }

    // admin -> edit category data //
    public function editCategory(Request $request,$id){
        $this->validationCheckForCreateCategory($request);
        $data = $this->requestCategoryData($request);

        Category::where('id',$id)->update($data);
        return redirect()->route('category#categoryPage')->with(["editStatus" => "Edited category data successfully."]);
    }

    // admin -> delete category //
    public function deleteCategory($id){
        Category::where('id',$id)->delete();
        return redirect()->route('category#categoryPage')->with(["deleteStatus" => "Deleted category successfully."]);
    }

    // admin -> validation check for create category //
    private function validationCheckForCreateCategory($request){
        Validator::make($request->all(),[
            'categoryTitle' => 'required | unique:Categories,title,'.$request->id,
            'categoryDescription' => 'required'
        ])->validate();
    }

    // admin -> request category date to create new category //
    private function requestCategoryData($request){
        return [
            'title' => $request->categoryTitle,
            'description' => $request->categoryDescription
        ];
    }
}

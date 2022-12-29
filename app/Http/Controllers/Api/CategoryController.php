<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // get category //
    public function category(){
        $category = Category::select('id','title','description')->get();
        return response()->json([
            'categories' => $category
        ]);
    }

    // search category //
    public function searchCategory(Request $request){
        if($request->id != null){
            $searchCategoryData = Post::where('category_id',$request->id)->get();
        }else{
            $searchCategoryData = Post::get();
        }

        return response()->json([
            'searchCategoryData' => $searchCategoryData
        ]);
    }


}

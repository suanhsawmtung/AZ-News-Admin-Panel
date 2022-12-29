<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    // admin -> direct news list page //
    public function newsListPage(){
        $categories = Category::get();
        $items = Post::when(request('key'),function($query){
            $query->where('title','like','%'.request('key').'%')
                  ->orWhere('description','like','%'.request('key').'%')
                  ->orWhere('category_id','like','%'.request('key').'%')
                  ->orWhere('created_at','like','%'.request('key').'%')
                  ->orWhere('updated_at','like','%'.request('key').'%');
                })
                ->paginate(4);
        return view('admin.posts.newsPost',compact('items','categories'));
    }


    // admin -> direct news post create page //
    public function newsCreatePage(){
        $categories = Category::get();
        return view('admin.posts.postCreatePage',compact('categories'));
    }

    // admin -> news post create //
    public function newsPostCreate(Request $request){
        $this->validationCheckForNewsPost($request);
        $data = $this->requestDataForNewPost($request);

        $fileName = uniqid().$request->file('newsImage')->getClientOriginalName();
        $request->file('newsImage')->storeAs('public',$fileName);
        $data['image'] = $fileName ;

        Post::create($data);
        return redirect()->route('news#newsListPage')->with(['createStatus' => 'Uploaded news successfully.']);
    }

    // admin -> direct news post edit page //
    public function newsPostEditPage($id){
        $post = Post::where('id',$id)->first();
        $categories = Category::get();
        return view('admin.posts.newsPostEditPage',compact('post','categories'));
    }

    // admin -> news post editing //
    public function newsPostEdit(Request $request){
        $this->validationCheckForNewsPost($request);
        $data = $this->requestDataForNewPost($request);

        if($request->hasFile('newsImage')){
            $dbImage = Post::where('id',$request->id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid().$request->file('newsImage')->getClientOriginalName();
            $request->file('newsImage')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        Post::where('id',$request->id)->update($data);
        Return redirect()->route('news#newsListPage')->with(['updateStatus' => 'Update post success.']);
    }

    // admin -> delete news post //
    public function deleteNewsPost($id){
        Post::where('id',$id)->delete();
        return back()->with(['deleteStatus' => 'Delete news successfully.']);
    }

    // validation check for news post creation //
    private function validationCheckForNewsPost($request){
        Validator::make($request->all(),[
            'newsTitle' => 'required | unique:posts,title,'.$request->id,
            'newsCategory' => 'required ',
            'newsImage' => 'required | image ',
            'newsDescription' => 'required'
        ])->validate();
    }

    // request data for new post creation //
    private function requestDataForNewPost($request){
        return [
            'title' => $request->newsTitle,
            'category_id' => $request->newsCategory,
            'description' => $request->newsDescription
        ];
    }
}


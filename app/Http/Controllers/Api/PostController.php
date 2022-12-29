<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Reaction;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // get all post //
    public function allPost(){
        $posts = Post::orderBy('created_at','desc')->get();
        return response()->json([
            "posts" => $posts
        ]);
    }

    // search post //
    public function search(Request $request){
        $searchData = Post::where('title','like','%'.$request->key.'%')->get();
        return response()->json([
            'searchData' => $searchData
        ]);
    }

    // direct post details page //
    public function postDetails($id){
        $details = Post::where('id',$id)->first();
        $comments = Comment::select('comments.*','users.name as user_name')
                                ->leftJoin('users','users.id','comments.user_id')
                                ->where('post_id',$id)
                                ->get();
        $react = Reaction::where('post_id',$id)->get();

        return response()->json([
            'postDetails' => $details,
            'comments' => $comments,
            'react' => $react,
            // 'reactStatus'=> $reactStatus
        ]);
    }

    // create view count //
    public function viewCount(Request $request){
        ActionLog::create([
            "user_id" => $request->userId,
            "post_id" => $request->postId
        ]);
        $viewData = ActionLog::where("post_id",$request->postId)->get();

        return response()->json([
            'view' => $viewData
        ]);
    }

    // post a comment //
    public function postComment(Request $request){
        Comment::create([
            'user_id' => $request->userId,
            'post_id' => $request->postId,
            'comment' => $request->comment
        ]);

        $comments = Comment::select('comments.*','users.name as user_name')
                            ->leftJoin('users','users.id','comments.user_id')
                            ->where('comments.post_id',$request->postId)
                            ->get();

        return response()->json([
            'comments' => $comments
        ]);
    }

    // react love //
    public function reactLove(Request $request){
        $myReact = Reaction::where('user_id',$request->userId)->where('post_id',$request->postId)->first();
        $status = null;

        if(empty($myReact)){
            Reaction::create([
                'user_id' => $request->userId,
                'post_id' => $request->postId
            ]);
            $status = true;
        }else{
            Reaction::where('user_id',$request->userId)->where('post_id',$request->postId)->delete();
            $status = false;
        }

        $react = Reaction::where('post_id',$request->postId)->get();

        return response()->json([
            'react' => $react,
            'reactStatus' => $status
        ]);
    }
}

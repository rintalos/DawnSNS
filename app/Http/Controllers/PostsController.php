<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //
    public function index(){
        $auth = \Auth::user();
        $authId = \Auth::id();
        $follow_count = \DB::table('follows')->where('follower',Auth::id())->count();
        $follower_count = \DB::table('follows')->where('follow',Auth::id())->count();
        $list = \DB::table('posts')
        ->leftJoin('users','posts.user_id','=','users.id')
        ->select('posts.id','posts.user_id','users.username','posts.posts','posts.created_at','posts.updated_at','users.images')
        ->orderBy('updated_at','desc')
        // ->where('user_id',$auth->id)
        ->get();


        return view('posts.index',['list'=>$list,'auth'=>$auth,'follow_count'=>$follow_count,'follower_count'=>$follower_count]); //←9/08追加検討

    }
    public function post(Request $request){
        $post = $request->input('newPost');
        \DB::table('posts')
        ->insert([
            'posts' => $post,
            'user_id' => \Auth::id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/top');
    }
    public function update(Request $request){
        $post = $request->input('upPost');
        $id = $request->input('id');
        \DB::table('posts')
            ->where('id',$id)
            ->update([
                'posts' => $post,
                'updated_at' => now()

            ]);
        return redirect('/top');
    }
    public function delete($id)
    {
        \DB::table('posts')
            ->where('id', $id)

            ->delete();

        return redirect('/top');
    }









}

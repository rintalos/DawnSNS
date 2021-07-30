<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    //

    public function create($id){

        \DB::table('follows')->insert(
        ['follow' => $id, 'follower' => Auth::id()]
        );
        return redirect('/search');
        }

    public function delete($id){

        \DB::table('follows')
            ->where('follow',$id)
            ->where('follower', Auth::id())
            ->delete();

        return redirect('/search');
    }
    public function profile($id){
        // dd($id);
        $auth = \Auth::user();
        $authId = \Auth::id();
        $follow_count = \DB::table('follows')->where('follower',Auth::id())->count();
        $follower_count = \DB::table('follows')->where('follow',Auth::id())->count();
        $other = \DB::table('users')
        ->leftJoin('posts','posts.user_id','=','users.id')
        ->where('users.id', $id)
        ->select('users.id','users.username','users.bio','posts.posts','posts.updated_at','images')
        ->get();
        $list = \DB::table('users')
        ->leftJoin('posts','posts.user_id','=','users.id')
        ->where('users.id', $id)
        ->select('users.id','users.username','users.bio','posts.posts','posts.updated_at','images')
        ->get();
        $array = \DB::table('follows')->where('follower','=',$authId )
        ->select('follow')

        ->get()->toArray();

        return view('follows.followProfile',['auth'=>$auth,'other'=>$other,'follow_count'=>$follow_count,'follower_count'=>$follower_count,'list'=>$list,'array'=>$array]);
    }



    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }
}

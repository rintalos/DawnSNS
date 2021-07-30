<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    //
    public function profile(){
        $auth = \Auth::user();
        $authId = \Auth::id();
        $follow_count = \DB::table('follows')->where('follower',Auth::id())->count();
        $follower_count = \DB::table('follows')->where('follow',Auth::id())->count();
        // $person = \DB::table('users')
        // ->where(id,$auth)
        // ->select('id','username')
        // ->get();
        // dd($person);

        return view('users.profile',['auth'=>$auth,'follow_count'=>$follow_count,'follower_count'=>$follower_count]);
    }

    public function search(Request $request){
        $auth = \Auth::user();
        $authId = \Auth::id();
        $follow_count = \DB::table('follows')->where('follower',Auth::id())->count();
        $follower_count = \DB::table('follows')->where('follow',Auth::id())->count();
        $followId = \DB::table('follows')
        ->where('follower','$authId')
        ->get();

        $searchName = $request->input('search');
        if ($searchName != '') {
            $person = \DB::table('users')->where('username', 'like', '%' .$searchName. '%')
            ->select('id', 'username')
            ->get();
        } else {
        $person = \DB::table('users')->where('id', '<>', $authId)
        ->select('id','username')
        ->get();

        }
        $array = \DB::table('follows')->where('follower','=',$authId )
        ->select('follow')

        ->get()->toArray();

       //dd($array);
        return view('users.search',['auth'=>$auth,'person'=>$person,'array'=>$array,'follow_count'=>$follow_count,'follower_count'=>$follower_count]);
    }
//follow=フォローされている、follower＝フォローしている人
    public function followList(){
        $auth = \Auth::user();
        $authId = \Auth::id();
        $follow_count = \DB::table('follows')->where('follower',Auth::id())->count();
        $follower_count = \DB::table('follows')->where('follow',Auth::id())->count();
        $person = \DB::table('users')
        ->leftjoin('follows','follows.follow','=','users.id')
        ->leftjoin('posts','posts.user_id','=','users.id')
        ->where('follows.follower',\Auth::id())
        ->select('users.id','username','images','posts.posts')
        ->get();
        $list = \DB::table('users')
        ->Join('posts','posts.user_id','=','users.id')
        ->leftjoin('follows','follows.follow','=','users.id')
        ->where('follows.follower',\Auth::id())
        ->select('users.id','username','images','posts.posts','posts.created_at','posts.updated_at')
        ->orderBy('updated_at','desc')
        // ->where('user_id',$auth->id)
        ->get();
        return view('follows.followList',['auth'=>$auth,'person'=>$person,'list'=>$list,'follow_count'=>$follow_count,'follower_count'=>$follower_count]);
    }
    public function followerList(){
        $auth = \Auth::user();
        $authId = \Auth::id();
        $follow_count = \DB::table('follows')->where('follower',Auth::id())->count();
        $follower_count = \DB::table('follows')->where('follow',Auth::id())->count();
        $person = \DB::table('users')
        ->leftjoin('posts','posts.user_id','=','users.id')
        ->leftjoin('follows','follows.follower','=','users.id')
        ->where('follows.follow',\Auth::id())
        ->select('users.id','username','images','posts.posts')
        ->get();

        $list = \DB::table('users')
        ->Join('posts','posts.user_id','=','users.id')
        ->leftjoin('follows','follows.follower','=','users.id')
        ->where('follows.follow',\Auth::id())
        ->select('users.id','username','images','posts.posts','posts.created_at','posts.updated_at')
        ->orderBy('updated_at','desc')
        // ->where('user_id',$auth->id)
        ->get();
        return view('follows.followerList',['auth'=>$auth,'person'=>$person,'list'=>$list,'follow_count'=>$follow_count,'follower_count'=>$follower_count]);
    }

    protected function validator(array $data)
    {
        // dd($data);
        return Validator::make($data, [
            'username' => 'string|min:4|max:12',
            'mail' => 'string|email|min:4|max:20',//min:4追加
            'new-password' => 'min:4|max:12|nullable|alpha_num|unique:users|different:password',//alpha_num,min:4,max:12追加
            'bio' => 'max:200'
            // 'images' =>'alpha_num|image'
        ],[
            'username.string' => '文字列ではありません。',
            'username.min' => '4文字以下です',
            'username.max' => '12文字以上です',
            'mail.string' => '文字列ではありません。',
            'mail.email' => 'Eメールではありません。',
            'mail.min' => '4文字以下です',
            'mail.max' => '20文字以上です',
            'new-password.min' => '4文字以下です',
            'new-password.max' => '12文字以上です',
            'new-password.alpha_num' => '英数字ではありません。',
            'bio.max' => '200文字以上です'
        ]);
    }
    public function update(Request $request){
            $id = \Auth::id();
            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('new-password');
            $bio = $request->input('bio');
            $images = $request->file('images');

//ここからバリデェーション
            $data = $request->input();
            $val = $this->validator($data);
            if($val->fails()) {
                return redirect('/profile')->withErrors($val)->withInput();
            }else {

                if(isset($password) && isset($images)){
                $filename = $images->getClientOriginalName();
                \DB::table('users')
                ->where('id',$id)
                ->update([
                    'username' => $username,
                    'mail' => $mail,
                    'password' => bcrypt($password),
                    'bio' => $bio,
                    'images' => $filename,
                    'updated_at' => now()

                ]);
                } elseif (isset($password)){
                    \DB::table('users')
                    ->where('id',$id)
                    ->update([
                        'username' => $username,
                        'mail' => $mail,
                        'password' => bcrypt($password),
                        'bio' => $bio,
                        'updated_at' => now()
                    ]);
                } elseif (isset($images)){
                    $filename = $images->getClientOriginalName();
                    \DB::table('users')
                    ->where('id',$id)
                    ->update([
                        'username' => $username,
                        'mail' => $mail,
                        'bio' => $bio,
                        'images' => $filename,
                        'updated_at' => now()
                    ]);
                } else {
                    \DB::table('users')
                    ->where('id',$id)
                    ->update([
                        'username' => $username,
                        'mail' => $mail,
                        'bio' => $bio,
                        'updated_at' => now()
                    ]);
                }
                return redirect('/top');
            }
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';//←homeから変更

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
        return Validator::make($data, [
            'username' => 'required|string|min:4|max:12',
            'mail' => 'required|string|email|min:4|max:20|unique:users',//min:4追加
            'password' => 'required|min:4|max:12|alpha_num|unique:users',//alpha_num,min:4,max:12追加
            'password-confirm' =>'required|alpha_num|min:4|same:password'
        ],[
            'username.required' => '入力必須です。',
            'username.string' => '文字列ではありません。',
            'username.min' => '4文字以下です',
            'username.max' => '12文字以上です',
            'mail.required' => '入力必須です。',
            'mail.string' => '文字列ではありません。',
            'mail.email' => 'Eメールではありません。',
            'mail.min' => '4文字以下です',
            'mail.max' => '20文字以上です',
            'password.required' => '入力必須です。',
            'password.min' => '4文字以下です',
            'password.max' => '12文字以上です',
            'password.alpha_num' => '英数字ではありません。',
            'password-confirm.required' => '入力必須です。',
            'password-confirm.alpha_num' => '英数字ではありません。',
            'password-confirm.min' => '4文字以下です',
            'password-confirm.same' => 'パスワードが同じではありせん。',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            $val = $this->validator($data);
            if($val->fails()) {
                return redirect('/register')->withErrors($val)->withInput();
            }else {

                $this->create($data);
                return redirect('added');
            }
        }
        return view('auth.register');
    }

    public function added(){

        $user = \DB::table('users') //ユーザー情報取得
        ->orderBy('id','desc')     //降順に並び替え（新しい順）
        ->first();                 //最初のデータだけ取り出す

        return view('auth.added',['user'=>$user]);
    }
}

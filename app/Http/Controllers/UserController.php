<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  /**
     * トップページ を表示する
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('user/register');
    }
    
     public function input(UserRegisterRequest $request)
    {
        // validate済

        // データの取得
        $validatedData = $request->validated();

        //
        var_dump($validatedData); exit;
         return view('user.input');
    }
    
    /**
     * 登録処理
     * 
     */
    public function register(UserRegisterRequest $request)
    {
        // validate済

        // データの取得
        $datum = $request->validated();
        //var_dump($datum); exit;

      
       
         $datum['password'] = Hash::make($datum['password']);
       

        // テーブルへのINSERT
        try {
            $r = User::create($datum);
        } catch(\Throwable $e) {
            // XXX 本当はログに書く等の処理をする。今回は一端「出力する」だけ
            echo $e->getMessage();
            exit;
        }
        
            
            
    

        // ユーザー登録成功
        $request->session()->flash('front.users_success', true);

        //
        return redirect('/');
    }

   
}

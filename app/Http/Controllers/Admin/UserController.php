<?php
declare(strict_types=1);
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User as UserModel;

class UserController extends Controller
{
    /**
     * ユーザの一覧 を表示する
     * 
     * @return \Illuminate\View\View
     */
    public function list()
    {
       
        $list = UserModel::select('users.id', 'users.name')
                         ->selectRaw('count(shoppinglists.id) AS shoppinglists_num')
                         ->leftJoin('shoppinglists', 'users.id', '=', 'shoppinglists.user_id')
                         ->groupBy('users.id', 'users.name')
                         ->orderBy('users.id')
                         ->get();
//echo "<pre>\n";
//var_dump($list->toArray()); exit;
        return view('admin.user.list', ['users' => $list]);
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    
    public function index() {
        
        // ユーザ一覧ををidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(1);
        
        // ユーザ一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
        
    }
    
    
    public function show($id) {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        return view('uses.show', [
            'user' => $user,
        ]);
    }
    
}

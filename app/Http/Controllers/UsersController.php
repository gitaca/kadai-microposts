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

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザの投稿一覧を作成日時の降順で取得
        // $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
        $microposts = $user->feed_microposts()->orderBy('created_at', 'desc')->paginate(10);

        // ユーザ詳細ビューでそれらを表示
        return view('users.show', [
            'user' => $user,
            'microposts' => $microposts,
        ]);
    }
    
    /**
     * ユーザのフォロー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロー一覧を取得
        $followings = $user->followings()->paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }

    /**
     * ユーザのフォロワー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followers($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロワー一覧を取得
        $followers = $user->followers()->paginate(10);

        // フォロワー一覧ビューでそれらを表示
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
    
    // ユーザーが追加したお気に入りを一覧表示
    public function favorites($id)
    {
        // dd($id);
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        // dd($user);
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // お気に入りの一覧を取得
        $microposts = $user->favorites()->paginate(10);
        
        // dd($microposts);
        
        return view('users.favorites', [
            'user' => $user,
            'microposts' => $microposts,
        ]);
    }
    
}

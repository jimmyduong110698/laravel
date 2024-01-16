<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;
use App\Models\UserInfo;
use DB,Auth;

class ClientAuthorController extends Controller
{
    public function author() {
        $items = DB::table('items')
        ->select('items.*','user_info.nick_name','user_info.avatar',DB::raw('COUNT(items.user_id) as count'))
        ->join('user_info','items.user_id','=','user_info.id')
        ->whereNotIn('user_id',Auth::check() ? [Auth::user()->id] : [-1])
        ->groupBy('items.user_id')
        ->orderBy('id','asc')
        ->get();


        return view('client.modules.author.index',[
            'authors' => $items,
        ]);
    }
    public function profile(int $id) {
        $authors = DB::table('user_info')
        ->where('id', $id)
        ->get();
        $comments = DB::table('comment')
        ->select('comment.*','user_info.nick_name','user_info.avatar')
        ->join('user_info','comment.reviewer_id','=','user_info.id')
        ->where('user_id', $id)
        ->get();
        $items = DB::table('items')
        ->select('items.*','user_info.nick_name','user_info.avatar')
        ->join('user_info','items.user_id','=','user_info.id')
        ->where('user_id', $id)
        ->get();
       
        $author = $authors[0];
        return view('client.modules.author.profile',[
            'author' => $author,
            'comments' => $comments,
            'items' => $items
        ]);
    }
}

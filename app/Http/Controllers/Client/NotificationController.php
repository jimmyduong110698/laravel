<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB,Auth;


class NotificationController extends Controller
{
    public function read_nofitication() {
        DB::table('notification')->where('user_id',Auth::user()->id)->update([
            'status' => 1
        ]);
    }

    public function update_nofitication(Request $request) {
        $data = DB::table('notification')->select('notification.*','user_info.nick_name','user_info.avatar')
        ->join('user_info','notification.owner_id','=','user_info.id')
        ->where('user_id',Auth::user()->id)->orderBy('create_date','DESC')->limit(20)->get();;
        if (!$data->isNotEmpty()) {
            $data = -1;
        }
        return response([
            'status' => 'success',
            'result' => $data,
        ],200);
    }
}

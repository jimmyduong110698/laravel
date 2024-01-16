<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bid;
use DB,Auth;

class BidsController extends Controller
{
    public function index() {
        $bids = DB::table('bids')->select('bids.*', 'user_info.nick_name','user_info.avatar')
        ->join('user_info','bids.user_id','=','user_info.id')->get();

        return view('admin.modules.bid.index',[
            'bids' => $bids,
        ]);
    }

    public function edit(Request $requeset) {
        $bid = Bid::findOrFail($requeset->bid_id);
        $bid_before = Bid::findOrFail($requeset->bid_id);

        $bid->status = $requeset->status;
        $bid->price = $requeset->price;


        $user = DB::table('users')->find($bid->user_id);
        if ($bid->price == $bid_before->price) {
            if($bid->status == 2 && $bid_before->status == 1) {
                DB::table('users')->where('id',$bid->user_id)->update(['points' => ($user->points +  $bid->price)]);
            }
            if($bid->status == 2 && $bid_before->status == 3) {
                DB::table('users')->where('id',$bid->user_id)->update(['points' => ($user->points +  $bid->price)]);
            }
            if ($bid->status == 1 && $bid_before->status == 2) {
                DB::table('users')->where('id',$bid->user_id)->update(['points' => ($user->points -  $bid->price)]);
            }
            if ($bid->status == 3 && $bid_before->status == 2) {
                DB::table('users')->where('id',$bid->user_id)->update(['points' => ($user->points -  $bid->price)]);
            }
        } else {
            if($bid->status == 2 && $bid_before->status == 1) {
                DB::table('users')->where('id',$bid->user_id)->update(['points' => ($user->points +  $bid_before->price)]);
            }
            if($bid->status == 2 && $bid_before->status == 3) {
                DB::table('users')->where('id',$bid->user_id)->update(['points' => ($user->points +  $bid_before->price)]);
            }
            if ($bid->status == 1 && $bid_before->status == 2) {
                DB::table('users')->where('id',$bid->user_id)->update(['points' => ($user->points -  $bid->price)]);
            }
            if ($bid->status == 3 && $bid_before->status == 2) {
                DB::table('users')->where('id',$bid->user_id)->update(['points' => ($user->points -  $bid->price)]);
            }
        }

        $bid->save();

        

        return redirect()->back()->with('success', 'Update item successfully');
    }

    public function filter(Request $request) {
        $date_before = date('Y-m-d');
        if ($request->filter_date === "1") {
            $date_after = date( 'Y-m-d' , strtotime ( '+ 1 day' , strtotime ( $date_before ) ) );
            $filter_date = " WHERE bids.create_date BETWEEN '".$date_before." 00:00:00' AND '".$date_after." 00:00:00'";
        } if ($request->filter_date === "2") {
            $date_before = date( 'Y-m-d' , strtotime ( '+ 1 day' , strtotime ( $date_before ) ) );
            $date_after = date( 'Y-m-d' , strtotime ( '- 1 day' , strtotime ( $date_before ) ) );
            $filter_date = " WHERE bids.create_date BETWEEN '".$date_after." 00:00:00' AND '".$date_before." 00:00:00'";
        } if ($request->filter_date === "3") {
            $date_before = date( 'Y-m-d' , strtotime ( '+ 1 day' , strtotime ( $date_before ) ) );
            $date_after = date( 'Y-m-d' , strtotime ( '- 1 week' , strtotime ( $date_before ) ) );
            $filter_date = " WHERE bids.create_date BETWEEN '".$date_after." 00:00:00' AND '".$date_before." 00:00:00'";
        } if ($request->filter_date === "4") {
            $date_before = date( 'Y-m-d' , strtotime ( '+ 1 day' , strtotime ( $date_before ) ) );
            $date_after = date( 'Y-m-d' , strtotime ( '- 1 month' , strtotime ( $date_before ) ) );
            $filter_date = " WHERE bids.create_date BETWEEN '".$date_after." 00:00:00' AND '".$date_before." 00:00:00'";
        }
       
        $sql = "SELECT bids.*, user_info.nick_name FROM bids JOIN user_info
        ON bids.user_id = user_info.id $filter_date";

        $result = DB::select($sql);

        return response([
            'status' => 'success',
            'result' => $result,
        ],200);
    }
}

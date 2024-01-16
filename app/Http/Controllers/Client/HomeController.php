<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Models\UserInfo;
use DB,Auth;
use App\Events\AuctionRefund;
use App\Events\SentItem;

class HomeController extends Controller
{
    public function index() {
        $categories = Category::get();
        $authors = DB::table('user_info')
        ->select('user_info.*', DB::raw('COUNT(items.user_id) as count'))
        ->join('items','items.user_id','=','user_info.id')
        ->groupBy('items.user_id')
        ->orderBy('id','asc')
        ->get();
        if (Auth::check()) {
            $items = DB::table('items')
            ->select('items.*', 'user_info.nick_name','user_info.avatar')
            ->join('user_info','items.user_id','=','user_info.id')
            ->whereNotIn('user_id',[Auth::user()->id])
            ->where('status',1)
            ->get();
        } else {
            $items = DB::table('items')
            ->select('items.*', 'user_info.nick_name','user_info.avatar')
            ->join('user_info','items.user_id','=','user_info.id')
            ->where('status',1)
            ->get();
        }
       
        return view('client.modules.home.index',[
            'items' => $items,
            'categories' => $categories,
            'authors' => $authors,
        ]);
    }
    public function news() {
        return view('client.modules.home.news');
    }

    public function bid_history(Request $request) {
        $result = DB::table('bids')
        ->select('bids.*','user_info.nick_name','user_info.avatar')
        ->join('user_info', 'bids.user_id', '=', 'user_info.id')
        ->where('item_id',$request->dataSearch)->orderBy('create_date','DESC')->get();
        return response([
            'status' => 'success',
            'result' => $result
        ],200);
    }
    public function bid_now(Request $request) {
        $result = DB::table('items')
        ->where('id',$request->dataSearch)
        ->get();
        return response([
            'status' => 'success',
            'result' => $result,
        ],200);
    }

    public static function item_check($id) { // kiem tra item hop le hay ko
        $item = DB::table('items')->find($id);
        $date_check = DB::table('items')
        ->select('items.end_date')
        ->find($id);
        $current_date = date('Y-m-d H:i:s');
        if (!empty($item) && $date_check > $current_date && $item->user_id != Auth::user()->id) {
            return true;
        } else {
            return false;
        }
    }

    public static function bid_check(int $item_id,int $user_id) {   //kiem user bid item hay hay chua
        $check_items = DB::table('bids')->where('item_id',$item_id)->get();
        foreach($check_items as $item) {
            if ($item->user_id == $user_id && $item->status == 1) {
                return false;
            }
        }
        return true;
    }
    
    public function check_balance($price) {
        if (Auth::user()->points >= $price) {
            return true;
        }
        return false;
    }

    public function change_item_price(int $item_id,$price) {
       DB::table('items')
       ->where('id',$item_id)
       ->update(['price' => $price]);
    }

    public function refund_balance(int $user_id,$price) {
        $user_points = DB::table('users')->select('users.points')->find($user_id);
        DB::table('users')->where('id',$user_id)->update(['points' => ($user_points->points + $price)]);
    }
    
    public function bid_update_status(int $id) {
        DB::table('bids')->where('id',$id)->update(['status' => 2]);
    }

    public function change_balance(int $item_id,$price) {
        $is_empty_bid = DB::table('bids')->where('item_id',$item_id)->where('status',1)->orderByDesc('price')->limit(1)->get();
        $item = DB::table('items')->find($item_id);
        if ($is_empty_bid->isNotEmpty()) {
            DB::table('users')->where('id',Auth::user()->id)->update(['points' => (Auth::user()->points - $price)]);
            $this->refund_balance($is_empty_bid[0]->user_id, $is_empty_bid[0]->price);
            $this->bid_update_status($is_empty_bid[0]->id);
            $new_notify[] = [
                'status' => 2,
                'owner_id' => 1, //phat thong bao, neu la admin id = 1
                'user_id' => $is_empty_bid[0]->user_id, //nhan thong bao
                'content' => "You get ".$is_empty_bid[0]->price." ETH from  ".$item->name." item: refund auction",
                'create_date' => date('Y-m-d H:i:s'),
            ]; 
            DB::table('notification')->insert($new_notify);
            event(new AuctionRefund($is_empty_bid[0]->user_id,$is_empty_bid[0]->price,$new_notify,$item));
        } else {
            DB::table('users')->where('id',Auth::user()->id)->update(['points' => (Auth::user()->points - $price)]);
        }
    }

    public function create_bid($item_id,$price,$status) {
        DB::table('bids')->insert([
            'price' => $price,
            'status' => $status,
            'item_id' => $item_id,
            'user_id' => Auth::user()->id,
            'create_date' => date('Y-m-d H:i:s'),
        ]);
       
    }

    public function sent_notify_to_owner_item($id) {
        $item = DB::table('items')->find($id);
        $user = DB::table('user_info')->find(Auth::user()->id);
        $notify[] = [
            'status' => 2,
            'owner_id' => Auth::user()->id, //phat thong bao, neu la admin id = 1
            'user_id' => $item->user_id, //nhan thong bao
            'content' => $user->nick_name." bid your ".$item->name." item for ".$item->price." ETH.",
            'create_date' => date('Y-m-d H:i:s'),
        ]; 
        DB::table('notification')->insert($notify);
        event(new SentItem($notify,$user));
    }

    public function bid_success(Request $request) {
        $status = 0;
        
        if ($this->item_check($request->id) && $this->bid_check($request->id,Auth::user()->id)) {
            if ($this->check_balance($request->price) && !empty($request->price)) {
                $this->change_item_price($request->id,$request->price);
                $this->change_balance($request->id,$request->price);
                $status = 1;
                $this->create_bid($request->id,$request->price,$status);
                $this->sent_notify_to_owner_item($request->id);
            } else {$status = 2;} 
        } else {
            $status = 2;
        }


        $item = DB::table('items')->find($request->id);
        $user = DB::table('users')->select('users.points')->find(Auth::user()->id);

        $data[] = [
            'status' => $status,
            'code-error' => 0,
            'item_price' => $item->price, 
            'points' => $user->points,
        ];
        
        
        // if ($this->check_balance($request->price)) {
        //     $status = 1;
        // } else {
        //     $status = 2;
        // }
        
        
        return response([
            'status' => 'success',
            'result' =>  $data,
        ],200);
    }
}

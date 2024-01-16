<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Events\SuccessBid;
use DB,Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function UpdateStatusItems() {
        $items = DB::table('items')->where('status',1)->get();
        $data_now = date('Y-m-d H:i:s');
        foreach ($items as $item) {
            $bid = DB::table('bids')->where('item_id',$item->id)->where('status',1)->get();
    
            if ($item->end_date < $data_now) {
                DB::table('items')->where('id',$item->id)->update([
                    'status' => 2
                ]);
                $old_balance = DB::table('users')->select('users.points')->find($item->user_id);

                if ($bid->isNotEmpty()) {
                    DB::table('bids')->where('item_id',$item->id)->where('status',1)->update([
                        'status' => 3
                    ]);
                    
                    $new_balance = $item->price + $old_balance->points;
                    DB::table('users')->where('id',$item->user_id)->update([
                        'points' => $new_balance
                    ]);
                    
                    $user_notify[] =[
                        'status' => 2,
                        'owner_id' => 1, //phat thong bao, neu la admin id = 1
                        'user_id' => $bid[0]->user_id, //nhan thong bao
                        'content' => "You won an item: ".$item->name." with ".$item->price." ETH.",
                        'create_date' => date('Y-m-d H:i:s'),
                    ]; 
                    $owner_notify[] = [
                        'status' => 2,
                        'owner_id' => 1, //phat thong bao, neu la admin id = 1
                        'user_id' => $item->user_id, //nhan thong bao
                        'content' => "The ".$item->name." item was successfully auctioned. You earn ".$item->price." ETH.",
                        'create_date' => date('Y-m-d H:i:s'),
                    ];
                    
                    DB::table('notification')->insert($user_notify);
                    DB::table('notification')->insert($owner_notify);
                    event(new SuccessBid($bid[0]->user_id,$item->user_id,$new_balance));
                } if (!$bid->isNotEmpty()) {
                    $owner_notify[] = [
                        'status' => 2,
                        'owner_id' => 1, //phat thong bao, neu la admin id = 1
                        'user_id' => $item->user_id, //nhan thong bao
                        'content' => "The ".$item->name." item has ended. There are no auctions.",
                        'create_date' => date('Y-m-d H:i:s'),
                    ];
                    DB::table('notification')->insert($owner_notify);
                    event(new SuccessBid(1,$item->user_id,$old_balance->points));
                }
            }
        }
    }

     /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->UpdateStatusItems();
    }
}

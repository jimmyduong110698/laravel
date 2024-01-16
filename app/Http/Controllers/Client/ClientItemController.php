<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use DB;
use Illuminate\Support\Collection;

class ClientItemController extends Controller
{
    public function explore() {
        $items = DB::table('items')
        ->select('items.*', 'user_info.nick_name','user_info.avatar')
        ->join('user_info','items.user_id','=','user_info.id')
        ->where('status',1)
        ->limit(15)
        ->get();
       
        return view('client.modules.item.liveItem',[
            'items' => $items,
        ]);
    }
    public function detail(int $id) {
        $items = DB::table('items')->select('items.*', 'user_info.nick_name','user_info.avatar')
        ->join('user_info','items.user_id','=','user_info.id')->where('items.id', $id)->get();
        $item = $items[0];
        return view('client.modules.item.detail',[
            'item' => $item,
        ]);
    }
    public function collection(int $id) {
        $items = DB::table('items')->where('category_id', $id)->get();
        return view('client.modules.item.collection',[
            'items' => $items,
        ]);
    }

    public function search(Request $request) {
        $result = DB::table('items')
        ->select('items.*', 'user_info.nick_name','user_info.avatar')
        ->join('user_info','items.user_id','=','user_info.id')
        ->where('name','LIKE',$request->search.'%')->get();
    
        return response([
            'status' => 'success',
            'result' => $result
        ],200);
    }

    public function filter_item(Request $request) {
        $category = $request->category;
        $sort_by = $request->sort_by;
        $end_soon = "";
        $check_satus = "";
        if ($request->end_auction === "true") {
            $check_satus = " WHERE (status = 1 || status = 2) ";
        } if ($request->end_auction === "false") {
            $check_satus = " WHERE status = 1 ";
        }
        $search = " && name LIKE '".$request->search."%' ";
        if ($request->search == "") {
            $search = "";
        }

       if ($request->end_soon === "true") {
            $end_soon = " end_date ASC, ";
       }

        $order_by = "";
        if ($sort_by == 1) {
            $order_by = "ORDER BY $end_soon name ASC";
        } if ($sort_by == 2) {
            $order_by = "ORDER BY $end_soon name DESC";
        } if ($sort_by == 3) {
            $order_by = "ORDER BY $end_soon price ASC";
        } if ($sort_by == 4) {
            $order_by = "ORDER BY $end_soon price DESC";
        }



        if ($category != null && $category != 0) {
            $sql = "SELECT  items.*, user_info.nick_name , user_info.avatar
            FROM items
            JOIN user_info
            ON items.user_id = user_info.id $check_satus && category_id = $category $search $order_by";
        } else {
            $sql = "SELECT  items.*, user_info.nick_name , user_info.avatar
            FROM items
            JOIN user_info
            ON items.user_id = user_info.id $check_satus $search $order_by";
        }
       

    

        $result = DB::select($sql);



        return response([
            'status' => 'success',
            'result' => $result
        ],200);
    }

    public function get_item($id) {
        $item = DB::table('items')
        ->select('items.*', 'user_info.nick_name','user_info.avatar')
        ->join('user_info','items.user_id','=','user_info.id')
        ->where('items.id',$id)
        ->get();

        $item = $item[0];
        
        return response([
            'status' => 'success',
            'result' => $item
        ],200);
    }

}

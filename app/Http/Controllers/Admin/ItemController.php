<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Item\UpdateRequest;
use App\Http\Requests\Admin\Item\StoreRequest;
use App\Models\Category;
use App\Models\Item;
use DB,Auth;

class ItemController extends Controller
{
    public function index() {
        // $items = DB::table(DB::table('items')->select('items.*', 'user_info.nick_name')
        // ->join('user_info','items.user_id','=','user_info.id'))->where(function($query) {
        //     $query->where('status', 1)
        //         ->orWhere('status', 2);
        // })->get();
        $items = DB::table(DB::table('items')->select('items.*', 'user_info.nick_name')
        ->join('user_info','items.user_id','=','user_info.id'))->get();
        $categories = DB::table('categories')->get();
        return view('admin.modules.item.index',[
            'items' => $items,
            'categories' => $categories,
        ]);
    }
    public function detail(int $id) {
        $item = DB::table(DB::table('items')->select('items.*', 'user_info.nick_name','user_info.avatar')
        ->join('user_info','items.user_id','=','user_info.id'))
        ->find($id);

        $bids = DB::table('bids')->where('item_id',$id)
        ->select('bids.*', 'user_info.nick_name','user_info.avatar')
        ->join('user_info','bids.user_id','=','user_info.id')->get();

        return view('admin.modules.item.detail',[
            'item' => $item,
            'bids' => $bids,
        ]);
    }
    public function ban(int $id) {
        DB::table('items')->where('id',$id)->update(['status' => 4]);
        return redirect()->route('admin.item.items_list')->with('success', 'The item has been banned');
    }

    public function edit(int $id) {
        $item = DB::table('items')->find($id);
        $categories = DB::table('categories')->get();

        return view('admin.modules.item.edit',[
            'item' => $item,
            'categories' => $categories,
        ]);
    }

    public function update(UpdateRequest $request,string $id) {
        $item = Item::findOrFail($id);

        $bid = DB::table('bids')->where('item_id',$id)->where('status',1)->get();
        

        if ($bid->isNotEmpty()) {
            DB::table('bids')->where('item_id',$id)->where('status',1)->update(['status'=>2]);
            $user = DB::table('users')->find($bid[0]->user_id);
            DB::table('users')->where('id',$bid[0]->user_id)->update(['points' => ($user->points +  $bid[0]->price)]);
        }
        
        $split = explode('/', $request->begin_date);

        $begin_date = strtotime($split[1]."/".$split[0]."/".$split[2]);
        $begin_date = date('Y-m-d H:i:s',$begin_date);
        $end_date = strtotime ( $request->state , strtotime ( $begin_date ) );


        $item->name = $request->name;
        $item->status = $request->status;
        $item->price = $request->price;
        $item->content = $request->content;
        $item->begin_date = $begin_date;
        $item->end_date = date( 'Y-m-d H:i:s' , $end_date );

        $item->save();

        return redirect()->route('admin.item.item_detail',['id'=>$item->id])->with('success', 'Update item successfully');
    }

    public function filter(Request $request) {
        $category_id = " category_id = ".$request->category_id;
        $state = " && status = ".$request->state;
        if ($request->category_id === "0") {
            $category_id = "";
            $state = " status = ".$request->state;
        }

        $search = " && name LIKE '".$request->search."%' ";
        if ($request->search == "") {
            $search = "";
        }



        $sql = "SELECT  items.*, user_info.nick_name, IFNULL((SELECT COUNT(item_id) FROM bids WHERE item_id = items.id GROUP BY item_id),0) AS count
                FROM items
                JOIN user_info
                ON items.user_id = user_info.id WHERE $category_id $state $search";

        $result = DB::select($sql);



        return response([
            'status' => 'success',
            'result' => $result,
        ],200);
    }

    public function create() {
        $categories = DB::table('categories')->get();

        return view('admin.modules.item.create',[
            'categories' => $categories,
        ]);
    }
    public function store(StoreRequest $request) {
        $item = new Item;

        $begin_date = strtotime($request->begin_date);
        $begin_date = date('Y-d-m H:i:s',$begin_date);
        $end_date = strtotime ( $request->state , strtotime ( $begin_date ) );
        $file = $request->image;
        $fileName = time() .rand(0,9) .rand(0,9) . '-' . $file->getClientOriginalName();

        $item->name = $request->name;
        $item->content = $request->content;
        $item->image = $fileName;
        $item->price = $request->price;
        $item->status = 3;
        $item->create_date = date('Y-m-d H:i:s');
        $item->begin_date = $begin_date;
        $item->end_date = date( 'Y-m-d H:i:s' , $end_date );
        $item->view = 0;
        $item->user_id = $request->user_id;
        $item->category_id = $request->category;

        $item->save();

        $file->move(public_path('uploads/item/'), $fileName);
        
        return redirect()->back()->with('success', 'Create item successfully');
    }

    public function approve(int $id) {
        $item = Item::findOrFail($id);

        $item->status = 1;

        $item->save();

        return redirect()->back()->with('success', 'Item approved');
    }
}

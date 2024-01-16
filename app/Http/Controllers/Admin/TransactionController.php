<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Bill\UpdateRequest;
use App\Http\Requests\Admin\Bill\StoreRequest;
use App\Http\Requests\Admin\Withdraw\StoreRequest2;
use App\Models\Bill;
use App\Models\Withdraw;
use App\Models\User;
use App\Models\UserInfo;
use DB,Auth;

class TransactionController extends Controller
{
    public function withdraw() {
        $items = DB::table('withdraw_history')->get();
        return view('admin.modules.transaction.withdraw',[
            'items' => $items,
        ]);
    }
    public function recharge() {
        $items = DB::table('bills')->select('bills.*', 'user_info.nick_name')
        ->join('user_info','bills.user_id','=','user_info.id')->get();
        return view('admin.modules.transaction.recharge',[
            'items' => $items,
        ]);
    }

    public function recharge_edit($id) {
        $item = DB::table('bills')->select('bills.*', 'user_info.nick_name')
        ->join('user_info','bills.user_id','=','user_info.id')->where('bills.id',$id)->get();

        return view('admin.modules.transaction.recharge_edit',[
            'item' => $item,
        ]);
    }

    public function update_recharge(Request $request,$id) {
        $bill = Bill::findOrFail($id);

        $bill->status = $request->status;
        $bill->vnd = $request->vnd;
        $bill->eth = $request->eth;
        
        $bill->save();

        return redirect()->back()->with('success', 'Update transaction successfully');
    }

    public function create_recharge() {
        return view('admin.modules.transaction.create_recharge',[
        ]);
    }
    public function store_recharge(StoreRequest $request) {
        $bill = new Bill;

        if ($request->eth <= 0) {
            return redirect()->back()->with('error', 'Invalid ETH value');
        } 

        $bill->status = $request->status;
        $bill->vnd = $request->vnd;
        $bill->eth = $request->eth;
        $bill->user_id = $request->user_id;
        $bill->recharger_id = Auth::user()->id;
        $bill->bill_code =  date('ymd').time().rand(0,9).rand(0,9);
        $bill->create_date = date('Y-m-d H:i:s');

        $bill->save();

        $user = User::findOrFail($bill->user_id);

        $user->points = $bill->eth + $user->points;

        $user->save();

        return redirect()->back()->with('success', 'Create transaction successfully');
    }

    public function edit_withdraw($id) {
        $item = DB::table('withdraw_history')->select('withdraw_history.*', 'user_info.nick_name')
        ->join('user_info','withdraw_history.user_id','=','user_info.id')->get();
        return view('admin.modules.transaction.edit_withdraw',[
            'item' => $item,
        ]);
    }

    public function update_withdraw(Request $request,$id) {
        $withdraw = Withdraw::findOrFail($id);

        $withdraw->status = $request->status;
        $withdraw->vnd = $request->vnd;
        $withdraw->eth = $request->eth;
        $withdraw->account_number = $request->account_number;
        $withdraw->account_name =  $request->account_name;
        $withdraw->bank =  $request->bank;

        $withdraw->save();



        return redirect()->back()->with('success', 'Update transaction successfully');
    }
}

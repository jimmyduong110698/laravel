<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use DB,Auth;

class Withdraw extends Controller
{
    public function withdraw() {
        return view('client.modules.user.withdraw');
    }
    public function withdraw_store(Request $request): RedirectResponse {
        $request->validate([
            'withdraw_eth' => 'required|numeric|min:1|max:1000',
            'account_number' => 'required|numeric',
            'account_name' => 'required|max:255',
        ], [
            'withdraw_eth.required' => 'Please enter eth!',
            'withdraw_eth.min' => 'ETH must be at least 1!',
            'withdraw_eth.max' => 'ETH must not be greater than 1000!',
            'account_name.max' => 'Account name must not be greater than 255!',
        ]);
        DB::table('withdraw_history')->insert([
            'bill_code' => date('ymd').time().rand(0,9).rand(0,9),
            'status' => 1,
            'eth' => $request->withdraw_eth,
            'vnd' => $request->withdraw_eth*9800,
            'user_id' => Auth::user()->id,
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'bank' => $request->bank,
            'create_date' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->where('id',Auth::user()->id)->update(['points' => (Auth::user()->points - $request->withdraw_eth)]);
        return redirect()->route('client.withdraw_success');
    }

    public function withdraw_success() {
        return view('client.modules.user.withdraw-success');
    }
}

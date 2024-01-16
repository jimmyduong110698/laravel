<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Item;
use App\Models\Bill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'ASC')->where('status', '!=', 2)->get();

        return view('admin.modules.user.index', [
            'users' => $users
        ]);
    }

    public function find(Request $request) {
        $sql = "SELECT  user_info.nick_name, user_info.id FROM user_info WHERE nick_name LIKE '".$request->name."%'";
        $result = DB::select($sql);

        return response([
            'status' => 'success',
            'result' => $result,
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.modules.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $user = new User();

        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = 1;
        $user->level = $request->level;
        $user->full_name = $request->full_name;
        $user->phone = $request->phone;
        $user->addresss = $request->address;
        $user->citizen_id = $request->citizen_id;
        $user->date_of_birth = $request->birthday;
        $user->points = 0;

        $user->save();

        DB::table('user_info')->insert([
            'level' => 1,
            'content' => $request->content,
            'nick_name' => $request->nick_name,
            'location' => "VN",
            'gender' => $request->gender,
            'credit_points' => 100,
            'create_date' => date('Y-m-d H:i:s'),
            'avatar' => 'avatar.png',
        ]);

        

        return redirect()->route('admin.user.index')->with('success', 'Create user successfully');
    }

    /**
     * Display the specified resource.
     */
    public function profile()
    {
        $user = DB::table('users')->find(Auth::user()->id);

        return view('admin.modules.user.myprofile', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $user = DB::table('users')
        ->select('users.*', 'user_info.nick_name','user_info.avatar','user_info.gender','user_info.content')
        ->join('user_info','users.id','=','user_info.id')
        ->where('users.id',$id)
        ->get();

        $edit_myself = null;
        if (Auth::user()->id == $id) {
            $edit_myself = true;
        } else {
            $edit_myself = false;
        }

        if (Auth::user()->id != 1 && ($id == 1 || ($user["level"] == 1 && $edit_myself == false))) {
            return redirect()->route('admin.user.index')->with('error', 'You have\'t permission to edit this user');
        }

        return view('admin.modules.user.edit', [
            'id' => $id,
            'user' => $user,
            'myself' => $edit_myself
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $user->email = $user->email;

        if (!empty($request->password)) {
            $request->validate([
                'password' => 'required|confirmed|min:8'
            ], [
                'password.required' => 'Please enter password',
                'password.confirmed' => 'Confirmation password does\'n match'
            ]);

            $user->password = bcrypt($request->password);
        }

        if (Auth::user()->level < $user->level) {
            $user->level = $request->level;
        }

        $user->level = $request->level;
        $user->full_name = $request->full_name;
        $user->phone = $request->phone;
        $user->addresss = $request->address;
        $user->date_of_birth = $request->birthday;

        $user->save();

        DB::table('user_info')->where('id',$id)->update([
            'content' => $request->content,
            'nick_name' => $request->nick_name,
            'gender' => $request->gender,
            
        ]);

        return redirect()->route('admin.user.index')->with('success', 'Update user successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        if ( ($id == Auth::user()->id) || ($user->level == 1)) {
            return redirect()->route('admin.user.index')->with('error', 'You have\'t permission to delete this user');
        }

        $user->status = 2;

        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'Delete user successfully');
    }

    public function activities($id) {
        $user = User::findOrFail($id);
        $items = DB::table(DB::table('items')->select('items.*', 'user_info.nick_name')
        ->join('user_info','items.user_id','=','user_info.id'))->where('user_id',$id)->get();
        $categories = DB::table('categories')->get();
        $bids = DB::table('bids')->select('bids.*', 'user_info.nick_name','user_info.avatar')
        ->join('user_info','bids.user_id','=','user_info.id')->where('user_id',$id)->get();
        $bills = DB::table('bills')->select('bills.*', 'user_info.nick_name')
        ->join('user_info','bills.user_id','=','user_info.id')->where('user_id',$id)->get();
        $withdraws = DB::table('withdraw_history')->where('user_id',$id)->get();
        return view('admin.modules.user.activities',[
            'items' => $items,
            'categories' => $categories,
            'bids' => $bids,
            'bills' => $bills,
            'withdraws' => $withdraws,
            'user' => $user
        ]);
    }
}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserInfo;
use App\Models\User;
use App\Models\Category;
use App\Models\Item;
use App\Http\Requests\Client\CreateUserRequest;
use App\Http\Requests\Client\UpdateUserRequest;
use App\Http\Requests\Client\CreateItemRequest;
use DB,Auth;
use App\Events\Follow;
use App\Events\NewProduct;

class ClientController extends Controller
{
    public function login() {
        return view('client.modules.user.login');
    }
    public function signup() {
        return view('client.modules.user.signup');
    }
    public function create_user(CreateUserRequest $request) {
        $user = new User;

        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = 3;
        $user->full_name = $request->full_name;
        $user->phone = $request->phone;
        $user->citizen_id = $request->citizen_id;
        $user->date_of_birth = $request->date_of_birth;
        $user->addresss = $request->addresss;
        $user->points = $request->points;
        $user->status = 1;
        $user->points = 0;

        $user->save();

        if ($user->id === 1) {
            $user->level = 1;
            $user->save();
        }

        $user_info = new UserInfo;

        $user_info->level = 1;
        $user_info->content = $request->content;
        $user_info->nick_name = $request->nick_name;
        $user_info->location = "VN";
        $user_info->gender = $request->gender;
        $user_info->credit_points = 100;
        $user_info->create_date = date('Y-m-d H:i:s');
        $user_info->avatar = 'avatar.png';

        $user_info->save();

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
       ];
       if (Auth::attempt($credentials)) {
            return  redirect()->route('client.myaccount');
       }
       return redirect()->back(); 
    }
    public function myaccount() {
        $user = DB::table('user_info')->where('id',Auth::user()->id)->get();

        $user_item = DB::table('items')->where('user_id',Auth::user()->id)
        ->select('items.*', 'user_info.nick_name','user_info.avatar')
        ->join('user_info','items.user_id','=','user_info.id')->get();
        
        $notifications = DB::table('notification')
        ->select('notification.*', 'user_info.nick_name','user_info.avatar')
        ->join('user_info','notification.owner_id','=','user_info.id')
        ->where('user_id',Auth::user()->id)->get();
        $categories = Category::get();
        
        return view('client.modules.user.myacc',[
            'user' => $user[0],
            'user_item' => $user_item,
            'notifications' => $notifications,
            'categories' => $categories,
        ]);
    }
    public function account_update(Request $request) {
        $user = DB::table('user_info')->where('id',Auth::user()->id)->get();
        $file = $request->avatar;
        
        if ($file == null) {
            $fileName = $user[0]->avatar;
        } else {
            $fileName = $request->avatar->getClientOriginalName();
            if ($fileName !=  $user[0]->avatar) {
                $old_image_path = public_path('uploads/avatar/'. $user[0]->avatar);
                if (file_exists($old_image_path) && $user[0]->avatar != "avatar.png") {
                    unlink($old_image_path);
                }
                $fileName = time() .rand(0,9) .rand(0,9) . '-' . $file->getClientOriginalName();
                $file->move(public_path('uploads/avatar/'), $fileName);
            } 
        }
        if (!empty($request->password)) {
            $request->validate([
                'password' => 'required|confirmed|min:8'
            ], [
                'password.required' => 'Please enter password',
                'password.confirmed' => 'Confirmation password does\'n match'
            ]);
            DB::table('users')->where('id',Auth::user()->id)->update([    
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'addresss' => $request->addresss,
                'date_of_birth' => $request->date_of_birth,
                'password' => bcrypt($request->password),
            ]);
        } else {
            DB::table('users')->where('id',Auth::user()->id)->update([    
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'addresss' => $request->addresss,
                'date_of_birth' => $request->date_of_birth,
            ]);
        }
        
        DB::table('user_info')->where('id',Auth::user()->id)->update([
            'nick_name' => $request->nick_name,
            'gender' => $request->gender,
            'content' => $request->content,
            'avatar' => $fileName,
        ]);
        return  redirect()->route('client.myaccount');
    }
    public function test() {
        $follower = DB::table('follow')->select('follow.user_id')->where('follow_id',Auth::user()->id)->get();
        $array_follower = array();


        if ($follower->isNotEmpty()) {
            foreach ($follower as $item) {
                array_push($array_follower,$item->user_id);
            }

            for ($x = 0; $x < count($array_follower); $x++) {
                $new_notify[] = [
                    'status' => 2,
                    'owner_id' => Auth::user()->id, //phat thong bao, neu la admin id = 1
                    'user_id' => $array_follower[$x], //nhan thong bao
                    'content' => Auth::user()->full_name." has a new item.",
                    'create_date' => date('Y-m-d H:i:s'),
                ]; 
                
                DB::table('notification')->insert($new_notify);
            };
        }

        event(new NewProduct($array_follower));
    }
    public function uploadnft() {
        $categories = DB::table('categories')->get();

        // $this->test();

        return view('client.modules.user.uploadnft',[
            'categories' => $categories
        ]);
    }
    public function upload_item(CreateItemRequest $request) {
        $date = str_replace('/', '-', $request->begin_date);
        $begin_date = strtotime($date.":00");
        $begin_date = date('Y-m-d H:i:s',$begin_date);
        
        $end_date = strtotime ( $request->end_date , strtotime ( $begin_date ) );
        $end_date = date ( 'Y-m-d H:i:s' , $end_date );

        $file = $request->image;
        $fileName = time() .rand(0,9) .rand(0,9) . '-' . $file->getClientOriginalName();

        $new_nft = new Item;

        $new_nft->name = $request->name;
        $new_nft->content = $request->content;
        $new_nft->image = $fileName;
        $new_nft->price = $request->price;
        $new_nft->status = 3;
        $new_nft->create_date = date('Y-m-d H:i:s');
        $new_nft->begin_date = $begin_date;
        $new_nft->end_date = $end_date;
        $new_nft->view = 0;
        $new_nft->user_id = Auth::user()->id;
        $new_nft->category_id = 1;

        $new_nft->save();

        $follower = DB::table('follow')->select('follow.user_id')->where('follow_id',Auth::user()->id)->get();
        $array_follower = array();
        $nick_name = DB::table('user_info')->select('user_info.nick_name')->find(Auth::user()->id);


        if ($follower->isNotEmpty()) {
            foreach ($follower as $item) {
                array_push($array_follower,$item->user_id);
            }

            for ($x = 0; $x < count($array_follower); $x++) {
                $new_notify[] = [
                    'status' => 2,
                    'owner_id' => Auth::user()->id, //phat thong bao, neu la admin id = 1
                    'user_id' => $array_follower[$x], //nhan thong bao
                    'content' => $nick_name->nick_name." has a new item.",
                    'create_date' => date('Y-m-d H:i:s'),
                ]; 
                
                DB::table('notification')->insert($new_notify);
            };
        }

        event(new NewProduct($array_follower));
        
        $file->move(public_path('uploads/item/'), $fileName);
        return redirect()->back();
    }

    public function follow_check(int $id) {
        $data = DB::table('follow')->where('user_id',Auth::user()->id)
        ->where('follow_id',$id)->get();
        if (!empty($data[0])) {
            return true;
        } else {
            return false;
        }
    }

    public function follow(Request $request) {
        if ($this->follow_check($request->followID) == true) {
            DB::table('follow')->where('user_id', Auth::user()->id)
            ->where('follow_id',$request->followID)->update(['status'=>1]);
        } else {
            DB::table('follow')->insert([
                'user_id' => Auth::user()->id,
                'follow_id' => $request->followID,
                'status' => 1
            ]);
        }
        $follower_name = DB::table('user_info')->select('user_info.nick_name')->find(Auth::user()->id);
        $new_notify[] = [
            'status' => 2,
            'owner_id' => Auth::user()->id, //phat thong bao, neu la admin id = 1
            'user_id' => $request->followID, //nhan thong bao
            'content' => $follower_name->nick_name." has started following you.",
            'create_date' => date('Y-m-d H:i:s'),
        ]; 
        DB::table('notification')->insert($new_notify);
        event(new Follow($request->followID,"Hello"));
        return response([
            'status' => 'success',
            'result' =>  $request->followID,
        ],200);
    }
    public function unfollow(Request $request) {
        DB::table('follow')->where('user_id', Auth::user()->id)
        ->where('follow_id',$request->followID)->update(['status'=>0]);
       
        return response([
            'status' => 'success',
            'result' =>  $request->followID,
        ],200);
    }
}

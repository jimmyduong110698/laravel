<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB,Auth;

class RechargeController extends Controller
{
    public function recharge() {
        return view('client.modules.user.recharge');
    }

    public function vn_payment(Request $request) {
        $data=$request->all();
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('client.bill_check');
        $vnp_TmnCode = "6KO3AZQ5";//Mã website tại VNPAY 
        $vnp_HashSecret = "DJZLYZOKXHITLUGSOVSVJBOZJGAFPAPH"; //Chuỗi bí mật

        $vnp_TxnRef = date('ymd').time().rand(0,9).rand(0,9); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toan hoa don";
        $vnp_OrderType = "NFT Bid";
        $vnp_Amount = $data['recharge']*10000* 100;
        $vnp_Locale = "US";
        $vnp_BankCode = $data['bank'];
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
        );

        DB::table('bills')->insert([
            'bill_code' => $vnp_TxnRef,
            'status' => 2,
            'eth' => $data['recharge'],
            'vnd' => $data['recharge']*10000,
            'user_id' => Auth::user()->id,
            'recharger_id' => Auth::user()->id,
            'create_date' => date('d/m/Y H:i:s')
        ]);

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo
    }

    public function bill_check() {
        $inputData = array();
        $returnData = array();
        $vnp_TmnCode = "6KO3AZQ5";//Mã website tại VNPAY 
        $vnp_HashSecret = "DJZLYZOKXHITLUGSOVSVJBOZJGAFPAPH"; //Chuỗi bí mật

        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
        $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
        $vnp_Amount = $inputData['vnp_Amount']/100; // Số tiền thanh toán VNPAY phản hồi

        $Status = 0; // Là trạng thái thanh toán của giao dịch chưa có IPN lưu tại hệ thống của merchant chiều khởi tạo URL thanh toán.
        $orderId = $inputData['vnp_TxnRef'];

        try {
            //Check Orderid    
            //Kiểm tra checksum của dữ liệu
            if ($secureHash == $vnp_SecureHash) {
                //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId            
                //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
                //Giả sử: $order = mysqli_fetch_assoc($result);   

                $order = DB::table('bills')->where('bill_code',$inputData['vnp_TxnRef'])->get();
                if ($order != NULL) {
                    if($order[0]->vnd == $vnp_Amount) //Kiểm tra số tiền thanh toán của giao dịch: giả sử số tiền kiểm tra là đúng. //$order["Amount"] == $vnp_Amount
                    {
                        if ($order[0]->status != NULL && $order[0]->status == 2) {
                            if ($inputData['vnp_ResponseCode'] == '00' || $inputData['vnp_TransactionStatus'] == '00') {
                                DB::table('users')->where('id',Auth::user()->id)->update(['points' => Auth::user()->points + ($vnp_Amount/10000)]);
                                DB::table('bills')->where('bill_code',$inputData['vnp_TxnRef'])->update(['status' => 1]);
                                return  redirect()->route('client.bill_success',['vnp_TxnRef'=>$inputData['vnp_TxnRef'],'vnp_Amount'=> ($vnp_Amount/10000)]);
                            } else {
                                DB::table('bills')->where('bill_code',$inputData['vnp_TxnRef'])->update(['status' => 3]);
                                return  redirect()->route('client.bill_error');
                            }            
                        } else {
                            DB::table('bills')->where('bill_code',$inputData['vnp_TxnRef'])->update(['status' => 3]);
                            return  redirect()->route('client.bill_error',['RspCode'=>'02','Message'=> 'Order already confirmed']);
                        }
                    }
                    else {
                        DB::table('bills')->where('bill_code',$inputData['vnp_TxnRef'])->update(['status' => 3]);
                        return  redirect()->route('client.bill_error',['RspCode'=>'04','Message'=> 'invalid amount']);
                    }
                } else {
                    DB::table('bills')->where('bill_code',$inputData['vnp_TxnRef'])->update(['status' => 3]);
                    return  redirect()->route('client.bill_error',['RspCode'=>'01','Message'=> 'Order not found']);
                }
            } else {
                DB::table('bills')->where('bill_code',$inputData['vnp_TxnRef'])->update(['status' => 3]);
                return  redirect()->route('client.bill_error',['RspCode'=>'97','Message'=> 'Invalid signature']);
            }
        } catch (Exception $e) {
            DB::table('bills')->where('bill_code',$inputData['vnp_TxnRef'])->update(['status' => 3]);
            return  redirect()->route('client.bill_error',['RspCode'=>'99','Message'=> 'Unknow error']);
        }
    }

    public function bill_success() {
        return  view('client.modules.user.bill');
    }
    public function bill_error() {
        return  view('client.modules.user.bill_error');
    }
}

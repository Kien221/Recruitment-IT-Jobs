<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    public function buy_service_view(){
        $packages_service = DB::table('services')
                            ->get();
        return view('hr_view.BuyServicesView',compact('packages_service'));
    }
    public function cart_service_view(request $request,$service_id){
        $service = DB::table('services')
                    ->where('id',$service_id)
                    ->first();
        return view('hr_view.CartServicesView',compact('service'));
    }
    function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}

    public function payment_VNPAY($service_id){
        $service = DB::table('services')
                    ->where('id',$service_id)
                    ->first();
                    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
                    $partnerCode = 'MOMOBKUN20180529';
                    $accessKey = 'klm05TvNBzhg7h7j';
                    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
                    $orderInfo = "Thanh toán qua MoMo";
                    $amount = $service->price;
                    $orderId = time() . "";
                    $redirectUrl = "http://localhost:8000/index/hr";
                    $ipnUrl = "http://localhost:8000/index/hr";
                    $extraData = "";
                    
                        $requestId = time() . "";
                        $requestType = "payWithATM";
                        //before sign HMAC SHA256 signature
                        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                        $signature = hash_hmac("sha256", $rawHash, $secretKey);
                        $data = array('partnerCode' => $partnerCode,
                            'partnerName' => "Test",
                            "storeId" => "MomoTestStore",
                            'requestId' => $requestId,
                            'amount' => $amount,
                            'orderId' => $orderId,
                            'orderInfo' => $orderInfo,
                            'redirectUrl' => $redirectUrl,
                            'ipnUrl' => $ipnUrl,
                            'lang' => 'vi',
                            'extraData' => $extraData,
                            'requestType' => $requestType,
                            'signature' => $signature);
                        $result = $this->execPostRequest($endpoint, json_encode($data));
                        $jsonResult = json_decode($result, true);  // decode json
                        $hr_id = session('id_hr');
                        $service_id = $service->id;
                        $find_level_account = DB::table('level_account')
                                            ->where('hr_id',$hr_id)
                                            ->where('service_id',$service_id)
                                            ->first();
                        if(!$find_level_account){
                            DB::table('level_account')->insert([
                                'hr_id' => $hr_id,
                                'service_id' => $service_id,
                                'used_views' => 0, 
                                'used_search'=>0
                            ]);
                            $success = "Chúc mừng bạn đã mua gói dịch vụ thành công";
                            session()->flash('success', $success);
                            return redirect()->to($jsonResult['payUrl']);

                        }
                        else{
                            return redirect()->to($jsonResult['payUrl']);
                        }
    }

}

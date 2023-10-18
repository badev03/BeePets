<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Order_detail;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bill::query()->where('customer_name', '!=', null)->where('total_amount', '>', 0)->get();
        return view('admin.purchase.index', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     */
//    public function create()
//    {
//        $products = Products::all();
//        return view('orders.create', compact('products'));
//    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function checkout()
    {
        return view('admin.checkout.index');
    }
    public function cash(Request $request) {
        $bill = Bill::query()->create(
            [
                'code' => 'DH' . rand(100000, 999999),
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'status' => 1,
                'total_amount' => $request->total_price,
                'note' => 'Thanh toán tại quầy',
                'transaction_type' => 2,
            ]
        );
        $bill_id = $bill->id;
        $carts = session()->get('carts');
        foreach ($carts as $key => $value) {
            Order_detail::query()->create(
                [
                    'bill_id' => $bill_id,
                    'product_id' => $key,
                    'quantity' => $value['quantity'],
                    'unit_price' => $value['price'],
                ]
            );
        }
        session()->forget('carts');
        return redirect()->route('purchase.index')->with('success', 'Đặt hàng thành công!');
    }

    public function vnpay(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('checkout.vnpay_return');
        $vnp_TmnCode = "QLOLENH7";//Mã website tại VNPAY
        $vnp_HashSecret = "TBWOTRYHZBSTLLGFWYSXBZLNGXZUTAMT"; //Chuỗi bí mật
        $vnp_TxnRef = 'DH' . rand(100000, 999999);
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $_POST['total_price'] * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $vnp_OrderInfo = $request->customer_name . '|' . $request->customer_phone .'|'. $request->customer_email;
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
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

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
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
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
    }

    public function vnpayReturn(Request $request)
    {
        if($request->vnp_ResponseCode == '00' && $request->vnp_TransactionStatus == '00'){
            //code  customer_name customer_email  customer_phone  status  total_price  note  user_id  payment_method
            $infoUser = $request->vnp_OrderInfo;
            $parts  = explode('|', $infoUser);
            $customer_name = $parts[0];
            $customer_phone = $parts[1];
            $customer_email = $parts[2];
            $total_price = $request->vnp_Amount / 100;
            $code = $request->vnp_TxnRef;
            Bill::query()->create(
                [
                    'code' => $code,
                    'customer_name' => $customer_name,
                    'customer_phone' => $customer_phone,
                    'status' => 1,
                    'total_amount' => $total_price,
                    'note' => 'Thanh toán tại quầy',
                    'transaction_type' => 1,
                ]
            );
            $bill_id = Bill::query()->where('code', $code)->first()->id;
            $carts = session()->get('carts');
            foreach ($carts as $key => $value) {
                Order_detail::query()->create(
                    [
                        'bill_id' => $bill_id,
                        'product_id' => $key,
                        'quantity' => $value['quantity'],
                        'unit_price' => $value['price'],
                    ]
                );
            }
            session()->forget('carts');
            return redirect()->route('products.index')->with('success', 'Đặt hàng thành công!');
        }
    }
    public function momoPay(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
        $notifyurl = "http://localhost:8000/paymomo/ipn_momo.php";
        $partnerCode = "MOMOBKUN20180529";
        $accessKey = "klm05TvNBzhg7h7j";
        $serectkey = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";
        $orderId = 'DH' . rand(100000, 999999); // Mã đơn hàng
        $orderInfo = 'Thanh toan don hang DH' . rand(100000, 999999);
        $amount = $_POST["total_price"];
        $returnUrl = "http://localhost:8000/paymomo/result.php";
        $requestId = time() . "";
        $requestType = "captureMoMoWallet";
        $extraData = "merchantName=;merchantId=";
        $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyurl . "&extraData=" . $extraData;
        $signature = hash_hmac("sha256", $rawHash, $serectkey);

        $data = array('partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'notifyUrl' => $notifyurl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json
        header('Location: ' . $jsonResult['payUrl']);
    }

    public function execPostRequest($url, $data)
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

    public function momoReturn()
    {

    }
}

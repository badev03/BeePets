<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendMailEvent;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Order_detail;
use App\Models\Products;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use PDF;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bill::where('transaction_type', 2)->get();
        return view('admin.purchase.index', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thanh toán tại quầy';
        $carts = session()->get('carts');
        return view('admin.checkout.index', compact('carts', 'title'));
    }

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
        $bill = Bill::query()->findOrFail($id);
        $order_details = Order_detail::query()->where('bill_id', $id)->get();
        return view('admin.purchase.show', compact('bill', 'order_details'));
    }
    public function printOrder($id) {
        $bill = Bill::query()->findOrFail($id);
        $order_details = Order_detail::query()->where('bill_id', $id)->get();
        $pdf = PDF::loadView('admin.purchase.invoice', compact('bill', 'order_details'));
        return $pdf->download('invoice1.pdf');
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
        try {
            $model = Bill::query()->findOrFail($id);
            $model->status = $request->status;
            $order_details = Order_detail::query()->where('bill_id', $id)
                ->join('products', 'products.id', '=', 'order_details.product_id')
                ->select('order_details.*', 'products.name as product_name')
                ->get();
            foreach ($order_details as $order_detail) {
                $product = Products::query()->find($order_detail->product_id);
                $product->quantity = $product->quantity + $order_detail->quantity;
                $product->save();
            }
            $model->save();
            $data = [
                'title' => 'Đơn hàng ' . $model->code . ' đã được cập nhật trạng thái',
                'content' => 'Đơn hàng ' . $model->code . ' đã được cập nhật trạng thái '
                    . ($model->status == 3 ? 'Đã hoàn trả' : ' ') .' vào lúc ' . date('H:i:s d-m-Y', strtotime($model->updated_at)),
                'email' => $model->customer_email,
                'name' => $model->customer_name,
                'phone' => $model->customer_phone,
                'code' => $model->code,
                'total_amount' => $model->total_amount,
                'status' => $model->status == 1 ? 'Đã thanh toán' : ($model->status == 2 ? 'Đã hủy' : ($model->status == 3 ? 'Đã hoàn trả' : 'Đã hủy')),
                'payment_method' => $model->payment_method == 1 ? 'Thanh toán tại quầy (Tiền mặt)' : 'Thanh toán online (VNPAY)',
                'order_detail' => $order_details,
            ];
            if(!empty($data)) {
                if($data['email'] != null) {
                    event(new SendMailEvent($data));
                }
            }

            Toastr::success('Cập nhật trạng thái thành công!', 'Success');
        } catch (\Exception $exception) {
            Toastr::error('Cập nhật trạng thái thất bại!', 'Error');
        }
        return redirect()->route('purchase.index');
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

    public function cash(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_phone' => 'required',
        ],
            [
                'customer_name.required' => 'Vui lòng nhập tên khách hàng',
                'customer_phone.required' => 'Vui lòng nhập số điện thoại khách hàng',
            ]
        );
        try {
            $bill = Bill::query()->create(
                [
                    'code' => 'DH' . rand(100000, 999999),
                    'customer_name' => $request->customer_name,
                    'customer_phone' => $request->customer_phone,
                    'customer_email' => $request->customer_email,
                    'status' => 1,
                    'total_amount' => $request->total_price,
                    'note' => 'Thanh toán tại quầy',
                    'transaction_type' => 2,
                    'payment_method' => 1,
                ]
            );
            $bill_id = $bill->id;
            $carts = session()->get('carts');

            foreach ($carts as $key => $value) {
                $this->updateQuantity($key, $value['quantity']);
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
            Toastr::success('Đặt hàng thành công!', 'Success');
            return redirect()->route('purchase.index');
        } catch (\Exception $exception) {
            Toastr::error('Đặt hàng thất bại!', 'Error');
        }
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
        $vnp_OrderInfo = $request->customer_name . '|' . $request->customer_phone . '|' . $request->customer_email;
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
        try {
            if ($request->vnp_ResponseCode == '00' && $request->vnp_TransactionStatus == '00') {
                //code  customer_name customer_email  customer_phone  status  total_price  note  user_id  payment_method
                $infoUser = $request->vnp_OrderInfo;
                $parts = explode('|', $infoUser);
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
                        'customer_email' => $customer_email,
                        'status' => 1,
                        'total_amount' => $total_price,
                        'note' => 'Thanh toán tại quầy',
                        'transaction_type' => 2,
                        'payment_method' => 2,
                    ]
                );
                $bill_id = Bill::query()->where('code', $code)->first()->id;
                $carts = session()->get('carts');
                foreach ($carts as $key => $value) {
                    $this->updateQuantity($key, $value['quantity']);
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
                Toastr::success('Đặt hàng thành công!', 'Success');
            }
        } catch (\Exception $exception) {
            Toastr::error('Đặt hàng thất bại!', 'Error');
        }
        return redirect()->route('purchase.index');
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


    //khi đặt hàng xong thì số lượng sản phẩm sẽ bị trừ đi
    public function updateQuantity($id, $quantity)
    {
        $product = Products::query()->find($id);
        $product->quantity = $product->quantity - $quantity;
        $product->save();
    }


}

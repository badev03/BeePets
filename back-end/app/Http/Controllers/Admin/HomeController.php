<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminNotification;
use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Interfaces\MessageUser;
use App\Models\Bill;
use App\Models\Notification;
use App\Models\Product_categories;
use App\Models\Products;
use App\Notifications\SmsNotificationBeepets;
use App\Traits\QueryCommon;
//use ConsoleTVs\Charts\Classes\C3\Chart;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
use Pusher\Pusher;
//use ConsoleTVs\Charts\
use App\Charts\MyChart;
class HomeController extends Controller
{

    use QueryCommon;
    public function index() {
        $totalAmount = DB::table('bills')->sum('total_amount');
        $totalAmountMonth = DB::table('bills')->whereMonth('created_at', date('m'))->sum('total_amount');
        $totalAmountLastMonth = DB::table('bills')->whereMonth('created_at', date('m', strtotime('-1 month')))->sum('total_amount');
        $totalAmountYear = DB::table('bills')->whereYear('created_at', date('Y'))->sum('total_amount');
        $totalOrder = Bill::where('status', 1)->count();
        $totalOrderNeedPay = Bill::where('status', 0)->where('transaction_type',2)->count();
        $totalOrderReturn = Bill::where('status', 3)->where('transaction_type',2)->count();
        $totalOrderCancel = Bill::where('status', 2)->where('transaction_type',2)->count();
        $totalProducts = Products::query()->count();
        $totalProductCategory = Product_categories::query()->count();
        $bestSeller = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select('products.name','products.price','products.image', DB::raw('SUM(order_details.quantity) as total'))
            ->groupBy('products.name','products.price','products.image')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();
        $months = range(1, 12);
        $totalAmountMonth1 = DB::table('bills')->whereMonth('created_at', 1)->sum('total_amount');
        $totalAmountMonth2 = DB::table('bills')->whereMonth('created_at', 2)->sum('total_amount');
        $totalAmountMonth3 = DB::table('bills')->whereMonth('created_at', 3)->sum('total_amount');
        $totalAmountMonth4 = DB::table('bills')->whereMonth('created_at', 4)->sum('total_amount');
        $totalAmountMonth5 = DB::table('bills')->whereMonth('created_at', 5)->sum('total_amount');
        $totalAmountMonth6 = DB::table('bills')->whereMonth('created_at', 6)->sum('total_amount');
        $totalAmountMonth7 = DB::table('bills')->whereMonth('created_at', 7)->sum('total_amount');
        $totalAmountMonth8 = DB::table('bills')->whereMonth('created_at', 8)->sum('total_amount');
        $totalAmountMonth9 = DB::table('bills')->whereMonth('created_at', 9)->sum('total_amount');
        $totalAmountMonth10 = DB::table('bills')->whereMonth('created_at', 10)->sum('total_amount');
        $totalAmountMonth11 = DB::table('bills')->whereMonth('created_at', 11)->sum('total_amount');
        $totalAmountMonth12 = DB::table('bills')->whereMonth('created_at', 12)->sum('total_amount');
        $totalAmountMonth1LastYear = DB::table('bills')->whereMonth('created_at', 1)->whereYear('created_at', date('Y', strtotime('-1 year')))->sum('total_amount');
        $totalAmountMonth2LastYear = DB::table('bills')->whereMonth('created_at', 2)->whereYear('created_at', date('Y', strtotime('-1 year')))->sum('total_amount');
        $totalAmountMonth3LastYear = DB::table('bills')->whereMonth('created_at', 3)->whereYear('created_at', date('Y', strtotime('-1 year')))->sum('total_amount');
        $totalAmountMonth4LastYear = DB::table('bills')->whereMonth('created_at', 4)->whereYear('created_at', date('Y', strtotime('-1 year')))->sum('total_amount');
        $totalAmountMonth5LastYear = DB::table('bills')->whereMonth('created_at', 5)->whereYear('created_at', date('Y', strtotime('-1 year')))->sum('total_amount');
        $totalAmountMonth6LastYear = DB::table('bills')->whereMonth('created_at', 6)->whereYear('created_at', date('Y', strtotime('-1 year')))->sum('total_amount');
        $totalAmountMonth7LastYear = DB::table('bills')->whereMonth('created_at', 7)->whereYear('created_at', date('Y', strtotime('-1 year')))->sum('total_amount');
        $totalAmountMonth8LastYear = DB::table('bills')->whereMonth('created_at', 8)->whereYear('created_at', date('Y', strtotime('-1 year')))->sum('total_amount');
        $totalAmountMonth9LastYear = DB::table('bills')->whereMonth('created_at', 9)->whereYear('created_at', date('Y', strtotime('-1 year')))->sum('total_amount');
        $totalAmountMonth10LastYear = DB::table('bills')->whereMonth('created_at', 10)->whereYear('created_at', date('Y', strtotime('-1 year')))->sum('total_amount');
        $totalAmountMonth11LastYear = DB::table('bills')->whereMonth('created_at', 11)->whereYear('created_at', date('Y', strtotime('-1 year')))->sum('total_amount');
        $totalAmountMonth12LastYear = DB::table('bills')->whereMonth('created_at', 12)->whereYear('created_at', date('Y', strtotime('-1 year')))->sum('total_amount');

        return view('admin.dashboard.dashboard',
            compact('totalAmount', 'totalOrder', 'totalOrderCancel', 'totalAmountMonth',
                'totalAmountLastMonth', 'totalAmountYear', 'totalOrderReturn', 'totalOrderNeedPay', 'totalAmountMonth1LastYear', 'totalAmountMonth2LastYear', 'totalAmountMonth3LastYear', 'totalAmountMonth4LastYear', 'totalAmountMonth5LastYear', 'totalAmountMonth6LastYear', 'totalAmountMonth7LastYear', 'totalAmountMonth8LastYear', 'totalAmountMonth9LastYear', 'totalAmountMonth10LastYear', 'totalAmountMonth11LastYear', 'totalAmountMonth12LastYear',
                'totalProducts', 'totalProductCategory', 'bestSeller', 'totalAmountMonth1','totalAmountMonth2', 'totalAmountMonth3', 'totalAmountMonth4', 'totalAmountMonth5', 'totalAmountMonth6', 'totalAmountMonth7', 'totalAmountMonth8', 'totalAmountMonth9', 'totalAmountMonth10', 'totalAmountMonth11', 'totalAmountMonth12'));
    }


    public function uploadImg(Request $request) {
        if($request->has('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName , PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName .'_'.time().'_'.$extension;
            $request->file('upload')->move(public_path('media') , $fileName);
            $url = asset('media/'. $fileName);
            return response()->json([
                'fileName' => $fileName , 'uploaded' => 1, 'url' => $url
            ]);
        }
    }

    public function upload(Request $request) {
        $uploadedFileUrl = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
    }

    public function Pusher() {
        $userId = 3;

        $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), [
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'useTLS' => config('broadcasting.connections.pusher.options.useTLS'),
        ]);

        $data = ['message' => 'Đây là thông báo mất kỳ. le huy dat test'];

        // Gửi thông báo đến kênh riêng của người dùng
        $pusher->trigger("private-user-3", 'notification-event', $data);
        Notification::create([
            'user_id' => $userId,
            'message' => $data['message'],
        ]);
        return response()->json(['message' => 'Thông báo đã được gửi']);
    }


    public function SendNotification(Request $request) {
        $user_id = $request->input('user_id');
        $message = $request->input('message');
        Notification::create([
            'user_id' => $user_id,
            'message' => $message,
        ]);
        $userId = 3;

        $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), [
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'useTLS' => config('broadcasting.connections.pusher.options.useTLS'),
        ]);

        $data = ['message' => $message , 'now' => now()];

        $pusher->trigger("user-notification-$userId", 'notification-event', $data);
        return response()->json(
            ['msg' => 'đã gửi thông báo thành công']
        , 200);
    }

    public function PusherView() {
        return view('api.pusher');
    }

    public function PusherView2() {
        return view('api.pusher_2');
    }

    public function pusherApi(MessageUser $messageService) {
        $messageService->sendMessage(3, 'Vũ anh bá');
    }

    public function indexAdmin() {
        if(\auth()->check()) {
            if(auth()->user()->hasAnyRole(['Admin', 'User' , 'Staff'])) {
                return redirect()->route('dashboard');
            }else {
                return view('admin.users.login');
            }
        }
        else {
            return view('admin.users.login');
        }
    }

    public function QueueTest() {
        $jobs = Queue::getJobs('TimeLineNotification');
        dd($jobs);
    }


    public function testSMS() {
        /**
         * Tiếp theo tạo một instance của class SpeedSMSAPI và truyền vào tham số là api access token của bạn.
         */
        $smsAPI = new SmsNotificationBeepets("sZU_gcsQQIVSa1xWStK8HUGXQi8zZMvV");
//        /**
//         * Để lấy thông tin về tài khoản như: email, số dư tài khoản bạn sử dụng hàm getUserInfo()
//         */
//
        $userInfo = $smsAPI->getUserInfo();
//        /* * Hàm getUserInfo() sẽ trả về một mảng như sau:
//         * /
//        ["email"=>"test@speedsms.vn", "balance" =>100000.0, "currency" => "VND"]
//
//        /** Để gửi SMS bạn sử dụng hàm sendSMS như sau:
//        */
        $phones = ["84981608298"];
//        /* tối đa 100 số cho 1 lần gọi API */
        $content = "tôi đang test dữ liệu";
        $type = 1;
//
        $response = $smsAPI->sendSMS($phones, $content, $type, '84981608298');
        if($response) {
            dd($response);
        }
//
///**
//sms_type có các giá trị như sau:
//2: tin nhắn gửi bằng đầu số ngẫu nhiên
//3: tin nhắn gửi bằng brandname
//4: tin nhắn gửi bằng brandname mặc định (Verify hoặc Notify)
//5: tin nhắn gửi bằng app android
// */
//$sender = "brandname";
///**
//brandname là tên thương hiệu hoặc số điện thoại đã đăng ký với SpeedSMS
// */
//
//$response = $smsAPI->sendSMS($phones, $content, $type, $sender);
//
///**hàm sendSMS sẽ trả về một mảng như sau:*/
//[
//    "status"=>"success", "code"=> "00",
//    "data"=>[
//        "tranId"=>123456, "totalSMS"=>2,
//        "totalPrice"=>500, "invalidPhone"=>[]
//    ]
//]
//*/
//// Trong trường hợp gửi sms bị lỗi, hàm sendSMS sẽ trả về mảng như sau:
//[
//    "status"=>"error", "code"=>"error code", "message" => "error description",
//    "invalidPhone"=>["danh sách sdt lỗi"]
//];

///** Để gửi VOICE OTP bạn sử dụng hàm sendVoice như sau:
// */
//$phone = "8491xxxxx";
//$content = "xxxx";
///* nội dung chỉ chứa mã code, ví dụ: 1234 */
//$response = $smsAPI->sendVoice($phone, $content);
//
///**hàm sendVoice sẽ trả về một mảng như sau:*/
//[
//    "status"=>"success", "code"=> "00",
//    "data"=>[
//        "tranId"=>123456,
//        "totalPrice"=>400, "invalidPhone"=>[]
//    ]
//]
//*/
//// Trong trường hợp gửi voice otp bị lỗi, hàm sẽ trả về mảng như sau:
//[
//    "status"=>"error", "code"=>"error code", "message" => "error description",
//    "invalidPhone"=>["danh sách sdt lỗi"]
//]
    }
}


<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Product_categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public $title = 'Thông kê sản phẩm';
    public function index()
    {
        $totalAmount = DB::table('bills')->sum('total_amount');
        $totalAmountMonth = DB::table('bills')->whereMonth('created_at', date('m'))->sum('total_amount');
        $totalAmountLastMonth = DB::table('bills')->whereMonth('created_at', date('m', strtotime('-1 month')))->sum('total_amount');
        $totalAmountYear = DB::table('bills')->whereYear('created_at', date('Y'))->sum('total_amount');
        $totalOrder = Bill::where('status', 1)->count();
        $totalOrderNeedPay = Bill::where('status', 0)->where('transaction_type', 2)->count();
        $totalOrderReturn = Bill::where('status', 3)->where('transaction_type', 2)->count();
        $totalOrderCancel = Bill::where('status', 2)->where('transaction_type', 2)->count();
        $totalProducts = Products::query()->count();
        $totalProductCategory = Product_categories::query()->count();
        $bestSeller = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select('products.name', 'products.price', 'products.image', DB::raw('SUM(order_details.quantity) as total'))
            ->groupBy('products.name', 'products.price', 'products.image')
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

        $totalAmountWeek1LastMonth = DB::table('bills')->whereBetween('created_at', [date('Y-m-d', strtotime('-1 month -1 week')), date('Y-m-d', strtotime('-1 month'))])->sum('total_amount');
        $totalAmountWeek2LastMonth = DB::table('bills')->whereBetween('created_at', [date('Y-m-d', strtotime('-1 month -2 week')), date('Y-m-d', strtotime('-1 month -1 week'))])->sum('total_amount');
        $totalAmountWeek3LastMonth = DB::table('bills')->whereBetween('created_at', [date('Y-m-d', strtotime('-1 month -3 week')), date('Y-m-d', strtotime('-1 month -2 week'))])->sum('total_amount');
        $totalAmountWeek4LastMonth = DB::table('bills')->whereBetween('created_at', [date('Y-m-d', strtotime('-1 month -4 week')), date('Y-m-d', strtotime('-1 month -3 week'))])->sum('total_amount');
        $totalAmountWeek1 = DB::table('bills')->whereBetween('created_at', [date('Y-m-d', strtotime('-1 week')), date('Y-m-d')])->sum('total_amount');
        $totalAmountWeek2 = DB::table('bills')->whereBetween('created_at', [date('Y-m-d', strtotime('-2 week')), date('Y-m-d', strtotime('-1 week'))])->sum('total_amount');
        $totalAmountWeek3 = DB::table('bills')->whereBetween('created_at', [date('Y-m-d', strtotime('-3 week')), date('Y-m-d', strtotime('-2 week'))])->sum('total_amount');
        $totalAmountWeek4 = DB::table('bills')->whereBetween('created_at', [date('Y-m-d', strtotime('-4 week')), date('Y-m-d', strtotime('-3 week'))])->sum('total_amount');

        //doanh thu theo $date
        $totalAmountToday = DB::table('bills')->whereDate('created_at', date('Y-m-d'))->sum('total_amount');
        return view('admin.statistic.index',compact(
            'totalAmount',
            'totalAmountLastMonth',
            'totalAmountToday',
            'totalAmountWeek1',
            'totalAmountWeek2',
            'totalAmountWeek3',
            'totalAmountWeek4',
            'totalAmountWeek1LastMonth',
            'totalAmountWeek2LastMonth',
            'totalAmountWeek3LastMonth',
            'totalAmountWeek4LastMonth',
            'totalOrder',
            'totalOrderCancel',
            'totalAmountMonth',
            'totalAmountLastMonth',
            'totalAmountYear',
            'totalOrderReturn',
            'totalOrderNeedPay',
            'totalAmountMonth1LastYear',
            'totalAmountMonth2LastYear',
            'totalAmountMonth3LastYear',
            'totalAmountMonth4LastYear',
            'totalAmountMonth5LastYear',
            'totalAmountMonth6LastYear',
            'totalAmountMonth7LastYear',
            'totalAmountMonth8LastYear',
            'totalAmountMonth9LastYear',
            'totalAmountMonth10LastYear',
            'totalAmountMonth11LastYear',
            'totalAmountMonth12LastYear',
            'totalProducts',
            'totalProductCategory',
            'bestSeller',
            'totalAmountMonth1',
            'totalAmountMonth2',
            'totalAmountMonth3',
            'totalAmountMonth4',
            'totalAmountMonth5',
            'totalAmountMonth6',
            'totalAmountMonth7',
            'totalAmountMonth8',
            'totalAmountMonth9',
            'totalAmountMonth10',
            'totalAmountMonth11',
            'totalAmountMonth12',
            'totalAmountWeek1LastMonth',
        ));
    }
    public function getByDate(Request $request)
    {
        $date = $request->input('date');

        if (!$date) {
            $date = now()->toDateString();
        }

        $data = DB::table('bills')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total_amount'))
            ->whereDate('created_at', $date)
            ->groupBy('date')
            ->get();

        return response()->json($data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AnalysisController extends Controller
{
    public function index() {

        $startDate = '2022-01-01';
        $endDate = '2023-01-31';

        // $period = Order::betweenDate($startDate, $endDate)
        // ->groupBy('id')
        // ->selectRaw('id, sum(subtotal) as total, customer_name, status, created_at')
        // ->orderBy('created_at')
        // ->paginate(50);

        // $subQuery = Order::betweenDate($startDate, $endDate)
        // ->where('status', true)
        // ->groupBy('id')
        // ->selectRaw('id, SUM(subtotal) as totalPerPurchase, DATE_FORMAT(created_at, "%Y%m%d") as date');

        // $data = DB::table($subQuery)
        // ->groupBy('date')
        // ->selectRaw('date, sum(totalPerPurchase) as total')
        // ->get();

        // 1. 購買ID毎にまとめる
        // $subQuery = Order::betweenDate($startDate, $endDate)
        // ->groupBy('id')
        // ->selectRaw('id, customer_id, customer_name,
        // SUM(subtotal) as totalPerPurchase, created_at');

        // // 2. 会員毎にまとめて最終購入日、回数、合計金額を 取得
        // $subQuery = DB::table($subQuery)
        // ->groupBy('customer_id')
        // ->selectRaw('customer_id, customer_name,
        // max(created_at) as recentDate,
        // datediff(now(), max(created_at)) as recency,
        // count(customer_id) as frequency,
        // sum(totalPerPurchase) as monetary');

        // // dd($subQuery);

        // // 4. 会員毎のRFMランクを計算
        // $subQuery = DB::table($subQuery)
        // ->selectRaw('customer_id, customer_name,
        // recentDate, recency,
        // frequency, monetary,
        // case
        //     when recency < 14 then 5
        //     when recency < 28 then 4
        //     when recency < 60 then 3
        //     when recency < 90 then 2
        //     else 1 end as r,
        // case
        //     when 7 <= frequency then 5
        //     when 5 <= frequency then 4
        //     when 3 <= frequency then 3
        //     when 2 <= frequency then 2
        //     else 1 end as f,
        // case
        //     when 300000 <= monetary then 5
        //     when 200000 <= monetary then 4
        //     when 100000 <= monetary then 3
        //     when 30000 <= monetary then 2
        //     else 1 end as m')->get();

        // dd($subQuery);

        // 5.ランク毎の数を計算する
        // $total = DB::table($subQuery)->count();

        // $rCount = DB::table($subQuery)
        // ->groupBy('r')
        // ->selectRaw('r, count(r)')
        // ->orderBy('r', 'desc')
        // ->get();

        // $fCount = DB::table($subQuery)
        // ->groupBy('f')
        // ->selectRaw('f, count(f)')
        // ->orderBy('f', 'desc')
        // ->get();

        // $mCount = DB::table($subQuery)
        // ->groupBy('m')
        // ->selectRaw('m, count(m)')
        // ->orderBy('m', 'desc')
        // ->get();

        // dd($total, $rCount, $fCount, $mCount);

        return Inertia::render('Analysis');
    }
}

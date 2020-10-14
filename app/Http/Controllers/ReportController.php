<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Colour;
use App\Factory;
use App\Order;
use App\Order_list;
use App\Style;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function orderReport(Request $request)
    {
        $filter = 0;
        $date = '';
        $factory_id = '';
        $buyer_id = '';
        $style_id = '';
        $colour_id = '';
        $order = Order_list::with('order.factory', 'buyer', 'style', 'colour')->get();
        $factory = Factory::all();
        $buyer = Buyer::all();
        $style = Style::all();
        $colour = Colour::all();
        if ($request->date != null) {
            $date = DateTime::createFromFormat('d/m/Y', $request->date);
            $order = $order->where('order.date', $date->format('Y-m-d'));
            $date = $request->date;
            $filter = 1;
        }

        if ($request->factory != null) {
            $order = $order->where('order.factory_id', base64_decode($request->factory));
            $factory_id = base64_decode($request->factory);
            $filter = 1;
        }

        if ($request->buyer != null) {
            $order = $order->where('buyer_id', base64_decode($request->buyer));
            $buyer_id = base64_decode($request->buyer);
            $filter = 1;
        }

        if ($request->style != null) {
            $order = $order->where('style_id', base64_decode($request->style));
            $style_id = base64_decode($request->style);
            $filter = 1;
        }

        if ($request->colour != null) {
            $order = $order->where('colour_id', base64_decode($request->colour));
            $colour_id = base64_decode($request->colour);
            $filter = 1;
        }


        //dd($order);
        return view('report.order_report', compact('filter','order', 'date', 'factory', 'buyer', 'style', 'colour', 'buyer_id', 'factory_id', 'style_id', 'colour_id'));
    }

    public function stockReport(Request $request){
        $order = Order::select('factory_id', DB::raw('sum(total_qty) as total'))->groupBy('factory_id')->get();
        $date = date('Y-m-d');
        $date2 = date('d/m/Y');
        if ($request->date != null) {
            $date = DateTime::createFromFormat('d/m/Y', $request->date);
            $date = $date->format('Y-m-d');
            $date2 = $request->date;
        }

        return view('report.stock_report',compact('date','date2','order'));
    }
}

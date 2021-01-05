<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Factory;
use App\Grey;
use App\Lab;
use App\Order;
use App\Order_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;
use Session;
use DateTime;
use Illuminate\Support\Collection;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::all();
        return view('order', compact('order'));
    }

    public function newOrder()
    {
        $factory = Factory::all();
        return view('order_receive', compact('factory'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'factory_id' => 'required',
            'date' => 'max:255',
            'total_qty' => 'required',
            'buyer' => 'required',
            'buyer.*' => 'required',
        ]);
        $date = DateTime::createFromFormat('d F, Y', $request->date);
        $insert = new Order();
        $insert->date = $date->format('Y-m-d');
        $insert->factory_id = $request->factory_id;
        $insert->total_qty = $request->total_qty;
        $insert->save();
        $order_id = $insert->id;

        for ($i = 0; $i < count($request->buyer); $i++) {
            $insert2 = new Order_list();
            $insert2->order_id = $order_id;
            $insert2->buyer_id = $request->buyer[$i];
            $insert2->style_id = $request->style[$i];
            $insert2->work_order = $request->work_order[$i];
            $insert2->yarn_count = $request->yarn_count[$i];
            $insert2->fabrics_type = $request->fabrics_type[$i];
            $insert2->dia = $request->dia[$i];
            $insert2->f_dia = $request->f_dia[$i];
            $insert2->gray_gsm = $request->gray_gsm[$i];
            $insert2->gsm = $request->gsm[$i];
            $insert2->colour_id = $request->colour[$i];
            $insert2->quantity = $request->quantity[$i];
            $insert2->remaining = $request->quantity[$i];
            $insert2->save();
        }

        Session::flash('message', 'Order entry successfully');
        return redirect('order');


    }

    public function labOrder($id)
    {
        $factory = Order_list::where('order_id', $id)->where('lab_status', 0)->first();
        if (!$factory) {
            return response()->json(['status' => 'error'], 404);
        }

        $collection = collect();
        $order = Order_list::where('order_id', $id)->get();

        foreach ($order as $orders) {
            $quantity = (int)$orders->grey_received - (int)$orders->batch_received;
            $style = $orders->style ? $orders->style->style_name : '';
            $color = $orders->colour ? $orders->colour->colour_name : '';
            if ($quantity != 0) {
                $collection->push(['id' => $orders->id, 'factory_name' => $orders->order->factory->factory_name,
                    'style' => $style, 'color' => $color,
                    'fabrics_type' => $orders->fabrics_type, 'grey_receive' => $quantity,
                    'buyer_name' => $orders->buyer->buyer]);
            }

        }

        return response()->json(['status' => 'success', 'order' => $collection], 200);
    }

    public function batchOrder($id)
    {
        $lab = Order_list::where('order_id', $id)->where('lab_status', 1)->get();

        if ($lab->first() == null) {
            return response()->json(['status' => 'error'], 404);
        }
        $collection = collect();
        foreach ($lab as $labs) {
            $grey = (int)$labs->grey_received - (int)$labs->batch_received;
            if ($grey > 0) {
                $style = $labs->style ? $labs->style->style_name : '';
                $color = $labs->colour ? $labs->colour->colour_name : '';
                $collection->push(['id' => $labs->id, 'factory_name' => $labs->order->factory->factory_name,
                    'style' => $style, 'color' => $color,
                    'fabrics_type' => $labs->fabrics_type, 'grey_receive' => $grey, 'lab_app' => $labs->lab_name,
                    'buyer_name' => $labs->buyer->buyer]);
            }
        }

        return response()->json(['status' => 'success', 'order' => $collection], 200);
    }

    public function show($id)
    {
        $factory = Order::with('order_list.buyer', 'order_list.style', 'order_list.colour', 'factory')->findOrFail($id);
        return response()->json(['status' => 'success', 'order' => $factory], 200);
    }

    public function simpleOrder($id)
    {
        $order = Order_list::with('order', 'order.factory', 'buyer', 'style', 'colour')->where('id', $id)->get()->first();
        return response()->json(['status' => 'success', 'order' => $order], 200);
    }

    public function greyOrder($id)
    {
        $order = Order_list::with('order', 'order.factory', 'buyer', 'style', 'colour')->findOrFail($id);
        return response()->json(['status' => 'success', 'order' => $order], 200);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

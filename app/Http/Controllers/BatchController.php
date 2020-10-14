<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Factory;
use App\Grey;
use App\Order;
use App\Order_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use DateTime;

class BatchController extends Controller
{
    public function index()
    {
        $batch = Batch::all();
        return view('batch', compact('batch'));
    }

    public function newBatch()
    {
        $factory = Factory::all();
        return view('batch_receive', compact('factory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|max:255',
            'batch_no' => 'required|max:11|unique:batches',
            'order_list_id' => 'required',
            'gray_wt' => 'required',
        ]);
        $order = Order_list::findOrFail($request->order_list_id);

        $grey = Grey::where('order_list_id', $order->id)->get();
        $batch = Batch::where('order_list_id', $order->id)->select('order_list_id', DB::raw('sum(gray_wt) as total'))->groupBy('order_list_id')->get()->first();
        $quantity = $grey->sum('today_receive');
        if ($batch != null) {
            $quantity -= $batch->total;
        }

        if ($request->gray_wt > $quantity){
            return back()->withErrors(['message' => 'Your Grey/WT not much bigger than Grey Received']);
        }


        $date = DateTime::createFromFormat('m/d/Y', $request->date);
        $insert = new Batch();
        $insert->date = $date->format('Y-m-d');
        $insert->order_id = $order->order_id;
        $insert->order_list_id = $request->order_list_id;
        $insert->batch_no = $request->batch_no;
        $insert->machine_no = $request->machine_no;
        $insert->po_no = $request->po_no;
        $insert->compostion = $request->compostion;
        $insert->stitch_length = $request->stitch_length;
        $insert->mark_hole = $request->mark_hole;
        $insert->y_lot = $request->y_lot;
        $insert->gray_wt = $request->gray_wt;
        $insert->save();

        Session::flash('message', 'Batch entry successfully');
        return redirect('batch');
    }

    public function show($id)
    {
        $batch = Batch::with('order_list', 'order_list.buyer', 'order_list.style', 'order_list.colour', 'order_list.order', 'order_list.order.factory')->findOrFail($id);
        return response()->json(['status' => 'success', 'batch' => $batch], 200);
    }

    public function getBatch($id)
    {
        $batch = Batch::where('batch_no', $id)->first();
        if ($batch) {
            return response()->json(['status' => 'success', 'batch' => $batch], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No batch found'], 401);
        }

    }
}

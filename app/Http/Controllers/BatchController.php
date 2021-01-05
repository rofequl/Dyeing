<?php

namespace App\Http\Controllers;

use App\Batch;
use App\BatchList;
use App\Factory;
use App\Grey;
use App\Lab;
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
            'order_id' => 'required',
            'gray_wt' => 'required',
            'gray_wt.*' => 'required',
        ]);

        //dd($request->all());

        for ($i = 0; $i < count($request->gray_wt); $i++) {
            $lab = Order_list::findOrFail($request->order_list_id[$i]);
            if (((int)$lab->grey_received - (int)$lab->batch_received) < $request->gray_wt[$i]) {
                return back()->withErrors(['message' => 'Your Grey/WT not much bigger than Grey Received']);
            }
        }

        $date = DateTime::createFromFormat('m/d/Y', $request->date);
        $insert = new Batch();
        $insert->date = $date->format('Y-m-d');
        $insert->order_id = $request->order_id;
        $insert->batch_no = $request->batch_no;
        $insert->work_order = $request->work_order;
        $insert->compostion = $request->compostion;
        $insert->stitch_length = $request->stitch_length;
        $insert->save();

        for ($i = 0; $i < count($request->gray_wt); $i++) {
            $lab = Order_list::findOrFail($request->order_list_id[$i]);
            $batch_amount = $lab->batch_received + $request->gray_wt[$i];
            $lab->batch_received = $batch_amount;
            $lab->save();

            $batch_list = new BatchList();
            $batch_list->order_list_id = $request->order_list_id[$i];
            $batch_list->batch_id = $insert->id;
            $batch_list->mark_hole = $request->mark_hole[$i];
            $batch_list->y_lot = $request->y_lot[$i];
            $batch_list->grey_wt = $request->gray_wt[$i];
            $batch_list->roll = $request->roll[$i];
            $batch_list->save();
        }

        Session::flash('message', 'Batch entry successfully');
        return redirect('batch');
    }

    public function show($id)
    {
        $batch = Batch::with('batchlist.order_list.buyer', 'batchlist.order_list.style', 'batchlist.order_list.colour', 'order.factory')->findOrFail($id);
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

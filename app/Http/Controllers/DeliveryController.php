<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Delivery;
use App\Order;
use Illuminate\Http\Request;
use Session;
use DateTime;

class DeliveryController extends Controller
{
    public function index()
    {
        $delivery = Delivery::all();
        return view('delivery', compact('delivery'));
    }

    public function newDelivery(Request $request)
    {
        $batch = null;
        $order = null;

        if ($request->order_no) {
            $batch = Batch::where('order_id', $request->order_no)->get();
            if (count($batch) == 0) {
                return back()->withErrors(['message' => 'Batch not found']);
            }
            $order = Order::findOrFail($request->order_no);
        }

        return view('delivery_receive', compact('batch', 'order'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $request->validate([
            'date' => 'required|max:255',
            'order_id' => 'required',
            'batch_no' => 'required',
            'batch_no*' => 'required',
        ]);

        $total_grey = 0;
        $total_finish = 0;
        $total_roll = 0;

        foreach ($request->batch_no as $batch_no) {
            $batch = Batch::where('batch_no', $batch_no)->first();
            $total_grey += $batch->batchlist->sum('grey_wt');
            $total_finish += $batch->batchlist->sum('finished_qty');
            $total_roll += $batch->batchlist->sum('roll');
        }

        $date = DateTime::createFromFormat('d F, Y', $request->date);
        $insert = new Delivery();
        $insert->challan_no = $request->challan_no;
        $insert->order_id = $request->order_id;
        $insert->date = $date->format('Y-m-d');
        $insert->vehicle_no = $request->vehicle_no;
        $insert->driver_name = $request->driver_name;
        $insert->batch_no = json_encode($request->batch_no);
        $insert->total_grey = $total_grey;
        $insert->total_finish = $total_finish;
        $insert->total_roll = $total_roll;
        $insert->save();

        Session::flash('message', 'Delivery challan create successfully');
        return redirect('delivery');


    }

    public function show($id)
    {
        $process = [];
        $order = Batch::where('batch_no', $id)->with('batchlist.order_list.buyer', 'process_list')->first();
        foreach (get_process($order->process_list->process_id) as $processes) {
            array_push($process, $processes->process_name);
        }
        return response()->json(['status' => 'success', 'batch' => $order, 'process' => $process], 200);
    }

    public function deliveryChallan($id)
    {
        $delivery = Delivery::findOrFail($id);
        return view('print.challan', compact('delivery'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $factory = Delivery::findOrFail($id);
        $factory->delete();
    }
}

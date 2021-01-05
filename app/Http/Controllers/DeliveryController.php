<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Bill;
use App\Deliveries_list;
use App\Delivery;
use App\Order;
use Illuminate\Http\Request;
use Session;
use DateTime;

class DeliveryController extends Controller
{
    public function index()
    {
        $delivery = Delivery::orderBy('id', 'DESC')->get();
        return view('delivery', compact('delivery'));
    }

    public function newDelivery(Request $request)
    {


        $batch = collect();
        $id = null;

        if ($request->order_no) {
            $id = $request->order_no;
            foreach (explode(',', $request->order_no) as $item) {
                $batch_info = Batch::where('order_id', $item)->get();
                $order = Order::find($item);
                foreach ($batch_info as $batchs) {
                    $batch->push(['batch' => $batchs, 'order' => $order]);
                }
            }
            if (count($batch) == 0) {
                return back()->withErrors(['message' => 'Batch not found']);
            }
        }
        $order = null;
        if ($data = explode(',', $request->order_no)[0]) {
            $order = Order::findOrFail($item);
        }

        return view('delivery_receive', compact('batch', 'id', 'order'));
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
            'challan_no' => 'required|max:11|unique:deliveries',
            'batch_no*' => 'required',
        ]);

        $date = DateTime::createFromFormat('d F, Y', $request->date);
        $insert = new Delivery();
        $insert->challan_no = $request->challan_no;
        $insert->order_id = $request->order_id;
        $insert->date = $date->format('Y-m-d');
        $insert->vehicle_no = $request->vehicle_no;
        $insert->driver_name = $request->driver_name;
        $insert->batch_no = json_encode($request->batch_no);
        $insert->save();

        for ($i = 0; $i < count($request->batch_list_id); $i++) {
            $entry = new Deliveries_list();
            $entry->delivery_id = $insert->id;
            $entry->batch_list_id = $request->batch_list_id[$i];
            $entry->dia = $request->dia[$i];
            $entry->grey_wt = $request->grey_wt[$i];
            $entry->finished_qty = $request->finished_qty[$i];
            $entry->roll = $request->roll[$i];
            $entry->delivery_remarks = $request->remarks[$i];
            $entry->save();
        }

        Session::flash('message', 'Delivery challan create successfully');
        return redirect('delivery');


    }

    public function show($id)
    {
        $process = [];
        $order = Batch::where('batch_no', $id)->with('batchlist.order_list.buyer', 'process_list')->first();
        if ($order->process_list) {
            foreach (get_process($order->process_list->process_id) as $processes) {
                array_push($process, $processes->process_name);
            }
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
        $bill = Bill::where('challan_no', $factory->challan_no)->first();
        if ($bill) {
            return response()->json(['status' => 'error', 'message' => 'You create a bill also'], 401);
        }
        Deliveries_list::where('delivery_id', $factory->id)->delete();
        $factory->delete();
    }
}

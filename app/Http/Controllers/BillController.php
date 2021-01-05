<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Deliveries_list;
use App\Delivery;
use Illuminate\Http\Request;
use Session;
use DateTime;
use NumberToWords\NumberToWords;

class BillController extends Controller
{
    public function index()
    {
        $bill = Bill::all()->pluck('challan_no');
        $delivery = Delivery::whereIn('challan_no', $bill)->orderBy('id', 'DESC')->get();
        return view('bill', compact('delivery'));
    }

    public function newBillEntry(Request $request)
    {
        $delivery = null;
        $id = null;

        if ($request->order_no) {
            $id = $request->order_no;
            $delivery = Delivery::where('challan_no', $id)->first();
        }

        return view('bill_receive', compact('id', 'delivery'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|max:255',
            'challan_no' => 'required|max:255',
            'remarks*' => 'max:255',
        ]);
        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en');
        $date = DateTime::createFromFormat('d F, Y', $request->date);
        $subtotal = 0;
        for ($i = 0; $i < count($request->batch_id); $i++) {
            $entry = Deliveries_list::where('batch_list_id', $request->batch_id[$i])->first();
            $total = 0;
            if ($request->unit_price[$i]) {
                $total = (int)$entry->grey_wt * (int)$request->unit_price[$i];
            }
            $subtotal += $total;
            $entry->unit_price = (int)$request->unit_price[$i];
            $entry->total_price = $total;
            $entry->bill_remarks = $request->remarks[$i];
            $entry->save();
        }
        $insert = new Bill();
        $insert->challan_no = $request->challan_no;
        $insert->date = $date->format('Y-m-d');
        $insert->total_amount = $subtotal;
        $insert->amount_word = $numberTransformer->toWords((int)$subtotal);
        $insert->save();

        Session::flash('message', 'Bill create successfully');
        return redirect('bill');
    }

    public function billChallan($id)
    {
        $delivery = Delivery::where('challan_no', $id)->first();
        return view('print.bill', compact('delivery'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $factory = Bill::findOrFail($id);
        $factory->delete();
    }
}

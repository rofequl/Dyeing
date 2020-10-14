<?php

namespace App\Http\Controllers;

use App\Grey;
use App\Order_list;
use Illuminate\Http\Request;
use Session;
use DateTime;

class GreyController extends Controller
{
    public function index()
    {
        $grey = Grey::orderBy('id','DESC')->get();
        return view('grey', compact('grey'));
    }

    public function newGrey()
    {
        return view('grey_received');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|max:255',
            'remarks' => 'max:255',
            'order_list_id' => 'required',
            'total_qty' => 'required',
            'today_receive' => 'required',
            'remaining' => 'required',
        ]);

        if ($request->total_qty < $request->today_receive) {
            return back()->withErrors(['message' => 'Your receive not much bigger than total quantity']);
        }

        $order = Order_list::findOrFail($request->order_list_id);
        $order->remaining = $request->total_qty - $request->today_receive;
        $order->save();

        $date = DateTime::createFromFormat('m/d/Y', $request->date);
        $insert = new Grey();
        $insert->date = $date->format('Y-m-d');
        $insert->order_list_id = $request->order_list_id;
        $insert->order_id = $order->order_id;
        $insert->total_qty = $request->total_qty;
        $insert->today_receive = $request->today_receive;
        $insert->remaining = $request->remaining;
        $insert->remarks = $request->remarks;
        $insert->save();
        Session::flash('message', 'Grey entry successfully');
        return redirect('grey');
    }

    public function show($id)
    {
        //
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
        //
    }
}

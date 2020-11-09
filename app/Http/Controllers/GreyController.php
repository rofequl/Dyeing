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
        $grey = Grey::orderBy('id', 'DESC')->get();
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
        //dd($request->all());
        $request->validate([
            'date' => 'required|max:255',
            'remarks' => 'max:255',
            'dia' => 'max:255',
            'gsm' => 'max:255',
            'order_list_id' => 'required',
            'today_receive' => 'required',
        ]);

        $order = Order_list::findOrFail($request->order_list_id);
        $order->remaining = $request->total_qty - ($request->today_receive + $request->grey_receive);
        $order->grey_received = $request->grey_receive + $request->today_receive;
        $order->save();

        $date = DateTime::createFromFormat('d F, Y', $request->date);
        $insert = new Grey();
        $insert->date = $date->format('Y-m-d');
        $insert->order_list_id = $request->order_list_id;
        $insert->order_id = $order->order_id;
        $insert->today_receive = $request->today_receive;
        $insert->remarks = $request->remarks;
        $insert->chalan_no = $request->chalan_no;
        $insert->dia = $request->dia;
        $insert->gsm = $request->gsm;
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

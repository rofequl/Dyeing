<?php

namespace App\Http\Controllers\Manage;

use App\Buyer;
use App\Factory;
use App\Http\Controllers\Controller;
use App\Order_list;
use Illuminate\Http\Request;
use Session;

class BuyerController extends Controller
{
    public function index()
    {
        $factory = Factory::all();
        $buyer = Buyer::all();
        return view('manage.buyer', compact('factory', 'buyer'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'buyer' => 'required|max:255|unique:buyers',
            'factory_id' => 'required',
        ]);
        Buyer::create($request->all());
        Session::flash('message', 'Buyer information insert successfully');
        return redirect('buyer');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $factory = Factory::all();
        $buyer = Buyer::all();
        $edit = Buyer::findOrFail($id);
        return view('manage.buyer', compact('factory', 'buyer', 'edit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'buyer' => 'required|max:255|unique:buyers,buyer,' . $id,
            'factory_id' => 'required',
        ]);
        Buyer::findOrFail($id)->update($request->all());
        Session::flash('message', 'Buyer information update successfully');
        return redirect('buyer');
    }

    public function destroy($id)
    {
        $order = Order_list::where('buyer_id', $id)->get();
        if ($order->count() > 0) {
            return response()->json(['status' => 'error', 'message' => 'This buyer already use another table'], 401);
        }
        $factory = Buyer::findOrFail($id);
        $factory->delete();
    }

    public function factoryBuyer($factory)
    {
        $buyer = Buyer::where('factory_id',$factory)->get();
        return response()->json(['status' => 'success', 'buyer' => $buyer], 200);
    }
}

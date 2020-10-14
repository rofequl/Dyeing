<?php

namespace App\Http\Controllers\Manage;

use App\Buyer;
use App\Factory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFactory;
use App\Order;
use Illuminate\Http\Request;
use Session;

class FactoryController extends Controller
{
    public function index()
    {
        $factory = Factory::all();
        return view('manage.factory', compact('factory'));
    }


    public function create()
    {
        //
    }

    public function store(StoreFactory $request)
    {
        $request->validated();
        Factory::create($request->all());
        Session::flash('message', 'Factory information insert successfully');
        return redirect('factory');

    }

    public function show($id)
    {
        $factory = Factory::findOrFail($id);
        return response()->json(['status' => 'success', 'factory' => $factory], 200);
    }

    public function edit($id)
    {
        $factory = Factory::all();
        $edit = Factory::findOrFail($id);
        return view('manage.factory', compact('factory', 'edit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'factory_name' => 'required|max:255|unique:factories,factory_name,' . $id,
            'phone' => 'max:255',
            'address' => 'max:500',
        ]);
        Factory::findOrFail($id)->update($request->all());
        Session::flash('message', 'Factory information update successfully');
        return redirect('factory');
    }

    public function destroy($id)
    {
        $buyer = Buyer::where('factory_id', $id)->get();
        $order = Order::where('factory_id', $id)->get();
        if ($buyer->count() > 0 || $order->count() > 0) {
            return response()->json(['status' => 'error', 'message' => 'This factory already use another table'], 401);
        }
        $factory = Factory::findOrFail($id);
        $factory->delete();
    }
}

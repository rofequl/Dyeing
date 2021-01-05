<?php

namespace App\Http\Controllers;

use App\Grey;
use App\Lab;
use App\Order_list;
use Illuminate\Http\Request;
use Session;

class LabController extends Controller
{
    public function index()
    {
        $lab = Order_list::where('lab_status', 1)->orderBy('id', 'DESC')->get();
        return view('lab', compact('lab'));
    }

    public function newLab()
    {
        return view('lab_received');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'lab_name' => 'required|max:255',
            'id' => 'required',
        ]);


        $order = Order_list::findOrFail($request->id);
        $order->lab_status = 1;
        $order->lab_name = $request->lab_name;
        $order->save();


        Session::flash('message', 'Lab entry successfully');
        return redirect('Lab');
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

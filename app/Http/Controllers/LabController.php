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
        $lab = Lab::orderBy('id', 'DESC')->get();
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
        $grey = Grey::where('order_list_id', $request->id)->where('lab_status', 0)->get();
        $grey_id = [];
        foreach ($grey as $greys) {
            array_push($grey_id, $greys->id);
        }

        $lab = new Lab();
        $lab->order_id = $order->order_id;
        $lab->order_list_id = $order->id;
        $lab->lab_name = $request->lab_name;
        $lab->grey_receive = $grey->sum('today_receive');
        $lab->remaining_grey = $grey->sum('today_receive');
        $lab->grey_id = json_encode($grey_id);
        $lab->save();

        foreach ($grey as $greys) {
            $insert = Grey::findOrFail($greys->id);
            $insert->lab_id = $lab->id;
            $insert->lab_status = 1;
            $insert->save();
        }


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

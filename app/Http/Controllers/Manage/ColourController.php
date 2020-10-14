<?php

namespace App\Http\Controllers\Manage;

use App\Colour;
use App\Http\Controllers\Controller;
use App\Order_list;
use Illuminate\Http\Request;
use Session;

class ColourController extends Controller
{
    public function index()
    {
        $colour = Colour::all();
        return view('manage.colour', compact('colour'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'colour_name' => 'required|max:255|unique:colours',
        ]);
        Colour::create($request->all());
        Session::flash('message', 'Colour name insert successfully');
        return redirect('colour');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $colour = Colour::all();
        $edit = Colour::findOrFail($id);
        return view('manage.colour', compact('colour', 'edit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'colour_name' => 'required|max:255|unique:colours,colour_name,' . $id,
        ]);
        Colour::findOrFail($id)->update($request->all());
        Session::flash('message', 'Colour name update successfully');
        return redirect('colour');
    }

    public function destroy($id)
    {
        $order = Order_list::where('colour_id', $id)->get();
        if ($order->count() > 0) {
            return response()->json(['status' => 'error', 'message' => 'This colour already use another table'], 401);
        }
        $factory = Colour::findOrFail($id);
        $factory->delete();
    }

    public function colourList()
    {
        $style = Colour::all();
        return response()->json(['status' => 'success', 'colour' => $style], 200);
    }
}

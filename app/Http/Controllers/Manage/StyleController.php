<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Order_list;
use App\Style;
use Illuminate\Http\Request;
use Session;

class StyleController extends Controller
{
    public function index()
    {
        $style = Style::all();
        return view('manage.style', compact('style'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'style_name' => 'required|max:255|unique:styles',
        ]);
        Style::create($request->all());
        Session::flash('message', 'Style name insert successfully');
        return redirect('style');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $style = Style::all();
        $edit = Style::findOrFail($id);
        return view('manage.style', compact('style', 'edit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'style_name' => 'required|max:255|unique:styles,style_name,' . $id,
        ]);
        Style::findOrFail($id)->update($request->all());
        Session::flash('message', 'Style name update successfully');
        return redirect('style');
    }

    public function destroy($id)
    {
        $order = Order_list::where('style_id', $id)->get();
        if ($order->count() > 0) {
            return response()->json(['status' => 'error', 'message' => 'This style already use another table'], 401);
        }
        $factory = Style::findOrFail($id);
        $factory->delete();
    }

    public function styleList()
    {
        $style = Style::all();
        return response()->json(['status' => 'success', 'style' => $style], 200);
    }
}

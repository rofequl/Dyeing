<?php

namespace App\Http\Controllers;

use App\Finished;
use Session;
use DateTime;
use Illuminate\Http\Request;

class FinishedController extends Controller
{
    public function index()
    {
        $finished = Finished::all();
        return view('finished', compact('finished'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|unique:finisheds',
            'gray_qty' => 'required',
            'finished_qty' => 'required',
            'waste' => 'required',
            'date' => 'required',
        ]);
        $date = DateTime::createFromFormat('m/d/Y', $request->date);
        $insert = new Finished();
        $insert->date = $date->format('Y-m-d');
        $insert->batch_id = $request->batch_id;
        $insert->gray_qty = $request->gray_qty;
        $insert->finished_qty = $request->finished_qty;
        $insert->waste = $request->waste;
        $insert->save();


        Session::flash('message', 'Finished entry successfully');
        return redirect('finished');
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

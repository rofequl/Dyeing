<?php

namespace App\Http\Controllers;

use App\Batch;
use App\BatchList;
use App\Finished;
use Session;
use DateTime;
use Illuminate\Http\Request;

class FinishedController extends Controller
{
    public function index()
    {
        $finished = BatchList::where('finished_received', 1)->get();
        return view('finished', compact('finished'));
    }

    public function newFinished(Request $request)
    {
        $batch = null;
        if ($request->batch_no) {
            $batch = Batch::where('batch_no', $request->batch_no)->first();
            if (!$batch) {
                return back()->withErrors(['message' => 'Batch no Invalid']);
            }
        }
        return view('finished_receive', compact('batch'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'batchlist_id' => 'required',
            'gray_qty' => 'required',
            'finished_qty' => 'required',
            'waste' => 'required',
        ]);

        $insert = BatchList::findOrFail($request->batchlist_id);
        $insert->grey_wt = $request->gray_qty;
        $insert->finished_qty = $request->finished_qty;
        $insert->waste = $request->waste;
        $insert->finished_received = 1;
        $insert->save();


        Session::flash('message', 'Finished entry successfully');
        return redirect()->back();
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

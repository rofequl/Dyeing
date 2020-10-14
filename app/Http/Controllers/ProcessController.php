<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Process;
use App\Process_list;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;
use Session;

class ProcessController extends Controller
{

    public function index()
    {
        $process = Process::all();
        $process_list = Process_list::all();
        //dd($process_list);
        return view('process_entry', compact('process','process_list'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|unique:process_lists',
            'process' => 'required',
            'process.*' => 'required',
        ]);
        $input = $request->all();
        $input['process_id'] = json_encode($request->input('process'));
        Process_list::create($input);
        Session::flash('message', 'Process entry successfully');
        return redirect('process-entry');
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

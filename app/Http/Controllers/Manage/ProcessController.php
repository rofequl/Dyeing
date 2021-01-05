<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Process;
use App\Process_list;
use Illuminate\Http\Request;
use Session;

class ProcessController extends Controller
{
    public function index()
    {
        $process = Process::all();
        return view('manage.process', compact('process'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'process_name' => 'required|max:255|unique:processes',
        ]);
        Process::create($request->all());
        Session::flash('message', 'Process name insert successfully');
        return redirect('process');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $process = Process::all();
        $edit = Process::findOrFail($id);
        return view('manage.process', compact('process', 'edit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'process_name' => 'required|max:255|unique:processes,process_name,' . $id,
        ]);
        Process::findOrFail($id)->update($request->all());
        Session::flash('message', 'Process name update successfully');
        return redirect('process');
    }

    public function destroy($id)
    {
        $process = Process_list::all();
        foreach ($process as $processes) {
            $data = json_decode($processes->process_id);
            if (in_array($id, $data)) {
                return response()->json(['status' => 'error', 'message' => 'This Process already use another table'], 401);
            }
        }
        $factory = Process::findOrFail($id);
        $factory->delete();
    }
}

<?php

use App\Batch;
use App\Grey;
use App\Order;
use App\Process;
use Illuminate\Support\Facades\DB;

function get_process($id)
{
    $id = json_decode($id);
    return Process::whereIn('id', $id)->get();
}

function preOrderQty($factoryId, $date)
{
    $order = Order::where('factory_id', $factoryId)->get()->sum('total_qty');
    $order2 = Order::where('factory_id', $factoryId)->where('date', $date)->get()->sum('total_qty');
    return $order - $order2;
}

function getOrderRece($factoryId, $date)
{
    $order = Order::where('factory_id', $factoryId)->where('date', $date)->get()->sum('total_qty');
    return $order;
}

function preGreyQty($factoryId, $date)
{
    $order = Order::where('factory_id', $factoryId)->get();
    $grey = 0;
    $grey2 = 0;
    foreach ($order as $orders) {
        $grey += Grey::where('order_id', $orders->id)->get()->sum('today_receive');
        $grey2 += Grey::where('order_id', $orders->id)->get()->where('date', $date)->sum('today_receive');
    }
    return $grey - $grey2;
}

function getGreyRece($factoryId, $date)
{
    $order = Order::where('factory_id', $factoryId)->get();
    $grey2 = 0;
    foreach ($order as $orders) {
        $grey2 += Grey::where('order_id', $orders->id)->get()->where('date', $date)->sum('today_receive');
    }
    return $grey2;
}

function totalGreyQty($factoryId, $date)
{
    $order = Order::where('factory_id', $factoryId)->get();
    $grey = 0;
    foreach ($order as $orders) {
        $grey += Grey::where('order_id', $orders->id)->get()->sum('today_receive');
    }
    return $grey;
}


function preBatchQty($factoryId, $date)
{
    $order = Order::where('factory_id', $factoryId)->get();
    $batch = 0;
    $batch2 = 0;
    foreach ($order as $orders) {
        $data = Batch::where('order_id', $orders->id)->select('order_id', DB::raw('sum(gray_wt) as total'))->groupBy('order_id')->get()->first();
        $data2 = Batch::where('order_id', $orders->id)->where('date', $date)->select('order_id', DB::raw('sum(gray_wt) as total'))->groupBy('order_id')->get()->first();
        if ($data != null){
            $batch += $data->total;
        }
        if ($data2 != null){
            $batch2 += $data2->total;
        }
    }
    return $batch - $batch2;
}

function getBatchQty($factoryId, $date)
{

    $order = Order::where('factory_id', $factoryId)->get();
    $batch2 = 0;
    foreach ($order as $orders) {
        $data2 = Batch::where('order_id', $orders->id)->where('date', $date)->select('order_id', DB::raw('sum(gray_wt) as total'))->groupBy('order_id')->get()->first();
        if ($data2 != null){
            $batch2 += $data2->total;
        }
    }
    return $batch2;
}

function totalBatchQty($factoryId, $date)
{

    $order = Order::where('factory_id', $factoryId)->get();
    $batch = 0;
    foreach ($order as $orders) {
        $data = Batch::where('order_id', $orders->id)->select('order_id', DB::raw('sum(gray_wt) as total'))->groupBy('order_id')->get()->first();
        if ($data != null){
            $batch += $data->total;
        }
    }
    return $batch;
}


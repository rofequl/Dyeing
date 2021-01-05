<?php

use App\Batch;
use App\BatchList;
use App\Bill;
use App\Deliveries_list;
use App\Grey;
use App\Order;
use App\Process;
use Illuminate\Support\Facades\DB;

function get_process($id)
{
    $id = json_decode($id);
    return Process::whereIn('id', $id)->get();
}

function get_delivery($id)
{
    $id = json_decode($id);
    return Batch::whereIn('batch_no', $id)->get();
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
        $data = Batch::where('order_id', $orders->id)->select('id')->get();
        $batchlist = BatchList::whereIn('batch_id', $data)->get();
        $data2 = Batch::where('order_id', $orders->id)->where('date', $date)->select('id')->get();
        $batchlist2 = BatchList::whereIn('batch_id', $data2)->get();
        if ($batchlist != null) {
            $batch += $batchlist->sum('grey_wt');
        }
        if ($batchlist2 != null) {
            $batch2 += $batchlist2->sum('grey_wt');
        }
    }

    return $batch - $batch2;
}

function getBatchQty($factoryId, $date)
{

    $order = Order::where('factory_id', $factoryId)->get();
    $batch2 = 0;
    foreach ($order as $orders) {
        $data2 = Batch::where('order_id', $orders->id)->where('date', $date)->select('id')->get();
        $batchlist2 = BatchList::whereIn('batch_id', $data2)->get();

        if ($batchlist2 != null) {
            $batch2 += $batchlist2->sum('grey_wt');
        }
    }
    return $batch2;
}

function totalBatchQty($factoryId, $date)
{

    $order = Order::where('factory_id', $factoryId)->get();
    $batch = 0;
    foreach ($order as $orders) {
        $data = Batch::where('order_id', $orders->id)->select('id')->get();
        $batchlist = BatchList::whereIn('batch_id', $data)->get();
        if ($batchlist != null) {
            $batch += $batchlist->sum('grey_wt');
        }
    }
    return $batch;
}

function getDeliveryChalan($id)
{
    return Deliveries_list::where('batch_list_id', $id)->first();
}

function getBillChalan($id)
{
    return Bill::where('challan_no', $id)->first();
}

@extends('layouts.app')
@section('title','Dyeing Factory')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <i class="fa fa-times-circle mx-2"></i>
                <strong>Error!</strong> {{$error}}!
            </div>
        @endforeach
    @endif
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <i class="fa fa-check mx-2"></i>
            <strong>Success!</strong> {{ session()->get('message') }}!
        </div>
    @endif
    <div class="main-content-container container-fluid px-4 mb-4">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-6 text-center text-sm-left mb-4 mb-sm-0">
                <span class="text-uppercase page-subtitle"></span>
                <h3 class="page-title">Grey Receive</h3>
            </div>
            <div class="col-12 col-sm-6 d-flex align-items-center">
                <div class="d-inline-flex mb-sm-0 mx-auto ml-sm-auto mr-sm-0" role="group" aria-label="Page actions">
                    <a href="{{route('grey.entry')}}" class="btn btn-primary">
                        <i class="material-icons">add</i> New Grey Entry</a>
                </div>
            </div>
        </div>
        <table class="transaction-history d-none">
            <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Order No.</th>
                <th>Order List No.</th>
                <th>Factory Name</th>
                <th>Buyer Name</th>
                <th>Total Quantity</th>
                <th>Total Received</th>
                <th>Remaining Order Quantity</th>
                <th>Remarks</th>
            </tr>
            </thead>
            <tbody>@php $sl = 1; @endphp
            @foreach($grey as $greys)
                <tr>
                    <td>{{$sl}}</td>@php $sl++; @endphp
                    <td>{{$greys->date}}</td>
                    <td>{{$greys->order_list->order_id}}</td>
                    <td>{{$greys->order_list_id}}</td>
                    <td>{{$greys->order_list->order->factory->factory_name}}</td>
                    <td>{{$greys->order_list->buyer->buyer}}</td>
                    <td>{{$greys->total_qty}}</td>
                    <td>{{$greys->today_receive}}</td>
                    <td>{{$greys->remaining}}</td>
                    <td>{{$greys->remarks}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('assets/styles/responsive.dataTables.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/sweetalert/sweetalert.css')}}"/>
@endpush
@push('script')
    <script src="{{asset('assets/scripts/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/scripts/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/scripts/app/app-transaction-history.1.3.1.min.js')}}"></script>
    <script src="{{asset('assets/sweetalert/sweetalert.js')}}"></script>
    <script>
        $('.view').click(function () {
            let id = $(this).attr("id");
            $.ajax({
                url: "{!! route('batch.show','') !!}" + "/" + id,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    $('.factory_name').html(data.batch.order_list.order.factory.factory_name);
                    $('.batch_no').html(data.batch.batch_no);
                    $('.machine_no').html(data.batch.machine_no);
                    $('.buyer_name').html(data.batch.order_list.buyer.buyer);
                    $('.po_no').html(data.batch.po_no);
                    $('.colour').html(data.batch.order_list.colour.colour_name);
                    $('.date').html(data.batch.date);
                    $('.compostion').html(data.batch.compostion);
                    $('.fab_type').html(data.batch.order_list.fabrics_type);
                    $('.yarn_count').html(data.batch.order_list.yarn_count);
                    $('.stitch_length').html(data.batch.stitch_length);
                    $('.finish_gsm').html(data.batch.order_list.gsm);
                    $('.mc_dia').html(data.batch.order_list.dia);
                    $('.finish_dia').html(data.batch.order_list.f_dia);
                    $('.mark_hole').html(data.batch.mark_hole);
                    $('.y_lot').html(data.batch.y_lot);
                    $('.gray_wt').html(data.batch.gray_wt);
                    $('.roll').html(data.batch.order_list.roll);
                    $('.finish_wt').html(data.batch.Finish_wt);
                    $('#exampleModal').modal('show');
                }
            });
        });
    </script>
@endpush

